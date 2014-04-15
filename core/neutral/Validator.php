<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 6/30/13
 * Time: 10:46 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once "interfaces".DIRECTORY_SEPARATOR."ValidatorInterface.php";
require_once "CheckInput.php";
/**
 * Class Validator
 *
 * @category Helper
 * @package  Model
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/Validator
 */
class Validator
    implements ValidatorInterface
{
    /**
     * @var array acceptableValidators holds the acceptable validators
     */
    protected static $acceptableValidators = array(
        FILTER_VALIDATE_BOOLEAN,
        FILTER_VALIDATE_EMAIL,
        FILTER_VALIDATE_FLOAT,
        FILTER_VALIDATE_INT,
        FILTER_VALIDATE_IP,
        FILTER_VALIDATE_REGEXP,
        FILTER_VALIDATE_URL
    );
    /**
     * @var array acceptableBoolFlags holds the acceptable bool flags
     */
    protected static $acceptableBoolFlags = array (
        FILTER_NULL_ON_FAILURE
    );
    /**
     * @var array acceptableFloatFlags holds the acceptable float flags
     */
    protected static $acceptableFloatFlags = array(
        FILTER_FLAG_ALLOW_THOUSAND
    );
    /**
     * @var array acceptableIntFlags holds the acceptable int flags
     */
    protected static $acceptableIntFlags = array(
        FILTER_FLAG_ALLOW_HEX,
        FILTER_FLAG_ALLOW_OCTAL
    );
    /**
     * @var array acceptableIPFlags holds the acceptable IP flags
     */
    protected static $acceptableIPFlags = array(
        FILTER_FLAG_IPV4,
        FILTER_FLAG_IPV6,
        FILTER_FLAG_NO_PRIV_RANGE,
        FILTER_FLAG_NO_RES_RANGE
    );
    /**
     * @var array acceptableURLFlags holds the acceptable URL flags
     */
    protected static $acceptableURLFlags = array(
        FILTER_FLAG_PATH_REQUIRED,
        FILTER_FLAG_QUERY_REQUIRED
    );
    /**
     * @var array acceptableFloatOption holds the acceptable float options
     */
    protected static $acceptableFloatOption = array (
        "decimal"
    );
    /**
     * @var array acceptableIntOption holds the acceptable int options
     */
    protected static $acceptableIntOption = array (
        "min_range",
        "max_range"
    );
    /**
     * @var array acceptableRegExOption holds the acceptable regex options
     */
    protected static $acceptableRegExOption = array (
        "regex"
    );
    /**
     * @var array dataArray holds the data to run the filter against
     */
    protected $dataArray = array();
    /**
     * @var array argumentArray holds the arguments to use against the data
     */
    protected $argumentArray = array();
    /**
     * @var array resultArray holds results of each filter
     */
    protected $resultArray = array();
    /**
     * @var object validator an instance of this class
     */
    public static $validator;

    /** __construct
     *
     */
    protected function __construct()
    {
    }

    /** instance
     *
     * @return Validator
     */
    static public function instance()
    {
        if ( !isset(self::$validator) ) {
            self::$validator = new Validator();
        }
        return self::$validator;
    }

    /** factory
     *
     * @return Validator
     */
    static public function factory()
    {
        return new Validator();
    }

    /** prepArgIndex
     *
     * @param string $index the index that you want to prepare
     *
     * @return bool
     */
    protected function prepArgIndex($index)
    {
        try {
            if ( ! $this->checkArgInitialized($index) ) {
                $this->initializeArgIndex($index);
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkArgInitialized
     *
     * @param string $index the index that you want to prepare
     *
     * @return bool
     */
    protected function checkArgInitialized($index)
    {
        if ( isset($this->argumentArray[$index]) ) {
            if ( is_array($this->argumentArray[$index]) ) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /** initializeArgIndex
     *
     * @param string $index the index that you want to initialize
     *
     * @return bool
     */
    protected function initializeArgIndex($index)
    {
        try {
            if ( CheckInput::checkNewInput($index) ) {
                $this->argumentArray[$index]=array('filter','flags','options');
            } else {
                throw new ExceptionHandler(__METHOD__ . "initializeArgIndex failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** initializeArgOption
     *
     * @param string $index the index that you want to initialize
     *
     * @return bool
     */
    protected function initializeArgOption($index)
    {
        try {
            if ( CheckInput::checkNewInput($index) ) {
                $this->argumentArray[$index]['options']=array();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": initializeArgOption failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkValidatorString
     *
     * @param string $validatorString the validator to use
     *
     * @return bool
     */
    protected function checkValidatorString($validatorString)
    {
        try {
            if ( !in_array($validatorString, self::$acceptableValidators) ) {
                throw new ExceptionHandler(__METHOD__ . ": checkValidatorString failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkBoolFlag
     *
     * @param mixed $flag the flag to check is valid
     *
     * @return bool
     */
    protected function checkBoolFlag($flag)
    {
        try {
            if ( !in_array($flag, self::$acceptableBoolFlags) ) {
                throw new ExceptionHandler(__METHOD__ . ": checkBoolFlag failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkFloatFlag
     *
     * @param mixed $flag the flag to check is valid
     *
     * @return bool
     */
    protected function checkFloatFlag($flag)
    {
        try {
            if ( !in_array($flag, self::$acceptableFloatFlags) ) {
                throw new ExceptionHandler(__METHOD__ . ": checkFloatFlag failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkIntFlag
     *
     * @param mixed $flag the flag to check is valid
     *
     * @return bool
     */
    protected function checkIntFlag($flag)
    {
        try {
            if ( !in_array($flag, self::$acceptableIntFlags) ) {
                throw new ExceptionHandler(__METHOD__ . ": checkIntFlag failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkIPFlag
     *
     * @param mixed $flag the flag to check is valid
     *
     * @return bool
     */
    protected function checkIPFlag($flag)
    {
        try {
            if ( !in_array($flag, self::$acceptableIPFlags) ) {
                throw new ExceptionHandler(__METHOD__ . ": checkIPFlag failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkURLFlag
     *
     * @param mixed $flag the flag to check is valid
     *
     * @return bool
     */
    protected function checkURLFlag($flag)
    {
        try {
            if ( !in_array($flag, self::$acceptableURLFlags) ) {
                throw new ExceptionHandler(__METHOD__ . ": checkURLFlag failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }



    /**  setArgumentArray
     *
     * @param mixed $argumentArray an array of arguments to use
     *
     * @return boolean
     */
    public function setArgumentArray( $argumentArray )
    {
        try {
            if ( CheckInput::checkNewInputArray($argumentArray) ) {
                $this->argumentArray = $argumentArray;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": argumentArray is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getSpecificValidator
     *
     * @param string $index the index that you want to get
     *
     * @return mixed
     */
    public function getSpecificValidator($index)
    {
        try {
            if ( CheckInput::checkSet($this->argumentArray[$index]['filter']) ) {
                return $this->argumentArray[$index]['filter'];
            } else {
                throw new ExceptionHandler(__METHOD__ . ": getSpecificValidator failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** setSpecificValidator
     *
     * @param string $index     the index that you want to set
     * @param mixed  $validator the specific validator to use
     *
     * @return bool
     */
    public function setSpecificValidator($index,$validator)
    {
        try {
            $this->prepArgIndex($index);
            if ( $this->checkValidatorString($validator) ) {
                    $this->argumentArray[$index]['filter'] = $validator;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": setSpecificValidator failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setSpecificFlags
     *
     * @param string $index the index that you want to prepare
     * @param mixed  $flags the specific flag to use
     *
     * @return bool
     */
    public function setSpecificFlags($index,$flags)
    {
        try {
            if ( $this->prepFlag($index, $flags) ) {
                $this->argumentArray[$index]['flags'] = $flags;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": setSpecificFlags failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** prepFlag
     *
     * @param string $index the index that you want to prepare
     * @param mixed  $flags the specific flag to use
     *
     * @return bool
     */
    protected function prepFlag($index,$flags)
    {
        try {
            $filter = $this->getSpecificValidator($index);
            if ( CheckInput::checkSet($filter) ) {
                return $this->cascadeFilterType($filter, $flags);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": prepFlag failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** cascadeFilterType
     *
     * @param mixed $filter the filter to test
     * @param mixed $flags  the specific flag to use
     *
     * @return bool
     */
    protected function cascadeFilterType($filter, $flags)
    {
        try {
            if ( $filter === FILTER_VALIDATE_BOOLEAN ) {
                return $this->checkBoolFlag($flags);
            } elseif ( $filter === FILTER_VALIDATE_INT ) {
                return $this->checkIntFlag($flags);
            } elseif ( $filter === FILTER_VALIDATE_FLOAT ) {
                return $this->checkFloatFlag($flags);
            } elseif ( $filter === FILTER_VALIDATE_IP ) {
                return $this->checkIPFlag($flags);
            } elseif ( $filter === FILTER_VALIDATE_URL ) {
                return $this->checkURLFlag($flags);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": cascadeFilterType failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** setSpecificOptions
     *
     * @param string $index       the index on which to set the option
     * @param mixed  $option      the option to use
     * @param mixed  $optionValue the value you want to set the option to
     *
     * @return bool
     */
    public function setSpecificOptions($index, $option, $optionValue)
    {
        try {
            if ( $this->prepOption($index, $option) ) {
                $this->argumentArray[$index]['options'][$option] = $optionValue;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": setSpecificOptions failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** prepOption
     *
     * @param string $index  the index to prepare
     * @param mixed  $option the option to use
     *
     * @return bool
     */
    protected function prepOption($index,$option)
    {
        try {
            $filter = $this->getSpecificValidator($index);
            if ( CheckInput::checkSet($filter) ) {
                return $this->cascadeOption($filter, $option);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": prepOption failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** cascadeOption
     *
     * @param mixed $filter the filter to test
     * @param mixed $option the option to use
     *
     * @return bool
     */
    protected function cascadeOption($filter, $option)
    {
        try {
            if ( $filter === FILTER_VALIDATE_FLOAT ) {
                return $this->checkFloatOption($option);
            } elseif ($filter === FILTER_VALIDATE_INT) {
                return $this->checkIntOption($option);
            } elseif ($filter === FILTER_VALIDATE_REGEXP) {
                return $this->checkRegExOption($option);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": options are not valid for this filter.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** checkFloatOption
     *
     * @param mixed $opt the option to use
     *
     * @return bool
     */
    protected function checkFloatOption($opt)
    {
        if ( in_array($opt, self::$acceptableFloatOption) ) {
            return true;
        } else {
            return false;
        }
    }

    /** checkIntOption
     *
     * @param mixed $opt the option to use
     *
     * @return bool
     */
    protected function checkIntOption($opt)
    {
        if ( in_array($opt, self::$acceptableIntOption) ) {
            return true;
        } else {
            return false;
        }
    }

    /** checkRegExOption
     *
     * @param mixed $opt the option to use
     *
     * @return bool
     */
    protected function checkRegExOption($opt)
    {
        if ( in_array($opt, self::$acceptableRegExOption) ) {
            return true;
        } else {
            return false;
        }
    }

    /**   getArgumentArray
     *
     * @return mixed
     */
    public function getArgumentArray()
    {
        return $this->argumentArray;
    }

    /**  setDataArray
     *
     * @param mixed $dataArray an array to use for the validation
     *
     * @return boolean
     */
    public function setDataArray( $dataArray )
    {
        try {
            if ( CheckInput::checkNewInputArray($dataArray) ) {
                $this->dataArray = $dataArray;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": dataArray is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setSpecificDataArray
     *
     * @param string $index the index that you want to set
     * @param mixed  $value the value to set
     *
     * @return bool
     */
    public function setSpecificDataArray($index, $value)
    {
        try {
            if ( CheckInput::checkNewInput($index)
                AND CheckInput::checkSet($value)
            ) {
                $this->dataArray[$index]=$value;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": setSpecificDataArray failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getDataArray
     *
     * @return mixed
     */
    public function getDataArray()
    {
        return $this->dataArray;
    }

    /** execute
     *
     * @return bool
     */
    public function execute()
    {
        try {
            if ( $this->prepExecute() ) {
                $this->resultArray = filter_var_array(
                    $this->dataArray,
                    $this->argumentArray
                );
                if ( $this->resultArray === false ) {
                    throw new ExceptionHandler(__METHOD__ . ": execute failed.");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": prepExecute failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** prepExecute
     *
     * @return bool
     */
    protected function prepExecute()
    {
        try {
            if ( CheckInput::checkSetArray($this->dataArray) ) {
                if( !CheckInput::checkSetArray($this->argumentArray)) {
                    throw new ExceptionHandler(__METHOD__ . ": argument array is not ready.");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": data array is not ready.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getResultArray
     *
     * @return mixed
     */
    public function getResultArray()
    {
        return $this->resultArray;
    }

    /** getSpecificResult
     *
     * @param string $index the index that you want to pull
     *
     * @return mixed
     */
    public function getSpecificResult($index)
    {
        try {
            if ( CheckInput::checkNewInput($index) ) {
                return $this->getValue($this->resultArray[$index]);
            } else {
                throw new ExceptionHandler(__METHOD__ . "Type a message.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** getValue
     *
     * @param mixed $val the value to return
     *
     * @return mixed
     */
    protected function getValue($val)
    {
        if ( is_array($val) ) {
            return $val['0'];
        } else {
            return $val;
        }
    }
}