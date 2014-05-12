<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_CORE_NEUTRAL . "ResponseHeader.php";
/**
 * Class ResponseHeaderTest
 *
 * @category UnitTestCoreNeutral
 * @package  ResponseHeaderTest
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  GPL v2
 * @link     documentation/ResponseHeaderTest
 */
class ResponseHeaderTest
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
        $this->object = ResponseHeader::factory();
    }

    /** testInstance
     *
     * @covers ResponseHeader::instance
     *
     * @return void
     */
    public function testInstance()
    {
        $this->expected = $this->object;
        $this->actual = ResponseHeader::instance();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testFactory
     *
     * @covers ResponseHeader::factory
     *
     * @return void
     */
    public function testFactory()
    {
        $this->expected = $this->object;
        $this->actual = ResponseHeader::factory();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetAcceptRanges
     *
     * @param string $expectedResult the accepted ranges
     *
     * @covers ResponseHeader::getAcceptRanges
     *
     * @return void
     */
    public function testGetAcceptRanges($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getAcceptRanges();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetAcceptRanges
     *
     * @param $value
     * @param $expectedResult
     *
     * @covers ResponseHeader::setAcceptRanges
     *
     * @return void
     */
    public function testSetAcceptRanges($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setAcceptRanges($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetAge
     *
     * @param $expectedResult
     *
     * @covers ResponseHeader::getAge
     *
     * @return void
     */
    public function testGetAge($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getAge();
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testSetAge
     *
     * @param $value
     * @param $expectedResult
     *
     * @covers ResponseHeader::setAge
     *
     * @return void
     */
    public function testSetAge($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setAge($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetETag
     *
     * @param $expectedResult
     *
     * @covers ResponseHeader::getETag
     *
     * @return void
     */
    public function testGetETag($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getETag();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetETag
     *
     * @param $value
     * @param $expectedResult
     *
     * @covers ResponseHeader::setETag
     *
     * @return void
     */
    public function testSetETag($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setETag($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetLocation
     *
     * @param $expectedResult
     *
     * @covers ResponseHeader::getLocation
     *
     * @return void
     */
    public function testGetLocation($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getLocation();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetLocation
     *
     * @param $value
     * @param $expectedResult
     *
     * @covers ResponseHeader::setLocation
     *
     * @return void
     */
    public function testSetLocation($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setLocation($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetProxyAuthenticate
     *
     * @param $expectedResult
     *
     * @covers ResponseHeader::getProxyAuthenticate
     *
     * @return void
     */
    public function testGetProxyAuthenticate($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getProxyAuthenticate();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetProxyAuthenticate
     *
     * @param $value
     * @param $expectedResult
     *
     * @covers ResponseHeader::setProxyAuthenticate
     *
     * @return void
     */
    public function testSetProxyAuthenticate($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setProxyAuthenticate($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetRetryAfter
     *
     * @param $expectedResult
     *
     * @covers ResponseHeader::getRetryAfter
     *
     * @return void
     */
    public function testGetRetryAfter($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getRetryAfter();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetRetryAfter
     *
     * @param $value
     * @param $expectedResult
     *
     * @covers ResponseHeader::setRetryAfter
     *
     * @return void
     */
    public function testSetRetryAfter($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setRetryAfter($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetServer
     *
     * @param $expectedResult
     *
     * @covers ResponseHeader::getServer
     *
     * @return void
     */
    public function testGetServer($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getServer();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetServer
     *
     * @param $value
     * @param $expectedResult
     *
     * @covers ResponseHeader::setServer
     *
     * @return void
     */
    public function testSetServer($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setServer($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetVary
     *
     * @param $expectedResult
     *
     * @covers ResponseHeader::getVary
     *
     * @return void
     */
    public function testGetVary($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getVary();
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testSetVary
     *
     * @param $value
     * @param $expectedResult
     *
     * @covers ResponseHeader::setVary
     *
     * @return void
     */
    public function testSetVary($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setVary($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetWwwAuthenticate
     *
     * @param $expectedResult
     *
     * @covers ResponseHeader::getWwwAuthenticate
     *
     * @return void
     */
    public function testGetWwwAuthenticate($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getWwwAuthenticate();
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testSetWwwAuthenticate
     *
     * @param string $value          the WWW-Authenticate value
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers ResponseHeader::setWwwAuthenticate
     *
     * @return void
     */
    public function testSetWwwAuthenticate($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setWwwAuthenticate($value);
        $this->assertEquals($this->expected, $this->actual);
    }
}
