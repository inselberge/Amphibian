<?php
/**
 * PHP Version 5.5.3-1ubuntu2
 * Created by PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 12/15/13
 * Time: 6:40 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once "interfaces".DIRECTORY_SEPARATOR."AgencyGeneratorMySQLiInterface.php";
require_once AMPHIBIAN_GENERATORS_ABSTRACT."agencyGenerator.php";
require_once AMPHIBIAN_CORE_MYSQLI . "databaseConnectionMySQLi.php";
/**
 * Class AgencyGeneratorMySQLi
 *
 * @category AgencyGenerator
 * @package  AgencyGeneratorMySQLi  
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/Amphibian/documentation/AgencyGeneratorMySQLi
 */
class AgencyGeneratorMySQLi
    extends AgencyGenerator
    implements AgencyGeneratorMySQLiInterface
{
    /**
     * @var object AgencyGeneratorMySQLi a singleton instances of this class
     */
    static public $AgencyGeneratorMySQLi;
    
    /** __construct
     *
     * @param object $databaseConnection a database connection
     */
    protected function __construct($databaseConnection)
    {
        try {
            if (CheckInput::checkSet($databaseConnection)) {
                parent::__construct($databaseConnection);
                if ( defined('AGENCIES_GENERATED') ) {
                    $this->setFileDestination(AGENCIES_GENERATED);
                } else {
                    throw new ExceptionHandler(__METHOD__ . ": undefined location.");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": database connection invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }
    
    /** instance
     *
     * @param object $databaseConnection a valid database connection
     *
     * @return AgencyGeneratorMySQLi
     */    
    static public function instance($databaseConnection)
    {
        if ( !isset(self::$AgencyGeneratorMySQLi) ) {
            self::$AgencyGeneratorMySQLi = new AgencyGeneratorMySQLi($databaseConnection);
        }
        return self::$AgencyGeneratorMySQLi;
    }
    
    /** factory
     *
     * @param object $databaseConnection a valid database connection
     *
     * @return AgencyGeneratorMySQLi
     */    
    static public function factory($databaseConnection)
    {
        return new AgencyGeneratorMySQLi($databaseConnection);
    }

    /** iterate
     *
     * @return bool
     */
    protected function iterate()
    {
        $this->addPHPTag();
        $this->addClassComment();
        $this->addClassStart();
        $this->addAcceptableVars();
        $this->addStaticVariable();
        $this->addStaticInstance();
        $this->addForkQuery();
        $this->addClassEnd();
    }

    /** fetchAll
     *
     * @return boolean
     */
    protected function fetchAll()
    {
        try {
            if (CheckInput::checkNewInput($this->connection)) {
                $this->tableArray = $this->connection->getViews();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": Connection is dead.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** addForkQuery
     *
     * @return void
     */
    protected function addForkQuery()
    {
        $this->buffer.='    protected function forkQuery()'."\n";
        $this->buffer.='    {'."\n";
        $this->buffer.='        if($this->checkQueryStringAddendum()){'."\n";
        $this->buffer.='            return $this->query->execute("SELECT * FROM '.$this->tableName.' ".$this->queryStringAddendum);'."\n";
        $this->buffer.='        } else {'."\n";
        $this->buffer.='            return $this->query->execute("SELECT * FROM '.$this->tableName.'");'."\n";
        $this->buffer.='        }'."\n";
        $this->buffer.='    }'."\n\n";
    }

    /** setTableColumns
     *
     * @return bool
     */
    protected function setTableColumns()
    {
        try {
            $this->tableColumns = $this->connection->getColumnList($this->tableName);
            if ( !CheckInput::checkSetArray($this->tableColumns) ) {
                throw new ExceptionHandler(__METHOD__ . ": unable to set columns on $this->tableName.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }
}
/*
require_once AMPHIBIAN_CORE_MYSQLI . "databaseConnectionMySQLi.php";
$databaseConnection = databaseConnectionMySQLi::instance();
$databaseConnection->setServerName("localhost");
$databaseConnection->setDatabaseName("InnerAlly");
$databaseConnection->setUserName("root");
$databaseConnection->setUserPassword('4u$t1nTX');
$databaseConnection->openConnection();
$agencyGen = AgencyGeneratorMySQLi::instance($databaseConnection);
$agencyGen->setFileDestination("/home/carl/Public/InnerAlly_SC/agencies/generated/");
$agencyGen->execute();
*/