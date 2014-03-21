<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/13/13
 * Time: 8:54 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
interface concreteAgencyInterface
    extends BasicAgencyInterface
{
    /** instance
     * @param $databaseConnection
     * @return mixed
     */
    static public function instance($databaseConnection);
}