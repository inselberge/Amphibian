<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/10/13
 * Time: 5:03 AM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once "DropDownMySQLiInterface.php";

/**
 * Interface CheckBoxQueryMySQLiInterface
 *
 * @category ${NAMESPACE}
 * @package  CheckBoxQueryMySQLiInterface
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated
 * @link     documentation/CheckBoxQueryMySQLiInterface
 */
interface CheckBoxQueryMySQLiInterface
    extends DropDownMySQLiInterface
{
    /** instance
     * @param resource $databaseConnection
     * @return mixed
     */
    static public function instance($databaseConnection);

    /** factory
     * @param resource $databaseConnection
     * @return mixed
     */
    static public function factory($databaseConnection);

    /** setIdField
     * @param $idField
     * @return mixed
     */
    public function setIdField( $idField );
    public function execute();
}