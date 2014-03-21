<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/10/13
 * Time: 1:34 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
interface DatabaseViewGeneratorMySQLiInterface
    extends DatabaseViewGeneratorInterface
{
    /** instance
     * @param $databaseConnection
     * @return mixed
     */
    static public function instance( $databaseConnection );

    /** setTableNames
     * @param $array
     * @return mixed
     */
    public function setTableNames( $array );
    public function execute();
}