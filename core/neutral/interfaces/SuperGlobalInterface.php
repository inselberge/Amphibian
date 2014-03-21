<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/9/13
 * Time: 7:58 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
interface SuperGlobalInterface
{
    /**
     * @param array $glob
     */
    public function __construct( array $glob );

    /** checkEqual
     * @param SuperGlobal $super
     * @return mixed
     */
    public function checkEqual( SuperGlobal $super );

    /** setLocalArray
     * @param $localArray
     * @return mixed
     */
    public function setLocalArray( $localArray );

    /** setLocalArrayByKey
     * @param $key
     * @param $value
     * @return mixed
     */
    public function setLocalArrayByKey( $key,$value );
    public function getLocalArray();

    /** getLocalArrayByKey
     * @param $key
     * @return mixed
     */
    public function getLocalArrayByKey($key);
    public function printSize();
}