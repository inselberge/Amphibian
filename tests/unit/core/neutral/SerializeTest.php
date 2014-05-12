<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_CORE_NEUTRAL."Serialize.php";
/**
 * Class SerializeTest
 *
 * @category ${NAMESPACE}
 * @package  SerializeTest
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  GPL v2
 * @link     documentation/SerializeTest
 */
class SerializeTest
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
        $this->object = Serialize::factory();
    }

    /** testInstance
     *
     * @covers Serialize::instance
     *
     * @return void
     */
    public function testInstance()
    {
        $this->expected = $this->object;
        $this->actual = Serialize::instance();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testFactory
     *
     * @covers Serialize::factory
     *
     * @return void
     */
    public function testFactory()
    {
        $this->expected = $this->object;
        $this->actual = Serialize::factory();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetDirection
     *
     * @param bool $value          the direction value
     * @param bool $expectedResult true = success; false = failure
     *
     * @covers Serialize::setDirection
     *
     * @return void
     */
    public function testSetDirection($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setDirection($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetDirection
     *
     * @param mixed $expectedResult the expected return
     *
     * @covers Serialize::getDirection
     *
     * @return void
     */
    public function testGetDirection($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getDirection();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetData
     *
     * @param array $value          the data array value
     * @param bool  $expectedResult true = success; false = failure
     *
     * @covers Serialize::setData
     *
     * @return void
     */
    public function testSetData($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setData($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testAppendData
     *
     * @param array $value          the append data array value
     * @param bool  $expectedResult true = success; false = failure
     *
     * @covers Serialize::appendData
     *
     * @return void
     */
    public function testAppendData($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->appendData($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetData
     *
     * @param mixed $expectedResult the expected return
     *
     * @covers Serialize::getData
     *
     * @return void
     */
    public function testGetData($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getData();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testExecute
     *
     * @param mixed $expectedResult the expected return
     *
     * @covers Serialize::execute
     *
     * @return void
     */
    public function testExecute($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->execute();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetOutput
     *
     * @param mixed $expectedResult the expected return
     *
     * @covers Serialize::getOutput
     *
     * @return void
     */
    public function testGetOutput($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getOutput();
        $this->assertEquals($this->expected, $this->actual);
    }
}
