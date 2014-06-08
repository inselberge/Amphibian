<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_CORE."DropDownMySQLi.php";

/**
 * Class DropDownMySQLiTest
 *
 * @category ${NAMESPACE}
 * @package  DropDownMySQLiTest
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license
 * @link
 */
class DropDownMySQLiTest
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
        $this->object = DropDownMySQLi::factory($this->arguments);
    }

    /** testInstance
     *
     * @covers DropDownMySQLi::instance
     *
     * @return void
     */
    public function testInstance()
    {
        $this->expected = $this->object;
        $this->actual = DropDownMySQLi::instance($this->arguments);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testFactory
     *
     * @covers DropDownMySQLi::factory
     *
     * @return void
     */
    public function testFactory()
    {
        $this->expected = $this->object;
        $this->actual = DropDownMySQLi::factory($this->arguments);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetQuery
     *
     * @param string $query          the MySQL query to run
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers DropDownMySQLi::setQuery
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
