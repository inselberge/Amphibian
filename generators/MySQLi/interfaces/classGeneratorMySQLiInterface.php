<?php
/**
 * PHP Version: ${PHP_VERSION}
 * Created by PhpStorm.
 * User: carl
 * Date: 12/20/13
 * Time: 9:20 PM
 */
/**
 * Class ClassGeneratorMySQLiInterface
 *
 * @category ClassGeneratorInterface
 * @package  ClassGeneratorMySQLiInterface
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/ClassGeneratorMySQLiInterface
 */
interface ClassGeneratorMySQLiInterface
    extends ClassGeneratorInterface
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