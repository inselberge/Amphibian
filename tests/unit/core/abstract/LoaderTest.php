<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_CORE_ABSTRACT . "Loader.php";
/**
 * Class LoaderTest
 *
 * @category UnitTestCoreAbstract
 * @package  Loader
 * @author   Carl "Tex" Morgan <texmorgan@amphibian.co>
 * @license  GPL v2
 * @link     documentation/LoaderTest
 *
 */
class LoaderTest
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
        $this->object = $this->getMockForAbstractClass('Loader');
    }

    /** testSet
     *
     * @param string $key            the index to set
     * @param mixed  $value          the value to set the index
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers Loader::set
     *
     * @dataProvider setDataProvider
     *
     * @return void
     */
    public function testSet($key, $value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->set($key, $value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** setDataProvider
     *
     * @return array
     */
    public function setDataProvider()
    {
        return array(
            array("possibleFiles", array(), true),
            array("declared", array(), true),
            array("searchLocations", array(), true),
            array("currentLocation", null, true),
            array("selectedFile", null, true),
            array("possibleClass", null, true),
            array("locationDecoration", array(), true),
            array("decoratedClass", null, true),
            array("class", null, true),
            array("method", null, true)
        );
    }

    /** testGet
     *
     * @param string $key            the index to get
     * @param mixed  $expectedResult the expected value of the index
     *
     * @covers Loader::get
     *
     * @dataProvider getDataProvider
     *
     * @return void
     */
    public function testGet($key, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->get($key);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** getDataProvider
     *
     * @return array
     */
    public function getDataProvider()
    {
        return array(
            array("possibleFiles", array()),
            array("declared", array()),
            array("searchLocations", array()),
            array("currentLocation", null),
            array("selectedFile", null),
            array("possibleClass", null),
            array("locationDecoration", array()),
            array("decoratedClass", null),
            array("class", null),
            array("method", null)
        );
    }

    /** testExecute
     *
     * @param bool $expectedResult true = success; false = failure
     *
     * @covers Loader::execute
     *
     * @return void
     */
    public function testExecute($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->execute();
        $this->assertEquals($this->expected, $this->actual);
    }
}
