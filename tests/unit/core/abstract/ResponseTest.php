<?php

require_once __DIR__ . DIRECTORY_SEPARATOR
    . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_CORE_ABSTRACT . "Response.php";

/**
 * Class ResponseTest
 *
 * @category UnitTestsCoreAbstract
 * @package  ResponseTest
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  GPL v3
 * @link     documentation/ResponseTest
 */
class ResponseTest
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
        $this->object = $this->getMockForAbstractClass('Response');
    }


    /** testGetHttpVersion
     *
     * @param string $expectedResult the expected HTTP version
     *
     * @covers Response::getHttpVersion
     *
     * @return void
     */
    public function testGetHttpVersion($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getHttpVersion();
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testSetHttpVersion
     *
     * @param string $version        the HTTP version
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers Response::setHttpVersion
     *
     * @return void
     */
    public function testSetHttpVersion($version, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setHttpVersion($version);
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testGetStatus
     *
     * @param mixed $expectedResult the status
     *
     * @covers Response::getStatus
     *
     * @return void
     */
    public function testGetStatus($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getStatus();
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testSetStatus
     *
     * @param string $status         the status
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers Response::setStatus
     *
     * @return void
     */
    public function testSetStatus($status, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setStatus($status);
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testGetEntityHeader
     *
     * @param object $expectedResult a valid EntityHeader
     *
     * @covers Response::getEntityHeader
     *
     * @return void
     */
    public function testGetEntityHeader($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getEntityHeader();
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testSetEntityHeader
     *
     * @param object $header         a valid EntityHeader object
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers Response::setEntityHeader
     *
     * @return void
     */
    public function testSetEntityHeader($header, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setEntityHeader($header);
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testGetGeneralHeader
     *
     * @param object $expectedResult a GeneralHeader object
     *
     * @covers Response::getGeneralHeader
     *
     * @return void
     */
    public function testGetGeneralHeader($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getGeneralHeader();
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testSetGeneralHeader
     *
     * @param object $header         a GeneralHeader object
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers Response::setGeneralHeader
     *
     * @return void
     */
    public function testSetGeneralHeader($header, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setGeneralHeader($header);
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testGetPayload
     *
     * @param array $expectedResult the expected data or errors
     *
     * @covers Response::getPayload
     *
     * @return void
     */
    public function testGetPayload($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getPayload();
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testSetPayload
     *
     * @param array $payload        the data or errors
     * @param bool  $expectedResult true = success; false = failure
     *
     * @covers Response::setPayload
     *
     * @return void
     */
    public function testSetPayload($payload, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setPayload($payload);
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testGetResponseHeader
     *
     * @param object $expectedResult an ResponseHeader object
     *
     * @covers Response::getResponseHeader
     *
     * @return void
     */
    public function testGetResponseHeader($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getResponseHeader();
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testSetResponseHeader
     *
     * @param object $header         a response header
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers Response::setResponseHeader
     *
     * @return void
     */
    public function testSetResponseHeader($header, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setResponseHeader($header);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testExecute
     *
     * @param bool $expectedResult true = success; false = failure
     *
     * @covers Response::execute
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
