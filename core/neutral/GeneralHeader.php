<?php
/**
 * PHP version 5.3
 * Created by PhpStorm.
 * User: texmorgan
 * Date: 4/17/14
 * Time: 4:10 PM
 */
require_once AMPHIBIAN_CORE_ABSTRACT."Header.php";
require_once "interfaces".DIRECTORY_SEPARATOR."GeneralHeaderInterface.php";
/**
 * Class GeneralHeader
 *
 * @category ${NAMESPACE}
 * @package  GeneralHeader
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated
 * @link     documentation/GeneralHeader
 */
 class GeneralHeader
    extends Header
    implements GeneralHeaderInterface 
{
     protected $cacheControl;
     protected $connection;
     protected $date;
     protected $pragma;
     protected $trailer;
     protected $transferEncoding;
     protected $upgrade;
     protected $via;
     protected $warning;

    /**
     * @var object GeneralHeader a singleton instance of this class
     */
    static public $GeneralHeader;
    
    /** __construct
    */
    protected function __construct()
    {
    
    }
    
    /** instance
     *
     * @return GeneralHeader
     */
    static public function instance()
    {
        if ( !isset(self::$GeneralHeader) ) {
            self::$GeneralHeader = new GeneralHeader();   
        }
        return self::$GeneralHeader;
    }
     
    /** factory
     * 
     * @return GeneralHeader
     */
    static public function factory()
    {
        return new GeneralHeader();
    }

     /** getCacheControl
      *
      * @return mixed
      */
     public function getCacheControl()
     {
         return $this->cacheControl;
     }

     /** setCacheControl
      *
      * @param mixed $cacheControl
      *
      * @return bool
      */
     public function setCacheControl($cacheControl)
     {
         try {
             if (CheckInput::checkNewInput($cacheControl)) {
                 $this->cacheControl = $cacheControl;
                 $this->headerArray['Cache-Control'] = 'Cache-Control: ' . $this->cacheControl;
                 $this->updateCount();
             } else {
                 throw new ExceptionHandler(__METHOD__ . ": cacheControl invalid.");
             }
         } catch (ExceptionHandler $e) {
             $e->execute();
             return false;
         }
         return true;
     }

     /** getConnection
      *
      * @return mixed
      */
     public function getConnection()
     {
         return $this->connection;
     }

     /** setConnection
      *
      * @param mixed $connection
      *
      * @return bool
      */
     public function setConnection($connection)
     {
         try {
             if (CheckInput::checkNewInput($connection)) {
                 $this->connection = $connection;
                 $this->headerArray['Connection'] = 'Connection: ' . $this->connection;
                 $this->updateCount();
             } else {
                 throw new ExceptionHandler(__METHOD__ . ": connection invalid.");
             }
         } catch (ExceptionHandler $e) {
             $e->execute();
             return false;
         }
         return true;
     }

     /** getDate
      *
      * @return mixed
      */
     public function getDate()
     {
         return $this->date;
     }

     /** setDate
      *
      * @param mixed $date
      *
      * @return bool
      */
     public function setDate($date)
     {
         try {
             if (CheckInput::checkNewInput($date)) {
                 $this->date = $date;
                 $this->headerArray['Date'] = 'Date: ' . $this->date;
                 $this->updateCount();
             } else {
                 throw new ExceptionHandler(__METHOD__ . ": date invalid.");
             }
         } catch (ExceptionHandler $e) {
             $e->execute();
             return false;
         }
         return true;
     }

     /** getPragma
      *
      * @return mixed
      */
     public function getPragma()
     {
         return $this->pragma;
     }

     /** setPragma
      *
      * @param mixed $pragma
      *
      * @return bool
      */
     public function setPragma($pragma)
     {
         try {
             if (CheckInput::checkNewInput($pragma)) {
                 $this->pragma = $pragma;
                 $this->headerArray['Pragma'] = 'Pragma: ' . $this->pragma;
                 $this->updateCount();
             } else {
                 throw new ExceptionHandler(__METHOD__ . ": pragma invalid.");
             }
         } catch (ExceptionHandler $e) {
             $e->execute();
             return false;
         }
         return true;
     }

     /** getTrailer
      *
      * @return mixed
      */
     public function getTrailer()
     {
         return $this->trailer;
     }

     /** setTrailer
      *
      * @param mixed $trailer
      *
      * @return bool
      */
     public function setTrailer($trailer)
     {
         try {
             if (CheckInput::checkNewInput($trailer)) {
                 $this->trailer = $trailer;
                 $this->headerArray['Trailer'] = 'Trailer: ' . $this->trailer;
                 $this->updateCount();
             } else {
                 throw new ExceptionHandler(__METHOD__ . ": trailer invalid.");
             }
         } catch (ExceptionHandler $e) {
             $e->execute();
             return false;
         }
         return true;
     }

     /** getTransferEncoding
      *
      * @return mixed
      */
     public function getTransferEncoding()
     {
         return $this->transferEncoding;
     }

     /** setTransferEncoding
      *
      * @param mixed $transferEncoding
      *
      * @return bool
      */
     public function setTransferEncoding($transferEncoding)
     {
         try {
             if (CheckInput::checkNewInput($transferEncoding)) {
                 $this->transferEncoding = $transferEncoding;
                 $this->headerArray['Transfer-Encoding'] = 'Transfer-Encoding: ' . $this->transferEncoding;
                 $this->updateCount();
             } else {
                 throw new ExceptionHandler(__METHOD__ . ": transferEncoding invalid.");
             }
         } catch (ExceptionHandler $e) {
             $e->execute();
             return false;
         }
         return true;
     }

     /** getUpgrade
      *
      * @return mixed
      */
     public function getUpgrade()
     {
         return $this->upgrade;
     }

     /** setUpgrade
      *
      * @param mixed $upgrade
      *
      * @return bool
      */
     public function setUpgrade($upgrade)
     {
         try {
             if (CheckInput::checkNewInput($upgrade)) {
                 $this->upgrade = $upgrade;
                 $this->headerArray['Upgrade'] = 'Upgrade: ' . $this->upgrade;
                 $this->updateCount();
             } else {
                 throw new ExceptionHandler(__METHOD__ . ": upgrade invalid.");
             }
         } catch (ExceptionHandler $e) {
             $e->execute();
             return false;
         }
         return true;
     }

     /** getVia
      *
      * @return mixed
      */
     public function getVia()
     {
         return $this->via;
     }

     /** setVia
      *
      * @param mixed $via
      *
      * @return bool
      */
     public function setVia($via)
     {
         try {
             if (CheckInput::checkNewInput($via)) {
                 $this->via = $via;
                 $this->headerArray['Via'] = 'Via: ' . $this->via;
                 $this->updateCount();

             } else {
                 throw new ExceptionHandler(__METHOD__ . ": via invalid.");
             }
         } catch (ExceptionHandler $e) {
             $e->execute();
             return false;
         }
         return true;
     }

     /** getWarning
      *
      * @return mixed
      */
     public function getWarning()
     {
         return $this->warning;
     }

     /** setWarning
      *
      * @param mixed $warning
      *
      * @return bool
      */
     public function setWarning($warning)
     {
         try {
             if (CheckInput::checkNewInput($warning)) {
                 $this->warning = $warning;
                 $this->headerArray['Warning'] = 'Warning: ' . $this->warning;
                 $this->updateCount();
             } else {
                 throw new ExceptionHandler(__METHOD__ . ": warning invalid.");
             }
         } catch (ExceptionHandler $e) {
             $e->execute();
             return false;
         }
         return true;
     }


} 