<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_GENERATORS_MYSQLI."DatabaseBackupMySQLi.php";
/**
 * Class DatabaseBackupMySQLiTest
 *
 * @category 
 * @package  
 * @author   
 * @license  
 * @link     documentation/DatabaseBackupMySQLiTest
 *
 */
class DatabaseBackupMySQLiTest 
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
        $this->object = DatabaseBackupMySQLi::factory();
    }

    /** testInstance
     *
     * @covers DatabaseBackupMySQLi::instance
     *
     * @return void
     */
    public function testInstance()
    {
        $this->expected = $this->object;
        $this->actual = DatabaseBackupMySQLi::instance();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testFactory
     *
     * @covers DatabaseBackupMySQLi::factory
     *
     * @return void
     */
    public function testFactory()
    {
        $this->expected = $this->object;
        $this->actual = DatabaseBackupMySQLi::factory();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetNoData
     *
     * @covers DatabaseBackupMySQLi::setNoData
     *
     * @return void
     */
    public function testSetNoData()
    {
        $this->expected = true;
        $this->actual = $this->object->setNoData(true);
        $this->assertEquals($this->expected, $this->actual);
    }
}
