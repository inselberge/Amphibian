<?php
/**
 * PHP version 5.3
 * Created by PhpStorm.
 * User: texmorgan
 * Date: 4/17/14
 * Time: 5:24 PM
 */
require_once "interfaces/RequestInterface.php";
/**
 * Class Request
 *
 * @category ${NAMESPACE}
 * @package  Request
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated
 * @link     documentation/Request
 */
class Request
    implements RequestInterface
{
    /**
     * @var  requestLine
     */
    protected $requestLine;
    /**
     * @var  requestMethod
     */
    protected $requestMethod;
    /**
     * @var  requestURI
     */
    protected $requestURI;
    /**
     * @var  httpVersion
     */
    protected $httpVersion;

    /**
     * @var  generalHeader
     */
    protected $generalHeader;
    /**
     * @var  requestHeader
     */
    protected $requestHeader;
    /**
     * @var  entityHeader
     */
    protected $entityHeader;

    /**
     * @var  messageBody
     */
    protected $messageBody;

    /**
     * @var array acceptableMethods
     */
    static protected $acceptableMethods = array("OPTIONS","GET","HEAD","POST","PUT","DELETE","TRACE","CONNECT","PATCH");
    /**
     * @var object Request a singleton instance of this class
     */
    static public $Request;

    /** __construct
     */
    protected function __construct()
    {

    }

    /** instance
     *
     * @return Request
     */
    static public function instance()
    {
        if ( !isset(self::$Request) ) {
            self::$Request = new Request();
        }
        return self::$Request;
    }

    /** factory
     *
     * @return Request
     */
    static public function factory()
    {
        return new Request();
    }

    /** setup
     *
     * @param string $index
     * @param mixed  &$variable
     *
     * @return bool
     */
    protected function setup($index, &$variable)
    {
        if (CheckInput::checkSet($index)) {
            if (CheckInput::checkSet($_SERVER[$index])) {
                $variable = $_SERVER[$index];
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /** getEntityHeader
     *
     * @return mixed
     */
    public function getEntityHeader()
    {
        return $this->entityHeader;
    }

    /** setEntityHeader
     *
     * @param mixed $entityHeader
     *
     * @return bool
     */
    public function setEntityHeader($entityHeader)
    {
        try {
            if (CheckInput::checkNewInput($entityHeader)) {
                $this->entityHeader = $entityHeader;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": entityHeader invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getGeneralHeader
     *
     * @return mixed
     */
    public function getGeneralHeader()
    {
        return $this->generalHeader;
    }

    /** setGeneralHeader
     *
     * @param mixed $generalHeader
     *
     * @return bool
     */
    public function setGeneralHeader($generalHeader)
    {
        try {
            if (CheckInput::checkNewInput($generalHeader)) {
                $this->generalHeader = $generalHeader;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": generalHeader invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getHttpVersion
     *
     * @return mixed
     */
    public function getHttpVersion()
    {
        return $this->httpVersion;
    }

    /** setHttpVersion
     *
     * @param mixed $httpVersion
     *
     * @return bool
     */
    public function setHttpVersion($httpVersion)
    {
        try {
            if (CheckInput::checkNewInput($httpVersion)) {
                $this->httpVersion = $httpVersion;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": httpVersion invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getMessageBody
     *
     * @return mixed
     */
    public function getMessageBody()
    {
        return $this->messageBody;
    }

    /** setMessageBody
     *
     * @param mixed $messageBody
     *
     * @return bool
     */
    public function setMessageBody($messageBody)
    {
        try {
            if (CheckInput::checkNewInput($messageBody)) {
                $this->messageBody = $messageBody;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": messageBody invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getRequestHeader
     *
     * @return mixed
     */
    public function getRequestHeader()
    {
        return $this->requestHeader;
    }

    /** setRequestHeader
     *
     * @param mixed $requestHeader
     *
     * @return bool
     */
    public function setRequestHeader($requestHeader)
    {
        try {
            if (CheckInput::checkNewInput($requestHeader)) {
                $this->requestHeader = $requestHeader;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": requestHeader invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getRequestLine
     *
     * @return mixed
     */
    public function getRequestLine()
    {
        return $this->requestLine;
    }

    /** setRequestLine
     *
     * @param mixed $requestLine
     *
     * @return bool
     */
    public function setRequestLine($requestLine)
    {
        try {
            if (CheckInput::checkNewInput($requestLine)) {
                $this->requestLine = $requestLine;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": requestLine invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getRequestMethod
     *
     * @return mixed
     */
    public function getRequestMethod()
    {
        return $this->requestMethod;
    }

    /** setRequestMethod
     *
     * @param mixed $requestMethod
     *
     * @return bool
     */
    public function setRequestMethod($requestMethod)
    {
        try {
            if (CheckInput::checkNewInput($requestMethod)) {
                $this->requestMethod = $requestMethod;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": requestMethod invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getRequestURI
     *
     * @return mixed
     */
    public function getRequestURI()
    {
        return $this->requestURI;
    }

    /** setRequestURI
     *
     * @param mixed $requestURI
     *
     * @return bool
     */
    public function setRequestURI($requestURI)
    {
        try {
            if (CheckInput::checkNewInput($requestURI)) {
                $this->requestURI = $requestURI;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": requestURI invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }


} 