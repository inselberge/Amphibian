<?php
/**
 * PHP Version: ${PHP_VERSION}
 * Created by PhpStorm.
 * User: carl
 * Date: 1/16/14
 * Time: 5:07 PM
 */
require_once __DIR__ . DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."config.inc.php";
require_once "interfaces".DIRECTORY_SEPARATOR."DatabaseBackupMySQLiInterface.php";
require_once AMPHIBIAN_GENERATORS_ABSTRACT."DatabaseBackup.php";
/**
 * Class DatabaseBackupMySQLi
 *
 * @category
 * @package  DatabaseBackupMySQLi
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
* @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/
 */
class DatabaseBackupMySQLi
    extends DatabaseBackup
    implements DatabaseBackupMySQLiInterface
{
    /**
     * @var array ignoreTables
     */
    protected $ignoreTables = [];
    /**
     * @var bool allDatabases
     */
    protected $allDatabases = false;
    /**
     * @var bool allTablespaces
     */
    protected $allTablespaces = false;
    /**
     * @var bool noTablespaces
     */
    protected $noTablespaces = false;
    /**
     * @var bool addDropDatabase
     */
    protected $addDropDatabase = false;
    /**
     * @var bool addDropTable
     */
    protected $addDropTable = true;
    /**
     * @var bool addLocks
     */
    protected $addLocks = true;
    /**
     * @var bool allowKeywords
     */
    protected $allowKeywords = false;
    /**
     * @var bool applySlaveStatements
     */
    protected $applySlaveStatements = false;
    /**
     * @var string characterSetsDir
     */
    protected $characterSetsDir = "";
    /**
     * @var bool comments
     */
    protected $comments = true;
    /**
     * @var  compatible
     */
    protected $compatible = "";

    /**
     * @var array acceptableCompatibleValues
     */
    static protected $acceptableCompatibleValues = [
        "ansi",
        "mysql323",
        "mysql40",
        "postgresql",
        "oracle",
        "mssql",
        "db2",
        "maxdb",
        "no_key_options",
        "no_table_options",
        "no_field_options"
    ];
    /**
     * @var bool compact
     */
    protected $compact = false;
    /**
     * @var bool completeInsert
     */
    protected $completeInsert = false;
    /**
     * @var bool compress
     */
    protected $compress = false;
    /**
     * @var bool createOptions
     */
    protected $createOptions = true;
    /**
     * @var bool databases
     */
    protected $databases = false;
    /**
     * @var bool debugCheck
     */
    protected $debugCheck = false;
    /**
     * @var bool debugInfo
     */
    protected $debugInfo = false;
    /**
     * @var string defaultCharacterSet
     */
    protected $defaultCharacterSet = "utf8";
    /**
     * @var bool delayedInsert
     */
    protected $delayedInsert = false;
    /**
     * @var bool deleteMasterLogs
     */
    protected $deleteMasterLogs = false;
    /**
     * @var bool disableKeys
     */
    protected $disableKeys = true;
    /**
     * @var int dumpSlave
     */
    protected $dumpSlave = 0;
    /**
     * @var bool events
     */
    protected $events = false;
    /**
     * @var bool extendedInsert
     */
    protected $extendedInsert = true;
    /**
     * @var string fieldsTerminatedBy
     */
    protected $fieldsTerminatedBy = "";
    /**
     * @var string fieldsEnclosedBy
     */
    protected $fieldsEnclosedBy = "";
    /**
     * @var string fieldsOptionallyEnclosedBy
     */
    protected $fieldsOptionallyEnclosedBy = "";
    /**
     * @var string fieldsEscapedBy
     */
    protected $fieldsEscapedBy = "";
    /**
     * @var bool flushLogs
     */
    protected $flushLogs = false;
    /**
     * @var bool flushPrivileges
     */
    protected $flushPrivileges = false;
    /**
     * @var bool force
     */
    protected $force = false;
    /**
     * @var bool hexBlob
     */
    protected $hexBlob = false;
    /**
     * @var bool includeMasterHostPort
     */
    protected $includeMasterHostPort = false;
    /**
     * @var bool insertIgnore
     */
    protected $insertIgnore = false;
    /**
     * @var  linesTerminatedBy
     */
    protected $linesTerminatedBy ="";
    /**
     * @var bool lockAllTables
     */
    protected $lockAllTables = false;
    /**
     * @var bool lockRables
     */
    protected $lockRables = true;
    /**
     * @var string logError
     */
    protected $logError = "";
    /**
     * @var int masterData
     */
    protected $masterData = 0;
    /**
     * @var int maxAllowedPacket
     */
    protected $maxAllowedPacket = 16777216;
    /**
     * @var int netBufferLength
     */
    protected $netBufferLength = 1046528;
    /**
     * @var bool noAutoCommit
     */
    protected $noAutoCommit = false;
    /**
     * @var bool noCreateDB
     */
    protected $noCreateDB = false;
    /**
     * @var bool noCreateInfo
     */
    protected $noCreateInfo = false;
    /**
     * @var bool noData
     */
    protected $noData = false;
    /**
     * @var bool orderByPrimary
     */
    protected $orderByPrimary = false;
    /**
     * @var bool quick
     */
    protected $quick = true;
    /**
     * @var bool quoteNames
     */
    protected $quoteNames = true;
    /**
     * @var bool replace
     */
    protected $replace = false;
    /**
     * @var bool routines
     */
    protected $routines = false;
    /**
     * @var bool setCharSet
     */
    protected $setCharSet = true;
    /**
     * @var bool singleTransaction
     */
    protected $singleTransaction = false;
    /**
     * @var bool dumpDate
     */
    protected $dumpDate = true;
    /**
     * @var bool ssl
     */
    protected $ssl = false;
    /**
     * @var string sslCA
     */
    protected $sslCA = "";
    /**
     * @var string sslCAPath
     */
    protected $sslCAPath = "";
    /**
     * @var string sslCert
     */
    protected $sslCert = "";
    /**
     * @var string sslCipher
     */
    protected $sslCipher = "";
    /**
     * @var string sslKey
     */
    protected $sslKey = "";
    /**
     * @var bool sslVerifyServerCert
     */
    protected $sslVerifyServerCert = false;
    /**
     * @var string tab
     */
    protected $tab = "";
    /**
     * @var bool triggers
     */
    protected $triggers = true;
    /**
     * @var bool tzUTC
     */
    protected $tzUTC = true;
    /**
     * @var bool verbose
     */
    protected $verbose = false;
    /**
     * @var string where
     */
    protected $where = "";
    /**
     * @var string pluginDir
     */
    protected $pluginDir = "";
    /**
     * @var string defaultAuth
     */
    protected $defaultAuth = "";
    /**
     * @var array acceptableProtocol
     */
    static protected $acceptableProtocol = [
        "tcp",
        "socket",
        "pipe",
        "memory"
    ];

    /**
     * @var object DatabaseBackupMySQLi a singleton instance of this class
     */
    static public $DatabaseBackupMySQLi;

    /** __construct
     */
    protected function __construct()
    {
        $this->setCommand("mysqldump ");
        $this->setPort("3306");
        $this->setSocket("/var/run/mysqld/mysqld.sock");
    }

    /** instance
     *
     * @return DatabaseBackupMySQLi
     */
    static public function instance()
    {
        if ( !isset(self::$DatabaseBackupMySQLi) ) {
            self::$DatabaseBackupMySQLi = new DatabaseBackupMySQLi();
        }
        return self::$DatabaseBackupMySQLi;
    }

    /** factory
     *
     * @return DatabaseBackupMySQLi
     */
    static public function factory()
    {
        return new DatabaseBackupMySQLi();
    }

    /**   setNoData
     *
     * @param boolean $noData
     *
     * @return bool
     */
    public function setNoData($noData)
    {
        try {
            if (CheckInput::checkNewInput($noData)) {
                $this->noData = $noData;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": noData invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        } finally {

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
            if ($this->checkRequired()) {
                $this->appendCommand(" -h ".$this->host);
                $this->appendCommand(" -u " . $this->user);
                $this->appendCommand(" --password='" . $this->password."'");
                if ( $this->noData ) {
                    $this->appendCommand(" -d");
                }
                $this->appendCommand(" " . implode("", $this->databases));
                $this->appendCommand(" >" . $this->destination);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": requirements not met.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        } finally {

        }
        return true;
    }

    /** checkRequired
     *
     * @return bool
     */
    protected function checkRequired()
    {
        if ( $this->checkSetArray([$this->host, $this->databases, $this->user, $this->password, $this->destination])) {
            return true;
        } else {
            return false;
        }
    }
}
/*
 *
//todo: test with client information
$databaseBackupMySQLi = DatabaseBackupMySQLi::instance();
$databaseBackupMySQLi->setHost("localhost");
$databaseBackupMySQLi->setUser("root");
$databaseBackupMySQLi->setPassword('4u$t1nTX');
$databaseBackupMySQLi->setDatabase("ecommerce1");
$databaseBackupMySQLi->setDestination("Ecommerce1.sql");
$databaseBackupMySQLi->setNoData(true);
$databaseBackupMySQLi->execute();
*/