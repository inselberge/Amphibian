<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Carl "Tex" Morgan
 * Date: 2/15/13
 * Time: 3:25 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once "interfaces".DIRECTORY_SEPARATOR."FileHandleInterface.php";
require_once "CheckInput.php";
/**
 * Class FileHandle
 *
 * @category Helper
 * @package  Core
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/FileHandle
 */
class FileHandle
    implements FileHandleInterface
{
    /**
     * @var bool _operationSuccessful true = yes, false = no
     */
    private $_operationSuccessful;
    /**
     * @var bool _optionAllowed holds values for $FileHandle->_optionAllowed
     */
    private $_optionAllowed;
    /**
     * @var bool _fileExists holds values for $FileHandle->_fileExists
     */
    private $_fileExists;
    /**
     * @var resource _handle the actual file handle
     */
    private $_handle;
    /**
     * @var string string a string to write or read
     */
    public $string;
    /**
     * @var string file the file name
     */
    public $file;
    /**
     * @var string openOption the options to use when opening the file
     */
    public $openOption;
    /**
     * @var object FileHandle a singleton instance of this class
     */
    static protected $FileHandle;

    /** __construct
     * 
     * @param string $fileName the name of the file
     */
    public function __construct( $fileName )
    {
        try {
            if ( CheckInput::checkNewInput($fileName) ) {
                $this->file = $fileName;
                if ( $this->checkExists() ) {
                    $this->_fileExists = true;
                    if ( $this->checkIsFile() == false ) {
                        if ( $this->checkIsDirectory() ) {
                            throw new ExceptionHandler(__METHOD__ . ": directory given.");
                        } else {
                            throw new ExceptionHandler(__METHOD__ . ": irregular file.");
                        }                        
                    }
                    return true;
                } else {
                    $this->_fileExists = false;
                    return true;
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": invalid file name.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** instance
     * 
     * @param string $fileName the name of the file
     * 
     * @return bool|FileHandle
     */
    static public function instance( $fileName )
    {
        if ( !isset(self::$FileHandle) ) {
            self::$FileHandle = new FileHandle($fileName);
        }
        return self::$FileHandle;
    }

    /** checkIsFile
     * 
     * @return bool
     */
    protected function checkIsFile()
    {
        /*
         * TODO: generators/core/FileHandle.php:78: Medium: is_file
            A potential TOCTOU (Time Of Check, Time Of Use) vulnerability exists.
            This is the first line where a check has occurred.
            The following line(s) contain uses that may match up with this check:
            383 (fopen)
         */
        if ( is_file($this->file) ) {
            return true;
        } else {
            return false;
        }
    }

    /** checkIsDirectory
     * 
     * @return bool
     */
    protected function checkIsDirectory()
    {
        if ( is_dir($this->file) ) {
            return true;
        } else {
            return false;
        }
    }

    /** setOpenOption
     * 
     * @param mixed $openOption the option to open the file with
     * 
     * @return bool
     */
    public function setOpenOption( $openOption )
    {
        try {
            if ( CheckInput::checkNewInput($openOption) ) {
                $this->openOption = $openOption;
                $this->checkOptionSet();
            } else {
                throw new ExceptionHandler(__METHOD__ . ":$openOption is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkOptionSet
     * 
     * @return bool
     * 
     * @throws Exception
     */
    protected function checkOptionSet()
    {
        if ( isset($this->openOption) ) {
            if ( !is_null($this->openOption) ) {
                try {
                    $this->checkOptionAllowed();
                } catch ( ExceptionHandler $e ) {
                    $e->execute();
                    return false;
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": the file option is set to null.");
            }
        } else {
            throw new ExceptionHandler(__METHOD__ . ": the file open option is not set.");
        }
        return true;
    }

    /** checkOptionAllowed
     * 
     * @return bool
     */
    protected function checkOptionAllowed()
    {
        try {
            $this->_optionAllowed = preg_match(
                "/([r(+)?])?([w(+)?])?([a(+)?])?([x(+)?])?([c(+)?])?(b)?/", 
                $this->openOption
            );
            if ( $this->_optionAllowed === 1 ) {
            } elseif ( $this->_optionAllowed === 0 ) {
                throw new ExceptionHandler(__METHOD__ . ": open option is not allowed.");
            } else {
                throw new ExceptionHandler(__METHOD__ . ": checkOptionAllowed failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkFileSet
     * 
     * @return bool
     * 
     * @throws Exception
     */
    protected function checkFileSet()
    {
        if ( isset($this->file) ) {
            if ( !is_null($this->file) ) {
                return true;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": the file name is set to null.");
            }
        } else {
            throw new ExceptionHandler(__METHOD__ . ": the file name is not set.");
        }
    }

    /** checkWrite
     *
     * @return bool
     */
    protected function checkWrite()
    {
        if ( is_writable($this->file) ) {
            return true;
        } else {
            return false;
        }
    }

    /** checkRead
     *
     * @return bool
     */
    protected function checkRead()
    {
        if ( is_readable($this->file) ) {
            return true;
        } else {
            return false;
        }
    }

    /** checkExecute
     *
     * @return bool
     */
    protected function checkExecute()
    {
        if ( is_executable($this->file) ) {
            return true;
        } else {
            return false;
        }
    }

    /** checkExists
     *
     * @return bool
     */
    protected function checkExists()
    {
        return file_exists($this->file);
    }

    /** write
     *
     * @param string $string a string to write to the file
     *
     * @return bool
     */
    public function write( $string )
    {
        try {
            $this->string = $string;
            if ( $this->checkString() ) {
                $this->_operationSuccessful = fwrite($this->_handle, $this->string);
                if ( !$this->_operationSuccessful ) {
                    throw new ExceptionHandler(__METHOD__ . ": write failed.");
                }
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** writeFull
     * 
     * @param string $string the string to write
     * 
     * @return bool
     */
    public function writeFull( $string )
    {
        try {
            if ( CheckInput::checkNewInput($string) ) {
                $this->string = $string;
            }
            if ( $this->checkFileSet() AND $this->checkString() ) {
                if ( $this->_fileExists ) {
                    if ( $this->checkWrite() ) {
                        $this->_operationSuccessful
                            = file_put_contents($this->file, $this->string);
                    } else {
                        throw new ExceptionHandler(__METHOD__ . ": write disabled.");
                    }
                } else {
                    $this->_operationSuccessful
                        = file_put_contents($this->file, $this->string, FILE_APPEND);
                }
                if ( $this->_operationSuccessful == false ) {
                    throw new ExceptionHandler(__METHOD__ . ": writeFull failed.");
                } else {
                    $this->string               = $this->_operationSuccessful;
                    $this->_operationSuccessful = true;
                }
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkString
     * 
     * @return bool     
     */
    protected function checkString()
    {
        try {
            if ( isset($this->string) ) {
                if ( is_null($this->string) ) {
                    throw new ExceptionHandler(__METHOD__ . ": string is null.");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": string is not set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** read
     * 
     * @return bool
     */
    public function read()
    {
        try {
            $this->_operationSuccessful = fgets($this->_handle);
            if ( $this->_operationSuccessful ) {
                $this->string = $this->_operationSuccessful;
            } else {
                $this->string = false;
                throw new ExceptionHandler(__METHOD__ . ": read failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** readClean
     * 
     * @return bool
     */
    public function readClean()
    {
        try {
            $this->_operationSuccessful = fgetss($this->_handle);
            if ( $this->_operationSuccessful ) {
                $this->string = $this->_operationSuccessful;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": readClean failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** readFull
     * 
     * @return bool
     */
    public function readFull()
    {
        try {
            if ( $this->checkFileSet() ) {
                if ( !$this->_fileExists ) {
                    throw new ExceptionHandler(__METHOD__ . ": $this->file does not exist.");
                } elseif ( $this->checkRead() ) {
                    $this->_operationSuccessful = file_get_contents($this->file);
                    if ( $this->_operationSuccessful == false ) {
                        throw new ExceptionHandler(__METHOD__ . ": there was a problem reading $this->file into a string.");
                    } else {
                        $this->string               = $this->_operationSuccessful;
                        $this->_operationSuccessful = true;
                    }
                } else {
                    throw new ExceptionHandler(__METHOD__ . ": $this->file is not readable.");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": $this->file is not set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** open
     * 
     * @return bool
     */
    public function open()
    {
        try {
            $this->_handle = fopen($this->file, $this->openOption);
            if ( !is_resource($this->_handle) ) {
                throw new ExceptionHandler(__METHOD__ . ": open failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** close
     * 
     * @return bool
     */
    public function close()
    {
        return fclose($this->_handle);
    }
}

/*
 * File example
 *
$fh = new file_handle("/home/carl/Public/html5/mysql/generated_views/test/test1.sql");
$fh->readFull();
*/

/*
 * File Write Example

$fh = FileHandle::instance("/home/carl/Public/html5/database/generated_sprocs/blargh.sql");
$fh->writeFull("BKAFDHKLSGHKL"."\n");
*/