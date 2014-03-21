<?php
/**
 * PHP Version 5.4.9-4ubuntu2.2
 * Created by PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 11/9/13
 * Time: 4:20 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
interface CoreUpdateInterface
{
    static public function instance();
    static public function factory();

    /** setDestination
     * @param $destination
     * @return mixed
     */
    public function setDestination( $destination );
    public function execute();
}
 