<?php
/**
 * PHP Version 5.4.9-4ubuntu2.2
 *
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 9/12/13
 * Time: 2:01 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once "interfaces".DIRECTORY_SEPARATOR."ParameterInterface.php";
require_once "CheckInput.php";
/**
 * Class Parameter
 *
 * @category Helper
 * @package  Parameter
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/Parameter
 */
class Parameter
    extends CheckInput
    implements ParameterInterface
{
    /**
     * @var array operators holds operator values for where, having statements
     */
    static protected $operators = array(
        "gt",
        "lt",
        "eq",
        "lte",
        "gte",
        "neq",
        "is",
        "isn",
        "lk",
        "nlk"
    );
    /**
     * @var array conjunctions holds conjunction values for where, having statements
     */
    static protected $conjunctions = array(
        "or",
        "and",
        "xor"
    );
    /**
     * @var array reservedWords holds reserved words list
     */
    static protected $reservedWords = array(
        "where",
        "groupBy",
        "having",
        "orderBy",
        "limit",
        "offset"
    );
    /**
     * @var array defaultModelActions holds the default model actions
     */
    static protected $defaultModelActions = array(
        "get",
        "insert",
        "update",
        "validate"
    );
    /**
     * @var array defaultAgencyActions holds the default agency actions
     */
    static protected $defaultAgencyActions = array(
        "browse",
        "search"
    );
    /**
     * @var array direction holds values direction of orderBy and groupBy
     */
    static protected $direction = array(
        "as",
        "de"
    );
    /**
     * @var array customActions additional actions
     */
    protected $customActions = array();
    /**
     * @var string path holds a string that will be exploded for the other variables
     */
    protected $path;
    /**
     * @var array pathArray holds all the variables from the path
     */
    protected $pathArray;
    /**
     * @var integer pathCount the number of elements in the path variable
     */
    protected $pathCount;
    /**
     * @var integer position the current position in the pathArray
     */
    protected $position;
    /**
     * @var mixed currentElement the current element of the pathArray
     */
    protected $currentElement;
    /**
     * @var array variables all the individual variables for the frontController
     */
    protected $variables;
    /**
     * @var object Parameter a singleton instance of this class
     */
    static public $Parameter;

    /** __construct
     *
     * @param string $path the path part of the URL string
     *
     * @throws ExceptionHandler
     */
    protected function __construct($path)
    {
        try {
            if ( CheckInput::checkNewInput($path) ) {
                $this->path=$path;
                $this->pathArray=array();
                $this->variables=array();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": path must be provided.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** instance
     *
     * @param string $path the path part of the URL string
     *
     * @return object
     */
    static public function instance($path)
    {
        if ( !isset(self::$Parameter) ) {
            self::$Parameter = new Parameter($path);
        }
        return self::$Parameter;
    }

    /** execute
     *
     * @return bool
     */
    public function execute()
    {
        try {
            $this->explodePath();
            if ( $this->checkPathArray() ) {
                foreach ( $this->pathArray as $this->position => $this->currentElement) {
                    $this->iterate();
                }
            } else {
                throw new ExceptionHandler(__METHOD__.": please try again.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** explodePath
     *
     * @return bool
     */
    protected function explodePath()
    {
        try {
            if ( CheckInput::checkNewInput($this->path) ) {
                $this->pathArray = explode('/', $this->path);
                $this->pathCount = count($this->pathArray);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": explodePath failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** cleanPathArray
     *
     * @return bool
     */
    protected function cleanPathArray()
    {
        try {
            if ( CheckInput::checkNewInputArray($this->pathArray) ) {
                if ( get_magic_quotes_gpc() ) {
                    $this->stripInputArray($this->pathArray);
                }
                $this->trimInputArray($this->pathArray);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": invalid array.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkPathArray
     *
     * @return bool
     */
    protected function checkPathArray()
    {
        try {
            if ( $this->pathCount < 1 ) {
                throw new ExceptionHandler(__METHOD__ . ":Path is too short.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** iterate
     *
     * @return bool
     */
    protected function iterate()
    {
        try {
            if ( $this->position == 0 ) {
                $this->extractBranch();
            } elseif ( $this->position == 1 ) {
                $this->extractController();
            } elseif ( $this->position == 2 ) {
                $this->extractAction();
            } else {
                $this->forkExtractOnAction();
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** extractBranch
     *
     * @return bool
     */
    protected function extractBranch()
    {
        try {
            $this->initVariable("branch");
            if ( isset($this->pathArray[0]) AND !is_null($this->pathArray[0]) ) {
                $this->variables["branch"] = $this->pathArray[0];
            } else {
                throw new ExceptionHandler(__METHOD__ . ": Branch is not ready.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** extractController
     *
     * @throws ExceptionHandler
     *
     * @return bool
     */
    protected function extractController()
    {
        try {
            if ( isset($this->pathArray[1]) AND $this->pathArray[1]!="" ) {
                $this->initVariable("controller");
                $this->variables["controller"] = $this->pathArray[1];
            } elseif ( CheckInput::checkSet($this->variables["controller"])) {
                /*
                 * You are using the default, which is already set.
                 */
            } else {
                throw new ExceptionHandler(__METHOD__ . ": Controller failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** extractAction
     *
     * @return bool
     */
    protected function extractAction()
    {
        try {
            if ( isset($this->pathArray[2]) AND !is_null($this->pathArray[2]) ) {
                $this->initVariable("action");
                $this->variables["action"] = $this->pathArray[2];
            } elseif ( CheckInput::checkSet($this->variables["action"])) {
                /*
                 * You are using the default, which is already set.
                 */
            } else {
                throw new ExceptionHandler(__METHOD__ . ": Action failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** forkExtractOnAction
     *
     * @return bool
     */
    protected function forkExtractOnAction()
    {
        try {
            if ( in_array($this->variables["action"], self::$defaultAgencyActions) ) {
                $this->extractMultiVariables();
            } elseif ( in_array($this->variables["action"], self::$defaultAction) ) {
                //for index only
            } elseif ( in_array($this->variables["action"], self::$defaultModelActions) ) {
                $this->extractRecordVariables();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": invalid action");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** extractRecordVariables
     *
     * @return bool
     */
    protected function extractRecordVariables()
    {
        try {
            for ( $i = 3; $i < $this->pathCount; $i += 2 ) {
                $this->variables[$this->pathArray[$i]]
                    = $this->pathArray[$i + 1];
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** extractMultiVariables
     *
     * @return bool
     */
    protected function extractMultiVariables()
    {
        try {
            if ( $this->checkPathArray() ) {
                $this->extractWhere();
                $this->extractGroupBy();
                $this->extractHaving();
                $this->extractOrderBy();
                $this->extractLimit();
                $this->addOffset();
                $this->extractRender();
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** initVariable
     *
     * @param string $key the key of the variable array
     *
     * @return bool
     */
    protected function initVariable( $key )
    {
        try {
            if ( !isset($this->variables[$key]) ) {
                $this->variables[$key] = null;
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** extractWhere
     *
     * @return bool
     */
    protected function extractWhere()
    {
        try {
            if ( $this->currentElement == "where" ) {
                $this->initVariable("where");
                $this->addClause("where");
                while ( $this->checkConjunction($this->pathArray[$this->position]) ) {
                    $this->addClause("where");
                }
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** addClause
     *
     * @param string $argumentKey the array to append
     *
     * @return bool
     */
    protected function addClause( $argumentKey )
    {
        try {
            $firstValue =  null;
            $operatorValue = null;
            $secondValue = null;

            $firstValue = $this->pathArray[$this->position+1];
            $operatorValue = $this->pathArray[$this->position+2];
            $secondValue = $this->pathArray[$this->position+3];

            if ( isset($firstValue,$operatorValue,$secondValue) ) {
                if ( $this->checkOperator($operatorValue) ) {
                    $this->appendSpecificVariable(
                        $argumentKey,
                        ' ' . $firstValue .
                        ' ' . $operatorValue .
                        ' ' . $secondValue
                    );
                    $this->advancePosition(4);
                } else {
                    throw new ExceptionHandler(__METHOD__.": invalid operator");
                }
            } else {
                throw new ExceptionHandler(__METHOD__.": invalid triad");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** extractGroupBy
     *
     * @return bool
     */
    protected function extractGroupBy()
    {
        try {
            if ( $this->currentElement == "groupBy" ) {
                $this->initVariable("groupBy");
                $this->addOrderClause("groupBy");
                while ( !$this->checkReservedWord($this->pathArray[$this->position]) ) {
                    $this->addOrderClause("groupBy");
                }
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** extractHaving
     *
     * @return bool
     */
    protected function extractHaving()
    {
        try {
            if ( $this->currentElement == "having" ) {
                $this->initVariable("having");
                $this->addClause("having");
                while ( $this->checkConjunction($this->pathArray[$this->position]) ) {
                    $this->addClause("having");
                }
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;

    }

    /** extractOrderBy
     *
     * @return bool
     */
    protected function extractOrderBy()
    {
        try {
            if ( $this->currentElement == "orderBy" ) {
                $this->initVariable("orderBy");
                $this->addOrderClause("orderBy");
                while ( !$this->checkReservedWord($this->pathArray[$this->position]) ) {
                    $this->addOrderClause("orderBy");
                }
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** addOrderClause
     *
     * @param string $key the array to append
     *
     * @return bool
     */
    protected function addOrderClause($key)
    {
        try {
            if ( $this->pathArray[$this->position] == $key ) {
                $columnValue = $this->pathArray[$this->position+1];
                $direction = $this->pathArray[$this->position+2];
                $this->advancePosition(3);
            } else {
                $columnValue = $this->pathArray[$this->position];
                $direction = $this->pathArray[$this->position+1];
                $this->advancePosition(2);
            }

            if ( CheckInput::checkSet($columnValue) ) {
                if ( $this->checkDirection($direction) ) {
                    $this->appendSpecificVariable(
                        $key,
                        ' '. $columnValue .
                        ' '. $direction
                    );

                } else {
                    $this->appendSpecificVariable(
                        $key,
                        ' '. $columnValue
                    );
                }
            } else {
                throw new ExceptionHandler(__METHOD__.": invalid order clause");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** extractLimit
     *
     * @return bool
     */
    protected function extractLimit()
    {
        try {
            if ( $this->currentElement == "limit" ) {
                $this->initVariable("limit");
                if ( $this->checkNextExists() ) {
                    $this->setSpecificVariable(
                        "limit",
                        $this->pathArray[$this->position+1]
                    );
                    $this->advancePosition(2);
                } else {
                    throw new ExceptionHandler(__METHOD__.": invalid value.");
                }
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** addOffset
     *
     * @return bool
     */
    protected function addOffset()
    {
        try {
            if ( $this->currentElement == "offset" ) {
                if ( $this->checkNextExists() ) {
                    $this->setSpecificVariable(
                        "limit",
                        $this->variables["limit"] .
                        ' offest ' . $this->pathArray[$this->position+1]
                    );
                    $this->advancePosition(2);
                } else {
                    throw new ExceptionHandler(__METHOD__.": invalid value.");
                }
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** extractRender
     *
     * @return bool
     */
    protected function extractRender()
    {
        try {
            if ( $this->currentElement == "render" ) {
                $this->initVariable("render");
                $this->setSpecificVariable(
                    "render",
                    $this->pathArray[$this->position+1]
                );
                $this->advancePosition(2);
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** advancePosition
     *
     * @param integer $number the number of places to advance
     *
     * @return bool
     */
    protected function advancePosition($number)
    {
        try {
            if ( CheckInput::checkSet($number) ) {
                if ( is_numeric($number) ) {
                    if ( ($this->position + $number) <= $this->pathCount ) {
                        $this->position += $number;
                    } else {
                        throw new ExceptionHandler(__METHOD__ . ": position overflow.");
                    }
                } else {
                    throw new ExceptionHandler(__METHOD__ . ": advance must be numeric.");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": invalid advance.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkReservedWord
     *
     * @param string $word a possible reserved word
     *
     * @return bool
     */
    protected function checkReservedWord($word)
    {
        if ( in_array($word, self::$reservedWords) ) {
            return true;
        } else {
            return false;
        }
    }

    /** checkOperator
     *
     * @param string $operator an operator
     *
     * @return bool
     */
    protected function checkOperator($operator)
    {
        if ( in_array($operator, self::$operators) ) {
            return true;
        } else {
            return false;
        }
    }

    /** checkConjunction
     *
     * @param string $conj a possible conjunction
     *
     * @return bool
     */
    protected function checkConjunction($conj)
    {
        if ( in_array($conj, self::$conjunctions) ) {
            return true;
        } else {
            return false;
        }
    }

    /** checkDirection
     *
     * @param string $direction the direction to order
     *
     * @return bool
     */
    protected function checkDirection($direction)
    {
        if ( in_array($direction, self::$direction) ) {
            return true;
        } else {
            return false;
        }
    }


    /** checkNextExists
     *
     * @return bool
     */
    protected function checkNextExists()
    {
        if ( isset( $this->pathArray[$this->position+1] ) ) {
            return true;
        } else {
            return false;
        }
    }

    /** setVariables
     *
     * @param array $vars an array of variables to set
     *
     * @return bool
     */
    public function setVariables( array $vars )
    {
        try {
            if ( CheckInput::checkNewInputArray($vars) ) {
                foreach ( $vars as $key => $value ) {
                    $this->variables[$key] = $value;
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": invalid array.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getVariables
     *
     * @return array
     */
    public function getVariables()
    {
        return $this->variables;
    }

    /** getPathCount
     *
     * @return int
     */
    public function getPathCount()
    {
        return $this->pathCount;
    }

    /**   getSpecificVariable
     *
     * @param string $key a valid index in the variables array
     *
     * @return mixed
     */
    public function getSpecificVariable($key)
    {
        try {
            if ( !array_key_exists($key, $this->variables) ) {
                throw new ExceptionHandler(__METHOD__ . ": invalid key.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return $this->variables[$key];
    }

    /**   setSpecificVariable
     *
     * @param string $key   a valid index in the variables array
     * @param mixed  $value a valid value in the variables array
     *
     * @return mixed
     */
    public function setSpecificVariable($key,$value)
    {
        try {
            $this->variables[$key] = $value;
            if ( !array_key_exists($key, $this->variables) ) {
                throw new ExceptionHandler(__METHOD__ . ": invalid key.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** appendSpecificVariable
     *
     * @param string $key   a valid index in the variables array
     * @param mixed  $value a valid value in the variables array
     *
     * @return bool
     */
    public function appendSpecificVariable($key,$value)
    {
        try {
            $original = $this->getSpecificVariable($key);
            if ( $original!=false ) {
                $this->setSpecificVariable($key, $original.$value);
            } else {
                $this->setSpecificVariable($key, $value);
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getDataVariables
     *
     * @return array|bool
     */
    public function getDataVariables()
    {
        try {
            $data = array();
            if ( CheckInput::checkSet($this->variables) ) {
                foreach ($this->variables as $key=>$value) {
                    if ( !in_array($key, array("branch","controller","action")) ) {
                        $data[$key] = $value;
                    }
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": variables required!");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return $data;
    }
}
/*  A few tests for various paths
//$path = "Geekdom/user/get/id/587";
//$path = "Geekdom/user/search/where/user_type/eq/mentor/render/json";
$path = "Geekdom/user/browse/groupBy/create_date/de/modify_date/as/limit/25/offset/25";
//$path = "Geekdom/";
$param = Parameter::instance($path);
$param->execute();
print_r($param->getVariables());
*/