<?php

require_once __DIR__ . DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config/config.inc.php";
require_once __DIR__ . DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."baseTest.php";
require_once AMPHIBIAN_CORE."SessionHandlerCookie.php";
/**
 * Class SessionHandlerCookieTest
 *
 * @category Test
 * @package  SessionHandlerCookieTest
 * @author   Carl 'Tex' Morgan <texmorgan@gmail.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     documentation/SessionHandlerCookieTest
 *
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-09-24 at 16:04:51.
 *
 */
class SessionHandlerCookieTest 
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
        $this->object = SessionHandlerCookie::instance();
    }

    /** testInstance
     *
     * @covers SessionHandlerCookie::instance
     *
     * @return void
     */
    public function testInstance()
    {
        $this->expected = $this->object;
        $this->actual = SessionHandlerCookie::instance();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** idDataProvider
     *
     * @return array
     */
    public function idDataProvider()
    {
        return array(
            array("first_name"),
            array("email")
        );
    }

    /** testOpen
     *
     * @param string $id the id of the cookie to open
     *
     * @covers SessionHandlerCookie::open
     *
     * @dataProvider idDataProvider
     *
     * @return void
     */
    public function testOpen( $id )
    {
        $this->expected = true;
        $this->actual = $this->object->open($id);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testRead
     *
     * @param string $id the id of the cookie to read
     *
     * @covers SessionHandlerCookie::read
     *
     * @dataProvider idDataProvider
     *
     * @return void
     */
    public function testRead( $id )
    {
        $this->expected = "";
        $this->actual = $this->object->read($id);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** combinedDataProvider
     *
     * @return array
     */
    public function combinedDataProvider()
    {
        return array(
            array("first_name","Tex"),
            array("email","texmorgan@amphibian.co")
        );
    }

    /** testWrite
     *
     * @param string $id   the id to set
     * @param string $data the data to set
     *
     * @covers SessionHandlerCookie::write
     *
     * @dataProvider combinedDataProvider
     *
     * @return void
     */
    public function testWrite($id, $data)
    {
        $this->expected = true;
        $this->actual = $this->object->write($id, $data);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testDestroy
     *
     * @param string $id the id of the cookie to destroy
     *
     * @covers SessionHandlerCookie::destroy
     *
     * @dataProvider idDataProvider
     *
     * @return void
     */
    public function testDestroy( $id )
    {
        $this->expected = true;
        $this->actual = $this->object->destroy($id);
        $this->assertEquals($this->expected, $this->actual);
    }
}
