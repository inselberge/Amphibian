<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/9/13
 * Time: 6:51 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once AMPHIBIAN_CORE_ABSTRACT_INTERFACES . "DropDownInterface.php";
/**
 * Interface DropDownMySQLiInterface
 *
 * @category DropDown
 * @package  DropDownMySQLiInterface
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
* @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/
 */
interface DropDownMySQLiInterface
    extends DropDownInterface
{
    /** instance
     *
     * @param resource $databaseConnection a valid database connection
     *
     * @return DropDown
     */
    static public function instance($databaseConnection);

    /** factory
     *
     * @param resource $databaseConnection a valid database connection
     *
     * @return DropDown
     */
    static public function factory($databaseConnection);

    /** setQuery
     *
     * @param object $query a valid MySQL query
     *
     * @return bool
     */
    public function setQuery( $query );

}