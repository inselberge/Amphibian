<?php
/**
 * PHP Version 5.4.9-4ubuntu2.2
 * Created by PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 10/31/13
 * Time: 2:48 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once AMPHIBIAN_CORE_NEUTRAL . "CheckInput.php";
require_once "interfaces".DIRECTORY_SEPARATOR."APIInterface.php";
/**
 * Class API
 * adapted from http://coreymaynard.com/blog/creating-a-restful-api-with-php/
 *
 * @category API
 * @package  API
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/Amphibian/documentation/API
 */
class API 
    implements APIInterface
{
    /**
     * @var array status the standard HTTP response codes
     */
    static protected $status = [
        100 => 'Continue',
        101 => 'Switching Protocols',
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        306 => '(Unused)',
        307 => 'Temporary Redirect',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported'
    ];
    /**
     * @var integer code the HTTP status code
     */
    protected $code;
    /**
     * @var mixed request the actual request from the user
     */
    protected $request;
    /**
     * @var mixed data the information to either return or process
     */
    protected $data;
    /**
     * @var string method the HTTP request method, i.e. GET, POST, PUT, etc.
     */
    protected $method;
    /**
     * @var string endpoint the model or agency to use
     */
    protected $endpoint;
    /**
     * @var string verb the action to take
     */
    protected $verb;
    /**
     * @var array args the arguments for the API call
     */
    protected $args;
    /**
     * @var resource file the file to store the data from a PUT
     */
    protected $file;
    /**
     * @var string key the API access key
     */
    protected $key;
    /**
     * @var object API a singleton instance of this class
     */
    static public $API;

    /** __construct
     *
     * @param mixed $request the actual request from the user
     */
    protected function __construct($request)
    {
        try {
            if ( CheckInput::checkNewInput($request) ) {
                $this->initHeader();
                if ( $this->extractArgs($request) ) {
                    if ( $this->extractEndPoint() ) {
                        $this->extractVerb();
                        if ( $this->extractMethod() ) {
                            $this->extractPutDelete();
                        }
                    }
                    $this->prepareRequest();
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": request required!");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** initHeader
     *
     * @return void
     */
    protected function initHeader()
    {
        header("Access-Control-Allow-Orgin: *");
        header("Access-Control-Allow-Methods: *");
        header("Content-Type: application/json");
    }

    /** extractArgs
     *
     * @param mixed $request the request from the user
     *
     * @return bool
     */
    protected function extractArgs($request)
    {
        try {
            if ( CheckInput::checkNewInput($request) ) {
                $this->args = explode('/', rtrim($request, '/'));
            } else {
                throw new ExceptionHandler(__METHOD__ . ": invalid request");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** extractEndPoint
     *
     * @return bool
     */
    protected function extractEndPoint()
    {
        try {
            if ( CheckInput::checkSet($this->args) ) {
                $this->endpoint = array_shift($this->args);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": invalid args");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** extractVerb
     *
     * @return bool
     */
    protected function extractVerb()
    {
        try {
            if ( CheckInput::checkSet($this->args) ) {
                if (array_key_exists(0, $this->args) && !is_numeric($this->args[0])) {
                    $this->verb = array_shift($this->args);
                } else {
                    //throw new ExceptionHandler(__METHOD__ . ": no verb");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": invalid args");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** extractMethod
     *
     * @return bool
     */
    protected function extractMethod()
    {
        try {
            if ( CheckInput::checkNewInput($_SERVER["REQUEST_METHOD"]) ) {
                $this->method = $_SERVER["REQUEST_METHOD"];
            } else {
                throw new ExceptionHandler(__METHOD__ . ": invalid request method");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** extractPutDelete
     *
     * @return bool
     */
    protected function extractPutDelete()
    {
        try {
            if ( $this->method == "POST" ) {
                if ( $this->checkXHTTP() ) {
                    if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'DELETE') {
                        $this->method = 'DELETE';
                    } else if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'PUT') {
                        $this->method = 'PUT';
                    } else {
                        throw new ExceptionHandler(__METHOD__.": unexpected header");
                    }
                }
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkXHTTP
     *
     * @return bool
     */
    protected function checkXHTTP()
    {
        if ( array_key_exists('HTTP_X_HTTP_METHOD', $_SERVER) ) {
            return true;
        } else {
            return false;
        }
    }

    /** prepareRequest
     *
     * @return bool
     */
    protected function prepareRequest()
    {
        try {
            if ( CheckInput::checkSet($this->method) ) {
                if ($this->method == "DELETE") {
                    $this->prepareDelete();
                } elseif ($this->method == "POST") {
                    $this->preparePost();
                } elseif ($this->method == "GET") {
                    $this->prepareGet();
                } elseif ($this->method == "PUT") {
                    $this->preparePut();
                } elseif ($this->method == "PATCH") {
                    $this->preparePatch();
                } elseif ($this->method == "HEAD") {
                    $this->prepareHead();
                } elseif ($this->method == "OPTIONS") {
                    $this->prepareOptions();
                } elseif ($this->method == "TRACE") {
                    $this->prepareTrace();
                } elseif ($this->method == "CONNECT") {
                    $this->prepareConnect();
                } else {
                    throw new ExceptionHandler(__METHOD__.": invalid method");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": method required");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** prepareDelete
     *
     * @return void
     */
    protected function prepareDelete()
    {
        /*
         * Intentionally left blank
         */
    }

    /** preparePost
     *
     * @return bool
     */
    protected function preparePost()
    {
        try {
            if ( CheckInput::checkNewInputArray($_POST) ) {
                $this->request = $this->clean($_POST);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": POST required");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** prepareGet
     *
     * @return bool
     */
    protected function prepareGet()
    {
        try {
            if ( CheckInput::checkNewInputArray($_GET) ) {
                $this->request = $this->clean($_GET);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": GET required");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** preparePut
     *
     * @return bool
     */
    protected function preparePut()
    {
        try {
            if ( $this->prepareGet() ) {
                $this->file = file_get_contents("php://input");
            } else {
                throw new ExceptionHandler(__METHOD__ . ": prepareGet failed");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** preparePatch
     *
     * @return void
     */
    protected function preparePatch()
    {
        /*
         * Intentionally left blank
         */
    }

    /** prepareHead
     *
     * @return void
     */
    protected function prepareHead()
    {
        /*
         * Intentionally left blank
         */
    }

    /** prepareOptions
     *
     * @return void
     */
    protected function prepareOptions()
    {
        /*
         * Intentionally left blank
         */
    }

    /** prepareTrace
     *
     * @return void
     */
    protected function prepareTrace()
    {
        /*
         * Intentionally left blank
         */
    }

    /** prepareConnect
     *
     * @return void
     */
    protected function prepareConnect()
    {
        /*
         * Intentionally left blank
         */
    }

    /** clean
     *
     * @param mixed $data the information to either return or process
     *
     * @return array|bool|string
     */
    protected function clean($data)
    {
        $cleaned = array();
        try {
            if ( CheckInput::checkSet($data) ) {
                if ( is_array($data) ) {
                    foreach ( $data as $key=>$value) {
                        $cleaned[$key] = $this->clean($value);
                    }
                } else {
                    $cleaned = trim(strip_tags($data));
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": data not set");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return $cleaned;
    }

    /** instance
     *
     * @param mixed $request the request from the user
     * @param mixed $origin  the request origin
     *
     * @return API
     */
    static public function instance($request, $origin)
    {
        if ( !isset(self::$API) ) {
            self::$API = new API($request);
        }
        return self::$API;
    }

    /**  setKey
     *
     * @param string $key the API key
     *
     * @return boolean
     */
    public function setKey( $key )
    {
        try {
            if ( CheckInput::checkNewInput($key) ) {
                $this->key = $key;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": key is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getKey
     *
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /** execute
     *
     * @return bool|string
     */
    public function execute()
    {
        try {
            if ( CheckInput::checkSet($this->endpoint) ) {
                if ( $this->checkActionAvailable() ) {
                    $this->data = $this->{$this->endpoint}($this->args);
                    if ( isset($this->data) ) {
                        $this->code = 200;
                    } else {
                        $this->data = '';
                        $this->code = 400;
                    }
                    return $this->response();
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": unknown end point");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** checkActionAvailable
     *
     * @return bool
     */
    protected function checkActionAvailable()
    {
        try {
            if ( $this->checkClass() ) {
                if ( ! $this->checkMethod() ) {
                    throw new ExceptionHandler(__METHOD__ . ": method not available");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": class not available");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkClass
     *
     * @return bool
     */
    protected function checkClass()
    {
        if ( class_exists($this->endpoint) ) {
            return true;
        } else {
            return false;
        }
    }

    /** checkMethod
     *
     * @return bool
     */
    protected function checkMethod()
    {
        if ( method_exists($this->endpoint, $this->verb)) {
            return true;
        } else {
            return false;
        }
    }

    /** response
     *
     * @return bool|string
     */
    protected function response()
    {
        try {
            if ( $this->checkResponseReady() ) {
                header("HTTP/1.1" . " ". $this->code . " " . $this->translateCode($this->code));
                return json_encode($this->data);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": response is not ready");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** checkResponseReady
     *
     * @return bool
     */
    protected function checkResponseReady()
    {
        try {
            if ( CheckInput::checkSet($this->code) ) {
                if ( CheckInput::checkSet($this->data) ) {
                } else {
                    throw new ExceptionHandler(__METHOD__ . ": data not set");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": code not set");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** translateCode
     *
     * @param integer $code a standard HTTP response codes
     *
     * @return bool
     */
    protected function translateCode($code)
    {
        try {
            if ( CheckInput::checkNewInput($code) ) {
                if ( isset(self::$status[$code]) ) {
                    return self::$status[$code];
                } else {
                    return self::$status[500];
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": invalid code.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }
}
//echo phpinfo();