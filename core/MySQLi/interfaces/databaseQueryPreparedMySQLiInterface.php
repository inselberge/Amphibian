<?php
/**
 * PHP Version: ${PHP_VERSION}
 * Created by PhpStorm.
 * User: carl
 * Date: 12/19/13
 * Time: 2:35 PM
 */
require_once AMPHIBIAN_CORE_ABSTRACT_INTERFACES."databaseQueryPreparedInterface.php";
/**
 * Class DatabaseQueryPreparedMySQLiInterface
 *
 * @category MySQLi
 * @package  DatabaseQueryPreparedMySQLiInterface
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
* @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/
 */
interface DatabaseQueryPreparedMySQLiInterface
    extends DatabaseQueryPreparedInterface
{
    /** instance
     * @param $databaseConnection
     * @return mixed
     */
    static public function instance($databaseConnection);

    /** factory
     * @param $databaseConnection
     * @return mixed
     */
    static public function factory($databaseConnection);
    public function init();

    /** prepare
     * @param $query
     * @return mixed
     */
    public function prepare($query);

    /** bind
     * @param array $typesVariables
     * @return mixed
     */
    public function bind(array $typesVariables);
    public function execute();

    /** bindResult
     * @param array $variables
     * @return mixed
     */
    public function bindResult(array $variables);
    public function freeResult();
    public function getResult();
    public function storeResult();

    /** seek
     * @param $offset
     * @return mixed
     */
    public function seek($offset);

    /** getAttribute
     * @param $attribute
     * @return mixed
     */
    public function getAttribute($attribute);

    /** setAttribute
     * @param $attribute
     * @param $mode
     * @return mixed
     */
    public function setAttribute($attribute, $mode);
    public function fetch();
    public function getWarnings();
    public function more();
    public function next();
    public function resultMetadata();

    /** sendLongData
     * @param $parameterNumber
     * @param $data
     * @return mixed
     */
    public function sendLongData($parameterNumber, $data);
    public function reset();
    public function close();
} 