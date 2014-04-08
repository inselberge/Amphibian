
<?php
/**
 * PHP version 5.4.17
 * Created by JetBrains PhpStorm.
 * User: carl
 * Date: 8/15/13
 * Time: 12:19 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once "interfaces".DIRECTORY_SEPARATOR."cURLInterface.php";
require_once "CheckInput.php";
/**
 * Class cURL
 *
 * @category Helper
 * @package  cURL
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/cURL
 * 
 */
class cURL
{

    /**
     * @var string url a valid URL of a website
     */
    protected $url;
    /**
     * @var array values an array with values to send
     */
    protected $values;
    /**
     * @var array options an array with the cURL options set
     */
    protected $options;
    /**
     * @var array defaultOptions an array with the cURL default options set
     */
    protected $defaultOptions;
    /**
     * @var resource cURLHandle a valid cURL handle
     */
    protected $cURLHandle;
    /**
     * @var array result the returned array for the cURL call
     */
    protected $result;
    /**
     * @var array info an array with information on the cURL call
     */
    protected $info;
    /**
     * @var object cURL a singleton instance of this class
     */
    static public $cURL;

    /** __construct
     */
    protected function __construct()
    {
    }

    /** instance
     *
     * @return cURL
     */
    static public function instance()
    {
        if ( !isset(self::$cURL) ) {
            self::$cURL = new cURL();
        }
        return self::$cURL;
    }

    /** init
     *
     * @return bool
     */
    public function init()
    {
        try {
            $this->clearVariables();
            $this->cURLHandle = curl_init();
            if ( !CheckInput::checkNewInput($this->cURLHandle) ) {
                throw new ExceptionHandler(__METHOD__ . ": init failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** clearVariables
     *
     * @return void
     */
    protected function clearVariables()
    {
        $this->cURLHandle = null;
        $this->result = null;
        $this->defaultOptions = array();
        $this->options = array();
        $this->url = null;
        $this->values = array();
    }

    /** setDefaultOptions
     *
     * @param array $defaultOptions the default options for the cURL call
     *
     * @return bool
     */
    public function setDefaultOptions($defaultOptions)
    {
        try {
            if ( CheckInput::CheckInput($defaultOptions) ) {
                $this->defaultOptions = $defaultOptions;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": setDefaultOptions failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getDefaultOptions
     *
     * @return array
     */
    public function getDefaultOptions()
    {
        return $this->defaultOptions;
    }

    /** setOptions
     *
     * @param array $options the options to us in the cURL call
     *
     * @return bool
     */
    public function setOptions($options)
    {
        try {
            if ( CheckInput::checkNewInputArray($options) ) {
                $this->options = array_merge_recursive($this->options, $options);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": setOptions failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getOptions
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /** setUrl
     *
     * @param string $url the URL to use
     *
     * @return bool
     */
    public function setUrl($url)
    {
        try {
            if ( CheckInput::checkNewInput($url) ) {
                $this->url = $url;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": setUrl failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getUrl
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /** setValues
     *
     * @param array $values the values to use in the cURL call
     *
     * @return bool
     */
    public function setValues($values)
    {
        try {
            if ( CheckInput::checkNewInputArray($values) ) {
                $this->values = array_merge_recursive($this->values, $values);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": setValues failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getValues
     *
     * @return array
     */
    public function getValues()
    {
        return $this->values;
    }



    /** post
     *
     * @return bool
     */
    public function post()
    {
        try {
            if ( $this->checkRequirements() ) {
                $this->buildPostDefaultOptions();
                $this->run();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": requirements not met");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkRequirements
     *
     * @return bool
     */
    protected function checkRequirements()
    {
        try {
            if ( ! CheckInput::checkSet($this->url) ) {
                throw new ExceptionHandler(__METHOD__ . ": url must be set");
            }
            if ( ! CheckInput::checkSet($this->cURLHandle) ) {
                throw new ExceptionHandler(__METHOD__ . ": cURLHandle must be set");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** buildPostDefaultOptions
     *
     * @return bool
     */
    protected function buildPostDefaultOptions()
    {
        try {
            if ( CheckInput::checkNewInput($this->url) ) {
                $this->setDefaultOptions(
                    array(
                        CURLOPT_POST           => 1,
                        CURLOPT_HEADER         => 0,
                        CURLOPT_URL            => $this->url,
                        CURLOPT_FRESH_CONNECT  => 1,
                        CURLOPT_RETURNTRANSFER => 1,
                        CURLOPT_FORBID_REUSE   => 1,
                        CURLOPT_TIMEOUT        => 4,
                        CURLOPT_POSTFIELDS     => http_build_query($this->values)
                    )
                );
            } else {
                throw new ExceptionHandler(__METHOD__ . ": buildPostDefaultOptions failed.");
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
            if ( $this->checkRequirements() ) {
                $this->buildGetDefaultOptions();
                $this->run();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": requirements not met");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** buildGetDefaultOptions
     *
     * @return bool
     */
    protected function buildGetDefaultOptions()
    {
        try {
            if ( CheckInput::checkNewInput($this->url) ) {
                $this->setDefaultOptions(
                    array(
                         CURLOPT_URL => $this->url
                                        . (strpos($this->url, '?') === FALSE ? '?' : '')
                                        . http_build_query($this->values),
                         CURLOPT_HEADER => 0,
                         CURLOPT_RETURNTRANSFER => 1,
                         CURLOPT_TIMEOUT => 4
                    )
                );
            } else {
                throw new ExceptionHandler(__METHOD__ . ": buildGetDefaultOptions failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** run
     *
     * @return bool
     */
    protected function run()
    {
        try {
            if ( $this->setOptionsArray() ) {
                if ( !$this->exec() ) {
                    $this->error();
                }
                $this->setInfo();
                $this->close();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": run failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setOptionsArray
     *
     * @return bool
     */
    public function setOptionsArray()
    {
        try {
            $this->result
                = curl_setopt_array(
                    $this->cURLHandle,
                    ($this->options + $this->defaultOptions)
                );
            if ( !CheckInput::checkNewInput($this->result) ) {
                throw new ExceptionHandler(__METHOD__ . ": setOptionsArray failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }


    /** exec
     *
     * @return bool
     */
    public function exec()
    {
        try {
            $this->result = curl_exec($this->cURLHandle);
            if ( ! CheckInput::checkSetArray($this->result) ) {
                throw new ExceptionHandler(__METHOD__ . ": exec failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** error
     *
     * @return bool
     */
    public function error()
    {
        try {
            $this->result = curl_error($this->cURLHandle);
            if ( CheckInput::checkSet($this->result) ) {
                echo $this->result;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": error failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getResult
     *
     * @return array
     */
    public function getResult()
    {
        return $this->result;
    }

    /** setInfo
     *
     * @return bool
     */
    public function setInfo()
    {
        try {
            $this->info = curl_getinfo($this->cURLHandle);
            if ( ! CheckInput::checkSetArray($this->info) ) {
                throw new ExceptionHandler(__METHOD__ . ": setInfo failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getInfo
     *
     * @return array
     */
    public function getInfo()
    {
        return $this->info;
    }

    /** close
     *
     * @return void
     */
    public function close()
    {
        curl_close($this->cURLHandle);
    }

    /** check
     *
     * @param string $key the key to check if it is set
     *
     * @return bool
     */
    public function check($key)
    {
        if ( isset($this->$key) ) {
            if ( !is_null($this->$key) ) {
                return true;
            } else {
                return false;
            }            
        } else {
            return false;
        }
    }
}