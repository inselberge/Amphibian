<?php
/**
 * PHP Version 5.4.9-4ubuntu2.2
 * Created by PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 11/1/13
 * Time: 8:36 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once "interfaces".DIRECTORY_SEPARATOR."APIRequestInterface.php";
/**
 * Class APIRequest
 *
 * @category API
 * @package  APIRequest
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/Amphibian/documentation/APIRequest
 */
class APIRequest 
    implements APIRequestInterface
{
    /**
     * @var string application the application key
     */
    protected $application;
    /**
     * @var string key the APIKey for the user
     */
    protected $key;
    /**
     * @var float timestamp $_SERVER["REQUEST_TIME_FLOAT"]
     */
    protected $timestamp;
    /**
     * @var string branch either "api", or a branch of the current site
     */
    protected $branch;
    /**
     * @var string type holds the value for the model or agency to use
     */
    protected $type;
    /**
     * @var string action holds the specific action to call
     */
    protected $action;
    /**
     * @var array arguments all the arguments for the request
     */
    protected $arguments;
    /**
     * @var object APIRequest a singleton instance of this class
     */
    static public $APIRequest;

    /** __construct
     */
    protected function __construct()
    {
        $this->timestamp = $_SERVER["REQUEST_TIME_FLOAT"];
        $this->arguments = [];
    }

    /** instance
     *
     * @return APIRequest|object
     */
    static public function instance()
    {
        if ( !isset(self::$APIRequest) ) {
            self::$APIRequest = new APIRequest(); 
        }
        return self::$APIRequest;
    }

    /** factory
     *
     * @return APIRequest
     */
    static public function factory()
    {
        return new APIRequest();
    }

    /**  setAction
     *
     * @param string $action holds the specific action to call
     *
     * @return boolean
     */
    public function setAction( $action )
    {
        try {
            if ( CheckInput::checkNewInput($action) ) {
                $this->action = $action;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": action is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getAction
     *
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**  setApplication
     *
     * @param string $application the application key
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

    /**  setArguments
     *
     * @param array $arguments all the arguments for the request
     *
     * @return boolean
     */
    public function setArguments( $arguments )
    {
        try {
            if ( CheckInput::checkNewInput($arguments) ) {
                $this->arguments = $arguments;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": arguments is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getArguments
     *
     * @return array
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**  setBranch
     *
     * @param string $branch either "api", or a branch of the current site
     *
     * @return boolean
     */
    public function setBranch( $branch )
    {
        try {
            if ( CheckInput::checkNewInput($branch) ) {
                $this->branch = $branch;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": branch is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getBranch
     *
     * @return string
     */
    public function getBranch()
    {
        return $this->branch;
    }

    /**  setKey
     *
     * @param string $key the APIKey for the user
     *
     * @return boolean
     */
    public function setKey( $key )
    {
        try {
            if ( CheckInput::checkNewInput($key) ) {
                $this->key = $key;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": key is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getKey
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**  setType
     *
     * @param string $type the value for the model or agency to use
     *
     * @return boolean
     */
    public function setType( $type )
    {
        try {
            if ( CheckInput::checkNewInput($type) ) {
                $this->type = $type;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": type is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getType
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**  setTimestamp
     *
     * @param float $timestamp $_SERVER["REQUEST_TIME_FLOAT"]
     *
     * @return boolean
     */
    public function setTimestamp( $timestamp )
    {
        try {
            if ( CheckInput::checkNewInput($timestamp) ) {
                $this->timestamp = $timestamp;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": timestamp is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getTimestamp
     *
     * @return float
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

} 