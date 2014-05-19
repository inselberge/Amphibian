<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_CORE_ABSTRACT . "Header.php";
/**
 * Class HeaderTest
 *
 * @category UnitTestCoreAbstract
 * @package  HeaderTest
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  GPL v2
 * @link     documentation/HeaderTest
 */
class HeaderTest
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
        $this->object = $this->getMockForAbstractClass('Header');
    }


    /** testExtractHeaderArray
     *
     * @param bool $expectedResult true = success; false = failure
     *
     * @covers Header::extractHeaderArray
     *
     * @return void
     */
    public function testExtractHeaderArray($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->extractHeaderArray();
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testGetCount
     *
     * @param int $expectedResult the number of headers in the header array
     *
     * @covers Header::getCount
     *
     * @return void
     */
    public function testGetCount($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getCount();
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testCheckCount
     *
     * @param bool $expectedResult true = success; false = failure
     *
     * @covers Header::checkCount
     *
     * @return void
     */
    public function testCheckCount($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->checkCount();
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testGetHeaderArray
     *
     * @param array $expectedResult the expected header array
     *
     * @covers Header::getHeaderArray
     *
     * @return void
     */
    public function testGetHeaderArray($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getHeaderArray();
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testRemove
     *
     * @param string $header         an index in the header array
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers Header::remove
     *
     * @return void
     */
    public function testRemove($header, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->remove($header);
        $this->assertEquals($this->expected, $this->actual);
    }


    /** test__isset
     *
     * @param string $index          the index in the header array
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers Header::__isset
     *
     * @return void
     */
    public function test__isset($index, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->__isset($index);
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testSent
     *
     * @param string $file           the file to use
     * @param int    $line           the line number in the file
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers Header::sent
     *
     * @return void
     */
    public function testSent($file, $line, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->sent($file, $line);
        $this->assertEquals($this->expected, $this->actual);
    }
}
