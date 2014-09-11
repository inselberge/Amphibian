<?php
/**
 * PHP Version: 
 * Created by PhpStorm.
 * User: texmorgan
 * Date: 9/11/14
 * Time: 3:58 AM
 */
require_once AMPHIBIAN_CORE_ABSTRACT."databaseConnection.php";
require_once "interfaces/DatabaseConnectionSQLite3Interface.php";
/**
 * Class DatabaseConnectionSQLite3
 *
 * @category ${NAMESPACE}
 * @package  DatabaseConnectionSQLite3
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  GPL v3
 * @link     /documentation/${NAMESPACE}/DatabaseConnectionSQLite3
 */
 class DatabaseConnectionSQLite3
    extends DatabaseConnection
    implements DatabaseConnectionSQLite3Interface 
{

     static public $acceptableFetchTypes = array(SQLITE3_ASSOC, SQLITE3_BOTH, SQLITE3_NUM);
     static public $acceptableDataTypes = array(SQLITE3_BLOB, SQLITE3_FLOAT, SQLITE3_INTEGER, SQLITE3_NULL, SQLITE3_TEXT);
     static public $acceptableOpenOptions = array(SQLITE3_OPEN_CREATE, SQLITE3_OPEN_READONLY, SQLITE3_OPEN_READWRITE);
    /**
     * @var object DatabaseConnectionSQLite3 a singleton instance of this class
     */
    static public $DatabaseConnectionSQLite3;
    
    /** __construct
    */
    protected function __construct()
    {
    
    }
    
    /** instance
     *
     * @return DatabaseConnectionSQLite3
     */
    static public function instance()
    {
        if ( !isset(self::$DatabaseConnectionSQLite3) ) {
            self::$DatabaseConnectionSQLite3 = new DatabaseConnectionSQLite3();   
        }
        return self::$DatabaseConnectionSQLite3;
    }
     
    /** factory
     * 
     * @return DatabaseConnectionSQLite3
     */
    static public function factory()
    {
        return new DatabaseConnectionSQLite3();
    }

     /** set
      *
      * @param string $key the index
      * @param mixed $value the value of the key
      *
      * @return mixed
      */
     public function set($key, $value)
     {

     }

     /** setOptions
      *
      * @param integer $option the option to use
      * @param mixed $value the value to set the option
      *
      * @return mixed
      */
     public function setOptions($option, $value)
     {

     }

     /** openConnection
      *
      * @return mixed
      */
     public function openConnection()
     {

     }

     /** printHostInfo
      *
      * @return mixed
      */
     public function printHostInfo()
     {

     }

     /** closeConnection
      *
      * @return mixed
      */
     public function closeConnection()
     {
         return $this->connection->close();
     }

     /** getTables
      *
      * @return mixed
      */
     public function getTables()
     {

     }

     /** getPrimaryKeys
      *
      * @return mixed
      */
     public function getPrimaryKeys()
     {

     }

     /** getViews
      *
      * @return mixed
      */
     public function getViews()
     {

     }

     /** describeTable
      *
      * @param $table
      *
      * @return mixed
      */
     public function describeTable($table)
     {

     }

     /** showKeysTable
      *
      * @param $table
      *
      * @return mixed
      */
     public function showKeysTable($table)
     {

     }

     /** getPrimaryKeysTable
      *
      * @param $table
      *
      * @return mixed
      */
     public function getPrimaryKeysTable($table)
     {

     }

     /** getForeignKeysTable
      *
      * @param $table
      *
      * @return mixed
      */
     public function getForeignKeysTable($table)
     {

     }

     /** getRequiredColumnsList
      *
      * @param $tableDescription
      *
      * @return mixed
      */
     public function getRequiredColumnsList($tableDescription)
     {

     }

     /** getColumnList
      *
      * @param $table
      *
      * @return mixed
      */
     public function getColumnList($table)
     {

     }

     /** getAllColumnTypes
      *
      * @return mixed
      */
     public function getAllColumnTypes()
     {

     }
} 