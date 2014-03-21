<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/9/13
 * Time: 7:44 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
interface preLoaderInterface {
    /** instance
     * @param $type
     * @param $array
     * @return mixed
     */
    public static function instance($type, $array);

    /** setArray
     * @param $array
     * @return mixed
     */
    public function setArray( $array );

    /** setType
     * @param $type
     * @return mixed
     */
    public function setType( $type );
    public function execute( );
}