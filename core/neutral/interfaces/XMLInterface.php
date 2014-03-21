<?php
/**
 * PHP version 5.4.17
 * Created by JetBrains PhpStorm.
 * User: carl
 * Date: 8/6/13
 * Time: 11:41 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated
 */
interface XMLInterface {
    static public function instance();

    /** setReadOrWrite
     * @param $readOrWrite
     * @return mixed
     */
    public function setReadOrWrite( $readOrWrite );
    public function getReadOrWrite();

    /** setFileHandle
     * @param $FileHandle
     * @return mixed
     */
    public function setFileHandle( $FileHandle );
    public function getFileHandle();

    /** setCharset
     * @param $charset
     * @return mixed
     */
    public function setCharset( $charset );
    public function getCharset();

    /** setDataArray
     * @param $dataArray
     * @return mixed
     */
    public function setDataArray( $dataArray );
    public function getDataArray();

    /** setTableColumns
     * @param $tableColumns
     * @return mixed
     */
    public function setTableColumns( $tableColumns );

    /** setTableName
     * @param $tableName
     * @return mixed
     */
    public function setTableName( $tableName );
    public function getBuffer();

    /** setVersion
     * @param $version
     * @return mixed
     */
    public function setVersion( $version );
    public function getVersion();
    public function execute();

    /** write
     * @param $data
     * @return mixed
     */
    public function write($data);
    public function read();
    public function printXML();

    /** check
     * @param $key
     * @return mixed
     */
    public function check($key);
    public function show();

}