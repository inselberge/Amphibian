<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/9/13
 * Time: 7:27 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
interface JSONInterface {
    /**
     *
     */
    public function __construct();

    /** setURL
     * @param $url
     * @return mixed
     */
    public function setURL( $url );
    public function post();
    public function get();

    /** setOptions
     * @param $array
     * @return mixed
     */
    public function setOptions( $array );

}