<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/9/13
 * Time: 8:01 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
interface sessionExceptionInterface {
    /**
     * @param $message
     */
    public function __construct( $message );
    public function printMessage();

}