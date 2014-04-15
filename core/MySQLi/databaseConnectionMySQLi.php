<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Carl "Tex" Morgan
 * Date: 3/22/13
 * Time: 3:10 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
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

    /** factory
     *
     * @return DatabaseConnectionMySQLi
     */
    public static function factory()
    {
        return new DatabaseConnectionMySQLi();
    }


    /** set
     * 
     * @param string $key
     * @param mixed $value
     * 
     * @return bool
     */
    public function set( $key, $value )
    {

        try {
            $this->$key = $value;
            if (!CheckInput::checkSet($this->$key)) {
                throw new exceptionHandler(__METHOD__ . ": set failed.");
            }
        } catch (exceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }


    /** setSSL
     * 
     * @param $keyPath
     * @param $certificatePath
     * @param $authorityPath
     * @param $pemPath
     * @param $cipher
     * 
     * @return bool
     */
    public function setSSL( $keyPath, $certificatePath, $authorityPath, $pemPath, $cipher )
    {
        return $this->connection->ssl_set($keyPath, $certificatePath, $authorityPath, $pemPath, $cipher);
    }

    /** init
     * 
     * @return bool
     */
    public function init()
    {
        try {
            $this->connection = mysqli_init();
            if (!CheckInput::checkSet($this->connection)) {
                throw new exceptionHandler(__METHOD__ . ": init failed.");
            }
        } catch (exceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;

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
                    $this->getDatabaseName()
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

    /** openConnectionSSL
     *
     * @return bool
     */
    public function openConnectionSSL()
    {
        try {
            if ($this->checkRequiredConnection()) {
                $this->connection->real_connect(
                    $this->getServerName(),
                    $this->getUserName(),
                    $this->getUserPassword(),
                    $this->getDatabaseName(),
                    3306,
                    "/var/run/mysqld/mysqld.sock",
                    MYSQL_CLIENT_SSL
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
     *
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
     *
     * @return bool
     */
    protected function checkPort()
    {
        return CheckInput::checkSet($this->databasePort);
    }

    /** checkSocket
     *
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

    /** more_results
     *
     * @return bool
     */
    public function more_results()
    {
        return $this->connection->more_results();
    }

    /** real_escape_string
     *
     * @param $string
     *
     * @return mixed
     */
    public function real_escape_string($string)
    {
        return $this->connection->real_escape_string($string);
    }

    /** commit
     *
     * @return mixed
     */
    public function commit()
    {
        return $this->connection->commit();
    }

    /** setCharacterSet
     * 
     * @param string $newCharacterSet the new character set to use
     * 
     * @return bool
     */
    public function setCharacterSet( $newCharacterSet )
    {
        return $this->connection->set_charset($newCharacterSet);
    }


    /** printCharacterSet
     * 
     * @return bool
     */
    public function printCharacterSet()
    {
        try {
            if (CheckInput::checkSet($this->connection->character_set_name())) {
                echo $this->connection->character_set_name();
            } else {
                throw new exceptionHandler(__METHOD__ . ": character set unknown.");
            }
        } catch (exceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }


    /** printHostInfo
     * 
     * @return bool
     */
    public function printHostInfo()
    {
        try {
            if (CheckInput::checkSet($this->connection->host_info)) {
                echo $this->connection->host_info;
            } else {
                throw new exceptionHandler(__METHOD__ . ": host info unknown.");
            }
        } catch (exceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** closeConnection
     * 
     * @return bool
     */
    public function closeConnection()
    {
        return $this->connection->close();
    }

    /** getTables
     * 
     * @return array|bool
     */
    public function getTables()
    {
        try {
            if (CheckInput::checkSet($this->databaseName)) {
                $q = 'SELECT distinct table_name FROM information_schema.key_column_usage WHERE table_schema="' . $this->getDatabaseName() . '" AND table_name NOT LIKE "view%"';
                $r = $this->connection->query($q);
                if ($r->num_rows > 0) {
                    $row = null;
                    $ret = array();
                    while ($row = $r->fetch_row()) {
                        $ret[] = $row['0'];
                    }
                    return $ret;
                } else {
                    return false;
                }
            } else {
                throw new exceptionHandler(__METHOD__ . ": no database name.");
            }
        } catch (exceptionHandler $e) {
            $e->execute();
            return false;
        }
    }

    /** getPrimaryKeys
     * 
     * @return array|bool
     */
    public function getPrimaryKeys()
    {
        try {
            if (CheckInput::checkSet($this->databaseName)) {
                $q = 'SELECT table_name, column_name FROM information_schema.key_column_usage WHERE table_schema="' . $this->getDatabaseName() . '" AND table_name NOT LIKE "view%" AND constraint_name="PRIMARY"';
                $r = $this->connection->query($q);
                if ($r->num_rows > 0) {
                    $row = null;
                    $ret = array();
                    while ($row = $r->fetch_row()) {
                        $ret[$row['0']][] = $row['1'];
                    }
                    return $ret;
                } else {
                    return false;
                }
            } else {
                throw new exceptionHandler(__METHOD__ . ": no database name.");
            }
        } catch (exceptionHandler $e) {
            $e->execute();
            return false;
        }
    }

    /** getViews
     * 
     * @return array|bool
     */
    public function getViews()
    {
        try {
            if (CheckInput::checkSet($this->databaseName)) {
                $q = 'SELECT distinct table_name FROM information_schema.views WHERE table_schema="' . $this->getDatabaseName() . '"';
                $r = $this->connection->query($q);
                $count = mysqli_num_rows($r);
                if ($count > 0) {
                    $row = null;
                    $ret = [];
                    while ($row = $r->fetch_row()) {
                        $ret[] = $row['0'];
                    }
                    return $ret;
                } else {
                    return false;
                }
            } else {
                throw new exceptionHandler(__METHOD__ . ": no database name.");
            }
        } catch (exceptionHandler $e) {
            $e->execute();
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
        try {
            if (CheckInput::checkSet($this->databaseName) AND CheckInput::checkNewInput($table)) {
                $q = "DESCRIBE `" . $table . "`";
                $r = $this->connection->query($q);
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
            } else {
                throw new exceptionHandler(__METHOD__ . ": table and database required.");
            }
        } catch (exceptionHandler $e) {
            $e->execute();
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
        try {
            if (CheckInput::checkSet($this->databaseName) AND CheckInput::checkNewInput($table)) {
                $q = "SHOW KEYS IN " . $table;
                $r = $this->connection->query($q);
                if ($r->num_rows > 0) {
                    $row = null;
                    $ret = [];
                    while ($row = $r->fetch_assoc()) {
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
            } else {
                throw new exceptionHandler(__METHOD__ . ": table and database required.");
            }
        } catch (exceptionHandler $e) {
            $e->execute();
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
        try {
            if (CheckInput::checkSet($this->databaseName) AND CheckInput::checkNewInput($table)) {
                $q = 'SELECT column_name FROM information_schema.key_column_usage WHERE table_schema="' . $this->getDatabaseName() . '" AND table_name="' . $table . '" AND CONSTRAINT_NAME="PRIMARY"';
                $r = $this->connection->query($q);
                if ($r->num_rows > 0) {
                    $row = null;
                    $ret = array();
                    while ($row = $r->fetch_assoc()) {
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
            } else {
                throw new exceptionHandler(__METHOD__ . ": table and database required.");
            }
        } catch (exceptionHandler $e) {
            $e->execute();
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
        try {
            if (CheckInput::checkSet($this->databaseName) AND CheckInput::checkNewInput($table) ) {
                $q = 'SELECT column_name FROM information_schema.key_column_usage WHERE table_schema="' . $this->getDatabaseName() . '" AND table_name="' . $table . '" AND CONSTRAINT_NAME LIKE "fk%"';
                $r = $this->connection->query($q);
                if ($r->num_rows > 0) {
                    $row = null;
                    $ret = array();
                    while ($row = $r->fetch_assoc()) {
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
            } else {
                throw new exceptionHandler(__METHOD__ . ": table and database required.");
            }
        } catch (exceptionHandler $e) {
            $e->execute();
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
                if ($value['Null'] === 'NO') {
                    if ($requiredList === null) {
                        $requiredList = "`" . $value['Field'] . "`";
                    } else {
                        $requiredList .= ", `" . $value['Field'] . "`";
                    }
                } else {
                    //do nothing
                }
            }
            if ($requiredList === null) {
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
        try {
            if (CheckInput::checkSet($this->databaseName) AND CheckInput::checkNewInput($table)) {
                $q = 'SELECT column_name FROM information_schema.columns WHERE table_schema="' . $this->getDatabaseName() . '" AND table_name="' . $table . '";';
                $r = $this->connection->query($q);
                if ($r->num_rows > 0) {
                    $row = null;
                    $ret = [];
                    while ($row = $r->fetch_assoc()) {
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
            } else {
                throw new exceptionHandler(__METHOD__ . ": table and database required.");
            }
        } catch (exceptionHandler $e) {
            $e->execute();
            return false;
        }        
    }

    /** getAllColumnTypes
     * 
     * @return array|bool
     */
    public function getAllColumnTypes()
    {
        try {
            if (CheckInput::checkSet($this->databaseName)) {
                $q = 'SELECT distinct(column_type) FROM information_schema.columns WHERE table_schema="' . $this->getDatabaseName() . '"';
                $r = $this->connection->query($q);
                if ($r->num_rows > 0) {
                    $row = null;
                    $ret = array();
                    while ($row = $r->fetch_assoc()) {
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
            } else {
                throw new exceptionHandler(__METHOD__ . ": no database name.");
            }
        } catch (exceptionHandler $e) {
            $e->execute();
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
$SSL->setDatabaseName("mysql");
$SSL->setUserName("root");
$SSL->setUserPassword('4u$t1nTX');
$SSL->openConnection();
$SSL->printHostInfo();
print_r(mysqli_fetch_row(mysqli_query($SSL->getConnection(),"SHOW STATUS LIKE 'ssl_cipher';")));
*/