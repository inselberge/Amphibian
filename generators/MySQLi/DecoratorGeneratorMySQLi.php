<?php
/**
 * PHP Version: ${PHP_VERSION}
 * Created by PhpStorm.
 * User: carl
 * Date: 1/19/14
 * Time: 10:00 PM
 */
require_once "interfaces".DIRECTORY_SEPARATOR."DecoratorGeneratorMySQLiInterface.php";
require_once AMPHIBIAN_GENERATORS_ABSTRACT."DecoratorGenerator.php";
/**
 * Class DecoratorGeneratorMySQLi
 *
 * @category 
 * @package  DecoratorGeneratorMySQLi
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
* @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/
 */
class DecoratorGeneratorMySQLi
    extends DecoratorGenerator
    implements DecoratorGeneratorMySQLiInterface
{
    /**
     * @var object DecoratorGeneratorMySQLi a singleton instance of this class
     */
    static public $DecoratorGeneratorMySQLi;
    
    /** __construct
     *
     * @param object $databaseConnection a valid database connection
    */
    protected function __construct($databaseConnection)
    {
            parent::__construct($databaseConnection);
    }
    
    /** instance
     *
     * @param object $databaseConnection a valid database connection
     *
     * @return DecoratorGeneratorMySQLi
     */
    static public function instance($databaseConnection)
    {
        if ( !isset(self::$DecoratorGeneratorMySQLi) ) {
            self::$DecoratorGeneratorMySQLi = new DecoratorGeneratorMySQLi($databaseConnection);
        }
        return self::$DecoratorGeneratorMySQLi;
    }
     
    /** factory
     *
     * @param object $databaseConnection a valid database connection
     *
     * @return DecoratorGeneratorMySQLi
     */
    static public function factory($databaseConnection)
    {
        return new DecoratorGeneratorMySQLi($databaseConnection);
    }

     /** fetchAllTables
      *
      * @return bool
      */
    protected function fetchAllTables()
    {
        try {
            if (CheckInput::checkSet($this->connection)) {

            } else {
                throw new ExceptionHandler(__METHOD__ . ": connection invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

     /** fetchAllViews
      *
      * @return bool
      */
    protected function fetchAllViews()
    {
        try {
            if (CheckInput::checkSet($this->connection)) {

            } else {
                throw new ExceptionHandler(__METHOD__ . ": connection invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }
}