<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/9/13
 * Time: 7:42 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
interface randomPasswordInterface {
    /**
     * @param $requestedAlgo
     * @param $passwordLength
     */
    public function __construct( $requestedAlgo, $passwordLength );
    public function checkSupportedAlgo();
    public function createPassword();
}