<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 6/14/13
 * Time: 3:10 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."config.inc.php";
require_once AMPHIBIAN_CONFIG . "Amphibian.config.inc.php";
require_once "BasicGenerator.php";
require_once "interfaces".DIRECTORY_SEPARATOR."classGeneratorInterface.php";
/**
 * Class classGenerator
 *
 * @category Generator
 * @package  Model
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/classGenerator
 */
abstract class ClassGenerator
    extends BasicGenerator
    implements ClassGeneratorInterface
{
    /**
     * @var object classGenerator a singleton instance of this class
     */
    public static $classGenerator;
    /**
     * @var resource interfaceHandle a file handle for the interface file
     */
    protected $interfaceHandle;
    /**
     * @var resource helperHandle a file handle for the helper file
     */
    protected $helperHandle;
    /**
     * @var string currentType the current type of the variable
     */
    protected $currentType;
    /**
     * @var string author holds values for the author
     */
    protected $author;
    /**
     * @var string license holds values for license
     */
    protected $license;
    /**
     * @var string link holds values for the base documentation link
     */
    protected $link;

    /**  setAuthor
     *
     * @param string $author the name and email of the author
     *
     * @return boolean
     */
    public function setAuthor( $author )
    {
        try {
            if ( CheckInput::checkNewInput($author) ) {
                $this->author = $author;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": author is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getAuthor
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**  setLicense
     *
     * @param string $license the license the class is using
     *
     * @return boolean
     */
    public function setLicense( $license )
    {
        try {
            if ( CheckInput::checkNewInput($license) ) {
                $this->license = $license;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": license is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getLicense
     *
     * @return string
     */
    public function getLicense()
    {
        return $this->license;
    }

    /** setLink
     *
     * @param string $link the URL to use in the class header
     *
     * @return boolean
     */
    public function setLink( $link )
    {
        try {
            if ( CheckInput::checkNewInput($link) ) {
                $this->link = $link;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": link is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getLink
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /** iterate
     *
     * @return void
     */
    protected function iterate()
    {
        if ($this->getTableDescription() ) {
            $this->writeTemplates();
            $this->writeFromBuffer();
            //TODO: find a new use for current Helper, possibly as starter for custom
            //$this->writeHelperTemplate();
        }
        $this->setupForNext();
    }

    /** getTableDescription
     *
     * @return bool
     */
    abstract protected function getTableDescription();

    /** writeTemplates
     *
     * @return bool
     */
    protected function writeTemplates()
    {
        try {
            if ( !$this->startClass() ) {
                throw new ExceptionHandler(__METHOD__."There was a problem starting the new class.");
            }
            if ( !$this->addAttributes() ) {
                throw new ExceptionHandler(__METHOD__."There was a problem adding attributes to the new class.");
            }
            if ( !$this->addMethods() ) {
                throw new ExceptionHandler(__METHOD__."There was a problem adding methods to the new class.");
            }
            if ( !$this->endClass() ) {
                throw new ExceptionHandler(__METHOD__."There was a problem ending the new class.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** startClass
     *
     * @return bool
     */
    protected function startClass()
    {
        $this->buffer = '<?php ' . PHP_EOL;
        $this->addFileComment();
        $this->buffer .= 'require_once __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."config.inc.php";' . PHP_EOL;
        $this->buffer .= 'require_once CORE_ABSTRACT."BasicModel.php";' . PHP_EOL;
        $this->buffer .= 'require_once CORE_INTERFACES."concreteModelInterface.php";' . PHP_EOL;
        $this->addClassComment();
        $this->buffer .= 'class ' . $this->tableName . 'Model' . PHP_EOL;
        $this->buffer .= '    extends basicModel'.PHP_EOL;
        $this->buffer .= '    implements concreteModelInterface'.PHP_EOL;
        $this->buffer .= '{'.PHP_EOL;
        return true;
    }

    /** addClassComment
     *
     * @return void
     */
    protected function addClassComment()
    {
        $this->buffer .= '/**' . PHP_EOL;
        $this->buffer .= ' * Class ' . $this->tableName.'Model'. PHP_EOL;
        $this->buffer .= ' *' . PHP_EOL;
        $this->buffer .= ' * @category Model' . PHP_EOL;
        $this->buffer .= ' * @package  ' . $this->tableName. PHP_EOL;
        $this->addAuthor();
        $this->addLicense();
        $this->addLink();
        $this->buffer .= ' */' . PHP_EOL;
    }

    /** addAuthor
     *
     * @return void
     */
    protected function addAuthor()
    {
        if ( isset($this->author) ) {
            $this->buffer .= ' * @author   ' .$this->author. PHP_EOL;
        } else {
            $this->buffer .= ' * @author   ' . PHP_EOL;
        }
    }

    /** addLicense
     *
     * @return void
     */
    protected function addLicense()
    {
        if ( isset($this->license) ) {
            $this->buffer .= ' * @license  ' .$this->license. PHP_EOL;
        } else {
            $this->buffer .= ' * @license  ' . PHP_EOL;
        }

    }

    /** addLink
     * 
     * @return void
     */
    protected function addLink()
    {
        if ( isset($this->link) ) {
            $this->buffer .= ' * @link     ' . $this->link . $this->tableName.PHP_EOL;
        } else {
            $this->buffer .= ' * @link     ' . PHP_EOL;
        }
    }

    /** addAttributes
     *
     * @return bool
     */
    abstract protected function addAttributes();

    /** addAcceptableKeys
     *
     * @return void
     */
    abstract protected function addAcceptableKeys();

    /** addMethods
     *
     * @return bool
     */
    protected function addMethods()
    {
        $this->addInstance();
        $this->addFactory();
        $this->addSetValue();
        $this->addCheckValue();
        $this->addGet();
        $this->addUpdate();
        $this->addInsert();
        $this->addGetInsertId();
        $this->addValidate();
        $this->addPatch();
        $this->addDelete();
        $this->addCheckRequired();
        return true;
    }

    /** addInstance
     *
     * @return void
     */
    protected function addInstance()
    {
        $this->buffer .= '    ' . '/** instance' . PHP_EOL;
        $this->buffer .= '    ' . ' *' . PHP_EOL;
        $this->buffer .= '    ' . ' * @param resource $databaseConnection a valid database connection' . PHP_EOL;
        $this->buffer .= '    ' . ' *' . PHP_EOL;
        $this->buffer .= '    ' . ' * @return object' . PHP_EOL;
        $this->buffer .= '    ' . '*/' . PHP_EOL;
        $this->buffer .= '    ' . 'static public function instance($databaseConnection)' . PHP_EOL;
        $this->buffer .= '    ' . '{' . PHP_EOL;
        $this->buffer .= '    ' . '    if ( !isset(self::$'.$this->tableName.'Model) ) {' . PHP_EOL;
        $this->buffer .= '    ' . '        self::$'.$this->tableName.'Model = new '.$this->tableName.'Model($databaseConnection);' . PHP_EOL;
        $this->buffer .= '    ' . '    } else {' . PHP_EOL;
        $this->buffer .= '    ' . '        self::$'.$this->tableName.'Model->connection = $databaseConnection;' . PHP_EOL;
        $this->buffer .= '    ' . '    }' . PHP_EOL;
        $this->buffer .= '    ' . '    return self::$'.$this->tableName.'Model;'.PHP_EOL;
        $this->buffer .= '    ' . '}' . PHP_EOL . PHP_EOL;
    }

    /** addFactory
     *
     * @return void
     */
    protected function addFactory()
    {
        $this->buffer .= '    ' . '/** factory' . PHP_EOL;
        $this->buffer .= '    ' . ' *' . PHP_EOL;
        $this->buffer .= '    ' . ' * @param resource $databaseConnection a valid database connection' . PHP_EOL;
        $this->buffer .= '    ' . ' *' . PHP_EOL;
        $this->buffer .= '    ' . ' * @return object' . PHP_EOL;
        $this->buffer .= '    ' . '*/' . PHP_EOL;
        $this->buffer .= '    ' . 'static public function factory($databaseConnection)' . PHP_EOL;
        $this->buffer .= '    ' . '{' . PHP_EOL;
        $this->buffer .= '    ' . '        return new '.$this->tableName.'Model($databaseConnection);' . PHP_EOL;
        $this->buffer .= '    ' . '}' . PHP_EOL . PHP_EOL;
    }

    /** addSetValue
     *
     * @return void
     */
    abstract protected function addSetValue();

    /** addTypeCases
     *
     * @return bool
     */
    abstract protected function addTypeCases();

    /** explodeType
     *
     * @param string $type the variable type
     *
     * @return array
     */
    abstract protected function explodeType( $type );

    /** checkUnsigned
     *
     * @param string $type the variable type
     *
     * @return bool
     */
    protected function checkUnsigned( $type )
    {
        if ( substr_count($type, 'unsigned') ) {
            return true;
        } else {
            return false;
        }
    }

    /** addIndex
     *
     * @return void
     */
    abstract protected function addIndex();

    /** addGet
     *
     * @return void
     */
    abstract protected function addGet();

    /** addUpdate
     *
     * @return void
     */
    abstract protected function addUpdate();

    /** addUpdateArguments
     *
     * @return bool
     */
    abstract protected function addUpdateArguments();

    /** addInsert
     *
     * @return void
     */
    abstract protected function addInsert();

    /** addInsertArguments
     *
     * @return bool
     */
    abstract protected function addInsertArguments();

    /** addGetInsertId
     *
     * @return void
     */
    abstract protected function addGetInsertId();

    /** addPatch
     *
     * @return mixed
     */
    abstract protected function addPatch();

    /** addDelete
     *
     * @return mixed
     */
    abstract protected function addDelete();

    /** addValidate
     *
     * @return void
     */
    abstract protected function addValidate();


    /** addCheckRequired
     *
     * @return void
     */
    protected function addCheckRequired()
    {
        $this->buffer .= '    ' . '/** checkRequired' . PHP_EOL;
        $this->buffer .= '    ' . ' *' . PHP_EOL;
        $this->buffer .= '    ' . ' * @return bool' . PHP_EOL;
        $this->buffer .= '    ' . ' */' . PHP_EOL;
        $this->buffer .= '    ' . 'protected function checkRequired()' . PHP_EOL;
        $this->buffer .= '    ' . '{' . PHP_EOL;
        $this->buffer .= '    ' . '    try {' . PHP_EOL;
        $this->buffer .= '    ' . '        if ( CheckInput::checkNewInputArray(array(';
        $this->buffer .= $this->convertArrayToString($this->tableDescription->notNullArray) . ')) ) {' . PHP_EOL;
        $this->buffer .= '    ' . '        } else {' . PHP_EOL;
        $this->buffer .= '    ' . '            throw new ExceptionHandler(__METHOD__ . ": Required values are not all specified.");' . PHP_EOL;
        $this->buffer .= '    ' . '        }' . PHP_EOL;
        $this->buffer .= '    ' . '    } catch ( ExceptionHandler $e ) {' . PHP_EOL;
        $this->buffer .= '    ' . '        $e->execute();' . PHP_EOL;
        $this->buffer .= '    ' . '        return false;' . PHP_EOL;
        $this->buffer .= '    ' . '    }' . PHP_EOL;
        $this->buffer .= '    ' . '    return true;' . PHP_EOL;
        $this->buffer .= '    ' . '}' . PHP_EOL;
    }

    /** convertArrayToString
     *
     * @param array $arr the array to convert to string
     *
     * @return string
     */
    protected function convertArrayToString( $arr )
    {
        $str = "";
        foreach ( array_keys($arr) as $key ) {
            if ( $key === 'id' ) {
            } else {
                if ( $str === "" ) {
                    $str .= " '" . '$this->' . $key . "'";
                } else {
                    $str .= ", '" . '$this->' . $key . "'";
                }
            }
        }
        return $str;
    }

    /** addCheckValue
     *
     * @return void
     */
    protected function addCheckValue()
    {
        $this->buffer .= '    ' . '/** CheckValue' . PHP_EOL;
        $this->buffer .= '    ' . ' *' . PHP_EOL;
        $this->buffer .= '    ' . ' * @param string  $type  specifies the data type fully' . PHP_EOL;
        $this->buffer .= '    ' . ' * @param integer $max   specifies the maximum' . PHP_EOL;
        $this->buffer .= '    ' . ' * @param mixed   $value specifies the variable candidate' . PHP_EOL;
        $this->buffer .= '    ' . ' *' . PHP_EOL;
        $this->buffer .= '    ' . ' * @return bool' . PHP_EOL;
        $this->buffer .= '    ' . ' */' . PHP_EOL;
        $this->buffer .= '    ' . 'public function CheckValue( $type, $max, $value )' . PHP_EOL;
        $this->buffer .= '    ' . '{' . PHP_EOL;
        $this->buffer .= '    ' . '    try {' . PHP_EOL;
        $this->buffer .= '    ' . '        if ( CheckInput::checkSetArray(array($type, $max, $value)) ) {' . PHP_EOL;
        $this->buffer .= '    ' . '            switch ( $type ) {' . PHP_EOL;
        $this->addCaseByType();
        $this->buffer .= '    ' . '            default:' . PHP_EOL;
        $this->buffer .= '    ' . '                return false;' . PHP_EOL;
        $this->buffer .= '    ' . '                break;' . PHP_EOL;
        $this->buffer .= '    ' . '            }' . PHP_EOL;
        $this->buffer .= '    ' . '        } else {' . PHP_EOL;
        $this->buffer .= '    ' . '            throw new ExceptionHandler(__METHOD__.": All required variables must be provided.");' . PHP_EOL;
        $this->buffer .= '    ' . '        }' . PHP_EOL;
        $this->buffer .= '    ' . '    } catch ( ExceptionHandler $e ) {' . PHP_EOL;
        $this->buffer .= '    ' . '        $e->execute();' . PHP_EOL;
        $this->buffer .= '    ' . '        return false;' . PHP_EOL;
        $this->buffer .= '    ' . '    }' . PHP_EOL;
        //$this->buffer .= '    ' . '    return true;' . PHP_EOL;
        $this->buffer .= '    ' . '}' . PHP_EOL . PHP_EOL;
    }

    /** addCaseByType
     *
     * @return void
     */
    abstract protected function addCaseByType();


    /** endClass
     *
     * @return bool
     */
    protected function endClass()
    {
        $this->buffer .= '}' . PHP_EOL;
        return true;
    }

    /** writeCustomTemplate
     *
     * @return bool
     */
    protected function writeCustomTemplate()
    {
        try {
            $this->addCustomClass();
            if ( CheckInput::checkNewInput($this->buffer) ) {
                $this->helperHandle = new FileHandle(MODELS_HELPERS . strtolower($this->tableName) . ".php");
                $this->helperHandle->writeFull($this->buffer);
                $this->clearBuffer();
            } else {
                throw new ExceptionHandler(__METHOD__."The buffer is empty.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** addCustomClass
     *
     * @return void
     */
    protected function addCustomClass()
    {
        $this->buffer = '<?php ' . PHP_EOL;
        $this->buffer .= 'require_once MODELS_GENERATED."' . $this->tableName . '.php";' . PHP_EOL;
        $this->buffer .= '//require_once MODELS_HELPERS_INTERFACES."' . $this->tableName . 'CustomInterface.php";' . PHP_EOL;
        $this->buffer .= '/******************' . PHP_EOL;
        $this->buffer .= 'Class: ' . $this->tableName . "ModelCustom" . PHP_EOL;
        $this->buffer .= '******************/' . PHP_EOL;
        $this->buffer .= 'class ' . $this->tableName . 'ModelCustom' . PHP_EOL;
        $this->buffer .= '    extends ' . $this->tableName . 'Model' . PHP_EOL;
        $this->buffer .= '//    implements ' . $this->tableName . 'CustomInterface' . PHP_EOL;
        $this->buffer .= '{' . PHP_EOL;
        $this->buffer .= '    /*** Attributes: ***/' . PHP_EOL . PHP_EOL;
        $this->buffer .= '    /*** Functions: ***/' . PHP_EOL . PHP_EOL;
        $this->buffer .= '}' . PHP_EOL;
    }

    /** setupForNext
     *
     * @return void
     */
    protected function setupForNext()
    {
        $this->tableName     = null;
        $this->tableDescription = null;
        $this->FileHandle       = null;
        $this->helperHandle     = null;
    }
}