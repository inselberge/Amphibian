<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Carl "Tex" Morgan
 * Date: 3/22/13
 * Time: 3:10 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once AMPHIBIAN_CORE_ABSTRACT."databaseConnection.php";
require_once AMPHIBIAN_CORE_NEUTRAL . "CheckInput.php";
require_once "interfaces".DIRECTORY_SEPARATOR."databaseConnectionMySQLiInterface.php";
/**
 * Class DatabaseConnectionMySQLi
 *
 * @category DatabaseConnection
 * @package  DatabaseConnectionMySQLi
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/DatabaseConnectionMySQLi
 */
class DatabaseConnectionMySQLi
    extends DatabaseConnection
    implements DatabaseConnectionMySQLiInterface
{
    /**
     * @var object DatabaseConnectionMySQLi a database connection
     */
    static public $DatabaseConnectionMySQLi;
    /**
     * @var array acceptableOptions
     */
    protected static $acceptableOptions = array(
        MYSQLI_OPT_CONNECT_TIMEOUT,
        MYSQLI_OPT_LOCAL_INFILE,
        MYSQLI_INIT_COMMAND,
        MYSQLI_READ_DEFAULT_FILE,
        MYSQLI_READ_DEFAULT_GROUP,
        MYSQLI_SERVER_PUBLIC_KEY
    );

    /** __construct
     */
    protected function __construct()
    {
        $this->init();
    }

    /** instance
     *
     * @return DatabaseConnectionMySQLi
     */
    public static function instance()
    {
        if ( !self::$DatabaseConnectionMySQLi  ) {
            self::$DatabaseConnectionMySQLi = new DatabaseConnectionMySQLi();
        }
        return self::$DatabaseConnectionMySQLi;
    }


    /** set
     * 
     * @param string $key
     * @param mixed $value
     * 
     * @return void
     */
    public function set( $key, $value )
    {
        $this->$$key = $value;
    }


    /** setSSL
     * 
     * @param $keyPath
     * @param $certificatePath
     * @param $authorityPath
     * @param $pemPath
     * @param $cipher
     * 
     * @return void
     */
    public function setSSL( $keyPath, $certificatePath, $authorityPath, $pemPath, $cipher )
    {
        $this->connection->ssl_set($keyPath, $certificatePath, $authorityPath, $pemPath, $cipher);
    }

    /** init
     * 
     * @return void
     */
    public function init()
    {
        $this->connection = mysqli_init();
    }

    /** setOptions
     *
     * @param int   $option
     * @param mixed $value
     *
     * @return bool
     */
    public function setOptions( $option, $value )
    {
        return $this->connection->options($option, $value);
    }

    /** checkValidOption
     *
     * @param $option
     *
     * @return bool
     */
    protected function checkValidOption( $option )
    {
        return in_array($option, self::$acceptableOptions);
    }


    /** openConnection
     * 
     * @return bool
     */
    public function openConnection()
    {
        try {
            if ( $this->checkRequiredConnection() ) {
                $this->connection->real_connect(
                    $this->getServerName(),
                    $this->getUserName(),
                    $this->getUserPassword(),
                    $this->getDatabaseName(),
                    null,
                    MYSQLI_CLIENT_SSL
                );
            } else {
                throw new ExceptionHandler(__METHOD__ . ": Requirements not met.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkRequiredConnection
     * @return bool
     */
    protected function checkRequiredConnection()
    {
        try {
            if (CheckInput::checkSet($this->serverName)) {
                if (CheckInput::checkSet($this->databaseName)) {
                    if (CheckInput::checkSet($this->userName)) {
                        if (CheckInput::checkSet($this->userPassword)) {
                        } else {
                            throw new ExceptionHandler(__METHOD__ . ": User password required.");
                        }
                    } else {
                        throw new ExceptionHandler(__METHOD__ . ": User name required.");
                    }
                } else {
                    throw new ExceptionHandler(__METHOD__ . ": Database name required.");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": Server name required.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkPort
     * @return bool
     */
    protected function checkPort()
    {
        return CheckInput::checkSet($this->databasePort);
    }

    /** checkSocket
     * @return bool
     */
    protected function checkSocket()
    {
        return CheckInput::checkSet($this->databaseSocket);
    }

    /** ping
     * 
     * @return mixed
     */
    public function ping()
    {
        return $this->connection->ping();
    }


    /** printError
     * 
     * @return void
     */
    public function printError()
    {
        echo $this->error;
    }


    /** setCharacterSet
     * 
     * @param string $newCharacterSet the new character set to use
     * 
     * @return void
     */
    public function setCharacterSet( $newCharacterSet )
    {
        $this->connection->set_charset($newCharacterSet);
    }


    /** printCharacterSet
     * 
     * @return void
     */
    public function printCharacterSet()
    {
        echo $this->connection->character_set_name();
    }


    /** printHostInfo
     * 
     * @return void
     */
    public function printHostInfo()
    {
        echo $this->connection->host_info;
    }

    /** closeConnection
     * 
     * @return void
     */
    public function closeConnection()
    {
        $this->connection->close();
    }

    /** getTables
     * 
     * @return array|bool
     */
    public function getTables()
    {
        $q = 'SELECT distinct table_name FROM information_schema.key_column_usage WHERE table_schema="' . DB_NAME . '" AND table_name NOT LIKE "view%"';
        $r = mysqli_query($this->connection, $q);
        if ($r->num_rows > 0) {
            $row = null;
            $ret = [];
            while ($row = mysqli_fetch_array($r, MYSQL_NUM)) {
                $ret[] = $row['0'];
            }
            return $ret;
        } else {
            return false;
        }
    }

    /** getPrimaryKeys
     * 
     * @return array|bool
     */
    public function getPrimaryKeys()
    {
        $q = 'SELECT table_name, column_name FROM information_schema.key_column_usage WHERE table_schema="' . DB_NAME . '" AND table_name NOT LIKE "view%" AND constraint_name="PRIMARY"';
        $r = mysqli_query($this->connection, $q);
        if ($r->num_rows > 0) {
            $row = null;
            $ret = [];
            while ($row = mysqli_fetch_array($r, MYSQL_NUM)) {
                $ret[] = $row['0'];
            }
            return $ret;
        } else {
            return false;
        }
    }

    /** getViews
     * 
     * @return array|bool
     */
    public function getViews()
    {
        $q = 'SELECT distinct table_name FROM information_schema.views WHERE table_schema="' . DB_NAME . '"';
        $r = mysqli_query($this->connection, $q);
        $count = mysqli_num_rows($r);
        if ($count > 0) {
            $row = null;
            $ret = [];
            while ($row = mysqli_fetch_array($r, MYSQL_NUM)) {
                $ret[] = $row['0'];
            }
            return $ret;
        } else {
            return false;
        }
    }

    /** describeTable
     *
     * @param string $table the name of the table
     * 
     * @return array|bool
     */
    public function describeTable($table)
    {
        $q = "DESCRIBE `" . $table . "`";
        $r = mysqli_query($this->connection, $q);
        if ($r->num_rows > 0) {
            $row = null;
            $ret = [];
            while ($row = mysqli_fetch_assoc($r)) {
                $ret[] = $row;
            }
            return $ret;
        } else {
            return false;
        }
    }

    /** showKeysTable
     *
     * @param string $table the name of the table
     * 
     * @return array|bool
     */
    public function showKeysTable($table)
    {
        $q = "SHOW KEYS IN " . $table;
        $r = mysqli_query($this->connection, $q);
        if ($r->num_rows > 0) {
            $row = null;
            $ret = [];
            while ($row = mysqli_fetch_array($r, MYSQL_ASSOC)) {
                $ret[] = $row;
            }
            if (sizeof($ret) > 0) {
                return $ret;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /** getPrimaryKeysTable
     *
     * @param string $table the name of the table
     * 
     * @return array|bool
     */
    public function getPrimaryKeysTable($table)
    {
        $q = 'SELECT column_name FROM information_schema.key_column_usage WHERE table_schema="' . DB_NAME . '" AND table_name="' . $table . '" AND CONSTRAINT_NAME="PRIMARY"';
        $r = mysqli_query($this->connection, $q);
        if ($r->num_rows > 0) {
            $row = null;
            $ret = array();
            while ($row = mysqli_fetch_array($r, MYSQL_ASSOC)) {
                $ret[] = $row;
            }
            if (sizeof($ret) > 0) {
                return $ret;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /** getForeignKeysTable
     *
     * @param string $table the name of the table
     * 
     * @return array|bool
     */
    public function getForeignKeysTable($table)
    {
        $q = 'SELECT column_name FROM information_schema.key_column_usage WHERE table_schema="' . DB_NAME . '" AND table_name="' . $table . '" AND CONSTRAINT_NAME LIKE "fk%"';
        $r = mysqli_query($this->connection, $q);
        if ($r->num_rows > 0) {
            $row = null;
            $ret = array();
            while ($row = mysqli_fetch_array($r, MYSQL_ASSOC)) {
                $ret[] = $row;
            }
            if (sizeof($ret) > 0) {
                return $ret;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    //TODO: decide if this should be here at all
    /** getRequiredColumnsList
     * 
     * @param $tableDescription
     * 
     * @return bool|null|string
     */
    public function getRequiredColumnsList($tableDescription)
    {
        if (isset($tableDescription) AND sizeof($tableDescription) > 0) {
            $requiredList = null;
            foreach ($tableDescription as $value) {
                if ($value['Null'] == 'NO') {
                    if ($requiredList == null) {
                        $requiredList = "`" . $value['Field'] . "`";
                    } else {
                        $requiredList .= ", `" . $value['Field'] . "`";
                    }
                } else {
                    //do nothing
                }
            }
            if ($requiredList == null) {
                return false;
            } else {
                //echo $requiredList;
                return $requiredList;
            }
        } else {
            return false;
        }
    }

    /** getColumnList
     * 
     * @param string $table the name of the table
     * 
     * @return array|bool
     */
    public function getColumnList($table)
    {
        $q = 'SELECT column_name FROM information_schema.columns WHERE table_schema="' . DB_NAME . '" AND table_name="' . $table . '";';
        $r = mysqli_query($this->connection, $q);
        if ($r->num_rows > 0) {
            $row = null;
            $ret = [];
            while ($row = mysqli_fetch_array($r, MYSQL_ASSOC)) {
                $ret[] = $row['column_name'];
            }
            if (sizeof($ret) > 0) {
                return $ret;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /** getAllColumnTypes
     * 
     * @return array|bool
     */
    public function getAllColumnTypes()
    {
        $q = 'SELECT distinct(column_type) FROM information_schema.columns WHERE table_schema="' . DB_NAME . '"';
        $r = mysqli_query($this->connection, $q);
        if ($r->num_rows > 0) {
            $row = null;
            $ret = array();
            while ($row = mysqli_fetch_array($r, MYSQL_ASSOC)) {
                $ret[] = $row;
            }
            if (sizeof($ret) > 0) {
                return $ret;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}
/*
$SSL = databaseConnectionMySQLi::instance();
$SSL->setOptions(MYSQLI_OPT_CONNECT_TIMEOUT, 10);
$SSL->setOptions(MYSQLI_SERVER_PUBLIC_KEY, "/etc/mysql/my.cnf");
$SSL->setOptions(MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, true);
$SSL->setSSL(
    "/etc/mysql/client-key.pem",
    "/etc/mysql/client-cert.pem",
    "/etc/mysql/ca-cert.pem",
    "/etc/mysql/",
    'DHE-RSA-AES256-SHA'
);
$SSL->setServerName("127.0.0.1");
$SSL->setDatabaseName("Aff_Cell");
$SSL->setUserName("root");
$SSL->setUserPassword('4u$t1nTX');
$SSL->openConnection();
$SSL->printHostInfo();
print_r(mysqli_fetch_row(mysqli_query($SSL->getConnection(),"SHOW STATUS LIKE 'ssl_cipher';")));
*/