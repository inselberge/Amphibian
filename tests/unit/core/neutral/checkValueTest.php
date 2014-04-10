<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_CORE_NEUTRAL . "CheckValue.php";

/**
 * Class CheckValueTest
 *
 * @category Test
 * @package  Core
 * @author   Carl "Tex" Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     documentation/CheckValueTest
 *
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-09-08 at 17:05:32.
 *
 */
class CheckValueTest
	extends BaseTest
{
    /**
     * @var object CheckValue an instance of CheckValue
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
        $this->object = new CheckValue();
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

    /** testSetType
     *
     * @covers CheckValue::setType
     *
     * @return void
     */
    public function testSetType()
    {
        $this->assertTrue($this->object->setType(2));
        /* TODO: uncomment when exception testing is ready
         * $this->setExpectedException("ExceptionHandler");
           $this->assertFalse($this->object->setType(1));
           $this->assertFalse($this->object->setType("Hello"));
        */
    }

    /** testSetValue
     *
     * @covers CheckValue::setValue
     *
     * @return void
     */
    public function testSetValue()
    {
        $this->assertTrue($this->object->setValue(1));
        $this->assertTrue($this->object->setValue(true));
        $this->assertTrue($this->object->setValue("Hello"));
        $this->assertTrue($this->object->setValue("texmorgan@amphibian.co"));
    }

    /** testEvaluateInput
     *
     * @param integer $type  the type of check to do
     * @param mixed   $value the value to check
     *
     * @covers CheckValue::evaluateInput
     *
     * @dataProvider CheckValueDataProvider()
     *
     * @return void
     */
    public function testEvaluateInput($type,$value)
    {
        $this->object->setType($type);
        $this->object->setValue($value);
        echo "\nType:".$type."\n";
        $this->assertNull($this->object->evaluateInput());
    }

    /** CheckValueDataProvider
     *
     * @return array
     */
    public function CheckValueDataProvider()
    {
        return array(
          array(2,"uH*HwwQuUoww7ea"),
          array(3,"Tex"),
          array(4,"San Antonio"),
          array(5,"TX"),
          array(6,"78235"),
          array(7,"8183966674"),
          array(8,"texmorgan@amphibian.co"),
          array(9,"7803 S. New Braunfels #9206"),
          array(10,"My, what a lovely child."),
          array(11,"11"),
          array(12,"1979"),
          array(13,"14"),
          array(14,"19"),
          array(15,"37"),
          array(16,"http://amphibian.co"),
          array(17,"texmorgan@amphibian.co"),
          array(18,"818-396-6674"),
          array(19,"10/20/1979"),
          array(19,"10-20-1979"),
          array(20,"20:17"),
          array(21,1),
          array(22,-1),
          array(23,3013),
          array(24,3.14),
          array(25,-3.14),
          array(26,3.1415),
          array(27,"192.168.1.10"),
          array(28,""),
          array(29,"\t"),
          array(30,"\r"),
          array(31,"texmorgan@amphibian.co"),
          array(32,"1979-10-20")
        );
    }

    /** testSetVariables
     *
     * @param integer $type  the type of check to do
     * @param mixed   $value the value to check
     *
     * @covers CheckValue::setVariables
     *
     * @dataProvider CheckValueDataProvider()
     *
     * @return void
     */
    public function testSetVariables($type, $value)
    {
        $_GET["v"] = $value;
        $_GET["t"] = $type;
        $this->assertTrue($this->object->setVariables());
    }

    /** testCheckVariables
     *
     * @param integer $type  the type of check to do
     * @param mixed   $value the value to check
     *
     * @covers CheckValue::checkVariables
     *
     * @dataProvider CheckValueDataProvider()
     *
     * @return void
     */
    public function testCheckVariables($type, $value)
    {
        $this->object->setType($type);
        $this->object->setValue($value);
        $this->assertTrue($this->object->checkVariables());
    }
}
