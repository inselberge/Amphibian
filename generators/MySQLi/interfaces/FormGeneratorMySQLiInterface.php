<?php
/**
 * PHP Version: ${PHP_VERSION}
 * Created by PhpStorm.
 * User: carl
 * Date: 1/20/14
 * Time: 12:24 AM
 */
require_once AMPHIBIAN_GENERATORS_ABSTRACT_INTERFACES."FormGeneratorInterface.php";
/**
 * Class FormGeneratorMySQLiInterface
 *
 * @category 
 * @package  FormGeneratorMySQLiInterface
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/FormGeneratorMySQLiInterface
 */
interface FormGeneratorMySQLiInterface
    extends FormGeneratorInterface
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