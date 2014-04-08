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