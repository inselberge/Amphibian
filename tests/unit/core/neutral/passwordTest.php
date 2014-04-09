<?php

require_once __DIR__ . DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR.".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once AMPHIBIAN_TESTS_UNIT . "baseTest.php";
require_once AMPHIBIAN_CORE_NEUTRAL . "Password.php";
/**
 * Class passwordTest
 *
 * @category Test
 * @package  Core
 * @author   Carl "Tex" Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/PasswordTest
 *
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-10-03 at 16:32:16.
 *
 */
class PasswordTest
    extends BaseTest
{
    /**
     * @var object password an instance of password
     */
    protected $object;
    /**
     * @var mixed expected the expected return value of the action
     */
    protected $expected;
    /**
     * @var mixed actual the actual return value of the action
     */
    protected $actual;
    /**
     * @var mixed arguments arguments provided to the actual call
     */
    protected $arguments;

    /** setUp
     *
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp()
    {
        $this->object = Password::instance();
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
        unset($this->object);
        unset($this->expected);
        unset($this->actual);
        unset($this->arguments);
    }

    /** testCheckPasswordRegEx
     *
     * @param string $pass the password to test
     *
     * @return void
     */
    public function testCheckPasswordRegEx( $pass )
    {
    }

    /** testInstance
     *
     * @return void
     */
    public function testInstance()
    {
        $this->expected = $this->object;
        $this->actual = Password::instance();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** algorithmDataProvider
     *
     * @return array
     */
    public function algorithmDataProvider()
    {
        return array(hash_algos());
    }

    /** testSetAlgorithm
     *
     * @param string $algorithm the algorithm to use
     *
     * @dataProvider algorithmDataProvider
     *
     * @return void
     */
    public function testSetAlgorithm( $algorithm )
    {
        $this->expected = true;
        $this->actual = $this->object->setAlgorithm($algorithm);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetAlgorithm
     *
     * @return void
     */
    public function testGetAlgorithm()
    {
        $this->expected = "whirlpool";
        $this->object->setAlgorithm("whirlpool");
        $this->actual = $this->object->getAlgorithm();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetLength
     *
     * @param integer $length the length of a password
     *
     * @return void
     */
    public function testSetLength( $length )
    {
        $this->expected = true;
        $this->actual = $this->object->setLength($length);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetLength
     *
     * @return void
     */
    public function testGetLength()
    {
        $this->expected = 16;
        $this->actual = $this->object->getLength();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetPassword
     *
     * @param string $password a password to use
     *
     * @return void
     */
    public function testSetPassword( $password )
    {
        $this->expected = true;
        $this->actual = $this->object->setPassword($password);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetPassword
     *
     * @return void
     */
    public function testGetPassword()
    {
        $this->expected = "";
        $this->actual = $this->object->getPassword();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetHash
     *
     * @return void
     */
    public function testGetHash()
    {
        $this->expected = "";
        $this->actual = $this->object->getHash();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testRandomPassword
     *
     * @return void
     */
    public function testRandomPassword()
    {
        $this->expected = true;
        $this->actual = $this->object->randomPassword();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testExecute
     *
     * @return void
     */
    public function testExecute()
    {
        $this->expected = true;
        $this->actual = $this->object->execute();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testCompare
     *
     * @param object $password2 a password object
     *
     * @return void
     */
    public function testCompare($password2)
    {
        $this->expected = true;
        $this->actual = $this->object->compare($password2);
        $this->assertEquals($this->expected, $this->actual);
    }
}
