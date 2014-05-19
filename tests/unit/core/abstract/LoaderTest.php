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
     * @return void
     */
    public function testSet($key, $value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->set($key, $value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGet
     *
     * @param string $key            the index to get
     * @param mixed  $expectedResult the expected value of the index
     *
     * @covers Loader::get
     *
     * @return void
     */
    public function testGet($key, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->get($key);
        $this->assertEquals($this->expected, $this->actual);
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
