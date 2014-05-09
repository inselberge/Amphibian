<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";

require_once AMPHIBIAN_GENERATORS_NEUTRAL."PHPUMLGenerator.php";
/**
 * Class PHPUMLGeneratorTest
 *
 * @category 
 * @package  
 * @author   
 * @license  
 * @link     documentation/PHPUMLGeneratorTest
 *
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-04-06 at 21:57:09.
 *
 */
class PHPUMLGeneratorTest 
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
        $this->object = PHPUMLGenerator::factory();
    }

    /** testInstance
     *
     * @covers PHPUMLGenerator::instance
     *
     * @return void
     */
    public function testInstance()
    {
        $this->expected = $this->object;
        $this->actual = PHPUMLGenerator::instance();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testFactory
     *
     * @covers PHPUMLGenerator::factory
     *
     * @return void
     */
    public function testFactory()
    {
        $this->expected = $this->object;
        $this->actual = PHPUMLGenerator::factory();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetDestination
     *
     * @covers PHPUMLGenerator::setDestination
     *
     * @dataProvider destinationDataProvider
     *
     * @return void
     */
    public function testSetDestination($destination, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setDestination($destination);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** destinationDataProvider
     *
     * @return array
     */
    public function destinationDataProvider()
    {
        return array(
            array("", true),
            array("", true),
            array("", true)
        );
    }

    /** testSetSource
     *
     * @covers PHPUMLGenerator::setSource
     *
     * @dataProvider sourceDataProvider
     *
     * @return void
     */
    public function testSetSource($source, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setSource($source);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** sourceDataProvider
     *
     * @return array
     */
    public function sourceDataProvider()
    {
        return array(
            array("",true),
            array("", true),
            array("", true)
        );
    }

    /** testSetEncoding
     *
     * @covers PHPUMLGenerator::setEncoding
     *
     * @dataProvider encodingDataProvider
     *
     * @return void
     */
    public function testSetEncoding($encoding, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setEncoding($encoding);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetOutputFormat
     *
     * @covers PHPUMLGenerator::setOutputFormat
     *
     * @dataProvider outputFormatDataProvider
     *
     * @return void
     */
    public function testSetOutputFormat($format, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setOutputFormat($format);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** outputFormatDataProvider
     *
     * @return array
     */
    public function outputFormatDataProvider()
    {
        return array(
            array("html", true),
            array("htmlnew", true),
            array("xmi", true),
            array("php", true),
            array("json", false)
        );
    }

    /** testSetXmiVersion
     *
     * @covers PHPUMLGenerator::setXmiVersion
     *
     * @dataProvider XMLVersionProvider
     *
     * @return void
     */
    public function testSetXmiVersion($version, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setXmlVersion($version);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testExecute
     *
     * @covers PHPUMLGenerator::execute
     *
     * @return void
     */
    public function testExecute()
    {
        $this->expected = true;
        $this->actual = $this->object->execute();
        $this->assertEquals($this->expected, $this->actual);
    }
}
