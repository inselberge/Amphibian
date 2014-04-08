<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Carl "Tex" Morgan
 * Date: 3/20/13
 * Time: 10:11 AM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once "interfaces".DIRECTORY_SEPARATOR."databaseConnectionInterface.php";
/**
 * Class DatabaseConnection
 *
 * @category Core
 * @package  Database
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/DatabaseConnection
 */
abstract class DatabaseConnection
    implements DatabaseConnectionInterface
{
    /**
     * @var resource connection a valid database connection
     */
    protected $connection;
    /**
     * @var string userName holds values for $DatabaseConnection->userName
     */
    protected $userName;
    /**
     * @var string userPassword holds values for $DatabaseConnection->userPassword
     */
    protected $userPassword;
    /**
     * @var string serverName holds values for $DatabaseConnection->serverName
     */
    protected $serverName;
    /**
     * @var string databaseName holds values for $DatabaseConnection->databaseName
     */
    protected $databaseName;
    /**
     * @var integer databasePort holds values for $DatabaseConnection->databasePort
     */
    protected $databasePort;
    /**
     * @var integer databaseSocket the database socket to use
     */
    protected $databaseSocket;
    /**
     * @var array error holds values for $DatabaseConnection->error
     */
    protected $error;

    /** __construct
     */
    abstract protected function __construct();

    /** set
     *
     * @param string $key   the index
     * @param mixed  $value the value of the key
     *
     * @return mixed
     */
    abstract public function set( $key, $value );

    /**   getConnection
     *
     * @return resource
     */
    public function getConnection()
    {
        return $this->connection;
    }


    /**  setDatabaseName
     *
     * @param string $databaseName
     *
     * @return boolean
     */
    public function setDatabaseName( $databaseName )
    {
        try {
            if ( CheckInput::checkNewInput($databaseName) ) {
                $this->databaseName = $databaseName;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": databaseName is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getDatabaseName
     *
     * @return string
     */
    public function getDatabaseName()
    {
        return $this->databaseName;
    }

    /**  setDatabasePort
     *
     * @param int $databasePort
     *
     * @return boolean
     */
    public function setDatabasePort( $databasePort )
    {
        try {
            if ( CheckInput::checkNewInput($databasePort) ) {
                $this->databasePort = $databasePort;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": databasePort is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getDatabasePort
     *
     * @return int
     */
    public function getDatabasePort()
    {
        return $this->databasePort;
    }

    /**  setDatabaseSocket
     *
     * @param int $databaseSocket
     *
     * @return boolean
     */
    public function setDatabaseSocket( $databaseSocket )
    {
        try {
            if ( CheckInput::checkNewInput($databaseSocket) ) {
                $this->databaseSocket = $databaseSocket;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": databaseSocket is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getDatabaseSocket
     *
     * @return int
     */
    public function getDatabaseSocket()
    {
        return $this->databaseSocket;
    }

    /**  setError
     *
     * @param array $error
     *
     * @return boolean
     */
    public function setError( $error )
    {
        try {
            if ( CheckInput::checkNewInput($error) ) {
                $this->error = $error;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": error is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getError
     *
     * @return array
     */
    public function getError()
    {
        return $this->error;
    }

    /**  setServerName
     *
     * @param string $serverName
     *
     * @return boolean
     */
    public function setServerName( $serverName )
    {
        try {
            if ( CheckInput::checkNewInput($serverName) ) {
                $this->serverName = $serverName;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": serverName is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getServerName
     *
     * @return string
     */
    public function getServerName()
    {
        return $this->serverName;
    }

    /**  setUserName
     *
     * @param string $userName
     *
     * @return boolean
     */
    public function setUserName( $userName )
    {
        try {
            if ( CheckInput::checkNewInput($userName) ) {
                $this->userName = $userName;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": userName is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getUserName
     *
     * @return string
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**  setUserPassword
     *
     * @param string $userPassword
     *
     * @return boolean
     */
    public function setUserPassword( $userPassword )
    {
        try {
            if ( CheckInput::checkNewInput($userPassword) ) {
                $this->userPassword = $userPassword;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": userPassword is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getUserPassword
     *
     * @return string
     */
    public function getUserPassword()
    {
        return $this->userPassword;
    }

    /** setOptions
     *
     * @param integer $option the option to use
     * @param mixed   $value  the value to set the option
     *
     * @return mixed
     */
    abstract public function setOptions( $option, $value );

    /** openConnection
     *
     * @return mixed
     */
    abstract public function openConnection();

    /** printHostInfo
     *
     * @return mixed
     */
    abstract public function printHostInfo();

    /** closeConnection
     *
     * @return mixed
     */
    abstract public function closeConnection();

    /** getTables
     *
     * @return mixed
     */
    abstract public function getTables();

    /** getPrimaryKeys
     *
     * @return mixed
     */
    abstract public function getPrimaryKeys();

    /** getViews
     *
     * @return mixed
     */
    abstract public function getViews();

    /** describeTable
     *
     * @param $table
     *
     * @return mixed
     */
    abstract public function describeTable($table);

    /** showKeysTable
     *
     * @param $table
     *
     * @return mixed
     */
    abstract public function showKeysTable($table);

    /** getPrimaryKeysTable
     *
     * @param $table
     *
     * @return mixed
     */
    abstract public function getPrimaryKeysTable($table);

    /** getForeignKeysTable
     *
     * @param $table
     *
     * @return mixed
     */
    abstract public function getForeignKeysTable($table);

    /** getRequiredColumnsList
     *
     * @param $tableDescription
     *
     * @return mixed
     */
    abstract public function getRequiredColumnsList($tableDescription);

    /** getColumnList
     *
     * @param $table
     *
     * @return mixed
     */
    abstract public function getColumnList($table);

    /** getAllColumnTypes
     *
     * @return mixed
     */
    abstract public function getAllColumnTypes();

}