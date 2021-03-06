<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Carl "Tex" Morgan
 * Date: 4/2/13
 * Time: 6:07 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
/**/
require_once __DIR__ . DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once AMPHIBIAN_CORE_ABSTRACT . "TableDescription.php";
require_once AMPHIBIAN_CORE_NEUTRAL . "FileHandle.php";
require_once AMPHIBIAN_GENERATORS_ABSTRACT."sprocGenerator.php";
require_once "interfaces".DIRECTORY_SEPARATOR."sprocGeneratorMySQLiInterface.php";

/**
 * Class SprocGeneratorMySQLi
 *
 * @category SprocGenerator
 * @package  SprocGeneratorMySQLi
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/SprocGeneratorMySQLi
 */
class SprocGeneratorMySQLi
    extends SprocGenerator
    implements SprocGeneratorMySQLiInterface
{
    /**
     * @var  _sprocGeneratorMySQLi
     */
    static private $_sprocGeneratorMySQLi;
    /**
     * @var  sprocInArguments
     */
    protected $sprocInArguments;
    /**
     * @var  sprocOutArguments
     */
    protected $sprocOutArguments;
    /**
     * @var  foreignQuery
     */
    protected $foreignQuery;
    /**
     * @var  sprocQuery
     */
    protected $sprocQuery;
    /**
     * @var  primaryKeyPairList
     */
    protected $primaryKeyPairList;

    /** __autoload
     *
     * @return void
     */
    protected function __autoload()
    {

    }

    /** __clone
     *
     * @return void
     */
    protected function __clone()
    {
    }

    /** instance
     *
     * @param object $databaseConnection a valid database connection
     *
     * @return object
     */
    static public function instance( $databaseConnection )
    {
        try {
            if ( isset($databaseConnection) & !is_null($databaseConnection) ) {
                if ( !isset(self::$_sprocGeneratorMySQLi) ) {
                    self::$_sprocGeneratorMySQLi              = new SprocGeneratorMySQLi($databaseConnection);
                    self::$_sprocGeneratorMySQLi->_connection = $databaseConnection;
                }
                return self::$_sprocGeneratorMySQLi;
            } else {
                throw new ExceptionHandler("Tne database connection must be set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** factory
     *
     * @param object $databaseConnection a valid database connection
     *
     * @return object
     */
    static public function factory($databaseConnection)
    {
        try {
            if (isset($databaseConnection) & !is_null($databaseConnection)) {
                return new SprocGeneratorMySQLi($databaseConnection);
            } else {
                throw new ExceptionHandler("Tne database connection must be set.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
    }

    /** setTableNames
     *
     * @param array $array the tables to generate sprocs for in the run
     *
     * @return bool
     */
    public function setTableNames( array $array )
    {
        try {
            if ( $this->checkNewInput($array) ) {
                if ( is_array($array) ) {
                    $this->_tableNames = $array;
                } else {
                    throw new ExceptionHandler("The input is not an array.");
                }
            } else {
                throw new ExceptionHandler("Tne table names array could not be set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** execute
     *
     * @return bool
     */
    public function execute()
    {
        try {
            if (!isset($this->_tableNames)) {
                $this->_tableNames = $this->connection->getTables();
            }
            foreach ($this->_tableNames as $this->currentTableName) {
                $this->initialize();
                $this->prepareTableDescription();
                if ( !$this->iterate() ) {
                    throw new ExceptionHandler(__METHOD__ . ": $this->currentTableName failed.");
                }
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** prepareTableDescription
     *
     * @return void
     */
    protected function prepareTableDescription()
    {
        $this->_tableDescription = TableDescription::instance($this->_connection);
        $this->_tableDescription->setTableName($this->currentTableName);
        $this->_tableDescription->execute();
        $this->autoIncrementColumnName = $this->_tableDescription->autoIncrementField;
        $this->makeColumnsCommaList();
    }

    /** extractRequiredColumnsFromDescription
     *
     * @return void
     */
    protected function extractRequiredColumnsFromDescription()
    {
    }

    /** extractPrimaryKeyColumnsFromDescription
     *
     * @return void
     */
    protected function extractPrimaryKeyColumnsFromDescription()
    {
    }

    /** extractForeignKeyColumnsFromDescription
     *
     * @return void
     */
    protected function extractForeignKeyColumnsFromDescription()
    {
    }

    /** makeInputVariableList
     *
     * @return void
     */
    protected function makeInputVariableList()
    {
    }

    /** initialize
     *
     * @return void
     */
    protected function initialize()
    {
        $this->sprocInArguments               = null;
        $this->sprocOutArguments              = null;
        $this->foreignQuery                   = null;
        $this->primaryKeyPairList             = null;
        $this->sprocQuery                     = null;
        $this->autoIncrementColumnName        = null;
        $this->_currentTableInputVariableList = null;
        $this->_currentTableColumnsCommaList  = null;
        $this->_currentTableUpdatePairsList   = null;
        $this->_currentTableInsertFieldList   = null;
    }


    /** iterate
     *
     * @return bool
     */
    protected function iterate()
    {
        try {
            $this->_FileHandle = new FileHandle("/" . DATABASE_STORED_PROCEDURES . ucwords($this->currentTableName) . ".sql");
            $this->writeAllSprocs();
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }


    /** writeAllSprocs
     *
     * @return bool
     */
    protected function writeAllSprocs()
    {
        try {
            $this->makeInputForGetValidate();
            $this->buildSprocQuery('validate', $this->sprocValidate());
            $this->buildSprocQuery('get', $this->sprocGet());
            $this->makeInputForUpdate();
            $this->makeUpdatePairsList();
            $this->buildSprocQuery('update', $this->sprocUpdate());
            $this->makeInputForInsert();
            $this->buildSprocQuery('insert', $this->sprocInsert() . $this->sprocInsertID());
            $this->writeSproc();
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }


    /** buildSprocQuery
     *
     * @param $queryType
     * @param $queryBody
     *
     * @return void
     */
    protected function buildSprocQuery( $queryType, $queryBody )
    {
        $this->sprocQuery .= $this->sprocChangeDelimiter();
        $this->sprocQuery .= $this->sprocDropPrevious($queryType);
        $this->sprocQuery .= $this->sprocCreate($queryType);
        $this->sprocQuery .= $this->sprocBeginQuery();
        $this->sprocQuery .= $queryBody;
        $this->sprocQuery .= $this->sprocEndQuery();
    }

    /** sprocChangeDelimiter
     *
     * @return string
     */
    protected function sprocChangeDelimiter()
    {
        return "DELIMITER $$" . PHP_EOL;
    }

    /** sprocDropPrevious
     *
     * @param $sprocType
     *
     * @return string
     */
    protected function sprocDropPrevious( $sprocType )
    {
        return "DROP PROCEDURE IF EXISTS `" . DB_NAME . "`.`" . $sprocType . ucwords($this->currentTableName) . "`$$" . PHP_EOL;
    }

    /** sprocCreate
     *
     * @param $sprocType
     *
     * @return string
     */
    protected function sprocCreate( $sprocType )
    {
        if ( isset($this->sprocOutArguments) ) {
            return "CREATE PROCEDURE `" . $sprocType . ucwords($this->currentTableName) . "`(" . $this->sprocInArguments . ", " . $this->sprocOutArguments . ")" . PHP_EOL;
        } else {
            return "CREATE PROCEDURE `" . $sprocType . ucwords($this->currentTableName) . "`(" . $this->sprocInArguments . ")" . PHP_EOL;
        }
    }


    /** sprocBeginQuery
     *
     * @return string
     */
    protected function sprocBeginQuery()
    {
        return "BEGIN" . PHP_EOL;
    }


    /** sprocValidate
     *
     * @return string
     */
    protected function sprocValidate()
    {
        return "\t" . "SELECT 1 \n\tFROM `" . $this->currentTableName . "` \n\tWHERE " . $this->makeKeyValuePair($this->autoIncrementColumnName) . ";" . PHP_EOL;
    }


    /** sprocUpdate
     *
     * @return string
     */
    protected function sprocUpdate()
    {
        return "\t" . "UPDATE `" . $this->currentTableName . "` \n\tSET " . $this->_currentTableUpdatePairsList . " \n\tWHERE " . $this->primaryKeyPairList . $this->foreignKeyCheck() . ";" . PHP_EOL;
    }

    /** sprocInsert
     *
     * @return string
     */
    protected function sprocInsert()
    {
        return "\t" . "INSERT INTO `" . $this->currentTableName . "` (" . $this->_currentTableInsertFieldList . ") \n\tVALUES (" . strtoupper($this->_currentTableInputVariableList) . ");" . PHP_EOL;
    }


    /** sprocInsertID
     *
     * @return string
     */
    protected function sprocInsertID()
    {
        return "\t" . "SELECT LAST_INSERT_ID() INTO " . strtoupper($this->autoIncrementColumnName) . "_VALUE; " . PHP_EOL;
    }

    /** sprocGet
     *
     * @return string
     */
    protected function sprocGet()
    {
        return "\t" . "SELECT " . $this->_currentTableColumnsCommaList . " \n\tFROM `" . $this->currentTableName . "` \n\tWHERE " . $this->makeKeyValuePair($this->autoIncrementColumnName) . ";" . PHP_EOL;
    }

    /** sprocEndQuery
     *
     * @return string
     */
    protected function sprocEndQuery()
    {
        return "END$$" . PHP_EOL . "DELIMITER ;\n" . PHP_EOL;
    }

    /** writeSproc
     *
     * @return void
     */
    protected function writeSproc()
    {
        $this->_FileHandle->writeFull($this->sprocQuery);
    }

    /** makeInputForUpdate
     *
     * @return void
     */
    protected function makeInputForUpdate()
    {
        $this->unsetSprocArguments();
        foreach ( $this->_tableDescription->fieldTypeArray as $currentField => $currentType ) {
            $this->sprocInArguments .= $this->appendInArguments($currentField, $currentType);
        }
    }

    /** makeInputForInsert
     *
     * @return void
     */
    protected function makeInputForInsert()
    {
        $this->unsetSprocArguments();
        foreach ( $this->_tableDescription->notNullArray as $currentField => $currentType ) {
            if ( in_array($currentField, array_keys($this->_tableDescription->primaryKeys)) ) {
            } else {
                $this->_currentTableInsertFieldList .= $this->addInsertListItem($currentField);
                $this->_currentTableInputVariableList .= $this->addInputVariableListItem($currentField);
                $this->sprocInArguments .= $this->appendInArguments($currentField, $currentType);
            }
        }
        $this->makeInputOutputPrimaryKeys("OUT");
    }

    /** makeInputForGetValidate
     *
     * @return void
     */
    protected function makeInputForGetValidate()
    {
        $this->unsetSprocArguments();
        $this->makeInputOutputPrimaryKeys("IN");
    }

    /** unsetSprocArguments
     *
     * @return void
     */
    protected function unsetSprocArguments()
    {
        unset($this->sprocInArguments);
        unset($this->sprocOutArguments);
    }

    /** makeInputOutputPrimaryKeys
     *
     * @param $direction
     *
     * @return void
     */
    protected function makeInputOutputPrimaryKeys( $direction )
    {
        foreach ( $this->_tableDescription->primaryKeys as $currentPrimaryKey => $currentPrimaryType ) {
            if ( $direction === "IN" ) {
                $this->sprocInArguments .= $this->appendInArguments($currentPrimaryKey, $currentPrimaryType);
            } elseif ( $direction === "OUT" ) {
                $this->sprocOutArguments .= $this->appendOutArguments($currentPrimaryKey, $currentPrimaryType);;
            } elseif ( $direction === "BOTH" ) {
                $this->sprocInArguments .= $this->appendInArguments($currentPrimaryKey, $currentPrimaryType);
                $this->sprocOutArguments .= $this->appendOutArguments($currentPrimaryKey, $currentPrimaryType);
            }
            $this->makePrimaryPairList($currentPrimaryKey);
        }
    }

    /** appendInArguments
     *
     * @param $key
     * @param $type
     *
     * @return string
     */
    protected function appendInArguments( $key, $type )
    {
        if ( !isset($this->sprocInArguments) ) {
            return "IN " . strtoupper($key) . "_VALUE " . $type;
        } else {
            return ", IN " . strtoupper($key) . "_VALUE " . $type;
        }
    }

    /** appendOutArguments
     *
     * @param $key
     * @param $type
     *
     * @return string
     */
    protected function appendOutArguments( $key, $type )
    {
        if ( !isset($this->sprocOutArguments) ) {
            return "OUT " . strtoupper($key) . "_VALUE " . $type;
        } else {
            return ", OUT " . strtoupper($key) . "_VALUE " . $type;
        }
    }

    /** makeUpdatePairsList
     *
     * @return void
     */
    protected function makeUpdatePairsList()
    {
        foreach ( $this->_tableDescription->fieldTypeArray as $currentField => $currentType ) {
            if ( $currentField === $this->_tableDescription->autoIncrementField ) {
            } else {
                if ( is_null($this->_currentTableUpdatePairsList) ) {
                    $this->_currentTableUpdatePairsList = "";
                } else {
                    $this->_currentTableUpdatePairsList .= ", ";
                }
                $this->_currentTableUpdatePairsList .= $this->makeKeyValuePair($currentField);
            }
        }
    }

    /** addInputVariableListItem
     *
     * @param $field
     *
     * @return string
     */
    protected function addInputVariableListItem( $field )
    {
        if ( isset($this->_currentTableInputVariableList) ) {
            return strtoupper(", " . $field . "_VALUE");
        } else {
            return strtoupper($field . "_VALUE");
        }
    }


    /** addInsertListItem
     *
     * @param $field
     *
     * @return string
     */
    protected function addInsertListItem( $field )
    {
        if ( isset($this->_currentTableInsertFieldList) ) {
            return ", `" . $field . "`";
        } else {
            return "`" . $field . "`";
        }
    }


    /** makePrimaryPairList
     *
     * @param $key
     *
     * @return void
     */
    protected function makePrimaryPairList( $key )
    {
        if ( is_null($this->primaryKeyPairList) ) {
        } else {
            $this->primaryKeyPairList .= "AND ";
        }
        $this->primaryKeyPairList .= $this->makeKeyValuePair($key);
    }


    /** makeKeyValuePair
     *
     * @param $key
     *
     * @return string
     */
    protected function makeKeyValuePair( $key )
    {
        return "`" . $key . "` = " . strtoupper($key) . "_VALUE";
    }

    /** makeColumnsCommaList
     *
     * @return void
     */
    protected function makeColumnsCommaList()
    {
        foreach ( $this->_tableDescription->fieldTypeArray as $currentField => $currentType ) {
            if ( is_null($this->_currentTableColumnsCommaList) ) {
                $this->_currentTableColumnsCommaList = "`" . $currentField . "`";
            } else {
                $this->_currentTableColumnsCommaList .= ", `" . $currentField . "`";
            }
        }
    }


    /** foreignKeyCheck
     *
     * @return foreignQuery|string
     */
    protected function foreignKeyCheck()
    {
        if ( count($this->_tableDescription->foreignKeys) > 0 ) {
            foreach ( $this->_tableDescription->foreignKeys as $foreignKeyArray ) {
                $this->foreignQuery .= "\n\t\t AND (SELECT 1 FROM `" . $foreignKeyArray['foreignTable'] . "` WHERE `" . $foreignKeyArray['foreignField'] . "` = " . strtoupper($foreignKeyArray['localField']) . "_VALUE)";
            }
        } else {
            return "";
        }
        return $this->foreignQuery;
    }
}
/*
 * Sproc Generation Test for User table
$sp = sprocGeneratorMySQLi::instance($databaseConnection);
$sp->setTableNames(array("Net_Promoter_Score"));
$sp->execute();
 */
/*
 * Sproc Generation Test for all tables
$sp = sprocGeneratorMySQLi::instance($databaseConnection);
$sp->execute();
*/