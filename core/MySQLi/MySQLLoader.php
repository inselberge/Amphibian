<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Carl "Tex" Morgan
 * Date: 2/20/13
 * Time: 2:23 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."config.inc.php";
require_once AMPHIBIAN_CORE_NEUTRAL ."FileList.php";
require_once AMPHIBIAN_CORE_NEUTRAL ."CheckInput.php";
////require_once MYSQL; todo: replace these with correct databaseConnectionMySQLi calls
require_once "interfaces".DIRECTORY_SEPARATOR."MySQLLoaderInterface.php";

/**
 * Class MySQLLoader
 *
 * @category Core
 * @package  Core
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/MySQLLoader
 */
class MySQLLoader
    implements MySQLLoaderInterface
{
    /**
     * @var string directory
     */
    public $directory;
    /**
     * @var string _command
     */
    private $_command;
    /**
     * @var string _fileName
     */
    private $_fileName;
    /**
     * @var array _fileList
     */
    private $_fileList;
    /**
     * @var integer _databaseStatus
     */
    private $_databaseStatus;
    /**
     * @var integer _status
     */
    private $_status;

    /**
     *
     */
    public function __construct()
    {
    }

    /** setFileName
     * 
     * @param $name
     * 
     * @return bool
     */
    public function setFileName( $name )
    {
        try {
            if ( CheckInput::checkNewInput($name) ) {
                $this->_fileName = $name;
            } else {
                throw new ExceptionHandler(__METHOD__.":Unable to set new file name.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setDirectory
     * 
     * @param $name
     * 
     * @return bool
     */
    public function setDirectory( $name )
    {
        try {
            if ( CheckInput::checkNewInput($name) ) {
                $this->directory = $name;
                return true;
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** checkDirectorySlash
     * 
     * @return bool
     */
    private function checkDirectorySlash()
    {
        if ( substr($this->directory, -1) === "/" ) {
            return true;
        } else {
            return false;
        }
    }

    /** execute
     * 
     * @return bool
     */
    public function execute()
    {
        try {
            $this->_databaseStatus = $this->checkDatabaseVariables();
            if ( isset($this->_fileName) ) {
                $this->iteration();
            } elseif ( isset($this->directory) ) {
                $this->setupFileList();
                if ( $this->_fileList->printCount() > 0 ) {
                    $this->setNextFile();
                    while ( $this->_fileName ) {
                        $this->iteration();
                        $this->setNextFile();
                    }
                } else {
                    throw new ExceptionHandler(__METHOD__.":There was a problem getting the file list.");
                }
            } else {
                throw new ExceptionHandler(__METHOD__.":Neither the directory or file handle are set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setupFileList
     * 
     * @return bool
     */
    private function setupFileList()
    {
        try {
            $this->_fileList = FileList::instance($this->directory);
            if ( CheckInput::checkNewInput($this->_fileList) ) {
                $this->_fileList->execute();
            } else {
                throw new ExceptionHandler(__METHOD__.":File list is not set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setNextFile
     * 
     * @return bool
     */
    private function setNextFile()
    {
        try {
            $this->_fileName = $this->_fileList->printFileName();
            if ( $this->_fileName ) {
                if ( strstr($this->_fileName, $this->directory) ) {
                } else {
                    if ( $this->checkDirectorySlash() ) {
                        $this->setFileName($this->directory . $this->_fileName);
                    } else {
                        $this->setFileName($this->directory . DIRECTORY_SEPARATOR . $this->_fileName);
                    }
                }
            } else {
                //    throw new ExceptionHandler(__METHOD__.":No file.");
                return false;
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** iteration
     * 
     * @return bool
     */
    private function iteration()
    {
        try {
            if ( $this->buildCommand() ) {
                $this->executeCommand();
                if ( $this->_status === "" ) {
                    $this->printLoadFinished();
                } else {
                    throw new ExceptionHandler(__METHOD__.":Command failed.");
                }
            } else {
                throw new ExceptionHandler(__METHOD__.":Bailing out - no command.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** buildCommand
     * 
     * @return bool
     */
    protected function buildCommand()
    {
        try {
            if ( $this->_databaseStatus ) {
                $this->_command = "mysql ";
                $this->_command .= "--user=" . DB_USER . " ";
                $this->_command .= "--host=" . DB_HOST . " ";
                $this->_command .= " --password='" . DB_PASSWORD . "' ";
                $this->_command .= DB_NAME;
                $this->_command .= " < " . $this->_fileName;
            } else {
                throw new ExceptionHandler(__METHOD__.":There was a problem with the database variables.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkDatabaseVariables
     * 
     * @return bool
     */
    protected function checkDatabaseVariables()
    {
        try {
            if ( CheckInput::checkNewInput(DB_HOST) ) {
                if ( CheckInput::checkNewInput(DB_NAME) ) {
                    if ( CheckInput::checkNewInput(DB_PASSWORD) ) {
                        if ( CheckInput::checkNewInput(DB_USER) ) {
                        } else {
                            throw new ExceptionHandler(__METHOD__.":Database user is not defined.");
                        }
                    } else {
                        throw new ExceptionHandler(__METHOD__.":Database password is not defined.");
                    }
                } else {
                    throw new ExceptionHandler(__METHOD__.":Database name is not defined.");
                }
            } else {
                throw new ExceptionHandler(__METHOD__.":Database host is not defined.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** executeCommand
     * 
     * @return bool
     */
    protected function executeCommand()
    {
        try {
            if ( CheckInput::checkNewInput($this->_command) ) {
                $this->_status = exec($this->_command);
            } else {
                throw new ExceptionHandler(__METHOD__.": command invalid.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** printLoadFinished
     * 
     */
    private function printLoadFinished()
    {
        echo utf8_encode(
            date('Y-m-d H:i:s') .
            " " . __CLASS__ .
            "::" . __FUNCTION__ .
            ": " . $this->_fileName .
            " load finished successfully." . PHP_EOL
        );
        $this->_resetForNext();
    }

    /** _resetForNext
     * 
     */
    private function _resetForNext()
    {
        unset($this->_status);
        unset($this->_fileName);
    }
}

/*
 * Load just the getActiveDisplay stored procedure
$myLoad = new MySQLLoader($databaseConnection);
$myLoad ->setFileName(SPROCS."getActiveDisplay.sql");
$myLoad->execute();
*/
/*
 * All the mysql stored procedures load
$myLoad = new MySQLLoader($databaseConnection);
$myLoad->setDirectory(DATABASE_STORED_PROCEDURES);
//print_r($this);
$myLoad->execute();
*/
/*
 * All the mysql views load
$myLoad = new MySQLLoader($databaseConnection);
$myLoad->setDirectory(DATABASE_VIEWS);
//print_r($this);
$myLoad->execute();
*/