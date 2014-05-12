<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_CORE_NEUTRAL."XML.php";
/**
 * Class XMLTest
 *
 * @category UnitTestCoreNeutral
 * @package  XMLTest
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  GPL v2
 * @link     documentation/XMLTest
 */
class XMLTest
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
        $this->object = XML::factory();
    }

    /** testInstance
     *
     * @covers XML::instance
     *
     * @return void
     */
    public function testInstance()
    {
        $this->expected = $this->object;
        $this->actual = XML::instance();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testFactory
     *
     * @covers XML::factory
     *
     * @return void
     */
    public function testFactory()
    {
        $this->expected = $this->object;
        $this->actual = XML::factory();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetReadOrWrite
     *
     * @param string $value          the read or write value
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers XML::setReadOrWrite
     *
     * @return void
     */
    public function testSetReadOrWrite($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setReadOrWrite($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetReadOrWrite
     *
     * @param mixed $expectedResult the expected return
     *
     * @covers XML::getReadOrWrite
     *
     * @return void
     */
    public function testGetReadOrWrite($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getReadOrWrite();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetFileHandle
     *
     * @param string $value          the fileHandle value
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers XML::setFileHandle
     *
     * @return void
     */
    public function testSetFileHandle($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setFileHandle($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetFileHandle
     *
     * @param mixed $expectedResult the expected return
     *
     * @covers XML::getFileHandle
     *
     * @return void
     */
    public function testGetFileHandle($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getFileHandle();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetCharset
     *
     * @param string $value          the character set value
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers XML::setCharset
     *
     * @return void
     */
    public function testSetCharset($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setCharset($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetCharset
     *
     * @param mixed $expectedResult the expected return
     *
     * @covers XML::getCharset
     *
     * @return void
     */
    public function testGetCharset($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getCharset();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetDataArray
     *
     * @param array $value          the data array value
     * @param bool  $expectedResult true = success; false = failure
     *
     * @covers XML::setDataArray
     *
     * @return void
     */
    public function testSetDataArray($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setDataArray($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetDataArray
     *
     * @param mixed $expectedResult the expected return
     *
     * @covers XML::getDataArray
     *
     * @return void
     */
    public function testGetDataArray($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getDataArray();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetTableColumns
     *
     * @param string $value          the table columns values
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers XML::setTableColumns
     *
     * @return void
     */
    public function testSetTableColumns($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setTableColumns($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetTableName
     *
     * @param string $value          the table name value
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers XML::setTableName
     *
     * @return void
     */
    public function testSetTableName($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setTableName($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetBuffer
     *
     * @param mixed $expectedResult the expected return
     *
     * @covers XML::getBuffer
     *
     * @return void
     */
    public function testGetBuffer($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getBuffer();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetVersion
     *
     * @param string $value          the version value
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers XML::setVersion
     *
     * @return void
     */
    public function testSetVersion($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setVersion($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetVersion
     *
     * @param mixed $expectedResult the expected return
     *
     * @covers XML::getVersion
     *
     * @return void
     */
    public function testGetVersion($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getVersion();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testExecute
     *
     * @param mixed $expectedResult the expected return
     *
     * @covers XML::execute
     *
     * @return void
     */
    public function testExecute($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->execute();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testWrite
     *
     * @param string $value          the data to write value
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers XML::write
     *
     * @return void
     */
    public function testWrite($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->write($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testPrintXML
     *
     * @param mixed $expectedResult the expected return
     *
     * @covers XML::printXML
     *
     * @return void
     */
    public function testPrintXML($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->printXML();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testRead
     *
     * @param mixed $value          the read data source
     * @param bool  $expectedResult true = success; false = failure
     *
     * @covers XML::read
     *
     * @return void
     */
    public function testRead($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->read($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testCheck
     *
     * @param string $value          the value to check in the object
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers XML::check
     *
     * @return void
     */
    public function testCheck($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->check($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testShow
     *
     * @covers XML::show
     *
     * @return void
     */
    public function testShow()
    {
        $this->expected = null;
        $this->actual = $this->object->show();
        $this->assertEquals($this->expected, $this->actual);
    }
}
