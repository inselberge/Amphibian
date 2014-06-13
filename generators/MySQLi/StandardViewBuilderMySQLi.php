<?php
/**
 * PHP Version: ${PHP_VERSION}
 * Created by PhpStorm.
 * User: carl
 * Date: 1/20/14
 * Time: 1:35 PM
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once AMPHIBIAN_GENERATORS_ABSTRACT."standardViewBuilder.php";
require_once "interfaces".DIRECTORY_SEPARATOR."StandardViewBuilderMySQLiInterface.php";
/**
 * Class StandardViewBuilderMySQLi
 *
 * @category StandardViewBuilder
 * @package  StandardViewBuilderMySQLi
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
* @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/
 */
class StandardViewBuilderMySQLi
    extends StandardViewBuilder
    implements StandardViewBuilderMySQLiInterface
{
    /**
     * @var object StandardViewBuilderMySQLi a singleton instance of this class
     */
    static public $StandardViewBuilderMySQLi;

    /** __construct
     *
     * @param object $databaseConnection a valid database connection
     */
    protected function __construct($databaseConnection)
    {
        $this->setFileDestination(DATABASE_VIEWS);
        parent::__construct($databaseConnection);
    }

    /** instance
     *
     * @param object $databaseConnection a valid database connection
     *
     * @return StandardViewBuilderMySQLi
     */
    static public function instance($databaseConnection)
    {
        if ( !isset(self::$StandardViewBuilderMySQLi) ) {
            self::$StandardViewBuilderMySQLi = new StandardViewBuilderMySQLi($databaseConnection);
        }
        return self::$StandardViewBuilderMySQLi;
    }

    /** factory
     *
     * @param object $databaseConnection a valid database connection
     *
     * @return StandardViewBuilderMySQLi
     */
    static public function factory($databaseConnection)
    {
        return new StandardViewBuilderMySQLi($databaseConnection);
    }

    /** setupRequiredColumnList
     *
     * @return bool
     */
    protected function setupRequiredColumnList()
    {
        try {
            if (CheckInput::checkSetArray($this->tableDescription->notNullArray)) {
                $this->requiredColumnList = "`" . implode("`,`", $this->tableDescription->notNullArray) . "`";
            } else {
                throw new ExceptionHandler(__METHOD__ . ":not null array invalid.");
            }
        } catch (ExceptionHandler $e) {
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
            if (CheckInput::checkSet($this->tableDescription)) {
                $this->buffer = "DELIMITER $$" . PHP_EOL;
                $this->buffer .= "DROP VIEW IF EXISTS `" . DB_NAME . "`.`view" . ucwords($this->tableName) . "`$$" . PHP_EOL;
                $this->buffer .= "CREATE VIEW `view";
                $this->buffer .= ucwords($this->tableName);
                $this->buffer .= "` AS SELECT " . $this->requiredColumnList;
                $this->buffer .= " FROM `" . $this->tableName . "`$$" . PHP_EOL;
                $this->buffer .= "DELIMITER ;\n" . PHP_EOL;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": TableDescription invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** fetchAll
     *
     * @return bool
     */
    protected function fetchAll()
    {

    }
} 