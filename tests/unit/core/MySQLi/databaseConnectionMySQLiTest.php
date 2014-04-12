<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_CORE_MYSQLI . "databaseConnectionMySQLi.php";
/**
 * Class DatabaseConnectionMySQLiTest
 *
 * @category Test
 * @package  DatabaseConnectionMySQLi
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/DatabaseConnectionMySQLiTest
 *
 */
class DatabaseConnectionMySQLiTest
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
        $this->object = DatabaseConnectionMySQLi::instance();
    }

    /** testInstance
     *
     * @covers DatabaseConnectionMySQLi::instance
     */
    public function testInstance()
    {
        $this->expected = $this->object;
        $this->actual = DatabaseConnectionMySQLi::instance();
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testSet
     *
     * @param $key
     * @param $value
     * @param $expectedResult
     *
     * @covers DatabaseConnectionMySQLi::set
     */
    public function testSet($key, $value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->set($key,$value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetSSL
     *
     * @param $keyPath
     * @param $certificatePath
     * @param $authorityPath
     * @param $pemPath
     * @param $cipher
     * @param $expectedResult
     *
     * @covers DatabaseConnectionMySQLi::setSSL
     */
    public function testSetSSL($keyPath, $certificatePath, $authorityPath, $pemPath, $cipher, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setSSL($keyPath, $certificatePath, $authorityPath, $pemPath, $cipher);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testInit
     *
     * @param $expectedResult
     *
     * @covers DatabaseConnectionMySQLi::init
     */
    public function testInit($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->init();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetOptions
     *
     * @param $option
     * @param $value
     * @param $expectedResult
     *
     * @covers DatabaseConnectionMySQLi::setOptions
     */
    public function testSetOptions($option, $value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setOptions($option, $value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testOpenConnection
     *
     * @param $expectedResult
     *
     * @covers DatabaseConnectionMySQLi::openConnection
     */
    public function testOpenConnection($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->openConnection();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testOpenConnectionSSL
     *
     * @param $expectedResult
     *
     * @covers DatabaseConnectionMySQLi::openConnectionSSL
     */
    public function testOpenConnectionSSL($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->openConnectionSSL();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testPing
     *
     * @param $expectedResult
     *
     * @covers DatabaseConnectionMySQLi::ping
     */
    public function testPing($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->ping();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testPrintError
     *
     * @param $expectedResult
     *
     * @covers DatabaseConnectionMySQLi::printError
     */
    public function testPrintError($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->printError();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetCharacterSet
     *
     * @param $newCharacterSet
     * @param $expectedResult
     *
     * @covers DatabaseConnectionMySQLi::setCharacterSet
     */
    public function testSetCharacterSet($newCharacterSet, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setCharacterSet($newCharacterSet);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testPrintCharacterSet
     *
     * @param $expectedResult
     *
     * @covers DatabaseConnectionMySQLi::printCharacterSet
     */
    public function testPrintCharacterSet($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->printCharacterSet();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testPrintHostInfo
     *
     * @param $expectedResult
     *
     * @covers DatabaseConnectionMySQLi::printHostInfo
     */
    public function testPrintHostInfo($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->printHostInfo();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testCloseConnection
     *
     * @param $expectedResult
     *
     * @covers DatabaseConnectionMySQLi::closeConnection
     */
    public function testCloseConnection($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->closeConnection();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetTables
     *
     * @param $expectedResult
     *
     * @covers DatabaseConnectionMySQLi::getTables
     */
    public function testGetTables($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getTables();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetPrimaryKeys
     *
     * @param $expectedResult
     *
     * @covers DatabaseConnectionMySQLi::getPrimaryKeys
     */
    public function testGetPrimaryKeys($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getPrimaryKeys();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetViews
     *
     * @param $expectedResult
     *
     * @covers DatabaseConnectionMySQLi::getViews
     */
    public function testGetViews($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getViews();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testDescribeTable
     *
     * @param $table
     * @param $expectedResult
     *
     * @covers DatabaseConnectionMySQLi::describeTable
     */
    public function testDescribeTable($table, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->describeTable($table);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testShowKeysTable
     *
     * @param $table
     * @param $expectedResult
     *
     * @covers DatabaseConnectionMySQLi::showKeysTable
     */
    public function testShowKeysTable($table, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->showKeysTable($table);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetPrimaryKeysTable
     *
     * @param $table
     * @param $expectedResult
     *
     * @covers DatabaseConnectionMySQLi::getPrimaryKeysTable
     */
    public function testGetPrimaryKeysTable($table, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getPrimaryKeysTable($table);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetForeignKeysTable
     *
     * @param $table
     * @param $expectedResult
     *
     * @covers DatabaseConnectionMySQLi::getForeignKeysTable
     */
    public function testGetForeignKeysTable($table, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getForeignKeysTable($table);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetRequiredColumnsList
     *
     * @param $tableDescription
     * @param $expectedResult
     *
     * @covers DatabaseConnectionMySQLi::getRequiredColumnList
     */
    public function testGetRequiredColumnsList($tableDescription, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getRequiredColumnList($tableDescription);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetColumnList
     * @param $table
     * @param $expectedResult
     *
     * @covers DatabaseConnectionMySQLi::getColumnList
     */
    public function testGetColumnList($table, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getColumnList($table);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetAllColumnTypes
     *
     * @param $expectedResult
     *
     * @covers DatabaseConnectionMySQLi::getAllColumnTypes
     *
     * @dataProvider columnsTypeDataProvider
     */
    public function testGetAllColumnTypes($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getAllColumnTypes();
        $this->assertEquals($this->expected, $this->actual);
    }

    public function columnsTypeDataProvider() {
        return array(
            array(
                "int(10) unsigned",
                "varchar(128)",
                "char(32)",
                "enum('pending', 'enabled', 'disabled', 'retired')",
                "timestamp",
                "tinytext",
                "bigint(20) unsigned",
                "text",
                "bit(1)",
                "set('mindfulness', 'self-talk')",
                "enum('a', 'b')",
                "tinyint(3) unsigned",
                "enum('1', '2', '3', '4', '5')",
                "set('a', 'b')",
                "set('seeker', 'provider')",
                "tinyint(1) unsigned",
                "varchar(64)",
                "char(2)",
                "varchar(5)",
                "float(16, 12)",
                "int(11)",
                "varchar(255)",
                "varchar(32)",
                "enum('treatment', 'data', 'admin', 'user')",
                "int(20) unsigned"
            )
        );
    }


}