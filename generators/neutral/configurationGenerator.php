<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Carl "Tex" Morgan
 * Date: 6/7/13
 * Time: 1:43 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."config.inc.php";
require_once AMPHIBIAN_CORE_NEUTRAL . "FileHandle.php";
require_once AMPHIBIAN_CORE_NEUTRAL . "CheckInput.php";
require_once "interfaces".DIRECTORY_SEPARATOR."configurationGeneratorInterface.php";

/**
 * Class ConfigurationGenerator
 *
 * @category Generator
 * @package  Configuration
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/ConfigurationGenerator
 */
class ConfigurationGenerator
    implements ConfigurationGeneratorInterface
{
    /**
     * @var string appName the name of the application
     */
    protected $appName;
    /**
     * @var string appWebsite the URL of the application website
     */
    protected $appWebsite;
    /**
     * @var string baseURI the location of the base install
     */
    protected $baseURI;
    /**
     * @var string baseURL the URL of the base website
     */
    protected $baseURL;
    /**
     * @var array databasesSupported an array of the databases supported
     */
    protected $databasesSupported;
    /**
     * @var bool production
     */
    protected $production = false;
    /**
     * @var resource _FileHandle a valid file handle for writing
     */
    private $_FileHandle = null;
    /**
     * @var string _buffer an area to store what needs to be written
     */
    private $_buffer;
    /**
     * @var object ConfigurationGenerator an instance of this class
     */
    public static $ConfigurationGenerator;
    /**
     * @var array acceptableDatabases the acceptable database types
     */
    protected static  $acceptableDatabases = array(
        "MARIADB",
        "MONGODB",
        "MSSQL",
        "MYSQLI",
        "PDO",
        "POSTGRE",
        "SQLITE",
        "SQLITE3",
        "SQLSRV"
    );
    /** __construct
     */
    protected function __construct()
    {
    }

    /** instance
     *
     * @return ConfigurationGenerator
     */
    public static function instance()
    {
        if ( isset(self::$ConfigurationGenerator) ) {
        } else {
            self::$ConfigurationGenerator = new ConfigurationGenerator();
        }
        return self::$ConfigurationGenerator;
    }

    /** factory
     *
     * @return ConfigurationGenerator
     */
    public static function factory()
    {
        return new ConfigurationGenerator();
    }

    /** setAppName
     *
     * @param string $appName the name of the application
     *
     * @return bool
     */
    public function setAppName( $appName )
    {
        try {
            if ( CheckInput::checkNewInput($appName) ) {
                $this->appName = $appName;
            } else {
                throw new ExceptionHandler("appName is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getAppName
     *
     * @return string
     */
    public function getAppName()
    {
        return $this->appName;
    }

    /** setAppWebsite
     *
     * @param string $appWebsite the URL of the application website
     *
     * @return bool
     */
    public function setAppWebsite( $appWebsite )
    {
        try {
            if ( CheckInput::checkNewInput($appWebsite) ) {
                $this->appWebsite = $appWebsite;
            } else {
                throw new ExceptionHandler("appWebsite is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getAppWebsite
     *
     * @return string
     */
    public function getAppWebsite()
    {
        return $this->appWebsite;
    }

    /** setBaseURI
     *
     * @param string $baseURI the location of the base install
     *
     * @return bool
     */
    public function setBaseURI( $baseURI )
    {
        try {
            if ( CheckInput::checkNewInput($baseURI) ) {
                $this->baseURI = $baseURI;
            } else {
                throw new ExceptionHandler("baseURI is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getBaseURI
     *
     * @return string
     */
    public function getBaseURI()
    {
        return $this->baseURI;
    }

    /** setBaseURL
     *
     * @param string $baseURL the URL of the base website
     *
     * @return bool
     */
    public function setBaseURL( $baseURL )
    {
        try {
            if ( CheckInput::checkNewInput($baseURL) ) {
                $this->baseURL = $baseURL;
            } else {
                throw new ExceptionHandler("baseURL is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getBaseURL
     *
     * @return string
     */
    public function getBaseURL()
    {
        return $this->baseURL;
    }

    /** getDatabasesSupported
     *
     * @return array
     */
    public function getDatabasesSupported()
    {
        return $this->databasesSupported;
    }

    /** setDatabasesSupported
     *
     * @param array $databasesSupported an array of the databases supported
     *
     * @return bool
     */
    public function setDatabasesSupported($databasesSupported)
    {
        try {
            if (CheckInput::checkNewInputArray($databasesSupported)) {
                foreach ($databasesSupported as $database) {
                    if ( in_array($database, self::$acceptableDatabases) ) {
                        $this->databasesSupported[] = $database;
                    }
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": databasesSupported invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getProduction
     *
     * @return boolean
     */
    public function getProduction()
    {
        return $this->production;
    }

    /**   setProduction
     *
     * @param boolean $production true = production; false = staging
     *
     * @return bool
     */
    public function setProduction($production)
    {
        try {
            if (CheckInput::checkNewInput($production)) {
                $this->production = $production;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": production invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }


    /** execute
     *
     * @return bool
     */
    public function execute()
    {
        try {
            if ( CheckInput::checkNewInputArray(
                array(
                    $this->appName,
                    $this->appWebsite,
                    $this->baseURI,
                    $this->baseURL
                )
            ) ) {
                $this->addBaseBlock();
                $this->addConfiguration();
                $this->addAgency();
                $this->addJSONAgencyBlock();
                $this->addControllersBlock();
                $this->addDatabaseBlock();
                $this->addDocumentationBlock();
                $this->addIncludesBlock();
                $this->addLib();
                $this->addLogBlock();
                $this->addModelsBlock();
                $this->addJSONModelBlock();
                $this->addBehaviourSpecFolders();
                $this->addViewsBlock();
                $this->addTestsBlock();
                $this->addVendor();
                $this->writeFromBuffer();
            } else {
                throw new ExceptionHandler(__METHOD__."Check the name, website, URI, and URL.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** addBaseBlock
     *
     * @return void
     */
    protected function addBaseBlock()
    {
        $this->_buffer = "<?php ".PHP_EOL;
        $this->_buffer .= "define('JQUERY_VERSION', '1.10.1');" . PHP_EOL;
        $this->_buffer .= "define('JQUERY_UI_VERSION', '1.10.3');" . PHP_EOL;
        $this->_buffer .= "define('JQUERY_MOBILE_VERSION', '1.3.1');" . PHP_EOL.PHP_EOL;
        $this->_buffer .= "define('APP_NAME', '" ;
        $this->_buffer .= $this->getAppName() . "');" . PHP_EOL;
        $this->_buffer .= "define('APP_WEBSITE', '" ;
        $this->_buffer .= $this->getAppWebsite() . "');" . PHP_EOL;
        $this->_buffer .= "define('BASE_URI', '" ;
        $this->_buffer .= $this->getBaseURI() . "');" . PHP_EOL;
        $this->_buffer .= "define('PUBLIC_BASE_URI', '" ;
        $this->_buffer .= $this->getBaseURI() . "html'.DIRECTORY_SEPARATOR);" . PHP_EOL.PHP_EOL;
        $this->addBaseURL();
    }

    /** addBaseURL
     *
     * @return void
     */
    protected function addBaseURL()
    {
        $this->_buffer .= 'if ( isset($live) AND $live===false ) {' . PHP_EOL;
        $this->_buffer .= "    define('BASE_URL', 'localhost/";
        $this->_buffer .= $this->getAppName() . "');" . PHP_EOL;
        $this->_buffer .= "} else {" . PHP_EOL;
        $this->_buffer .= "    define('BASE_URL', '";
        $this->_buffer .= $this->getBaseURL() . "'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "}" . PHP_EOL.PHP_EOL;
    }

    /** addConfiguration
     *
     * @return void
     */
    protected function addConfiguration()
    {
        $this->_buffer .= "define('BASE_CSS', PUBLIC_BASE_URI.'css'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('BASE_JAVASCRIPT', PUBLIC_BASE_URI.'js'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('PUBLIC_IMAGES', PUBLIC_BASE_URI . 'image'.DIRECTORY_SEPARATOR);" . PHP_EOL.PHP_EOL;
        $this->_buffer .= "define('BASE_CONFIG', BASE_URI.'config'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('BASE_CONFIG_PRODUCTION', BASE_CONFIG.'production'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('BASE_CONFIG_STAGING', BASE_CONFIG.'staging'.DIRECTORY_SEPARATOR);" . PHP_EOL.PHP_EOL;
        $this->_buffer .= "define('CORE', BASE_URI . 'core'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('CORE_ABSTRACT', CORE . 'abstract'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('CORE_ABSTRACT_INTERFACES', CORE_ABSTRACT . 'interfaces'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('CORE_HELPERS', CORE . 'helpers'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('CORE_INTERFACES', CORE . 'interfaces'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->addCoreDatabase();
        $this->_buffer .= "define('CORE_NEUTRAL', CORE . 'neutral'.DIRECTORY_SEPARATOR);" . PHP_EOL.PHP_EOL;
    }

    /** addCoreDatabase
     *
     * @return bool
     */
    protected function addCoreDatabase()
    {
        try {
            if (CheckInput::checkSetArray($this->databasesSupported)) {
                foreach ($this->databasesSupported as $database) {
                    $this->forkCoreDatabase($database);
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": no databases listed.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** forkCoreDataBase
     *
     * @param string $database a string representing the database
     *
     * @return bool
     */
    protected function forkCoreDataBase($database)
    {
        try {
            if ($database === "MARIADB") {
                $this->_buffer .= "define('CORE_MARIADB', CORE . 'MariaDB'.DIRECTORY_SEPARATOR);" . PHP_EOL;
                $this->_buffer .= "define('CORE_MARIADB_INTERFACES', CORE_MARIADB . 'interfaces'.DIRECTORY_SEPARATOR);" . PHP_EOL;
            } elseif ($database === "MONGODB") {
                $this->_buffer .= "define('CORE_MONGODB', CORE . 'MongoDB'.DIRECTORY_SEPARATOR);" . PHP_EOL;
                $this->_buffer .= "define('CORE_MONGODB_INTERFACES', CORE_MONGODB . 'interfaces'.DIRECTORY_SEPARATOR);" . PHP_EOL;
            } elseif ($database === "MSSQL") {
                $this->_buffer .= "define('CORE_MSSQL', CORE . 'MSSQL'.DIRECTORY_SEPARATOR);" . PHP_EOL;
                $this->_buffer .= "define('CORE_MSSQL_INTERFACES', CORE_MSSQL . 'interfaces'.DIRECTORY_SEPARATOR);" . PHP_EOL;
            } elseif ($database === "MYSQLI") {
                $this->_buffer .= "define('CORE_MYSQLI', CORE . 'MySQLi'.DIRECTORY_SEPARATOR);" . PHP_EOL;
                $this->_buffer .= "define('CORE_MYSQLI_INTERFACES', CORE_MYSQLI . 'interfaces'.DIRECTORY_SEPARATOR);" . PHP_EOL;
            } elseif ($database === "PDO") {
                $this->_buffer .= "define('CORE_PDO', CORE . 'PDO'.DIRECTORY_SEPARATOR);" . PHP_EOL;
                $this->_buffer .= "define('CORE_PDO_INTERFACES', CORE_PDO . 'interfaces'.DIRECTORY_SEPARATOR);" . PHP_EOL;
            } elseif ($database === "POSTGRE") {
                $this->_buffer .= "define('CORE_POSTGRE', CORE . 'Postgre'.DIRECTORY_SEPARATOR);" . PHP_EOL;
                $this->_buffer .= "define('CORE_POSTGRE_INTERFACES', CORE_POSTGRE . 'interfaces'.DIRECTORY_SEPARATOR);" . PHP_EOL;
            } elseif ($database === "SQLITE") {
                $this->_buffer .= "define('CORE_SQLITE', CORE . 'SQLite'.DIRECTORY_SEPARATOR);" . PHP_EOL;
                $this->_buffer .= "define('CORE_SQLITE_INTERFACES', CORE_SQLITE . 'interfaces'.DIRECTORY_SEPARATOR);" . PHP_EOL;
            } elseif ($database === "SQLITE3") {
                $this->_buffer .= "define('CORE_SQLITE3', CORE . 'SQLite3'.DIRECTORY_SEPARATOR);" . PHP_EOL;
                $this->_buffer .= "define('CORE_SQLITE3_INTERFACES', CORE_SQLITE3 . 'interfaces'.DIRECTORY_SEPARATOR);" . PHP_EOL;
            } elseif ($database === "SQLSRV") {
                $this->_buffer .= "define('CORE_SQLSRV', CORE . 'SQLSRV'.DIRECTORY_SEPARATOR);" . PHP_EOL;
                $this->_buffer .= "define('CORE_SQLSRV_INTERFACES', CORE_SQLSRV . 'interfaces'.DIRECTORY_SEPARATOR);" . PHP_EOL;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": unsupported database.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** addAgency
     *
     * @return void
     */
    protected function addAgency()
    {
        $this->_buffer .= "define('AGENCIES', BASE_URI . 'agencies'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('AGENCIES_CUSTOM', AGENCIES . 'custom'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('AGENCIES_DECORATORS', AGENCIES . 'decorators'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('AGENCIES_DECORATORS_INTERFACES', AGENCIES_DECORATORS . 'interfaces'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('AGENCIES_GENERATED', AGENCIES . 'generated'.DIRECTORY_SEPARATOR);" . PHP_EOL.PHP_EOL;
    }

    /** addJSONAgencyBlock
     *
     * @return void
     */
    protected function addJSONAgencyBlock()
    {
        $this->_buffer .= "define('AGENCIES_JSON', AGENCIES . 'json'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('AGENCIES_JSON_REQUEST', AGENCIES_JSON . 'request'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('AGENCIES_JSON_GET_REQUEST', AGENCIES_JSON_REQUEST . 'get'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('AGENCIES_JSON_PATCH_REQUEST', AGENCIES_JSON_REQUEST . 'patch'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('AGENCIES_JSON_POST_REQUEST', AGENCIES_JSON_REQUEST . 'post'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('AGENCIES_JSON_PUT_REQUEST', AGENCIES_JSON_REQUEST . 'put'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('AGENCIES_JSON_RESPONSE', AGENCIES_JSON . 'response'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('AGENCIES_JSON_GET_RESPONSE', AGENCIES_JSON_RESPONSE . 'get'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('AGENCIES_JSON_PATCH_RESPONSE', AGENCIES_JSON_RESPONSE . 'patch'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('AGENCIES_JSON_POST_RESPONSE', AGENCIES_JSON_RESPONSE . 'post'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('AGENCIES_JSON_PUT_RESPONSE', AGENCIES_JSON_RESPONSE . 'put'.DIRECTORY_SEPARATOR);" . PHP_EOL.PHP_EOL;
    }

    /** addControllersBlock
     *
     * @return void
     */
    protected function addControllersBlock()
    {
        $this->_buffer .= "define('CONTROLLERS', BASE_URI . 'controllers'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('CONTROLLERS_CUSTOM', CONTROLLERS . 'custom'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('CONTROLLERS_CUSTOM_INTERFACES', CONTROLLERS_CUSTOM . 'interfaces'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('CONTROLLERS_GENERATED', CONTROLLERS . 'generated'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('CONTROLLERS_GENERATED_INTERFACES', CONTROLLERS_GENERATED . 'interfaces'.DIRECTORY_SEPARATOR);" . PHP_EOL.PHP_EOL;
    }

    /** addDocumentationBlock
     *
     * @return void
     */
    protected function addDocumentationBlock()
    {
        $this->_buffer .= "define('DOCUMENTATION', BASE_URI . 'documentation'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('DOCUMENTATION_CLOVER', DOCUMENTATION . 'clover'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('DOCUMENTATION_HTML', DOCUMENTATION . 'html'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('DOCUMENTATION_INTERNAL', DOCUMENTATION . 'internal'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('DOCUMENTATION_TESTDOX', DOCUMENTATION . 'testdox'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('DOCUMENTATION_UML', DOCUMENTATION . 'uml'.DIRECTORY_SEPARATOR);" . PHP_EOL.PHP_EOL;

        $this->_buffer .= "define('DOCUMENTATION_UML_AGENCIES', DOCUMENTATION_UML . 'agencies'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('DOCUMENTATION_UML_AGENCIES_CUSTOM', DOCUMENTATION_UML_AGENCIES . 'custom'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('DOCUMENTATION_UML_AGENCIES_DECORATORS', DOCUMENTATION_UML_AGENCIES . 'decorators'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('DOCUMENTATION_UML_AGENCIES_GENERATED', DOCUMENTATION_UML_AGENCIES . 'generated'.DIRECTORY_SEPARATOR);" . PHP_EOL.PHP_EOL;

        $this->_buffer .= "define('DOCUMENTATION_UML_CONTROLLERS', DOCUMENTATION_UML . 'controllers'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('DOCUMENTATION_UML_CONTROLLERS_CUSTOM', DOCUMENTATION_UML_CONTROLLERS . 'custom'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('DOCUMENTATION_UML_CONTROLLERS_GENERATED', DOCUMENTATION_UML_CONTROLLERS . 'generated'.DIRECTORY_SEPARATOR);" . PHP_EOL.PHP_EOL;

        $this->_buffer .= "define('DOCUMENTATION_UML_MODELS', DOCUMENTATION_UML . 'models'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('DOCUMENTATION_UML_MODELS_CUSTOM', DOCUMENTATION_UML_MODELS . 'custom'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('DOCUMENTATION_UML_MODELS_DECORATORS', DOCUMENTATION_UML_MODELS . 'decorators'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('DOCUMENTATION_UML_MODELS_GENERATED', DOCUMENTATION_UML_MODELS . 'generated'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('DOCUMENTATION_UML_MODELS_HELPERS', DOCUMENTATION_UML_MODELS . 'helpers'.DIRECTORY_SEPARATOR);" . PHP_EOL.PHP_EOL;

        $this->_buffer .= "define('DOCUMENTATION_UML_VIEWS', DOCUMENTATION_UML . 'views'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('DOCUMENTATION_UML_VIEWS_CUSTOM', DOCUMENTATION_UML_VIEWS . 'custom'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('DOCUMENTATION_UML_VIEWS_CUSTOM_BROWSE', DOCUMENTATION_UML_VIEWS_CUSTOM . 'browse'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('DOCUMENTATION_UML_VIEWS_CUSTOM_FORMS', DOCUMENTATION_UML_VIEWS_CUSTOM . 'forms'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('DOCUMENTATION_UML_VIEWS_CUSTOM_PARTIALS', DOCUMENTATION_UML_VIEWS_CUSTOM . 'partials'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('DOCUMENTATION_UML_VIEWS_GENERATED', DOCUMENTATION_UML_VIEWS . 'generated'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('DOCUMENTATION_UML_VIEWS_GENERATED_BROWSE', DOCUMENTATION_UML_VIEWS_GENERATED . 'browse'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('DOCUMENTATION_UML_VIEWS_GENERATED_FORMS', DOCUMENTATION_UML_VIEWS_GENERATED . 'forms'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('DOCUMENTATION_UML_VIEWS_GENERATED_PARTIALS', DOCUMENTATION_UML_VIEWS_GENERATED . 'partials'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= PHP_EOL;
    }

    /** addDatabaseBlock
     *
     * @return void
     */
    protected function addDatabaseBlock()
    {
        $this->_buffer .= "define('DATABASE', BASE_URI.'database'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('DATABASE_BACKUP', DATABASE.'backup'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('DATABASE_CUSTOM_STORED_PROCEDURES', DATABASE . 'custom_sprocs'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('DATABASE_VIEWS_CUSTOM', DATABASE . 'custom_views'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('DATABASE_DIAGRAMS', DATABASE.'diagrams'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('DATABASE_STORED_PROCEDURES', DATABASE . 'generated_sprocs'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('DATABASE_VIEWS', DATABASE . 'generated_views'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('DATABASE_CONNECTIONS', DATABASE.'connections'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('DATABASE_CONNECTIONS_PRODUCTION', DATABASE_CONNECTIONS.'production'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('DATABASE_CONNECTIONS_STAGING', DATABASE_CONNECTIONS.'staging'.DIRECTORY_SEPARATOR);" . PHP_EOL.PHP_EOL;
        $this->addDatabaseConnections();
    }

    /** addDatabaseConnections
     *
     * @return bool
     */
    protected function addDatabaseConnections()
    {
        try {
            if (CheckInput::checkSet($this->databasesSupported)) {
                foreach ($this->databasesSupported as $database) {
                    $this->_buffer .= 'if ( isset($live) AND $live===false ) {' . PHP_EOL;
                    $this->addStagingDatabaseConnectionsBlock($database);
                    $this->_buffer .= "} else {" . PHP_EOL;
                    $this->addProductionDatabaseConnectionsBlock($database);
                    $this->_buffer .= "}" . PHP_EOL . PHP_EOL;
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": databasesSupported required.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** addDatabaseConnectionsBlock
     *
     * @param string $database a valid database type
     *
     * @return bool
     */
    protected function addStagingDatabaseConnectionsBlock($database)
    {
        try {
            if (CheckInput::checkSet($database)) {
                $this->_buffer .= "    define('" . $database . "_BROWSE', DATABASE_CONNECTIONS_STAGING.'" . strtolower($database) . "_browse.inc.php');" . PHP_EOL;
                $this->_buffer .= "    define('" . $database . "', DATABASE_CONNECTIONS_STAGING.'" . strtolower($database) . "_user.inc.php');" . PHP_EOL;
                $this->_buffer .= "    define('" . $database . "_ADMIN', DATABASE_CONNECTIONS_STAGING.'" . strtolower($database) . "_Adm1n.inc.php');" . PHP_EOL;
                $this->_buffer .= "    define('" . $database . "_POWER_USER', DATABASE_CONNECTIONS_STAGING.'" . strtolower($database) . "_pwrUser.inc.php');" . PHP_EOL;
            } else {
                throw new ExceptionHandler(__METHOD__ . ":some message.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** addProductionDatabaseConnectionsBlock
     *
     * @param string $database a valid database type
     *
     * @return bool
     */
    protected function addProductionDatabaseConnectionsBlock($database)
    {
        try {
            if (CheckInput::checkSet($database)) {
                $this->_buffer .= "    define('" . $database . "_BROWSE', DATABASE_CONNECTIONS_PRODUCTION.'" . strtolower($database) . "_browse.inc.php');" . PHP_EOL;
                $this->_buffer .= "    define('" . $database . "', DATABASE_CONNECTIONS_PRODUCTION.'" . strtolower($database) . "_user.inc.php');" . PHP_EOL;
                $this->_buffer .= "    define('" . $database . "_ADMIN', DATABASE_CONNECTIONS_PRODUCTION.'" . strtolower($database) . "_Adm1n.inc.php');" . PHP_EOL;
                $this->_buffer .= "    define('" . $database . "_POWER_USER', DATABASE_CONNECTIONS_PRODUCTION.'".strtolower($database)."_pwrUser.inc.php');" . PHP_EOL;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": database required.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** addIncludesBlock
     *
     * @return void
     */
    protected function addIncludesBlock()
    {
        $this->_buffer .= "define('INCLUDES', BASE_URI . 'includes'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('BOOKENDS', INCLUDES . 'bookends'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('INC_PHP', INCLUDES . 'inc'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('LAYOUTS', INCLUDES . 'layouts'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('PRELOADERS', INCLUDES . 'preloaders'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= PHP_EOL;
    }

    /** addLib
     *
     * @return void
     */
    protected function addLib()
    {
        $this->_buffer .= "define('LIB', BASE_URI . 'lib'.DIRECTORY_SEPARATOR);" . PHP_EOL.PHP_EOL;
        $this->_buffer .= "define('MOBILE', BASE_URI . 'mobile'.DIRECTORY_SEPARATOR);" . PHP_EOL.PHP_EOL;
    }

    /** addLogBlock
     *
     * @return void
     */
    protected function addLogBlock()
    {
        $this->_buffer .= "define('LOG', BASE_URI . 'log'.DIRECTORY_SEPARATOR);" . PHP_EOL.PHP_EOL;
        $this->_buffer .= "define('LOG_DATABASE', LOG . 'database'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('LOG_DATABASE_BACKUP', LOG_DATABASE . 'backup'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('LOG_DATABASE_ERROR', LOG_DATABASE . 'error'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('LOG_DATABASE_QUERY', LOG_DATABASE . 'query'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('LOG_DATABASE_WARNING', LOG_DATABASE . 'warning'.DIRECTORY_SEPARATOR);" . PHP_EOL . PHP_EOL;
        $this->_buffer .= "define('LOG_SYSTEM', LOG . 'system'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('LOG_ACCESS', LOG_SYSTEM . 'access'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('LOG_EMAIL', LOG_SYSTEM . 'email'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('LOG_ERROR', LOG_SYSTEM . 'error'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('LOG_MALICIOUS', LOG_SYSTEM . 'malicious'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('LOG_SLOW', LOG_SYSTEM . 'slow'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('LOG_UPDATE', LOG_SYSTEM . 'update'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('LOG_VIRUS', LOG_SYSTEM . 'virus'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('LOG_WARNING', LOG_SYSTEM . 'warning'.DIRECTORY_SEPARATOR);" . PHP_EOL.PHP_EOL;
    }

    /** addModelsBlock
     *
     * @return void
     */
    protected function addModelsBlock()
    {
        $this->_buffer .= "define('MODELS', BASE_URI . 'models'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('MODELS_GENERATED', MODELS .'generated'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('MODELS_GENERATED_INTERFACES', MODELS_GENERATED . 'interfaces'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('MODELS_DECORATORS', MODELS .'decorators'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('MODELS_DECORATORS_INTERFACES', MODELS_DECORATORS . 'interfaces'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('MODELS_HELPERS', MODELS . 'helpers'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('MODELS_HELPERS_INTERFACES', MODELS_HELPERS . 'interfaces'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('MODELS_CUSTOM', MODELS . 'custom'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('MODELS_CUSTOM_INTERFACES', MODELS_CUSTOM . 'interfaces'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= PHP_EOL;
    }

    /** addJSONModelBlock
     *
     * @return void
     */
    protected function addJSONModelBlock()
    {
        $this->_buffer .= "define('MODELS_JSON', MODELS . 'json'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('MODELS_JSON_REQUEST', MODELS_JSON . 'request'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('MODELS_JSON_GET_REQUEST', MODELS_JSON_REQUEST . 'get'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('MODELS_JSON_PATCH_REQUEST', MODELS_JSON_REQUEST . 'patch'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('MODELS_JSON_POST_REQUEST', MODELS_JSON_REQUEST . 'post'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('MODELS_JSON_PUT_REQUEST', MODELS_JSON_REQUEST . 'put'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('MODELS_JSON_RESPONSE', MODELS_JSON . 'response'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('MODELS_JSON_GET_RESPONSE', MODELS_JSON_RESPONSE . 'get'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('MODELS_JSON_PATCH_RESPONSE', MODELS_JSON_RESPONSE . 'patch'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('MODELS_JSON_POST_RESPONSE', MODELS_JSON_RESPONSE . 'post'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('MODELS_JSON_PUT_RESPONSE', MODELS_JSON_RESPONSE . 'put'.DIRECTORY_SEPARATOR);" . PHP_EOL.PHP_EOL;
    }

    /** addBehaviourSpecFolders
     *
     */
    protected function addBehaviourSpecFolders()
    {
        $this->_buffer .= "define('SPEC', BASE_URI . 'spec'.DIRECTORY_SEPARATOR);" . PHP_EOL.PHP_EOL;
    }
    /** addViewsBlock
     *
     * @return void
     */
    protected function addViewsBlock()
    {
        $this->_buffer .= "define('VIEWS', BASE_URI . 'views'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('VIEWS_CUSTOM', VIEWS . 'custom'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('VIEWS_CUSTOM_BROWSE', VIEWS_CUSTOM . 'browse'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('VIEWS_CUSTOM_FORMS', VIEWS_CUSTOM . 'forms'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('VIEWS_CUSTOM_PARTIALS', VIEWS_CUSTOM . 'partials'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('VIEWS_GENERATED', VIEWS . 'generated'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('VIEWS_GENERATED_BROWSE', VIEWS_GENERATED . 'browse'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('VIEWS_GENERATED_FORMS', VIEWS_GENERATED . 'forms'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('VIEWS_GENERATED_PARTIALS', VIEWS_GENERATED . 'partials'.DIRECTORY_SEPARATOR);" . PHP_EOL.PHP_EOL;
    }

    /** addTestsBlock
     *
     */
    protected function addTestsBlock()
    {
        $this->_buffer .= "define('TESTS', BASE_URI . 'tests'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('TESTS_ACCEPTANCE', TESTS . 'acceptance'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('TESTS_ACCEPTANCE_ABSTRACT', TESTS_ACCEPTANCE . 'abstract'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('TESTS_CONFIG', TESTS . 'config'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('TESTS_INTEGRATION', TESTS . 'integration'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('TESTS_INTEGRATION_ABSTRACT', TESTS_INTEGRATION . 'abstract'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('TESTS_UNIT', TESTS . 'unit'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('TESTS_UNIT_ABSTRACT', TESTS_UNIT . 'abstract'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('TESTS_UNIT_AGENCIES', TESTS_UNIT . 'agencies'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('TESTS_UNIT_AGENCIES_CUSTOM', TESTS_UNIT_AGENCIES . 'custom'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('TESTS_UNIT_AGENCIES_DECORATORS', TESTS_UNIT_AGENCIES . 'decorators'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('TESTS_UNIT_AGENCIES_GENERATED', TESTS_UNIT_AGENCIES . 'generated'.DIRECTORY_SEPARATOR);" . PHP_EOL.PHP_EOL;
        $this->_buffer .= "define('TESTS_UNIT_CONTROLLERS', TESTS_UNIT . 'controllers'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('TESTS_UNIT_CONTROLLERS_CUSTOM', TESTS_UNIT_CONTROLLERS . 'custom'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('TESTS_UNIT_CONTROLLERS_GENERATED', TESTS_UNIT_CONTROLLERS . 'generated'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('TESTS_UNIT_DATABASE', TESTS_UNIT . 'database'.DIRECTORY_SEPARATOR);" . PHP_EOL.PHP_EOL;
        $this->_buffer .= "define('TESTS_UNIT_DATABASE_CONNECTIONS', TESTS_UNIT_DATABASE . 'connections'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('TESTS_UNIT_DATABASE_CONNECTIONS_PRODUCTION', TESTS_UNIT_DATABASE_CONNECTIONS . 'production'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('TESTS_UNIT_DATABASE_CONNECTIONS_STAGING', TESTS_UNIT_DATABASE_CONNECTIONS . 'staging'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('TESTS_UNIT_DATABASE_CUSTOM_SPROCS', TESTS_UNIT_DATABASE . 'custom_sprocs'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('TESTS_UNIT_DATABASE_VIEWS_CUSTOM', TESTS_UNIT_DATABASE . 'custom_views'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('TESTS_UNIT_DATABASE_GENERATED_SPROCS', TESTS_UNIT_DATABASE . 'generated_sprocs'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('TESTS_UNIT_DATABASE_VIEWS_GENERATED', TESTS_UNIT_DATABASE . 'generated_views'.DIRECTORY_SEPARATOR);" . PHP_EOL.PHP_EOL;
        $this->_buffer .= "define('TESTS_UNIT_MODELS', TESTS_UNIT . 'models'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('TESTS_UNIT_MODELS_CUSTOM', TESTS_UNIT_MODELS . 'custom'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('TESTS_UNIT_MODELS_CUSTOM_INTERFACES', TESTS_UNIT_MODELS_CUSTOM . 'interfaces'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('TESTS_UNIT_MODELS_DECORATORS', TESTS_UNIT_MODELS . 'decorators'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('TESTS_UNIT_MODELS_DECORATORS_INTERFACES', TESTS_UNIT_MODELS_DECORATORS . 'interfaces'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('TESTS_UNIT_MODELS_GENERATED', TESTS_UNIT_MODELS . 'generated'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('TESTS_UNIT_MODELS_GENERATED_INTERFACES', TESTS_UNIT_MODELS_GENERATED . 'interfaces'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('TESTS_UNIT_MODELS_HELPERS', TESTS_UNIT_MODELS . 'helpers'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('TESTS_UNIT_MODELS_HELPERS_INTERFACES', TESTS_UNIT_MODELS . 'interfaces'.DIRECTORY_SEPARATOR);" . PHP_EOL.PHP_EOL;
        $this->_buffer .= "define('TESTS_UNIT_VIEWS', TESTS_UNIT . 'views'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('TESTS_UNIT_VIEWS_CUSTOM', TESTS_UNIT_VIEWS . 'views'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('TESTS_UNIT_VIEWS_CUSTOM_BROWSE', TESTS_UNIT_VIEWS_CUSTOM . 'browse'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('TESTS_UNIT_VIEWS_CUSTOM_FORMS', TESTS_UNIT_VIEWS_CUSTOM . 'forms'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('TESTS_UNIT_VIEWS_CUSTOM_PARTIALS', TESTS_UNIT_VIEWS_CUSTOM . 'partials'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('TESTS_UNIT_VIEWS_GENERATED', TESTS_UNIT_VIEWS . 'views'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('TESTS_UNIT_VIEWS_GENERATED_BROWSE', TESTS_UNIT_VIEWS_GENERATED . 'browse'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('TESTS_UNIT_VIEWS_GENERATED_FORMS', TESTS_UNIT_VIEWS_GENERATED . 'forms'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('TESTS_UNIT_VIEWS_GENERATED_PARTIALS', TESTS_UNIT_VIEWS_GENERATED . 'partials'.DIRECTORY_SEPARATOR);" . PHP_EOL.PHP_EOL;

    }


    /** addVendor
     *
     * @return void
     */
    protected function addVendor()
    {
        $this->_buffer .= "define('VAGRANT', BASE_URI . 'vagrant'.DIRECTORY_SEPARATOR);" . PHP_EOL;
        $this->_buffer .= "define('VENDOR', BASE_URI . 'vendor'.DIRECTORY_SEPARATOR);" . PHP_EOL;
    }

    /** writeFromBuffer
     *
     * @return bool
     */
    protected function writeFromBuffer()
    {
        try {
            if ( CheckInput::checkNewInput($this->_buffer) ) {
                if ( $this->checkRequired() ) {
                    if ( $this->production === true) {
                        $this->_FileHandle = new FileHandle($this->baseURI . "config" . DIRECTORY_SEPARATOR ."production".DIRECTORY_SEPARATOR. $this->appName . ".config.inc.php");
                    } else {
                        $this->_FileHandle = new FileHandle($this->baseURI . "config" . DIRECTORY_SEPARATOR . "staging" . DIRECTORY_SEPARATOR . $this->appName . ".config.inc.php");
                    }
                    $this->_FileHandle->writeFull($this->_buffer);
                } else {
                    throw new ExceptionHandler(__METHOD__ . ": requirements not met.");
                }
            } else {
                throw new ExceptionHandler(__METHOD__."The buffer is empty.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkRequired
     *
     * @return bool
     */
    protected function checkRequired()
    {
        try {
            if (CheckInput::checkSet($this->appName)) {
                if ( !CheckInput::checkSet($this->baseURI) ) {
                    throw new ExceptionHandler(__METHOD__ . ": baseURI required.");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": appName required.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }
}
/* Coworks.In
$cfGen = ConfigurationGenerator::instance();
$cfGen->setAppName("Coworks.In");
$cfGen->setAppWebsite("coworks.in");
$cfGen->setBaseURI("/var/www/Coworks.In/");
$cfGen->setBaseURL("http://coworks.in");
$cfGen->execute();
*/
/* InnerAlly */
$cfGen = ConfigurationGenerator::instance();
$cfGen->setAppName("InnerAlly");
$cfGen->setAppWebsite("InnerAlly.com");
$cfGen->setBaseURI("/var/www/InnerAlly_SC/");
$cfGen->setBaseURL("http://innerally.com");
$cfGen->setDatabasesSupported(array("MYSQLI","SQLITE3"));
$cfGen->execute();
