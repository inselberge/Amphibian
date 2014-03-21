<?php
/**
 * PHP Version 5.4.9-4ubuntu2.2
 *
 * Created by PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 10/31/13
 * Time: 1:26 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once "interfaces".DIRECTORY_SEPARATOR."SerializeInterface.php";
require_once "CheckInput.php";
require_once "ExceptionHandler.php";
/**
 * Class Serialize
 *
 * @category Helper
 * @package  Serialize
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/Amphibian/documentation/Serialize
 */
class Serialize 
    implements SerializeInterface
{
    /**
     * @var boolean direction true = serialize, false = unserialize
     */
    protected $direction;
    /**
     * @var mixed data the information to serialize or unserialize
     */
    protected $data;
    /**
     * @var mixed output the return of the serialization or unserialization
     */
    protected $output;
    /**
     * @var object Serialize a singleton instance of this class
     */
    static public $Serialize;

    /** __construct
     */
    protected function __construct()
    {
        $this->direction = true;
    }

    /** instance
     *
     * @return object|Serialize
     */
    static public function instance()
    {
        if ( !isset(self::$Serialize) ) {
            self::$Serialize = new Serialize(); 
        }
        return self::$Serialize;
    }

    /**  setDirection
     *
     * @param boolean $direction true = serialize, false = unserialize
     *
     * @return boolean
     */
    public function setDirection( $direction )
    {
        try {
            if ( CheckInput::checkNewInput($direction) ) {
                $this->direction = $direction;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": direction is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getDirection
     *
     * @return mixed
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**  setData
     *
     * @param mixed $data the information to serialize or unserialize
     *
     * @return boolean
     */
    public function setData( $data )
    {
        try {
            if ( CheckInput::checkNewInputArray($data) ) {
                $this->data = $data;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": data is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** appendData
     *
     * @param mixed $data the information to serialize or unserialize
     *
     * @return bool
     */
    public function appendData( $data )
    {
        try {
            if ( CheckInput::checkNewInput($data) ) {
                $this->data[] = $data;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": data is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getData
     *
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /** execute
     *
     * @return boolean
     */
    public function execute()
    {
        try {
            if ( $this->checkRequired() ) {
                if ( $this->direction == false ) {
                    $this->unserialize();
                } elseif ( $this->direction == true ) {
                    $this->serialize();
                } else {
                    throw new ExceptionHandler(__METHOD__ . ": unknown direction.");
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

    /** checkRequired
     *
     * @return bool
     */
    protected function checkRequired()
    {
        try {
            if ( $this->checkDirection() ) {
                if ( $this->checkData() ) {
                } else {
                    throw new ExceptionHandler(__METHOD__ . ": data not set.");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": direction not set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkDirection
     *
     * @return bool
     */
    protected function checkDirection()
    {
        if ( isset($this->direction) ) {
            return true;
        } else {
            return false;
        }
    }

    /** checkData
     *
     * @return bool
     */
    protected function checkData()
    {
        if ( isset($this->data) ) {
            return true;
        } else {
            return false;
        }
    }

    /** serialize
     *
     * @return bool
     */
    protected function serialize()
    {
        try {
            if ( !$this->checkResource() ) {
                $this->output = serialize($this->data);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": resources are invalid.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkResource
     *
     * @return bool
     */
    protected function checkResource()
    {
        if ( is_resource($this->data) ) {
            return true;
        } else {
            return false;
        }
    }

    /** unserialize
     *
     * @return bool
     */
    protected function unserialize()
    {
        try {
            if ( $this->checkString() ) {
                $this->output = unserialize($this->data);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": data is not a string.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkString
     *
     * @return bool
     */
    protected function checkString()
    {
        if ( is_string($this->data) ) {
            return true;
        } else {
            return false;
        }
    }

    /** getOutput
     *
     * @return mixed
     */
    public function getOutput()
    {
        return $this->output;
    }
} 