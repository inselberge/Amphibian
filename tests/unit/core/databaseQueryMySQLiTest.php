<?php

require_once __DIR__ . DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."../../config/config.inc.php";
require_once __DIR__."/../baseTest.php";
require_once AMPHIBIAN_CORE . "databaseQueryMySQLi.php";
/**
 * Class databaseQueryMySQLiTest
 *
 * @category Test
 * @package  DatabaseQueryMySQLi
 * @author   Carl "Tex" Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/databaseQueryMySQLiTest
 *
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-09-08 at 17:05:31.
 *
 */
class databaseQueryMySQLiTest 
    extends BaseTest
{
    /** setUp
     *
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @param resource $databaseConnection a valid database connection
     *
     * @return void
     */
    protected function setUp($databaseConnection)
    {
        $this->object = databaseQueryMySQLi::instance($databaseConnection);
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

    /** testInstance
     *
     * @param resource $databaseConnection a valid database connection
     *
     * @covers databaseQueryMySQLi::instance
     *
     * @return void
     */
    public function testInstance($databaseConnection)
    {
        $this->expected = $this->object;
        $this->actual = databaseQueryMySQLi::instance($databaseConnection);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** MySQLQueryDataProvider
     *
     * @return void
     */
    public function MySQLQueryDataProvider()
    {
        return array();
    }

    /** testExecute
     *
     * @param string $queryString a valid MySQL Query
     *
     * @covers databaseQueryMySQLi::execute
     *
     * @dataProvider MySQLQueryDataProvider
     *
     * @return void
     */
    public function testExecute($queryString)
    {
        $this->expected = true;
        $this->actual = $this->object->execute($queryString);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testClean
     *
     * @param string $queryString a valid MySQL Query
     *
     * @covers databaseQueryMySQLi::clean
     *
     * @dataProvider MySQLQueryDataProvider
     *
     * @return void
     */
    public function testClean($queryString)
    {
        $this->expected = $queryString;
        $this->actual = $this->object->clean($queryString);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testCommit
     *
     * @covers databaseQueryMySQLi::commit
     *
     * @return void
     */
    public function testCommit()
    {
        $this->expected = true;
        $this->actual = $this->object->commit();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetArray
     *
     * @covers databaseQueryMySQLi::getArray
     *
     * @return void
     */
    public function testGetArray()
    {
        $this->expected = array();
        $this->actual = $this->object->getArray();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetRow
     *
     * @covers databaseQueryMySQLi::getRow
     *
     * @return void
     */
    public function testGetRow()
    {
        $this->expected = array();
        $this->actual = $this->object->getRow();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testFree
     *
     * @covers databaseQueryMySQLi::free
     *
     * @return void
     */
    public function testFree()
    {
        $this->expected = null;
        $this->actual = $this->object->free();
        $this->assertEquals($this->expected, $this->actual);
    }
}
