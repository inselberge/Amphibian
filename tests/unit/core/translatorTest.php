<?php
require_once __DIR__ . DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."config.inc.php";
require_once AMPHIBIAN_TESTS . "baseTest.php";
require_once AMPHIBIAN_CORE_ABSTRACT . "Translator.php";
/**
 * Class translatorTest
 *
 * @category Test
 * @package  Core
 * @author   Carl "Tex" Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/translatorTest
 *
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-09-17 at 13:41:29.
 *
 */
class translatorTest 
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
        $this->object = $this->getMockForAbstractClass('Translator');
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
    }

    /** testSetOriginal
     *
     * @covers Translator::setOriginal
     *
     * @return void
     */
    public function testSetOriginal()
    {
        $this->expected = true;
        $this->actual = $this->object->setOriginal("id gt 100");
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetOriginal
     *
     * @covers Translator::getOriginal
     *
     * @return void
     */
    public function testGetOriginal()
    {
        $this->expected = "id gt 100";
        $this->arguments = "id gt 100";
        $this->object->setOriginal($this->arguments);
        $this->actual = $this->object->getOriginal();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetTranslation
     *
     * @covers Translator::getTranslation
     *
     * @return void
     */
    public function testGetTranslation()
    {
        //TODO: properly test this after translatorMySQLi or others are implemented
        $this->expected = null;
        $this->actual = $this->object->getTranslation();
        $this->assertEquals($this->expected, $this->actual);
    }
}
