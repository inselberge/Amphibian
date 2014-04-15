<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Carl "Tex" Morgan
 * Date: 3/19/13
 * Time: 4:29 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once "CheckInput.php";
require_once "interfaces".DIRECTORY_SEPARATOR."SuperGlobalInterface.php";
/**
 * Class SuperGlobal
 *
 * @category Helper
 * @package  Core
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/SuperGlobal
 */
class SuperGlobal
    implements SuperGlobalInterface
{
    /**
     * @var array localArray one of the local super-global arrays
     */
    protected $localArray;
    /**
     * @var integer size the number of elements in the localArray
     */
    protected $size;

    /** __construct
     *
     * @param array $glob a super-global array
     */
    public function __construct( array $glob )
    {
        try {
            if ( !$this->setLocalArray($glob) ) {
                throw new ExceptionHandler(__METHOD__.": initialization failed!");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        ksort($this->localArray);
    }

    /** checkEqual
     *
     * @param SuperGlobal $super an object of this class
     *
     * @return bool
     */
    public function checkEqual( SuperGlobal $super )
    {
        try {
            if ( CheckInput::checkNewInput($super) ) {
                if ( $this->localArray === $super->getLocalArray() ) {
                    return true;
                } else {
                    return false;
                }
            } else {
                throw new ExceptionHandler(__METHOD__.": checkEqual failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** setLocalArray
     *
     * @param array $localArray a super-global array
     *
     * @return bool
     */
    public function setLocalArray( $localArray )
    {
        try {
            if ( CheckInput::checkSetArray($localArray) ) {
                $this->localArray = $localArray;
                $this->size = count($localArray);
            } else {
                throw new ExceptionHandler(__METHOD__.": localArray is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setLocalArrayByKey
     *
     * @param string $key   the index in the array
     * @param mixed  $value the new value
     *
     * @return bool
     */
    public function setLocalArrayByKey( $key,$value )
    {
        try {
            if ( CheckInput::checkNewInput($key) ) {
                if ( CheckInput::checkNewInput($value) ) {
                    $this->localArray[$key] = $value;
                } else {
                    throw new ExceptionHandler(__METHOD__."$value is not valid");
                }
            } else {
                throw new ExceptionHandler(__METHOD__."$key is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getLocalArray
     *
     * @return array
     */
    public function getLocalArray()
    {
        return $this->localArray;
    }

    /** getLocalArrayByKey
     *
     * @param string $key the index of the array
     *
     * @return mixed
     */
    public function getLocalArrayByKey($key)
    {
        try {
            if (!CheckInput::checkNewInput($key)) {
                throw new ExceptionHandler(__METHOD__."$key is not valid.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return $this->localArray[$key];
    }


    /** printSize
     *
     * @return void
     */
    public function printSize()
    {
        echo $this->size;
    }
}