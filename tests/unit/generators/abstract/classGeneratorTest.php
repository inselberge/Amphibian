<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_GENERATORS_ABSTRACT."classGenerator.php";
/**
 * Class classGeneratorTest
 *
 * @category ${NAMESPACE}
 * @package  classGeneratorTest
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license
 * @link
 */
class ClassGeneratorTest
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
        $this->object = $this->getMockForAbstractClass('ClassGenerator');
    }

    /** testSetAuthor
     *
     * @param string $value          the author of the code
     * @param bool   $expectedResult true = success, false = failure
     *
     * @covers ClassGenerator::setAuthor
     *
     * @return void
     */
    public function testSetAuthor($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setAuthor($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetAuthor
     *
     * @param string $expectedResult the author of the code
     *
     * @covers ClassGenerator::getAuthor
     *
     * @return void
     */
    public function testGetAuthor($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getAuthor();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetLicense
     *
     * @param string $value          the specific license to have the code under
     * @param bool   $expectedResult true = success, false = failure
     *
     * @covers ClassGenerator::setLicense
     *
     * @return void
     */
    public function testSetLicense($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setLicense($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetLicense
     *
     * @param string $expectedResult the specific license to have the code under
     *
     * @covers ClassGenerator::getLicense
     *
     * @return void
     */
    public function testGetLicense($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getLicense();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetLink
     *
     * @param string $value          the link to use for the class
     * @param bool   $expectedResult true = success, false = failure
     *
     * @covers ClassGenerator::setLink
     *
     * @return void
     */
    public function testSetLink($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setLink($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetLink
     *
     * @param string $expectedResult the expected link string
     *
     * @covers ClassGenerator::getLink
     *
     * @return void
     */
    public function testGetLink($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getLink();
        $this->assertEquals($this->expected, $this->actual);
    }
}
