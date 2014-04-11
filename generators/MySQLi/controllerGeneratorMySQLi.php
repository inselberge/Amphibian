<?php
/**
 * PHP Version 5.5.3
 *
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 1/17/14
 * Time: 6:55 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."config.inc.php";
require_once AMPHIBIAN_GENERATORS_ABSTRACT."ControllerGenerator.php";
require_once AMPHIBIAN_CORE_MYSQLI. "TableDescriptionMySQLi.php";
require_once "interfaces".DIRECTORY_SEPARATOR."controllerGeneratorMySQLiInterface.php";
/**
 * Class ControllerGenerator
 *
 * @category Core
 * @package  Controller
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/ControllerGenerator
 */
class ControllerGeneratorMySQLi
    extends ControllerGenerator
    implements ControllerGeneratorMySQLiInterface
{
    /**
     * @var object controllerGenerator a singleton instance of this class
     */
    static public $controllerGeneratorMySQLi;

    /** instance
     *
     * @param resource $databaseConnection a database connection
     *
     * @return object
     */
    static public function instance($databaseConnection)
    {
        if ( !isset(self::$controllerGeneratorMySQLi) ) {
            self::$controllerGeneratorMySQLi = new ControllerGeneratorMySQLi($databaseConnection);
        }
        return self::$controllerGeneratorMySQLi;
    }

    /** instance
     *
     * @param resource $databaseConnection a database connection
     *
     * @return object
     */
    static public function factory($databaseConnection)
    {
        return new ControllerGeneratorMySQLi($databaseConnection);
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
                throw new ExceptionHandler(__METHOD__ . ": connection invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getTableDescription
     *
     * @return bool
     */
    protected function getTableDescription()
    {
        try {
            $this->tableDescription = TableDescriptionMySQLi::instance($this->connection);
            $this->tableDescription->setTableName($this->tableName);
            if ( !$this->tableDescription->execute() ) {
                throw new ExceptionHandler(__METHOD__ . ": getTableDescription failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }
}
/* Coworks.In
require_once AMPHIBIAN_CONFIG ."Coworks.In.config.inc.php";
require_once AMPHIBIAN_CONFIG . "mysql.cfg.php";
$controlGen = new controllerGenerator($databaseConnection);
$controlGen->execute();
*/

/* InnerAlly
require_once AMPHIBIAN_CONFIG ."InnerAlly.config.inc.php";
require_once AMPHIBIAN_CONFIG . "mysql.cfg.php";*/
require_once "/home/texmorgan/Public/InnerAlly_SC/config/staging/InnerAlly.config.inc.php";
require_once AMPHIBIAN_CORE_MYSQLI . "databaseConnectionMySQLi.php";
$databaseConnection = databaseConnectionMySQLi::instance();
$databaseConnection->setServerName("localhost");
$databaseConnection->setDatabaseName("InnerAlly");
$databaseConnection->setUserName("root");
$databaseConnection->setUserPassword('4u$t1nTX');
$databaseConnection->openConnection();
$controlGen = ControllerGeneratorMySQLi::instance($databaseConnection->getConnection());
$controlGen->setFileDestination("/home/texmorgan/Public/InnerAlly_SC/controllers/generated/");
$controlGen->execute();
