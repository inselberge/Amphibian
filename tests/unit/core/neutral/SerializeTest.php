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
     * @dataProvider setDirectionDataProvider
     *
     * @return void
     */
    public function testSetDirection($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setDirection($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    public function setDirectionDataProvider()
    {
        return array(
            array(true, true),
            array(false, true),
            array(null, false)
        );
    }

    /** testGetDirection
     *
     * @param mixed $expectedResult the expected return
     *
     * @covers Serialize::getDirection
     *
     * @dataProvider getDirectionDataProvider
     *
     * @return void
     */
    public function testGetDirection($value, $expectedResult)
    {
        $this->object->setDirection($value);
        $this->expected = $expectedResult;
        $this->actual = $this->object->getDirection();
        $this->assertEquals($this->expected, $this->actual);
    }

    public function getDirectionDataProvider()
    {
        return array(
            array(true, true),
            array(false, false),
            array(null, true)
        );
    }

    /** testSetData
     *
     * @param array $value          the data array value
     * @param bool  $expectedResult true = success; false = failure
     *
     * @covers Serialize::setData
     *
     * @dataProvider setDataDataProvider
     *
     * @return void
     */
    public function testSetData($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setData($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    public function setDataDataProvider()
    {
        return array(
            array(true, false),
            array(array(), true),
            array(null, false)
        );
    }

    /** testAppendData
     *
     * @param array $value          the append data array value
     * @param bool  $expectedResult true = success; false = failure
     *
     * @covers Serialize::appendData
     *
     * @dataProvider appendDataDataProvider
     *
     * @return void
     */
    public function testAppendData($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->appendData($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    public function appendDataDataProvider()
    {
        return array(
            array(true, true),
            array(array(), true),
            array(null, false)
        );
    }

    /** testGetData
     *
     * @param mixed $expectedResult the expected return
     *
     * @covers Serialize::getData
     *
     * @dataProvider getDataDataProvider
     *
     * @return void
     */
    public function testGetData($value, $expectedResult)
    {
        $this->object->setData($value);
        $this->expected = $expectedResult;
        $this->actual = $this->object->getData();
        $this->assertEquals($this->expected, $this->actual);
    }

    public function getDataDataProvider()
    {
        return array(
            array(array(), array()),
            array(null,null)
        );
    }

    /** testExecute
     *
     * @param mixed $expectedResult the expected return
     *
     * @covers Serialize::execute
     *
     * @dataProvider executeDataProvider
     *
     * @return void
     */
    public function testExecute($direction, $data, $expectedResult)
    {
        $this->object->setDirection($direction);
        $this->object->setData($data);
        $this->expected = $expectedResult;
        $this->actual = $this->object->execute();
        $this->assertEquals($this->expected, $this->actual);
    }

    public function executeDataProvider()
    {
        return array(
            array(true, array(), true),
            array(false, array(), true),
            array(null, null, false)
        );
    }

    /** testGetOutput
     *
     * @param mixed $expectedResult the expected return
     *
     * @covers Serialize::getOutput
     *
     * @dataProvider getOutputDataProvider
     *
     * @return void
     */
    public function testGetOutput($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getOutput();
        $this->assertEquals($this->expected, $this->actual);
    }

    public function getOutputDataProvider()
    {
        return array(
            array(false)
        );
    }
}
