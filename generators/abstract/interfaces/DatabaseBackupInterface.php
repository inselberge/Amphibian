<?php
/**
 * PHP Version: ${PHP_VERSION}
 * Created by PhpStorm.
 * User: carl
 * Date: 1/16/14
 * Time: 5:14 PM
 */
/**
 * Class DatabaseBackupInterface
 *
 * @category 
 * @package  DatabaseBackupInterface
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/DatabaseBackupInterface
 */
interface DatabaseBackupInterface
{

    /** setCommand
     *
     * @param $command
     *
     * @return mixed
     */
    public function setCommand($command);

    /** getCommand
     *
     * @return mixed
     */
    public function getCommand();

    /** setDatabase
     *
     * @param $database
     *
     * @return mixed
     */
    public function setDatabase($database);

    /** getDatabase
     *
     * @return mixed
     */
    public function getDatabase();

    /** setHost
     *
     * @param $host
     *
     * @return mixed
     */
    public function setHost($host);

    /** getHost
     *
     * @return mixed
     */
    public function getHost();

    /** setOptions
     *
     * @param $options
     *
     * @return mixed
     */
    public function setOptions($options);

    /** getOptions
     *
     * @return mixed
     */
    public function getOptions();

    /** setPassword
     *
     * @param $password
     *
     * @return mixed
     */
    public function setPassword($password);

    /** getPassword
     *
     * @return mixed
     */
    public function getPassword();

    /** setPort
     *
     * @param $port
     *
     * @return mixed
     */
    public function setPort($port);

    /** getPort
     *
     * @return mixed
     */
    public function getPort();

    /** setProtocol
     *
     * @param $protocol
     *
     * @return mixed
     */
    public function setProtocol($protocol);

    /** getProtocol
     *
     * @return mixed
     */
    public function getProtocol();

    /** setSocket
     *
     * @param $socket
     *
     * @return mixed
     */
    public function setSocket($socket);

    /** getSocket
     *
     * @return mixed
     */
    public function getSocket();

    /** setTables
     *
     * @param $tables
     *
     * @return mixed
     */
    public function setTables($tables);

    /** getTables
     *
     * @return mixed
     */
    public function getTables();

    /** setUser
     *
     * @param $user
     *
     * @return mixed
     */
    public function setUser($user);

    /** getUser
     *
     * @return mixed
     */
    public function getUser();

    /** execute
     *
     * @return mixed
     */
    public function execute();
} 