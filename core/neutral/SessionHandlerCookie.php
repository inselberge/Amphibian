<?php
/**
 * PHP version 5.4.17
 * Created by JetBrains PhpStorm.
 * User: carl
 * Date: 9/17/13
 * Time: 11:30 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated
 */
require_once "interfaces".DIRECTORY_SEPARATOR."SessionHandlerCookieInterface.php";
require_once "CheckInput.php";
/**
 * Class SessionHandlerCookie
 *
 * @category Helper
 * @package  SessionHandler
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/SessionHandlerCookie
 */
class SessionHandlerCookie
    implements SessionHandlerCookieInterface
{
    /**
     * @var array data holds values for $SessionHandlerCookie->data
     */
    private $data = array();
    /**
     * @var null savePath holds values for $SessionHandlerCookie->savePath
     */
    private $savePath = null;
    /**
     * @var null raw holds values for $SessionHandlerCookie->raw
     */
    protected $raw = null;
    /**
     * @var null hash holds values for $SessionHandlerCookie->hash
     */
    protected $hash = null;
    /**
     * @var null hashCalculated holds values for $SessionHandlerCookie->hashCalculated
     */
    protected $hashCalculated = null;
    /**
     *
     */
    const HASH_LEN = 128;
    /**
     *
     */
    const HASH_ALGO = 'sha512';
    /**
     *
     */
    const HASH_SECRET = "YOUR_SECRET_STRING";
    /**
     * @var  SessionHandlerCookie holds values for $SessionHandlerCookie->SessionHandlerCookie
     */
    static public $SessionHandlerCookie;

    /** __construct

     */
    protected function __construct()
    {
    }

    /** instance
     *
     * @return SessionHandlerCookie
     */
    static public function instance()
    {
        if ( !isset(self::$SessionHandlerCookie) ) {
            self::$SessionHandlerCookie = new SessionHandlerCookie();
        }
        return self::$SessionHandlerCookie;
    }

    /** open
     *
     * @param $savePath
     *
     * @return bool
     */
    public function open( $savePath )
    {
        try {
            if ( CheckInput::checkNewInput($savePath) ) {
                $this->savePath = $savePath;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": path not set");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** read
     *
     * @param $id
     *
     * @return bool|string
     */
    public function read( $id )
    {
        try {
            if ( CheckInput::checkNewInput($id) ) {
                if ( !isset($_COOKIE[$id]) ) {
                    return '';
                } else {
                    if ( $this->setRaw($id) ) {
                        if ( $this->checkStringLength() ) {
                            return '';
                        } else {
                            $this->setHash();
                            $this->setData();
                            $this->calculateHash();
                            if ( $this->checkHashes() ) {
                                return '';
                            } else {
                                return (string) $this->data;
                            }
                        }
                    }
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": id not set");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** setHash
     *
     * @return bool
     */
    protected function setHash()
    {
        try {
            if ( CheckInput::checkSet($this->raw) ) {
                $this->hash = substr($this->raw, strlen($this->raw) - self::HASH_LEN, self::HASH_LEN);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": raw has not be set");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setData
     *
     * @return bool
     */
    protected function setData()
    {
        try {
            if ( CheckInput::checkNewInput($this->raw) ) {
                $this->data = substr($this->raw, 0, -(self::HASH_LEN));
            } else {
                throw new ExceptionHandler(__METHOD__ . ": raw has not been set");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setRaw
     *
     * @param $id
     *
     * @return bool
     */
    protected function setRaw( $id )
    {
        try {
            if ( CheckInput::checkNewInput($_COOKIE[$id]) ) {
                $this->raw = base64_decode($_COOKIE[$id]);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": cookie is not set");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkStringLength
     *
     * @return bool
     */
    protected function checkStringLength()
    {
        if ( strlen($this->raw) < self::HASH_LEN ) {
            return true;
        } else {
            return false;
        }
    }

    /** calculateHash
     *
     * @return bool
     */
    protected function calculateHash()
    {
        try {
            if ( CheckInput::checkSet($this->data) ) {
                $this->hashCalculated = hash_hmac(self::HASH_ALGO, $this->data, self::HASH_SECRET);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": data not set");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkHashes
     *
     * @return bool
     */
    protected function checkHashes()
    {
        if ( $this->hashCalculated !== $this->hash ) {
            return true;
        } else {
            return false;
        }
    }

    /** write
     *
     * @param $id
     * @param $data
     *
     * @return bool
     */
    public function write( $id, $data )
    {
        try {
            if ( CheckInput::checkNewInputArray(array( $id, $data )) ) {
                $this->data = $data;
                $this->calculateHash();
                $this->data .= $this->hashCalculated;
                $this->setCookie($id);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": prerequisites not met");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setCookie
     *
     * @param $id
     *
     * @return bool
     */
    protected function setCookie( $id )
    {
        try {
            if ( CheckInput::checkSet($id) ) {
                setcookie($id, base64_encode($this->data), time() + 3600);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": id must be set");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** destroy
     *
     * @param $id
     *
     * @return bool
     */
    public function destroy( $id )
    {
        try {
            if ( CheckInput::checkNewInput($id) ) {
                setcookie($id, '', time());
            } else {
                throw new ExceptionHandler(__METHOD__ . ": id must be set");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }
}