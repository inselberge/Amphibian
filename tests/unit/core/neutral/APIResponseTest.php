<?php

require_once __DIR__ . DIRECTORY_SEPARATOR
    . ".." . DIRECTORY_SEPARATOR
    . ".." . DIRECTORY_SEPARATOR
    . "baseTest.php";
require_once AMPHIBIAN_CORE_NEUTRAL."APIResponse.php";
/**
 * Class APIResponseTest
 *
 * @category UnitTestsCoreNeutral
 * @package  APIResponseTest
 * @author   Carl "Tex" Morgan <texmorgan@amphibian.co>
 * @license  GPL v3
 * @link     documentation/APIResponseTest
 */
class APIResponseTest 
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
        $this->object = APIResponse::factory();
    }

    /** testInstance
     *
     * @covers APIResponse::instance
     *
     * @return void
     */
    public function testInstance()
    {
        $this->expected = $this->object;
        $this->actual = APIResponse::instance();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testFactory
     *
     * @covers APIResponse::factory
     *
     * @return void
     */
    public function testFactory()
    {
        $this->expected = $this->object;
        $this->actual = APIResponse::factory();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetApplication
     *
     * @param string $value          the application to use
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers APIResponse::setApplication
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
     * @covers APIResponse::getApplication
     *
     * @return void
     */
    public function testGetApplication($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getAction();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetKey
     *
     * @param string $value          the API Key to use
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers APIResponse::setKey
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
     * @covers APIResponse::getKey
     *
     * @return void
     */
    public function testGetKey($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getKey();
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testSetPageSize
     *
     * @param int  $value          size of the page
     * @param bool $expectedResult true = success; false = failure
     *
     * @covers APIResponse::setPageSize
     *
     * @return void
     */
    public function testSetPageSize($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setPageSize($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetPageSize
     *
     * @param int $expectedResult the expected value of pageSize
     *
     * @covers APIResponse::getPageSize
     *
     * @return void
     */
    public function testGetPageSize($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getPageSize();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetPayload
     *
     * @param array $value          the payload to use
     * @param bool  $expectedResult true = success; false = failure
     *
     * @covers APIResponse::setPayload
     *
     * @return void
     */
    public function testSetPayload($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setPayload($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testAppendPayload
     *
     * @param array $value          the new data to use
     * @param bool  $expectedResult true = success; false = failure
     *
     * @covers APIResponse::appendPayload
     *
     * @return void
     */
    public function testAppendPayload($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->appendPayload($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetPayload
     *
     * @param array $expectedResult the expected value of payload
     *
     * @covers APIResponse::getPayload
     *
     * @return void
     */
    public function testGetPayload($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getPayload();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetPayloadSize
     *
     * @param int  $value          the size of the payload
     * @param bool $expectedResult true = success; false = failure
     *
     * @covers APIResponse::setPayloadSize
     *
     * @return void
     */
    public function testSetPayloadSize($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setPayloadSize($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetPayloadSize
     *
     * @param int $expectedResult the expected value of payloadSize
     *
     * @covers APIResponse::getPayloadSize
     *
     * @return void
     */
    public function testGetPayloadSize($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getPayloadSize();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetSuccess
     *
     * @param bool $value          true = data; false = error data
     * @param bool $expectedResult true = success; false = failure
     *
     * @covers APIResponse::setSuccess
     *
     * @return void
     */
    public function testSetSuccess($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setSuccess($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetSuccess
     *
     * @param bool $expectedResult the expected value of success
     *
     * @covers APIResponse::getSuccess
     *
     * @return void
     */
    public function testGetSuccess($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getSuccess();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetTimestamp
     *
     * @param float $value          the value of timestamp to use
     * @param bool  $expectedResult true = success;false = failure
     *
     * @covers APIResponse::setTimestamp
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
     * @covers APIResponse::getTimestamp
     *
     * @return void
     */
    public function testGetTimestamp($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getTimestamp();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetType
     *
     * @param string $value          the model or agency to use
     * @param bool   $expectedResult true = success;false = failure
     *
     * @covers APIResponse::setType
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
     * @covers APIResponse::getType
     *
     * @return void
     */
    public function testGetType($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getType();
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testExecute
     *
     * @param mixed $expectedResult the expected response
     *
     * @covers APIResponse::execute
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
