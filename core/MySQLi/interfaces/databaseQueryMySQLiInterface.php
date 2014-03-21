<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/9/13
 * Time: 6:26 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once AMPHIBIAN_CORE_ABSTRACT_INTERFACES."databaseQueryInterface.php";

/**
 * Interface databaseQueryMySQLiInterface
 *
 * @category ${NAMESPACE}
 * @package  databaseQueryMySQLiInterface
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated
 * @link     documentation/databaseQueryMySQLiInterface
 */
interface databaseQueryMySQLiInterface
    extends databaseQueryInterface
{
    /** instance
     * @param $databaseConnection
     * @return mixed
     */
    static public function instance( $databaseConnection );

    /** execute
     * @param $string
     * @return mixed
     */
    public function execute( $string );

    /** clean
     * @param $string
     * @return mixed
     */
    public function clean( $string );
    public function commit();
    public function getArray();
    public function getRow();
    public function free();

}