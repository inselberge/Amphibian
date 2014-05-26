<?php
require_once __DIR__ . DIRECTORY_SEPARATOR
    . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_CORE_MYSQLI."TableBuilderMySQLi.php";
/**
 * Class TableBuilderTest
 *
 * @category Test
 * @package  TableBuilder
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  GPL v3
 * @link     documentation/TableBuilderTest
 *
 */
class TableBuilderTest 
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
        $this->object = TableBuilderMySQLi::instance("testTable");
    }


    /** testSetOption
     *
     * @param string $key            the option name
     * @param mixed  $value          the value to assign
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers TableBuilder::setOption
     *
     * @return void
     */
    public function testSetOption($key, $value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setOption($key, $value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testPrintHead
     *
     * @param bool $expectedResult the expected result
     *
     * @covers TableBuilder::printHead
     *
     * @return void
     */
    public function testPrintHead($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->printHead();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testPrintBody
     *
     * @param bool $expectedResult the expected result
     *
     * @covers TableBuilder::printBody
     *
     * @return void
     */
    public function testPrintBody($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->printBody();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testPrintFoot
     *
     * @param bool $expectedResult the expected result
     *
     * @covers TableBuilder::printFoot
     *
     * @return void
     */
    public function testPrintFoot($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->printFoot();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testPrintStartTable
     *
     * @param bool $expectedResult the expected result
     *
     * @covers TableBuilder::printStartTable
     *
     * @return void
     */
    public function testPrintStartTable($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->printStartTable();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testPrintEndTable
     *
     * @param bool $expectedResult the expected result
     *
     * @covers TableBuilder::printEndTable
     *
     * @return void
     */
    public function testPrintEndTable($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->printEndTable();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testPrintStartBody
     *
     * @param bool $expectedResult the expected result
     *
     * @covers TableBuilder::printStartBody
     *
     * @return void
     */
    public function testPrintStartBody($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->printStartBody();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testPrintEndBody
     *
     * @param bool $expectedResult the expected result
     *
     * @covers TableBuilder::printEndBody
     *
     * @return void
     */
    public function testPrintEndBody($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->printEndBody();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testPrintPager
     *
     * @param bool $expectedResult the expected result
     *
     * @covers TableBuilder::printPager
     *
     * @return void
     */
    public function testPrintPager($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->printPager();
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testPrintScripts
     *
     * @param bool $expectedResult the expected result
     *
     * @covers TableBuilder::printScripts
     *
     * @return void
     */
    public function testPrintScripts($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->printScripts();
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testPrintCSS
     *
     * @param bool $expectedResult the expected result
     *
     * @covers TableBuilder::printCSS
     *
     * @return void
     */
    public function testPrintCSS($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->printCSS();
        $this->assertEquals($this->expected, $this->actual);
    }
}
