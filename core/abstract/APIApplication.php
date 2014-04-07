<?php
/**
 * PHP Version 5.4.9-4ubuntu2.2
 * Created by PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 11/1/13
 * Time: 8:35 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once AMPHIBIAN_CORE_NEUTRAL . "CheckInput.php";
require_once "interfaces".DIRECTORY_SEPARATOR."APIApplicationInterface.php";
/**
 * Class APIApplication
 *
 * @category API
 * @package  APIApplication
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/Amphibian/documentation/APIApplication
 */
abstract class APIApplication
    implements APIApplicationInterface
{
    /**
     * @var integer id holds id of the application in the database
     */
    protected $id;
    /**
     * @var string name the name of the application
     */
    protected $name;
    /**
     * @var string description what the application does
     */
    protected $description;
    /**
     * @var string key the application key
     */
    protected $key;
    /**
     * @var string email holds the email of the registered person
     */
    protected $email;
    /**
     * @var boolean status if the application is enabled or not
     */
    protected $status;

    /**  setDescription
     *
     * @param string $description a description of the application
     *
     * @return boolean
     */
    public function setDescription( $description )
    {
        try {
            if ( CheckInput::checkNewInput($description) ) {
                $this->description = $description;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": description invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getDescription
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**  setEmail
     *
     * @param string $email a valid email address
     *
     * @return boolean
     */
    public function setEmail( $email )
    {
        try {
            if ( CheckInput::checkNewInput($email) ) {
                $this->email = $email;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": email is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getEmail
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**  setKey
     *
     * @param string $key a valid API Key
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

    /**  setName
     *
     * @param string $name a valid name
     *
     * @return boolean
     */
    public function setName( $name )
    {
        try {
            if ( CheckInput::checkNewInput($name) ) {
                $this->name = $name;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": name is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getName
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /** generate
     *
     * @return bool
     */
    public function generate()
    {
        try {
            if ( CheckInput::checkSet($this->name) ) {
                $seed = microtime().$this->name;
                $this->key = hash('snefru', $seed);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": invalid name");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** insert
     *
     * @return bool
     */
    abstract public function insert();


    /** checkRequired
     *
     * @return bool
     */
    abstract protected function checkRequired();

    /** get
     *
     * @return bool
     */
    abstract public function get();


    /** update
     *
     * @return bool
     */
    abstract public function update();
} 