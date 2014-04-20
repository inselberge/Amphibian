<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_CORE_NEUTRAL . "EntityHeader.php";
/**
 * Class EntityHeaderTest
 *
 * @category UnitTests
 * @package  EntityHeaderTest
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated
 * @link     documentation/EntityHeaderTest
 */
class EntityHeaderTest
    extends BaseTest
{
    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = EntityHeader::factory();
    }

    /** testInstance
     *
     * @covers EntityHeader::instance
     *
     * @return void
     */
    public function testInstance()
    {
        $this->expected = $this->object;
        $this->actual = EntityHeader::instance();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testFactory
     *
     * @covers EntityHeader::factory
     *
     * @return void
     */
    public function testFactory()
    {
        $this->expected = $this->object;
        $this->actual = EntityHeader::factory();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetAllow
     *
     * @covers EntityHeader::getAllow
     *
     * @return void
     */
    public function testGetAllow()
    {
        $this->expected = "GET, PUT, POST";
        $this->object->setAllow("GET, PUT, POST");
        $this->actual = $this->object->getAllow();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetAllow
     *
     * @param mixed $value a value to give to the function
     *
     * @covers EntityHeader::setAllow
     *
     * @dataProvider httpAllowMethodDataProvider
     *
     * @return void
     */
    public function testSetAllow($value)
    {
        $this->expected = true;
        $this->actual = $this->object->setAllow($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetContentEncoding
     *
     * @covers EntityHeader::getContentEncoding
     *
     * @return void
     */
    public function testGetContentEncoding()
    {
        $this->expected = "gzip";
        $this->object->setContentEncoding("gzip");
        $this->actual = $this->object->getContentEncoding();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetContentEncoding
     *
     * @param mixed $value a value to give to the function
     *
     * @covers EntityHeader::setContentEncoding
     *
     * @dataProvider httpContentEncodingDataProvider
     *
     * @return void
     */
    public function testSetContentEncoding($value)
    {
        $this->expected = true;
        $this->actual = $this->object->setContentEncoding($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetContentLanguage
     *
     * @covers EntityHeader::getContentLanguage
     *
     * @return void
     */
    public function testGetContentLanguage()
    {
        $this->expected = "en";
        $this->object->setContentLanguage("en");
        $this->actual = $this->object->getContentLanguage();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetContentLanguage
     *
     * @param mixed $value a value to give to the function
     *
     * @covers EntityHeader::setContentLanguage
     *
     * @dataProvider httpContentLanguageDataProvider
     *
     * @return void
     */
    public function testSetContentLanguage($value)
    {
        $this->expected = true;
        $this->actual = $this->object->setContentLanguage($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetContentLength
     *
     * @covers EntityHeader::getContentLength
     *
     * @return void
     */
    public function testGetContentLength()
    {
        $this->expected = 3245;
        $this->object->setContentLength(3245);
        $this->actual = $this->object->getContentLength();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetContentLength
     *
     * @param mixed $value a value to give to the function
     *
     * @covers EntityHeader::setContentLength
     *
     * @dataProvider positiveIntegerDataProvider
     *
     * @return void
     */
    public function testSetContentLength($value)
    {
        $this->expected = true;
        $this->actual = $this->object->setContentLength($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetContentLocation
     *
     * @covers EntityHeader::getContentLocation
     *
     * @return void
     */
    public function testGetContentLocation()
    {
        $this->expected = "/var/log";
        $this->object->setContentLocation("/var/log");
        $this->actual = $this->object->getContentLocation();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetContentLocation
     *
     * @param mixed $value a value to give to the function
     *
     * @covers EntityHeader::setContentLocation
     *
     * @dataProvider httpContentLocationDataProvider
     *
     * @return void
     */
    public function testSetContentLocation($value)
    {
        $this->expected = true;
        $this->actual = $this->object->setContentLocation($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetContentMD5
     *
     * @covers EntityHeader::getContentMD5
     *
     * @return void
     */
    public function testGetContentMD5()
    {
        $this->expected = md5($_SERVER["REQUEST_TIME"]);
        $this->object->setContentMD5(md5($_SERVER["REQUEST_TIME"]));
        $this->actual = $this->object->getContentMD5();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetContentMD5
     *
     * @covers EntityHeader::setContentMD5
     *
     * @return void
     */
    public function testSetContentMD5()
    {
        $this->expected = true;
        $this->actual = $this->object->setContentMD5(md5($_SERVER["REQUEST_TIME"]));
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetContentRange
     *
     * @covers EntityHeader::getContentRange
     *
     * @return void
     */
    public function testGetContentRange()
    {
        $this->expected = "bytes 500-1233/1234";
        $this->object->setContentRange("bytes 500-1233/1234");
        $this->actual = $this->object->getContentRange();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetContentRange
     *
     * @param mixed $value a value to give to the function
     *
     * @covers EntityHeader::setContentRange
     *
     * @dataProvider httpContentRangeDataProvider
     *
     * @return void
     */
    public function testSetContentRange($value)
    {
        $this->expected = true;
        $this->actual = $this->object->setContentRange($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetContentType
     *
     * @covers EntityHeader::getContentType
     *
     * @return void
     */
    public function testGetContentType()
    {
        $this->expected = "text/html; charset=ISO-8859-4";
        $this->object->setContentType("text/html; charset=ISO-8859-4");
        $this->actual = $this->object->getContentType();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetContentType
     *
     * @param mixed $value a value to give to the function
     *
     * @covers EntityHeader::setContentType
     *
     * @dataProvider httpContentTypeDataProvider
     *
     * @return void
     */
    public function testSetContentType($value)
    {
        $this->expected = true;
        $this->actual = $this->object->setContentType($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetExpires
     *
     * @covers EntityHeader::getExpires
     *
     * @return void
     */
    public function testGetExpires()
    {
        $this->expected = "Thu, 01 Dec 1994 16:00:00 GMT";
        $this->object->setExpires("Thu, 01 Dec 1994 16:00:00 GMT");
        $this->actual = $this->object->getExpires();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetExpires
     *
     * @param mixed $value a value to give to the function
     *
     * @covers EntityHeader::setExpires
     *
     * @dataProvider httpDateDataProvider
     *
     * @return void
     */
    public function testSetExpires($value)
    {
        $this->expected = true;
        $this->actual = $this->object->setExpires($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetExtensionHeader
     *
     * @covers EntityHeader::getExtensionHeader
     *
     * @return void
     */
    public function testGetExtensionHeader()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /** testSetExtensionHeader
     *
     * @covers EntityHeader::setExtensionHeader
     *
     * @return void
     */
    public function testSetExtensionHeader()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /** testGetLastModified
     *
     * @covers EntityHeader::getLastModified
     *
     * @return void
     */
    public function testGetLastModified()
    {
        $this->expected = "Thu, 01 Dec 1994 16:00:00 GMT";
        $this->object->setLastModified("Thu, 01 Dec 1994 16:00:00 GMT");
        $this->actual = $this->object->getLastModified();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetLastModified
     *
     * @param mixed $value a value to give to the function
     *
     * @covers EntityHeader::setLastModified
     *
     * @dataProvider httpDateDataProvider
     *
     * @return void
     */
    public function testSetLastModified($value)
    {
        $this->expected = true;
        $this->actual = $this->object->setLastModified($value);
        $this->assertEquals($this->expected, $this->actual);
    }
}
