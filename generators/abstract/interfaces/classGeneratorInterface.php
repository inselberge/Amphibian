<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/10/13
 * Time: 1:06 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
interface ClassGeneratorInterface
{
    /** setTableName
     * @param $name
     * @return mixed
     */
    public function setTableName( $name );
    public function execute();
}