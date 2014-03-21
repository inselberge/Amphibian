<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Carl "Tex" Morgan
 * Date: 4/1/13
 * Time: 1:08 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once AMPHIBIAN_CORE_NEUTRAL ."CheckInput.php";
require_once AMPHIBIAN_CORE_NEUTRAL ."Log.php";
require_once "interfaces".DIRECTORY_SEPARATOR."databaseQueryInterface.php";
/**
 * Class databaseQuery
 *
 * @category Core
 * @package  Database
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/databaseQuery
 */
abstract class databaseQuery
    extends CheckInput
    implements databaseQueryInterface
{
    /**
     * @var string query the database query to run
     */
    protected $query;
    /**
     * @var integer numberOfRows the number of rows returned
     */
    protected $numberOfRows;
    /**
     * @var integer affectedRows the number of rows affected
     */
    protected $affectedRows;
    /**
     * @var integer fieldCount the number of fields in a row
     */
    protected $fieldCount;
    /**
     * @var resource resultSet the result set returned by the query
     */
    protected $resultSet;
    /**
     * @var array errors an array of the errors
     */
    protected $errors;
    /**
     * @var integer warningCount the number of warnings
     */
    protected $warningCount;
    /**
     * @var array warnings an array of warnings
     */
    protected $warnings;
    /**
     * @var resource databaseConnection the active connection
     */
    protected $databaseConnection;
    /**
     * @var array resultArray an array with all the rows
     */
    public $resultArray;
    /**
     * @var array row an array of one database row
     */
    public $row;
    /**
     * @var object log the log to use
     */
    protected $log;

    /** __construct
     *
     * @param resource $databaseConnection an active database connection
     */
    abstract protected function __construct( $databaseConnection );

    /** execute
     *
     * @param string $string the query string to run
     *
     * @return bool
     */
    abstract public function execute( $string );

    public function init()
    {
        $this->query = "";
        $this->numberOfRows = 0;
        $this->affectedRows = 0;
        $this->fieldCount = 0;
        $this->resultSet = null;
        $this->errors = array();
        $this->warningCount = 0;
        $this->warnings = array();
        $this->resultArray = array();
        $this->row = array();
    }

    /** executeQuery
     *
     * @return bool
     */
    abstract protected function executeQuery();

    /** clean
     *
     * @param string $string the query string to clean
     *
     * @return mixed
     */
    abstract protected function clean( $string );

    /** checkErrors
     *
     * @return bool
     */
    abstract protected function checkErrors();

    /** handleErrors
     *
     * @return bool
     */
    abstract protected function handleErrors();

    /** checkWarnings
     *
     * @return bool
     */
    abstract protected function checkWarnings();

    /** handleWarnings
     *
     * @return bool
     */
    abstract protected function handleWarnings();

    /** setNumberOfRows
     *
     * @return bool
     */
    abstract protected function setNumberOfRows();

    /** setAffectedRows
     *
     * @return bool
     */
    abstract protected function setAffectedRows();

    /** setFieldCount
     *
     * @return bool
     */
    abstract protected function setFieldCount();

    /** commit
     *
     * @return bool
     */
    abstract public function commit();

    /** getArray
     *
     * @return mixed
     */
    abstract public function getArray();

    /** getRow
     *
     * @return mixed
     */
    abstract public function getRow();

    /** free
     *
     * @return bool
     */
    abstract public function free();

    /** checkMoreResults
     *
     * @return bool
     */
    abstract protected function checkMoreResults();

    /** clearResults
     *
     * @return bool
     */
    abstract protected function clearResults();

    /** show
     *
     * @return void
     */
    public function show()
    {
        print_r($this);
    }

    /** printRow
     *
     * @return void
     */
    public function printRow()
    {
        echo $this->row;
    }

    /** printNumberOfRows
     *
     * @return void
     */
    public function printNumberOfRows()
    {
        echo $this->numberOfRows;
    }

    /** printAffectedRows
     *
     * @return void
     */
    public function printAffectedRows()
    {
        echo $this->affectedRows;
    }

    /** printFieldCount
     *
     * @return void
     */
    public function printFieldCount()
    {
        echo $this->fieldCount;
    }

    /** printArray
     *
     * @return void
     */
    public function printArray()
    {
        print_r($this->resultArray);
    }

    /** printErrors
     *
     * @return void
     */
    public function printErrors()
    {
        print_r($this->errors);
    }

    /** printWarnings
     *
     * @return void
     */
    public function printWarnings()
    {
        print_r($this->warnings);
    }

    /** getAffectedRows
     *
     * @return int
     */
    public function getAffectedRows()
    {
        return $this->affectedRows;
    }

    /** getErrors
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /** getFieldCount
     *
     * @return int
     */
    public function getFieldCount()
    {
        return $this->fieldCount;
    }

    /** getNumberOfRows
     *
     * @return int
     */
    public function getNumberOfRows()
    {
        return $this->numberOfRows;
    }

    /** getWarnings
     *
     * @return array
     */
    public function getWarnings()
    {
        return $this->warnings;
    }


    /** getWarningCount
     *
     * @return int
     */
    public function getWarningCount()
    {
        return $this->warningCount;
    }

    /** initErrors
     *
     * @return void
     */
    protected function initErrors()
    {
        $this->errors = array();
    }

    /** setQuery
     *
     * @param string $query the query string to run
     *
     * @return bool
     */
    protected function setQuery($query)
    {
        try {
            if ( CheckInput::checkNewInput($query) ) {
                $this->query=$query;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": Input a database query.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkQuery
     *
     * @return bool
     */
    protected function checkQuery()
    {
        try {
            if (! CheckInput::checkNewInput($this->query) ) {
                throw new ExceptionHandler(__METHOD__ . ": checkQuery failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkAffected
     *
     * @return bool
     */
    public function checkAffected()
    {
        try {
            if ( $this->affectedRows <= 0 ) {
                throw new ExceptionHandler(__METHOD__ . ": checkAffected failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** logQuery
     *
     * @param string $msg the message to log
     *
     * @return bool
     */
    protected function logQuery($msg)
    {
        try {
            if ( isset($msg) ) {
                $this->log = Log::instance($msg);
                if ( $this->changeLogType("Database_Query") ) {
                    $this->executeLog();
                }
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** logError
     *
     * @param string $msg the message to log
     *
     * @return bool
     */
    protected function logError($msg)
    {
        try {
            if ( isset($msg) ) {
                $this->log = Log::instance(print_r($msg));
                if ( $this->changeLogType("Database_Error") ) {
                    $this->executeLog();
                }
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** logWarning
     *
     * @param string $msg the message to log
     *
     * @return bool
     */
    protected function logWarning($msg)
    {
        try {
            if ( isset($msg) ) {
                $this->log = Log::instance(print_r($msg));
                if ( $this->changeLogType("Database_Warning") ) {
                    $this->executeLog();
                }
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** changeLogType
     *
     * @param string $type the type of log
     *
     * @return bool
     */
    protected function changeLogType($type)
    {
        try {
            if ( !$this->log->setLogType($type) ) {
                throw new ExceptionHandler(__METHOD__ . ": changeLogType failed");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** executeLog
     *
     * @return bool
     */
    protected function executeLog()
    {
        try {
            if ( !$this->log->execute() ) {
                throw new ExceptionHandler(__METHOD__ . "Failed to execute log.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }
}