<?php
/**
 * PHP version 5.4.17
 * Created by JetBrains PhpStorm.
 * User: carl
 * Date: 7/9/13
 * Time: 1:02 AM
 * To change this template use File | Settings | File Templates.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once "interfaces".DIRECTORY_SEPARATOR."SanitizerInterface.php";
require_once "CheckInput.php";
/**
 * Class Sanitizer
 *
 * @category Helper
 * @package  Core
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/Sanitizer
 */
class Sanitizer
    implements SanitizerInterface
{
    /**
     * @var mixed variable the variable you are sanitizing
     */
    protected $variable;
    /**
     * @var integer sanitationFilter the predefined integer for the sanitation
     */
    protected $sanitationFilter;
    /**
     * @var array flags the flags to apply to the sanitation
     */
    protected $flags;

    /**
     * @var object Sanitizer an instance of this object
     */
    public static $Sanitizer;

    /** __construct
     *
     */
    protected function __construct()
    {

    }

    /** instance
     *
     * @return Sanitizer
     */
    static public function instance()
    {
        if ( !isset(self::$Sanitizer) ) {
            self::$Sanitizer = new Sanitizer();
        }
        return self::$Sanitizer;
    }

    /** factory
     *
     * @return Sanitizer
     */
    static public function factory()
    {
        return new Sanitizer();
    }

    /** getFlags
     *
     * @return array
     */
    public function getFlags()
    {
        return $this->flags;
    }

    /** setFlags
     *
     * @param integer $flags a bitwise comparison for individual flags
     *
     * @return bool
     */
    public function setFlags($flags)
    {
        try {
            if ( CheckInput::checkNewInput($flags) ) {
                if ( $this->checkFlag($flags) ) {
                    $this->flags |= $flags;
                } else {
                    throw new ExceptionHandler(__METHOD__ . ": invalid flag.");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": The flags must be set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getVariable
     *
     * @return mixed
     */
    public function getVariable()
    {
        return $this->variable;
    }

    /** setVariable
     *
     * @param mixed $variable the value to sanitize
     *
     * @return bool
     */
    public function setVariable($variable)
    {
        try {
            if ( CheckInput::checkNewInput($variable) ) {
                $this->variable = $variable;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": variable invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getSanitationFilter
     *
     * @return int
     */
    public function getSanitationFilter()
    {
        return $this->sanitationFilter;
    }

    /** setSanitationFilter
     *
     * @param integer $sanitationFilter the specific sanitation filter to apply
     *
     * @return bool
     */
    public function setSanitationFilter($sanitationFilter)
    {
        try {
            if ( CheckInput::checkNewInput($sanitationFilter) ) {
                $this->sanitationFilter = $sanitationFilter;
            } else {
                throw new ExceptionHandler(__METHOD__ . ":sanitationFilter invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;

    }

    /** execute
     *
     * @return mixed
     */
    public function execute()
    {
        try {
            if ( CheckInput::checkNewInputArray(
                array($this->variable,$this->sanitationFilter)
            )
            ) {
                if ( isset($this->flags) ) {
                    return filter_var(
                        $this->variable,
                        $this->sanitationFilter
                    );
                } else {
                    return filter_var(
                        $this->variable,
                        $this->sanitationFilter,
                        $this->flags
                    );
                }
            } else {
                throw new ExceptionHandler(__METHOD__.":execute failed");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
    }

    /** checkFlag
     *
     * @param integer $flag a specific flag for the Sanitizer
     *
     * @return bool
     */
    protected function checkFlag($flag)
    {
        try {
            if ( CheckInput::checkNewInput($this->sanitationFilter) ) {
                switch ( $this->sanitationFilter ) {
                case FILTER_SANITIZE_ENCODED:
                    return $this->checkEncodedFlag($flag);
                    break;
                case FILTER_SANITIZE_NUMBER_FLOAT:
                    return $this->checkFloatFlag($flag);
                    break;
                case FILTER_SANITIZE_SPECIAL_CHARS:
                    return $this->checkSpecialCharsFlag($flag);
                    break;
                case FILTER_SANITIZE_FULL_SPECIAL_CHARS:
                    return $this->checkFullSpecialCharsFlag($flag);
                    break;
                case FILTER_SANITIZE_STRING:
                    return $this->checkSanitizeStringFlag($flag);
                    break;
                default:
                    throw new ExceptionHandler(__METHOD__ . ": flag invalid");
                    break;
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": Sanitizer invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** checkEncodedFlag
     *
     * @param integer $flag a specific flag for the Sanitizer
     *
     * @return bool
     */
    protected function checkEncodedFlag($flag)
    {
        return in_array(
            $flag,
            array(
                FILTER_FLAG_STRIP_LOW,
                FILTER_FLAG_STRIP_HIGH,
                FILTER_FLAG_ENCODE_LOW,
                FILTER_FLAG_ENCODE_HIGH
            )
        );
    }

    /** checkFloatFlag
     *
     * @param integer $flag a specific flag for the Sanitizer
     *
     * @return bool
     */
    protected function checkFloatFlag($flag)
    {
        return in_array(
            $flag,
            array(
                FILTER_FLAG_ALLOW_FRACTION,
                FILTER_FLAG_ALLOW_THOUSAND,
                FILTER_FLAG_ALLOW_SCIENTIFIC
            )
        );
    }

    /** checkSpecialCharsFlag
     *
     * @param integer $flag a specific flag for the Sanitizer
     *
     * @return bool
     */
    protected function checkSpecialCharsFlag($flag)
    {
        return in_array(
            $flag,
            array(
                FILTER_FLAG_STRIP_LOW,
                FILTER_FLAG_STRIP_HIGH,
                FILTER_FLAG_ENCODE_HIGH
            )
        );
    }

    /** checkFullSpecialCharsFlag
     *
     * @param integer $flag a specific flag for the Sanitizer
     *
     * @return bool
     */
    protected function checkFullSpecialCharsFlag($flag)
    {
        if ( $flag === FILTER_FLAG_NO_ENCODE_QUOTES ) {
            return true;
        } else {
            return false;
        }
    }

    /** checkSanitizeStringFlag
     *
     * @param integer $flag a specific flag for the Sanitizer
     *
     * @return bool
     */
    protected function checkSanitizeStringFlag($flag)
    {
        return in_array(
            $flag,
            array(
                FILTER_FLAG_NO_ENCODE_QUOTES,
                FILTER_FLAG_STRIP_LOW,
                FILTER_FLAG_STRIP_HIGH,
                FILTER_FLAG_ENCODE_LOW,
                FILTER_FLAG_ENCODE_HIGH,
                FILTER_FLAG_ENCODE_AMP
            )
        );
    }

    /** checkSanitationFilter
     *
     * @param integer $filter the specific filter to apply
     *
     * @return bool
     */
    protected function checkSanitationFilter($filter)
    {
        return in_array(
            $filter,
            array(
            FILTER_SANITIZE_EMAIL,
            FILTER_SANITIZE_ENCODED,
            FILTER_SANITIZE_MAGIC_QUOTES,
            FILTER_SANITIZE_NUMBER_FLOAT,
            FILTER_SANITIZE_NUMBER_INT,
            FILTER_SANITIZE_SPECIAL_CHARS,
            FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            FILTER_SANITIZE_STRING,
            FILTER_SANITIZE_STRIPPED,
            FILTER_SANITIZE_URL
            )
        );
        // FILTER_UNSAFE_RAW has been intentionally skipped
    }
}