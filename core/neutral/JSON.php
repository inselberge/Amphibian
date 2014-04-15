<?php
/**
 * PHP version 5.4.17
 * Created by JetBrains PhpStorm.
 * User: Carl "Tex" Morgan
 * Date: 5/24/13
 * Time: 1:26 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once "interfaces".DIRECTORY_SEPARATOR."JSONInterface.php";
require_once "CheckInput.php";
/**
 * Class JSON
 *
 * @category Helper
 * @package  Core
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/JSON
 */
class JSON
    implements JSONInterface
{
    /**
     * @var string url the url to fetch
     */
    public $url;
    /**
     * @var array arrayJSON the JSON object decoded to an array
     */
    public $arrayJSON;
    /**
     * @var object objectJSON the JSON object encoded
     */
    public $objectJSON;
    /**
     * @var integer errorJSON an integer denoting the error
     */
    protected $errorJSON;
    /**
     * @var array postDefaults an array storing the default flags for posts
     */
    protected $postDefaults;
    /**
     * @var array getDefaults an array storing the default flags for get
     */
    protected $getDefaults;
    /**
     * @var array cURLOptions an array storing the cURL options
     */
    protected $cURLOptions;
    /**
     * @var resource cURLHandle the handle for the cURL call
     */
    protected $cURLHandle;
    /**
     * @var mixed cURLResult stores the result on success, or false on failure
     */
    protected $cURLResult;

    /** __construct
     */
    public function __construct()
    {
        $this->arrayJSON    = array();
        $this->objectJSON   = null;
        $this->cURLOptions  = array();
        $this->postDefaults = array( 
            CURLOPT_POST => 1, 
            CURLOPT_HEADER => 0,
            CURLOPT_FRESH_CONNECT => 1, 
            CURLOPT_RETURNTRANSFER => 1, 
            CURLOPT_FORBID_REUSE => 1, 
            CURLOPT_TIMEOUT => 4 
        );
        $this->getDefaults  = array( 
            CURLOPT_HEADER => 0, 
            CURLOPT_RETURNTRANSFER => true, 
            CURLOPT_TIMEOUT => 4 
        );
    }

    /** setURL
     *
     * @param string $url a valid URL
     *
     * @return bool
     */
    public function setURL( $url )
    {
        try {
            if ( CheckInput::checkNewInput($url) ) {
                $this->url = $url;
                $this->postDefaults[CURLOPT_URL] = $url;
            } else {
                throw new ExceptionHandler(__METHOD__ . ":invalid URL.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }


    /** post
     *
     * @return bool
     */
    public function post()
    {
        try {
            if ( CheckInput::checkSet($this->url) ) {
                $this->encodeResult();
                $this->cURLPost();
                $this->checkJSONErrors();
                if ($this->errorJSON !== 'No errors') {
                    throw new ExceptionHandler(__METHOD__ . ": $this->errorJSON");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": URL required.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** get
     *
     * @return bool
     */
    public function get()
    {
        try {
            if ( CheckInput::checkSet($this->url) ) {
                $this->cURLGet();
                $this->decodeResult();
                $this->checkJSONErrors();
                if ($this->errorJSON !== 'No errors') {
                    throw new ExceptionHandler(__METHOD__ . ": $this->errorJSON");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": URL required.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setOptions
     *
     * @param array $array an array of options
     *
     * @return bool
     */
    public function setOptions( $array )
    {
        try {
            if ( CheckInput::checkNewInputArray($array) ) {
                $this->cURLOptions = $array;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": array invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** encodeResult
     * 
     * @return bool
     */
    protected function encodeResult()
    {
        try {
            if ( CheckInput::checkNewInput($this->arrayJSON) ) {
                array_walk($this->arrayJSON, 'utf8_encode');
                $this->objectJSON = json_encode(
                    $this->arrayJSON,
                    JSON_FORCE_OBJECT
                );
            } else {
                throw new ExceptionHandler(__METHOD__ . ": arrayJSON invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;        
    }

    /** response
     *
     * @return bool
     */
    public function response()
    {
        try {
            if ( ! CheckInput::checkSet($this->objectJSON) ) {
                if ( CheckInput::checkSet($this->arrayJSON) ) {
                    $this->encodeResult();
                } else {
                    throw new ExceptionHandler(__METHOD__ . ": response not ready.");
                }
            }
            header("content-type: text/json charset=utf-8");
            echo $this->objectJSON;
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** cURLPost
     *
     * @return string
     */
    protected function cURLPost( )
    {
        $this->postDefaults[CURLOPT_POSTFIELDS] 
            = http_build_query($this->arrayJSON);
        $this->cURLHandle = curl_init();
        curl_setopt_array(
            $this->cURLHandle, 
            ($this->cURLOptions + $this->postDefaults)
        );
        if ( !$this->cURLResult = curl_exec($this->cURLHandle) ) {
            trigger_error(curl_error($this->cURLHandle));
        }
        curl_close($this->cURLHandle);
        return true;
    }

    /** cURLGet
     *
     * Send a GET request using cURL
     *
     * @return string
     */
    protected function cURLGet()
    {
        $this->getDefaults[CURLOPT_URL] 
            = $this->url 
            . (strpos($this->url, '?') === false ? '?' : '') 
            . http_build_query($this->arrayJSON);
        $this->cURLHandle = curl_init();
        curl_setopt_array(
            $this->cURLHandle, 
            ($this->cURLOptions + $this->getDefaults)
        );
        if ( !$this->cURLResult = curl_exec($this->cURLHandle) ) {
            trigger_error(curl_error($this->cURLHandle));
        }
        curl_close($this->cURLHandle);
        return true;
    }

    /** decodeResult
     *
     * @return bool
     */
    protected function decodeResult()
    {
        try {
            if ( CheckInput::checkNewInput($this->cURLResult) ) {
                $this->arrayJSON = json_decode(utf8_encode($this->cURLResult), true);
                $this->objectJSON = $this->cURLResult;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": cURLResult invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;        
    }

    /** checkJSONErrors
     *
     * @return void
     */
    protected function checkJSONErrors()
    {
        switch ( json_last_error() ) {
        case JSON_ERROR_NONE:
                $this->errorJSON = 'No errors';
            break;
        case JSON_ERROR_DEPTH:
                $this->errorJSON = 'Maximum stack depth exceeded';
            break;
        case JSON_ERROR_STATE_MISMATCH:
                $this->errorJSON = 'Underflow or the modes mismatch';
            break;
        case JSON_ERROR_CTRL_CHAR:
                $this->errorJSON = 'Unexpected control character found';
            break;
        case JSON_ERROR_SYNTAX:
                $this->errorJSON = 'Syntax error, malformed JSON';
            break;
        case JSON_ERROR_UTF8:
                $this->errorJSON = 'Malformed UTF-8 characters, incorrectly encoded';
            break;
        default:
                $this->errorJSON = 'Unknown error';
            break;
        }
    }
}

/* Get the geographic information about zip code 78205
$zippy = new JSON();
$zippy->setURL("http://zipasaur.us/zip/78205");
$zippy->get();
print_r($zippy);
*/