<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_GENERATORS_MYSQLI."controllerGeneratorMySQLi.php";
/**
 * Class ControllerGeneratorMySQLiTest
 *
 * @category UnitTests
 * @package  ControllerGeneratorMySQLiTest
 * @author   Carl "Tex" Morgan <texmorgan@amphibian.co>
 * @license  GPL v3
 * @link     documentation/ControllerGeneratorMySQLiTest
 *
 */
class ControllerGeneratorMySQLiTest
	extends BaseTest
{
    /** setUp
     *
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @param resource $connection a valid DatabaseMySQLi connection
     *
     * @dataProvider validDatabaseConnectionMySQLiDataProvider
     *
     * @return void
     */
    protected function setUp($connection)
    {
        $this->object = ControllerGeneratorMySQLi::factory($connection);
    }

    /** testInstance
     *
     * @param resource $databaseConnection a valid DatabaseConnectionMySQLi resource
     *
     * @covers ControllerGeneratorMySQLi::instance
     *
     * @dataProvider validDatabaseConnectionMySQLiDataProvider
     *
     * @return void
     */
    public function testInstance($databaseConnection)
    {
        $this->expected = $this->object;
        $this->actual = ControllerGeneratorMySQLi::instance($databaseConnection);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testFactory
     *
     * @param resource $databaseConnection a valid DatabaseConnectionMySQLi resource
     *
     * @covers ControllerGeneratorMySQLi::factory
     *
     * @dataProvider validDatabaseConnectionMySQLiDataProvider
     *
     * @return void
     */
    public function testFactory($databaseConnection)
    {
        $this->expected = $this->object;
        $this->actual = ControllerGeneratorMySQLi::factory($databaseConnection);
        $this->assertEquals($this->expected, $this->actual);
    }
}
