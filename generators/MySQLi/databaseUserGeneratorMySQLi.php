<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Carl "Tex" Morgan
 * Date: 3/29/13
 * Time: 10:45 AM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config/config.inc.php";
require_once "databaseUserGenerator.php";
require_once AMPHIBIAN_CORE . "databaseConnectionMySQLi.php";
require_once AMPHIBIAN_CORE . "RandomPassword.php";
require_once AMPHIBIAN_CORE . "FileHandle.php";
require_once AMPHIBIAN_CORE . "databaseQueryMySQLi.php";
require_once "interfaces".DIRECTORY_SEPARATOR."databaseUserGeneratorMySQLiInterface.php";
/**
 * Class DatabaseUserGeneratorMySQLi
 */
class DatabaseUserGeneratorMySQLi
    extends DatabaseUserGenerator
    implements DatabaseUserGeneratorMySQLiInterface
{
    /**
     * @param $databaseConnection
     */
    protected function __construct( $databaseConnection )
    {
        $this->databaseConnection = $databaseConnection;
        $this->databaseName       = DB_NAME;
        $this->databaseHost       = DB_HOST;
        $this->databaseQuery      = databaseQueryMySQLi::instance($this->databaseConnection);
    }

    protected function __clone()
    {
    }

    /**
     * @param $databaseConnection
     * @return bool|DatabaseUserGeneratorMySQLi
     */
    static public function instance( $databaseConnection )
    {
        try {
            if ( $databaseConnection->ping() ) {
                if ( self::$databaseUser === null ) {
                    self::$databaseUser = new DatabaseUserGeneratorMySQLi($databaseConnection);
                }
                return self::$databaseUser;
            } else {
                throw new Exception(" database connection is dead.");
            }
        } catch ( Exception $e ) {
            echo utf8_encode(date('Y-m-d H:i:s') . " " . __CLASS__ . "::" . __FUNCTION__ . ":" . $e);
            return false;
        }
    }

    /**
     * @param $element
     * @param $value
     * @return bool
     */
    public function set( $element, $value )
    {
        try {
            if ( $this->checkNewInput($element) ) {
                if ( $this->checkNewInput($value) ) {
                    $this->$$element = $value;
                } else {
                    throw new Exception("the value is not specified");
                }
            } else {
                throw new Exception("the attribute is not specified");
            }
        } catch ( Exception $e ) {
            echo utf8_encode(date('Y-m-d H:i:s') . " " . __CLASS__ . "::" . __FUNCTION__ . ":" . $e);
            return false;
        }
        return true;
    }

    protected function defaultBrowseUserRights()
    {
        $this->userRights = "EXECUTE, SELECT, SHOW VIEW";
    }

    protected function defaultRegularUserRights()
    {
        $this->userRights = "EXECUTE, INSERT, SELECT, UPDATE";
    }

    protected function defaultPowerUserRights()
    {
        $this->userRights = "DELETE, EXECUTE, INSERT, SELECT, SHOW VIEW, UPDATE";
    }

    protected function defaultAdminUserRights()
    {
        $this->userRights = "ALL";
    }

    /**
     * @return bool
     */
    public function execute()
    {
        try {
            if ( $this->checkUserExists() ) {
                $this->revoke();
                $this->drop();
            }
            $this->create();
            $this->setPassword();
            $this->grant();
        } catch ( Exception $e ) {
            echo utf8_encode(date('Y-m-d H:i:s') . " " . __CLASS__ . "::" . __FUNCTION__ . ":" . $e);
            return false;
        }
        return true;
    }

    public function createDefaultUsers()
    {
        $this->makeUserName("browse");
        $this->defaultBrowseUserRights();
        $this->iterate();
        $this->makeUserName("user");
        $this->defaultRegularUserRights();
        $this->iterate();
        $this->makeUserName("pwrUser");
        $this->defaultPowerUserRights();
        $this->iterate();
        $this->makeUserName("Adm1n");
        $this->defaultAdminUserRights();
        $this->iterate();
    }

    protected function iterate()
    {
        $this->uppercaseName      = strtoupper($this->baseUserName);
        $this->uppercaseFirstName = ucfirst($this->baseUserName);
        $this->makePassword();
        $this->generateConnectionTemplate();
        $this->writeConnectionTemplate();
        $this->execute();
    }

    protected function generateConnectionTemplate()
    {
        $this->content = '<?php' . "\n";
        $this->content .= "DEFINE ('" . $this->uppercaseName . "_DB_USER', '" . $this->userName . "');\n";
        $this->content .= "DEFINE ('" . $this->uppercaseName . "_DB_PASSWORD', '" . $this->password . "');\n";
        $this->content .= "DEFINE ('" . $this->uppercaseName . "_DB_HOST', '" . $this->databaseHost . "');\n";
        $this->content .= "DEFINE ('" . $this->uppercaseName . "_DB_NAME', '" . $this->databaseName . "');\n";
        $this->content .= "/*\n";
        $this->content .= " * SSL configuration constants\n";
        $this->content .= " * For help with SSL replication see this website:\n";
        $this->content .= " * http://www.webdevelopersdiary.com/1/post/2012/07/mysql-database-replication-using-ssl-on-ubuntu-1204.html\n";
        $this->content .= "DEFINE ('" . $this->uppercaseName . "_SSL_KEY_PATH','/etc/mysql/server-key.pem');\n";
        $this->content .= "DEFINE ('" . $this->uppercaseName . "_SSL_CERT_PATH','/etc/mysql/server-cert.pem');\n";
        $this->content .= "DEFINE ('" . $this->uppercaseName . "_SSL_AUTH_PATH','/etc/mysql/ca-cert.pem');\n";
        $this->content .= "DEFINE ('" . $this->uppercaseName . "_SSL_CA_PATH',NULL);\n";
        $this->content .= "DEFINE ('" . $this->uppercaseName . "_SSL_CIPHER',NULL);\n";
        $this->content .= "*/\n";
        $this->content .= "/*\n";
        $this->content .= " * RSA configuration constants\n";
        $this->content .= "DEFINE ('" . $this->uppercaseName . "_RSA_PUBLIC_KEY',NULL);\n";
        $this->content .= "*/\n";
        $this->content .= "// Make the connection:\n";
        $this->content .= '$databaseConnection' . $this->uppercaseFirstName . " = mysqli_connect (" . $this->uppercaseName . "_DB_HOST, " . $this->uppercaseName . "_DB_USER, " . $this->uppercaseName . "_DB_PASSWORD, " . $this->uppercaseName . "_DB_NAME);\n";
        $this->content .= 'if( !$databaseConnection' . $this->uppercaseFirstName . " ) {\n";
        $this->content .= '    die("Connection Error(".mysqli_connect_errno($databaseConnection' . $this->uppercaseFirstName . ").'): ' . mysqli_connect_error());\n";
        $this->content .= "} else {\n";
        $this->content .= "    // Set the character set:\n";
        $this->content .= "    mysqli_set_charset(" . '$databaseConnection' . $this->uppercaseFirstName . ", 'utf8');\n";
        $this->content .= "}";
    }

    protected function writeConnectionTemplate()
    {
        $this->FileHandle = new FileHandle(DATABASE_CONNECTIONS . "mysql_" . $this->baseUserName . ".inc.php");
        $this->FileHandle->writeFull($this->content);
    }

    /**
     * @return bool
     */
    protected function checkUserExists()
    {
        try {
            if ( $this->databaseQuery->execute('SELECT 1 FROM mysql.user WHERE `User` LIKE "' . $this->userName . '%" AND `Host`="' . $this->databaseHost . '"') ) {
                return true;
            } else {
                throw new Exception("Check user exists command failed");
            }
        } catch ( Exception $e ) {
            echo utf8_encode(date('Y-m-d H:i:s') . " " . __CLASS__ . "::" . __FUNCTION__ . ":" . $e);
            return false;
        }
    }

    /**
     * @return bool
     */
    protected function revoke()
    {
        try {
            if ( $this->databaseQuery->execute("REVOKE ALL PRIVILEGES, GRANT OPTION FROM " . $this->userName . "@" . $this->databaseHost) ) {
                return true;
            } else {
                throw new Exception("REVOKE command failed");
            }
        } catch ( Exception $e ) {
            echo utf8_encode(date('Y-m-d H:i:s') . " " . __CLASS__ . "::" . __FUNCTION__ . ":" . $e);
            return false;
        }
    }

    /**
     * @return bool
     */
    protected function drop()
    {
        try {
            if ( $this->databaseQuery->execute("DROP USER " . $this->userName . "@" . $this->databaseHost) ) {
                return true;
            } else {
                throw new Exception("DROP USER command failed");
            }
        } catch ( Exception $e ) {
            echo utf8_encode(date('Y-m-d H:i:s') . " " . __CLASS__ . "::" . __FUNCTION__ . ":" . $e);
            return false;
        }
    }

    /**
     * @return bool
     */
    protected function create()
    {
        try {
            if ( $this->databaseQuery->execute("CREATE USER " . $this->userName . "@" . $this->databaseHost) ) {
                return true;
            } else {
                throw new Exception("CREATE USER command failed");
            }
        } catch ( Exception $e ) {
            echo utf8_encode(date('Y-m-d H:i:s') . " " . __CLASS__ . "::" . __FUNCTION__ . ":" . $e);
            return false;
        }
    }

    protected function makePassword()
    {
        $pw = new randomPassword("whirlpool", 16);
        $pw->createPassword();
        $this->password = $pw->password;
        unset($pw);
    }

    /**
     * @return bool
     */
    protected function setPassword()
    {
        try {
            if ( $this->databaseQuery->execute("SET PASSWORD FOR " . $this->userName . "@" . $this->databaseHost . " = PASSWORD(" . $this->password . ")") ) {
                return true;
            } else {
                throw new Exception("SET PASSWORD command failed");
            }
        } catch ( Exception $e ) {
            echo utf8_encode(date('Y-m-d H:i:s') . " " . __CLASS__ . "::" . __FUNCTION__ . ":" . $e);
            return false;
        }
    }

    /**
     * @return bool
     */
    protected function grant()
    {
        try {
            if ( $this->databaseQuery->execute("GRANT " . $this->userRights . " ON " . $this->databaseName . ".* TO " . $this->userName . "@" . $this->databaseHost) ) {
                return true;
            } else {
                throw new Exception("GRANT command failed");
            }
        } catch ( Exception $e ) {
            echo utf8_encode(date('Y-m-d H:i:s') . " " . __CLASS__ . "::" . __FUNCTION__ . ":" . $e);
            return false;
        }
    }
}

/*
 * Run for all users
 */

//require_once AMPHIBIAN_CONFIG."Coworks.In.config.inc.php";
require_once MYSQL;
/*
$mysqliUG = DatabaseUserGeneratorMySQLi::instance($databaseConnection);
$mysqliUG->makeUserName("browse");
$mysqliUG->execute();
*/
/*
 * Make all the default users*/
$mysqliUG = DatabaseUserGeneratorMySQLi::instance($databaseConnection);
$mysqliUG->createDefaultUsers();
