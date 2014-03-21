<?php
/**
 * PHP version 5.4.17
 * Created by JetBrains PhpStorm.
 * User: Carl "Tex" Morgan
 * Date: 3/7/13
 * Time: 2:42 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once AMPHIBIAN_CORE_ABSTRACT . "BasicInteraction.php";
require_once "interfaces".DIRECTORY_SEPARATOR."TableDescriptionInterface.php";
/**
 * Class TableDescription
 *
 * @category Helper
 * @package  Core
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/TableDescription
 */
abstract class TableDescription
    extends BasicInteraction
    implements TableDescriptionInterface
{
    /**
     * @var string currentTableName a string of the current table name
     */
    public $currentTableName = null;
    /**
     * @var array tableArray an array of all the table names
     */
    public $tableArray = [];
    /**
     * @var string autoIncrementField a string storing the auto-increment field
     */
    public $autoIncrementField = null;
    /**
     * @var array primaryKeys an array of the primary keys
     */
    public $primaryKeys = [];
    /**
     * @var array uniqueKeys all the unique keys in the table
     */
    public $uniqueKeys = [];
    /**
     * @var array foreignKeys all the foreign keys in the table
     */
    public $foreignKeys = [];
    /**
     * @var array indexKeys all the index keys in the table
     */
    public $indexKeys = [];
    /**
     * @var array notNullArray all the not null keys in the table
     */
    public $notNullArray = [];
    /**
     * @var array fieldTypeArray field name => field type
     */
    public $fieldTypeArray = [];
    /**
     * @var array typeFrequencyArray field type => count
     */
    public $typeFrequencyArray = [];
    /**
     * @var mixed result the result of a general query
     */
    protected $result = null;
    /**
     * @var mixed foreignResult the result of a foreign key query
     */
    protected $foreignResult = null;
    /**
     * @var array _row a single row from a result
     */
    protected $row = [];
    /**
     * @var array _foreignRow an array containing an foreign key array
     */
    protected $foreignRow = [];
    /**
     * @var mixed indexResult the result set of the index query
     */
    protected $indexResult = null;
    /**
     * @var array indexRow an array containing an index row
     */
    protected $indexRow = [];
    /**
     * @var array indexArray an array of the index columns
     */
    protected $indexArray = [];
    /**
     * @var string fieldName a string index of the field name
     */
    protected $fieldName = null;
    /**
     * @var string fieldType a string denoting the field type
     */
    protected $fieldType = null;
    /**
     * @var string fieldNull a string denoting if the field can be null
     */
    protected $fieldNull = null;
    /**
     * @var string fieldKey a string denoting if the field is a key
     */
    protected $fieldKey = null;
    /**
     * @var string fieldReferenceTable a string denoting the table referenced
     */
    protected $fieldReferenceTable = null;
    /**
     * @var string fieldReferenceField a string denoting the column referenced
     */
    protected $fieldReferenceField = null;
    /**
     * @var mixed fieldDefault the default value for this column
     */
    protected $fieldDefault = null;
    /**
     * @var string fieldExtra a string denoting any extra features of the column
     */
    protected $fieldExtra = null;


    /** setTableName
     *
     * @param string $name a specific table name
     *
     * @return bool
     */
    public function setTableName( $name )
    {
        try {
            if ( CheckInput::checkNewInput($name) ) {
                $this->currentTableName = $name;
                return true;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": setTableName failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** execute
     *
     * @return bool
     */
    public function execute()
    {
        try {
            if ( $this->setTableDescription() ) {
                while ( $this->iterate() ) {
                    $this->setupForNext();
                }
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setTableDescription
     *
     * @return bool
     */
    abstract protected function setTableDescription();

    /** iterate
     *
     * @return bool
     */
    protected function iterate()
    {
        if ( $this->setRow() ) {
            $this->storeRowInTableArray();
        } else {
            return false;
        }
        return true;
    }

    /** setRow
     *
     * @return bool
     */
    abstract protected function setRow();

    /** storeRowInTableArray
     *
     * @return void
     */
    abstract protected function storeRowInTableArray();

    /** storeTypeFrequency
     *
     * @return void
     */
    protected function storeTypeFrequency()
    {
        if ( array_key_exists($this->fieldType, $this->typeFrequencyArray) ) {
            $this->typeFrequencyArray[$this->fieldType] += 1;
        } else {
            $this->typeFrequencyArray[$this->fieldType] = 1;
        }
    }

    /** storePrimaryKey
     *
     * @return void
     */
    protected function storePrimaryKey()
    {
        $this->primaryKeys[$this->fieldName] = $this->fieldType;
        $this->initForeignKeys();
    }

    /** storeUniqueKey
     *
     * @return void
     */
    protected function storeUniqueKey()
    {
        $this->uniqueKeys[$this->fieldName] = $this->fieldType;
        $this->initForeignKeys();
    }

    /** initForeignKeys
     *
     * @return void
     */
    protected function initForeignKeys()
    {
        $this->fieldReferenceTable = null;
        $this->fieldReferenceField = null;
    }


    /** setupForNext
     *
     * @return void
     */
    protected function setupForNext()
    {
        $this->foreignResult = null;
        $this->row           = null;
        $this->foreignRow    = null;
        $this->fieldName     = null;
        $this->fieldType     = null;
        $this->fieldNull     = null;
        $this->fieldKey      = null;
        $this->fieldDefault  = null;
        $this->fieldExtra    = null;
        $this->initForeignKeys();
        $this->indexArray  = null;
        $this->indexResult = null;
        $this->indexRow    = null;
    }

    /**   getUniqueKeys
     *
     * @return array
     */
    public function getUniqueKeys()
    {
        return $this->uniqueKeys;
    }

    /**   getTypeFrequencyArray
     *
     * @return array
     */
    public function getTypeFrequencyArray()
    {
        return $this->typeFrequencyArray;
    }

    /**   getPrimaryKeys
     *
     * @return array
     */
    public function getPrimaryKeys()
    {
        return $this->primaryKeys;
    }

    /**   getNotNullArray
     *
     * @return array
     */
    public function getNotNullArray()
    {
        return $this->notNullArray;
    }

    /**   getIndexKeys
     *
     * @return array
     */
    public function getIndexKeys()
    {
        return $this->indexKeys;
    }

    /**   getForeignKeys
     *
     * @return array
     */
    public function getForeignKeys()
    {
        return $this->foreignKeys;
    }

    /**   getFieldTypeArray
     *
     * @return array
     */
    public function getFieldTypeArray()
    {
        return $this->fieldTypeArray;
    }

    /**   getAutoIncrementField
     *
     * @return string
     */
    public function getAutoIncrementField()
    {
        return $this->autoIncrementField;
    }

    /**   getTableArray
     *
     * @return array
     */
    public function getTableArray()
    {
        return $this->tableArray;
    }

    /** getColumns
     *
     * @return array
     */
    public function getColumns()
    {
        return array_keys($this->fieldTypeArray);
    }
}