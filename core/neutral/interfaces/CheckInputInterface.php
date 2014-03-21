<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/9/13
 * Time: 5:07 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
interface CheckInputInterface
{
    /** checkNewInput
     * @param $value
     * @return mixed
     */
    static public function checkNewInput( $value );

    /** checkNewInputArray
     * @param $array
     * @return mixed
     */
    static public function checkNewInputArray( $array );

    /** checkSet
     * @param $key
     * @return mixed
     */
    static public function checkSet($key);

    /** checkSetArray
     * @param $array
     * @return mixed
     */
    static public function checkSetArray($array);
}