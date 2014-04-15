<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Carl "Tex" Morgan
 * Date: 5/4/13
 * Time: 2:46 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."config.inc.php";
//require_once AMPHIBIAN_CONFIG . "Coworks.In.config.inc.php";
//require_once AMPHIBIAN_CONFIG . "InnerAlly.config.inc.php";
//require_once MYSQL; todo: replace these with correct databaseConnectionMySQLi calls
require_once AMPHIBIAN_CORE_MYSQLI . "TableDescriptionMySQLi.php";
require_once AMPHIBIAN_CORE_NEUTRAL . "FileHandle.php";
require_once AMPHIBIAN_CORE_MYSQLI . "databaseQueryMySQLi.php";
require_once AMPHIBIAN_GENERATORS_ABSTRACT."databaseViewGenerator.php";
require_once "interfaces".DIRECTORY_SEPARATOR."databaseViewGeneratorMySQLiInterface.php";
/**
 * Class DatabaseViewGeneratorMySQLi
 *
 * @category
 * @package  DatabaseViewGeneratorMySQLi
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/DatabaseViewGeneratorMySQLi
 */
class DatabaseViewGeneratorMySQLi
    extends DatabaseViewGenerator
    implements DatabaseViewGeneratorMySQLiInterface
{
    /**
     * @var object databaseViewGeneratorMySQLi
     */
    static public $databaseViewGeneratorMySQLi;

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

    /** __construct
     *
     */
    protected function __construct()
    {
    }

    /** instance
     *
     * @param $databaseConnection
     *
     * @return bool|databaseViewGeneratorMySQLi
     */
    static public function instance( $databaseConnection )
    {
        try {
            if ( isset($databaseConnection) & !is_null($databaseConnection) ) {
                if ( !isset(self::$databaseViewGeneratorMySQLi) ) {
                    self::$databaseViewGeneratorMySQLi                = new DatabaseViewGeneratorMySQLi();
                    self::$databaseViewGeneratorMySQLi->connection    = $databaseConnection;
                    self::$databaseViewGeneratorMySQLi->databaseQuery = DatabaseQueryMySQLi::instance($databaseConnection);
                }
                return self::$databaseViewGeneratorMySQLi;
            } else {
                throw new ExceptionHandler("Tne database connection must be set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** setTableNames
     *
     * @param array $array an array of valid table names
     *
     * @return bool
     */
    public function setTableNames( $array )
    {
        try {
            if ( CheckInput::checkNewInputArray($array) ) {
                $this->tableNames = $array;
            } else {
                throw new ExceptionHandler("Tne table list array must be set.");
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
            if ( !isset($this->tableList) ) {
                $this->tableNames = $this->connection->getTables();
            }
            foreach ( $this->tableNames as $this->currentTable ) {
                $this->iterate();
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** iterate
     *
     * @return void
     */
    protected function iterate()
    {
        $this->initializeFileHandle();
        $this->buildQuery();
        $this->writeView();
        $this->setForNext();
        //$this->loadView();
    }

    /** initializeFileHandle
     *
     * @return void
     */
    protected function initializeFileHandle()
    {
        $this->FileHandle = new FileHandle("/" . DATABASE_VIEWS . ucwords($this->currentTable) . ".sql");
    }

    /** buildQuery
     *
     * @return void
     */
    protected function buildQuery()
    {
        $this->query = null;
        $this->changeDelimiter('$$');
        $this->dropPreviousView();
        $this->getTableDescription();
        $this->getRequiredColumns();
        $this->buildView();
        $this->changeDelimiter(';');
    }

    /** changeDelimiter
     *
     * @param string $delim a new delimiter
     *
     * @return bool
     */
    protected function changeDelimiter( $delim )
    {
        try {
            if ( CheckInput::checkNewInput($delim) ) {
                $this->delimiter = $delim;
                $this->query .= 'DELIMITER ' . $this->delimiter . "\n";
            } else {
                throw new ExceptionHandler("Tne delimiter must be set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** dropPreviousView
     *
     * @return bool
     */
    protected function dropPreviousView()
    {
        try {
            if ( CheckInput::checkNewInput($this->currentTable) ) {
                $this->query .= 'DROP VIEW IF EXISTS `' . DB_NAME . '`.`view' . ucwords($this->currentTable) . '`' . $this->delimiter . "\n";
            } else {
                throw new ExceptionHandler("Tne current table must be set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getTableDescription
     *
     * @return void
     */
    protected function getTableDescription()
    {
        $this->tableDescription = TableDescription::instance($this->connection);
        $this->tableDescription->setTableName($this->currentTable);
        $this->tableDescription->execute();
    }

    /** getRequiredColumns
     *
     * @return bool
     */
    protected function getRequiredColumns()
    {
        try {
            if ( CheckInput::checkNewInput($this->tableDescription->notNullArray) ) {
                foreach ( $this->tableDescription->notNullArray as $key => $value ) {
                    if ( $this->requiredColumns == null ) {
                        $this->requiredColumns = "`" . $key . "`";
                    } else {
                        $this->requiredColumns .= ", `" . $key . "`";
                    }
                }
            } else {
                throw new ExceptionHandler("Tne not null array from table description must be set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** buildView
     *
     * @return bool
     */
    protected function buildView()
    {
        try {
            if ( CheckInput::checkNewInput($this->requiredColumns) ) {
                $this->query .= 'CREATE VIEW `view' . ucwords($this->currentTable) . '`';
                $this->query .= ' AS SELECT ' . $this->requiredColumns;
                $this->query .= ' FROM `' . $this->currentTable . '`';
                $this->query .= $this->delimiter . "\n";
            } else {
                throw new ExceptionHandler("Tne required columns must be set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** writeView
     *
     * @return void
     */
    protected function writeView()
    {
        $this->FileHandle->writeFull($this->query);
    }

    /** loadView
     *
     * @return void
     */
    protected function loadView()
    {
        //$this->query=str_replace("\n",' ',$this->query);
        $this->databaseQuery->execute($this->query);
    }

    /** setForNext
     *
     * @return void
     */
    protected function setForNext()
    {
        $this->requiredColumns = null;
    }
}

/*
 * View Generation Test for User table
$vg = databaseViewGeneratorMySQLi::instance($databaseConnection);
$vg->setTableNames(array("Users"));
$vg->execute();
*/
/*
 * View Generation Test for all tables
$vg = databaseViewGeneratorMySQLi::instance($databaseConnection);
$vg->execute();
*/