<?php
require_once __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."config.inc.php";
require_once AMPHIBIAN_TESTS_UNIT . "baseTest.php";
require_once AMPHIBIAN_CORE_NEUTRAL."OpenSSL.php";
/**
 * Class OpenSSLTest
 *
 * @category Test
 * @package  Core
 * @author   Carl "Tex" Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/OpenSSLTest
 *
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-09-08 at 17:05:30.
 *
 */
class OpenSSLTest 
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
        $this->object = OpenSSL::instance();
    }

    /** tearDown
     *
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     *
     * @return void
     */
    protected function tearDown()
    {
        unset($this->arguments);
        unset($this->expected);
        unset($this->actual);
    }

    /** testInstance
     *
     * @covers OpenSSL::instance
     *
     * @return void
     */
    public function testInstance()
    {
        $this->expected = $this->object;
        $this->actual = OpenSSL::instance();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetClearText
     *
     * @covers OpenSSL::setClearText
     *
     * @return void
     */
    public function testSetClearText()
    {
        $this->expected = true;
        $this->actual = $this->object->setClearText("Do they speak English in What?");
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetClearText
     *
     * @covers OpenSSL::getClearText
     *
     * @return void
     */
    public function testGetClearText()
    {
        $this->arguments = "Do they speak English in What?";
        $this->object->setClearText($this->arguments);
        $this->expected = $this->arguments;
        $this->actual = $this->object->getClearText();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetPrivateKey
     *
     * @covers OpenSSL::setPrivateKey
     *
     * @return void
     */
    public function testSetPrivateKey()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /** testGetPrivateKey
     *
     * @covers OpenSSL::getPrivateKey
     *
     * @return void
     */
    public function testGetPrivateKey()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /** testSetPublicKey
     *
     * @covers OpenSSL::setPublicKey
     *
     * @return void
     */
    public function testSetPublicKey()
    {
        $this->expected = true;
        $this->object->generatePublicKey();
        $this->arguments = $this->object->getPublicKey();
        $this->actual = $this->object->setPublicKey($this->arguments);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetPublicKey
     *
     * @covers OpenSSL::getPublicKey
     *
     * @return void
     */
    public function testGetPublicKey()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /** testSetResource
     *
     * @covers OpenSSL::setResource
     *
     * @return void
     */
    public function testSetResource()
    {
        $this->expected = true;
        $this->object->initResource();
        $this->arguments = $this->object->getResource();
        $this->actual = $this->object->setResource($this->arguments);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetResource
     *
     * @covers OpenSSL::getResource
     *
     * @return void
     */
    public function testGetResource()
    {
        /*
        $this->expected = null;
        $this->actual = $this->object->getResource();
        $this->assertEquals($this->expected, $this->actual);
        */
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /** testSetWorkingText
     *
     * @covers OpenSSL::setWorkingText
     *
     * @return void
     */
    public function testSetWorkingText()
    {
        $this->expected = true;
        $this->actual = $this->object->setWorkingText("DNSKLNEO@1244");
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetWorkingText
     *
     * @covers OpenSSL::getWorkingText
     *
     * @return void
     */
    public function testGetWorkingText()
    {
        /*
        $this->expected = null;
        $this->actual = $this->object->getWorkingText();
        $this->assertEquals($this->expected, $this->actual);
        */
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /** testInitResource
     *
     * @covers OpenSSL::initResource
     *
     * @return void
     */
    public function testInitResource()
    {
        $this->expected = true;
        $this->actual = $this->object->initResource();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGeneratePrivateKey
     *
     * @covers OpenSSL::generatePrivateKey
     *
     * @return void
     */
    public function testGeneratePrivateKey()
    {
        $this->expected = true;
        $this->object->initResource();
        $this->actual = $this->object->generatePrivateKey();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGeneratePublicKey
     *
     * @covers OpenSSL::generatePublicKey
     *
     * @return void
     */
    public function testGeneratePublicKey()
    {
        $this->expected = true;
        $this->object->initResource();
        $this->actual = $this->object->generatePublicKey();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testEncrypt
     *
     * @covers OpenSSL::encrypt
     *
     * @return void
     */
    public function testEncrypt()
    {
        $this->expected = true;
        $this->arguments = "Do they speak English in What?";
        $this->object->setClearText($this->arguments);
        $this->actual = $this->object->encrypt();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testDecrypt
     *
     * @covers OpenSSL::decrypt
     *
     * @return void
     */
    public function testDecrypt()
    {
        $this->expected = true;
        $this->actual = $this->object->decrypt();
        $this->assertEquals($this->expected, $this->actual);

        $this->expected = "Do they speak English in What?";
        $this->actual = $this->object->getClearText();
        $this->assertEquals($this->expected, $this->actual);
    }
}
