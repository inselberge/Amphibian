<?php
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-08-23 at 22:51:30.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_CORE_NEUTRAL . "Sanitizer.php";

class sanitizerTest
    extends BaseTest
{
    /** setUp
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp()
    {
        $this->object = Sanitizer::factory();
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

    /**
     * @covers sanitizer::instance
     */
    public function testInstance()
    {
        $this->assertEquals($this->object, Sanitizer::instance());
    }

    /**
     * @covers sanitizer::factory
     */
    public function testFactory()
    {
        $this->assertEquals($this->object, Sanitizer::factory());
    }

    /**
     * @covers sanitizer::getFlags
     */
    public function testGetFlags()
    {
        $this->object->setSanitationFilter(FILTER_SANITIZE_ENCODED);
        $this->object->setFlags(FILTER_FLAG_STRIP_HIGH);
        $this->assertEquals(FILTER_FLAG_STRIP_HIGH,$this->object->getFlags());
        $this->assertNotEquals(FILTER_FLAG_STRIP_LOW,$this->object->getFlags());
    }

    /** testSetFlags
     *
     * @covers sanitizer::setFlags
     *
     * @dataProvider setFlagsDataProvider
     *
     * @return void
     */
    public function testSetFlags($filter, $flag)
    {
        $this->object->setSanitationFilter($filter);
        $this->assertTrue($this->object->setFlags($flag));
    }

    public function setFlagsDataProvider()
    {
        return array(
            array(FILTER_SANITIZE_ENCODED, FILTER_FLAG_STRIP_LOW),
            array(FILTER_SANITIZE_ENCODED, FILTER_FLAG_STRIP_HIGH),
            array(FILTER_SANITIZE_ENCODED, FILTER_FLAG_ENCODE_LOW),
            array(FILTER_SANITIZE_ENCODED, FILTER_FLAG_ENCODE_HIGH),
            array(FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
            array(FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_THOUSAND),
            array(FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_SCIENTIFIC),
            array(FILTER_SANITIZE_SPECIAL_CHARS,FILTER_FLAG_STRIP_HIGH),
            array(FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_STRIP_LOW),
            array(FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_ENCODE_HIGH),
            array(FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES),
            array(FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES),
            array(FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW),
            array(FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH),
            array(FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW),
            array(FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_HIGH),
            array(FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP)
        );
    }

    /**
     * @covers sanitizer::getVariable
     */
    public function testGetVariable()
    {
        $expected = 15;
        $this->object->setVariable(15);
        $this->assertEquals($expected, $this->object->getVariable());
    }

    /**
     * @covers sanitizer::setVariable
     */
    public function testSetVariable()
    {
        $this->assertTrue($this->object->setVariable(15));
    }

    /**
     * @covers sanitizer::getSanitationFilter
     */
    public function testGetSanitationFilter()
    {
        $this->object->setSanitationFilter(FILTER_SANITIZE_NUMBER_INT);
        $this->assertEquals(FILTER_SANITIZE_NUMBER_INT, $this->object->getSanitationFilter());
    }

    /** testSetSanitationFilter
     *
     * @covers sanitizer::setSanitationFilter
     *
     * @dataProvider setSanitationFilterDataProvider
     */
    public function testSetSanitationFilter($filter)
    {
        $this->assertTrue($this->object->setSanitationFilter($filter));
    }

    public function setSanitationFilterDataProvider()
    {
        return array(
            array(FILTER_SANITIZE_EMAIL),
            array(FILTER_SANITIZE_ENCODED),
            array(FILTER_SANITIZE_MAGIC_QUOTES),
            array(FILTER_SANITIZE_NUMBER_FLOAT),
            array(FILTER_SANITIZE_NUMBER_INT),
            array(FILTER_SANITIZE_SPECIAL_CHARS),
            array(FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            array(FILTER_SANITIZE_STRING),
            array(FILTER_SANITIZE_STRIPPED),
            array(FILTER_SANITIZE_URL)
        );
    }

    /**
     * @covers sanitizer::execute
     *
     * @dataProvider setFlagsDataProvider
     */
    public function testExecute($filter, $flag)
    {
        $this->object->setVariable(15);
        $this->object->setSanitationFilter($filter);
        $this->object->setFlags($flag);
        $this->assertEquals(15, $this->object->execute());
    }
}
