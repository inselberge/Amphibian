<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Carl "Tex" Morgan
 * Date: 3/22/13
 * Time: 3:14 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
include AMPHIBIAN_CORE_ABSTRACT."databaseConnection.php";
require_once "interfaces".DIRECTORY_SEPARATOR."postgreInterface.php";

/**
 * Class postgre
 *
 * @category ${NAMESPACE}
 * @package  postgre
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated
 * @link     documentation/postgre
 */
class postgre
    extends DatabaseConnection
    implements postgreInterface
{
    /**
     *
     */
    protected function __construct()
    {
    }

    public static function instance()
    {
    }

    /** set
     * @param string $key
     * @param mixed $value
     * @return mixed|void
     */
    public function set( $key, $value )
    {
    }

    /** setSSL
     * @param $keyPath
     * @param $certificatePath
     * @param $authorityPath
     * @param $pemPath
     * @param $cipher
     * @return mixed|void
     */
    public function setSSL( $keyPath, $certificatePath, $authorityPath, $pemPath, $cipher )
    {
        $this->connection->ssl_set($keyPath, $certificatePath, $authorityPath, $pemPath, $cipher);
    }

    public function init()
    {
    }

    /** setOptions
     * @param int $option
     * @param mixed $value
     * @return mixed|void
     */
    public function setOptions($option, $value )
    {
    }

    public function openConnection()
    {
    }

    public function ping()
    {
    }

    public function printError()
    {
        echo $this->error;
    }

    /** setCharacterSet
     * @param $newCharacterSet
     * @return mixed|void
     */
    public function setCharacterSet( $newCharacterSet )
    {
    }

    public function printCharacterSet()
    {
    }

    public function printHostInfo()
    {
    }

    public function closeConnection()
    {
    }
}