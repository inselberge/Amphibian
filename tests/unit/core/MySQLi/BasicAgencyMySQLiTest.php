<?php
require_once __DIR__ . "/../../../config/config.inc.php";
require_once AMPHIBIAN_CORE."BasicAgencyMySQLi.php";
/**
 * Class BasicAgencyMySQLiTest
 *
 * @category 
 * @package  
 * @author   
 * @license  
 * @link     documentation/BasicAgencyMySQLiTest
 *
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-04-06 at 22:55:06.
 *
 */
class BasicAgencyMySQLiTest 
	extends PHPUnit_Framework_TestCase
{
    /**
     * @var object BasicAgencyMySQLi an instance of BasicAgencyMySQLi
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
        $this->object = new BasicAgencyMySQLi();
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

    /** testAcceptArgumentsDataPackage
     *
     * @covers BasicAgencyMySQLi::acceptArgumentsDataPackage
     *
     * @todo   Implement testAcceptArgumentsDataPackage().
     *
     * @return void
     */
    public function testAcceptArgumentsDataPackage()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }
}
