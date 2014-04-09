<?php
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-08-23 at 22:51:31.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR.".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once AMPHIBIAN_TESTS_UNIT . "baseTest.php";
require_once AMPHIBIAN_CONFIG."Coworks.In.config.inc.php";
require_once AMPHIBIAN_CORE_NEUTRAL."Log.php";
/**
 * Class logTest
 *
 * @category Test
 * @package  Log
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/${PROJECT_NAME}/documentation/logTest
 */
class logTest
    extends BaseTest
{

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp()
    {
        $this->object = Log::instance(": Error message");
    }

    /** testInstance
     *
     * @covers Log::instance
     *
     * @return void
     */
    public function testInstance()
    {
        $this->assertTrue(is_object($this->object));
    }

    /** testSetLogName
     *
     * @covers Log::setLogName
     *
     * @return void
     */
    public function testSetLogName()
    {
        $this->assertTrue($this->object->setLogName(date('Y-m-d_H:i:s').".".uniqid().".log"));
    }

    /** testSetLogType
     *
     * @covers Log::setLogType
     *
     * @return void
     */
    public function testSetLogType()
    {
        $this->assertTrue($this->object->setLogType("Email"));
        $this->assertTrue($this->object->setLogType("Error"));
        $this->assertTrue($this->object->setLogType("Malicious"));
        $this->assertTrue($this->object->setLogType("Virus"));
        $this->assertTrue($this->object->setLogType("Warning"));
        $this->assertTrue($this->object->setLogType("Database_Error"));
        $this->assertTrue($this->object->setLogType("Database_Backup"));
        $this->assertTrue($this->object->setLogType("Database_Query"));
        $this->assertTrue($this->object->setLogType("Database_Warning"));
    }

    /** testExecute
     *
     * @covers Log::execute
     *
     * @return void
     */
    public function testExecute()
    {
        $this->object->setLogType("Error");
        $this->object->setLogName("Mr.Mittens.log");
        $this->assertTrue($this->object->execute());
    }
}
