<?php
/**
 * PHP Version 5.4.9-4ubuntu2.2
 * Created by PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 10/31/13
 * Time: 1:58 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */

interface SerializeInterface
{
    static public function instance();

    /** setDirection
     * @param $direction
     * @return mixed
     */
    public function setDirection( $direction );
    public function getDirection();

    /** setData
     * @param $data
     * @return mixed
     */
    public function setData( $data );

    /** appendData
     * @param $data
     * @return mixed
     */
    public function appendData( $data );
    public function getData();
    public function execute();
    public function getOutput();
}
 