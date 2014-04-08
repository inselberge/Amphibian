<?php
require_once __DIR__ . DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."config.inc.php";
require_once AMPHIBIAN_CORE_ABSTRACT."BasicModel.php";
require_once AMPHIBIAN_TESTS."baseTest.php";
/**
 * Class basicModelTest
 *
 * @category Test
 * @package  Core
 * @author   Carl "Tex" Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/basicModelTest
 *
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-09-08 at 17:05:32.
 *
 */
class basicModelTest 
	extends BaseTest
{
    /**
     * @var object basicModel an instance of basicModel
     */
    protected $object;
    /**
     * @var mixed expected holds values for $basicModelTest->expected
     */
    protected $expected;
    /**
     * @var mixed actual holds values for $basicModelTest->actual
     */
    protected $actual;
    /**
     * @var mixed arguments holds values for $basicModelTest->arguments
     */
    protected $arguments;

    /** setUp
     *
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp()
    {
        require AMPHIBIAN_CONFIG."mysql.cfg.php";
        $this->object = $this->getMockForAbstractClass('basicModel', array($databaseConnection));
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
        unset($this->actual);
        unset($this->expected);
    }

    /** testSetFilter
     *
     * @covers basicModel::setFilter
     *
     * @return void
     */
    public function testSetFilter()
    {
        $this->expected = true;
        $this->actual = $this->object->setFilter("key", array(FILTER_FLAG_ALLOW_HEX));
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetValidator
     *
     * @covers basicModel::setValidator
     *
     * @return void
     */
    public function testSetValidator()
    {
        $this->expected = true;
        $this->actual = $this->object->setValidator("key", "validator");
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetSanitizer
     *
     * @covers basicModel::setSanitizer
     *
     * @return void
     */
    public function testSetSanitizer()
    {
        $this->expected = true;
        $this->actual = $this->object->setSanitizer("key", "filter");
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetValuesFromRow
     *
     * @covers basicModel::setValuesFromRow
     *
     * @return void
     */
    public function testSetValuesFromRow()
    {
        $this->expected = true;
        $this->actual = $this->object->setValuesFromRow();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testExtract
     *
     * @covers basicModel::extract
     *
     * @return void
     */
    public function testExtract()
    {
        $this->expected = true;
        $this->actual = $this->object->extract();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testExtractPayload
     *
     * @covers basicModel::extractPayload
     *
     * @return void
     */
    public function testExtractPayload()
    {
        $this->expected = true;
        $this->actual = $this->object->extractPayload();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetAcceptableKeys
     *
     * @covers basicModel::getAcceptableKeys
     *
     * @return void
     */
    public function testGetAcceptableKeys()
    {
        $this->expected=null;
        $this->actual = $this->object->getAcceptableKeys();
        $this->assertEquals($this->expected, $this->actual);
    }
}