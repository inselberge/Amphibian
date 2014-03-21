<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/10/13
 * Time: 1:44 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
interface SkeletonTestGeneratorInterface
{
    /** setDestination
     * @param $destination
     * @return mixed
     */
    public function setDestination( $destination );
    public function execute();

}