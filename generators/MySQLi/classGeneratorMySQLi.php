<?php
/**
 * PHP Version:
 * Created by PhpStorm.
 * User: carl
 * Date: 12/20/13
 * Time: 9:19 PM
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." .DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once __DIR__ . DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."abstract".DIRECTORY_SEPARATOR."classGenerator.php";
require_once AMPHIBIAN_CORE_MYSQLI."TableDescriptionMySQLi.php";
require_once "interfaces".DIRECTORY_SEPARATOR."classGeneratorMySQLiInterface.php";
/**
 * Class ClassGeneratorMySQLi
 *
 * @category ClassGenerator
 * @package  ClassGeneratorMySQLi
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
* @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/
 */
class ClassGeneratorMySQLi
    extends ClassGenerator
    implements ClassGeneratorMySQLiInterface
{
    /**
     * @var object ClassGeneratorMySQLi a singleton instance of this class
     */
    static public $ClassGeneratorMySQLi;

    /** __construct
     *
     * @param resource $databaseConnection a valid database connection
     */
    protected function __construct($databaseConnection)
    {
        try {
            parent::__construct($databaseConnection);
            if ( defined('MODELS_GENERATED') ) {
                $this->setFileDestination(MODELS_GENERATED);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": unknown destination.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
    }

    /** instance
     *
     * @param resource $databaseConnection a valid database connection
     *
     * @return ClassGeneratorMySQLi
     */
    static public function instance($databaseConnection)
    {
        if ( !isset(self::$ClassGeneratorMySQLi) ) {
            self::$ClassGeneratorMySQLi = new ClassGeneratorMySQLi($databaseConnection);
        }
        return self::$ClassGeneratorMySQLi;
    }

    /** factory
     *
     * @param resource $databaseConnection a valid database connection
     *
     * @return ClassGeneratorMySQLi
     */
    static public function factory($databaseConnection)
    {
        return new ClassGeneratorMySQLi($databaseConnection);
    }

    /** getTableDescription
     *
     * @return bool
     */
    protected function getTableDescription()
    {
        try
        {
            $this->tableDescription = TableDescriptionMySQLi::instance($this->connection);
            if (CheckInput::checkNewInput($this->tableDescription)) {
                if ($this->tableDescription->setTableName($this->tableName)) {
                    if (!$this->tableDescription->execute()) {

                        throw new ExceptionHandler(__METHOD__ . "There was a problem during execution of the table description.");
                    }
                } else {
                    throw new ExceptionHandler(__METHOD__ . "Failed to set the table name.");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . "A table description object could not be created.");
            }
        } catch
        (ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** addAttributes
     *
     * @return bool
     */
    protected function addAttributes()
    {
        $this->buffer .= '    ' . '/*** Attributes: ***/' . PHP_EOL;
        foreach ($this->tableDescription->tableArray as $field => $rowArray) {
            if ($rowArray['key'] === 'PRI') {
                $this->buffer .= '    ' . 'private $' . $field . ';' . PHP_EOL;
            } else {
                $this->buffer .= '    ' . 'protected $' . $field . ';' . PHP_EOL;
            }
        }
        $this->addAcceptableKeys();
        $this->buffer .= '    ' . 'static public $' . $this->tableName . 'Model;' . PHP_EOL;
        $this->buffer .= PHP_EOL . PHP_EOL;
        return true;
    }

    /** addAcceptableKeys
     *
     * @return void
     */
    protected function addAcceptableKeys()
    {
        foreach ($this->tableDescription->tableArray as $field => $rowArray) {
            if ($rowArray['key'] === 'PRI') {
                $this->buffer .= '    ' . 'protected $acceptableKeys = array('.PHP_EOL;
                $this->buffer .= '        ' .'"' . $field . '"'.PHP_EOL;
            } else {
                $this->buffer .= '        ' . ', "' . $field . '"' . PHP_EOL;
            }
        }
        $this->buffer .= '    ' . ');' . PHP_EOL;
    }

    /** fetchAll
     *
     * @return bool
     */
    protected function fetchAll()
    {
        try {
            if (CheckInput::checkSet($this->connection)) {
                $this->tableArray = $this->connection->getTables();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": dead connection.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** addIndex
     *
     * @return void
     */
    protected function addIndex()
    {
        $this->buffer .= '    ' . '/** index' . PHP_EOL;
        $this->buffer .= '    ' . ' *' . PHP_EOL;
        $this->buffer .= '    ' . ' * @return boolean' . PHP_EOL;
        $this->buffer .= '    ' . ' */' . PHP_EOL;
        $this->buffer .= '    ' . 'public function index()' . PHP_EOL;
        $this->buffer .= '    ' . '{' . PHP_EOL;
        $this->buffer .= '    ' . '    try {' . PHP_EOL;
        $this->buffer .= '    ' . '    } catch ( ExceptionHandler $e ) {' . PHP_EOL;
        $this->buffer .= '    ' . '        $e->execute();' . PHP_EOL;
        $this->buffer .= '    ' . '        return false;' . PHP_EOL;
        $this->buffer .= '    ' . '    }' . PHP_EOL;
        $this->buffer .= '    ' . '    return true;' . PHP_EOL;
        $this->buffer .= '    ' . '}' . PHP_EOL . PHP_EOL;
    }

    /** addGet
     *
     * @return void
     */
    protected function addGet()
    {
        $this->buffer .= '    ' . '/** get' . PHP_EOL;
        $this->buffer .= '    ' . ' *' . PHP_EOL;
        $this->buffer .= '    ' . ' * @param integer $id the id of the object to fetch' . PHP_EOL;
        $this->buffer .= '    ' . ' *' . PHP_EOL;
        $this->buffer .= '    ' . ' * @return boolean' . PHP_EOL;
        $this->buffer .= '    ' . ' */' . PHP_EOL;
        $this->buffer .= '    ' . 'public function get( $id )' . PHP_EOL;
        $this->buffer .= '    ' . '{' . PHP_EOL;
        $this->buffer .= '    ' . '    try {' . PHP_EOL;
        $this->buffer .= '    ' . '        $this->prepQuery();' . PHP_EOL;
        $this->buffer .= '    ' . '        if ( CheckInput::checkNewInput($id) ) {' . PHP_EOL;
        $this->buffer .= '    ' . '            if ( $this->query->execute("CALL get' . $this->tableName . '(' . "'" . '$id' . "'" . ')") ) {' . PHP_EOL;
        $this->buffer .= '    ' . '                $this->query->getRow();' . PHP_EOL;
        $this->buffer .= '    ' . '                $this->setValuesFromRow();' . PHP_EOL;
        $this->buffer .= '    ' . '            } else {' . PHP_EOL;
        $this->buffer .= '    ' . '                throw new ExceptionHandler(__METHOD__.": The get query returned an error.");' . PHP_EOL;
        $this->buffer .= '    ' . '            }' . PHP_EOL;
        $this->buffer .= '    ' . '        }' . PHP_EOL;
        $this->buffer .= '    ' . '    } catch ( ExceptionHandler $e ) {' . PHP_EOL;
        $this->buffer .= '    ' . '        $e->execute();' . PHP_EOL;
        $this->buffer .= '    ' . '        return false;' . PHP_EOL;
        $this->buffer .= '    ' . '    }' . PHP_EOL;
        $this->buffer .= '    ' . '    return true;' . PHP_EOL;
        $this->buffer .= '    ' . '}' . PHP_EOL . PHP_EOL;
    }

    /** addUpdate
     *
     * @return void
     */
    protected function addUpdate()
    {
        $this->buffer .= '    ' . '/** update' . PHP_EOL;
        $this->buffer .= '    ' . ' *' . PHP_EOL;
        $this->buffer .= '    ' . ' * @return bool' . PHP_EOL;
        $this->buffer .= '    ' . ' */' . PHP_EOL;
        $this->buffer .= '    ' . 'public function update()' . PHP_EOL;
        $this->buffer .= '    ' . '{' . PHP_EOL;
        $this->buffer .= '    ' . '    try {' . PHP_EOL;
        $this->buffer .= '    ' . '        $this->prepQuery();' . PHP_EOL;
        $this->buffer .= '    ' . '        if ( $this->checkRequired() ) {' . PHP_EOL;
        $this->buffer .= '    ' . '            if ( $this->prewash() ) {' . PHP_EOL;
        $this->buffer .= '    ' . '                if ( $this->query->execute(' . PHP_EOL;
        $this->buffer .= '    ' . '                    "CALL update' . $this->tableName . '(' . PHP_EOL;
        $this->addUpdateArguments();
        $this->buffer .= '    ' . '                    )"' . PHP_EOL;
        $this->buffer .= '    ' . '                )' . PHP_EOL;
        $this->buffer .= '    ' . '                ) {' . PHP_EOL;
        $this->buffer .= '    ' . '                    $this->query->checkAffected();' . PHP_EOL;
        $this->buffer .= '    ' . '                } else {' . PHP_EOL;
        $this->buffer .= '    ' . '                    throw new ExceptionHandler(__METHOD__ . ": The update query returned an error.");' . PHP_EOL;
        $this->buffer .= '    ' . '                }' . PHP_EOL;
        $this->buffer .= '    ' . '            }' . PHP_EOL;
        $this->buffer .= '    ' . '        }' . PHP_EOL;
        $this->buffer .= '    ' . '    } catch ( ExceptionHandler $e ) {' . PHP_EOL;
        $this->buffer .= '    ' . '        $e->execute();' . PHP_EOL;
        $this->buffer .= '    ' . '        return false;' . PHP_EOL;
        $this->buffer .= '    ' . '    }' . PHP_EOL;
        $this->buffer .= '    ' . '    return true;' . PHP_EOL;
        $this->buffer .= '    ' . '}' . PHP_EOL . PHP_EOL;
    }

    /** addUpdateArguments
     *
     * @return bool
     */
    protected function addUpdateArguments()
    {
        try {
            if (CheckInput::checkNewInputArray($this->tableDescription->fieldTypeArray)) {
                foreach ($this->tableDescription->fieldTypeArray as $key => $type) {
                    if ($key === 'id') {
                        $this->buffer .= '    ' . '                    \'$this->' . $key . '\'' . PHP_EOL;
                    } else {
                        $this->buffer .= '    ' . '                    ,\'$this->' . $key . '\'' . PHP_EOL;
                    }
                }
            } else {
                throw new ExceptionHandler("Field type array is not set.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** addInsert
     *
     * @return void
     */
    protected function addInsert()
    {
        $this->buffer .= '    ' . '/** insert' . PHP_EOL;
        $this->buffer .= '    ' . ' *' . PHP_EOL;
        $this->buffer .= '    ' . ' * @return bool' . PHP_EOL;
        $this->buffer .= '    ' . ' */' . PHP_EOL;
        $this->buffer .= '    ' . 'public function insert()' . PHP_EOL;
        $this->buffer .= '    ' . '{' . PHP_EOL;
        $this->buffer .= '    ' . '    try {' . PHP_EOL;
        $this->buffer .= '    ' . '        $this->prepQuery();' . PHP_EOL;
        $this->buffer .= '    ' . '        if ( $this->checkRequired()) {' . PHP_EOL;
        $this->buffer .= '    ' . '            if ( $this->prewash() ) {' . PHP_EOL;
        $this->buffer .= '    ' . '                if ( $this->query->execute(' . PHP_EOL;
        $this->buffer .= '    ' . '                    "CALL insert' . $this->tableName . '(' . PHP_EOL;
        $this->addInsertArguments();
        $this->buffer .= '    ' . '                    , @ceid)"' . PHP_EOL;
        $this->buffer .= '    ' . '                )' . PHP_EOL;
        $this->buffer .= '    ' . '                ) {' . PHP_EOL;
        $this->buffer .= '    ' . '                    $this->getInsertId();' . PHP_EOL;
        $this->buffer .= '    ' . '                } else {' . PHP_EOL;
        $this->buffer .= '    ' . '                    throw new ExceptionHandler(__METHOD__.": The insert failed.");' . PHP_EOL;
        $this->buffer .= '    ' . '                }' . PHP_EOL;
        $this->buffer .= '    ' . '            }' . PHP_EOL;
        $this->buffer .= '    ' . '        }' . PHP_EOL;
        $this->buffer .= '    ' . '    } catch ( ExceptionHandler $e ) {' . PHP_EOL;
        $this->buffer .= '    ' . '        $e->execute();' . PHP_EOL;
        $this->buffer .= '    ' . '        return false;' . PHP_EOL;
        $this->buffer .= '    ' . '    }' . PHP_EOL;
        $this->buffer .= '    ' . '    return true;' . PHP_EOL;
        $this->buffer .= '    ' . '}' . PHP_EOL . PHP_EOL;
    }

    /** addInsertArguments
     *
     * @return bool
     */
    protected function addInsertArguments()
    {
        try {
            if (CheckInput::checkNewInputArray($this->tableDescription->notNullArray)) {
                foreach ($this->tableDescription->notNullArray as $key => $type) {
                    if ($key === 'id') {
                        $first_pass = true;
                        //} elseif ( $key === 'create_date' ) {
                    } else {
                        if ($first_pass === true) {
                            $this->buffer .= '    ' . '                    \'$this->' . $key . '\'' . PHP_EOL;
                            $first_pass = false;
                        } else {
                            $this->buffer .= '    ' . '                    ,\'$this->' . $key . '\'' . PHP_EOL;
                        }
                    }
                }
            } else {
                throw new ExceptionHandler("Field type array is not set.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** addGetInsertId
     *
     * @return void
     */
    protected function addGetInsertId()
    {
        $this->buffer .= '    ' . '/** getInsertId' . PHP_EOL;
        $this->buffer .= '    ' . ' *' . PHP_EOL;
        $this->buffer .= '    ' . ' * @return bool' . PHP_EOL;
        $this->buffer .= '    ' . ' */' . PHP_EOL;
        $this->buffer .= '    ' . 'public function getInsertId()' . PHP_EOL;
        $this->buffer .= '    ' . '{' . PHP_EOL;
        $this->buffer .= '    ' . '    try {' . PHP_EOL;
        $this->buffer .= '    ' . '        $this->prepQuery();' . PHP_EOL;
        $this->buffer .= '    ' . '        if ( $this->query->execute("Select @ceid as id") ) {' . PHP_EOL;
        $this->buffer .= '    ' . '            $this->query->getRow();' . PHP_EOL;
        $this->buffer .= '    ' . '            if ( !$this->setValue("id", $this->query->row["id"]) ) {' . PHP_EOL;
        $this->buffer .= '    ' . '                throw new ExceptionHandler(__METHOD__ . ": Setting the new id failed.");' . PHP_EOL;
        $this->buffer .= '    ' . '            }' . PHP_EOL;
        $this->buffer .= '    ' . '        } else {' . PHP_EOL;
        $this->buffer .= '    ' . '            throw new ExceptionHandler(__METHOD__ . ": The new id could not be retrieved.");' . PHP_EOL;
        $this->buffer .= '    ' . '        }' . PHP_EOL;
        $this->buffer .= '    ' . '    } catch ( ExceptionHandler $e ) {' . PHP_EOL;
        $this->buffer .= '    ' . '        $e->execute();' . PHP_EOL;
        $this->buffer .= '    ' . '        return false;' . PHP_EOL;
        $this->buffer .= '    ' . '    }' . PHP_EOL;
        $this->buffer .= '    ' . '    return true;' . PHP_EOL;
        $this->buffer .= '    ' . '}' . PHP_EOL . PHP_EOL;
    }

    /** addPatch
     *
     * @return void
     */
    protected function addPatch()
    {
        $this->buffer .= '    ' . '/** patch' . PHP_EOL;
        $this->buffer .= '    ' . ' *' . PHP_EOL;
        $this->buffer .= '    ' . ' * @param string $key the key to update specifically' . PHP_EOL;
        $this->buffer .= '    ' . ' *' . PHP_EOL;
        $this->buffer .= '    ' . ' * @return bool' . PHP_EOL;
        $this->buffer .= '    ' . ' */' . PHP_EOL;
        $this->buffer .= '    ' . 'public function patch( $key )' . PHP_EOL;
        $this->buffer .= '    ' . '{' . PHP_EOL;
        $this->buffer .= '    ' . '    try {' . PHP_EOL;
        $this->buffer .= '    ' . '        $this->prepQuery();' . PHP_EOL;
        $this->buffer .= '    ' . '        if ( $this->checkKey($key) ) {' . PHP_EOL;
        $this->buffer .= '    ' . '            if ( $this->query->execute("UPDATE '
            . $this->tableName
            . ' SET ". $key ." = ' . "'" . '$this->$key' . "'"
            . ', modify_date = NOW()'
            . ', modify_user = ".$_SESSION[' . "'" . 'user_id' . "'" . ']."'
            . ', modify_reason=' . "'" . 'patching $key' . "'" . ' WHERE '
            . $this->tableDescription->autoIncrementField
            . ' = ' . "'" . '$this->' . $this->tableDescription->autoIncrementField . "'"
            . '") ) {' . PHP_EOL;
        $this->buffer .= '    ' . '                $this->query->checkAffected();' . PHP_EOL;
        $this->buffer .= '    ' . '            } else {' . PHP_EOL;
        $this->buffer .= '    ' . '                throw new ExceptionHandler(__METHOD__.": patch failed!");' . PHP_EOL;
        $this->buffer .= '    ' . '            }' . PHP_EOL;
        $this->buffer .= '    ' . '        } else {' . PHP_EOL;
        $this->buffer .= '    ' . '            throw new ExceptionHandler(__METHOD__.": invalid key.");' . PHP_EOL;
        $this->buffer .= '    ' . '        }' . PHP_EOL;
        $this->buffer .= '    ' . '    } catch ( ExceptionHandler $e ) {' . PHP_EOL;
        $this->buffer .= '    ' . '        $e->execute();' . PHP_EOL;
        $this->buffer .= '    ' . '        return false;' . PHP_EOL;
        $this->buffer .= '    ' . '    }' . PHP_EOL;
        $this->buffer .= '    ' . '    return true;' . PHP_EOL;
        $this->buffer .= '    ' . '}' . PHP_EOL . PHP_EOL;
    }

    /** addDelete
     *
     * @return void
     */
    protected function addDelete()
    {
        $this->buffer .= '    ' . '/** delete' . PHP_EOL;
        $this->buffer .= '    ' . ' *' . PHP_EOL;
        $this->buffer .= '    ' . ' * @return bool' . PHP_EOL;
        $this->buffer .= '    ' . ' */' . PHP_EOL;
        $this->buffer .= '    ' . 'public function delete()' . PHP_EOL;
        $this->buffer .= '    ' . '{' . PHP_EOL;
        $this->buffer .= '    ' . '    try {' . PHP_EOL;
        $this->buffer .= '    ' . '        $this->prepQuery();' . PHP_EOL;
        $this->buffer .= '    ' . '        if ( CheckInput::checkSet($this->' . $this->tableDescription->autoIncrementField . ') ) {' . PHP_EOL;
        $this->buffer .= '    ' . '            if ( $this->query->execute("DELETE FROM ' . $this->tableName . ' WHERE ' . $this->tableDescription->autoIncrementField . "='" . '$this->' . $this->tableDescription->autoIncrementField . "'" . '") ) {' . PHP_EOL;
        $this->buffer .= '    ' . '                $this->query->checkAffected();' . PHP_EOL;
        $this->buffer .= '    ' . '            } else {' . PHP_EOL;
        $this->buffer .= '    ' . '                throw new ExceptionHandler(__METHOD__.": delete failed!");' . PHP_EOL;
        $this->buffer .= '    ' . '            }' . PHP_EOL;
        $this->buffer .= '    ' . '        } else {' . PHP_EOL;
        $this->buffer .= '    ' . '            throw new ExceptionHandler(__METHOD__.": The ' . $this->tableDescription->autoIncrementField . ' must be set.");' . PHP_EOL;
        $this->buffer .= '    ' . '        }' . PHP_EOL;
        $this->buffer .= '    ' . '    } catch ( ExceptionHandler $e ) {' . PHP_EOL;
        $this->buffer .= '    ' . '        $e->execute();' . PHP_EOL;
        $this->buffer .= '    ' . '        return false;' . PHP_EOL;
        $this->buffer .= '    ' . '    }' . PHP_EOL;
        $this->buffer .= '    ' . '    return true;' . PHP_EOL;
        $this->buffer .= '    ' . '}' . PHP_EOL . PHP_EOL;
    }

    /** addValidate
     *
     * @return void
     */
    protected function addValidate()
    {
        $this->buffer .= '    ' . '/** validate' . PHP_EOL;
        $this->buffer .= '    ' . ' *' . PHP_EOL;
        $this->buffer .= '    ' . ' * @param integer $id unsigned integer reference to the table primary key' . PHP_EOL;
        $this->buffer .= '    ' . ' *' . PHP_EOL;
        $this->buffer .= '    ' . ' * @return bool' . PHP_EOL;
        $this->buffer .= '    ' . ' */' . PHP_EOL;
        $this->buffer .= '    ' . 'public function validate( $id )' . PHP_EOL;
        $this->buffer .= '    ' . '{' . PHP_EOL;
        $this->buffer .= '    ' . '    try {' . PHP_EOL;
        $this->buffer .= '    ' . '        $this->prepQuery();' . PHP_EOL;
        $this->buffer .= '    ' . '        if ( CheckInput::checkNewInput($id) ) {' . PHP_EOL;
        $this->buffer .= '    ' . '            if ( $this->query->execute("CALL validate' . $this->tableName . '(' . "'" . '$id' . "'" . ')") ) {' . PHP_EOL;
        $this->buffer .= '    ' . '                $this->query->checkAffected();' . PHP_EOL;
        $this->buffer .= '    ' . '            } else {' . PHP_EOL;
        $this->buffer .= '    ' . '                throw new ExceptionHandler(__METHOD__.": Validation sproc error!");' . PHP_EOL;
        $this->buffer .= '    ' . '            }' . PHP_EOL;
        $this->buffer .= '    ' . '        } else {' . PHP_EOL;
        $this->buffer .= '    ' . '            throw new ExceptionHandler(__METHOD__.": The id must be set.");' . PHP_EOL;
        $this->buffer .= '    ' . '        }' . PHP_EOL;
        $this->buffer .= '    ' . '    } catch ( ExceptionHandler $e ) {' . PHP_EOL;
        $this->buffer .= '    ' . '        $e->execute();' . PHP_EOL;
        $this->buffer .= '    ' . '        return false;' . PHP_EOL;
        $this->buffer .= '    ' . '    }' . PHP_EOL;
        $this->buffer .= '    ' . '    return true;' . PHP_EOL;
        $this->buffer .= '    ' . '}' . PHP_EOL . PHP_EOL;
    }

    /** addSetValue
     *
     * @return void
     */
    protected function addSetValue()
    {
        $this->buffer .= '    ' . '/** setValue' . PHP_EOL;
        $this->buffer .= '    ' . ' *' . PHP_EOL;
        $this->buffer .= '    ' . ' * @param string $key   the index you want to use' . PHP_EOL;
        $this->buffer .= '    ' . ' * @param mixed  $value the value to set to that index' . PHP_EOL;
        $this->buffer .= '    ' . ' *' . PHP_EOL;
        $this->buffer .= '    ' . ' * @return boolean' . PHP_EOL;
        $this->buffer .= '    ' . ' */' . PHP_EOL;
        $this->buffer .= '    ' . 'public function setValue($key, $value)' . PHP_EOL;
        $this->buffer .= '    ' . '{' . PHP_EOL;
        $this->buffer .= '    ' . '    if ( isset($key, $value) AND !is_null($key) ) {' . PHP_EOL;
        $this->buffer .= '    ' . '        switch($key){' . PHP_EOL;
        $this->addTypeCases();
        $this->buffer .= '    ' . '        default :' . PHP_EOL;
        $this->buffer .= '    ' . '            break;' . PHP_EOL;
        $this->buffer .= '    ' . '        }' . PHP_EOL;
        $this->buffer .= '    ' . '        return true;' . PHP_EOL;
        $this->buffer .= '    ' . '    } else {' . PHP_EOL;
        $this->buffer .= '    ' . '        return false;' . PHP_EOL;
        $this->buffer .= '    ' . '    }' . PHP_EOL;
        $this->buffer .= '    ' . '}' . PHP_EOL . PHP_EOL;
    }

    /** addTypeCases
     *
     * @return bool
     */
    protected function addTypeCases()
    {
        try {
            if (CheckInput::checkNewInputArray($this->tableDescription->fieldTypeArray)) {
                $tmpType = null;
                foreach ($this->tableDescription->fieldTypeArray as $field => $type) {
                    $tmpType = $this->explodeType($type);
                    if ($tmpType["size"] === null) {
                        $tmpType["size"] = 'null';
                    }
                    $this->buffer .= '    ' . '        case \'';
                    $this->buffer .= $field . '\' :' . PHP_EOL;
                    $this->buffer .= '    ' . '            if ( $this->CheckValue(' . PHP_EOL;
                    $this->buffer .= '                    ' . '"' . $type . '",' . PHP_EOL;
                    $this->buffer .= '                    ' . $tmpType["size"] . ',' . PHP_EOL;
                    $this->buffer .= '                    ' . '$value' . PHP_EOL;
                    $this->buffer .= '                ' . ') ) {' . PHP_EOL;
                    $this->buffer .= '    ' . '                $this->' . $field;
                    $this->buffer .= '=$value;' . PHP_EOL;
                    $this->buffer .= '    ' . '            } else {' . PHP_EOL;
                    $this->buffer .= '    ' . '                return false;' . PHP_EOL;
                    $this->buffer .= '    ' . '            };' . PHP_EOL;
                    $this->buffer .= '    ' . '            break;' . PHP_EOL;
                    $tmpType = null;
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . "The field type array is not set.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** addCaseByType
     *
     * @return void
     */
    protected function addCaseByType()
    {
        foreach ($this->tableDescription->typeFrequencyArray as $type => $frequency) {
            $this->buffer .= '    ' . '            case "' . $type . '":' . PHP_EOL;
            $this->buffer .= '    ' . '                if ( ';
            $this->currentType = $this->explodeType($type);
            if (in_array(
                $this->currentType["type"],
                array("bigint", "int", "tinyint", "smallint", "integer", "mediumint")
            )
            ) {
                $this->buffer .= ' ' . 'is_int(intval($value)) AND $max >= strlen($value) ';
            }
            if (in_array($this->currentType["type"], array("bool", "boolean", "bit"))) {
                $this->buffer .= ' ' . 'is_bool(boolval($value)) AND $max >= strlen($value) ';
            }
            if ($this->currentType["type"] === "float") {
                $this->buffer .= ' ' . 'is_float(floatval($value)) AND $max >= strlen($value) ';
            }
            if ($this->currentType["type"] === "double" || $this->currentType["type"] === "decimal") {
                $this->buffer .= ' ' . 'is_double(doubleval($value))';
            }
            if ($this->currentType["type"] === "varchar" || $this->currentType["type"] === "char") {
                $this->buffer .= ' ' . 'is_string($value) AND $max >= strlen($value) ';
            }
            if ($this->currentType["type"] === "enum") {
                $this->buffer .= ' ' . 'in_array($value, array(';
                foreach ($this->currentType["options"] as $opt => $p) {
                    if ($opt === 0) {
                        $this->buffer .= ' ' . '' . $p;
                    } else {
                        $this->buffer .= ' ' . ', ' . $p;
                    }
                }
                $this->buffer .= ' ' . ')) ';
            }
            /*
             * TODO : update to check time, date, blob, and text lengths
             */
            if (in_array(
                $this->currentType["type"],
                array("time", "date", "datetime", "timestamp", "year")
            )
            ) {
                $this->buffer .= ' ' . 'true ';
            }
            if (in_array(
                $this->currentType["type"],
                array("tinyblob", "mediumblob", "blob", "longblob", "binary", "varbinary")
            )
            ) {
                $this->buffer .= ' ' . 'true ';
            }
            if (in_array(
                $this->currentType["type"],
                array("tinytext", "text", "mediumtext", "longtext")
            )
            ) {
                $this->buffer .= ' ' . 'true ';
            }
            if ($this->currentType["unsigned"] !== null) {
                $this->buffer .= ' ' . 'AND $value >=0 ';
            }
            $this->buffer .= ' ) {' . PHP_EOL;
            $this->buffer .= '    ' . '                    return true;' . PHP_EOL;
            $this->buffer .= '    ' . '                } else {' . PHP_EOL;
            $this->buffer .= '    ' . '                    return false;' . PHP_EOL;
            $this->buffer .= '    ' . '                }' . PHP_EOL;
            $this->buffer .= '    ' . '                break;' . PHP_EOL;
        }
    }

    /** explodeType
     *
     * @param string $type the variable type
     *
     * @return array
     */
    protected function explodeType($type)
    {
        if (substr_count($type, '(')) {
            $newType = explode('(', $type);
            $countUnsigned = explode(')', $newType['1']);
            if (sizeof($countUnsigned) > 1) {
                if (substr_count($countUnsigned['0'], ',') > 0) {
                    $options = explode(',', $countUnsigned['0']);
                    $array = array(
                        "type" => $newType['0'],
                        "size" => sizeof($options),
                        "unsigned" => null,
                        "options" => $options
                    );
                } else {
                    $array = array(
                        "type" => $newType['0'],
                        "size" => $countUnsigned['0'],
                        "unsigned" => trim($countUnsigned['1']),
                        "options" => null
                    );
                }
            } else {
                $array = array(
                    "type" => $newType['0'],
                    "size" => $countUnsigned['0'],
                    "unsigned" => null,
                    "options" => null
                );
            }
            return $array;
        } elseif ($this->checkUnsigned($type)) {
            $type = explode(' ', $type);
            $array = array("type" => $type['0'], "size" => null, "unsigned" => $type['1'], "options" => null);
            return $array;
        } else {
            $array = array("type" => $type, "size" => null, "unsigned" => null, "options" => null);
            return $array;
        }
    }
}

/*
$cg = ClassGeneratorMySQLi::instance($databaseConnection);
$cg->setAuthor('Carl "Tex" Morgan <texmorgan@'.APP_WEBSITE.'>');
$cg->setLicense("All rights reserved by ".APP_NAME." unless otherwise stated.");
$cg->setLink("http://".APP_WEBSITE."/documentation/uml/models/generated");
$cg->setTableName("User");
$cg->execute();


//require_once "/home/carl/Public/InnerAlly_SC/config/staging/InnerAlly.config.inc.php";
require_once AMPHIBIAN_CORE_MYSQLI . "databaseConnectionMySQLi.php";
$databaseConnection = databaseConnectionMySQLi::instance();
$databaseConnection->setServerName("localhost");
$databaseConnection->setDatabaseName("InnerAlly");
$databaseConnection->setUserName("root");
$databaseConnection->setUserPassword('4u$t1nTX');
$databaseConnection->openConnection();
$classGen = ClassGeneratorMySQLi::instance($databaseConnection);
$classGen->setFileDestination("/home/carl/Public/InnerAlly_SC/models/generated/");
$classGen->execute();
*/