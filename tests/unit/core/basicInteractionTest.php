<?php
require_once __DIR__ . DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config/config.inc.php";
require_once AMPHIBIAN_DATABASE."Coworks.In.mysql.config.inc.php";
require_once __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."baseTest.php";
require_once AMPHIBIAN_CORE . "BasicInteraction.php";
/**
 * Class basicInteractionTest
 * @category
 * @package
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/basicInteractionTest
 */class basicInteractionTest extends BaseTest
{
    /**
     * @var basicInteraction
     */
    protected $object;
    /**
     * @var mixed expected holds values for $basicInteractionTest->expected
     */
    protected $expected;
    /**
     * @var mixed actual holds values for $basicInteractionTest->actual
     */
    protected $actual;
    /**
     * @var mixed arguments holds values for $basicInteractionTest->arguments
     */
    protected $arguments;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        require AMPHIBIAN_CONFIG."mysql.cfg.php";
        $this->object = new BasicInteraction($databaseConnection);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        unset($this->object);
    }

    /**
     * @covers basicInteraction::printByKey
     */
    public function testPrintByKey()
    {
        $this->assertTrue($this->object->printByKey("dataPackage"));
        $this->assertTrue($this->object->printByKey("connection"));
        $this->assertTrue($this->object->printByKey("errors"));
        $this->assertTrue($this->object->printByKey("log"));
    }

    /**
     * @covers basicInteraction::getByKey
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

    /**
     * @covers basicInteraction::showSelf
     */
    public function testShowSelf()
    {
        $this->assertTrue($this->object->showSelf());
    }

    /**
     * @covers basicInteraction::getErrors
     */
    public function testGetErrors()
    {
        $this->expected = $this->object->getByKey("errors");
        $this->actual = $this->object->getErrors();
        $this->assertEquals($this->expected, $this->actual);
    }

    /**
     * @covers basicInteraction::setDataPackage
     */
    public function testSetDataPackage()
    {
        $this->arguments = new dataPackage();
        $this->expected = true;
        $this->actual = $this->object->setDataPackage($this->arguments);
        $this->assertEquals($this->expected, $this->actual);
    }

    /**
     * @covers basicInteraction::getDataPackage

     */
    public function testGetDataPackage()
    {
        $this->expected = $this->object->getByKey("dataPackage");
        $this->actual = $this->object->getDataPackage();
        $this->assertEquals($this->expected, $this->actual);
    }

    /**
     * @covers basicInteraction::checkDataPackageSet
     */
    public function testCheckDataPackageSet()
    {
        $this->expected = true;
        $this->actual = $this->object->checkDataPackageSet();
        $this->assertEquals($this->expected, $this->actual);
    }
}
