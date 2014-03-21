<?php
/**
 * PHP Version: ${PHP_VERSION}
 * Created by PhpStorm.
 * User: carl
 * Date: 1/19/14
 * Time: 10:16 PM
 */
require_once "interfaces".DIRECTORY_SEPARATOR."JSONObjectGeneratorMySQLiInterface.php";
require_once AMPHIBIAN_GENERATORS_ABSTRACT."JSONObjectGenerator.php";
require_once AMPHIBIAN_CORE_MYSQLI."TableDescriptionMySQLi.php";
/**
 * Class JSONObjectGeneratorMySQLi
 *
 * @category 
 * @package  JSONObjectGeneratorMySQLi
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
* @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/
 */
class JSONObjectGeneratorMySQLi
    extends JSONObjectGenerator
    implements JSONObjectGeneratorMySQLiInterface
{
    /**
     * @var object JSONObjectGeneratorMySQLi a singleton instance of this class
     */
    static public $JSONObjectGeneratorMySQLi;
    
    /** __construct
     *
     * @param object $databaseConnection a valid database connection
    */
    protected function __construct($databaseConnection)
    {
        $this->fileExtension = ".json";
        return parent::__construct($databaseConnection);
    }
    
    /** instance
     *
     * @param object $databaseConnection a valid database connection
     *
     * @return JSONObjectGeneratorMySQLi
     */
    static public function instance($databaseConnection)
    {
        if ( !isset(self::$JSONObjectGeneratorMySQLi) ) {
            self::$JSONObjectGeneratorMySQLi = new JSONObjectGeneratorMySQLi($databaseConnection);
        }
        return self::$JSONObjectGeneratorMySQLi;
    }
     
    /** factory
     *
     * @param object $databaseConnection a valid database connection
     *
     * @return JSONObjectGeneratorMySQLi
     */
    static public function factory($databaseConnection)
    {
        return new JSONObjectGeneratorMySQLi($databaseConnection);
    }

    /** fetchAllViews
     *
     * @return bool
     */
    protected function fetchAllViews()
    {

    }

    /** fetchAllTables
     *
     * @return bool
     */
    protected function fetchAllTables()
    {

    }

    /** setupTableDescription
     *
     * @return bool
     */
    protected function setupTableDescription()
    {
        try {
            if (CheckInput::checkSet($this->tableName)) {
                $this->tableDescription = TableDescriptionMySQLi::instance($this->connection);
                $this->tableDescription->setTableName($this->tableName);
                $this->tableDescription->execute();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": tableName invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        } finally {

        }
        return true;
    }
}