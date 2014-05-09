<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_GENERATORS_MYSQLI. "databaseUserGeneratorMySQLi.php";
/**
 * Class DatabaseUserGeneratorMySQLiTest
 *
 * @category ${NAMESPACE}
 * @package  DatabaseUserGeneratorMySQLiTest
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license
 * @link
 */
class DatabaseUserGeneratorMySQLiTest
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

        $this->object = DatabaseUserGeneratorMySQLi::instance($this->connection);
    }

    /** testInstance
     *
     * @covers DatabaseUserGeneratorMySQLi::instance
     *
     * @return void
     */
    public function testInstance()
    {
        $this->expected = $this->object;
        $this->actual = DatabaseUserGeneratorMySQLi::instance($this->connection);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSet
     *
     * @param string $index          the field to set
     * @param mixed  $value          the value to set the field
     * @param bool   $expectedResult true = success, false = failure
     *
     * @covers DatabaseUserGeneratorMySQLi::set
     *
     * @dataProvider setDataProvider
     *
     * @return void
     */
    public function testSet($index, $value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->set($index, $value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** setDataProvider
     *
     * @return array
     */
    public function setDataProvider()
    {
        return array(
            array("compactedAppName", "", true),
            array("baseUserName", "", true),
            array("uppercaseFirstName", "", true),
            array("uppercaseName","",true),
            array("userName", "", true),
            array("password", "", true),
            array("userRights", "", true),
            array("databaseName","",true),
            array("databaseHost","localhost", true),
            array("fileHandle", FileHandle::instance("databaseUserGeneratorMySQLi.test"), true),
            array("content", "blah", true),
            array("databaseQuery", DatabaseQueryMySQLi::instance($this->connection), true),
            array("databaseConnection", $this->connection, true)
        );
    }

    /** testExecute
     *
     * @covers DatabaseUserGeneratorMySQLi::execute
     *
     * @return void
     */
    public function testExecute()
    {
        $this->expected = true;
        $this->actual = $this->object->execute();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testCreateDefaultUsers
     *
     * @covers DatabaseUserGeneratorMySQLi::createDefaultUsers
     *
     * @return void
     */
    public function testCreateDefaultUsers()
    {
        $this->expected = true;
        $this->actual = $this->object->createDefaultUsers();
        $this->assertEquals($this->expected, $this->actual);
    }
}
