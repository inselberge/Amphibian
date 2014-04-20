<?php
/**
 * PHP version 5.3
 * Created by PhpStorm.
 * User: texmorgan
 * Date: 4/17/14
 * Time: 1:49 PM
 */
require_once AMPHIBIAN_CORE_ABSTRACT."Header.php";
require_once "interfaces".DIRECTORY_SEPARATOR."ResponseHeaderInterface.php";
/**
 * Class ResponseHeader
 *
 * @category ${NAMESPACE}
 * @package  ResponseHeader
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated
 * @link     documentation/ResponseHeader
 */
 class ResponseHeader
    extends Header
    implements ResponseHeaderInterface 
{
     /**
      * @var  acceptRanges
      */
     protected $acceptRanges;
     /**
      * @var  age
      */
     protected $age;
     /**
      * @var  eTag
      */
     protected $eTag;
     /**
      * @var  location
      */
     protected $location;
     /**
      * @var  proxyAuthenticate
      */
     protected $proxyAuthenticate;
     /**
      * @var  retryAfter
      */
     protected $retryAfter;
     /**
      * @var  server
      */
     protected $server;
     /**
      * @var  vary
      */
     protected $vary;
     /**
      * @var  wwwAuthenticate
      */
     protected $wwwAuthenticate;

    /**
     * @var object ResponseHeader a singleton instance of this class
     */
    static public $ResponseHeader;
    
    /** __construct
    */
    protected function __construct()
    {

    }
    
    /** instance
     *
     * @return ResponseHeader
     */
    static public function instance()
    {
        if ( !isset(self::$ResponseHeader) ) {
            self::$ResponseHeader = new ResponseHeader();   
        }
        return self::$ResponseHeader;
    }
     
    /** factory
     * 
     * @return ResponseHeader
     */
    static public function factory()
    {
        return new ResponseHeader();
    }

     /** getAcceptRanges
      *
      * @return mixed
      */
     public function getAcceptRanges()
     {
         return $this->acceptRanges;
     }

     /** setAcceptRanges
      *
      * @param mixed $acceptRanges
      *
      * @return bool
      */
     public function setAcceptRanges($acceptRanges)
     {
         try {
             if (CheckInput::checkNewInput($acceptRanges)) {
                 $this->acceptRanges = $acceptRanges;
                 $this->headerArray['Accept-Ranges'] = 'Accept-Ranges: ' . $this->acceptRanges;
                 $this->updateCount();
             } else {
                 throw new ExceptionHandler(__METHOD__ . ": acceptRanges invalid.");
             }
         } catch (ExceptionHandler $e) {
             $e->execute();
             return false;
         }
         return true;
     }

     /** getAge
      *
      * @return mixed
      */
     public function getAge()
     {
         return $this->age;
     }

     /** setAge
      *
      * @param integer $startTime
      *
      * @return bool
      */
     public function setAge($startTime)
     {
         try {
             if (CheckInput::checkNewInput($startTime)) {
                 $this->age = $_SERVER["REQUEST_TIME"] - $startTime;
                 $this->headerArray['Age'] = 'Age: '.$this->age;
                 $this->updateCount();
             } else {
                 throw new ExceptionHandler(__METHOD__ . ": age invalid.");
             }
         } catch (ExceptionHandler $e) {
             $e->execute();
             return false;
         }
         return true;
     }

     /** getETag
      *
      * @return mixed
      */
     public function getETag()
     {
         return $this->eTag;
     }

     /** setETag
      *
      * @param mixed $eTag
      *
      * @return bool
      */
     public function setETag($eTag)
     {
         try {
             if (CheckInput::checkNewInput($eTag)) {
                 $this->eTag = $eTag;
                 $this->headerArray['ETag'] = 'ETag: ' . $this->eTag;
                 $this->updateCount();
             } else {
                 throw new ExceptionHandler(__METHOD__ . ": eTag invalid.");
             }
         } catch (ExceptionHandler $e) {
             $e->execute();
             return false;
         }
         return true;
     }

     /** getLocation
      *
      * @return mixed
      */
     public function getLocation()
     {
         return $this->location;
     }

     /** setLocation
      *
      * @param mixed $location
      *
      * @return bool
      */
     public function setLocation($location)
     {
         try {
             if (CheckInput::checkNewInput($location)) {
                 $this->location = $location;
                 $this->headerArray['Location'] = 'Location: ' . $this->location;
                 $this->updateCount();
             } else {
                 throw new ExceptionHandler(__METHOD__ . ": location invalid.");
             }
         } catch (ExceptionHandler $e) {
             $e->execute();
             return false;
         }
         return true;
     }

     /** getProxyAuthenticate
      *
      * @return mixed
      */
     public function getProxyAuthenticate()
     {
         return $this->proxyAuthenticate;
     }

     /** setProxyAuthenticate
      *
      * @param mixed $proxyAuthenticate
      *
      * @return bool
      */
     public function setProxyAuthenticate($proxyAuthenticate)
     {
         try {
             if (CheckInput::checkNewInput($proxyAuthenticate)) {
                 $this->proxyAuthenticate = $proxyAuthenticate;
                 $this->headerArray['Proxy-Authenticate'] = 'Proxy-Authenticate: ' . $this->proxyAuthenticate;
                 $this->updateCount();
             } else {
                 throw new ExceptionHandler(__METHOD__ . ": proxyAuthenticate invalid.");
             }
         } catch (ExceptionHandler $e) {
             $e->execute();
             return false;
         }
         return true;
     }

     /** getRetryAfter
      *
      * @return mixed
      */
     public function getRetryAfter()
     {
         return $this->retryAfter;
     }

     /** setRetryAfter
      *
      * @param mixed $retryAfter this can be either an HTTP date or # of seconds
      *
      * @return bool
      */
     public function setRetryAfter($retryAfter)
     {
         try {
             if (CheckInput::checkNewInput($retryAfter)) {
                 $this->retryAfter = $retryAfter;
                 $this->headerArray['Retry-After'] = 'Retry-After: ' . $this->retryAfter;
                 $this->updateCount();
             } else {
                 throw new ExceptionHandler(__METHOD__ . ": retryAfter invalid.");
             }
         } catch (ExceptionHandler $e) {
             $e->execute();
             return false;
         }
         return true;
     }

     /** getServer
      *
      * @return mixed
      */
     public function getServer()
     {
         return $this->server;
     }

     /** setServer
      *
      * @param mixed $server
      *
      * @return bool
      */
     public function setServer($server)
     {
         try {
             if (CheckInput::checkNewInput($server)) {
                 $this->server = $server;
                 $this->headerArray['Server'] = 'Server: ' . $this->server;
                 $this->updateCount();
             } else {
                 throw new ExceptionHandler(__METHOD__ . ": server invalid.");
             }
         } catch (ExceptionHandler $e) {
             $e->execute();
             return false;
         }
         return true;
     }

     /** getVary
      *
      * @return mixed
      */
     public function getVary()
     {
         return $this->vary;
     }

     /** setVary
      *
      * @param mixed $vary
      *
      * @return bool
      */
     public function setVary($vary)
     {
         try {
             if (CheckInput::checkNewInput($vary)) {
                 $this->vary = $vary;
                 $this->headerArray['Vary'] = 'Vary: ' . $this->vary;
                 $this->updateCount();
             } else {
                 throw new ExceptionHandler(__METHOD__ . ": vary invalid.");
             }
         } catch (ExceptionHandler $e) {
             $e->execute();
             return false;
         }
         return true;
     }

     /** getWwwAuthenticate
      *
      * @return mixed
      */
     public function getWwwAuthenticate()
     {
         return $this->wwwAuthenticate;
     }

     /** setWwwAuthenticate
      *
      * @param mixed $wwwAuthenticate
      *
      * @return bool
      */
     public function setWwwAuthenticate($wwwAuthenticate)
     {
         try {
             if (CheckInput::checkNewInput($wwwAuthenticate)) {
                 $this->wwwAuthenticate = $wwwAuthenticate;
                 $this->headerArray['WWW-Authenticate'] = 'WWW-Authenticate: ' . $this->wwwAuthenticate;
                 $this->updateCount();
             } else {
                 throw new ExceptionHandler(__METHOD__ . ": wwwAuthenticate invalid.");
             }
         } catch (ExceptionHandler $e) {
             $e->execute();
             return false;
         }
         return true;
     }
} 