<?php
require_once __DIR__ . "/../../../config/config.inc.php";
require_once AMPHIBIAN_CORE."databaseQueryPreparedMySQLi.php";
/**
 * Class databaseQueryPreparedMySQLiTest
 *
 * @category 
 * @package  
 * @author   
 * @license  
 * @link     documentation/databaseQueryPreparedMySQLiTest
 *
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-04-06 at 22:59:00.
 *
 */
class databaseQueryPreparedMySQLiTest 
	extends PHPUnit_Framework_TestCase
{
    /**
     * @var object databaseQueryPreparedMySQLi an instance of databaseQueryPreparedMySQLi
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
        $this->object = new databaseQueryPreparedMySQLi();
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