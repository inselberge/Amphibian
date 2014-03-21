<?php
/**
 * PHP Version 5.5.3-1ubuntu2
 * Created by PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 11/12/13
 * Time: 10:45 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once "interfaces".DIRECTORY_SEPARATOR."DatabaseQuerySQLSRVInterface.php";
/**
 * Class DatabaseQuerySQLSRV
 *
 * @category 
 * @package  DatabaseQuerySQLSRV  
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/Amphibian/documentation/DatabaseQuerySQLSRV
 */
class DatabaseQuerySQLSRV
    extends databaseQuery
    implements DatabaseQuerySQLSRVInterface
{
    /**
     * @var array acceptableFetchTypes holds values for $DatabaseQuerySQLSRV->acceptableFetchTypes
     */
    static protected $acceptableFetchTypes = array(SQLSRV_FETCH_ASSOC, SQLSRV_FETCH_NUMERIC, SQLSRV_FETCH_BOTH);
    /**
     * @var array acceptableRowTypes holds values for $DatabaseQuerySQLSRV->acceptableRowTypes
     */
    static protected $acceptableRowTypes = array(SQLSRV_SCROLL_NEXT, SQLSRV_SCROLL_PRIOR, SQLSRV_SCROLL_FIRST, SQLSRV_SCROLL_LAST, SQLSRV_SCROLL_ABSOLUTE, SQLSRV_SCROLL_RELATIVE);
    /**
     * @var string statement holds values for $DatabaseQuerySQLSRV->statement
     */
    protected $statement;
    /**
     * @var mixed parameters holds values for $DatabaseQuerySQLSRV->parameters
     */
    protected $parameters;
    /**
     * @var mixed options holds values for $DatabaseQuerySQLSRV->options
     */
    protected $options;
    /**
     * @var int fetchType holds values for $DatabaseQuerySQLSRV->fetchType
     */
    protected $fetchType = SQLSRV_FETCH_BOTH;
    /**
     * @var int row holds values for $DatabaseQuerySQLSRV->row
     */
    protected $row = SQLSRV_SCROLL_RELATIVE;
    /**
     * @var int offset holds values for $DatabaseQuerySQLSRV->offset
     */
    protected $offset = 0;
    /**
     * @var object DatabaseQuerySQLSRV a singleton instances of this class
     */
    static public $DatabaseQuerySQLSRV;

    /** __construct
     *
     * @param resource $connection a valid database connection
     */
    protected function __construct($connection)
    {
        try {
            if ( CheckInput::checkNewInput($connection) ) {
                $this->databaseConnection = $connection;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": invalid connection.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** instance
     *
     * @param resource $connection a valid database connection
     *
     * @return DatabaseQuerySQLSRV|object
     */
    static public function instance($connection)
    {
        if ( !isset(self::$DatabaseQuerySQLSRV) ) {
            self::$DatabaseQuerySQLSRV = new DatabaseQuerySQLSRV($connection); 
        }
        return self::$DatabaseQuerySQLSRV;
    }

    /** factory
     *
     * @param resource $connection a valid database connection
     *
     * @return DatabaseQuerySQLSRV
     */
    static public function factory($connection)
    {
        return new DatabaseQuerySQLSRV($connection);
    }

    /** prepare
     * * @param $string
     * @return bool
     */
    public function prepare( $string )
    {
        try {
            if ( CheckInput::checkSet($string) ) {
                $this->statement = sqlsrv_prepare($this->databaseConnection, $string, $this->parameters, $this->options);
            } else {
                throw new ExceptionHandler(__METHOD__ . "Type a message.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** execute
     *
     * @param string $string a SQL query to execute
     *
     * @return bool
     */
    public function execute($string)
    {
        try {
            if ( CheckInput::checkNewInput($string) ) {
                $this->statement = sqlsrv_query($this->databaseConnection, $string, $this->parameters, $this->options);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": invalid query.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** executeQuery
     *
     * @return bool
     */
    protected function executeQuery()
    {

    }

    /** clean
     *
     * @param string $string the query string to clean
     *
     * @return mixed
     */
    protected function clean( $string )
    {

    }

    /** checkErrors
     *
     * @return bool
     */
    protected function checkErrors()
    {

    }

    /** handleErrors
     *
     * @return bool
     */
    protected function handleErrors()
    {

    }

    /** checkWarnings
     *
     * @return bool
     */
    protected function checkWarnings()
    {

    }

    /** handleWarnings
     *
     * @return bool
     */
    protected function handleWarnings()
    {

    }

    /** setNumberOfRows
     *
     * @return bool
     */
    protected function setNumberOfRows()
    {
        try {
            if ( CheckInput::checkSet($this->statement) ) {
                $this->numberOfRows = sqlsrv_num_rows($this->statement);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": invalid statement");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }


    /** setAffectedRows
     *
     * @return bool
     */
    protected function setAffectedRows()
    {
        try {
            if ( CheckInput::checkSet($this->statement) ) {
                $this->affectedRows = sqlsrv_rows_affected($this->statement);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": invalid statement.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setFieldCount
     *
     * @return bool
     */
    protected function setFieldCount()
    {
        try {
            if ( CheckInput::checkSet($this->statement) ) {
                $this->fieldCount = sqlsrv_num_fields($this->statement);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": invalid statement");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** commit
     *
     * @return bool
     */
    public function commit()
    {
        try {
            if ( CheckInput::checkSet($this->databaseConnection) ) {
                return sqlsrv_commit($this->databaseConnection);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": invalid connection.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** getArray
     *
     * @return mixed
     */
    public function getArray()
    {
        try {
            if ( CheckInput::checkSet($this->statement) ) {
                $this->resultArray = sqlsrv_fetch_array($this->statement, $this->fetchType, $this->row, $this->offset);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": invalid statement.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getRow
     *
     * @return mixed
     */
    public function getRow()
    {

    }

    /** free
     *
     * @return bool
     */
    public function free()
    {
        try {
            if ( CheckInput::checkSet($this->statement) ) {
                return sqlsrv_free_stmt($this->statement);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": invalid statement");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** checkMoreResults
     *
     * @return bool
     */
    protected function checkMoreResults()
    {

    }

    /** clearResults
     *
     * @return bool
     */
    protected function clearResults()
    {

    }

    /** rollback
     *
     * @return bool
     */
    public function rollback()
    {
        try {
            if ( CheckInput::checkSet($this->databaseConnection) ) {
                return sqlsrv_rollback($this->databaseConnection);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": invalid connection.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** sendStreamData
     *
     * @return bool
     */
    public function sendStreamData()
    {
        try {
            if ( CheckInput::checkSet($this->statement) ) {
                return sqlsrv_send_stream_data($this->statement);
            } else {
                throw new ExceptionHandler(__METHOD__ . "Type a message.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** cancel
     *
     * @return bool
     */
    public function cancel()
    {
        try {
            if ( CheckInput::checkSet($this->statement) ) {
                return sqlsrv_cancel($this->statement);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": invalid statement.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

} 