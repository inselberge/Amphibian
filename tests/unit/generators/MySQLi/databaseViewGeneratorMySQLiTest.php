<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_GENERATORS_MYSQLI."databaseViewGeneratorMySQLi.php";
require_once AMPHIBIAN_CORE_MYSQLI . "databaseConnectionMySQLi.php";

/**
 * Class DatabaseViewGeneratorMySQLiTest
 *
 * @category ${NAMESPACE}
 * @package  DatabaseViewGeneratorMySQLiTest
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license
 * @link
 */
class DatabaseViewGeneratorMySQLiTest
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
        $this->connection = DatabaseConnectionMySQLi::factory();
        $this->connection->setOptions(MYSQLI_OPT_CONNECT_TIMEOUT, 10);
        $this->connection->setSSL(
            "/etc/mysql/client-key.pem",
            "/etc/mysql/client-cert.pem",
            "/etc/mysql/ca-cert.pem",
            "/etc/mysql/",
            'DHE-RSA-AES256-SHA'
        );
        $this->connection->setServerName("127.0.0.1");
        $this->connection->setDatabaseName("InnerAlly");
        $this->connection->setUserName("root");
        $this->connection->setUserPassword('4u$t1nTX');
        $this->connection->openConnection();
        $this->object = DatabaseViewGeneratorMySQLi::instance($this->connection);
    }

    /** testInstance
     *
     * @covers databaseViewGeneratorMySQLi::instance
     *
     * @return void
     */
    public function testInstance()
    {
        $this->expected = $this->object;
        $this->actual = DatabaseViewGeneratorMySQLi::instance($this->connection);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetTableNames
     *
     * @param array $names an array of valid table names
     *
     * @covers databaseViewGeneratorMySQLi::setTableNames
     *
     * @dataProvider tableNamesArrayDataProvider
     *
     * @return void
     */
    public function testSetTableNames($names)
    {
        $this->expected = true;
        $this->actual = $this->object->setTableNames($names);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** tableNamesArrayDataProvider
     *
     * @return array
     */
    public function tableNamesArrayDataProvider()
    {
        return array(
            array(
                array(
                    "Users",
                    "Login"
                )
            )
        );
    }

    /** testExecute
     *
     * @covers databaseViewGeneratorMySQLi::execute
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
