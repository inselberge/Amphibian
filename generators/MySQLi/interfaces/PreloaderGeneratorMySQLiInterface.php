<?php
/**
 * PHP Version: ${PHP_VERSION}
 * Created by PhpStorm.
 * User: carl
 * Date: 1/13/14
 * Time: 1:50 PM
 */
require_once AMPHIBIAN_GENERATORS_ABSTRACT_INTERFACES."PreloaderGeneratorInterface.php";
/**
 * Class PreloaderGeneratorMySQLiInterface
 *
 * @category 
 * @package  PreloaderGeneratorMySQLiInterface
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/PreloaderGeneratorMySQLiInterface
 */
interface PreloaderGeneratorMySQLiInterface
    extends PreloaderGeneratorInterface
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