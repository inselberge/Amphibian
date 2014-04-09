<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once AMPHIBIAN_TESTS_UNIT . "baseTest.php";
require_once AMPHIBIAN_CORE_NEUTRAL . "BasicBrowse.php";
//require_once MYSQL; todo: replace these with correct databaseConnectionMySQLi calls
/**
 * Class BasicBrowseTest
 *
 * @category Test
 * @package  BasicBrowse
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/BasicBrowseTest
 *
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-09-08 at 17:05:32.
 *
 */
class BasicBrowseTest 
    extends BaseTest
{
    protected $databaseConnection;
    /** setUp
     *
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp()
    {
        $this->databaseConnection = DatabaseConnectionMySQLi::instance();
        $this->object = BasicBrowse::instance($this->databaseConnection);
    }

    /** testInstance
     *
     * @covers BasicBrowse::instance
     *
     * @return void
     */
    public function testInstance()
    {
        $this->expected = $this->object;
        $this->actual = BasicBrowse::instance($this->databaseConnection);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetIdName
     *
     * @covers BasicBrowse::setIdName
     *
     * @return void
     */
    public function testSetIdName()
    {
        $this->expected = true;
        $this->actual = $this->object->setIdName("hello");
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetIdName
     *
     * @covers BasicBrowse::getIdName
     *
     * @return void
     */
    public function testGetIdName()
    {
        $this->expected = "hello";
        $this->object->setIdName("hello");
        $this->actual = $this->object->getIdName();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetAgency
     *
     * @covers BasicBrowse::setAgency
     *
     * @return void
     */
    public function testSetAgency()
    {
        $this->expected = true;
        $this->actual = $this->object->setAgency("User");
        $this->assertEquals($this->expected, $this->actual);
    }

    /** renderMethodDataProvider
     *
     * @return array
     */
    public function renderMethodDataProvider()
    {
        return array(
            array("json"),
            array("html"),
            array("xml")
        );
    }

    /** testSetRenderMethod
     *
     * @param string $render a specific render method
     *
     * @covers BasicBrowse::setRenderMethod
     *
     * @dataProvider renderMethodDataProvider
     *
     * @return void
     */
    public function testSetRenderMethod($render)
    {
        $this->expected = true;
        $this->actual = $this->object->setRenderMethod($render);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testExecute
     *
     * @covers BasicBrowse::execute
     *
     * @return void
     */
    public function testExecute()
    {
        $this->expected = true;
        $this->actual = $this->object->execute();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testRender
     *
     * @covers BasicBrowse::render
     *
     * @return void
     */
    public function testRender()
    {
        $this->expected = true;
        $this->actual = $this->object->render();
        $this->assertEquals($this->expected, $this->actual);
    }
}
