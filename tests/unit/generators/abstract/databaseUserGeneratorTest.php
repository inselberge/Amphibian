<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_GENERATORS_ABSTRACT."databaseUserGenerator.php";
/**
 * Class DatabaseUserGeneratorTest
 *
 * @category ${NAMESPACE}
 * @package  DatabaseUserGeneratorTest
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license
 * @link
 */
class DatabaseUserGeneratorTest
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
        $this->object = $this->getMockForAbstractClass('DatabaseUserGenerator');
    }

    /** testMakeUserName
     *
     * @param string $value          the name to use
     * @param bool   $expectedResult true = success, false = failure
     *
     * @covers DatabaseUserGenerator::makeUserName
     *
     * @return void
     */
    public function testMakeUserName($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->makeUserName($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testShow
     *
     * @covers DatabaseUserGenerator::show
     *
     * @return void
     */
    public function testShow()
    {
        $this->expected = null;
        $this->actual = $this->object->show();
        $this->assertEquals($this->expected, $this->actual);
    }
}
