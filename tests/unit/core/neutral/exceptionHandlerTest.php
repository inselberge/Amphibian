<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_CORE_NEUTRAL."ExceptionHandler.php";
/**
 * Class ExceptionHandlerTest
 *
 * @category Test
 * @package  Core
 * @author   Carl "Tex" Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     documentation/ExceptionHandlerTest
 *
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-09-08 at 17:05:31.
 *
 */
class ExceptionHandlerTest
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
        $this->object = ExceptionHandler::instance("This is an exception message");
    }

    /** testInstance
     *
     * @covers ExceptionHandler::instance
     *
     * @return void
     */
    public function testInstance()
    {
        $this->expected = $this->object;
        $this->actual = ExceptionHandler::instance("This is an exception message");
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testExecute
     *
     * @covers ExceptionHandler::execute
     *
     * @return void
     */
    public function testExecute()
    {
        $this->assertTrue($this->object->execute());
    }

    /** test__toString
     *
     * @covers ExceptionHandler::__toString
     *
     * @return void
     */
    public function testToString()
    {
        $this->object = new ExceptionHandler(__METHOD__.": This is an exception message");
        $this->object->execute();
        $this->assertAttributeContains(": This is an exception message", 'message',$this->object);
    }
}
