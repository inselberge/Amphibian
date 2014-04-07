<?php
/**
 * PHP Version 5.4.9-4ubuntu2.2
 * Created by PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 11/1/13
 * Time: 8:37 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once "interfaces".DIRECTORY_SEPARATOR."APIResponseInterface.php";
require_once "JSON.php";
/**
 * Class APIResponse
 *
 * @category API
 * @package  APIResponse
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/Amphibian/documentation/APIResponse
 */
class APIResponse 
    implements APIResponseInterface
{
    /**
     * @var string application the application being used
     */
    protected $application;
    /**
     * @var string key the key used for the request
     */
    protected $key;
    /**
     * @var float timestamp the time of the response
     */
    protected $timestamp;
    /**
     * @var bool success true = data, false = error
     */
    protected $success;
    /**
     * @var string type the type of information being given
     */
    protected $type;
    /**
     * @var int pageSize the maximum number of records requested
     */
    protected $pageSize;
    /**
     * @var int payloadSize the number of records in the response
     */
    protected $payloadSize;
    /**
     * @var array payload all of the results
     */
    protected $payload;
    /**
     * @var  APIResponse holds values for $APIResponse->APIResponse
     */
    static public $APIResponse;

    /** __construct
     */
    protected function __construct()
    {
        $this->timestamp = $_SERVER["REQUEST_TIME_FLOAT"];
        $this->payloadSize = 0;
        $this->payload = [];
    }

    /** instance
     *
     * @return APIResponse
     */
    static public function instance()
    {
        if ( !isset(self::$APIResponse) ) {
            self::$APIResponse = new APIResponse(); 
        }
        return self::$APIResponse;
    }

    /** factory
     *
     * @return APIResponse
     */
    static public function factory()
    {
        return new APIResponse();
    }

    /**  setApplication
     *
     * @param string $application the current application
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

    /**  setKey
     *
     * @param string $key the API Key
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

    /**  setPageSize
     *
     * @param int $pageSize the maximum number of records in payload
     *
     * @return boolean
     */
    public function setPageSize( $pageSize )
    {
        try {
            if ( CheckInput::checkNewInput($pageSize) ) {
                $this->pageSize = $pageSize;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": pageSize is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getPageSize
     *
     * @return int
     */
    public function getPageSize()
    {
        return $this->pageSize;
    }

    /**  setPayload
     *
     * @param array $payload the data or error message
     *
     * @return boolean
     */
    public function setPayload( $payload )
    {
        try {
            if ( CheckInput::checkNewInputArray($payload) ) {
                $this->payload = $payload;
                $this->setPayloadSize(count($payload));
            } else {
                throw new ExceptionHandler(__METHOD__ . ": payload is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** appendPayload
     *
     * @param array $payload the new data to append to the existing payload
     *
     * @return bool
     */
    public function appendPayload( $payload )
    {
        try {
            if ( CheckInput::checkNewInputArray($payload) ) {
                $this->payload[] = $payload;
                $this->setPayloadSize(count($payload));
            } else {
                throw new ExceptionHandler(__METHOD__ . ": payload is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getPayload
     *
     * @return array
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**  setPayloadSize
     *
     * @param int $payloadSize the actual size of the data or number of errors
     *
     * @return boolean
     */
    public function setPayloadSize( $payloadSize )
    {
        try {
            if ( CheckInput::checkNewInput($payloadSize) ) {
                $this->payloadSize = $payloadSize;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": payloadSize is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getPayloadSize
     *
     * @return int
     */
    public function getPayloadSize()
    {
        return $this->payloadSize;
    }

    /**  setSuccess
     *
     * @param boolean $success true = data, false = error
     *
     * @return boolean
     */
    public function setSuccess( $success )
    {
        try {
            if ( CheckInput::checkNewInput($success) ) {
                $this->success = $success;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": success is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getSuccess
     *
     * @return boolean
     */
    public function getSuccess()
    {
        return $this->success;
    }

    /**  setTimestamp
     *
     * @param float $timestamp the timestamp of the response
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

    /**  setType
     *
     * @param string $type the type of data being returned
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

    /** execute
     *
     * @return string
     */
    public function execute()
    {
        try {
            if ( !CheckInput::checkSet(self::$APIResponse) ) {
                throw new ExceptionHandler(__METHOD__ . ": APIResponse must be initialized.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return self::$APIResponse;
    }
} 