<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/10/13
 * Time: 1:38 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
interface sprocGeneratorMySQLiInterface extends sprocGeneratorInterface {
    /** instance
     * @param $databaseConnection
     * @return mixed
     */
    static public function instance( $databaseConnection );

    /** setTableNames
     * @param array $array
     * @return mixed
     */
    public function setTableNames( array $array );
    public function execute();
}