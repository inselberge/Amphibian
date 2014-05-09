<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_GENERATORS_ABSTRACT."DatabaseBackup.php";
/**
 * Class DatabaseBackupTest
 *
 * @category ${NAMESPACE}
 * @package  DatabaseBackupTest
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license
 * @link
 */
class DatabaseBackupTest
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
        $this->object = $this->getMockForAbstractClass('DatabaseBackup');
    }

    /** testSetCommand
     *
     * @param string $value          the value to set
     * @param bool   $expectedResult true = success, false = failure
     *
     * @covers DatabaseBackup::setCommand
     *
     * @return void
     */
    public function testSetCommand($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setCommand($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetCommand
     *
     * @param string $expectedResult the command to run
     *
     * @covers DatabaseBackup::getCommand
     *
     * @return void
     */
    public function testGetCommand($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getCommand();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testAppendCommand
     *
     * @param string $value          the value to set
     * @param bool   $expectedResult true = success, false = failure
     *
     * @covers DatabaseBackup::appendCommand
     *
     * @return void
     */
    public function testAppendCommand($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->appendCommand($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetDatabase
     *
     * @param string $value          the value to set
     * @param bool   $expectedResult true = success, false = failure
     *
     * @covers DatabaseBackup::setDatabase
     *
     * @return void
     */
    public function testSetDatabase($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setDatabase($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetDatabase
     *
     * @param string $expectedResult the expected current value
     *
     * @covers DatabaseBackup::getDatabase
     *
     * @return void
     */
    public function testGetDatabase($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getDatabase();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetDestination
     *
     * @param string $value          the value to set
     * @param bool   $expectedResult true = success, false = failure
     *
     * @covers DatabaseBackup::setDestination
     *
     * @return void
     */
    public function testSetDestination($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setDestination($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetDestination
     *
     * @param string $expectedResult the expected current value
     *
     * @covers DatabaseBackup::getDestination
     *
     * @return void
     */
    public function testGetDestination($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getDestination();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetHost
     *
     * @param string $value          the value to set
     * @param bool   $expectedResult true = success, false = failure
     *
     * @covers DatabaseBackup::setHost
     *
     * @return void
     */
    public function testSetHost($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setHost($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetHost
     *
     * @param string $expectedResult the expected current value
     *
     * @covers DatabaseBackup::getHost
     *
     * @return void
     */
    public function testGetHost($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getHost();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetOptions
     *
     * @param string $value          the value to set
     * @param bool   $expectedResult true = success, false = failure
     *
     * @covers DatabaseBackup::setOptions
     *
     * @return void
     */
    public function testSetOptions($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setOptions($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetOptions
     *
     * @param string $expectedResult the expected current value
     *
     * @covers DatabaseBackup::getOptions
     *
     * @return void
     */
    public function testGetOptions($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getOptions();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetPassword
     *
     * @param string $value          the value to set
     * @param bool   $expectedResult true = success, false = failure
     *
     * @covers DatabaseBackup::setPassword
     *
     * @return void
     */
    public function testSetPassword($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setPassword($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetPassword
     *
     * @param string $expectedResult the expected current value
     *
     * @covers DatabaseBackup::getPassword
     *
     * @return void
     */
    public function testGetPassword($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getPassword();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetPort
     *
     * @param string $value          the value to set
     * @param bool   $expectedResult true = success, false = failure
     *
     * @covers DatabaseBackup::setPort
     *
     * @return void
     */
    public function testSetPort($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setPort($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetPort
     *
     * @param string $expectedResult the expected current value
     *
     * @covers DatabaseBackup::getPort
     *
     * @return void
     */
    public function testGetPort($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getPort();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetProtocol
     *
     * @param string $value          the value to set
     * @param bool   $expectedResult true = success, false = failure
     *
     * @covers DatabaseBackup::setProtocol
     *
     * @return void
     */
    public function testSetProtocol($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setProtocol($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetProtocol
     *
     * @param string $expectedResult the expected current value
     *
     * @covers DatabaseBackup::getProtocol
     *
     * @return void
     */
    public function testGetProtocol($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getProtocol();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetSocket
     *
     * @param string $value          the value to set
     * @param bool   $expectedResult true = success, false = failure
     *
     * @covers DatabaseBackup::setSocket
     *
     * @return void
     */
    public function testSetSocket($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setSocket($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetSocket
     *
     * @param string $expectedResult the expected current value
     *
     * @covers DatabaseBackup::getSocket
     *
     * @return void
     */
    public function testGetSocket($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getProtocol();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetTables
     *
     * @param array $value          the tables to use
     * @param bool  $expectedResult true = success, false = failure
     *
     * @covers DatabaseBackup::setTables
     *
     * @return void
     */
    public function testSetTables($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setTables($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetTables
     *
     * @param array $expectedResult the expected current value
     *
     * @covers DatabaseBackup::getTables
     *
     * @return void
     */
    public function testGetTables($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getTables();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetUser
     *
     * @param string $value          the value to set
     * @param bool   $expectedResult true = success, false = failure
     *
     * @covers DatabaseBackup::setUser
     *
     * @return void
     */
    public function testSetUser($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setUser($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetUser
     *
     * @param string $expectedResult the expected current value
     *
     * @covers DatabaseBackup::getUser
     *
     * @return void
     */
    public function testGetUser($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getUser();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testExecute
     *
     * @covers DatabaseBackup::execute
     *
     * @return void
     */
    public function testExecute()
    {
        $this->expected = true;
        $this->actual = $this->object->execute();
        $this->assertEquals($this->expected, $this->actual);
    }
}
