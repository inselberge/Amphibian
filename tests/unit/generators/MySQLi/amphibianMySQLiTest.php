<?php
require_once __DIR__ . "/../../../config/config.inc.php";
require_once AMPHIBIAN_CORE."amphibianMySQLi.php";
/**
 * Class amphibianMySQLiTest
 *
 * @category 
 * @package  
 * @author   
 * @license  
 * @link     documentation/amphibianMySQLiTest
 *
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-04-06 at 21:25:45.
 *
 */
class amphibianMySQLiTest 
	extends PHPUnit_Framework_TestCase
{
    /**
     * @var object amphibianMySQLi an instance of amphibianMySQLi
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
        $this->object = new amphibianMySQLi();
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
