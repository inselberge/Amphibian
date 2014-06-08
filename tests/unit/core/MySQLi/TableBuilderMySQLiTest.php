<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_CORE."TableBuilderMySQLi.php";

/**
 * Class TableBuilderMySQLiTest
 *
 * @category ${NAMESPACE}
 * @package  TableBuilderMySQLiTest
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license
 * @link
 */
class TableBuilderMySQLiTest
    extends BaseTest
{
    /**
     * @var  connection
     */
    protected $connection;
    /**
     * @var  resultSet
     */
    protected $resultSet;

    /** setUp
     *
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp()
    {
        $this->connection = DatabaseConnectionMySQLi::factory();
        $this->resultSet = null;
        $this->arguments = "tableName";
        $this->object = TableBuilderMySQLi::factory($this->connection, $this->resultSet, $this->arguments);
    }

    /** testInstance
     *
     * @covers TableBuilderMySQLi::instance
     *
     * @return void
     */
    public function testInstance()
    {
        $this->expected = $this->object;
        $this->actual = TableBuilderMySQLi::instance($this->connection, $this->resultSet, $this->arguments);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testFactory
     *
     * @covers TableBuilderMySQLi::factory
     *
     * @return void
     */
    public function testFactory()
    {
        $this->expected = $this->object;
        $this->actual = TableBuilderMySQLi::factory($this->connection, $this->resultSet, $this->arguments);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testExecute
     *
     * @covers TableBuilderMySQLi::execute
     *
     * @return void
     */
    public function testExecute()
    {
        $this->expected = true;
        $this->actual = $this->object->execute();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testExecuteFromPayload
     *
     * @param array $payload        the information to print
     * @param bool  $expectedResult true = success; false = failure
     *
     * @covers TableBuilderMySQLi::executeFromPayload
     *
     * @dataProvider executeFromPayloadDataProvider
     *
     * @return void
     */
    public function testExecuteFromPayload($payload, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = TableBuilderMySQLi::executeFromPayload($this->arguments, $payload);
        $this->assertEquals($this->expected, $this->actual);
    }
}
