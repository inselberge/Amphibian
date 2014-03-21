<?php
/**
 * PHP Version: ${PHP_VERSION}
 * Created by PhpStorm.
 * User: carl
 * Date: 1/21/14
 * Time: 10:44 AM
 */
require_once AMPHIBIAN_CORE_ABSTRACT_INTERFACES."TableDescriptionInterface.php";
/**
 * Class TableDescriptionMySQLiInterface
 *
 * @category 
 * @package  TableDescriptionMySQLiInterface
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
* @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/
 */
interface TableDescriptionMySQLiInterface
    extends TableDescriptionInterface
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