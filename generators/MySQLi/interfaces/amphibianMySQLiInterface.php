<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/10/13
 * Time: 1:01 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
interface amphibianMySQLiInterface extends amphibianInterface {
    static public function instance();
    public function execute();
    public function printResults();
}