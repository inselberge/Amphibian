<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/10/13
 * Time: 1:26 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
interface DatabaseUserGeneratorInterface
    extends CheckInputInterface
{
    /** makeUserName
     * @param $name
     * @return mixed
     */
    public function makeUserName( $name );
    public function show();

}