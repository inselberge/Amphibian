<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Carl "Tex" Morgan
 * Date: 3/29/13
 * Time: 10:27 AM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once AMPHIBIAN_CORE_NEUTRAL . "CheckInput.php";
require_once "interfaces".DIRECTORY_SEPARATOR."databaseUserGeneratorInterface.php";
/**
 * Class DatabaseUserGenerator
 */
abstract class DatabaseUserGenerator
    extends CheckInput
    implements DatabaseUserGeneratorInterface
{
    /**
     * @var  compactedAppName
     */
    protected $compactedAppName;
    /**
     * @var  baseUserName
     */
    protected $baseUserName;
    /**
     * @var  uppercaseName
     */
    protected $uppercaseName;
    /**
     * @var  uppercaseFirstName
     */
    protected $uppercaseFirstName;
    /**
     * @var  userName
     */
    protected $userName;
    /**
     * @var  password
     */
    protected $password;
    /**
     * @var  userRights
     */
    protected $userRights;
    /**
     * @var  databaseName
     */
    protected $databaseName;
    /**
     * @var  databaseHost
     */
    protected $databaseHost;
    /**
     * @var  FileHandle
     */
    protected $FileHandle;
    /**
     * @var  content
     */
    protected $content;
    /**
     * @var  databaseQuery
     */
    protected $databaseQuery;
    /**
     * @var  databaseConnection
     */
    protected $databaseConnection;
    /**
     * @var  databaseUser
     */
    static protected $databaseUser;

    /** __construct
     *
     * @param resource $databaseConnection a valid database connection
     */
    abstract protected function __construct( $databaseConnection );

    /** __clone
     *
     * @return mixed
     */
    abstract protected function __clone();

    /** set
     *
     * @param $element
     * @param $value
     *
     * @return bool
     */
    abstract public function set( $element, $value );

    /** defaultBrowseUserRights
     *
     * @return mixed
     */
    abstract protected function defaultBrowseUserRights();

    /** defaultRegularUserRights
     *
     * @return mixed
     */
    abstract protected function defaultRegularUserRights();

    /** defaultPowerUserRights
     *
     * @return mixed
     */
    abstract protected function defaultPowerUserRights();

    /** defaultAdminUserRights
     *
     * @return mixed
     */
    abstract protected function defaultAdminUserRights();

    /** execute
     *
     * @return mixed
     */
    abstract public function execute();

    /** revoke
     *
     * @return mixed
     */
    abstract protected function revoke();

    /** drop
     *
     * @return mixed
     */
    abstract protected function drop();

    /** create
     *
     * @return mixed
     */
    abstract protected function create();

    /** setPassword
     *
     * @return mixed
     */
    abstract protected function setPassword();

    /** grant
     *
     * @return mixed
     */
    abstract protected function grant();

    /** makeUserName
     *
     * @param string $name
     *
     * @return void
     */
    public function makeUserName( $name )
    {
        if ( !isset($this->compactedAppName) ) {
            $this->compactAppName();
        }
        $this->baseUserName = $name;
        $this->userName     = $this->compactedAppName . "_" . $name;
    }

    /** checkAppNameLength
     *
     * @return bool
     */
    protected function checkAppNameLength()
    {
        if ( strlen(APP_NAME) < 9 ) {
            return true;
        } else {
            return false;
        }
    }

    /** compactAppName
     *
     * @return void
     */
    protected function compactAppName()
    {
        if ( $this->checkAppNameLength() ) {
            $this->compactedAppName = APP_NAME;
        } else {
            $this->compactedAppName = substr(APP_NAME, 0, 7);
        }
    }

    /** show
     *
     * @return void
     */
    public function show()
    {
        print_r(self::$databaseUser);
    }
}