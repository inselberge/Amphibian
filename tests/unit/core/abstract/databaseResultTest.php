<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_CORE_ABSTRACT . "databaseResult.php";
/**
 * Class databaseResultTest
 *
 * @category Test
 * @package  DatabaseResult
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     documentation/databaseResultTest
 *
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-09-08 at 17:05:31.
 *
 */
class databaseResultTest 
    extends BaseTest
{
    /** setUp
     *
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp()
    {
        $this->object = $this->getMockForAbstractClass('databaseResult');
    }


}
