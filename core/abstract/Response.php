<?php
/**
 * PHP version 5.3
 * Created by PhpStorm.
 * User: texmorgan
 * Date: 4/17/14
 * Time: 12:20 PM
 */
require_once "interfaces".DIRECTORY_SEPARATOR."ResponseInterface.php";
/**
 * Class Response
 *
 * @category ${NAMESPACE}
 * @package  Response
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated
 * @link     documentation/Response
 */
abstract class Response
    implements ResponseInterface
{
    /**
     * @var string httpVersion
     */
    protected $httpVersion = "HTTP/1.1";
    /**
     * @var string status a HTTP response status
     */
    protected $status;
    /**
     * @var object generalHeader a GeneralHeader object
     */
    protected $generalHeader;
    /**
     * @var object responseHeader a ResponseHeader object
     */
    protected $responseHeader;
    /**
     * @var object entityHeader an EntityHeader object
     */
    protected $entityHeader;
    /**
     * @var array payload the message to print in return
     */
    protected $payload;
    /**
     * @var string responseMessage a valid HTTP response message
     */
    protected $responseMessage;

    /**
     * @var array statusArray
     */
    static protected $statusArray = array(
        '100' => '100 Continue',
        '101' => '101 Switching Protocols',
        '200' => '200 OK',
        '201' => '201 Created',
        '202' => '202 Accepted',
        '203' => '203 Non-Authoritative Information',
        '204' => '204 No Content',
        '205' => '205 Reset Content',
        '206' => '206 Partial Content',
        '300' => '300 Multiple Choices',
        '301' => '301 Moved Permanently',
        '302' => '302 Found',
        '303' => '303 See Other',
        '304' => '304 Not Modified',
        '305' => '305 Use Proxy',
        '307' => '307 Temporary Redirect',
        '400' => '400 Bad Request',
        '401' => '401 Unauthorized',
        '402' => '402 Payment Required',
        '403' => '403 Forbidden',
        '404' => '404 Not Found',
        '405' => '405 Method Not Allowed',
        '406' => '406 Not Acceptable',
        '407' => '407 Proxy Authentication Required',
        '408' => '408 Request Time-out',
        '409' => '409 Conflict',
        '410' => '410 Gone',
        '411' => '411 Length Required',
        '412' => '412 Precondition Failed',
        '413' => '413 Request Entity Too Large',
        '414' => '414 Request-URI Too Large',
        '415' => '415 Unsupported Media Type',
        '416' => '416 Requested range not satisfiable',
        '417' => '417 Expectation Failed',
        '500' => '500 Internal Server Error',
        '501' => '501 Not Implemented',
        '502' => '502 Bad Gateway',
        '503' => '503 Service Unavailable',
        '504' => '504 Gateway Time-out',
        '505' => '505 HTTP Version not supported'
    );

    /** getHttpVersion
     *
     * @return string
     */
    public function getHttpVersion()
    {
        return $this->httpVersion;
    }

    /** setHttpVersion
     *
     * @param string $httpVersion the version of HTTP protocol
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

    /** getStatus
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /** setStatus
     *
     * @param integer $statusCode an HTTP Response code value
     *
     * @return bool
     */
    public function setStatus($statusCode)
    {
        try {
            if (CheckInput::checkSet($statusCode)) {
                if (is_numeric($statusCode)) {
                    $this->status = $this->httpVersion." ".self::$statusArray[$statusCode] . chr(13) . chr(10);
                } else {
                    throw new exceptionHandler(__METHOD__ . ": code must be numeric.");
                }
            } else {
                throw new exceptionHandler(__METHOD__ . ": status code required.");
            }
        } catch (exceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
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
     * @param object &$entityHeader a valid EntityHeader object
     *
     * @return bool
     */
    public function setEntityHeader(&$entityHeader)
    {
        try {
            if (CheckInput::checkNewObject($entityHeader)) {
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
     * @param object &$generalHeader a valid GeneralHeaderObject
     *
     * @return bool
     */
    public function setGeneralHeader(&$generalHeader)
    {
        try {
            if (CheckInput::checkNewObject($generalHeader)) {
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

    /** getPayload
     *
     * @return mixed
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /** setPayload
     *
     * @param mixed $payload
     *
     * @return bool
     */
    public function setPayload($payload)
    {
        try {
            if (CheckInput::checkNewInput($payload)) {
                $this->payload = $payload;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": payload invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getResponseHeader
     *
     * @return mixed
     */
    public function getResponseHeader()
    {
        return $this->responseHeader;
    }

    /** setResponseHeader
     *
     * @param object &$responseHeader a valid ResponseHeader object
     *
     * @return bool
     */
    public function setResponseHeader(&$responseHeader)
    {
        try {
            if (CheckInput::checkNewObject($responseHeader)) {
                $this->responseHeader = $responseHeader;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": responseHeader invalid.");
            }
        } catch (ExceptionHandler $e) {
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
            if (CheckInput::checkSet($this->status)) {
                //status
                header($this->status. chr(13) . chr(10));
                //general header
                if ( $this->checkGeneralHeader() ) {
                    $this->extractHeaderArray($this->generalHeader->getHeaderArray());
                }
                //response header
                if ($this->checkResponseHeader()) {
                    $this->extractHeaderArray($this->responseHeader->getHeaderArray());
                }
                //entity header
                if ($this->checkEntityHeader()) {
                    $this->extractHeaderArray($this->entityHeader->getHeaderArray());
                }
                //payload
            } else {
                throw new exceptionHandler(__METHOD__ . ": status required.");
            }
        } catch (exceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkGeneralHeader
     *
     * @return bool
     */
    protected function checkGeneralHeader()
    {
        try {
            if (CheckInput::checkSet($this->generalHeader)) {
                if ($this->generalHeader->getCount() > 0) {
                    return true;
                } else {
                    return false;
                }
            } else {
                throw new exceptionHandler(__METHOD__ . ": generalHeader invalid.");
            }
        } catch (exceptionHandler $e) {
            $e->execute();
            return false;
        }
    }

    /** checkResponseHeader
     *
     * @return bool
     */
    protected function checkResponseHeader()
    {
        try {
            if (CheckInput::checkSet($this->responseHeader)) {
                if ($this->responseHeader->getCount() > 0) {
                    return true;
                } else {
                    return false;
                }
            } else {
                throw new exceptionHandler(__METHOD__ . ": responseHeader invalid.");
            }
        } catch (exceptionHandler $e) {
            $e->execute();
            return false;
        }
    }

    /** checkEntityHeader
     *
     * @return bool
     */
    protected function checkEntityHeader()
    {
        try {
            if (CheckInput::checkSet($this->entityHeader)) {
                if ( $this->entityHeader->getCount() > 0 ) {
                    return true;
                } else {
                    return false;
                }
            } else {
                throw new exceptionHandler(__METHOD__ . ": entityHeader invalid.");
            }
        } catch (exceptionHandler $e) {
            $e->execute();
            return false;
        }
    }

    /** checkPayload
     *
     * @return bool
     */
    protected function checkPayload()
    {
        try {
            if (!CheckInput::checkSet($this->payload)) {
                throw new exceptionHandler(__METHOD__ . ": payload invalid.");
            }
        } catch (exceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** convert
     *
     * @return mixed
     */
    abstract protected function convert();
} 