<?php

require_once __DIR__ . DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."config.inc.php";
require_once AMPHIBIAN_CORE_NEUTRAL."BasicCartographer.php";
require_once AMPHIBIAN_TESTS."baseTest.php";
/**
 * Class BasicCartographerTest
 *
 * @category Test
 * @package  BasicCartographer
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     documentation/BasicCartographerTest
 *
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-09-08 at 17:05:32.
 *
 */
class BasicCartographerTest
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
        $this->object = $this->getMockForAbstractClass("BasicCartographer");
    }

    /** testSetAction
     *
     * @covers BasicCartographer::setAction
     *
     * @return void
     */
    public function testSetAction()
    {
        $this->expected = true;
        $this->actual = $this->object->setAction("index");
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetAction
     *
     * @covers BasicCartographer::getAction
     *
     * @return void
     */
    public function testGetAction()
    {
        $this->expected = "index";
        $this->object->setAction("index");
        $this->actual = $this->object->getAction();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetFormData
     *
     * @covers BasicCartographer::setFormData
     *
     * @return void
     */
    public function testSetFormData()
    {
        $this->expected = true;
        $this->actual = $this->object->setFormData($_SERVER);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetFormData
     *
     * @covers BasicCartographer::getFormData
     *
     * @return void
     */
    public function testGetFormData()
    {
        $this->expected = $_SERVER;
        $this->object->setFormData($_SERVER);
        $this->actual = $this->object->getFormData();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetIndexNames
     *
     * @covers BasicCartographer::setIndexNames
     *
     * @return void
     */
    public function testSetIndexNames()
    {
        $this->expected = true;
        $this->actual = $this->object->setIndexNames("First_Name");
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetIndexNames
     *
     * @covers BasicCartographer::getIndexNames
     *
     * @return void
     */
    public function testGetIndexNames()
    {
        $this->expected = "First_Name";
        $this->object->setIndexNames("First_Name");
        $this->actual = $this->object->getIndexNames();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetRequiredForAction
     *
     * @covers BasicCartographer::setRequiredForAction
     *
     * @return void
     */
    public function testSetRequiredForAction()
    {
        $this->expected = true;
        $this->actual = $this->object->setRequiredForAction("id");
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetRequiredForAction
     *
     * @covers BasicCartographer::getRequiredForAction
     *
     * @return void
     */
    public function testGetRequiredForAction()
    {
        $this->expected = "id";
        $this->actual = $this->object->getRequiredForAction();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** typeDataProvider
     *
     * @return array
     */
    public function typeDataProvider()
    {
        return array(
          array()
        );
    }

    /** testSetType
     *
     * @param string $type the type to set
     *
     * @covers BasicCartographer::setType
     *
     * @dataProvider typeDataProvider
     *
     * @return void
     */
    public function testSetType($type)
    {
        $this->expected = true;
        $this->actual = $this->object->setType($type);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetType
     *
     * @covers BasicCartographer::getType
     *
     * @return void
     */
    public function testGetType()
    {
        $this->expected = true;
        $this->actual = $this->object->getType();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetMap
     *
     * @covers BasicCartographer::getMap
     *
     * @return void
     */
    public function testGetMap()
    {
        $this->expected = true;
        $this->actual = $this->object->getMap();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testInitMap
     *
     * @covers BasicCartographer::initMap
     *
     * @return void
     */
    public function testInitMap()
    {
        $this->expected = true;
        $this->actual = $this->object->initMap();
        $this->assertEquals($this->expected, $this->actual);
    }
}