<?php
/**
 * PHP Version: ${PHP_VERSION}
 * Created by PhpStorm.
 * User: carl
 * Date: 1/20/14
 * Time: 1:36 PM
 */
require_once AMPHIBIAN_GENERATORS_ABSTRACT_INTERFACES."StandardViewBuilderInterface.php";
/**
 * Class StandardViewBuilderMySQLiInterface
 *
 * @category StandardViewBuilder
 * @package  StandardViewBuilderMySQLiInterface
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/StandardViewBuilderMySQLiInterface
 */
interface StandardViewBuilderMySQLiInterface
    extends StandardViewBuilderInterface
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