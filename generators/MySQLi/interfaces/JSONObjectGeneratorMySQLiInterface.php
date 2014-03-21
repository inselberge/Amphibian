<?php
/**
 * PHP Version: ${PHP_VERSION}
 * Created by PhpStorm.
 * User: carl
 * Date: 1/19/14
 * Time: 10:28 PM
 */
require_once AMPHIBIAN_GENERATORS_ABSTRACT_INTERFACES."JSONObjectGeneratorInterface.php";
/**
 * Class JSONObjectGeneratorMySQLiInterface
 *
 * @category 
 * @package  JSONObjectGeneratorMySQLiInterface
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/JSONObjectGeneratorMySQLiInterface
 */
interface JSONObjectGeneratorMySQLiInterface
    extends JSONObjectGeneratorInterface
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
} 