<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Carl "Tex" Morgan
 * Date: 1/15/13
 * Time: 12:52 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once "interfaces".DIRECTORY_SEPARATOR."RandomPasswordInterface.php";

/**
 * Class RandomPassword
 *
 * @category Helper
 * @package  Core
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/RandomPassword
 */
class RandomPassword
    implements RandomPasswordInterface
{
    /**
     * @var string password the new password
     */
    public $password;
    /**
     * @var string algo the specific algo to use for encryption
     */
    public $algo;
    /**
     * @var integer length the length of the password
     */
    public $length;
    /**
     * @var string hash the password encrypted
     */
    public $hash;
    /**
     * @var array supported_algos an array of the supported encryption methods
     */
    protected $supported_algos;
    /**
     * @var string seed the seed for the encryption
     */
    protected $seed;
    /**
     * @var string substring a substring of the generated key
     */
    protected $substring;

    /** __construct
     *
     * @param string  $requestedAlgo  the specific algorithm to use
     * @param integer $passwordLength the length of the new password
     */
    public function __construct( $requestedAlgo, $passwordLength )
    {
        if ( isset($requestedAlgo, $passwordLength) ) {
            $this->algo   = $requestedAlgo;
            $this->length = $passwordLength;
            $this->getSupportedAlgos();
            $this->generateSeed();
            if ( $this->checkSupportedAlgo() ) {
                $this->createHash();
                return true;
            } else {
                return false;
            }
        }
    }

    /** getSupportedAlgos
     *
     * @return void
     */
    protected function getSupportedAlgos()
    {
        $this->supported_algos = hash_algos();
    }

    /** generateSeed
     *
     * @return void
     */
    protected function generateSeed()
    {
        $this->seed = uniqid(rand(), true);
    }

    /** checkSupportedAlgo
     *
     * @return bool
     */
    public function checkSupportedAlgo()
    {
        if ( isset($this->supported_algos, $this->algo) ) {
            if ( is_array($this->supported_algos) AND count($this->supported_algos) ) {
                if ( in_array($this->algo, $this->supported_algos) ) {
                    return true;
                } else {
                    //throw new Exception(utf8_encode(__CLASS__."::".__FUNCTION__.": the algo specified is not currently supported."));
                    trigger_error(utf8_encode(__CLASS__ . "::" . __FUNCTION__ . ": the algo specified is not currently supported."));
                    return false;
                }
            } else {
                //throw new Exception(utf8_encode(__CLASS__."::".__FUNCTION__.": the supported algos array is not set properly or the hash library is not loaded."));
                trigger_error(utf8_encode(__CLASS__ . "::" . __FUNCTION__ . ": the supported algos array is not set properly or the hash library is not loaded."));
                return false;
            }
        } else {
            //throw new Exception(utf8_encode(__CLASS__."::".__FUNCTION__.": the required variables are not set properly."));
            trigger_error(utf8_encode(__CLASS__ . "::" . __FUNCTION__ . ": the required variables are not set properly."));
            return false;
        }
    }

    /** createHash
     *
     * @return bool
     */
    protected function createHash()
    {
        if ( isset($this->algo, $this->seed) ) {
            $this->hash = hash($this->algo, $this->seed);
            return true;
        } else {
            //throw new Exception(utf8_encode(__CLASS__."::".__FUNCTION__.": the required variables are not set properly."));
            trigger_error(utf8_encode(__CLASS__ . "::" . __FUNCTION__ . ": the required variables are not set properly."));
            return false;
        }
    }

    /** checkLength
     *
     * @return bool
     */
    protected function checkLength()
    {
        if ( isset($this->length) ) {
            if ( is_numeric($this->length) ) {
                return true;
            } else {
                //throw new Exception(utf8_encode(__CLASS__."::".__FUNCTION__.": the length is not numeric."));
                trigger_error(utf8_encode(__CLASS__ . "::" . __FUNCTION__ . ": the length is not numeric."));
                return false;
            }
        } else {
            $this->length = 8;
            return true;
        }
    }

    /** createPassword
     *
     * @return bool
     */
    public function createPassword()
    {
        if ( isset($this->hash, $this->length) AND is_numeric($this->length) ) {
            $start = (int) strlen($this->hash) / 3;
            if ( is_numeric($start) ) {
                $this->password = substr($this->hash, $start, $this->length);
                return true;
            } else {
                //throw new Exception(utf8_encode(__CLASS__."::".__FUNCTION__.": the length is not numeric."));
                trigger_error(utf8_encode(__CLASS__ . "::" . __FUNCTION__ . ": the substring start, end, or both is not numeric."));
                return false;
            }
        } else {
            //throw new Exception(utf8_encode(__CLASS__."::".__FUNCTION__.": the required variables are not set properly."));
            trigger_error(utf8_encode(__CLASS__ . "::" . __FUNCTION__ . ": the required variables are not set properly."));
            return false;
        }
    }
}
/*
 * Example of 16 character long password
$pw = new RandomPassword("whirlpool",16);
$pw->createPassword();
echo $pw->password." ".strlen($pw->password);
*/