<?php
/**
 * PHP Version 5.4.9-4ubuntu2.2
 * Created by PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 11/1/13
 * Time: 8:32 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once "interfaces".DIRECTORY_SEPARATOR."APIKeyInterface.php";
require_once AMPHIBIAN_CORE_ABSTRACT . "APIApplication.php";
require_once AMPHIBIAN_CORE_NEUTRAL . "CheckInput.php";
/**
 * Class APIKey
 *
 * @category API
 * @package  APIKey
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/Amphibian/documentation/APIKey
 */
abstract class APIKey
    implements APIKeyInterface
{
    /**
     * @var object query a valid database query object
     */
    protected $query;
    /**
     * @var object application a valid application id
     */
    protected $application;
    /**
     * @var string key the API key for the application
     */
    protected $key;
    /**
     * @var string expiration if the key expires, when
     */
    protected $expiration;
    /**
     * @var integer limit if the key has a limit, what is it
     */
    protected $limit = 0;
    /**
     * @var integer requests the current number of requests
     */
    protected $requests = 0;
    /**
     * @var integer responses the current number of responses
     */
    protected $responses = 0;

    /** __construct
     */
    public function __construct()
    {
        //good for 30 days
        $this->expiration = microtime(true)+2592000;
    }

    /**  setApplication
     *
     * @param object $application a valid APIApplication object
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
     * @return object
     */
    public function getApplication()
    {
        return $this->application;
    }

    /**  setExpiration
     *
     * @param string $expiration a valid expiration time in UTC
     *
     * @return boolean
     */
    public function setExpiration( $expiration )
    {
        try {
            if ( CheckInput::checkNewInput($expiration) ) {
                $this->expiration = $expiration;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": expiration is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getExpiration
     *
     * @return string
     */
    public function getExpiration()
    {
        return $this->expiration;
    }

    /**  setKey
     *
     * @param string $key the public key to use for accessing the API
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

    /**  setLimit
     *
     * @param int $limit the maximum number of requests
     *
     * @return boolean
     */
    public function setLimit( $limit )
    {
        try {
            if ( CheckInput::checkNewInput($limit) ) {
                $this->limit = $limit;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": limit is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getLimit
     *
     * @return int
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**  setRequests
     *
     * @param int $requests the number of requests made
     *
     * @return boolean
     */
    public function setRequests( $requests )
    {
        try {
            if ( CheckInput::checkNewInput($requests) ) {
                $this->requests = $requests;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": requests is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getRequests
     *
     * @return int
     */
    public function getRequests()
    {
        return $this->requests;
    }

    /**  setResponses
     *
     * @param int $responses the number of responses given
     *
     * @return boolean
     */
    public function setResponses( $responses )
    {
        try {
            if ( CheckInput::checkNewInput($responses) ) {
                $this->responses = $responses;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": responses is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getResponses
     *
     * @return int
     */
    public function getResponses()
    {
        return $this->responses;
    }

    /** generate
     *
     * @return bool
     */
    public function generate()
    {
        try {
            if ( CheckInput::checkSet($this->application) ) {
                $applicationKey = $this->application->getKey();
                $seed = microtime().$applicationKey;
                $this->key = hash('md2', $seed);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": application invalid.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** renew
     *
     * @return bool
     */
    public function renew()
    {
        try {
            if ( $this->checkRequired() ) {
                $this->expiration = microtime(true) + 2592000;
                if ( !$this->update() ) {
                    throw new ExceptionHandler(__METHOD__ . ": renew failed.");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": requirements not met.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** resetCounters
     *
     * @return bool
     */
    public function resetCounters()
    {
        try {
            $this->requests = 0;
            $this->responses = 0;
            if ( !$this->update() ) {
                throw new ExceptionHandler(__METHOD__ . ": reset failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** get
     *
     * @return bool
     */
    abstract public function get();

    /** insert
     *
     * @return bool
     */
    abstract public function insert();

    /** update
     *
     * @return bool
     */
    abstract public function update();

    /** checkRequired
     *
     * @return bool
     */
    protected function checkRequired()
    {
        if ( isset($this->application, $this->key, $this->expiration) ) {
            return true;
        } else {
            return false;
        }
    }

    /** checkExpired
     *
     * @return bool
     */
    protected function checkExpired()
    {
        if ( microtime() > $this->expiration ) {
            return true;
        } else {
            return false;
        }
    }
} 