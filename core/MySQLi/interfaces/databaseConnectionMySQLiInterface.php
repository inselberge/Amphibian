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
     *
     * @param $key
     * @param $value
     *
     * @return mixed
     */
    public function set( $key, $value );

    /** setSSL
     *
     * @param $keyPath
     * @param $certificatePath
     * @param $authorityPath
     * @param $pemPath
     * @param $cipher
     *
     * @return mixed
     */
    public function setSSL( $keyPath, $certificatePath, $authorityPath, $pemPath, $cipher );

    /** init
     *
     * @return mixed
     */
    public function init();

    /** setOptions
     *
     * @param $option
     * @param $value
     *
     * @return mixed
     */
    public function setOptions( $option, $value );

    /** openConnection
     *
     * @return mixed
     */
    public function openConnection();

    /** openConnectionSSL
     *
     * @return bool
     */
    public function openConnectionSSL();

    /** ping
     *
     * @return mixed
     */
    public function ping();

    /** printError
     *
     * @return mixed
     */
    public function printError();

    /** setCharacterSet
     *
     * @param $newCharacterSet
     *
     * @return mixed
     */
    public function setCharacterSet( $newCharacterSet );

    /** printCharacterSet
     *
     * @return mixed
     */
    public function printCharacterSet();

    /** printHostInfo
     *
     * @return mixed
     */
    public function printHostInfo();

    /** closeConnection
     *
     * @return mixed
     */
    public function closeConnection();

    /** getTables
     *
     * @return mixed
     */
    public function getTables();

    /** getPrimaryKeys
     *
     * @return mixed
     */
    public function getPrimaryKeys();

    /** getViews
     *
     * @return mixed
     */
    public function getViews();

    /** describeTable
     *
     * @param $table
     *
     * @return mixed
     */
    public function describeTable($table);

    /** showKeysTable
     *
     * @param $table
     *
     * @return mixed
     */
    public function showKeysTable($table);

    /** getPrimaryKeysTable
     *
     * @param $table
     *
     * @return mixed
     */
    public function getPrimaryKeysTable($table);

    /** getForeignKeysTable
     *
     * @param $table
     *
     * @return mixed
     */
    public function getForeignKeysTable($table);

    /** getRequiredColumnsList
     *
     * @param $tableDescription
     *
     * @return mixed
     */
    public function getRequiredColumnsList($tableDescription);

    /** getColumnList
     *
     * @param $table
     *
     * @return mixed
     */
    public function getColumnList($table);

    /** getAllColumnTypes
     *
     * @return mixed
     */
    public function getAllColumnTypes();
}