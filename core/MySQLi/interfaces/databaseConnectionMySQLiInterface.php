<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/9/13
 * Time: 7:49 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
interface DatabaseConnectionMySQLiInterface
    extends DatabaseConnectionInterface
{
    /** set
     * @param $key
     * @param $value
     * @return mixed
     */
    public function set( $key, $value );

    /** setSSL
     * @param $keyPath
     * @param $certificatePath
     * @param $authorityPath
     * @param $pemPath
     * @param $cipher
     * @return mixed
     */
    public function setSSL( $keyPath, $certificatePath, $authorityPath, $pemPath, $cipher );
    public function init();

    /** setOptions
     * @param $option
     * @param $value
     * @return mixed
     */
    public function setOptions( $option, $value );
    public function openConnection();
    public function ping();
    public function printError();

    /** setCharacterSet
     * @param $newCharacterSet
     * @return mixed
     */
    public function setCharacterSet( $newCharacterSet );
    public function printCharacterSet();
    public function printHostInfo();
    public function closeConnection();
    public function getTables();
    public function getPrimaryKeys();
    public function getViews();

    /** describeTable
     * @param $table
     * @return mixed
     */
    public function describeTable($table);

    /** showKeysTable
     * @param $table
     * @return mixed
     */
    public function showKeysTable($table);

    /** getPrimaryKeysTable
     * @param $table
     * @return mixed
     */
    public function getPrimaryKeysTable($table);

    /** getForeignKeysTable
     * @param $table
     * @return mixed
     */
    public function getForeignKeysTable($table);

    /** getRequiredColumnsList
     * @param $tableDescription
     * @return mixed
     */
    public function getRequiredColumnsList($tableDescription);

    /** getColumnList
     * @param $table
     * @return mixed
     */
    public function getColumnList($table);
    public function getAllColumnTypes();
}