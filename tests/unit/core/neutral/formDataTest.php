<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_CORE_NEUTRAL."FormData.php";
require_once AMPHIBIAN_CORE_NEUTRAL."SuperGlobal.php";
/**
 * Class formDataTest
 *
 * @category Test
 * @package  Core
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     documentation/formDataTest
 *
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-09-08 at 17:05:31.
 *
 */
class formDataTest 
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
        $this->object = new formData();
        $_SESSION["fullName"] = "Tex Morgan";
        $_GET["first_name"] = "Tex";
        $_POST["last_name"] = "Morgan";
        $_COOKIE["email"] = "texmorgan@amphibian.co";
     }

    /** testLoadSuperVariables
     *
     * @covers formData::loadSuperVariables
     *
     * @return void
     */
    public function testLoadSuperVariables()
    {
        $this->expected = true;
        $this->actual = $this->object->loadSuperVariables();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetCookie
     *
     * @covers formData::setCookie
     *
     * @return void
     */
    public function testSetCookie()
    {
        $this->expected = true;
        $this->arguments = $_COOKIE;
        $this->actual = $this->object->setCookie($this->arguments);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetCookie
     *
     * @covers formData::getCookie
     *
     * @return void
     */
    public function testGetCookie()
    {
        $this->expected = new SuperGlobal($_COOKIE);
        $this->object->loadSuperVariables();
        $this->actual = $this->object->getCookie();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetGet
     *
     * @covers formData::setGet
     *
     * @return void
     */
    public function testSetGet()
    {
        $this->expected = true;
        $this->arguments = $_GET;
        $this->actual = $this->object->setGet($this->arguments);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetGet
     *
     * @covers formData::getGet
     *
     * @return void
     */
    public function testGetGet()
    {
        $this->expected = new SuperGlobal($_GET);
        $this->object->loadSuperVariables();
        $this->actual = $this->object->getGet();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetPost
     *
     * @covers formData::setPost
     *
     * @return void
     */
    public function testSetPost()
    {
        $this->expected = true;
        $this->arguments = $_POST;
        $this->actual = $this->object->setPost($this->arguments);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetPost
     *
     * @covers formData::getPost
     *
     * @return void
     */
    public function testGetPost()
    {
        $this->expected = new SuperGlobal($_POST);
        $this->object->loadSuperVariables();
        $this->actual = $this->object->getPost();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetServer
     *
     * @covers formData::setServer
     *
     * @return void
     */
    public function testSetServer()
    {
        $this->expected = true;
        $this->arguments = $_SERVER;
        $this->actual = $this->object->setServer($this->arguments);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetServer
     *
     * @covers formData::getServer
     *
     * @return void
     */
    public function testGetServer()
    {
        $this->expected = new SuperGlobal($_SERVER);
        $this->object->loadSuperVariables();
        $this->actual = $this->object->getServer();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetSession
     *
     * @covers formData::setSession
     *
     * @return void
     */
    public function testSetSession()
    {
        $this->expected = true;
        $this->arguments = $_SESSION;
        $this->actual = $this->object->setSession($this->arguments);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetSession
     *
     * @covers formData::getSession
     *
     * @return void
     */
    public function testGetSession()
    {
        $this->expected = new SuperGlobal($_SESSION);
        $this->object->loadSuperVariables();
        $this->actual = $this->object->getSession();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testCheckPostGet
     *
     * @covers formData::checkPostGet
     *
     * @return void
     */
    public function testCheckPostGet()
    {
        //TODO: positive test
        $this->expected = false;
        $this->arguments = "fullName";
        $this->actual = $this->object->checkPostGet($this->arguments);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetByKey
     *
     * @covers formData::getByKey
     *
     * @return void
     */
    public function testGetByKey()
    {
        $this->expected = "en_US.UTF-8";
        $this->object->loadSuperVariables();
        $this->actual = $this->object->getByKey("server", "LANG");
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetByLocalKey
     *
     * @covers formData::getByLocalKey
     *
     * @return void
     */
    public function testGetByLocalKey()
    {
        $this->expected = "en_US.UTF-8";
        $this->object->loadSuperVariables();
        $this->actual = $this->object->getByLocalKey("server", "LANG");
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testCheckExists
     *
     * @covers formData::checkExists
     *
     * @return void
     */
    public function testCheckExists()
    {
        $this->expected = true;
        $this->object->loadSuperVariables();
        $this->actual = $this->object->checkExists("server", "LANG");
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testOnGet
     *
     * @covers formData::onGet
     *
     * @todo   Implement testOnGet().
     *
     * @return void
     */
    public function testOnGet()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /** testOnPost
     *
     * @covers formData::onPost
     *
     * @todo   Implement testOnPost().
     *
     * @return void
     */
    public function testOnPost()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /** testOnPut
     *
     * @covers formData::onPut
     *
     * @todo   Implement testOnPut().
     *
     * @return void
     */
    public function testOnPut()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }
}
