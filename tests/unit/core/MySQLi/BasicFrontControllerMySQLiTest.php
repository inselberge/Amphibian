<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_CORE_MYSQLI."BasicFrontControllerMySQLi.php";

/**
 * Class BasicFrontControllerMySQLiTest
 *
 * @category UnitTests
 * @package  BasicFrontControllerMySQLiTest
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  GPL v3
 * @link     http://amphibian.co/documentation/BasicFrontControllerMySQLiTest
 */
class BasicFrontControllerMySQLiTest
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
        $this->arguments = "localhost/";
        $this->object = BasicFrontControllerMySQLi::factory($this->arguments);
    }

    /** testInstance
     *
     * @covers BasicFrontControllerMySQLi::instance
     *
     * @return void
     */
    public function testInstance()
    {
        $this->expected = $this->object;
        $this->actual = BasicFrontControllerMySQLi::instance($this->arguments);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testFactory
     *
     * @covers BasicFrontControllerMySQLi::factory
     *
     * @return void
     */
    public function testFactory()
    {
        $this->expected = $this->object;
        $this->actual = BasicFrontControllerMySQLi::factory($this->arguments);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testCascadeView
     *
     * @param array $locations      all the places to look
     * @param bool  $expectedResult true = success; false = failure
     *
     * @covers BasicFrontControllerMySQLi::cascadeView
     *
     * @dataProvider viewDataProvider
     *
     * @return void
     */
    public function testCascadeView($locations, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->cascadeView($locations);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** viewDataProvider
     *
     * @return array
     */
    public function viewDataProvider()
    {
        return array(
            array(
                array(),
                false
            ),
            array(
                array(__DIR__),
                true
            )
        );
    }
}
