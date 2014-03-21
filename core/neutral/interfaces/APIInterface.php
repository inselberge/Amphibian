<?php
/**
 * PHP Version 5.4.9-4ubuntu2.2
 * Created by PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 10/31/13
 * Time: 3:26 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */

interface APIInterface
{
    /** instance
     * @param $request
     * @param $origin
     * @return mixed
     */
    static public function instance($request, $origin);

    /** setKey
     * @param $key
     * @return mixed
     */
    public function setKey( $key );
    public function getKey();
    public function execute();
}
 