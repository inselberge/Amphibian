<?php
/**
 * PHP Version: ${PHP_VERSION}
 * Created by PhpStorm.
 * User: carl
 * Date: 1/22/14
 * Time: 11:46 PM
 */
/**
 * Class DataListMySQLiInterface
 *
 * @category 
 * @package  DataListMySQLiInterface
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
* @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/
 */
interface DataListMySQLiInterface
    extends DataListInterface
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

    /** setQuery
     * @param $query
     * @return mixed
     */
    public function setQuery($query);
} 