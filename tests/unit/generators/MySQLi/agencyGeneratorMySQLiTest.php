<?php
require_once __DIR__ . "/../../../config/config.inc.php";
require_once AMPHIBIAN_CORE."agencyGeneratorMySQLi.php";
/**
 * Class agencyGeneratorMySQLiTest
 *
 * @category 
 * @package  
 * @author   
 * @license  
 * @link     documentation/agencyGeneratorMySQLiTest
 *
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-04-06 at 21:21:19.
 *
 */
class agencyGeneratorMySQLiTest 
	extends PHPUnit_Framework_TestCase
{
    /**
     * @var object agencyGeneratorMySQLi an instance of agencyGeneratorMySQLi
     */
    protected $object;

    /** setUp
     *
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp()
    {
        $this->object = new agencyGeneratorMySQLi();
    }

    /** tearDown
     *
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     *
     * @return void
     */
    protected function tearDown()
    {
    }
}
