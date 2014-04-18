<?php
/**
 * PHP version 5.3
 * Created by PhpStorm.
 * User: texmorgan
 * Date: 4/17/14
 * Time: 3:27 PM
 */
require_once "interfaces/HeaderInterface.php";
/**
 * Class Header
 *
 * @category ${NAMESPACE}
 * @package  Header
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated
 * @link     documentation/Header
 */
abstract class Header
    implements HeaderInterface 
{
    /**
     * @var int count the number of header records
     */
    protected $count = 0;
    /**
     * @var array headerArray an array of all the header information
     */
    protected $headerArray = array();

    /** extractHeaderArray
     *
     * @return bool
     */
    public function extractHeaderArray()
    {
        try {
            if (CheckInput::checkSetArray($this->headerArray)) {
                foreach ($this->headerArray as $item) {
                    header($item . chr(13) . chr(10));
                }
            } else {
                throw new exceptionHandler(__METHOD__ . ": headerArray invalid.");
            }
        } catch (exceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** updateCount
     *
     * @return bool
     */
    protected function updateCount()
    {
        try {
            if (CheckInput::checkSet($this->headerArray)) {
                $this->count = count($this->headerArray);
            } else {
                throw new exceptionHandler(__METHOD__ . ": headerArray required.");
            }
        } catch (exceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getCount
     *
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /** checkCount
     *
     * @return bool
     */
    public function checkCount()
    {
        if ($this->count > 0) {
            return true;
        } else {
            return false;
        }
    }

    /** getHeaderArray
     *
     * @return array
     */
    public function getHeaderArray()
    {
        return $this->headerArray;
    }

    /** remove
     *
     * @param string $header an index in the headerArray
     *
     * @return bool
     */
    public function remove($header)
    {
        try {
            if (CheckInput::checkSet($header)) {
                if ( $this->__isset($header)){
                    header_remove($header);
                } else {
                    return false;
                }
            } else {
                throw new exceptionHandler(__METHOD__ . ": header required.");
            }
        } catch (exceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** __isset
     *
     * @param string $index an index in the header array
     *
     * @return bool
     */
    public function __isset($index)
    {
        try {
            if (CheckInput::checkSet($index)) {
                if ( array_key_exists($index, $this->headerArray) ) {
                    return CheckInput::checkSet($this->headerArray[$index]);
                } else {
                    return false;
                }
            } else {
                throw new exceptionHandler(__METHOD__ . ": index required.");
            }
        } catch (exceptionHandler $e) {
            $e->execute();
            return false;
        }
    }

    /** sent
     *
     * @param string &$file the file string to use
     * @param int    &$line the line number in the file
     *
     * @return bool
     */
    public function sent(&$file = null, &$line=null)
    {
        return headers_sent($file,$line);
    }

    /** setup
     *
     * @param $index
     * @param $variable
     *
     * @return bool
     */
    protected function setup($index, &$variable)
    {
        if (CheckInput::checkSet($index)) {
            if (CheckInput::checkSet($_SERVER[$index])) {
                $variable = $_SERVER[$index];
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
} 