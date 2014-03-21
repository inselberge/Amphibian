<?php
/**
 * PHP Version: ${PHP_VERSION}
 * Created by PhpStorm.
 * User: carl
 * Date: 1/16/14
 * Time: 5:18 PM
 */
/**
 * Class DatabaseBackupMySQLiInterface
 *
 * @category 
 * @package  DatabaseBackupMySQLiInterface
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/DatabaseBackupMySQLiInterface
 */
interface DatabaseBackupMySQLiInterface
{
    static public function instance();
    static public function factory();
} 