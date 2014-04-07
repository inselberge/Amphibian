<?php
/**
 * PHP Version: ${PHP_VERSION}
 * Created by PhpStorm.
 * User: carl
 * Date: 1/13/14
 * Time: 1:50 PM
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once "interfaces".DIRECTORY_SEPARATOR."PreloaderGeneratorMySQLiInterface.php";
require_once AMPHIBIAN_GENERATORS_ABSTRACT."PreloaderGenerator.php";
/**
 * Class PreloaderGeneratorMySQLi
 *
 * @category 
 * @package  PreloaderGeneratorMySQLi
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
* @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/
 */
class PreloaderGeneratorMySQLi
    extends PreloaderGenerator
    implements PreloaderGeneratorMySQLiInterface
{
    /**
     * @var object PreloaderGeneratorMySQLi a singleton instance of this class
     */
    static public $PreloaderGeneratorMySQLi;
    
    /** __construct
     *
     * @param object $databaseConnection a valid database connection
     */
    protected function __construct($databaseConnection)
    {
        try {
            if (CheckInput::checkSet($databaseConnection)) {
                parent::__construct($databaseConnection);
                if ( defined('PRELOADERS') ) {
                    $this->setFileDestination(PRELOADERS);
                } else {
                    throw new ExceptionHandler(__METHOD__ . ": PRELOADERS invalid.");
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
     * @return PreloaderGeneratorMySQLi
     */
    static public function instance($databaseConnection)
    {
        if ( !isset(self::$PreloaderGeneratorMySQLi) ) {
            self::$PreloaderGeneratorMySQLi = new PreloaderGeneratorMySQLi($databaseConnection);
        }
        return self::$PreloaderGeneratorMySQLi;
    }
     
    /** factory
     *
     * @param object $databaseConnection a valid database connection
     *
     * @return PreloaderGeneratorMySQLi
     */
    static public function factory($databaseConnection)
    {
        return new PreloaderGeneratorMySQLi($databaseConnection);
    }
}