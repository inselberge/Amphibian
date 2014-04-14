<?php
/**
 * PHP Version: ${PHP_VERSION}
 * Created by PhpStorm.
 * User: carl
 * Date: 1/21/14
 * Time: 10:43 AM
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once AMPHIBIAN_CORE_ABSTRACT."TableDescription.php";
require_once AMPHIBIAN_CORE_MYSQLI . "databaseQueryMySQLi.php";
require_once "interfaces".DIRECTORY_SEPARATOR."TableDescriptionMySQLiInterface.php";
/**
 * Class TableDescriptionMySQLi
 *
 * @category TableDescription
 * @package  TableDescriptionMySQLi
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/TableDescriptionMySQLi
 */
class TableDescriptionMySQLi
    extends TableDescription
    implements TableDescriptionMySQLiInterface
{

    /**
     * @var object query a DatabaseQueryMySQLi object
     */
    protected $query;
    /**
     * @var object TableDescriptionMySQLi a singleton instance of this class
     */
    static public $TableDescriptionMySQLi;

    /** __construct
     *
     * @param object $databaseConnection a valid database connection
     */
    public function __construct($databaseConnection)
    {
        parent::__construct($databaseConnection);
        $this->query = databaseQueryMySQLi::instance($databaseConnection);
    }

    /** instance
     *
     * @param object $databaseConnection a valid database connection
     *
     * @return TableDescriptionMySQLi
     */
    static public function instance($databaseConnection)
    {
        if ( !isset(self::$TableDescriptionMySQLi) ) {
            self::$TableDescriptionMySQLi = new TableDescriptionMySQLi($databaseConnection);
        }
        return self::$TableDescriptionMySQLi;
    }

    /** factory
     *
     * @param object $databaseConnection a valid database connection
     *
     * @return TableDescriptionMySQLi
     */
    static public function factory($databaseConnection)
    {
        return new TableDescriptionMySQLi($databaseConnection);
    }

    /** setTableDescription
     *
     * @return bool
     */
    protected function setTableDescription()
    {
        try {
            $this->query->execute("DESCRIBE `" . $this->currentTableName . "`");
            if ($this->query->checkAffected()) {
                throw new ExceptionHandler(__METHOD__ . ": setTableDescription failed");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setRow
     *
     * @return bool
     */
    protected function setRow()
    {
        $this->row = mysqli_fetch_assoc($this->result);
        if (CheckInput::checkSet($this->row)) {
            return true;
        } else {
            return false;
        }
    }

    /** storeRowInTableArray
     *
     * @return void
     */
    protected function storeRowInTableArray()
    {
        $this->getFieldName();
        $this->getFieldType();
        $this->getFieldNulls();
        $this->setFieldKeys();
        $this->getFieldDefault();
        $this->getFieldExtra();
        $this->tableArray[$this->fieldName]
            = [
            "type" => $this->fieldType,
            "nullAllowed" => $this->fieldNull,
            "key" => $this->fieldKey,
            "foreignTable" => $this->fieldReferenceTable,
            "foreignField" => $this->fieldReferenceField,
            "defaultValue" => $this->fieldDefault,
            "extra" => $this->fieldExtra
        ];
        $this->storeNulls();
        $this->storeFieldType();
        $this->storeTypeFrequency();
    }

    /** getFieldName
     *
     * @return void
     */
    protected function getFieldName()
    {
        $this->fieldName = $this->row['Field'];
    }

    /** getFieldType
     *
     * @return void
     */
    protected function getFieldType()
    {
        $this->fieldType = $this->row['Type'];
    }

    /** getFieldNulls
     *
     * @return void
     */
    protected function getFieldNulls()
    {
        $this->fieldNull = $this->row['Null'];
    }

    /** getFieldDefault
     *
     * @return void
     */
    protected function getFieldDefault()
    {
        $this->fieldDefault = $this->row['Default'];
    }

    /** getFieldExtra
     *
     * @return void
     */
    protected function getFieldExtra()
    {
        if ($this->row['Extra'] === "auto_increment") {
            $this->fieldExtra = $this->row['Extra'];
            $this->autoIncrementField = $this->row['Field'];
        }
    }

    /** storeNulls
     *
     * @return void
     */
    protected function storeNulls()
    {
        if ($this->fieldNull === "NO") {
            $this->notNullArray[$this->fieldName] = $this->fieldType;
        }
    }

    /** storeFieldType
     *
     * @return void
     */
    protected function storeFieldType()
    {
        $this->fieldTypeArray[$this->fieldName] = $this->fieldType;
    }

    /** setFieldKeys
     *
     * @return void
     */
    protected function setFieldKeys()
    {
        if (CheckInput::checkSet($this->row['Key'])) {
            if ($this->setKeyType()) {
                $this->fieldKey = $this->row['Key'];
            }
        } else {
            $this->fieldKey = null;
        }
    }

    /** setKeyType
     *
     * @return bool
     */
    protected function setKeyType()
    {
        try {
            if ($this->row['Key']) {
                if ($this->row['Key'] == "PRI") {
                    $this->storePrimaryKey();
                } elseif ($this->row['Key'] == "UNI") {
                    $this->storeUniqueKey();
                } elseif ($this->row['Key'] == "MUL") {
                    $this->storeForeignKey();
                } else {
                    throw new ExceptionHandler(__METHOD__ . ": Unsupported type ");
                }
            } else {
                return false;
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** storeForeignKey
     *
     * @return bool
     */
    protected function storeForeignKey()
    {
        try {
            if ($this->extractFieldReferences()) {
                $this->foreignKeys[]
                    = [
                    "localField" => $this->fieldName,
                    "foreignTable" => $this->fieldReferenceTable,
                    "foreignField" => $this->fieldReferenceField
                ];
            } elseif ($this->setIndexColumns()) {
                $this->indexKeys[$this->fieldName] = $this->indexArray;
            } else {
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** extractFieldReferences
     *
     * @return bool
     */
    protected function extractFieldReferences()
    {
        try {
            $q = "select referenced_table_name, referenced_column_name"
                . "from information_schema.key_column_usage "
                . "where referenced_table_name is not null AND table_schema='"
                . DB_NAME . "' AND table_name='"
                . $this->currentTableName
                . "' AND column_name='" . $this->fieldName . "'";
            $this->foreignResult = mysqli_query($this->connection, $q);
            if ($this->foreignResult->num_rows > 0) {
                $this->foreignRow = mysqli_fetch_assoc($this->foreignResult);
                $this->setFieldReferenceTable();
                $this->setFieldReferenceField();
            } else {
                throw new ExceptionHandler(__METHOD__ . ":getFieldReferences failed.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setIndexColumns
     *
     * @return bool
     */
    protected function setIndexColumns()
    {
        try {
            $q = "select seq_in_index, column_name"
                . "from information_schema.statistics where table_schema='"
                . DB_NAME . "' AND table_name='"
                . $this->currentTableName . "' AND index_name='"
                . $this->fieldName . "'";
            $this->indexResult = mysqli_query($this->connection, $q);
            if ($this->indexResult->num_rows > 0) {
                $this->indexArray = [];
                $this->indexRow = mysqli_fetch_assoc($this->indexResult);
                while ($this->indexRow) {
                    $this->indexArray[$this->indexRow['seq_in_index']]
                        = $this->indexRow['column_name'];
                    $this->indexRow = null;
                    $this->indexRow = mysqli_fetch_assoc($this->indexResult);
                }
            } elseif ($this->indexResult->num_rows == 0) {
                return false;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": setIndexColumns failed");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setFieldReferenceTable
     *
     * @return void
     */
    protected function setFieldReferenceTable()
    {
        $this->fieldReferenceTable = $this->foreignRow['referenced_table_name'];
    }

    /** setFieldReferenceField
     *
     * @return void
     */
    protected function setFieldReferenceField()
    {
        $this->fieldReferenceField = $this->foreignRow['referenced_column_name'];
    }

}
/*
 * One table example
 *
require_once "../project/AffCell/database/staging/AffCell.mysql.config.inc.php";
require_once "../config/mysql.cfg.php";
$TD = TableDescriptionMySQLi::instance($databaseConnection);
$TD->setTableName("Users");
$TD->execute();
print_r($TD);
*/