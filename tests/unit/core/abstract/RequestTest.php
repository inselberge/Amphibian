<?php

require_once __DIR__ . DIRECTORY_SEPARATOR
    . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_CORE_ABSTRACT . "Request.php";
/**
 * Class RequestTest
 *
 * @category UnitTestsCoreAbstract
 * @package  RequestTest
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  GPL v3
 * @link     documentation/RequestTest
 */
class RequestTest
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
        $this->object = $this->getMockForAbstractClass("Request");
    }


    /** testInstance
     *
     * @covers Request::instance
     *
     * @return void
     */
    public function testInstance()
    {
        $this->expected = $this->object;
        $this->actual = Request::instance();
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testFactory
     *
     * @covers Request::factory
     *
     * @return void
     */
    public function testFactory()
    {
        $this->expected = $this->object;
        $this->actual = Request::factory();
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testGetEntityHeader
     *
     * @param object $expectedResult a valid EntityHeader object
     *
     * @covers Request::getEntityHeader
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
     * @covers Request::setEntityHeader
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
     * @param object $expectedResult a valid GeneralHeader object
     *
     * @covers Request::getGeneralHeader
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
     * @param object $header         a valid GeneralHeader object
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers Request::setGeneralHeader
     *
     * @return void
     */
    public function testSetGeneralHeader($header, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setGeneralHeader($header);
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testGetHttpVersion
     *
     * @param string $expectedResult the HTTP version
     *
     * @covers Request::getHttpVersion
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
     * @param string $version        the version of HTTP
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers Request::setHttpVersion
     *
     * @return void
     */
    public function testSetHttpVersion($version, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setHttpVersion($version);
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testGetMessageBody
     *
     * @param string $expectedResult the text to make up the message body
     *
     * @covers Request::getMessageBody
     *
     * @return void
     */
    public function testGetMessageBody($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getMessageBody();
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testSetMessageBody
     *
     * @param string $messageBody    the text to make up the message body
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers Request::setMessageBody
     *
     * @return void
     */
    public function testSetMessageBody($messageBody, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setMessageBody($messageBody);
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testGetRequestHeader
     *
     * @param object $expectedResult a valid RequestHeader object
     *
     * @return void
     */
    public function testGetRequestHeader($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getRequestHeader();
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testSetRequestHeader
     *
     * @param object $header         a valid RequestHeader object
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers Request::setRequestHeader
     *
     * @return void
     */
    public function testSetRequestHeader($header, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setRequestHeader($header);
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testGetRequestLine
     *
     * @param string $expectedResult the request line
     *
     * @covers Request::getRequestLine
     *
     * @return void
     */
    public function testGetRequestLine($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getRequestLine();
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testSetRequestLine
     *
     * @param string $line           the request line
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers Request::setRequestLine
     *
     * @return void
     */
    public function testSetRequestLine($line, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setRequestLine($line);
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testGetRequestMethod
     *
     * @param string $expectedResult the Request Method
     *
     * @return void
     */
    public function testGetRequestMethod($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getRequestMethod();
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testSetRequestMethod
     *
     * @param string $method         the Request Method
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers Request::setRequestMethod
     *
     * @return void
     */
    public function testSetRequestMethod($method, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setRequestMethod($method);
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testGetRequestURI
     *
     * @param string $expectedResult the Request URI
     *
     * @covers Request::getRequestURI
     *
     * @return void
     */
    public function testGetRequestURI($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getRequestURI();
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testSetRequestURI
     *
     * @param string $uri            the URI of the Request
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers Request::setRequestURI
     *
     * @return void
     */
    public function testSetRequestURI($uri, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setRequestURI($uri);
        $this->assertEquals($this->expected, $this->actual);
    }
}
