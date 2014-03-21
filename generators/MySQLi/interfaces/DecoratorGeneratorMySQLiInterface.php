<?php
/**
 * PHP Version: ${PHP_VERSION}
 * Created by PhpStorm.
 * User: carl
 * Date: 1/19/14
 * Time: 10:01 PM
 */
require_once AMPHIBIAN_GENERATORS_ABSTRACT_INTERFACES."DecoratorGeneratorInterface.php";
/**
 * Class DecoratorGeneratorMySQLiInterface
 *
 * @category 
 * @package  DecoratorGeneratorMySQLiInterface
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/DecoratorGeneratorMySQLiInterface
 */
interface DecoratorGeneratorMySQLiInterface
    extends DecoratorGeneratorInterface
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