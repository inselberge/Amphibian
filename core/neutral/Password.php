<?php
/**
 * PHP Version 5.4.9-4ubuntu2.2
 * Created by PhpStorm.
 * Project: Coworks.In
 * User: Carl "Tex" Morgan
 * Date: 9/25/13
 * Time: 3:14 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once "interfaces".DIRECTORY_SEPARATOR."PasswordInterface.php";
require_once "CheckInput.php";
/**
 * Class Password
 *
 * @category Core
 * @package  Password
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/Password
 */
class Password 
    implements PasswordInterface
{
    /**
     * @var string password the new password
     */
    protected $password;
    /**
     * @var string hash the encrypted password
     */
    protected $hash;
    /**
     * @var integer length the length of a password
     */
    protected $length;
    /**
     * @var string algorithm the password algorithm to use
     */
    protected $algorithm;
    /**
     * @var array supportedAlgorithms an array of supported algorithms
     */
    protected $supportedAlgorithms;
    /**
     * @var object Password a singleton instance of this class
     */
    static public $Password;

    /** __construct
     */
    protected function __construct()
    {
        $this->supportedAlgorithms = hash_algos();
        $this->length = 16;
        $this->algorithm = 'whirlpool';
    }

    /** checkPasswordRegEx
     *
     * @param string $pass the password to check against the regex
     *
     * @return bool
     */
    static public function checkPasswordRegEx( $pass )
    {
        return preg_match('/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{6,20}$/', $pass);
    }

    /** instance
     *
     * @return object
     */
    static public function instance()
    {
        if ( !isset(self::$Password) ) {
            self::$Password = new Password(); 
        }
        return self::$Password;
    }

    /** factory
     *
     * @return object
     */
    static public function factory()
    {
        return new Password();
    }

    /**  setAlgorithm
     *
     * @param string $algorithm the algorithm you want to use
     *
     * @return boolean
     */
    public function setAlgorithm( $algorithm )
    {
        try {
            if ( CheckInput::checkNewInput($algorithm) ) {
                $this->algorithm = $algorithm;
                if ( !$this->checkAlgorithmSupport() ) {
                    $this->algorithm = null;
                    throw new ExceptionHandler(__METHOD__ . ": algorithm unsupported");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": algorithm not set");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkAlgorithmSupport
     *
     * @return bool
     */
    protected function checkAlgorithmSupport()
    {
        try {
            if ( CheckInput::checkSet($this->algorithm) ) {
                return in_array($this->algorithm, $this->supportedAlgorithms);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": algorithm not set");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /**   getAlgorithm
     *
     * @return string
     */
    public function getAlgorithm()
    {
        return $this->algorithm;
    }

    /**  setLength
     *
     * @param int $length the length of a password to generate
     *
     * @return boolean
     */
    public function setLength( $length )
    {
        try {
            if ( CheckInput::checkNewInput($length) and is_integer($length)) {
                $this->length = $length;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": length is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getLength
     *
     * @return int
     */
    public function getLength()
    {
        return $this->length;
    }

    /**  setPassword
     *
     * @param string $password the unencrypted password
     *
     * @return boolean
     */
    public function setPassword( $password )
    {
        try {
            if ( CheckInput::checkNewInput($password) AND is_string($password)) {
                $this->password = $password;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": password is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getPassword
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**   getHash
     *
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /** randomPassword
     *
     * @return bool
     */
    public function randomPassword()
    {
        try {
            $chars =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.
                '0123456789`-=~!@#$%^&*()_+,./<>?;:[]{}\|';
            $tempArray=array();
            $max = strlen($chars)-1;
            for ( $i=0; $i < $this->length; $i++ ) {
                $letter = rand(0, $max);
                $tempArray[] = $chars[$letter];
            }
            $this->password = implode($tempArray);
        } catch ( ExceptionHandler $e ) {
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
            if ( $this->checkEncryptionReady() ) {
                $this->hash = hash($this->algorithm, $this->password);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": unprepared");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkEncryptionReady
     *
     * @return bool
     */
    protected function checkEncryptionReady()
    {
        try {
            if ( CheckInput::checkSet($this->password) ) {
                if ( ! CheckInput::checkSet($this->algorithm) ) {
                    throw new ExceptionHandler(__METHOD__ . ": algorithm not set");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": password not set");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** compare
     *
     * @param string $password2 another password to compare to the hash
     *
     * @return bool
     */
    public function compare($password2)
    {
        try {
            if ( CheckInput::checkNewInput($password2) ) {
                if ( CheckInput::checkSet($this->hash) ) {
                    return $this->hash === $password2;
                } else {
                    throw new ExceptionHandler(__METHOD__ . ": invalid hash");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": nothing to compare");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }
}
/*
$pw1 = Password::instance();
$pw1->setAlgorithm('whirlpool');
$pw1->setPassword('1n$3lbergE');
$pw1->execute();
echo $pw1->getHash().PHP_EOL;
echo strlen($pw1->getHash());
*/
/*
$pw2 = Password::instance();
$pw2->randomPassword();
$pw2->setAlgorithm('whirlpool');
$pw2->execute();
echo "Password: ".$pw2->getPassword().PHP_EOL;
echo "Hash: ". $pw2->getHash().PHP_EOL;
*/