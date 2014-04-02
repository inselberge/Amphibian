<?php

require_once __DIR__ . DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."config.inc.php";
//require_once AMPHIBIAN_DATABASE."Coworks.In.mysql.config.inc.php";
require_once __DIR__ . DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."baseTest.php";
require_once AMPHIBIAN_CORE_ABSTRACT . "BasicAgency.php";
/**
 * Class BasicAgencyTest
 *
 * @category Test
 * @package  Core
 * @author   Carl "Tex" Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc., except where noted
 * @link     documentation/BasicAgencyTest
 *
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-09-08 at 17:05:32.
 *
 */
class BasicAgencyTest
	extends BaseTest
{
    /**
     * @var object BasicAgency an instance of BasicAgency
     */
    protected $object;
    /**
     * @var mixed expected holds the expected value
     */
    protected $expected;
    /**
     * @var mixed actual holds the actual value
     */
    protected $actual;
    /**
     * @var mixed arguments holds the arguments for the function call
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
        $this->object = $this->getMockForAbstractClass('BasicAgency', array($databaseConnection));
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

    /** testExecute
     *
     * @covers BasicAgency::execute
     *
     * @return void
     */
    public function testExecute()
    {
        $this->expected = true;
        $this->actual = $this->object->execute();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testAcceptArgumentsDataPackage
     *
     * @covers BasicAgency::acceptArgumentsDataPackage
     *
     * @return void
     */
    public function testAcceptArgumentsDataPackage()
    {
        $this->expected = true;
        $this->arguments = new dataPackage();
        $this->arguments->setQueryArguments(array("where"=>"id gt 100","groupBy"=>"create_date"));
        $this->actual = $this->object->acceptArgumentsDataPackage($this->arguments);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetAcceptableVars
     *
     * @covers BasicAgency::setAcceptableVars
     *
     * @return void
     */
    public function testSetAcceptableVars()
    {
        $this->expected = true;
        $this->arguments = array("id","first_name","last_name");
        $this->actual = $this->object->setAcceptableVars($this->arguments);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetAcceptableVars
     *
     * @covers BasicAgency::getAcceptableVars
     *
     * @return void
     */
    public function testGetAcceptableVars()
    {
        $this->expected = array("id","first_name","last_name");
        $this->arguments = array("id","first_name","last_name");
        $this->object->setAcceptableVars($this->arguments);
        $this->actual = $this->object->getAcceptableVars();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testCheckVariable
     *
     * @covers BasicAgency::checkVariable
     *
     * @return void
     */
    public function testCheckVariable()
    {
        $this->expected = true;
        $this->actual = $this->object->checkVariable("where");
        $this->assertEquals($this->expected, $this->actual);
    }
}