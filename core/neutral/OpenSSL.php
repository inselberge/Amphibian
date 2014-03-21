<?php
/**
 * PHP Version 5.4.9-4ubuntu2.2
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 8/20/13
 * Time: 2:39 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once "interfaces".DIRECTORY_SEPARATOR."OpenSSLInterface.php";
/**
 * Class OpenSSL
 *
 * @category Helper
 * @package  OpenSSL
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/OpenSSL
 */
class OpenSSL 
    implements OpenSSLInterface
{
    /**
     * @var mixed resource the OpenSSL resource to use for key generation
     */
    protected $resource;
    /**
     * @var array details the details of the resource
     */
    protected $details;
    /**
     * @var string privateKey the private key
     */
    protected $privateKey;
    /**
     * @var string publicKey the public key
     */
    protected $publicKey;
    /**
     * @var string clearText the decrypted string
     */
    protected $clearText;
    /**
     * @var string workingText the encrypted string
     */
    protected $workingText;
    /**
     * @var object OpenSSL a singleton instance of this class
     */
    static public $OpenSSL;

    /** __construct
     */
    protected function __construct()
    {
    }

    /** instance
     *
     * @return object
     */
    static public function instance()
    {
        if ( !isset(self::$OpenSSL) ) {
            self::$OpenSSL = new OpenSSL(); 
        }
        return self::$OpenSSL;
    }

    /**  setClearText
     *
     * @param string $clearText an unencrypted string
     *
     * @return boolean
     */
    public function setClearText( $clearText )
    {
        try {
            if ( CheckInput::checkNewInput($clearText) ) {
                $this->clearText = $clearText;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": clearText is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getClearText
     *
     * @return string
     */
    public function getClearText()
    {
        return $this->clearText;
    }

    /**  setPrivateKey
     *
     * @param string $privateKey the private key
     *
     * @return boolean
     */
    public function setPrivateKey( $privateKey )
    {
        try {
            if ( CheckInput::checkNewInput($privateKey) ) {
                $this->privateKey = $privateKey;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": privateKey is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getPrivateKey
     *
     * @return string
     */
    public function getPrivateKey()
    {
        return $this->privateKey;
    }

    /**  setPublicKey
     *
     * @param string $publicKey the public key
     *
     * @return boolean
     */
    public function setPublicKey( $publicKey )
    {
        try {
            if ( CheckInput::checkNewInput($publicKey) ) {
                $this->publicKey = $publicKey;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": publicKey is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getPublicKey
     *
     * @return string
     */
    public function getPublicKey()
    {
        return $this->publicKey;
    }

    /**  setResource
     *
     * @param mixed $resource the resource used to generate the keys
     *
     * @return boolean
     */
    public function setResource( $resource )
    {
        try {
            if ( CheckInput::checkNewInputArray($resource) ) {
                $this->resource[] = $resource;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": resource is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getResource
     *
     * @return mixed
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**  setWorkingText
     *
     * @param string $workingText the current working text
     *
     * @return boolean
     */
    public function setWorkingText( $workingText )
    {
        try {
            if ( CheckInput::checkNewInput($workingText) ) {
                $this->workingText = $workingText;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": workingText is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getWorkingText
     *
     * @return string
     */
    public function getWorkingText()
    {
        return $this->workingText;
    }

    /** initResource
     *
     * @return bool
     */
    public function initResource()
    {
        try {
            $this->resource = openssl_pkey_new();
            if ( ! CheckInput::checkNewInput($this->resource) ) {
                throw new ExceptionHandler(__METHOD__ . ": initResource failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** generatePrivateKey
     *
     * @return bool
     */
    public function generatePrivateKey()
    {
        try {
            if ( !openssl_pkey_export($this->resource, $this->privateKey) ) {
                throw new ExceptionHandler(__METHOD__ . ": generatePrivateKey failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** generatePublicKey
     *
     * @return bool
     */
    public function generatePublicKey()
    {
        try {
            if ( ! CheckInput::checkSetArray($this->details) ) {
                $this->setDetails();
            }
            $this->publicKey = $this->details["key"];

            if ( CheckInput::checkNewInput($this->publicKey) ) {
                throw new ExceptionHandler(__METHOD__ . ": generatePublicKey failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setDetails
     *
     * @return bool
     */
    protected function setDetails()
    {
        try {
            $this->details = openssl_pkey_get_details($this->resource);
            if ( ! CheckInput::checkNewInputArray($this->details) ) {
                throw new ExceptionHandler(__METHOD__ . ": setDetails failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** encrypt
     *
     * @return bool
     */
    public function encrypt()
    {
        try {
            if ( !openssl_public_encrypt($this->clearText, $this->workingText, $this->publicKey) ) {
                throw new ExceptionHandler(__METHOD__ . ": encrypt failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** decrypt
     *
     * @return bool
     */
    public function decrypt()
    {
        try {
            if ( !openssl_private_decrypt($this->workingText, $this->clearText, $this->privateKey) ) {
                throw new ExceptionHandler(__METHOD__ . ": decrypt failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }
}