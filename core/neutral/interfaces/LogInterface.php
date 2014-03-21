<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/9/13
 * Time: 7:25 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
interface logInterface {
    /** instance
     * @param $msg
     * @return mixed
     */
    public static function instance($msg);

    /** setLogName
     * @param $logName
     * @return mixed
     */
    public function setLogName( $logName );

    /** setLogType
     * @param $type
     * @return mixed
     */
    public function setLogType($type);
    public function execute();
}