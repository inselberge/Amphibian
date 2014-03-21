<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/9/13
 * Time: 7:55 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once AMPHIBIAN_CORE_ABSTRACT_INTERFACES."TableBuilderInterface.php";
/**
 * Interface TableBuilderMySQLiInterface
 *
 * @category TableBuilderMySQLi
 * @package  TableBuilderMySQLiInterface
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/TableBuilderMySQLiInterface
 */
interface TableBuilderMySQLiInterface
    extends TableBuilderInterface
{
    /** instance
     *
     * @param object   $databaseConnection a valid database connection
     * @param resource $resultSet          a result set from a query
     * @param string   $id                 the id of the table
     *
     * @return TableBuilderMySQLi
     */
    static public function instance($databaseConnection = null, $resultSet = null, $id);

    /** factory
     *
     * @param object   $databaseConnection a valid database connection
     * @param resource $resultSet          a result set from a query
     * @param string   $id                 the id of the table
     *
     * @return TableBuilderMySQLi
     */
    static public function factory($databaseConnection = null, $resultSet = null, $id);

    /** execute
     *
     * @return bool
     */
    public function execute();

    /** executeFromPayload
     *
     * @param string $idValue the id of the table
     * @param array  $payload the payload of a DataPackage
     *
     * @return mixed
     */
    static public function executeFromPayload($idValue,array $payload);
}