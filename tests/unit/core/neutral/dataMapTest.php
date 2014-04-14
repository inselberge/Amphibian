<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_CORE_NEUTRAL . "DataMap.php";

/**
 * Class dataMapTest
 *
 * @category Test
 * @package  DataMap
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     documentation/dataMapTest
 *
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-09-08 at 17:05:31.
 *
 */
class dataMapTest 
    extends BaseTest
{
    /**
     * @var object dataMap an instance of dataMap
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
        $this->object = dataMap::instance();
    }

    /** testInstance
     *
     * @covers dataMap::instance
     *
     * @return void
     */
    public function testInstance()
    {
        $this->expected = $this->object;
        $this->actual = dataMap::instance();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** dataMapKeysDataProvider
     *
     * @return array
     */
    public function dataMapKeysDataProvider()
    {
        return array(
            array(
                array(
                    "id",
                    "firstName",
                    "lastName",
                    "email",
                    "login"
                )
            )
        );
    }

    /** testInitMap
     *
     * @param array $array the array to init
     *
     * @covers dataMap::initMap
     *
     * @dataProvider dataMapKeysDataProvider
     *
     * @return void
     */
    public function testInitMap($array)
    {
        $this->expected = true;
        $this->actual = $this->object->initMap($array);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** mapDataProvider
     *
     * @return array
     */
    public function mapDataProvider()
    {
        return array(
            array(
                array(
                    "id" => "session",
                    "firstName" => "session",
                    "lastName" => "session",
                    "email" => "session",
                    "login" => date('Y-m-d')
                )
            )
        );
    }

    /** testSetMapByKey
     *
     * @param array $array the array to use
     *
     * @covers dataMap::setMapByKey
     *
     * @dataProvider mapDataProvider
     *
     * @return void
     */
    public function testSetMapByKey( $array )
    {
        $this->expected = true;
        $this->actual = $this->object->setMapByKey($array);
        $this->assertEquals($this->expected, $this->actual);

    }

    /** testGetMapByKey
     *
     * @covers dataMap::getMapByKey
     *
     * @return void
     */
    public function testGetMapByKey()
    {
        $this->expected = "session";
        $this->actual = $this->object->getMapByKey("firstName");
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetMap
     *
     * @param array $array the array to use
     *
     * @covers dataMap::setMap
     *
     * @dataProvider mapDataProvider
     *
     * @return void
     */
    public function testSetMap($array)
    {
        $this->expected = true;
        $this->actual = $this->object->setMap($array);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetMap
     *
     * @covers dataMap::getMap
     *
     * @return void
     */
    public function testGetMap()
    {
        $this->expected = array(
            "id" => "session",
            "firstName" => "session",
            "lastName" => "session",
            "email" => "session",
            "login" => date('Y-m-d')
        );
        $this->actual = $this->object->getMap();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetMapType
     *
     * @covers dataMap::getMapType
     *
     * @return void
     */
    public function testGetMapType()
    {
        $this->expected = "array";
        $this->actual = $this->object->getMapType("firstName");
        $this->assertEquals($this->expected, $this->actual);

        $this->expected = "code";
        $this->actual = $this->object->getMapType("login");
        $this->assertEquals($this->expected, $this->actual);
    }
}
