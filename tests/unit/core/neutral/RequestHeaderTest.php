<?php
require_once __DIR__ . DIRECTORY_SEPARATOR
    . ".." . DIRECTORY_SEPARATOR
    . ".." . DIRECTORY_SEPARATOR
    . "baseTest.php";
require_once AMPHIBIAN_CORE_NEUTRAL . "RequestHeader.php";

/**
 * Class RequestHeaderTest
 *
 * @category ${NAMESPACE}
 * @package  RequestHeaderTest
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license
 * @link
 */
class RequestHeaderTest
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
        $this->object = RequestHeader::factory();
    }

    /** testInstance
     *
     * @covers RequestHeader::instance
     *
     * @return void
     */
    public function testInstance()
    {
        $this->expected = $this->object;
        $this->actual = RequestHeader::instance();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testFactory
     *
     * @covers RequestHeader::factory
     *
     * @return void
     */
    public function testFactory()
    {
        $this->expected = $this->object;
        $this->actual = RequestHeader::factory();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetAccept
     *
     * @param string $expectedResult the expected accept value
     *
     * @covers RequestHeader::getAccept
     *
     * @return void
     */
    public function testGetAccept($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getAccept();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetAccept
     *
     * @param string $value          the value to use for accept
     * @param bool   $expectedResult true = success;false = failure
     *
     * @covers RequestHeader::setAccept
     *
     * @return void
     */
    public function testSetAccept($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setAccept($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetAcceptCharset
     *
     * @param string $expectedResult the expected accept charset value
     *
     * @covers RequestHeader::getAcceptCharset
     *
     * @return void
     */
    public function testGetAcceptCharset($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getAcceptCharset();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetAcceptCharset
     *
     * @param string $value          the value of Accept Charset
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers RequestHeader::setAcceptCharset
     *
     * @return void
     */
    public function testSetAcceptCharset($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setAcceptCharset($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetAcceptEncoding
     *
     * @param string $expectedResult the expected accept encoding
     *
     * @covers RequestHeader::getAcceptEncoding
     *
     * @return void
     */
    public function testGetAcceptEncoding($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getAcceptEncoding();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetAcceptEncoding
     *
     * @param string $value          the value of Accept Encoding
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers RequestHeader::setAcceptEncoding
     *
     * @return void
     */
    public function testSetAcceptEncoding($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setAcceptEncoding($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetAcceptLanguage
     *
     * @param string $expectedResult the expected accept language
     *
     * @covers RequestHeader::getAcceptLanguage
     *
     * @return void
     */
    public function testGetAcceptLanguage($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getAcceptLanguage();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetAcceptLanguage
     *
     * @param string $value          the value of Accept Language
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers RequestHeader::setAcceptLanguage
     *
     * @return void
     */
    public function testSetAcceptLanguage($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setAcceptLanguage($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetAuthorization
     *
     * @param string $expectedResult the expected authorization value
     *
     * @covers RequestHeader::getAuthorization
     *
     * @return void
     */
    public function testGetAuthorization($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getAuthorization();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetAuthorization
     *
     * @param string $value          the value of Authorization
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers RequestHeader::setAuthorization
     *
     * @return void
     */
    public function testSetAuthorization($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setAuthorization($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetExpect
     *
     * @param string $expectedResult the expected value
     *
     * @covers RequestHeader::getExpect
     *
     * @return void
     */
    public function testGetExpect($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getExpect();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetExpect
     *
     * @param string $value          the value of Expect
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers RequestHeader::setExpect
     *
     * @return void
     */
    public function testSetExpect($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setExpect($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetFrom
     *
     * @param string $expectedResult the expected value
     *
     * @covers RequestHeader::getFrom
     *
     * @return void
     */
    public function testGetFrom($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getFrom();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetFrom
     *
     * @param string $value          the value of From
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers RequestHeader::setFrom
     *
     * @return void
     */
    public function testSetFrom($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setFrom($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetHost
     *
     * @param string $expectedResult the expected value
     *
     * @covers RequestHeader::getHost
     *
     * @return void
     */
    public function testGetHost($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getHost();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetHost
     *
     * @param string $value          the value of Host
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers RequestHeader::setHost
     *
     * @return void
     */
    public function testSetHost($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setHost($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetIfMatch
     *
     * @param string $expectedResult the expected value
     *
     * @covers RequestHeader::getIfMatch
     *
     * @return void
     */
    public function testGetIfMatch($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getIfMatch();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetIfMatch
     *
     * @param string $value          the value of If Match
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers RequestHeader::setIfMatch
     *
     * @return void
     */
    public function testSetIfMatch($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setIfMatch($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetIfModifiedSince
     *
     * @param string $expectedResult the expected value
     *
     * @covers RequestHeader::getIfModifiedSince
     *
     * @return void
     */
    public function testGetIfModifiedSince($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getIfModifiedSince();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetIfModifiedSince
     *
     * @param string $value          the value of If Modified Since
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers RequestHeader::setIfModifiedSince
     *
     * @return void
     */
    public function testSetIfModifiedSince($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setIfModifiedSince($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetIfNoneMatch
     *
     * @param string $expectedResult the expected value
     *
     * @covers RequestHeader::getIfNoneMatch
     *
     * @return void
     */
    public function testGetIfNoneMatch($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getIfNoneMatch();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetIfNoneMatch
     *
     * @param string $value          the value of If None Match
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers RequestHeader::setIfNoneMatch
     *
     * @return void
     */
    public function testSetIfNoneMatch($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setIfNoneMatch($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetIfRange
     *
     * @param string $expectedResult the expected value
     *
     * @covers RequestHeader::getIfRange
     *
     * @return void
     */
    public function testGetIfRange($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getIfRange();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetIfRange
     *
     * @param string $value          the value of If Range
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers RequestHeader::setIfRange
     *
     * @return void
     */
    public function testSetIfRange($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setIfRange($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetIfUnmodifiedSince
     *
     * @param string $expectedResult the expected value
     *
     * @covers RequestHeader::getIfUnmodifiedSince
     *
     * @return void
     */
    public function testGetIfUnmodifiedSince($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getIfUnmodifiedSince();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetIfUnmodifiedSince
     *
     * @param string $value          the value of If Unmodified Since
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers RequestHeader::setIfUnmodifiedSince
     *
     * @return void
     */
    public function testSetIfUnmodifiedSince($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setIfUnmodifiedSince($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetMaxForwards
     *
     * @param string $expectedResult the expected value of Max Forwards
     *
     * @covers RequestHeader::getMaxForwards
     *
     * @return void
     */
    public function testGetMaxForwards($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getMaxForwards();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetMaxForwards
     *
     * @param string $value          the value of Max Forwards
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers RequestHeader::setMaxForwards
     *
     * @return void
     */
    public function testSetMaxForwards($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setMaxForwards($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetProxyAuthorization
     *
     * @param string $expectedResult the expected Proxy Authorization value
     *
     * @covers RequestHeader::getProxyAuthorization
     *
     * @return void
     */
    public function testGetProxyAuthorization($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getProxyAuthorization();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetProxyAuthorization
     *
     * @param string $value          the value of Proxy Authorization
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers RequestHeader::setProxyAuthorization
     *
     * @return void
     */
    public function testSetProxyAuthorization($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setProxyAuthorization($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetRange
     *
     * @param string $expectedResult the expected Range value
     *
     * @covers RequestHeader::getRange
     *
     * @return void
     */
    public function testGetRange($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getRange();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetRange
     *
     * @param string $value          the value of range
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers RequestHeader::setRange
     *
     * @return void
     */
    public function testSetRange($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setRange($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetReferer
     *
     * @param string $expectedResult the expected value of referer
     *
     * @covers RequestHeader::getReferer
     *
     * @return void
     */
    public function testGetReferer($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getReferer();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetReferer
     *
     * @param string $value          the value of the referer
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers RequestHeader::setReferer
     *
     * @return void
     */
    public function testSetReferer($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setReferer($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetTE
     *
     * @param string $expectedResult the expected value of TE
     *
     * @covers RequestHeader::getTE
     *
     * @return void
     */
    public function testGetTE($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getTE();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetTE
     *
     * @param string $value          the value of TE
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers RequestHeader::setTE
     *
     * @return void
     */
    public function testSetTE($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setTE($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetUserAgent
     *
     * @param string $expectedResult the value of the user agent
     *
     * @covers RequestHeader::getUserAgent
     *
     * @return void
     */
    public function testGetUserAgent($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getUserAgent();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetUserAgent
     *
     * @param string $value          the value of the user agent
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers RequestHeader::setUserAgent
     *
     * @return void
     */
    public function testSetUserAgent($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setUserAgent($value);
        $this->assertEquals($this->expected, $this->actual);
    }
}
