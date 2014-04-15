<?php
/**
 * PHP version 5.4.17
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/11/13
 * Time: 3:26 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once "CheckInput.php";
require_once "interfaces".DIRECTORY_SEPARATOR."DataPackageInterface.php";
/**
 * Class DataPackage
 * 
 * @category Helper
 * @package  Core
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/DataPackage
 */
class DataPackage
    implements DataPackageInterface
{
    /**
     * @var array payload holds data values
     */
    protected $payload;
    /**
     * @var array errors holds error values
     */
    protected $errors;
    /**
     * @var array queryArguments holds query argument values
     */
    protected $queryArguments;

    /** __construct
     *
     */
    public function __construct()
    {
        $this->payload=array();
        $this->errors=array();
        $this->queryArguments=array();
    }

    /** setErrors
     *
     * @param array $errors an array of errors
     *
     * @throws ExceptionHandler
     *
     * @return bool
     */
    public function setErrors( $errors )
    {
        try {
            if ( CheckInput::checkNewInputArray($errors) ) {
                $this->errors = $errors;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": errors invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getErrors
     *
     * @throws ExceptionHandler
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }


    /** setPayload
     *
     * @param array $payload an array of data
     *
     * @throws ExceptionHandler
     *
     * @return bool
     */
    public function setPayload( $payload )
    {
        try {
            if ( CheckInput::checkNewInputArray($payload) ) {
                $this->payload = $payload;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": payload invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }


    /** getPayload
     *
     * @throws ExceptionHandler
     *
     * @return array
     */
    public function getPayload()
    {
        return $this->payload;
    }


    /** setQueryArguments
     *
     * @param array $queryArguments an array of query arguments
     *
     * @throws ExceptionHandler
     *
     * @return bool
     */
    public function setQueryArguments( $queryArguments )
    {
        try {
            if ( CheckInput::checkNewInputArray($queryArguments) ) {
                $this->queryArguments = $queryArguments;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": queryArguments invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getQueryArguments
     *
     * @throws ExceptionHandler
     *
     * @return array
     */
    public function getQueryArguments()
    {
        return $this->queryArguments;
    }

    /** checkKeyInArray
     *
     * @param string $arrayName the specific name of the array
     * @param string $key       the specific key to check
     *
     * @return bool
     */
    public function checkKeyInArray($arrayName, $key)
    {
        try {
            if ( CheckInput::checkNewInput($key) ) {
                if ( $arrayName === "payload" ) {
                    return array_key_exists($key, $this->payload);
                } elseif ( $arrayName === "errors" ) {
                    return array_key_exists($key, $this->errors);
                } elseif ( $arrayName === "queryArguments" ) {
                    return array_key_exists($key, $this->queryArguments);
                } else {
                    throw new ExceptionHandler(__METHOD__ . ": invalid array.");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": key must be set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** appendToArray
     *
     * @param string $arrayName   the specific name of the array
     * @param mixed  $arrayValues the specific values to add
     *
     * @return bool
     */
    public function appendToArray($arrayName, $arrayValues)
    {
        try {
            if ( CheckInput::checkNewInput($arrayName) ) {
                $this->forkAppend($arrayName, $arrayValues);
            } else {
                throw new ExceptionHandler(__METHOD__ . "Type a message.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** forkAppend
     *
     * @param string $arrayName   the specific name of the array
     * @param mixed  $arrayValues the specific values to add
     *
     * @return bool
     */
    protected function forkAppend($arrayName,$arrayValues)
    {
        try {
            if ( $arrayName =="payload" ) {
                $this->appendPayload($arrayValues);
            } elseif ($arrayName =="errors") {
                $this->appendErrors($arrayValues);
            } elseif ($arrayName =="queryArguments") {
                $this->appendQueryArguments($arrayValues);
            } else {
                throw new ExceptionHandler(__METHOD__ . "Unknown array.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** appendPayload
     *
     * @param mixed $arrayValues the specific values to append
     *
     * @return bool
     */
    protected function appendPayload($arrayValues)
    {
        try {
            if ( CheckInput::checkNewInputArray($arrayValues) ) {
                foreach ($arrayValues as $value) {
                    $this->payload[]=$value;
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": New payload invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** appendErrors
     *
     * @param mixed $arrayValues the specific values to append
     *
     * @return bool
     */
    protected function appendErrors($arrayValues)
    {
        try {
            if ( CheckInput::checkNewInputArray($arrayValues) ) {
                foreach ($arrayValues as $value) {
                    $this->errors[]=$value;
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": New errors invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** appendQueryArguments
     *
     * @param mixed $arrayValues the specific values to append
     *
     * @return bool
     */
    protected function appendQueryArguments($arrayValues)
    {
        try {
            if ( CheckInput::checkNewInputArray($arrayValues) ) {
                foreach ($arrayValues as $value) {
                    $this->queryArguments[]=$value;
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": New query arguments invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** addToArray
     * 
     * @param string $arrayName   the specific name of the array      
     * @param mixed  $arrayValues the specific values to add
     *
     * @throws ExceptionHandler
     *
     * @return bool
     */
    public function addToArray($arrayName, $arrayValues)
    {
        try {
            if ( CheckInput::checkNewInput($arrayName) ) {
                $this->forkArray($arrayName, $arrayValues);
            } else {
                throw new ExceptionHandler(__METHOD__ . "Array name not set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** forkArray
     *
     * @param string $arrayName   the specific name of the array
     * @param mixed  $arrayValues the specific values to add
     *
     * @throws ExceptionHandler
     *
     * @return bool
     */
    protected function forkArray($arrayName,$arrayValues)
    {
        try {
            if ( $arrayName =="payload" ) {
                $this->setSpecificPayload($arrayValues);
            } elseif ($arrayName =="errors") {
                $this->setSpecificErrors($arrayValues);
            } elseif ($arrayName =="queryArguments") {
                $this->setSpecificQueryArguments($arrayValues);
            } else {
                throw new ExceptionHandler(__METHOD__ . "Unknown array.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }


    /** setSpecificErrors
     *
     * @param array $arrayValues an array of errors
     *
     * @throws ExceptionHandler
     *
     * @return bool
     */
    protected function setSpecificErrors($arrayValues)
    {
        try {
            if ( CheckInput::checkNewInputArray($arrayValues) ) {
                foreach ($arrayValues as $key=>$value) {                
                    $this->errors[$key]=$value;
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": New errors invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setSpecificPayload
     *
     * @param array $arrayValues an array of payload data
     *
     * @throws ExceptionHandler
     *
     * @return bool
     */
    protected function setSpecificPayload($arrayValues)
    {
        try {
            if ( CheckInput::checkNewInputArray($arrayValues) ) {
                foreach ($arrayValues as $key=>$value) {
                    $this->payload[$key]=$value;
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": New payload invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setSpecificQueryArguments
     *
     * @param array $arrayValues an array of query arguments
     *
     * @throws ExceptionHandler
     *
     * @return bool
     */
    protected function setSpecificQueryArguments($arrayValues)
    {
        try {
            if ( CheckInput::checkNewInputArray($arrayValues) ) {
                foreach ($arrayValues as $key=>$value) {
                    $this->queryArguments[$key]=$value;
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": New query args invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getSpecificPayload
     *
     * @param string $payloadId the name of the specific array
     *
     * @throws ExceptionHandler
     *
     * @return bool|null
     */
    public function getSpecificPayload($payloadId)
    {
        try {
            if ( CheckInput::checkNewInput($payloadId) ) {
                if ( isset($this->payload[$payloadId]) ) {
                    return $this->payload[$payloadId];
                } else {
                    return null;
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": Payload ID invalid.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** getSpecificError
     *
     * @param string $errorId the name of the error index
     *
     * @throws ExceptionHandler
     *
     * @return mixed
     */
    public function getSpecificError($errorId)
    {
        try {
            if ( CheckInput::checkNewInput($errorId) ) {
                if ( isset($this->errors[$errorId]) ) {
                    return $this->errors[$errorId];
                } else {
                    return null;
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": Errors ID invalid.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** getSpecificQueryArguments
     *
     * @param string $queryArgId the name of the query argument index
     *
     * @throws ExceptionHandler
     *
     * @return mixed
     */
    public function getSpecificQueryArguments($queryArgId)
    {
        try {
            if ( CheckInput::checkNewInput($queryArgId) ) {
                if ( isset($this->queryArguments[$queryArgId]) ) {
                    return $this->queryArguments[$queryArgId];
                } else {
                    return null;
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": Query args ID invalid.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }
}