<?php
/**
 * PHP version 5.5.3
 * Created by JetBrains PhpStorm.
 * User: Carl "Tex" Morgan
 * Date: 3/26/13
 * Time: 3:32 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once AMPHIBIAN_CORE_NEUTRAL."CheckInput.php";
require_once "interfaces".DIRECTORY_SEPARATOR."databaseConnectionFactoryInterface.php";
/**
 * Class DatabaseConnectionFactory
 * 
 * @category Core
 * @package  DatabaseConnection
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/DatabaseConnectionFactory
 */
class DatabaseConnectionFactory
    extends CheckInput
    implements DatabaseConnectionFactoryInterface
{
    /**
     * @var array _supportedDatabases the supported databases
     */
    private static $_supportedDatabases
        = array( "mysqli", "mongo", "postgre", "mssql", "oracle", "sqlite", "sqlite3" );

    /** __construct
     *
     */
    protected function __construct()
    {

    }

    /** connect
     *
     * @param string $datbaseTypeKey the type of database to be used
     *
     * @return bool
     */
    public function connect($datbaseTypeKey)
    {
        try {
            if ( $this->checkNewInput($datbaseTypeKey) ) {
                if ( $this->checkSupported($datbaseTypeKey) ) {
                    return $this->create($datbaseTypeKey);
                } else {
                    throw new ExceptionHandler(__METHOD__.": datbaseTypeKey is not currently supported.");
                }
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** checkSupported
     *
     * @param string $databaseKey the database type to test
     *
     * @return bool
     */
    protected function checkSupported($databaseKey)
    {
        if ( in_array($databaseKey, self::$_supportedDatabases) ) {
            return true;
        } else {
            return false;
        }
    }

    /** create
     *
     * @param string $datbaseTypeKey the type of database to be used
     *
     * @return bool
     */
    protected function create($datbaseTypeKey)
    {
        switch ( $datbaseTypeKey ) {
        case "mysqli":
            return AmphibianMySQLi::instance();
            break;
        case "mongo":
            return AmphibianMongo::instance();
            break;
        case "postgre":
            return AmphibianPostgre::instance();
            break;
        case "mssql":
            return AmphibianMSSQL::instance();
            break;
        default:
            return false;
            break;
        }
    }
}