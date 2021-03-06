<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_CORE_NEUTRAL."DataPackage.php";

/**
 * Class DataPackageTest
 *
 * @category Test
 * @package  Core
 * @author   Carl "Tex" Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/DataPackageTest
 *
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-09-08 at 17:05:31.
 *
 */
class DataPackageTest 
    extends BaseTest
{
    /**
     * @var object DataPackage an instance of DataPackage
     */
    protected $object;
    /**
     * @var mixed expected the expected value
     */
    protected $expected;
    /**
     * @var mixed arguments holds the arguments
     */
    protected $arguments;
    /**
     * @var mixed actual the actual return of the action
     */
    protected $actual;

    /** setUp
     *
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp()
    {
        $this->object = new DataPackage();
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

    /** testSetErrors
     *
     * @covers DataPackage::setErrors
     *
     * @return void
     */
    public function testSetErrors()
    {
        $this->expected = true;
        $this->arguments = array("first_name"=>"Invalid first name.");
        $this->actual = $this->object->setErrors($this->arguments);
        $this->assertEquals($this->expected, $this->actual);

        $this->arguments = null;
        $this->expected = false;
        //$this->setExpectedException('ExceptionHandler');
        $this->actual = $this->object->setErrors($this->arguments);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetErrors
     *
     * @covers DataPackage::getErrors
     *
     * @return void
     */
    public function testGetErrors()
    {
        $this->expected = array();
        $this->actual = $this->object->getErrors();
        $this->assertEquals($this->expected, $this->actual);

        $this->arguments = array("first_name"=>"Invalid first name.");
        $this->object->setErrors($this->arguments);
        $this->expected = $this->arguments;
        $this->actual = $this->object->getErrors();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetPayload
     *
     * @covers DataPackage::setPayload
     *
     * @return void
     */
    public function testSetPayload()
    {
        $this->expected = true;
        $this->arguments = array("first_name"=>"Tex");
        $this->actual = $this->object->setPayload($this->arguments);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetPayload
     *
     * @covers DataPackage::getPayload
     *
     * @return void
     */
    public function testGetPayload()
    {
        $this->expected = array("first_name"=>"Tex");
        $this->arguments = array("first_name"=>"Tex");
        $this->object->setPayload($this->arguments);
        $this->actual = $this->object->getPayload();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetQueryArguments
     *
     * @covers DataPackage::setQueryArguments
     *
     * @return void
     */
    public function testSetQueryArguments()
    {
        $this->expected = true;
        $this->arguments = array(
            "where"=>"id gt 587",
            "groupBy"=>"create_date de",
            "limit"=> "25 offset 25"
        );
        $this->actual = $this->object->setQueryArguments($this->arguments);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetQueryArguments
     *
     * @covers DataPackage::getQueryArguments
     *
     * @return void
     */
    public function testGetQueryArguments()
    {
        $this->expected = array();
        $this->actual = $this->object->getQueryArguments();
        $this->assertEquals($this->expected, $this->actual);

        $this->expected = array(
            "where"=>"id gt 587",
            "groupBy"=>"create_date de",
            "limit"=> "25 offset 25"
        );
        $this->arguments = array(
            "where"=>"id gt 587",
            "groupBy"=>"create_date de",
            "limit"=> "25 offset 25"
        );
        $this->object->setQueryArguments($this->arguments);
        $this->actual = $this->object->getQueryArguments();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testCheckKeyInArray
     *
     * @covers DataPackage::checkKeyInArray
     *
     * @return void
     */
    public function testCheckKeyInArray()
    {
        $this->arguments = array(
            "where"=>"id gt 587",
            "groupBy"=>"create_date de",
            "limit"=> "25 offset 25"
        );
        $this->object->setQueryArguments($this->arguments);

        $this->expected = true;
        $this->actual = $this->object->checkKeyInArray("queryArguments","limit");
        $this->assertEquals($this->expected, $this->actual);
        $this->expected = false;
        $this->actual = $this->object->checkKeyInArray("queryArguments","orderBy");
        $this->assertEquals($this->expected, $this->actual);

    }

    /** testAddToArray
     *
     * @covers DataPackage::addToArray
     *
     * @return void
     */
    public function testAddToArray()
    {
        $this->expected = array(
            "where"=>"id gt 587",
            "groupBy"=>"create_date de",
            "orderBy"=>"modify_date de",
            "limit"=> "25 offset 25"
        );
        $this->arguments = array(
            "where"=>"id gt 587",
            "groupBy"=>"create_date de",
            "limit"=> "25 offset 25"
        );
        $this->object->setQueryArguments($this->arguments);
        $this->actual = $this->object->addToArray(
            "queryArguments",
            array("orderBy"=>"modify_date de")
        );
        $this->assertEquals($this->expected, $this->object->getQueryArguments());
        $this->assertEquals(true, $this->actual);
    }

    /** testGetSpecificPayload
     *
     * @covers DataPackage::getSpecificPayload
     *
     * @return void
     */
    public function testGetSpecificPayload()
    {
        $this->arguments = array(
            "first_name"=>"Tex",
            "last_name"=>"Morgan"
        );
        $this->object->setPayload($this->arguments);
        $this->expected = "Morgan";
        $this->actual = $this->object->getSpecificPayload("last_name");
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetSpecificError
     *
     * @covers DataPackage::getSpecificError
     *
     * @return void
     */
    public function testGetSpecificError()
    {
        $this->arguments = array(
            "first_name"=>"Invalid first name.",
            "last_name"=>"Invalid last name."
        );
        $this->object->setErrors($this->arguments);
        $this->expected = "Invalid last name.";
        $this->actual = $this->object->getSpecificError("last_name");
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetSpecificQueryArguments
     *
     * @covers DataPackage::getSpecificQueryArguments
     *
     * @return void
     */
    public function testGetSpecificQueryArguments()
    {
        $this->arguments = array(
            "where"=>"id gt 587",
            "groupBy"=>"create_date de",
            "limit"=> "25 offset 25"
        );
        $this->object->setQueryArguments($this->arguments);
        $this->expected = "id gt 587";
        $this->actual = $this->object->getSpecificQueryArguments("where");
        $this->assertEquals($this->expected, $this->actual);
    }
}
