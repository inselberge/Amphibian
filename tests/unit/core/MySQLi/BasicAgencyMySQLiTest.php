<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_CORE_MYSQLI."BasicAgencyMySQLi.php";
/**
 * Class BasicAgencyMySQLiTest
 *
 * @category ${NAMESPACE}
 * @package  BasicAgencyMySQLiTest
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license
 * @link
 */
class BasicAgencyMySQLiTest
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
        $this->object = $this->getMockForAbstractClass('BasicAgencyMySQLi',$this->arguments);
    }

    /** testAcceptArgumentsDataPackage
     *
     * @covers BasicAgencyMySQLi::acceptArgumentsDataPackage
     *
     * @todo   Implement testAcceptArgumentsDataPackage().
     *
     * @return void
     */
    public function testAcceptArgumentsDataPackage($dataPackage, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->acceptArgumentsDataPackage($dataPackage);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** argumentsDataPackageDataProvider
     *
     * @return array
     */
    public function argumentsDataPackageDataProvider()
    {
        return array(
            array(new DataPackage, false),
            array(array(), false)
        );
    }

}
