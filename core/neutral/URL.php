<?php
/**
 * PHP version: 5.4.9-4ubuntu2.2
 *
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/25/13
 * Time: 11:06 AM
 *
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once "interfaces".DIRECTORY_SEPARATOR."URLInterface.php";
require_once "CheckInput.php";
/**
 * Class URL
 *
 * @category Helper
 * @package  Core
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/URL
 */
class URL
    implements URLInterface
{
    /**
     * @var string urlString the base string of this class
     */
    protected $urlString;
    /**
     * @var string scheme the scheme(http,etc.) section of a URL
     */
    protected $scheme;
    /**
     * @var string host the host section of a URL
     */
    protected $host;
    /**
     * @var integer port the port section of a URL
     */
    protected $port;
    /**
     * @var string user the user section of a URL
     */
    protected $user;
    /**
     * @var string pass the password section of a URL
     */
    protected $pass;
    /**
     * @var string path the path section of a URL
     */
    protected $path;
    /**
     * @var string page the page section of a URL
     */
    protected $page;
    /**
     * @var string query the query section of a URL
     */
    protected $query;
    /**
     * @var string fragment the fragment section of a URL
     */
    protected $fragment;
    /**
     * @var boolean status true = action successful, false = action failed
     */
    protected $status;
    /**
     * @var string rawURL the raw URL
     */
    protected $rawURL;
    /**
     * @var array headers an array of the headers sent
     */
    protected $headers;
    /**
     * @var array metaTags an array of the meta tags
     */
    protected $metaTags;
    /**
     * @var object URL a singleton instance of this class
     */
    public static $URL;

    /** __construct
     *
     * @param string $urlString an URL string to use
     */
    protected function __construct( $urlString )
    {
        try {
            if ( CheckInput::checkNewInput($urlString) ) {
                $this->urlString = $urlString;
                $this->stripLastSlash();
                $this->metaTags = array();
                $this->headers = array();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": invalid URL string.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** instance
     *
     * @param string $urlString an URL string to use
     *
     * @return URL
     */
    static public function instance( $urlString )
    {
        if ( !isset(self::$URL) ) {
            self::$URL = new URL($urlString);
        } else {
            //self::setUrlString($urlString);
        }
        return self::$URL;
    }

    /**  setUrlString
     *
     * @param mixed $urlString manually set the urlString variable
     *
     * @return boolean
     */
    public function setUrlString( $urlString )
    {
        try {
            if ( CheckInput::checkNewInput($urlString) ) {
                $this->urlString = $urlString;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": urlString is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** stripLastSlash
     *
     * @return bool
     */
    protected function stripLastSlash()
    {
        try {
            if ( CheckInput::checkSet($this->urlString) ) {
                if ( substr($this->urlString, -1) == "/" ) {
                    $this->urlString = substr($this->urlString, 0, -1);
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": URL required!");
            }
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
            if ( !$this->explodeURLBasic() ) {
                throw new ExceptionHandler(__METHOD__ . ": URL explosion error.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** explodeURLBasic
     *
     * @return bool
     */
    protected function explodeURLBasic()
    {
        try {
            if ( CheckInput::checkNewInput($this->urlString) ) {
                $this->extractHost();
                $this->extractPath();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": URL string must be set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** explodeURLFull
     *
     * @return bool
     */
    public function explodeURLFull()
    {
        try {
            if ( CheckInput::checkNewInput($this->urlString) ) {
                $this->extractScheme();
                $this->extractHost();
                $this->extractPort();
                $this->extractUser();
                $this->extractPass();
                $this->extractPath();
                $this->extractQuery();
                $this->extractFragment();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": URL string must be set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**  setFragment
     *
     * @return boolean
     */
    protected function extractFragment()
    {
        try {
            $this->status = parse_url($this->urlString, PHP_URL_FRAGMENT);
            if ( $this->status != false ) {
                $this->fragment = trim($this->status, "/");
                unset($this->status);
            } else {
                return false;
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getFragment
     *
     * @return mixed
     */
    public function getFragment()
    {
        return $this->fragment;
    }

    /**  setHost
     *
     * @return boolean
     */
    protected function extractHost()
    {
        try {
            $this->status = parse_url($this->urlString, PHP_URL_HOST);
            if ( $this->status != false ) {
                $this->host = trim($this->status, "/");
                unset($this->status);
            } else {
                return false;
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getHost
     *
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**  setPass
     *
     * @return boolean
     */
    protected function extractPass()
    {
        try {
            $this->status = parse_url($this->urlString, PHP_URL_PASS);
            if ( $this->status != false ) {
                $this->pass = trim($this->status, "/");
                unset($this->status);
            } else {
                return false;
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getPass
     *
     * @return mixed
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**  setPath
     *
     * @return boolean
     */
    protected function extractPath()
    {
        try {
            $this->status = parse_url($this->urlString, PHP_URL_PATH);
            if ( CheckInput::checkNewInput($this->status) ) {
                $this->path = trim($this->status, "/");
                unset($this->status);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": path is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getPath
     *
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**  setPort
     *
     * @return boolean
     */
    protected function extractPort()
    {
        try {
            $this->status =  parse_url($this->urlString, PHP_URL_PORT);
            if ( $this->status != false ) {
                $this->port = trim($this->status, "/");
                unset($this->status);
            } else {
                return false;
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getPort
     *
     * @return mixed
     */
    public function getPort()
    {
        return $this->port;
    }

    /**  extractQuery
     *
     * @return boolean
     */
    protected function extractQuery()
    {
        try {
            $this->status = parse_url($this->urlString, PHP_URL_QUERY);
            if ( $this->status != false ) {
                $this->query = trim($this->status, "/");
                unset($this->status);
            } else {
                return false;
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getQuery
     *
     * @return mixed
     */
    public function getQuery()
    {
        return $this->query;
    }

    /** getSchemeFromProtocol
     *
     * @return null|string
     */
    public function getSchemeFromProtocol()
    {

        if ( isset($_SERVER["SERVER_PROTOCOL"]) ) {
            $protocol = $_SERVER["SERVER_PROTOCOL"];
        } else {
            list($protocol, $junk) = explode("://", strtoupper($this->urlString));
            unset($junk);
        }
        if ( strstr($protocol, "HTTPS") ) {
            return 'https';
        } elseif ( strstr($protocol, "HTTP") ) {
            return 'http';
        } elseif ( strstr($protocol, "SFTP") ) {
            return 'sftp';
        } elseif ( strstr($protocol, "FTP") ) {
            return 'ftp';
        } elseif ( strstr($protocol, "GIT") ) {
            return 'git';
        } elseif ( strstr($protocol, "SSH") ) {
            return 'ssh';
        } elseif ( strstr($protocol, "SSL") ) {
            return 'ssl';
        } else {
            return null;
        }
    }

    /**  extractScheme
     *
     * @return boolean
     */
    protected function extractScheme()
    {
        try {
            $this->status = parse_url($this->urlString, PHP_URL_SCHEME);
            if ( $this->status != false ) {
                $this->scheme = trim($this->status, "/");
                unset($this->status);
            } else {
                return false;
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getScheme
     *
     * @return mixed
     */
    public function getScheme()
    {
        return $this->scheme;
    }

    /**  setUser
     *
     * @return boolean
     */
    protected function extractUser()
    {
        try {
            $this->status = parse_url($this->urlString, PHP_URL_USER);
            if ( $this->status != false ) {
                $this->user = trim($this->status, "/");
                unset($this->status);
            } else {
                return false;
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getUser
     *
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**  setRawURL
     *
     * @param mixed $rawURL manually set the rawURL
     *
     * @return boolean
     */
    public function setRawURL( $rawURL )
    {
        try {
            if ( CheckInput::checkNewInput($rawURL) ) {
                $this->rawURL = $rawURL;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": rawURL is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getRawURL
     *
     * @return mixed
     */
    public function getRawURL()
    {
        return $this->rawURL;
    }

    /** rawEncode
     *
     * @return bool
     */
    public function rawEncode()
    {
        try {
            if ( CheckInput::checkNewInput($this->rawURL) ) {
                $this->urlString = rawurlencode($this->rawURL);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": rawUrl is not set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** rawDecode
     *
     * @return bool
     */
    public function rawDecode()
    {
        try {
            if ( CheckInput::checkNewInput($this->urlString) ) {
                $this->rawURL = rawurldecode($this->urlString);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": urlString is not set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** encode
     *
     * @return bool
     */
    public function encode()
    {
        try {
            if ( CheckInput::checkNewInput($this->rawURL) ) {
                $this->urlString = urlencode($this->rawURL);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": rawURL is not set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** decode
     *
     * @return bool
     */
    public function decode()
    {
        try {
            if ( CheckInput::checkNewInput($this->urlString) ) {
                $this->rawURL = urldecode($this->urlString);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": urlString is not set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**  setHeaders
     *
     * @param mixed $headers an array of headers to merge with current headers
     *
     * @return boolean
     */
    public function setHeaders( $headers )
    {
        try {
            if ( CheckInput::checkNewInputArray($headers) ) {
                $this->headers = array_merge($this->headers, $headers);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": headers is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getHeaders
     *
     * @return mixed
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /** extractHeaders
     *
     * @return bool
     */
    public function extractHeaders()
    {
        try {
            if ( CheckInput::checkNewInput($this->rawURL) ) {
                $this->setStreamContextToHead();
                $this->headers = get_headers($this->rawURL, 1);
                $this->revertStreamContext();
                if ( isset($this->headers[0]) ) {
                    $this->headers["Response"] = substr($this->headers[0], 9, 3);
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": rawURL is not set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setStreamContextToHead
     *
     * @return resource
     */
    protected function setStreamContextToHead()
    {
        return stream_context_set_default(
            array( 'http' => array( 'method' => 'HEAD' ) )
        );
    }

    /** revertStreamContext
     *
     * @return resource
     */
    protected function revertStreamContext()
    {
        return stream_context_set_default(
            array( 'http' => array( 'method' => 'GET' ) )
        );
    }

    /**  setMetaTags
     *
     * @param mixed $metaTags an array of meta tags to merge with current tags
     *
     * @return boolean
     */
    public function setMetaTags( $metaTags )
    {
        try {
            if ( CheckInput::checkNewInputArray($metaTags) ) {
                $this->metaTags = array_merge($this->metaTags, $metaTags);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": metaTags is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getMetaTags
     *
     * @return mixed
     */
    public function getMetaTags()
    {
        return $this->metaTags;
    }

    /** extractMetaTags
     *
     * @return bool
     */
    public function extractMetaTags()
    {
        try {
            if ( CheckInput::checkNewInput($this->rawURL) ) {
                $this->metaTags = get_meta_tags($this->rawURL);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": rawURL is not set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }
}
/*
$ur = URL::instance('http://localhost/Phatness/Week1%20Introduction/phpinfo.php');
$ur->execute();
print_r($ur);
*/