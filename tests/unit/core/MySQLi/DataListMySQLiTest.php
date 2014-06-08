<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_CORE."DataListMySQLi.php";

/**
 * Class DataListMySQLiTest
 *
 * @category UnitTests
 * @package  DataListMySQLiTest
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  GPL v3
 * @link     http://amphibian.co/documentation/DataListMySQLiTest
 */
class DataListMySQLiTest
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
        $this->arguments = DatabaseConnectionMySQLi::factory();
        $this->object = DataListMySQLi::factory($this->arguments);
    }

    /** testInstance
     *
     * @covers DataListMySQLi::instance
     *
     * @return void
     */
    public function testInstance()
    {
        $this->expected = $this->object;
        $this->actual = DataListMySQLi::instance($this->arguments);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testFactory
     *
     * @covers DataListMySQLi::factory
     *
     * @return void
     */
    public function testFactory()
    {
        $this->expected = $this->object;
        $this->actual = DataListMySQLi::factory($this->arguments);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetQuery
     *
     * @param string $query          the MySQL query to use
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers DataListMySQLi::setQuery
     *
     * @dataProvider queryDataProvider
     *
     * @return void
     */
    public function testSetQuery($query, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setQuery($query);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** queryDataProvider
     *
     * @return array
     */
    public function queryDataProvider()
    {
        return array(
            array("", false),
            array("SELECT * FROM Users", true)
        );
    }
}
