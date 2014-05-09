<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_GENERATORS_ABSTRACT."DecoratorGenerator.php";
/**
 * Class DecoratorGeneratorTest
 *
 * @category ${NAMESPACE}
 * @package  DecoratorGeneratorTest
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license
 * @link
 */
class DecoratorGeneratorTest
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
        $this->object = $this->getMockForAbstractClass('DecoratorGenerator');
    }

    /** testSetAgencyOrModelFlag
     *
     * @param string $value          either "agency" or "model"
     * @param bool   $expectedResult true = success, false = failure
     *
     * @covers DecoratorGenerator::setAgencyOrModelFlag
     *
     * @return void
     */
    public function testSetAgencyOrModelFlag($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setAgencyOrModelFlag($value);
        $this->assertEquals($this->expected, $this->actual);
    }
}
