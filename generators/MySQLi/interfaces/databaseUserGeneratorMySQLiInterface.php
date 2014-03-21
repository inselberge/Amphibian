<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/10/13
 * Time: 1:28 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
interface DatabaseUserGeneratorMySQLiInterface
    extends DatabaseUserGeneratorInterface
{
    /** instance
     * @param $databaseConnection
     * @return mixed
     */
    static public function instance( $databaseConnection );

    /** set
     * @param $element
     * @param $value
     * @return mixed
     */
    public function set( $element, $value );
    public function execute();
    public function createDefaultUsers();

}