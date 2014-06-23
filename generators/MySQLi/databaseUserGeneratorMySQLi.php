<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Carl "Tex" Morgan
 * Date: 3/29/13
 * Time: 10:45 AM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR. ".." . DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."config.inc.php";
require_once AMPHIBIAN_GENERATORS_ABSTRACT. "databaseUserGenerator.php";
require_once AMPHIBIAN_CORE_MYSQLI . "databaseConnectionMySQLi.php";
require_once AMPHIBIAN_CORE_NEUTRAL . "RandomPassword.php";
require_once AMPHIBIAN_CORE_NEUTRAL . "FileHandle.php";
require_once AMPHIBIAN_CORE_MYSQLI . "databaseQueryMySQLi.php";
require_once "interfaces".DIRECTORY_SEPARATOR."databaseUserGeneratorMySQLiInterface.php";
/**
 * Class DatabaseUserGeneratorMySQLi
 *
 * @category ${NAMESPACE}
 * @package  DatabaseUserGeneratorMySQLi
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license
 * @link
 */
class DatabaseUserGeneratorMySQLi
    extends DatabaseUserGenerator
    implements DatabaseUserGeneratorMySQLiInterface
{
    /** __construct
     *
     * @param object $databaseConnection a valid DatabaseConnection object
     */
    protected function __construct( $databaseConnection )
    {
        $this->databaseConnection = $databaseConnection;
        $this->databaseName       = DB_NAME;
        $this->databaseHost       = DB_HOST;
        $this->databaseQuery      = databaseQueryMySQLi::instance($this->databaseConnection);
    }

    /** __clone
     *
     * @return void
     */
    protected function __clone()
    {
    }

    /** instance
     *
     * @param object $databaseConnection a valid DatabaseConnection object
     *
     * @return object
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
                throw new ExceptionHandler(" database connection is dead.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** set
     *
     * @param string $element the specific element to set
     * @param mixed  $value   the value to give the element
     *
     * @return bool
     */
    public function set( $element, $value )
    {
        try {
            if ( $this->checkNewInput($element) ) {
                if ( $this->checkNewInput($value) ) {
                    $this->$element = $value;
                } else {
                    throw new ExceptionHandler("the value is not specified");
                }
            } else {
                throw new ExceptionHandler("the attribute is not specified");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** defaultBrowseUserRights
     *
     * @return void
     */
    protected function defaultBrowseUserRights()
    {
        $this->userRights = "EXECUTE, SELECT, SHOW VIEW";
    }

    /** defaultRegularUserRights
     *
     * @return void
     */
    protected function defaultRegularUserRights()
    {
        $this->userRights = "EXECUTE, INSERT, SELECT, UPDATE";
    }

    /** defaultPowerUserRights
     *
     * @return void
     */
    protected function defaultPowerUserRights()
    {
        $this->userRights = "DELETE, EXECUTE, INSERT, SELECT, SHOW VIEW, UPDATE";
    }

    /** defaultAdminUserRights
     *
     * @return void
     */
    protected function defaultAdminUserRights()
    {
        $this->userRights = "ALL";
    }

    /** execute
     *
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
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** createDefaultUsers
     *
     * @return void
     */
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

    /** iterate
     *
     * @return void
     */
    protected function iterate()
    {
        $this->uppercaseName      = strtoupper($this->baseUserName);
        $this->uppercaseFirstName = ucfirst($this->baseUserName);
        $this->makePassword();
        $this->generateConnectionTemplate();
        $this->writeConnectionTemplate();
        $this->execute();
    }

    /** generateConnectionTemplate
     *
     * @return void
     */
    protected function generateConnectionTemplate()
    {
        $this->content = '<?php' . PHP_EOL;
        $this->content .= "DEFINE ('" . $this->uppercaseName . "_DB_USER', '" . $this->userName . "');" . PHP_EOL;
        $this->content .= "DEFINE ('" . $this->uppercaseName . "_DB_PASSWORD', '" . $this->password . "');" . PHP_EOL;
        $this->content .= "DEFINE ('" . $this->uppercaseName . "_DB_HOST', '" . $this->databaseHost . "');" . PHP_EOL;
        $this->content .= "DEFINE ('" . $this->uppercaseName . "_DB_NAME', '" . $this->databaseName . "');" . PHP_EOL;
        $this->content .= "/*" . PHP_EOL;
        $this->content .= " * SSL configuration constants" . PHP_EOL;
        $this->content .= " * For help with SSL replication see this website:" . PHP_EOL;
        $this->content .= " * http://www.webdevelopersdiary.com/1/post/2012/07/mysql-database-replication-using-ssl-on-ubuntu-1204.html" . PHP_EOL;
        $this->content .= "DEFINE ('" . $this->uppercaseName . "_SSL_KEY_PATH','/etc/mysql/server-key.pem');" . PHP_EOL;
        $this->content .= "DEFINE ('" . $this->uppercaseName . "_SSL_CERT_PATH','/etc/mysql/server-cert.pem');" . PHP_EOL;
        $this->content .= "DEFINE ('" . $this->uppercaseName . "_SSL_AUTH_PATH','/etc/mysql/ca-cert.pem');" . PHP_EOL;
        $this->content .= "DEFINE ('" . $this->uppercaseName . "_SSL_CA_PATH',NULL);" . PHP_EOL;
        $this->content .= "DEFINE ('" . $this->uppercaseName . "_SSL_CIPHER',NULL);" . PHP_EOL;
        $this->content .= "*/" . PHP_EOL;
        $this->content .= "/*" . PHP_EOL;
        $this->content .= " * RSA configuration constants" . PHP_EOL;
        $this->content .= "DEFINE ('" . $this->uppercaseName . "_RSA_PUBLIC_KEY',NULL);" . PHP_EOL;
        $this->content .= "*/" . PHP_EOL;
        $this->content .= "// Make the connection:" . PHP_EOL;
        $this->content .= '$databaseConnection' . $this->uppercaseFirstName . " = mysqli_connect (" . $this->uppercaseName . "_DB_HOST, " . $this->uppercaseName . "_DB_USER, " . $this->uppercaseName . "_DB_PASSWORD, " . $this->uppercaseName . "_DB_NAME);" . PHP_EOL;
        $this->content .= 'if( !$databaseConnection' . $this->uppercaseFirstName . " ) {" . PHP_EOL;
        $this->content .= '    die("Connection Error(".mysqli_connect_errno($databaseConnection' . $this->uppercaseFirstName . ").'): ' . mysqli_connect_error());" . PHP_EOL;
        $this->content .= "} else {" . PHP_EOL;
        $this->content .= "    // Set the character set:" . PHP_EOL;
        $this->content .= "    mysqli_set_charset(" . '$databaseConnection' . $this->uppercaseFirstName . ", 'utf8');" . PHP_EOL;
        $this->content .= "}";
    }

    /** writeConnectionTemplate
     *
     * @return void
     */
    protected function writeConnectionTemplate()
    {
        $this->FileHandle = new FileHandle(DATABASE_CONNECTIONS . "mysql_" . $this->baseUserName . ".inc.php");
        $this->FileHandle->writeFull($this->content);
    }

    /** checkUserExists
     *
     * @return bool
     */
    protected function checkUserExists()
    {
        try {
            if ( $this->databaseQuery->execute('SELECT 1 FROM mysql.user WHERE `User` LIKE "' . $this->userName . '%" AND `Host`="' . $this->databaseHost . '"') ) {
                return true;
            } else {
                throw new ExceptionHandler("Check user exists command failed");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** revoke
     *
     * @return bool
     */
    protected function revoke()
    {
        try {
            if ( $this->databaseQuery->execute("REVOKE ALL PRIVILEGES, GRANT OPTION FROM " . $this->userName . "@" . $this->databaseHost) ) {
                return true;
            } else {
                throw new ExceptionHandler("REVOKE command failed");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** drop
     *
     * @return bool
     */
    protected function drop()
    {
        try {
            if ( $this->databaseQuery->execute("DROP USER " . $this->userName . "@" . $this->databaseHost) ) {
                return true;
            } else {
                throw new ExceptionHandler("DROP USER command failed");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** create
     *
     * @return bool
     */
    protected function create()
    {
        try {
            if ( $this->databaseQuery->execute("CREATE USER " . $this->userName . "@" . $this->databaseHost) ) {
                return true;
            } else {
                throw new ExceptionHandler("CREATE USER command failed");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** makePassword
     *
     * @return void
     */
    protected function makePassword()
    {
        $pw = new randomPassword("whirlpool", 16);
        $pw->createPassword();
        $this->password = $pw->password;
        unset($pw);
    }

    /** setPassword
     *
     * @return bool
     */
    protected function setPassword()
    {
        try {
            if ( $this->databaseQuery->execute("SET PASSWORD FOR " . $this->userName . "@" . $this->databaseHost . " = PASSWORD(" . $this->password . ")") ) {
                return true;
            } else {
                throw new ExceptionHandler("SET PASSWORD command failed");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** grant
     *
     * @return bool
     */
    protected function grant()
    {
        try {
            if ( $this->databaseQuery->execute("GRANT " . $this->userRights . " ON " . $this->databaseName . ".* TO " . $this->userName . "@" . $this->databaseHost) ) {
                return true;
            } else {
                throw new ExceptionHandler("GRANT command failed");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }
}

/*
 * Run for all users
 */

//require_once AMPHIBIAN_CONFIG."Coworks.In.config.inc.php";
//require_once MYSQL; todo: replace these with correct databaseConnectionMySQLi calls
/*
$mysqliUG = DatabaseUserGeneratorMySQLi::instance($databaseConnection);
$mysqliUG->makeUserName("browse");
$mysqliUG->execute();
*/
/*
 * Make all the default users*/
$mysqliUG = DatabaseUserGeneratorMySQLi::instance($databaseConnection);
$mysqliUG->createDefaultUsers();
