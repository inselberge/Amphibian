<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/9/13
 * Time: 7:45 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
interface postgreInterface extends DatabaseConnectionInterface {
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
     * @param int $option
     * @param $value
     * @return mixed
     */
    public function setOptions( int $option, $value );
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

}