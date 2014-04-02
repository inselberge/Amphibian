<?php
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-06-07 at 17:49:28.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config/config.inc.php";
require_once AMPHIBIAN_CORE."CheckInput.php";
require_once __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."baseTest.php";
class CheckInputTest extends BaseTest
{
    /**
     * @var CheckInput
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new CheckInput();
    }


    /**
     * @covers CheckInput::checkNewInput
     */
    public function testCheckNewInput()
    {
        $this->assertTrue($this->object->checkNewInput(1));
        $this->assertTrue($this->object->checkNewInput("Hello"));
        $this->assertTrue($this->object->checkNewInput(array("1")));
        $this->assertTrue($this->object->checkNewInput(1.9));
        $this->assertTrue($this->object->checkNewInput(false));
        $this->assertTrue($this->object->checkNewInput(true));
        $this->assertTrue($this->object->checkNewInput(-5));
    }

    /**
     * @covers CheckInput::checkNewInputArray
     */
    public function testCheckNewInputArray()
    {
        $this->assertTrue($this->object->checkNewInputArray(array("hello")));
        $this->assertTrue($this->object->checkNewInputArray(array()));
        $this->assertTrue($this->object->checkNewInputArray(array("hello" => 1)));
    }
    /**
     * @covers CheckInput::checkSet
     */
    public function testCheckSet()
    {
        $this->assertTrue($this->object->checkSet(1));
        $this->assertTrue($this->object->checkSet("Hello"));
        $this->assertTrue($this->object->checkSet(array("1")));
        $this->assertTrue($this->object->checkSet(1.9));
        $this->assertTrue($this->object->checkSet(false));
        $this->assertTrue($this->object->checkSet(true));
        $this->assertTrue($this->object->checkSet(-5));
    }

    /**
     * @covers CheckInput::checkSetArray
     */
    public function testCheckSetArray()
    {
        $this->assertTrue($this->object->checkSetArray(array("hello")));
        $this->assertFalse($this->object->checkSetArray(array()));
        $this->assertTrue($this->object->checkSetArray(array("hello" => 1)));
    }
}
