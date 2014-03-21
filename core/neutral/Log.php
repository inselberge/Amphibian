<?php
/**
 * PHP version 5.4.17
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 6/20/13
 * Time: 5:42 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."config.inc.php";
require_once "FileHandle.php";
require_once "CheckInput.php";
require_once "interfaces".DIRECTORY_SEPARATOR."LogInterface.php";
/**
 * Class Log
 *
 * @category Helper
 * @package  Core
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/Log
 */
class Log
    implements LogInterface
{
    /**
     * @var resource _FileHandle the file handle of the specific Log
     */
    private $_FileHandle;
    /**
     * @var string message the message to Log
     */
    protected $message;
    /**
     * @var string LogName the name of the Log
     */
    protected $LogName;
    /**
     * @var string LogType the type of Log
     */
    protected $LogType;
    /**
     * @var array _acceptableTypes
     */
    private static $_acceptableTypes
        = array("Email",
            "Error",
            "Malicious",
            "Virus",
            "Warning",
            "Database_Backup",
            "Database_Error",
            "Database_Query",
            "Database_Warning"
        );
    /**
     * @var object Log a singleton instance of this class
     */
    public static $Log;

    /** __construct
     *
     * @param string $msg the message to Log
     */
    protected function __construct($msg)
    {
        $this->message = $msg;
    }

    /** instance
     *
     * @param string $msg the message to Log
     *
     * @return Log|object
     */
    public static function instance($msg)
    {
        if ( !isset(self::$Log) ) {
            self::$Log = new Log($msg);
        } else {
            self::$Log->message = $msg;
        }
        return self::$Log;
    }

    /** setLogName
     *
     * @param string $LogName the name of the Log
     *
     * @return bool
     */
    public function setLogName( $LogName )
    {
        try {
            if ( CheckInput::checkNewInput($LogName) ) {
                $this->LogName = $LogName;
            } else {
                throw new ExceptionHandler(__METHOD__.":$LogName is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setLogType
     *
     * @param string $type the Log type to use
     *
     * @return bool
     */
    public function setLogType($type)
    {
        try {
            if ( $this->isTypeAcceptable($type) ) {
                $this->LogType=$type;
            } else {
                throw new ExceptionHandler(__METHOD__.":Unknown type.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** isTypeAcceptable
     *
     * @param string $type the Log type
     *
     * @return bool
     */
    protected function isTypeAcceptable($type)
    {
        return in_array($type, self::$_acceptableTypes);
    }

    /** execute
     *
     * @return bool
     */
    public function execute()
    {
        try {
            if (CheckInput::checkNewInput($this->LogType)) {
                if ( !isset($this->LogName) ) {
                    $this->LogName = date('Y-m-d_H:i:s').".".uniqid().".Log";
                }
                $this->iterate();

            } else {
                throw new ExceptionHandler("Log type must be set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** iterate
     *
     * @return void
     */
    protected function iterate()
    {
        $this->openLog();
        $this->writeLog();
        $this->closeLog();
    }

    /** openLog
     *
     * @return void
     */
    protected function openLog()
    {
        $this->_FileHandle = new FileHandle($this->buildFullName());
        $this->_FileHandle->setOpenOption("ab");
        $this->_FileHandle->open();
    }

    /** buildFullName
     *
     * @return string
     */
    protected function buildFullName()
    {
        return $this->getLogDirectory().$this->LogName;
    }

    /** getLogDirectory
     *
     * @return string
     */
    protected function getLogDirectory()
    {
        if ( $this->LogType == "Email" ) {
            return LOG_EMAIL;
        } elseif ($this->LogType == "Error") {
            return LOG_ERROR;
        } elseif ($this->LogType == "Malicious") {
            return LOG_MALICIOUS;
        } elseif ($this->LogType == "Virus") {
            return LOG_VIRUS;
        } elseif ($this->LogType == "Warning") {
            return LOG_WARNING;
        } elseif ($this->LogType == "Database_Backup") {
            return LOG_DATABASE_BACKUP;
        } elseif ($this->LogType == "Database_Error") {
            return LOG_DATABASE_ERROR;
        } elseif ($this->LogType == "Database_Query") {
            return LOG_DATABASE_QUERY;
        } elseif ($this->LogType == "Database_Warning") {
            return LOG_DATABASE_WARNING;
        } else {
            return false;
        }
    }

    /** writeLog
     *
     * @return void
     */
    protected function writeLog()
    {
        if ( isset($_SERVER["HTTP_COOKIE"]) ) {
            $this->_FileHandle->write(
                $_SERVER["HTTP_COOKIE"]."::"
                .$_SERVER["REQUEST_URI"]."::"
                .$this->message."\n"
            );
        } else {
            if ( isset($_SERVER["REQUEST_URI"]) ) {
                $this->_FileHandle->write(
                    $_SERVER["REQUEST_URI"]
                    ."::"
                    .$this->message."\n"
                );
            } else {
                $this->_FileHandle->write(
                    $_SERVER["PHP_SELF"]
                    ."::"
                    .$this->message."\n"
                );
            }
        }
    }

    /** closeLog
     *
     * @return void
     */
    protected function closeLog()
    {
        $this->_FileHandle->close();
    }
}
/*
 * $LogQuery = Log::instance("Some message blargh");
 * $LogQuery->setType("Database_Query");
 * $LogQuery->execute();
 */