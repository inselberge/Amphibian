<?php
/**
 * PHP Version 5.5.3-1ubuntu2
 * Created by PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 11/12/13
 * Time: 6:56 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once "interfaces".DIRECTORY_SEPARATOR."DatabaseConnectionSQLSRVInterface.php";
/**
 * Class DatabaseConnectionSQLSRV
 *
 * @category DatabaseConnection
 * @package  DatabaseConnectionSQLSRV  
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/Amphibian/documentation/DatabaseConnectionSQLSRV
 */
class DatabaseConnectionSQLSRV
    extends DatabaseConnection
    implements DatabaseConnectionSQLSRVInterface
{
    /**
     * @var array acceptableSettings the only acceptable settings for configuration
     */
    static protected $acceptableSettings=array("WarningsReturnAsErrors","LogSubsystems","LogSeverity");
    /**
     * @var array acceptableWarningFlags the only acceptable warning flag values
     */
    static protected $acceptableWarningFlags = array(
        true,
        false
    );
    /**
     * @var array acceptableSubSystemFlags the only acceptable subsystems flag values
     */
    static protected $acceptableSubSystemFlags = array(
        SQLSRV_LOG_SYSTEM_ALL,
        SQLSRV_LOG_SYSTEM_CONN,
        SQLSRV_LOG_SYSTEM_INIT,
        SQLSRV_LOG_SYSTEM_OFF,
        SQLSRV_LOG_SYSTEM_STMT,
        SQLSRV_LOG_SYSTEM_UTIL
    );
    /**
     * @var array acceptableSeverityFlags the only acceptable severity flag values
     */
    static protected $acceptableSeverityFlags = array(
        SQLSRV_LOG_SEVERITY_ALL,
        SQLSRV_LOG_SEVERITY_ERROR,
        SQLSRV_LOG_SEVERITY_WARNING,
        SQLSRV_LOG_SEVERITY_NOTICE
    );
    /**
     * @var array connectionInfo the specific information for the connection
     */
    protected $connectionInfo = array();
    /**
     * @var array acceptableConnectionInfoSettings the only acceptable fields for connectionInfo
     */
    static protected $acceptableConnectionInfoSettings = array(
        "APP",
        "ApplicationIntent",
        "AttachDBFileName",
        "CharacterSet",
        "ConnectionPooling",
        "Database",
        "Encrypt",
        "Failover_Partner",
        "LoginTimeout",
        "MultipleActiveResultSets",
        "MultiSubnetFailover",
        "PWD",
        "QuotedId",
        "ReturnDatesAsStrings",
        "Scrollable",
        "Server",
        "TraceFile",
        "TraceOn",
        "TransactionIsolation",
        "TrustServerCertificate",
        "UID",
        "WSID"
    );
    /**
     * @var string application holds values for $DatabaseConnectionSQLSRV->application
     */
    protected $application = "";
    /**
     * @var string applicationIntent holds values for $DatabaseConnectionSQLSRV->applicationIntent
     */
    protected $applicationIntent = "ReadWrite";
    /**
     * @var string attachDBFileName holds values for $DatabaseConnectionSQLSRV->attachDBFileName
     */
    protected $attachDBFileName = "";
    /**
     * @var string characterSet holds values for $DatabaseConnectionSQLSRV->characterSet
     */
    protected $characterSet = SQLSVR_ENC_CHAR;
    /**
     * @var boolean connectionPooling holds values for $DatabaseConnectionSQLSRV->connectionPooling
     */
    protected $connectionPooling = true;
    /**
     * @var boolean encrypt holds values for $DatabaseConnectionSQLSRV->encrypt
     */
    protected $encrypt = false;
    /**
     * @var string failoverPartner holds values for $DatabaseConnectionSQLSRV->failoverPartner
     */
    protected $failoverPartner = "";
    /**
     * @var integer loginTimeout holds values for $DatabaseConnectionSQLSRV->loginTimeout
     */
    protected $loginTimeout = 0;
    /**
     * @var boolean multipleActiveResultSets holds values for $DatabaseConnectionSQLSRV->multipleActiveResultSets
     */
    protected $multipleActiveResultSets = true;
    /**
     * @var string multiSubnetFailover holds values for $DatabaseConnectionSQLSRV->multiSubnetFailover
     */
    protected $multiSubnetFailover = "No";
    /**
     * @var boolean quotedId holds values for $DatabaseConnectionSQLSRV->quotedId
     */
    protected $quotedId = true;
    /**
     * @var bool returnDatesAsStrings holds values for $DatabaseConnectionSQLSRV->returnDatesAsStrings
     */
    protected $returnDatesAsStrings = false;
    /**
     * @var string scrollable holds values for $DatabaseConnectionSQLSRV->scrollable
     */
    protected $scrollable;
    /**
     * @var string traceFile holds values for $DatabaseConnectionSQLSRV->traceFile
     */
    protected $traceFile = "";
    /**
     * @var boolean traceOn holds values for $DatabaseConnectionSQLSRV->traceOn
     */
    protected $traceOn =false;
    /**
     * @var mixed transactionIsolation holds values for $DatabaseConnectionSQLSRV->transactionIsolation
     */
    protected $transactionIsolation = SQLSVR_TXN_READ_COMMITTED;
    /**
     * @var boolean trustServerCertificate holds values for $DatabaseConnectionSQLSRV->trustServerCertificate
     */
    protected $trustServerCertificate = false;
    /**
     * @var string workstationId holds values for $DatabaseConnectionSQLSRV->workstationId
     */
    protected $workstationId = "";

    /**
     * @var object DatabaseConnectionSQLSRV a singleton instances of this class
     */
    static public $DatabaseConnectionSQLSRV;
    
    /** __construct
     */
    protected function __construct()
    {
    
    }
    
    /** instance
     *
     * @return DatabaseConnectionSQLSRV
     */    
    static public function instance()
    {
        if ( !isset(self::$DatabaseConnectionSQLSRV) ) {
            self::$DatabaseConnectionSQLSRV = new DatabaseConnectionSQLSRV(); 
        }
        return self::$DatabaseConnectionSQLSRV;
    }
    
    /** factory
     *
     * @return DatabaseConnectionSQLSRV
     */    
    static public function factory()
    {
        return new DatabaseConnectionSQLSRV();
    }

    /** set
     *
     * @param $key
     * @param $value
     *
     * @return bool
     */
    public function set( $key, $value )
    {
        try {
            if (CheckInput::checkSet($key)) {
                $this->$$key = $value;
            } else {
                throw new exceptionHandler(__METHOD__ . ":some message.");
            }
        } catch (exceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setOptions
     *
     * @param int $option
     * @param mixed $value
     *
     * @return bool
     */
    public function setOptions( $option, $value )
    {
        try {
            if ( $this->checkValidOption($option) ) {
                if ( $this->forkOnOption($option, $value) ) {
                    return sqlsvr_configure($option, $value);
                } else {
                    throw new ExceptionHandler(__METHOD__ . ": invalid value.");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": option not available.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** checkValidOption
     *
     * @param $option
     *
     * @return bool
     */
    protected function checkValidOption( $option )
    {
        try {
            if ( CheckInput::checkNewInput($option) ) {
                return in_array($option, self::$acceptableSettings);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": invalid option.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** forkOnOption
     *
     * @param $option
     * @param $value
     *
     * @return bool
     */
    protected function forkOnOption($option, $value)
    {
        try {
            if ( $option === "WarningsReturnAsErrors" ) {
                return $this->checkValidWarningFlag($value);
            } elseif ( $option === "LogSubsystems" ) {
                return $this->checkValidSubSystemFlag($value);
            } elseif ( $option === "LogSeverity" ) {
                return $this->checkValidSeverityFlag($value);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": invalid fork.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** checkValidWarningFlag
     *
     * @param $value
     *
     * @return bool
     */
    protected function checkValidWarningFlag($value)
    {
        try {
            if ( CheckInput::checkNewInput($value) ) {
                return in_array($value, self::$acceptableWarningFlags);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": invalid value.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** checkValidSubSystemFlag
     *
     * @param $value
     *
     * @return bool
     */
    protected function checkValidSubSystemFlag($value)
    {
        try {
            if ( CheckInput::checkNewInput($value) ) {
                return in_array($value, self::$acceptableSubSystemFlags);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": invalid value.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** checkValidSeverityFlag
     *
     * @param $value
     *
     * @return bool
     */
    protected function checkValidSeverityFlag($value)
    {
        try {
            if ( CheckInput::checkNewInput($value) ) {
                return in_array($value, self::$acceptableSeverityFlags);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": invalid value.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /**  setApplication
     *
     * @param string $application
     *
     * @return boolean
     */
    public function setApplication( $application )
    {
        try {
            if ( CheckInput::checkNewInput($application) ) {
                $this->application = $application;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": application is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getApplication
     *
     * @return string
     */
    public function getApplication()
    {
        return $this->application;
    }

    /**  setApplicationIntent
     *
     * @param string $applicationIntent
     *
     * @return boolean
     */
    public function setApplicationIntent( $applicationIntent )
    {
        try {
            if ( CheckInput::checkNewInput($applicationIntent) ) {
                $this->applicationIntent = $applicationIntent;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": applicationIntent is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getApplicationIntent
     *
     * @return string
     */
    public function getApplicationIntent()
    {
        return $this->applicationIntent;
    }

    /**  setAttachDBFileName
     *
     * @param string $attachDBFileName
     *
     * @return boolean
     */
    public function setAttachDBFileName( $attachDBFileName )
    {
        try {
            if ( CheckInput::checkNewInput($attachDBFileName) ) {
                $this->attachDBFileName = $attachDBFileName;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": attachDBFileName is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getAttachDBFileName
     *
     * @return string
     */
    public function getAttachDBFileName()
    {
        return $this->attachDBFileName;
    }

    /**  setCharacterSet
     *
     * @param string $characterSet
     *
     * @return boolean
     */
    public function setCharacterSet( $characterSet )
    {
        try {
            if ( CheckInput::checkNewInput($characterSet) ) {
                $this->characterSet = $characterSet;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": characterSet is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getCharacterSet
     *
     * @return string
     */
    public function getCharacterSet()
    {
        return $this->characterSet;
    }

    /**  setConnectionPooling
     *
     * @param boolean $connectionPooling
     *
     * @return boolean
     */
    public function setConnectionPooling( $connectionPooling )
    {
        try {
            if ( CheckInput::checkNewInput($connectionPooling) ) {
                $this->connectionPooling = $connectionPooling;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": connectionPooling is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getConnectionPooling
     *
     * @return boolean
     */
    public function getConnectionPooling()
    {
        return $this->connectionPooling;
    }

    /**  setEncrypt
     *
     * @param boolean $encrypt
     *
     * @return boolean
     */
    public function setEncrypt( $encrypt )
    {
        try {
            if ( CheckInput::checkNewInput($encrypt) ) {
                $this->encrypt = $encrypt;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": encrypt is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getEncrypt
     *
     * @return boolean
     */
    public function getEncrypt()
    {
        return $this->encrypt;
    }

    /**  setFailoverPartner
     *
     * @param string $failoverPartner
     *
     * @return boolean
     */
    public function setFailoverPartner( $failoverPartner )
    {
        try {
            if ( CheckInput::checkNewInput($failoverPartner) ) {
                $this->failoverPartner = $failoverPartner;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": failoverPartner is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getFailoverPartner
     *
     * @return string
     */
    public function getFailoverPartner()
    {
        return $this->failoverPartner;
    }

    /**  setLoginTimeout
     *
     * @param int $loginTimeout
     *
     * @return boolean
     */
    public function setLoginTimeout( $loginTimeout )
    {
        try {
            if ( CheckInput::checkNewInput($loginTimeout) ) {
                $this->loginTimeout = $loginTimeout;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": loginTimeout is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getLoginTimeout
     *
     * @return int
     */
    public function getLoginTimeout()
    {
        return $this->loginTimeout;
    }

    /**  setMultiSubnetFailover
     *
     * @param string $multiSubnetFailover
     *
     * @return boolean
     */
    public function setMultiSubnetFailover( $multiSubnetFailover )
    {
        try {
            if ( CheckInput::checkNewInput($multiSubnetFailover) ) {
                $this->multiSubnetFailover = $multiSubnetFailover;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": multiSubnetFailover is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getMultiSubnetFailover
     *
     * @return string
     */
    public function getMultiSubnetFailover()
    {
        return $this->multiSubnetFailover;
    }

    /**  setMultipleActiveResultSets
     *
     * @param boolean $multipleActiveResultSets
     *
     * @return boolean
     */
    public function setMultipleActiveResultSets( $multipleActiveResultSets )
    {
        try {
            if ( CheckInput::checkNewInput($multipleActiveResultSets) ) {
                $this->multipleActiveResultSets = $multipleActiveResultSets;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": multipleActiveResultSets is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getMultipleActiveResultSets
     *
     * @return boolean
     */
    public function getMultipleActiveResultSets()
    {
        return $this->multipleActiveResultSets;
    }

    /**  setQuotedId
     *
     * @param boolean $quotedId
     *
     * @return boolean
     */
    public function setQuotedId( $quotedId )
    {
        try {
            if ( CheckInput::checkNewInput($quotedId) ) {
                $this->quotedId = $quotedId;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": quotedId is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getQuotedId
     *
     * @return boolean
     */
    public function getQuotedId()
    {
        return $this->quotedId;
    }

    /**  setReturnDatesAsStrings
     *
     * @param boolean $returnDatesAsStrings
     *
     * @return boolean
     */
    public function setReturnDatesAsStrings( $returnDatesAsStrings )
    {
        try {
            if ( CheckInput::checkNewInput($returnDatesAsStrings) ) {
                $this->returnDatesAsStrings = $returnDatesAsStrings;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": returnDatesAsStrings is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getReturnDatesAsStrings
     *
     * @return boolean
     */
    public function getReturnDatesAsStrings()
    {
        return $this->returnDatesAsStrings;
    }

    /**  setScrollable
     *
     * @param string $scrollable
     *
     * @return boolean
     */
    public function setScrollable( $scrollable )
    {
        try {
            if ( CheckInput::checkNewInput($scrollable) ) {
                $this->scrollable = $scrollable;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": scrollable is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getScrollable
     *
     * @return string
     */
    public function getScrollable()
    {
        return $this->scrollable;
    }

    /**  setTraceFile
     *
     * @param string $traceFile
     *
     * @return boolean
     */
    public function setTraceFile( $traceFile )
    {
        try {
            if ( CheckInput::checkNewInput($traceFile) ) {
                $this->traceFile = $traceFile;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": traceFile is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getTraceFile
     * @return string
     */
    public function getTraceFile()
    {
        return $this->traceFile;
    }

    /**  setTransactionIsolation
     *
     * @param mixed $transactionIsolation
     *
     * @return boolean
     */
    public function setTransactionIsolation( $transactionIsolation )
    {
        try {
            if ( CheckInput::checkNewInputArray($transactionIsolation) ) {
                $this->transactionIsolation[] = $transactionIsolation;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": transactionIsolation is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getTransactionIsolation
     *
     * @return mixed
     */
    public function getTransactionIsolation()
    {
        return $this->transactionIsolation;
    }

    /**  setTraceOn
     *
     * @param boolean $traceOn
     *
     * @return boolean
     */
    public function setTraceOn( $traceOn )
    {
        try {
            if ( CheckInput::checkNewInput($traceOn) ) {
                $this->traceOn = $traceOn;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": traceOn is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getTraceOn
     *
     * @return boolean
     */
    public function getTraceOn()
    {
        return $this->traceOn;
    }

    /**  setTrustServerCertificate
     *
     * @param boolean $trustServerCertificate
     *
     * @return boolean
     */
    public function setTrustServerCertificate( $trustServerCertificate )
    {
        try {
            if ( CheckInput::checkNewInput($trustServerCertificate) ) {
                $this->trustServerCertificate = $trustServerCertificate;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": trustServerCertificate is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getTrustServerCertificate
     *
     * @return boolean
     */
    public function getTrustServerCertificate()
    {
        return $this->trustServerCertificate;
    }

    /**  setWorkstationId
     *
     * @param string $workstationId
     *
     * @return boolean
     */
    public function setWorkstationId( $workstationId )
    {
        try {
            if ( CheckInput::checkNewInput($workstationId) ) {
                $this->workstationId = $workstationId;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": workstationId is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getWorkstationId
     *
     * @return string
     */
    public function getWorkstationId()
    {
        return $this->workstationId;
    }

    /** openConnection
     *
     * @return bool
     */
    public function openConnection()
    {
        try {
            if ( CheckInput::checkSet($this->serverName) ) {
                $this->packageConnectionInfo();
                $this->connection = sqlsrv_connect($this->serverName, $this->connectionInfo);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": invalid server name.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** packageConnectionInfo
     *
     * @return bool
     */
    protected function packageConnectionInfo()
    {
        try {
            if ( CheckInput::checkSet($this->connectionInfo) ) {
                $this->connectionInfo["APP"] = $this->application;
                $this->connectionInfo["ApplicationIntent"] = $this->applicationIntent;
                $this->connectionInfo["AttachDBFileName"] = $this->attachDBFileName;
                $this->connectionInfo["CharacterSet"] = $this->characterSet;
                $this->connectionInfo["ConnectionPooling"] = $this->connectionPooling;
                $this->connectionInfo["Database"] = $this->databaseName;
                $this->connectionInfo["Encrypt"] = $this->encrypt;
                $this->connectionInfo["Failover_Partner"] = $this->failoverPartner;
                $this->connectionInfo["LoginTimeout"] = $this->loginTimeout;
                $this->connectionInfo["MultipleActiveResultSets"] = $this->multipleActiveResultSets;
                $this->connectionInfo["MultiSubnetFailover"] = $this->multiSubnetFailover;
                $this->connectionInfo["PWD"] = $this->userPassword;
                $this->connectionInfo["QuotedId"] = $this->quotedId;
                $this->connectionInfo["ReturnDatesAsStrings"] = $this->returnDatesAsStrings;
                $this->connectionInfo["Scrollable"] = $this->scrollable;
                $this->connectionInfo["Server"] = $this->serverName;
                $this->connectionInfo["TraceFile"] = $this->traceFile;
                $this->connectionInfo["TraceOn"] = $this->traceOn;
                $this->connectionInfo["TransactionIsolation"] = $this->transactionIsolation;
                $this->connectionInfo["TrustServerCertificate"] = $this->trustServerCertificate;
                $this->connectionInfo["UID"] = $this->userName;
                $this->connectionInfo["WSID"] = $this->workstationId;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": connection info uninitialized.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** printClientInfo
     *
     * @return array|bool|null
     */
    public function printClientInfo()
    {
        try {
            if ( CheckInput::checkSet($this->connection) ) {
                return sqlsrv_client_info($this->connection);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": invalid connection");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** printHostInfo
     *
     * @return array|bool
     */
    public function printHostInfo()
    {
        try {
            if ( CheckInput::checkSet($this->connection) ) {
                return sqlsrv_server_info($this->connection);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": invalid connection");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** closeConnection
     *
     * @return boolean
     */
    public function closeConnection()
    {
        return sqlsrv_close($this->connection);
    }

} 