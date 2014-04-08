<?php
/**
 * PHP version 5.4.17
 * Created by JetBrains PhpStorm.
 * User: Carl "Tex" Morgan
 * Date: 4/1/13
 * Time: 1:59 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once "interfaces".DIRECTORY_SEPARATOR."databaseQueryPreparedInterface.php";
/**
 * Class DatabaseQueryPrepared
 *
 * @category Core
 * @package  DatabaseQueryPrepared
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/databaseQueryPrepared
 */
abstract class DatabaseQueryPrepared
    implements DatabaseQueryPreparedInterface
{
    /**
     * @var object connection
     */
    protected $connection;
    /**
     * @var integer affectedRows
     */
    protected $affectedRows;
    /**
     * @var integer errorNumber
     */
    protected $errorNumber;
    /**
     * @var array errorList
     */
    protected $errorList;
    /**
     * @var string error
     */
    protected $error;
    /**
     * @var integer fieldCount
     */
    protected $fieldCount;
    /**
     * @var integer insertId
     */
    protected $insertId;
    /**
     * @var integer numberOfRows
     */
    protected $numberOfRows;
    /**
     * @var integer parameterCount
     */
    protected $parameterCount;
    /**
     * @var string state
     */
    protected $state;
    /**
     * @var object statement the prepared statement object
     */
    protected $statement;
    /**
     * @var object result a database result set
     */
    protected $result;
    /**
     * @var object databaseQueryPrepared a singleton instance of this class
     */
    static public $databaseQueryPrepared;

    /** init
     *
     * @return bool
     */
    abstract public function init();

    /**   setResult
     *
     * @param object $result
     *
     * @return bool
     */
    public function setResult($result)
    {
        try {
            if (CheckInput::checkNewInput($result)) {
                $this->result = $result;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": result invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getResult
     *
     * @return object
     */
    public function getResult()
    {
        return $this->result;
    }

    /**   setStatement
     *
     * @param object $statement
     *
     * @return bool
     */
    public function setStatement($statement)
    {
        try {
            if (CheckInput::checkNewInput($statement)) {
                $this->statement = $statement;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": statement invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getStatement
     *
     * @return object
     */
    public function getStatement()
    {
        return $this->statement;
    }

    /**   setAffectedRows
     *
     * @param int $affectedRows
     *
     * @return bool
     */
    public function setAffectedRows($affectedRows)
    {
        try {
            if (CheckInput::checkNewInput($affectedRows)) {
                $this->affectedRows = $affectedRows;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": affectedRows invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getAffectedRows
     *
     * @return int
     */
    public function getAffectedRows()
    {
        return $this->affectedRows;
    }

    /**   setError
     *
     * @param string $error
     *
     * @return bool
     */
    public function setError($error)
    {
        try {
            if (CheckInput::checkNewInput($error)) {
                $this->error = $error;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": error invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getError
     *
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

    /**   setErrorList
     *
     * @param array $errorList
     *
     * @return bool
     */
    public function setErrorList($errorList)
    {
        try {
            if (CheckInput::checkNewInputArray($errorList)) {
                $this->errorList = $errorList;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": errorList invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getErrorList
     *
     * @return array
     */
    public function getErrorList()
    {
        return $this->errorList;
    }

    /**   setErrorNumber
     *
     * @param int $errorNumber
     *
     * @return bool
     */
    public function setErrorNumber($errorNumber)
    {
        try {
            if (CheckInput::checkNewInput($errorNumber)) {
                $this->errorNumber = $errorNumber;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": errorNumber invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getErrorNumber
     *
     * @return int
     */
    public function getErrorNumber()
    {
        return $this->errorNumber;
    }

    /**   setFieldCount
     *
     * @param int $fieldCount
     *
     * @return bool
     */
    public function setFieldCount($fieldCount)
    {
        try {
            if (CheckInput::checkNewInput($fieldCount)) {
                $this->fieldCount = $fieldCount;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": fieldCount invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getFieldCount
     *
     * @return int
     */
    public function getFieldCount()
    {
        return $this->fieldCount;
    }

    /**   setInsertId
     *
     * @param int $insertId
     *
     * @return bool
     */
    public function setInsertId($insertId)
    {
        try {
            if (CheckInput::checkNewInput($insertId)) {
                $this->insertId = $insertId;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": insertId invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getInsertId
     *
     * @return int
     */
    public function getInsertId()
    {
        return $this->insertId;
    }

    /**   setNumberOfRows
     *
     * @param int $numberOfRows
     *
     * @return bool
     */
    public function setNumberOfRows($numberOfRows)
    {
        try {
            if (CheckInput::checkNewInput($numberOfRows)) {
                $this->numberOfRows = $numberOfRows;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": numberOfRows invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getNumberOfRows
     *
     * @return int
     */
    public function getNumberOfRows()
    {
        return $this->numberOfRows;
    }

    /**   setParameterCount
     *
     * @param int $parameterCount
     *
     * @return bool
     */
    public function setParameterCount($parameterCount)
    {
        try {
            if (CheckInput::checkNewInput($parameterCount)) {
                $this->parameterCount = $parameterCount;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": parameterCount invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getParameterCount
     *
     * @return int
     */
    public function getParameterCount()
    {
        return $this->parameterCount;
    }

    /**   setState
     *
     * @param string $state
     *
     * @return bool
     */
    public function setState($state)
    {
        try {
            if (CheckInput::checkNewInput($state)) {
                $this->state = $state;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": state invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getState
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }




    /** prepare
     *
     * @param string $query the query to prepare
     *
     * @return bool
     */
    abstract public function prepare( $query );

    /** bind
     *
     * @param array $typesVariables the variable to bind to the query
     *
     * @return bool
     */
    abstract public function bind( array $typesVariables );

    /** execute
     *
     * @return bool
     */
    abstract public function execute();

    /** bindResult
     *
     * @param array $variables the variable to bind to the result
     *
     * @return bool
     */
    abstract public function bindResult( array $variables );

    /** storeResult
     *
     * @return bool
     */
    abstract public function storeResult();

    /** seek
     *
     * @param int $offset the rows to offset
     *
     * @return bool
     */
    abstract public function seek( $offset );

    /** reset
     *
     * @return bool
     */
    abstract public function reset();

    /** close
     *
     * @return bool
     */
    abstract public function close();
}