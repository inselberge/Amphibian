<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Carl "Tex" Morgan
 * Date: 3/13/13
 * Time: 11:51 AM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."config.inc.php";
require_once AMPHIBIAN_CORE_NEUTRAL . "CheckInput.php";
require_once AMPHIBIAN_CORE_NEUTRAL . "DirectoryExtended.php";
require_once "interfaces".DIRECTORY_SEPARATOR."architectureGeneratorInterface.php";
/**
 * Class ArchitectureGenerator
 *
 * @category Generator
 * @package  Architecture
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/Amphibian/documentation/ArchitectureGenerator
 */
class ArchitectureGenerator
    extends CheckInput
    implements ArchitectureGeneratorInterface
{
    /**
     * @var array _baseAgencies holds the agency directories
     */
    private static $_baseAgencies = [
        "agencies",
        "agencies/abstracts",
        "agencies/abstracts/interfaces",
        "agencies/custom",
        "agencies/custom/interfaces",
        "agencies/decorators",
        "agencies/decorators/interfaces",
        "agencies/generated",
        "agencies/generated/interfaces"
    ];

    /**
     * @var array _JSONAgencies
     */
    private static $_JSONAgencies = [
        "agencies/json",
        "agencies/json/request",
        "agencies/json/request/post",
        "agencies/json/request/put",
        "agencies/json/request/get",
        "agencies/json/request/patch",
        "agencies/json/response",
        "agencies/json/response/post",
        "agencies/json/response/put",
        "agencies/json/response/get",
        "agencies/json/response/patch"
    ];
    /**
     * @var array _baseAgenciesTests holds the agencies tests directories
     */
    private static $_baseAgenciesTests = [
        "tests/acceptance/agencies",
        "tests/acceptance/agencies/abstracts",
        "tests/acceptance/agencies/custom",
        "tests/acceptance/agencies/decorators",
        "tests/acceptance/agencies/generated",
        "tests/integration/agencies",
        "tests/integration/agencies/abstracts",
        "tests/integration/agencies/custom",
        "tests/integration/agencies/decorators",
        "tests/integration/agencies/generated",
        "tests/unit/agencies",
        "tests/unit/agencies/abstracts",
        "tests/unit/agencies/custom",
        "tests/unit/agencies/decorators",
        "tests/unit/agencies/generated"
    ];
    /**
     * @var array _baseControllers holds the controller base directories
     */
    private static $_baseControllers = [
        "controllers",
        "controllers/abstracts",
        "controllers/abstracts/interfaces",
        "controllers/custom",
        "controllers/generated"
    ];
    /**
     * @var array _baseControllersCustom holds the controllers custom interfaces
     */
    private static $_baseControllersCustom = [
        "controllers/custom/interfaces"
    ];
    /**
     * @var array _baseControllersGenerated holds the controllers gen interfaces
     */
    private static $_baseControllersGenerated = [
        "controllers/generated/interfaces"
    ];
    /**
     * @var array _baseControllerTests holds the controllers test directories
     */
    private static $_baseControllerTests = [
        "tests/acceptance/controllers",
        "tests/acceptance/controllers/abstracts",
        "tests/acceptance/controllers/custom",
        "tests/acceptance/controllers/generated",
        "tests/integration/controllers",
        "tests/integration/controllers/abstracts",
        "tests/integration/controllers/custom",
        "tests/integration/controllers/generated",
        "tests/unit/controllers",
        "tests/unit/controllers/abstracts",
        "tests/unit/controllers/custom",
        "tests/unit/controllers/generated"
    ];

    /**
     * @var array _baseDatabase holds the database base directories
     */
    private static $_baseDatabase = [
        "database",
        "database/backup",
        "database/connections",
        "database/connections/production",
        "database/connections/staging",
        "database/custom_sprocs",
        "database/custom_views",
        "database/diagrams",
        "database/generated_sprocs",
        "database/generated_views"
    ];
    /**
     * @var array _baseDatabaseTests holds the database test directories
     */
    private static $_baseDatabaseTests = [
        "tests/unit/database",
        "tests/unit/database/connections",
        "tests/unit/database/connections/production",
        "tests/unit/database/connections/staging",
        "tests/unit/database/custom_sprocs",
        "tests/unit/database/custom_views",
        "tests/unit/database/generated_sprocs",
        "tests/unit/database/generated_views"
    ];

    /**
     * @var array _baseDocumentation
     */
    private static $_baseDocumentation = [
        "documentation",
        "documentation/clover",
        "documentation/html",
        "documentation/internal",
        "documentation/testdox",
        "documentation/uml",
        "documentation/uml/agencies",
        "documentation/uml/agencies/custom",
        "documentation/uml/agencies/decorators",
        "documentation/uml/agencies/generated",
        "documentation/uml/controllers",
        "documentation/uml/controllers/custom",
        "documentation/uml/controllers/generated",
        "documentation/uml/models",
        "documentation/uml/models/custom",
        "documentation/uml/models/decorators",
        "documentation/uml/models/generated",
        "documentation/uml/models/helpers",
        "documentation/uml/views",
        "documentation/uml/views/custom",
        "documentation/uml/views/custom/browse",
        "documentation/uml/views/custom/forms",
        "documentation/uml/views/custom/partials",
        "documentation/uml/views/generated",
        "documentation/uml/views/generated/browse",
        "documentation/uml/views/generated/forms",
        "documentation/uml/views/generated/partials"
    ];
    /**
     * @var array _baseHTML holds values for $ArchitectureGenerator->_baseHTML
     */
    private static $_baseHTML = [
        "html", 
        "html/css", 
        "html/image", 
        "html/js"
    ];
    /**
     * @var array _baseLog holds values for $ArchitectureGenerator->_baseLog
     */
    private static $_baseLog = [
        "log",
        "log/system",
        "log/system/access",
        "log/system/error",
        "log/system/email",
        "log/system/malicious",
        "log/system/slow",
        "log/system/update",
        "log/system/virus",
        "log/system/warning",
        "log/database",
        "log/database/query",
        "log/database/backup",
        "log/database/warning",
        "log/database/error"
    ];
    /**
     * @var array _baseIncludes the base include directories
     */
    private static $_baseIncludes = [
        "includes", 
        "includes/bookends", 
        "includes/inc",
        "includes/layouts",
        "includes/preloaders"
    ];
    /**
     * @var array _baseModels the base model directories
     */
    private static $_baseModels = [
        "models",
        "models/abstracts",
        "models/custom",
        "models/decorators",
        "models/generated",
        "models/helpers"
    ];

    /**
     * @var array _JSONModels the JSON model directories
     */
    private static $_JSONModels = [
        "models/json",
        "models/json/request",
        "models/json/request/post",
        "models/json/request/put",
        "models/json/request/get",
        "models/json/request/patch",
        "models/json/response",
        "models/json/response/post",
        "models/json/response/put",
        "models/json/response/get",
        "models/json/response/patch"
    ];

    /**
     * @var array _baseModelInterfaces the model interface directories
     */
    private static $_baseModelInterfaces = [
        "models/abstracts/interfaces/",
        "models/custom/interfaces/",
        "models/decorators/interfaces/",
        "models/generated/interfaces/",
        "models/helpers/interfaces/"
    ];
    /**
     * @var array _baseModelTests the model tests directories
     */
    private static $_baseModelTests = [
        "tests/acceptance/models",
        "tests/acceptance/models/abstracts",
        "tests/acceptance/models/custom",
        "tests/acceptance/models/decorators",
        "tests/acceptance/models/generated",
        "tests/acceptance/models/helpers",
        "tests/integration/models",
        "tests/integration/models/abstracts",
        "tests/integration/models/custom",
        "tests/integration/models/decorators",
        "tests/integration/models/generated",
        "tests/integration/models/helpers",
        "tests/unit/models",
        "tests/unit/models/abstracts",
        "tests/unit/models/custom",
        "tests/unit/models/decorators",
        "tests/unit/models/generated",
        "tests/unit/models/helpers",
    ];
    /**
     * @var array _baseViews the base view directories
     */
    private static $_baseViews = [
        "views", 
        "views/custom", 
        "views/generated",
        "tests/unit/views"
    ];
    /**
     * @var array _baseViewsCustom the base custom browse directories
     */
    private static $_baseViewsCustom = [
        "views/custom/browse", 
        "views/custom/forms", 
        "views/custom/partials"
    ];
    /**
     * @var array _baseViewTestsCustom the view custom tests directories
     */
    private static $_baseViewTestsCustom = [
        "tests/unit/views/custom/",
        "tests/unit/views/custom/browse",
        "tests/unit/views/custom/forms",
        "tests/unit/views/custom/partials"
    ];
    /**
     * @var array _baseViewsGenerated the generated views base directories
     */
    private static $_baseViewsGenerated = [
        "views/generated/browse",
        "views/generated/forms",
        "views/generated/partials"
    ];
    /**
     * @var array _baseViewTestsGenerated the generated view test directories
     */
    private static $_baseViewTestsGenerated = [
        "tests/acceptance/views/generated/",
        "tests/acceptance/views/generated/browse",
        "tests/acceptance/views/generated/forms",
        "tests/acceptance/views/generated/partials",
        "tests/integration/views/generated/",
        "tests/integration/views/generated/browse",
        "tests/integration/views/generated/forms",
        "tests/integration/views/generated/partials",
        "tests/unit/views/generated/",
        "tests/unit/views/generated/browse",
        "tests/unit/views/generated/forms",
        "tests/unit/views/generated/partials"
    ];

    /**
     * @var array _baseTests an array of base tests
     */
    private static $_baseTests = [
        "tests",
        "tests/acceptance",
        "tests/config",
        "tests/integration",
        "tests/unit",
    ];
    /**
     * @var array _baseTopLevelOnly holds values for $ArchitectureGenerator->_baseTopLevelOnly
     */
    private static $_baseTopLevelOnly = [
        "vendor", 
        "lib", 
        "config",
        "config/production",
        "config/staging",
        "core",
        "mobile",
        "vagrant"
    ];
    /**
     * @var string _baseURI holds value base URI
     */
    private $_baseURI;
    /**
     * @var string _currentDirectory the current directory to create
     */
    private $_currentDirectory;
    /**
     * @var int _directoryPermission the permission level for the directory
     */
    private $_directoryPermission;
    /**
     * @var string directoryName the name of the directory to use
     */
    protected $directoryName;
    /**
     * @var array directoryList an array of directories to use
     */
    protected $directoryList;

    /** __construct
     *
     * @param string $URI a valid URI
     */
    public function __construct( $URI )
    {
        try {
            if ( $this->checkNewInput($URI) ) {
                $this->_baseURI = $URI;
                if ( !$this->_checkSlash($URI) ) {
                    $this->_baseURI .= '/';
                }
                $this->_directoryPermission = 0755;
            } else {
                throw new ExceptionHandler(": The new value is null.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** _checkSlash
     *
     * @param string $URI a valid URI
     *
     * @return bool
     */
    private function _checkSlash( $URI )
    {
        if ( substr($URI, -1) === '/' ) {
            return true;
        } else {
            return false;
        }
    }

    /** setDirectoryName
     *
     * @param string $name the name of the directory to use
     *
     * @return bool
     */
    public function setDirectoryName( $name )
    {
        try {
            if ( $this->checkNewInput($name) ) {
                $this->directoryName = $name;
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setDirectoryList
     *
     * @param array $list the directories to use
     *
     * @return bool
     */
    public function setDirectoryList( array $list )
    {
        try {
            if ( $this->checkNewInput($list) ) {
                if ( is_array($list) ) {
                    $this->directoryList = $list;
                } else {
                    throw new ExceptionHandler(":list is not an array.");
                }
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** execute
     *
     * @return void
     */
    public function execute()
    {
        //$this->makeSoftLinkToDocumentRoot();
        if ( count($this->directoryList) > 0 ) {
            //user: multiple instances
        } else {
            //default: initial setup
            $this->_prepareInitialRun();
        }
        $this->_iterate();
    }

    /** _iterate
     *
     * @return void
     */
    private function _iterate()
    {
        $this->_currentDirectory = new DirectoryExtended();
        $this->_appendBaseURI();
        $this->_currentDirectory->setDirectoryList($this->directoryList);
        $this->_currentDirectory->setDirectoryPermissions($this->_directoryPermission);
        $this->_currentDirectory->execute();
    }

    /** _prepareInitialRun
     *
     * @return void
     */
    private function _prepareInitialRun()
    {
        $this->directoryList = [];
        $this->directoryList = array_merge($this->directoryList, self::$_baseTests);
        $this->directoryList = array_merge($this->directoryList,self::$_baseAgencies);
        $this->directoryList = array_merge($this->directoryList,self::$_JSONAgencies);
        $this->directoryList = array_merge($this->directoryList,self::$_baseDocumentation);
        $this->directoryList = array_merge($this->directoryList,self::$_baseAgenciesTests);
        $this->directoryList = array_merge($this->directoryList,self::$_baseControllers);
        $this->directoryList = array_merge($this->directoryList,self::$_baseControllerTests);
        $this->directoryList = array_merge($this->directoryList, self::$_baseControllersCustom);
        $this->directoryList = array_merge($this->directoryList, self::$_baseControllersGenerated);
        $this->directoryList = array_merge($this->directoryList, self::$_baseDatabase);
        $this->directoryList = array_merge($this->directoryList, self::$_baseDatabaseTests);
        $this->directoryList = array_merge($this->directoryList, self::$_baseHTML);
        $this->directoryList = array_merge($this->directoryList, self::$_baseIncludes);
        $this->directoryList = array_merge($this->directoryList, self::$_baseLog);
        $this->directoryList = array_merge($this->directoryList, self::$_baseModels);
        $this->directoryList = array_merge($this->directoryList, self::$_baseModelInterfaces);
        $this->directoryList = array_merge($this->directoryList, self::$_baseModelTests);
        $this->directoryList = array_merge($this->directoryList, self::$_JSONModels);
        $this->directoryList = array_merge($this->directoryList, self::$_baseViews);
        $this->directoryList = array_merge($this->directoryList, self::$_baseViewsCustom);
        $this->directoryList = array_merge($this->directoryList, self::$_baseViewTestsCustom);
        $this->directoryList = array_merge($this->directoryList, self::$_baseViewsGenerated);
        $this->directoryList = array_merge($this->directoryList, self::$_baseViewTestsGenerated);
        $this->directoryList = array_merge($this->directoryList, self::$_baseTopLevelOnly);
    }

    /** _appendBaseURI
     *
     * @return bool
     */
    private function _appendBaseURI()
    {
        try {
            foreach ( $this->directoryList as $key =>$value ) {
                    $this->directoryList[$key] = $this->_baseURI . $value;
            }
        } catch ( ExceptionHandler $e ) {
            echo utf8_encode(date('Y-m-d H:i:s') . " " . __METHOD__ . ": " . $e);
            return false;
        }
        return true;
    }
}
/*
//require_once AMPHIBIAN_CONFIG."InnerAlly.config.inc.php";
//require_once AMPHIBIAN_PROJECT."Coworks.In/config/staging/Coworks.In.config.inc.php";
$ag = new ArchitectureGenerator(BASE_URI);
$ag->execute();
*/
$ag = new ArchitectureGenerator("/home/texmorgan/Public/Heimdall");
$ag->execute();