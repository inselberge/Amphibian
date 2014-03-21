<?php
/**
 * PHP Version 5.5.3-1ubuntu2
 * Created by PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 11/18/13
 * Time: 1:07 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."config.inc.php";
require_once AMPHIBIAN_CORE . "CheckInput.php";
require_once "interfaces".DIRECTORY_SEPARATOR."PHPUMLGeneratorInterface.php";
/**
 * Class PHPUMLGenerator
 *
 * @category Generator
 * @package  PHPUMLGenerator  
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/Amphibian/documentation/PHPUMLGenerator
 */
class PHPUMLGenerator 
    implements PHPUMLGeneratorInterface
{
    /**
     * @var string source the location of the file(s) to generate
     */
    protected $source;
    /**
     * @var string destination the location of where the file(s) should generate
     */
    protected $destination;
    /**
     * @var array acceptableFormats acceptable formats for phpuml
     */
    static protected $acceptableFormats = array("xmi", "html", "htmlnew", "php");
    /**
     * @var string outputFormat the specific acceptable output type to use
     */
    protected $outputFormat = "htmlnew";
    /**
     * @var integer xmiVersion the specific version of XMI to use
     */
    protected $xmiVersion = 2;
    /**
     * @var string encoding the specific character encoding to use
     */
    protected $encoding;
    /**
     * @var string command the command to run to generate the documentation files
     */
    protected $command;
    /**
     * @var object PHPUMLGenerator a singleton instances of this class
     */
    static public $PHPUMLGenerator;
    
    /** __construct
     */
    protected function __construct()
    {
    
    }
    
    /** instance
     *
     * @return PHPUMLGenerator
     */    
    static public function instance()
    {
        if ( !isset(self::$PHPUMLGenerator) ) {
            self::$PHPUMLGenerator = new PHPUMLGenerator(); 
        }
        return self::$PHPUMLGenerator;
    }
    
    /** factory
     *
     * @return PHPUMLGenerator
     */    
    static public function factory()
    {
        return new PHPUMLGenerator();
    }

    /**  setDestination
     *
     * @param string $destination the location of where the file(s) should generate
     *
     * @return boolean
     */
    public function setDestination( $destination )
    {
        try {
            if ( CheckInput::checkNewInput($destination) ) {
                if ( is_file($destination) OR is_dir($destination) ) {
                    $this->destination = $destination;
                } else {
                    throw new ExceptionHandler(__METHOD__ . ": destination does not exist");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": destination is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**  setSource
     *
     * @param string $source the location of the file(s) to generate
     *
     * @return boolean
     */
    public function setSource( $source )
    {
        try {
            if ( CheckInput::checkNewInput($source) ) {
                if ( is_file($source) OR is_dir($source) ) {
                    $this->source = $source;
                } else {
                    throw new ExceptionHandler(__METHOD__ . ": source does not exist");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": source is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**  setEncoding
     *
     * @param string $encoding the specific character encoding to use
     *
     * @return boolean
     */
    public function setEncoding( $encoding )
    {
        try {
            if ( CheckInput::checkNewInput($encoding) ) {
                $this->encoding = $encoding;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": encoding is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**  setOutputFormat
     *
     * @param string $outputFormat the specific acceptable output format to use
     *
     * @return boolean
     */
    public function setOutputFormat( $outputFormat )
    {
        try {
            if ( CheckInput::checkNewInput($outputFormat) ) {
                if ( in_array($outputFormat, self::$acceptableFormats) ) {
                    $this->outputFormat = $outputFormat;
                } else {
                    throw new ExceptionHandler(__METHOD__ . ": outputFormat is not acceptable");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": outputFormat is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**  setXmiVersion
     *
     * @param int $xmiVersion the specific version of XMI to use
     *
     * @return boolean
     */
    public function setXmiVersion( $xmiVersion )
    {
        try {
            if ( CheckInput::checkNewInput($xmiVersion) ) {
                $this->xmiVersion = $xmiVersion;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": xmiVersion is not valid");
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
            if ( $this->makeCommand() ) {
                if ( !exec($this->command) ) {
                    throw new ExceptionHandler(__METHOD__." : Failed to generate documenation with the following command: \n" . $this->command);
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": could not make the command.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** makeCommand
     *
     * @return bool
     */
    protected function makeCommand()
    {
        try {
            if ( $this->checkRequired() ) {
                $this->command = 'phpuml '. $this->source;
                $this->command .= ' -o '. $this->destination;
                $this->command .= ' -f '. $this->outputFormat;
                if ( $this->outputFormat == "xmi" ) {
                    $this->command .= ' -x '.$this->xmiVersion;
                }
                $this->command .= ' --pure-object';
            } else {
                throw new ExceptionHandler(__METHOD__ . ": requirements not met.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkRequired
     *
     * @return bool
     */
    protected function checkRequired()
    {
        if ( isset($this->source, $this->destination, $this->outputFormat) ) {
            return true;
        } else {
            return false;
        }
    }
}
//require_once AMPHIBIAN_CONFIG."InnerAlly.config.inc.php";
/*
 * Agency Documentation

$agencyDocumentation = PHPUMLGenerator::factory();
//$agencyDocumentation->setOutputFormat("xmi");
//$agencyDocumentation->setXmiVersion(1);
//Custom Agencies
$agencyDocumentation->setSource(AGENCIES_CUSTOM);
$agencyDocumentation->setDestination(DOCUMENTATION_UML_AGENCIES_CUSTOM);
$agencyDocumentation->execute();

//Decorator Agencies
$agencyDocumentation->setSource(AGENCIES_DECORATORS);
$agencyDocumentation->setDestination(DOCUMENTATION_UML_AGENCIES_DECORATORS);
$agencyDocumentation->execute();

//Generated Agencies
$agencyDocumentation->setSource(AGENCIES_GENERATED);
$agencyDocumentation->setDestination(DOCUMENTATION_UML_AGENCIES_GENERATED);
$agencyDocumentation->execute();
*/
/*
 * Controller Documentation

$controllerDocumentation = PHPUMLGenerator::factory();
//$controllerDocumentation->setOutputFormat("xmi");
//$controllerDocumentation->setXmiVersion(1);
//Custom Controllers
$controllerDocumentation->setSource(CONTROLLERS_CUSTOM);
$controllerDocumentation->setDestination(DOCUMENTATION_UML_CONTROLLERS_CUSTOM);
$controllerDocumentation->execute();

//Generated Controllers
$controllerDocumentation->setSource(CONTROLLERS_GENERATED);
$controllerDocumentation->setDestination(DOCUMENTATION_UML_CONTROLLERS_GENERATED);
$controllerDocumentation->execute();
 */

/*
 * Model Documentation
 *

$modelDocumentation = PHPUMLGenerator::factory();
//$modelDocumentation->setOutputFormat("xmi");
//$modelDocumentation->setXmiVersion(1);
//Custom Models
$modelDocumentation->setSource(MODELS_CUSTOM);
$modelDocumentation->setDestination(DOCUMENTATION_UML_MODELS_CUSTOM);
$modelDocumentation->execute();

//Decorator Models
$modelDocumentation->setSource(MODELS_DECORATORS);
$modelDocumentation->setDestination(DOCUMENTATION_UML_MODELS_DECORATORS);
$modelDocumentation->execute();

//Generated Models
$modelDocumentation->setSource(MODELS_GENERATED);
$modelDocumentation->setDestination(DOCUMENTATION_UML_MODELS_GENERATED);
$modelDocumentation->execute();

//Helper Models
$modelDocumentation->setSource(MODELS_HELPERS);
$modelDocumentation->setDestination(DOCUMENTATION_UML_MODELS_HELPERS);
$modelDocumentation->execute();
 */
/*
 * View Documentation
 *
$viewDocumentation = PHPUMLGenerator::factory();
//$viewDocumentation->setOutputFormat("xmi");
//$viewDocumentation->setXmiVersion(1);
//Custom Browse Views
$viewDocumentation->setSource(VIEWS_CUSTOM_BROWSE);
$viewDocumentation->setDestination(DOCUMENTATION_UML_VIEWS_CUSTOM_BROWSE);
$viewDocumentation->execute();
//Custom Form Views
$viewDocumentation->setSource(VIEWS_CUSTOM_FORMS);
$viewDocumentation->setDestination(DOCUMENTATION_UML_VIEWS_CUSTOM_FORMS);
$viewDocumentation->execute();
//Custom Partial Views
$viewDocumentation->setSource(VIEWS_CUSTOM_PARTIALS);
$viewDocumentation->setDestination(DOCUMENTATION_UML_VIEWS_CUSTOM_PARTIALS);
$viewDocumentation->execute();
//Generated Browse Views
$viewDocumentation->setSource(BROWSE_ELEMENTS);
$viewDocumentation->setDestination(DOCUMENTATION_UML_VIEWS_GENERATED_BROWSE);
$viewDocumentation->execute();
//Generated Form Views
$viewDocumentation->setSource(FORM_ELEMENTS);
$viewDocumentation->setDestination(DOCUMENTATION_UML_VIEWS_GENERATED_FORMS);
$viewDocumentation->execute();
//Generated Partial Views
$viewDocumentation->setSource(PARTIAL_ELEMENTS);
$viewDocumentation->setDestination(DOCUMENTATION_UML_VIEWS_GENERATED_PARTIALS);
$viewDocumentation->execute();
 */