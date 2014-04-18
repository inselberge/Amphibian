<?php
/**
 * PHP version 5.3
 * Created by PhpStorm.
 * User: texmorgan
 * Date: 4/17/14
 * Time: 4:25 PM
 */
require_once "interfaces/EntityHeaderInterface.php";
/**
 * Class EntityHeader
 *
 * @category ${NAMESPACE}
 * @package  EntityHeader
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated
 * @link     documentation/EntityHeader
 */
 class EntityHeader
    extends Header
    implements EntityHeaderInterface 
{
     protected $allow;
     protected $contentEncoding;
     protected $contentLanguage;
     protected $contentLength;
     protected $contentLocation;
     protected $contentMD5;
     protected $contentRange;
     protected $contentType;
     protected $expires;
     protected $lastModified;
     protected $extensionHeader;

    /**
     * @var object EntityHeader a singleton instance of this class
     */
    static public $EntityHeader;
    
    /** __construct
    */
    protected function __construct()
    {
    
    }
    
    /** instance
     *
     * @return EntityHeader
     */
    static public function instance()
    {
        if ( !isset(self::$EntityHeader) ) {
            self::$EntityHeader = new EntityHeader();   
        }
        return self::$EntityHeader;
    }
     
    /** factory
     * 
     * @return EntityHeader
     */
    static public function factory()
    {
        return new EntityHeader();
    }

     /** getAllow
      *
      * @return mixed
      */
     public function getAllow()
     {
         return $this->allow;
     }

     /** setAllow
      *
      * @param mixed $allow
      *
      * @return bool
      */
     public function setAllow($allow)
     {
         try {
             if (CheckInput::checkNewInput($allow)) {
                 $this->allow = $allow;
                 $this->headerArray['Allow'] = 'Allow: ' . $this->allow;
                 $this->updateCount();
             } else {
                 throw new ExceptionHandler(__METHOD__ . ": allow invalid.");
             }
         } catch (ExceptionHandler $e) {
             $e->execute();
             return false;
         }
         return true;
     }

     /** getContentEncoding
      *
      * @return mixed
      */
     public function getContentEncoding()
     {
         return $this->contentEncoding;
     }

     /** setContentEncoding
      *
      * @param mixed $contentEncoding
      *
      * @return bool
      */
     public function setContentEncoding($contentEncoding)
     {
         try {
             if (CheckInput::checkNewInput($contentEncoding)) {
                 $this->contentEncoding = $contentEncoding;
                 $this->headerArray['Content-Encoding'] = 'Content-Encoding: ' . $this->contentEncoding;
                 $this->updateCount();
             } else {
                 throw new ExceptionHandler(__METHOD__ . ": contentEncoding invalid.");
             }
         } catch (ExceptionHandler $e) {
             $e->execute();
             return false;
         }
         return true;
     }

     /** getContentLanguage
      *
      * @return mixed
      */
     public function getContentLanguage()
     {
         return $this->contentLanguage;
     }

     /** setContentLanguage
      *
      * @param mixed $contentLanguage
      *
      * @return bool
      */
     public function setContentLanguage($contentLanguage)
     {
         try {
             if (CheckInput::checkNewInput($contentLanguage)) {
                 $this->contentLanguage = $contentLanguage;
                 $this->headerArray['Content-Language'] = 'Content-Language: ' . $this->contentLanguage;
                 $this->updateCount();
             } else {
                 throw new ExceptionHandler(__METHOD__ . ": contentLanguage invalid.");
             }
         } catch (ExceptionHandler $e) {
             $e->execute();
             return false;
         }
         return true;
     }

     /** getContentLength
      *
      * @return mixed
      */
     public function getContentLength()
     {
         return $this->contentLength;
     }

     /** setContentLength
      *
      * @param mixed $contentLength
      *
      * @return bool
      */
     public function setContentLength($contentLength)
     {
         try {
             if (CheckInput::checkNewInput($contentLength)) {
                 $this->contentLength = $contentLength;
                 $this->headerArray['Content-Length'] = 'Content-Lenght: ' . $this->contentLength;
                 $this->updateCount();
             } else {
                 throw new ExceptionHandler(__METHOD__ . ": contentLength invalid.");
             }
         } catch (ExceptionHandler $e) {
             $e->execute();
             return false;
         }
         return true;
     }

     /** getContentLocation
      *
      * @return mixed
      */
     public function getContentLocation()
     {
         return $this->contentLocation;
     }

     /** setContentLocation
      *
      * @param mixed $contentLocation
      *
      * @return bool
      */
     public function setContentLocation($contentLocation)
     {
         try {
             if (CheckInput::checkNewInput($contentLocation)) {
                 $this->contentLocation = $contentLocation;
                 $this->headerArray['Content-Location'] = 'Content-Location: ' . $this->contentLocation;
                 $this->updateCount();
             } else {
                 throw new ExceptionHandler(__METHOD__ . ": contentLocation invalid.");
             }
         } catch (ExceptionHandler $e) {
             $e->execute();
             return false;
         }
         return true;
     }

     /** getContentMD5
      *
      * @return mixed
      */
     public function getContentMD5()
     {
         return $this->contentMD5;
     }

     /** setContentMD5
      *
      * @param mixed $contentMD5
      *
      * @return bool
      */
     public function setContentMD5($contentMD5)
     {
         try {
             if (CheckInput::checkNewInput($contentMD5)) {
                 $this->contentMD5 = $contentMD5;
                 $this->headerArray['Content-MD5'] = 'Content-MD5: ' . $this->contentMD5;
                 $this->updateCount();
             } else {
                 throw new ExceptionHandler(__METHOD__ . ": contentMD5 invalid.");
             }
         } catch (ExceptionHandler $e) {
             $e->execute();
             return false;
         }
         return true;
     }

     /** getContentRange
      *
      * @return mixed
      */
     public function getContentRange()
     {
         return $this->contentRange;
     }

     /** setContentRange
      *
      * @param mixed $contentRange
      *
      * @return bool
      */
     public function setContentRange($contentRange)
     {
         try {
             if (CheckInput::checkNewInput($contentRange)) {
                 $this->contentRange = $contentRange;
                 $this->headerArray['Content-Range'] = 'Content-Range: ' . $this->contentRange;
                 $this->updateCount();
             } else {
                 throw new ExceptionHandler(__METHOD__ . ": contentRange invalid.");
             }
         } catch (ExceptionHandler $e) {
             $e->execute();
             return false;
         }
         return true;
     }

     /** getContentType
      *
      * @return mixed
      */
     public function getContentType()
     {
         return $this->contentType;
     }

     /** setContentType
      *
      * @param mixed $contentType
      *
      * @return bool
      */
     public function setContentType($contentType)
     {
         try {
             if (CheckInput::checkNewInput($contentType)) {
                 $this->contentType = $contentType;
                 $this->headerArray['Content-Type'] = 'Content-Type: ' . $this->contentType;
                 $this->updateCount();
             } else {
                 throw new ExceptionHandler(__METHOD__ . ": contentType invalid.");
             }
         } catch (ExceptionHandler $e) {
             $e->execute();
             return false;
         }
         return true;
     }

     /** getExpires
      *
      * @return mixed
      */
     public function getExpires()
     {
         return $this->expires;
     }

     /** setExpires
      *
      * @param mixed $expires
      *
      * @return bool
      */
     public function setExpires($expires)
     {
         try {
             if (CheckInput::checkNewInput($expires)) {
                 $this->expires = $expires;
                 $this->headerArray['Expires'] = 'Expires: ' . $this->expires;
                 $this->updateCount();
             } else {
                 throw new ExceptionHandler(__METHOD__ . ": expires invalid.");
             }
         } catch (ExceptionHandler $e) {
             $e->execute();
             return false;
         }
         return true;
     }

     /** getExtensionHeader
      *
      * @return mixed
      */
     public function getExtensionHeader()
     {
         return $this->extensionHeader;
     }

     /** setExtensionHeader
      *
      * @param mixed $extensionHeader
      *
      * @return bool
      */
     public function setExtensionHeader($extensionHeader)
     {
         try {
             if (CheckInput::checkNewInput($extensionHeader)) {
                 $this->extensionHeader = $extensionHeader;
                 $this->headerArray['extension-header'] = 'extension-header: ' . $this->extensionHeader;
                 $this->updateCount();
             } else {
                 throw new ExceptionHandler(__METHOD__ . ": extensionHeader invalid.");
             }
         } catch (ExceptionHandler $e) {
             $e->execute();
             return false;
         }
         return true;
     }

     /** getLastModified
      *
      * @return mixed
      */
     public function getLastModified()
     {
         return $this->lastModified;
     }

     /** setLastModified
      *
      * @param mixed $lastModified
      *
      * @return bool
      */
     public function setLastModified($lastModified)
     {
         try {
             if (CheckInput::checkNewInput($lastModified)) {
                 $this->lastModified = $lastModified;
                 $this->headerArray['Last-Modified'] = 'Last-Modified: ' . $this->lastModified;
                 $this->updateCount();
             } else {
                 throw new ExceptionHandler(__METHOD__ . ": lastModified invalid.");
             }
         } catch (ExceptionHandler $e) {
             $e->execute();
             return false;
         }
         return true;
     }


} 