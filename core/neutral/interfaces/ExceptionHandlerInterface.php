<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/9/13
 * Time: 7:00 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
interface ExceptionHandlerInterface {
    /**
     * @param $message
     * @param int $code
     * @param null $previous
     */
    public function __construct($message, $code=0, $previous=null);

    /** instance
     * @param $msg
     * @return mixed
     */
    public static function instance($msg);
    public function execute();
    public function __toString();
}