<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/9/13
 * Time: 8:11 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
interface DatabaseConnectionFactoryInterface
    extends CheckInputInterface
{
    /** connect
     * @param $datbaseTypeKey
     * @return mixed
     */
    public function connect( $datbaseTypeKey );
}
