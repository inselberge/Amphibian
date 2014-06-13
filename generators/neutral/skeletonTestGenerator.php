<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Carl "Tex" Morgan
 * Date: 6/7/13
 * Time: 1:52 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."config.inc.php";
require_once AMPHIBIAN_CORE_NEUTRAL . "FileList.php";
require_once AMPHIBIAN_CORE_NEUTRAL . "CheckInput.php";
require_once "interfaces".DIRECTORY_SEPARATOR."skeletonTestGeneratorInterface.php";

/**
 * Class SkeletonTestGenerator
 *
 * @category Testing
 * @package  Testing
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/skeletonTestGenerator
 */
class SkeletonTestGenerator
    implements SkeletonTestGeneratorInterface
{
    /**
     * @var object skeletonTestGenerator
     */
    public static $skeletonTestGenerator;
    /**
     * @var  sourceDirectory
     */
    protected $sourceDirectory;
    /**
     * @var  destinationDirectory
     */
    protected $destinationDirectory;
    /**
     * @var  FileList
     */
    protected $fileList;
    /**
     * @var  currentFile
     */
    protected $currentFile;
    /**
     * @var  testFile
     */
    protected $testFile;
    /**
     * @var  currentClass
     */
    protected $currentClass;
    /**
     * @var string classType used in addition to the class name
     */
    protected $classType;
    /**
     * @var  _cmd
     */
    private $_cmd;

    /** __construct
     */
    protected function __construct()
    {
    }

    /** instance
     *
     * @param $source
     *
     * @return bool|skeletonTestGenerator
     */
    static public function instance($source)
    {
        try {
            if ( CheckInput::checkNewInput($source) ) {
                if ( self::$skeletonTestGenerator === null ) {
                    self::$skeletonTestGenerator = new skeletonTestGenerator();
                } else {
                }
                self::$skeletonTestGenerator->sourceDirectory = $source;
            } else {
                throw new ExceptionHandler(" : The source directory is not set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return self::$skeletonTestGenerator;
    }

    /** setDestination
     *
     * @param string $destination the destination directory
     *
     * @return bool
     */
    public function setDestination($destination)
    {
        try {
            if ( CheckInput::checkNewInput($destination) ) {
                $this->destinationDirectory = $destination;
            } else {
                throw new ExceptionHandler(" : The destination directory is not set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**  setClassType
     *
     * @param string $classType
     *
     * @return boolean
     */
    public function setClassType( $classType )
    {
        try {
            if ( CheckInput::checkNewInput($classType) ) {
                $this->classType = $classType;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": classType is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }



    /** execute
     *
     * @return bool
     */
    public function execute()
    {
        try {
            if ( $this->checkSlash($this->sourceDirectory) ) {
            } else {
                $this->sourceDirectory .= "/";
            }
            if ( $this->checkSlash($this->destinationDirectory) ) {
            } else {
                $this->destinationDirectory .= "/";
            }
            $this->fileList = FileList::instance(".php");
            $this->fileList->setLocation($this->sourceDirectory);
            $this->fileList->execute();
            if ( !CheckInput::checkNewInput($this->fileList) ) {
                throw new ExceptionHandler(" : The file list could not be created.");
            } else {
                foreach ( $this->fileList->matches as  $this->currentFile ) {
                    $this->iterate();
                    $this->setupForNext();
                }
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkSlash
     *
     * @param $directory
     *
     * @return bool
     */
    protected function checkSlash($directory)
    {
        if ( substr($directory, -1) === "/" ) {
            return true;
        } else {
            return false;
        }
    }

    /** iterate
     *
     * @return bool
     */
    protected function iterate()
    {
        try {
            $this->currentClass = explode('.', $this->currentFile);
            if ( CheckInput::checkNewInputArray($this->currentClass) ) {
                if ( $this->checkTestFileExists() ) {
                    echo __METHOD__." : $this->currentFile already has a test file, skipping." . PHP_EOL;
                } else {
                    $this->generateTestFile();
                }
            } else {
                throw new ExceptionHandler(" : $this->currentFile is not a file, skipping.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkTestFileExists
     *
     * @return bool
     */
    protected function checkTestFileExists()
    {
        if ( is_file($this->destinationDirectory . $this->currentClass['0'] . "Test.php") ) {
            return true;
        } else {
            return false;
        }
    }

    /** generateTestFile
     *
     * @return bool
     */
    protected function generateTestFile()
    {
        try {
            //root of the command
            $this->_cmd = "phpunit-skelgen --test -- ";
            // source class
            if ( CheckInput::checkSet($this->classType) ) {
                $this->_cmd .= ucwords($this->currentClass['0']). $this->classType;
            } else {
                $this->_cmd .= $this->currentClass['0'];
            }
            //source file
            $this->_cmd .= " " . $this->sourceDirectory . $this->currentFile;
            //destination class
            if ( CheckInput::checkSet($this->classType) ) {
                $this->_cmd .= " " .ucwords($this->currentClass['0']). $this->classType."Test";
            } else {
                $this->_cmd .= " " .$this->currentClass['0']. "Test";
            }
            //destination file
            $this->_cmd .= " " . $this->destinationDirectory . $this->currentClass['0'] . "Test.php";
            if ( !exec($this->_cmd) ) {
                throw new ExceptionHandler(" : Failed to generate file with the following command: " . PHP_EOL . $this->_cmd);
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setupForNext
     *
     * @return void
     */
    protected function setupForNext()
    {
        $this->currentFile = null;
    }
}

/*
 *  Run for core PHP classes
$core = skeletonTestGenerator::instance("/home/carl/Public/Amphibian/generators/core");
$core->setDestination("/home/carl/Public/Amphibian/generators/tests/core");
$core->execute();
*/
/*
 * Run for generator PHP classes
$gen = skeletonTestGenerator::instance("/home/carl/Public/Amphibian/generators/php");
$gen->setDestination("/home/carl/Public/Amphibian/generators/tests/php");
$gen->execute();
*/
/*
$core = skeletonTestGenerator::instance("/home/carl/Public/Coworks.In/controllers/generated");
$core->setDestination("/home/carl/Public/Public/Coworks.In/controllers/tests/generated");
$core->execute();
*/

/*
 * InnerAlly
 *
TODO: figure out why the definitions aren't being followed in the classes, agencies, and controllers
require_once AMPHIBIAN_CONFIG."InnerAlly.config.inc.php";
$agencies = skeletonTestGenerator::instance(AGENCIES_CUSTOM);
$agencies->setDestination(TEST_AGENCIES_CUSTOM);
$agencies->execute();

$agencies = skeletonTestGenerator::instance(AGENCIES_DECORATORS);
$agencies->setDestination(TEST_AGENCIES_DECORATORS);
$agencies->execute();

$agencies = skeletonTestGenerator::instance(AGENCIES_GENERATED);
$agencies->setDestination(TEST_AGENCIES_GENERATED);
$agencies->execute();

$controllers = skeletonTestGenerator::instance(CONTROLLERS_CUSTOM);
$controllers->setDestination(TEST_CONTROLLERS_CUSTOM);
$controllers->execute();

$controllers = skeletonTestGenerator::instance(CONTROLLERS_GENERATED);
$controllers->setDestination(TEST_GENERATED_CONTROLLERS);
$controllers->execute();

$generatedModels = skeletonTestGenerator::instance(MODELS_GENERATED);
$generatedModels->setClassType("Model");
$generatedModels->setDestination(TEST_GENERATED_MODELS);
$generatedModels->execute();

$helperModels = skeletonTestGenerator::instance(MODELS_HELPERS);
$helperModels->setDestination(TEST_MODEL_HELPERS);
$helperModels->execute();

$customModels = skeletonTestGenerator::instance(MODELS_CUSTOM);
$customModels->setDestination(TEST_CUSTOM_MODELS);
$customModels->execute();

$decoratorModels = skeletonTestGenerator::instance(MODELS_DECORATORS);
$decoratorModels->setDestination(TEST_MODELS_DECORATORS);
$decoratorModels->execute();
*/