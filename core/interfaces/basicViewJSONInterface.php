<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/30/13
 * Time: 3:25 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
interface basicViewJSONInterface
    extends basicViewInterface
{
    /** render
     * @param $dataPackage
     * @return mixed
     */
    public function render( $dataPackage );
}