<?php
/**
 * PHP version 5.3
 * Created by PhpStorm.
 * User: texmorgan
 * Date: 4/17/14
 * Time: 4:48 PM
 */
require_once "interfaces/RequestHeaderInterface.php";
/**
 * Class RequestHeader
 *
 * @category ${NAMESPACE}
 * @package  RequestHeader
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated
 * @link     documentation/RequestHeader
 */
class RequestHeader
    extends Header
    implements RequestHeaderInterface
{
    /**
     * @var object RequestHeader a singleton instance of this class
     */
    static public $RequestHeader;
    protected $accept;
    protected $acceptCharset;
    protected $acceptEncoding;
    protected $acceptLanguage;
    protected $authorization;
    protected $expect;
    protected $from;
    protected $host;
    protected $ifMatch;
    protected $ifModifiedSince;
    protected $ifNoneMatch;
    protected $ifRange;
    protected $ifUnmodifiedSince;
    protected $maxForwards;
    protected $proxyAuthorization;
    protected $range;
    protected $referer;
    protected $TE;
    protected $userAgent;

    /** __construct
     */
    protected function __construct()
    {
        $this->initializeFromServer();
    }

    /** instance
     *
     * @return RequestHeader
     */
    static public function instance()
    {
        if ( !isset(self::$RequestHeader) ) {
            self::$RequestHeader = new RequestHeader();
        }
        return self::$RequestHeader;
    }

    /** factory
     *
     * @return RequestHeader
     */
    static public function factory()
    {
        return new RequestHeader();
    }

    protected function initializeFromServer()
    {
        $this->setup("HTTP_ACCEPT",$this->accept);
        $this->setup("HTTP_ACCEPT_CHARSET", $this->acceptCharset);
        $this->setup("HTTP_ACCEPT_ENCODING", $this->acceptEncoding);
        $this->setup("HTTP_ACCEPT_LANGUAGE", $this->acceptLanguage);
        $this->setup("HTTP_HOST", $this->host);
        $this->setup("HTTP_REFERER", $this->referer);
        $this->setup("HTTP_USER_AGENT", $this->userAgent);
    }

    /** getAccept
     *
     * @return mixed
     */
    public function getAccept()
    {
        return $this->accept;
    }

    /** setAccept
     *
     * @param mixed $accept
     *
     * @return bool
     */
    public function setAccept($accept)
    {
        try {
            if (CheckInput::checkNewInput($accept)) {
                $this->accept = $accept;
                $this->headerArray['Accept'] = 'Accept: ' . $this->accept;
                $this->updateCount();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": accept invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getAcceptCharset
     *
     * @return mixed
     */
    public function getAcceptCharset()
    {
        return $this->acceptCharset;
    }

    /** setAcceptCharset
     *
     * @param mixed $acceptCharset
     *
     * @return bool
     */
    public function setAcceptCharset($acceptCharset)
    {
        try {
            if (CheckInput::checkNewInput($acceptCharset)) {
                $this->acceptCharset = $acceptCharset;
                $this->headerArray['Accept-Charset'] = 'Accept-Charset: ' . $this->acceptCharset;
                $this->updateCount();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": acceptCharset invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getAcceptEncoding
     *
     * @return mixed
     */
    public function getAcceptEncoding()
    {
        return $this->acceptEncoding;
    }

    /** setAcceptEncoding
     *
     * @param mixed $acceptEncoding
     *
     * @return bool
     */
    public function setAcceptEncoding($acceptEncoding)
    {
        try {
            if (CheckInput::checkNewInput($acceptEncoding)) {
                $this->acceptEncoding = $acceptEncoding;
                $this->headerArray['Accept-Encoding'] = 'Accept-Encoding: ' . $this->acceptEncoding;
                $this->updateCount();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": acceptEncoding invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getAcceptLanguage
     *
     * @return mixed
     */
    public function getAcceptLanguage()
    {
        return $this->acceptLanguage;
    }

    /** setAcceptLanguage
     *
     * @param mixed $acceptLanguage
     *
     * @return bool
     */
    public function setAcceptLanguage($acceptLanguage)
    {
        try {
            if (CheckInput::checkNewInput($acceptLanguage)) {
                $this->acceptLanguage = $acceptLanguage;
                $this->headerArray['Accept-Language'] = 'Accept-Language: ' . $this->acceptLanguage;
                $this->updateCount();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": acceptLanguage invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getAuthorization
     *
     * @return mixed
     */
    public function getAuthorization()
    {
        return $this->authorization;
    }

    /** setAuthorization
     *
     * @param mixed $authorization
     *
     * @return bool
     */
    public function setAuthorization($authorization)
    {
        try {
            if (CheckInput::checkNewInput($authorization)) {
                $this->authorization = $authorization;
                $this->headerArray['Authorization'] = 'Authorization: ' . $this->authorization;
                $this->updateCount();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": authorization invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getExpect
     *
     * @return mixed
     */
    public function getExpect()
    {
        return $this->expect;
    }

    /** setExpect
     *
     * @param mixed $expect
     *
     * @return bool
     */
    public function setExpect($expect)
    {
        try {
            if (CheckInput::checkNewInput($expect)) {
                $this->expect = $expect;
                $this->headerArray['Expect'] = 'Expect: ' . $this->expect;
                $this->updateCount();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": expect invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getFrom
     *
     * @return mixed
     */
    public function getFrom()
    {
        return $this->from;
    }

    /** setFrom
     *
     * @param mixed $from
     *
     * @return bool
     */
    public function setFrom($from)
    {
        try {
            if (CheckInput::checkNewInput($from)) {
                $this->from = $from;
                $this->headerArray['From'] = 'From: ' . $this->from;
                $this->updateCount();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": from invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getHost
     *
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /** setHost
     *
     * @param mixed $host
     *
     * @return bool
     */
    public function setHost($host)
    {
        try {
            if (CheckInput::checkNewInput($host)) {
                $this->host = $host;
                $this->headerArray['Host'] = 'Host: ' . $this->host;
                $this->updateCount();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": host invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getIfMatch
     *
     * @return mixed
     */
    public function getIfMatch()
    {
        return $this->ifMatch;
    }

    /** setIfMatch
     *
     * @param mixed $ifMatch
     *
     * @return bool
     */
    public function setIfMatch($ifMatch)
    {
        try {
            if (CheckInput::checkNewInput($ifMatch)) {
                $this->ifMatch = $ifMatch;
                $this->headerArray['If-Match'] = 'If-Match: ' . $this->ifMatch;
                $this->updateCount();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": ifMatch invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getIfModifiedSince
     *
     * @return mixed
     */
    public function getIfModifiedSince()
    {
        return $this->ifModifiedSince;
    }

    /** setIfModifiedSince
     *
     * @param mixed $ifModifiedSince
     *
     * @return bool
     */
    public function setIfModifiedSince($ifModifiedSince)
    {
        try {
            if (CheckInput::checkNewInput($ifModifiedSince)) {
                $this->ifModifiedSince = $ifModifiedSince;
                $this->headerArray['If-Modified-Since'] = 'If-Modified-Since: ' . $this->ifModifiedSince;
                $this->updateCount();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": ifModifiedSince invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getIfNoneMatch
     *
     * @return mixed
     */
    public function getIfNoneMatch()
    {
        return $this->ifNoneMatch;
    }

    /** setIfNoneMatch
     *
     * @param mixed $ifNoneMatch
     *
     * @return bool
     */
    public function setIfNoneMatch($ifNoneMatch)
    {
        try {
            if (CheckInput::checkNewInput($ifNoneMatch)) {
                $this->ifNoneMatch = $ifNoneMatch;
                $this->headerArray['If-None-Match'] = 'If-None-Match: ' . $this->ifNoneMatch;
                $this->updateCount();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": ifNoneMatch invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getIfRange
     *
     * @return mixed
     */
    public function getIfRange()
    {
        return $this->ifRange;
    }

    /** setIfRange
     *
     * @param mixed $ifRange
     *
     * @return bool
     */
    public function setIfRange($ifRange)
    {
        try {
            if (CheckInput::checkNewInput($ifRange)) {
                $this->ifRange = $ifRange;
                $this->headerArray['If-Range'] = 'If-Range: ' . $this->ifRange;
                $this->updateCount();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": ifRange invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getIfUnmodifiedSince
     *
     * @return mixed
     */
    public function getIfUnmodifiedSince()
    {
        return $this->ifUnmodifiedSince;
    }

    /** setIfUnmodifiedSince
     *
     * @param mixed $ifUnmodifiedSince
     *
     * @return bool
     */
    public function setIfUnmodifiedSince($ifUnmodifiedSince)
    {
        try {
            if (CheckInput::checkNewInput($ifUnmodifiedSince)) {
                $this->ifUnmodifiedSince = $ifUnmodifiedSince;
                $this->headerArray['If-Unmodified-Since'] = 'If-Unmodified-Since: ' . $this->ifUnmodifiedSince;
                $this->updateCount();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": ifUnmodifiedSince invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getMaxForwards
     *
     * @return mixed
     */
    public function getMaxForwards()
    {
        return $this->maxForwards;
    }

    /** setMaxForwards
     *
     * @param mixed $maxForwards
     *
     * @return bool
     */
    public function setMaxForwards($maxForwards)
    {
        try {
            if (CheckInput::checkNewInput($maxForwards)) {
                $this->maxForwards = $maxForwards;
                $this->headerArray['Max-Forwards'] = 'Max-Forwards: ' . $this->maxForwards;
                $this->updateCount();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": maxForwards invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getProxyAuthorization
     *
     * @return mixed
     */
    public function getProxyAuthorization()
    {
        return $this->proxyAuthorization;
    }

    /** setProxyAuthorization
     *
     * @param mixed $proxyAuthorization
     *
     * @return bool
     */
    public function setProxyAuthorization($proxyAuthorization)
    {
        try {
            if (CheckInput::checkNewInput($proxyAuthorization)) {
                $this->proxyAuthorization = $proxyAuthorization;
                $this->headerArray['Proxy-Authorization'] = 'Proxy-Authorization: ' . $this->proxyAuthorization;
                $this->updateCount();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": proxyAuthorization invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getRange
     *
     * @return mixed
     */
    public function getRange()
    {
        return $this->range;
    }

    /** setRange
     *
     * @param mixed $range
     *
     * @return bool
     */
    public function setRange($range)
    {
        try {
            if (CheckInput::checkNewInput($range)) {
                $this->range = $range;
                $this->headerArray['Range'] = 'Range: ' . $this->range;
                $this->updateCount();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": range invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getReferer
     *
     * @return mixed
     */
    public function getReferer()
    {
        return $this->referer;
    }

    /** setReferer
     *
     * @param mixed $referer
     *
     * @return bool
     */
    public function setReferer($referer)
    {
        try {
            if (CheckInput::checkNewInput($referer)) {
                $this->referer = $referer;
                $this->headerArray['Referer'] = 'Referer: ' . $this->referer;
                $this->updateCount();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": referer invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getTE
     *
     * @return mixed
     */
    public function getTE()
    {
        return $this->TE;
    }

    /** setTE
     *
     * @param mixed $TE
     *
     * @return bool
     */
    public function setTE($TE)
    {
        try {
            if (CheckInput::checkNewInput($TE)) {
                $this->TE = $TE;
                $this->headerArray['TE'] = 'TE: ' . $this->TE;
                $this->updateCount();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": TE invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getUserAgent
     *
     * @return mixed
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }

    /** setUserAgent
     *
     * @param mixed $userAgent
     *
     * @return bool
     */
    public function setUserAgent($userAgent)
    {
        try {
            if (CheckInput::checkNewInput($userAgent)) {
                $this->userAgent = $userAgent;
                $this->headerArray['User-Agent'] = 'User-Agent: ' . $this->userAgent;
                $this->updateCount();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": userAgent invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

} 