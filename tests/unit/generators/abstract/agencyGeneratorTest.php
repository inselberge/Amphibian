<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";

require_once AMPHIBIAN_GENERATORS_ABSTRACT . "agencyGenerator.php";
/**
 * Class agencyGeneratorTest
 *
 * @category 
 * @package  
 * @author   
 * @license  
 * @link     documentation/agencyGeneratorTest
 *
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-04-06 at 21:00:11.
 *
 */
class agencyGeneratorTest 
    extends PHPUnit_Framework_TestCase
{
    /**
     * @var object agencyGenerator an instance of agencyGenerator
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
        $this->object = new agencyGenerator();
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
