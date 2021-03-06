<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_CORE_ABSTRACT . "databaseQuery.php";

/**
 * Class databaseQueryTest
 *
 * @category Test
 * @package  DatabaseQuery
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     documentation/databaseQueryTest
 *
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-09-08 at 17:05:31.
 *
 */
class databaseQueryTest 
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
        $this->object = $this->getMockForAbstractClass('databaseQuery');
    }

    /** testShow
     *
     * @covers databaseQuery::show
     *
     * @return void
     */
    public function testShow()
    {
        $this->expected = null;
        $this->actual = $this->object->show();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testPrintRow
     *
     * @covers databaseQuery::printRow
     *
     * @return void
     */
    public function testPrintRow()
    {
        $this->expected = null;
        $this->actual = $this->object->printRow();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testPrintNumberOfRows
     *
     * @covers databaseQuery::printNumberOfRows
     *
     * @return void
     */
    public function testPrintNumberOfRows()
    {
        $this->expected = null;
        $this->actual = $this->object->printNumberOfRows();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testPrintAffectedRows
     *
     * @covers databaseQuery::printAffectedRows
     *
     * @return void
     */
    public function testPrintAffectedRows()
    {
        $this->expected = null;
        $this->actual = $this->object->printAffectedRows();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testPrintFieldCount
     *
     * @covers databaseQuery::printFieldCount
     *
     * @return void
     */
    public function testPrintFieldCount()
    {
        $this->expected = null;
        $this->actual = $this->object->printFieldCount();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testPrintArray
     *
     * @covers databaseQuery::printArray
     *
     * @return void
     */
    public function testPrintArray()
    {
        $this->expected = null;
        $this->actual = $this->object->printArray();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testPrintErrors
     *
     * @covers databaseQuery::printErrors
     *
     * @return void
     */
    public function testPrintErrors()
    {
        $this->expected = null;
        $this->actual = $this->object->printErrors();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testPrintWarnings
     *
     * @covers databaseQuery::printWarnings
     *
     * @return void
     */
    public function testPrintWarnings()
    {
        $this->expected = null;
        $this->actual = $this->object->printWarnings();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetAffectedRows
     *
     * @covers databaseQuery::getAffectedRows
     *
     * @return void
     */
    public function testGetAffectedRows()
    {
        $this->expected = 0;
        $this->actual = $this->object->getAffectedRows();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetErrors
     *
     * @covers databaseQuery::getErrors
     *
     * @return void
     */
    public function testGetErrors()
    {
        $this->expected = [];
        $this->actual = $this->object->getErrors();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetFieldCount
     *
     * @covers databaseQuery::getFieldCount
     *
     * @return void
     */
    public function testGetFieldCount()
    {
        $this->expected = 0;
        $this->actual = $this->object->getFieldCount();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetNumberOfRows
     *
     * @covers databaseQuery::getNumberOfRows
     *
     * @return void
     */
    public function testGetNumberOfRows()
    {
        $this->expected = 0;
        $this->actual = $this->object->getNumberOfRows();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetWarnings
     *
     * @covers databaseQuery::getWarnings
     *
     * @return void
     */
    public function testGetWarnings()
    {
        $this->expected = [];
        $this->actual = $this->object->getWarnings();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetWarningCount
     *
     * @covers databaseQuery::getWarningCount
     *
     * @return void
     */
    public function testGetWarningCount()
    {
        $this->expected = 0;
        $this->actual = $this->object->getWarningCount();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testCheckAffected
     *
     * @covers databaseQuery::checkAffected
     *
     * @return void
     */
    public function testCheckAffected()
    {
        $this->expected = false;
        $this->actual = $this->object->checkAffected();
        $this->assertEquals($this->expected, $this->actual);

        $this->expected = true;
        $this->object->affectedRows = 3;
        $this->actual = $this->object->checkAffected();
        $this->assertEquals($this->expected, $this->actual);
    }
}
