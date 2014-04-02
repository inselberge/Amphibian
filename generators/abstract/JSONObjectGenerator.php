<?php
/**
 * PHP Version 5.5.3-1ubuntu2
 * Created by PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 11/14/13
 * Time: 12:15 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once "BasicGenerator.php";
require_once AMPHIBIAN_CORE_NEUTRAL . "JSON.php";
require_once "interfaces".DIRECTORY_SEPARATOR."JSONObjectGeneratorInterface.php";
/**
 * Class JSONObjectGenerator
 *
 * @category Generator
 * @package  JSONObjectGenerator  
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/Amphibian/documentation/JSONObjectGenerator
 */
abstract class JSONObjectGenerator
    extends BasicGenerator
    implements JSONObjectGeneratorInterface
{
    /**
     * @var array acceptableRequestTypes the only acceptable request types for Models
     */
    static protected $acceptableRequestTypes = ["POST", "PUT", "GET", "PATCH"];
    /**
     * @var array unacceptableRequestTypes the request types that are unacceptable for Models
     */
    static protected $unacceptableRequestTypes = ["TRACE", "OPTIONS", "HEAD", "DELETE", "CONNECT"];
    /**
     * @var string agencyOrModel "agency" or "model" only
     */
    protected $agencyOrModel;
    /**
     * @var string requestOrResponse "request" or "response" only
     */
    protected $requestOrResponse;
    /**
     * @var boolean showTableDescription false = don't show, true = show
     */
    protected $showTableDescription = false;
    /**
     * @var array types the request types to generate
     */
    protected $types;
    /**
     * @var array object holds all the key-value pairs for the JSON object
     */
    protected $object;

    /** fetchAll
     *
     * @return boolean
     */
    protected function fetchAll()
    {
        try {
            if ( CheckInput::checkNewInput($this->agencyOrModel) ) {
                if ( $this->agencyOrModel == "agency" ) {
                    $this->fetchAllViews();
                } elseif ( $this->agencyOrModel == "model") {
                    $this->fetchAllTables();
                } else {
                    throw new ExceptionHandler(__METHOD__ . ": unknown flag.");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": invalid flag.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** fetchAllTables
     *
     * @return bool
     */
    abstract protected function fetchAllTables();

    /** fetchAllViews
     *
     * @return bool
     */
    abstract protected function fetchAllViews();

    /**  setRequestOrResponse
     *
     * @param string $requestOrResponse
     *
     * @return boolean
     */
    public function setRequestOrResponse( $requestOrResponse )
    {
        try {
            if ( CheckInput::checkNewInput($requestOrResponse) ) {
                $this->requestOrResponse = $requestOrResponse;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": requestOrResponse is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getRequestOrResponse
     *
     * @return string
     */
    public function getRequestOrResponse()
    {
        return $this->requestOrResponse;
    }

    /**  setAgencyOrModel
     *
     * @param string $agencyOrModel
     *
     * @return boolean
     */
    public function setAgencyOrModel( $agencyOrModel )
    {
        try {
            if ( CheckInput::checkNewInput($agencyOrModel) ) {
                if ( $agencyOrModel == "agency" OR $agencyOrModel == "model") {
                    $this->agencyOrModel = $agencyOrModel;
                } else {
                    throw new ExceptionHandler(__METHOD__ . ": agencyOrModel illegal");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": agencyOrModel is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getAgencyOrModel
     *
     * @return string
     */
    public function getAgencyOrModel()
    {
        return $this->agencyOrModel;
    }

    /**  setTypes
     *
     * @param array $types
     *
     * @return boolean
     */
    public function setTypes( $types )
    {
        try {
            if ( CheckInput::checkNewInputArray($types) ) {
                $this->types = $types;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": types is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getTypes
     *
     * @return array
     */
    public function getTypes()
    {
        return $this->types;
    }

    /** iterate
     *
     * @return bool
     */         
    protected function iterate()
    {
        try {
            if ( CheckInput::checkSet($this->tableName) ) {
                $this->setupTableDescription();
                $this->initObject();
                if ( $this->agencyOrModel == "agency" ) {
                    $this->initAgencyObject();
                    if ( $this->requestOrResponse == "request" ) {
                        $this->makeAgencyRequestObject();
                    } else {
                        $this->makeAgencyResponseObject();
                    }
                } elseif ( $this->agencyOrModel == "model" ) {
                    if ( $this->requestOrResponse == "request" ) {
                        $this->makeModelRequestObject();
                        $this->makeGetRequestObject();
                        $this->makePatchRequestObject();
                        $this->makePutRequestObject();
                        $this->makePostRequestObject();
                    } else {
                        $this->makeModelResponseObject();
                    }
                } else {
                    $this->makeErrorResponseObject();
                }
                $this->clearTableName();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": invalid table name.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setupTableDescription
     *
     * @return bool
     */
    abstract protected function setupTableDescription();

    /** prepareWrite
     *
     * @param string $location location to save the file
     *
     * @return bool
     */
    protected function prepareWrite($location)
    {
        try {
            if ( CheckInput::checkNewInput($location) ) {
                $this->setFileDestination($location);
                $this->convertToJSON();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": invalid location.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** write
     *
     * @return bool
     */
    protected function write()
    {
        try {
            if ( CheckInput::checkSet($this->buffer) ) {
                $this->writeFromBuffer();
                $this->setupForNext();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": buffer is empty.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** initRequestObject
     *
     * @return bool
     */
    protected function initObject()
    {
        try {
            unset($this->object);
            $this->object = array(
                "application" => uniqid("ak_"),
                "key" => uniqid("uk_"),
                "timestamp" => microtime(true),
                "branch" => "api",
                "type" => $this->tableName,
                "action" => ""
            );
            if( $this->showTableDescription == true ) {
                $this->object["tableDesciption"] = $this->tableDescription->getFieldTypeArray();
            }
            if ( ! CheckInput::checkNewInputArray($this->object) ) {
                throw new ExceptionHandler(__METHOD__ . ": object could not be initialized.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** initAgencyObject
     *
     * @return bool
     */
    protected function initAgencyObject()
    {
        try {
            if ( CheckInput::checkSet($this->object) ) {
                $this->object["action"] = "browse | search";

            } else {
                throw new ExceptionHandler(__METHOD__ . ": object not initialized.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** makeModelRequestObject
     *
     * @return void
     */
    protected function makeModelRequestObject()
    {
        $this->object["arguments"] = array();
    }

    /** makeAgencyRequestObject
     *
     * @return void
     */
    protected function makeAgencyRequestObject()
    {
        $this->object["arguments"] = array(
            "where" => "",
            "groupBy" => "",
            "having" => "",
            "orderBy" => "",
            "limit" => ""
        );
        $this->prepareWrite(AGENCIES_JSON_REQUEST);
    }


    /** initResponseObject
     *
     * @return bool
     */
    protected function initResponseObject()
    {
        try {
            unset($this->object);
            $this->object = array(
                "application" => uniqid("ak_"),
                "key" => uniqid("uk_"),
                "timestamp" => microtime(),
                "type" => $this->tableName,
                "success" => "",
                "pageSize" => "",
                "payloadSize" =>"",
                "payload" => array()
            );
            if ( ! CheckInput::checkNewInputArray($this->object) ) {
                throw new ExceptionHandler(__METHOD__ . ": object could not be initialized.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** makeAgencyResponseObject
     *
     * @return bool
     */
    protected function makeAgencyResponseObject()
    {
        try {
            if ( CheckInput::checkSet($this->object) ) {
                $this->object["success"] = 1;
                $this->object["payloadSize"] = 2;
                $this->object["pageSize"] = 25;
                $this->object["payload"][] = $this->tableDescription->getFieldTypeArray();
                $this->object["payload"][] = $this->tableDescription->getFieldTypeArray();
                if ( $this->prepareWrite(AGENCIES_JSON_RESPONSE) ) {
                    $this->write();
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": object could not be initialized.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** makeGetRequestObject
     *
     * @return bool
     */
    protected function makeGetRequestObject()
    {
        try {
            if ( CheckInput::checkSet($this->object) ) {
                $this->object["action"] = "get";
                $this->object["arguments"] = $this->tableDescription->getPrimaryKeys();
                if ($this->prepareWrite(MODELS_JSON_GET_REQUEST) ) {
                    $this->write();
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": object not initialized.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** makePatchRequestObject
     *
     * @return bool
     */
    protected function makePatchRequestObject()
    {
        try {
            if ( CheckInput::checkSet($this->object) ) {
                $this->object["action"] = "patch";
                $this->object["arguments"] = $this->tableDescription->getFieldTypeArray();
                if ( $this->prepareWrite(MODELS_JSON_PATCH_REQUEST) ) {
                    $this->write();
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": object not initialized.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** makePostRequestObject
     *
     * @return bool
     */
    protected function makePostRequestObject()
    {
        try {
            if ( CheckInput::checkSet($this->object) ) {
                $this->object["action"] = "update";
                $this->object["arguments"] = $this->tableDescription->getFieldTypeArray();
                if ( $this->prepareWrite(MODELS_JSON_POST_REQUEST) ) {
                    $this->write();
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": object not initialized.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** makePutRequestObject
     *
     * @return bool
     */
    protected function makePutRequestObject()
    {
        try {
            if ( CheckInput::checkSet($this->object) ) {
                $this->object["action"] = "insert";
                $this->object["arguments"] = $this->tableDescription->getNotNullArray();
                if ( $this->prepareWrite(MODELS_JSON_PUT_REQUEST) ) {
                    $this->write();
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": object not initialized.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** makeModelResponseObject
     *
     * @return bool
     */
    protected function makeModelResponseObject()
    {
        /*
         * TODO: decide if the responses should vary based on the request or not.  If so, how?
         */
        try {
            if ( CheckInput::checkSet($this->object) ) {
                $this->object["pageSize"] = 1;
                $this->object["payloadSize"] = 1;
                $this->object["success"] = 1;
                $this->object["payload"][] = $this->tableDescription->getFieldTypeArray();
                if ( $this->prepareWrite(MODELS_JSON_RESPONSE) ) {
                    $this->write();
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": object not initialized.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** makeErrorResponseObject
     *
     * @return bool
     */
    protected function makeErrorResponseObject()
    {
        try {
            if ( CheckInput::checkSet($this->object) ) {
                $this->object["pageSize"] = 1;
                $this->object["payloadSize"] = 1;
                $this->object["success"] = 0;
                $this->object["payload"][] = array("type" => "database", "code" => 400, "message" => "record not found");
                if ( $this->prepareWrite(MODELS_JSON_RESPONSE) ) {
                    $this->write();
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": object not initialized.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** convertToJSON
     *
     * @return bool
     */
    protected function convertToJSON()
    {
        try {
            if ( CheckInput::checkSet($this->object) ) {
                $this->buffer = json_encode($this->object, JSON_FORCE_OBJECT);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": invalid object");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }
}
/*
 * Agency JSON Objects
 *
//require_once AMPHIBIAN_CONFIG . "Coworks.In.config.inc.php";
require_once AMPHIBIAN_CONFIG . "InnerAlly.config.inc.php";
//require_once MYSQL; todo: replace these with correct databaseConnectionMySQLi calls
$aj = JSONObjectGenerator::instance($databaseConnection);
$aj->setAgencyOrModel("agency");
$aj->setFileDestination(AGENCIES_JSON);
$aj->execute();
 */
/*
 * Model JSON Objects
 *
require_once AMPHIBIAN_CONFIG . "InnerAlly.config.inc.php";
//require_once MYSQL; todo: replace these with correct databaseConnectionMySQLi calls
$mj = JSONObjectGenerator::instance($databaseConnection);
$mj->setAgencyOrModel("model");
$mj->setRequestOrResponse("request");
$mj->setFileDestination(MODELS_JSON);
$mj->execute();
 */