<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Carl "Tex" Morgan
 * Date: 3/14/13
 * Time: 4:22 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."config.inc.php";
require_once AMPHIBIAN_CORE_NEUTRAL."CheckInput.php";
require_once AMPHIBIAN_CORE_NEUTRAL ."Log.php";
require_once AMPHIBIAN_CORE_NEUTRAL ."DataPackage.php";
require_once "interfaces".DIRECTORY_SEPARATOR."BasicInteractionInterface.php";
/**
 * Class BasicInteraction
 *
 * @category Core
 * @package  Core
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/BasicInteraction
 */
abstract class BasicInteraction
    extends CheckInput
    implements BasicInteractionInterface
{

    /**
     * @var object dataPackage a dataPackage object for storing information
     */
    protected $dataPackage;
    /**
     * @var resource connection a database connection
     */
    protected $connection;
    /**
     * @var object log an log object
     */
    protected $log;
    /**
     * @var array errors an array that holds error messages
     */
    protected $errors;

    /** __construct
     *
     * @param resource $databaseConnection a database connection
     */
    protected function __construct( $databaseConnection )
    {
        try {
            if ( CheckInput::checkNewInput($databaseConnection) ) {
                if ($databaseConnection->ping() ) {
                    $this->connection = $databaseConnection;
                    $this->dataPackage = new dataPackage();
                    $this->errors = [];
                } else {
                    throw new ExceptionHandler(__METHOD__ . ": dead connection");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": The new value is null.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** printByKey
     *
     * @param string $key the name of the variable you want to print
     *
     * @return bool
     */
    public function printByKey( $key )
    {
        try {
            if ( CheckInput::checkNewInput($key) ) {
                $this->printKey($key);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": key invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** printKey
     *
     * @param mixed $key the thing you want printed
     *
     * @return void
     */
    protected function printKey($key)
    {
        if ( is_array($this->$key) OR is_object($this->$key) ) {
            print_r($this->$key);
        } else {
            echo $this->$key;
        }
    }

    /** getByKey
     *
     * @param string $key the name of the variable you want to get
     *
     * @return mixed
     */
    public function getByKey( $key )
    {
        try {
            if ( CheckInput::checkNewInput($key) ) {
                if ( !CheckInput::checkNewInput($this->$key) ) {
                    throw new ExceptionHandler(__METHOD__ . ": variable invalid");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": The key must be set");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return $this->$key;
    }

    /** showSelf
     *
     * @return bool
     */
    public function showSelf()
    {
        return print_r($this);
    }

    /** setSpecific
     *
     * @param string $key   the specific variable to set
     * @param mixed  $value the specific value to set
     *
     * @return bool
     */
    protected function setSpecific( $key, $value )
    {
        try {
            if ( CheckInput::checkNewInput($key) ) {
                if ( CheckInput::checkNewInput($value) ) {
                    $this->$key = $value;
                } else {
                    throw new ExceptionHandler(__METHOD__ . ": value invalid.");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": The key must be set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkErrors
     *
     * @return bool
     */
    protected function checkErrors()
    {
        if ( empty($this->errors) ) {
            return false;
        } else {
            return true;
        }
    }

    /** setErrors
     *
     * @param string        $errorMessage the specific error message
     * @param (null|string) $key          the error array key
     *
     * @return bool
     */
    protected function setErrors( $errorMessage, $key = null )
    {
        try {
            if ( CheckInput::checkNewInput($errorMessage) ) {
                if ( isset($key) AND !is_null($key) ) {
                    $this->errors[$key] = $errorMessage;
                } else {
                    $this->errors[] = $errorMessage;
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . "Type a message.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getErrors
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /** setDataPackage
     *
     * @param object $dataPackage the dataPackage to use
     *
     * @return bool
     */
    public function setDataPackage( $dataPackage )
    {
        try {
            if ( CheckInput::checkNewInput($dataPackage) ) {
                $this->dataPackage = $dataPackage;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": dataPackage invalid.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** freeDataPackage
     *
     * @return void
     */
    protected function freeDataPackage()
    {
        unset($this->dataPackage);
    }

    /** getDataPackage
     *
     * @return object
     */
    public function getDataPackage()
    {
        return $this->dataPackage;
    }

    /** checkDataPackage
     *
     * @param object $dataPackage the dataPackage to check if it is set
     *
     * @return bool
     */
    protected function checkDataPackage($dataPackage)
    {
        try {
            if (! CheckInput::checkNewInput($dataPackage) ) {
                throw new ExceptionHandler(__METHOD__ . ": dataPackage is not set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkDataPackageSet
     *
     * @return bool
     */
    public function checkDataPackageSet()
    {
        if ( count($this->dataPackage) ) {
            return true;
        } else {
            return false;
        }
    }
}