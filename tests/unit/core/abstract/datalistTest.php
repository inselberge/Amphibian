cd P<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_CORE_ABSTRACT . "DataList.php";
/**
 * Class DataListTest
 *
 * @category UnitTestCoreAbstract
 * @package  DataList
 * @author   Carl "Tex" Morgan <texmorgan@amphibian.co>
 * @license  GPL v2
 * @link     documentation/DataListTest
 *
 */
class DataListTest
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
        $this->object = $this->getMockForAbstractClass('DataList');
    }

    /** testSetClass
     *
     * @param string $value          the HTML class value
     * @param bool   $expectedResult true = success; false = failure
     * 
     * @covers DataList::setClass
     *
     * @return void
     */
    public function testSetClass($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setClass($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetHtml
     *
     * @param string $expectedResult the HTML string built by the other functions
     *
     * @covers DataList::getHtml
     *
     * @return void
     */
    public function testGetHtml($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getHTML();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetId
     *
     * @param string $value          the HTML id value
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers DataList::setId
     *
     * @return void
     */
    public function testSetId($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setId($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetTitle
     *
     * @param string $value          the HTML title value
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers DataList::setTitle
     *
     * @return void
     */
    public function testSetTitle($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setTitle($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetPlaceholder
     *
     * @param string $value          the HTML placeholder value
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers DataList::setPlaceholder
     *
     * @return void
     */
    public function testSetPlaceholder($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setPlaceholder($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetLabelFields
     *
     * @param string $value          the fields to add HTML labels to
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers DataList::setLabelFields
     *
     * @return void
     */
    public function testSetLabelFields($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setLabelFields($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetName
     *
     * @param string $value          the HTML name value
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers DataList::setName
     *
     * @return void
     */
    public function testSetName($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setName($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetLabel
     *
     * @param string $value          the HTML label value
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers DataList::setLabel
     *
     * @return void
     */
    public function testSetLabel($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setLabel($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetQuery
     *
     * @param string $value          the query value
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers DataList::setQuery
     *
     * @return void
     */
    public function testSetQuery($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setQuery($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetQuery
     *
     * @param string $expectedResult the value of the query string
     *
     * @covers DataList::getQuery
     *
     * @return void
     */
    public function testGetQuery($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getQuery();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetValueField
     *
     * @param string $value          the database field value
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers DataList::setValueField
     *
     * @return void
     */
    public function testSetValueField($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setValueField($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetValueField
     *
     * @param string $expectedResult the expected string value of the value field
     *
     * @covers DataList::getValueField
     *
     * @return void
     */
    public function testGetValueField($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getValueField();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetSeparatorFields
     *
     * @param string $value          the separator value
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers DataList::setSeparatorFields
     *
     * @return void
     */
    public function testSetSeparatorFields($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setSeparatorFields($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testExecute
     *
     * @param bool $expectedResult true = success; false = failure
     * 
     * @covers DataList::execute
     *
     * @return void
     */
    public function testExecute($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->execute();
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testShowHTML
     * 
     * @covers DataList::showHTML
     * 
     * @return void
     */
    public function testShowHTML()
    {
        $this->expected = null;
        $this->actual = $this->object->showHTML();
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testWrite
     * 
     * @param string $value          the file to write
     * @param bool   $expectedResult true = success; false = failure
     * 
     * @covers DataList::write
     * 
     * @return void
     */
    public function testWrite($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->write($value);
        $this->assertEquals($this->expected, $this->actual);
    }
}
