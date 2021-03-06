<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_CORE_MYSQLI . "databaseQueryMySQLi.php";
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
     * @return void
     */
    protected function setUp()
    {
        $this->connection = DatabaseConnectionMySQLi::instance();
        $this->connection->init();
        $this->connection->setServerName("127.0.0.1");
        $this->connection->setUserName("root");
        $this->connection->setUserPassword('4u$t1nTX');
        $this->connection->setDatabaseName('mysql');
        $this->connection->openConnection();
        $this->object = databaseQueryMySQLi::instance($this->connection);
    }

    /** testInstance
     *
     * @covers databaseQueryMySQLi::instance
     *
     * @return void
     */
    public function testInstance()
    {
        $this->expected = $this->object;
        $this->actual = databaseQueryMySQLi::instance($this->connection);
        $this->assertEquals($this->expected, $this->actual);
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

    public function MySQLQueryDataProvider()
    {
        return array(
            array("SELECT CURRENT_TIMESTAMP;"),
            array("SELECT NOW();")
        );
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

    /** testGetRow
     *
     * @covers databaseQueryMySQLi::getRow
     *
     * @return void
     */
    public function testGetRow()
    {
        $this->expected = true;
        $this->actual = $this->object->getRow();
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
        $this->expected = true;
        $this->actual = $this->object->getArray();
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
        $this->expected = true;
        $this->actual = $this->object->free();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testClearResults
     *
     * @covers databaseQueryMySQLi::clearResults
     *
     * @return void
     */
    public function testClearResults()
    {
        $this->expected = null;
        $this->actual = $this->object->clearResults();
        $this->assertEquals($this->expected, $this->actual);
    }
}
