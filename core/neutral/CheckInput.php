<?php
/**
 * PHP version PHP 5.4.17-1~dotdeb.1
 * Created by JetBrains PhpStorm.
 * User: Carl "Tex" Morgan
 * Date: 3/20/13
 * Time: 8:22 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once "interfaces".DIRECTORY_SEPARATOR."CheckInputInterface.php";
require_once "ExceptionHandler.php";
/**
 * Class CheckInput
 *
 * @category Helper
 * @package  Core
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/CheckInput
 */
class CheckInput
    implements CheckInputInterface
{
    /** checkNewInput
     *
     * @param mixed $value the value to check
     *
     * @return bool
     */
    static public function checkNewInput( $value )
    {
        try {
            if ( isset($value) ) {
                if ( !is_null($value) ) {
                    return true;
                } else {
                    throw new ExceptionHandler(__METHOD__.": value is null.");
                }
            } else {
                throw new ExceptionHandler(__METHOD__.": value is not set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** checkNewBoolean
     *
     * @param mixed $value the value to check
     *
     * @return bool
     */
    static public function checkNewBoolean( $value )
    {
        try {
            if (isset($value)) {
                if (!is_null($value)) {
                    return is_bool($value);
                } else {
                    return false;
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": value is not set.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
    }

    /** checkNewCallable
     *
     * @param mixed $value          the value to check
     * @param bool  $syntax_only    If set to TRUE the function only verifies that name might be a function or method
     * @param null  $callable_name
     *
     * @return bool
     */
    static public function checkNewCallable( $value , $syntax_only = false, &$callable_name = null)
    {
        try {
            if (isset($value)) {
                if (!is_null($value)) {
                    return is_callable($value, $syntax_only, $callable_name);
                } else {
                    return false;
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": value is not set.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
    }

    /** checkNewFloat
     *
     * @param mixed    $value     the value to check
     * @param bool     $unsigned  true = unsigned; false = signed
     * @param null|int $min       the minimum value
     * @param null|int $max       the maximum value
     * @param null|int $precision the number of decimal places
     *
     * @return bool
     */
    static public function checkNewFloat( $value, $unsigned = null, $min = null, $max = null, $precision = null)
    {
        try {
            if (isset($value)) {
                if (!is_null($value)) {
                    if (is_float($value)) {
                        if ($unsigned !== null) {
                            if ($value < 0) {
                                return false;
                            }
                        }
                        if ($min !== null) {
                            if ($value < $min) {
                                return false;
                            }
                        }
                        if ($max !== null) {
                            if ($value > $max) {
                                return false;
                            }
                        }
                        if ($precision !== null) {
                            list($whole, $fraction) = explode('.', $value);
                            $valueLength = strlen($fraction);
                            if ( $valueLength > $max) {
                                return false;
                            }
                        }
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": value is not set.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
    }

    /** checkNewInt
     *
     * @param mixed    $value    the value to check
     * @param bool     $unsigned true = unsigned; false = signed
     * @param null|int $min      the minimum value
     * @param null|int $max      the maximum value
     *
     * @return bool
     */
    static public function checkNewInt( $value , $unsigned = false, $min = null, $max = null)
    {
        try {
            if (isset($value)) {
                if (!is_null($value)) {
                    if (is_int($value)) {
                        if ($unsigned === true) {
                            if ($value < 0 ) {
                                return false;
                            }
                        }
                        if ($min !== null) {
                            if ($value < $min) {
                                return false;
                            }
                        }
                        if ($max !== null) {
                            if ($value > $max) {
                                return false;
                            }
                        }
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": value is not set.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
    }

    /** checkNewNumeric
     *
     * @param mixed $value the value to check
     *
     * @return bool
     */
    static public function checkNewNumeric( $value )
    {
        try {
            if (isset($value)) {
                if (!is_null($value)) {
                    return is_numeric($value);
                } else {
                    return false;
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": value is not set.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
    }

    /** checkNewResource
     *
     * @param mixed $value the value to check
     *
     * @return bool
     */
    static public function checkNewResource( $value )
    {
        try {
            if (isset($value)) {
                if (!is_null($value)) {
                    return is_resource($value);
                } else {
                    return false;
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": value is not set.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
    }

    /** checkNewString
     *
     * @param mixed    $value the value to check
     *
     * @param null|int $min   minimum number of characters
     *
     * @param null|int $max   maximum number of characters
     *
     * @return bool
     */
    static public function checkNewString( $value, $min = null, $max = null )
    {
        try {
            if (isset($value)) {
                if (!is_null($value)) {
                    if ( is_string($value) ) {
                        $length = strlen($value);
                        if ( $min !== null) {
                            if ($length < $min) {
                                return false;
                            }
                        }
                        if ( $max !== null) {
                            if ( $length > $max ) {
                                return false;
                            }
                        }
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": value is not set.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
    }
    /** checkNewInputArray
     *
     * @param array $array the array to check
     *
     * @return bool
     */
    static public function checkNewInputArray( $array )
    {
        try {
            if ( isset($array) ) {
                if ( is_array($array) ) {
                    foreach ( $array as $key => $value ) {
                        if ( self::checkNewInput($value) ) {
                        } else {
                            echo "Key: $key\tValue:$value were not acceptable";
                        }
                    }
                } else {
                    throw new ExceptionHandler(__METHOD__.":value is not an array.");
                }
            } else {
                throw new ExceptionHandler(__METHOD__.": value is not set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkSet
     *
     * @param mixed $key the value to check
     *
     * @return bool
     */
    static public function checkSet($key)
    {
        if ( isset($key) ) {
            if ( !is_null($key)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /** checkSetArray
     *
     * @param array $array the array to check
     *
     * @return bool
     */
    static public function checkSetArray($array)
    {
        if ( CheckInput::checkSet($array) ) {
            if ( !empty($array) ) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /** checkNewObject
     *
     * @param object &$value a valid object
     *
     * @return bool
     */
    static public function checkNewObject(&$value)
    {
        try {
            if (isset($value)) {
                if (!is_null($value)) {
                    if ( is_object($value) ) {
                        return true;
                    } else {
                        throw new ExceptionHandler(__METHOD__ . ": value is not an object.");
                    }
                } else {
                    throw new ExceptionHandler(__METHOD__ . ": value is null.");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": value is not set.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
    }

    /** checkSetObject
     *
     * @param object &$value a valid object
     *
     * @return bool
     */
    static public function checkSetObject(&$value)
    {
        try {
            if (isset($value)) {
                if (!is_null($value)) {
                    return is_object($value);
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
    }

    /** makeSafe
     *
     * @param string $str the string to alter
     *
     * @return string
     */
    protected function makeSafe( $str )
    {
        return htmlspecialchars($str);
    }

    /** checkSafety
     *
     * @param string $str the string to alter
     *
     * @return bool
     */
    protected function checkSafety( $str )
    {
        if ( $str === htmlspecialchars($str) ) {
            return true;
        } else {
            return false;
        }
    }

    /** trimInput
     *
     * @param string $str the string to alter
     *
     * @return string
     */
    protected function trimInput( $str )
    {
        return trim($str);
    }

    /** stripInput
     *
     * @param string $str the string to alter
     *
     * @return string
     */
    protected function stripInput ($str)
    {
        return stripslashes($str);
    }

    /** trimInputArray
     *
     * @param array $arr the array to alter
     *
     * @return bool
     */
    protected function trimInputArray( array $arr )
    {
        return array_walk($arr, 'trim');
    }

    /** stripInputArray
     *
     * @param array $arr the array to alter
     *
     * @return bool
     */
    protected function stripInputArray( array $arr )
    {
        return array_walk($arr, 'stripslashes');
    }

    /** oneSpaceOnly
     *
     * @param string $str the string to alter
     *
     * @return mixed
     */
    protected function oneSpaceOnly( $str )
    {
        return preg_replace('/\s+/', ' ', $str);
    }

    /** stripNullBytes
     *
     * @param string $str the string to alter
     *
     * @return mixed
     */
    protected function stripNullBytes( $str )
    {
        return str_replace("\0", '', $str);
    }
}