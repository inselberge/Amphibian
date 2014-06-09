<?php
require_once __DIR__ . DIRECTORY_SEPARATOR
    . ".." . DIRECTORY_SEPARATOR
    . ".." . DIRECTORY_SEPARATOR
    . "baseTest.php";
require_once AMPHIBIAN_CORE_NEUTRAL."APIRequest.php";
/**
 * Class APIRequestTest
 *
 * @category UnitTestsCoreNeutral
 * @package  APIRequestTest
 * @author   Carl "Tex" Morgan <texmorgan@amphibian.co>
 * @license  GPL v3
 * @link     documentation/APIRequestTest
 */
class APIRequestTest 
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
        $this->object = APIRequest::factory();
    }

    /** testInstance
     *
     * @covers APIRequest::instance
     *
     * @return void
     */
    public function testInstance()
    {
        $this->expected = $this->object;
        $this->actual = APIRequest::instance();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testFactory
     *
     * @covers APIRequest::factory
     *
     * @return void
     */
    public function testFactory()
    {
        $this->expected = $this->object;
        $this->actual = APIRequest::factory();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetAction
     *
     * @param string $value          the action to use
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers APIRequest::setAction
     *
     * @return void
     */
    public function testSetAction($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setAction($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetAction
     *
     * @param string $expectedResult the expected return of the function call
     *
     * @covers APIRequest::getAction
     *
     * @return void
     */
    public function testGetAction($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getAction();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetApplication
     *
     * @param string $value          the application to use
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers APIRequest::setApplication
     *
     * @return void
     */
    public function testSetApplication($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setApplication($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetApplication
     *
     * @param string $expectedResult the expected value of application
     *
     * @covers APIRequest::getApplication
     *
     * @return void
     */
    public function testGetApplication($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getAction();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetArguments
     *
     * @param string $value          the arguments to use
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers APIRequest::setArguments
     *
     * @return void
     */
    public function testSetArguments($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setArguments($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetArguments
     *
     * @param string $expectedResult the expected value of arguments
     *
     * @covers APIRequest::getArguments
     *
     * @return void
     */
    public function testGetArguments($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getArguments();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetBranch
     *
     * @param string $value          the branch to use
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers APIRequest::setBranch
     *
     * @return void
     */
    public function testSetBranch($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setBranch($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetBranch
     *
     * @param string $expectedResult the expected value of branch
     *
     * @covers APIRequest::getBranch
     *
     * @return void
     */
    public function testGetBranch($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getBranch();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetKey
     *
     * @param string $value          the API Key to use
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers APIRequest::setKey
     *
     * @return void
     */
    public function testSetKey($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setKey($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetKey
     *
     * @param string $expectedResult the expected value of the key
     *
     * @covers APIRequest::getKey
     *
     * @return void
     */
    public function testGetKey($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getKey();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetType
     *
     * @param string $value          the model or agency to use
     * @param bool   $expectedResult true = success;false = failure
     *
     * @covers APIRequest::setType
     *
     * @return void
     */
    public function testSetType($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setType($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetType
     *
     * @param string $expectedResult the expected value of type
     *
     * @covers APIRequest::getType
     *
     * @return void
     */
    public function testGetType($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getType();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetTimestamp
     *
     * @param float $value          the value of timestamp to use
     * @param bool  $expectedResult true = success;false = failure
     *
     * @covers APIRequest::setTimestamp
     *
     * @return void
     */
    public function testSetTimestamp($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setTimestamp($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetTimestamp
     *
     * @param float $expectedResult the expected value of timestamp
     *
     * @covers APIRequest::getTimestamp
     *
     * @return void
     */
    public function testGetTimestamp($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getTimestamp();
        $this->assertEquals($this->expected, $this->actual);
    }
}
