<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_CORE_ABSTRACT . "BasicInteraction.php";
require_once AMPHIBIAN_CORE_MYSQLI . "databaseConnectionMySQLi.php";
/**
 * Class basicInteractionTest
 *
 * @category UnitTests
 * @package  BasicInteraction
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/basicInteractionTest
 */
class basicInteractionTest extends BaseTest
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
        $this->connection = DatabaseConnectionMySQLi::factory();
        $this->connection->setServerName("localhost");
        $this->connection->setDatabaseName("mysql");
        $this->connection->setUserName("root");
        $this->connection->setUserPassword('4u$t1nTX');
        $this->connection->openConnection();
        $this->object = $this->getMockForAbstractClass('BasicInteraction', array($this->connection));
    }

    /** testPrintByKey
     *
     * @covers BasicInteraction::printByKey
     *
     * @return void
     */
    public function testPrintByKey()
    {
        $this->assertTrue($this->object->printByKey("dataPackage"));
        $this->assertTrue($this->object->printByKey("connection"));
        $this->assertTrue($this->object->printByKey("errors"));
        $this->assertTrue($this->object->printByKey("log"));
    }

    /** testGetByKey
     *
     * @covers BasicInteraction::getByKey
     *
     * @return void
     */
    public function testGetByKey()
    {
        $this->expected = $this->object->getByKey("dataPackage");
        $this->actual = $this->object->getDataPackage();
        $this->assertEquals($this->expected, $this->actual);

        $this->expected = $this->object->getByKey("errors");
        $this->actual = $this->object->getErrors();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testShowSelf
     *
     * @covers BasicInteraction::showSelf
     *
     * @return void
     */
    public function testShowSelf()
    {
        $this->assertTrue($this->object->showSelf());
    }

    /** testGetErrors
     *
     * @covers BasicInteraction::getErrors
     *
     * @return void
     */
    public function testGetErrors()
    {
        $this->expected = $this->object->getByKey("errors");
        $this->actual = $this->object->getErrors();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetDataPackage
     *
     * @covers BasicInteraction::setDataPackage
     *
     * @return void
     */
    public function testSetDataPackage()
    {
        $this->arguments = new dataPackage();
        $this->expected = true;
        $this->actual = $this->object->setDataPackage($this->arguments);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetDataPackage
     *
     * @covers BasicInteraction::getDataPackage
     *
     * @return void
     */
    public function testGetDataPackage()
    {
        $this->expected = $this->object->getByKey("dataPackage");
        $this->actual = $this->object->getDataPackage();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testCheckDataPackageSet
     *
     * @covers BasicInteraction::checkDataPackageSet
     *
     * @return void
     */
    public function testCheckDataPackageSet()
    {
        $this->expected = true;
        $this->actual = $this->object->checkDataPackageSet();
        $this->assertEquals($this->expected, $this->actual);
    }
}
