<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_GENERATORS_ABSTRACT."classGenerator.php";
/**
 * Class classGeneratorTest
 *
 * @category 
 * @package  
 * @author   
 * @license  
 * @link     documentation/classGeneratorTest
 *
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-04-06 at 21:03:07.
 *
 */
class classGeneratorTest 
    extends PHPUnit_Framework_TestCase
{
    /**
     * @var object classGenerator an instance of classGenerator
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
        $this->object = new classGenerator();
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
