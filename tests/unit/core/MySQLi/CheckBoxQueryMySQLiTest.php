<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_CORE_MYSQLI."CheckBoxQueryMySQLi.php";

/**
 * Class CheckBoxQueryMySQLiTest
 *
 * @category ${NAMESPACE}
 * @package  CheckBoxQueryMySQLiTest
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license
 * @link
 */
class CheckBoxQueryMySQLiTest
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
        $this->arguments = DatabaseConnectionMySQLi::factory();
        $this->object = CheckBoxQueryMySQLi::factory($this->arguments);
    }

    /** testInstance
     *
     * @covers CheckBoxQueryMySQLi::instance
     *
     * @return void
     */
    public function testInstance()
    {
        $this->expected = $this->object;
        $this->actual = CheckBoxQueryMySQLi::instance($this->arguments);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testFactory
     *
     * @covers CheckBoxQueryMySQLi::factory
     *
     * @return void
     */
    public function testFactory()
    {
        $this->expected = $this->object;
        $this->actual = CheckBoxQueryMySQLi::factory($this->arguments);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetIdField
     *
     * @param string $idField        the value to set the id field to in the html
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers CheckBoxQueryMySQLi::setIdField
     *
     * @dataProvider setIdDataProvider
     *
     * @return void
     */
    public function testSetIdField($idField, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setIdField($idField);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** setIdDataProvider
     *
     * @return array
     */
    public function setIdDataProvider()
    {
        return array(
            array("", false),
            array("blah", true)
        );
    }

    /** testExecute
     *
     * @covers CheckBoxQueryMySQLi::execute
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
