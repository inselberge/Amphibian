<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_GENERATORS_ABSTRACT."BasicGenerator.php";
/**
 * Class BasicGeneratorTest
 *
 * @category UnitTests
 * @package  BasicGeneratorTest
 * @author   Carl "Tex" Morgan <texmorgan@amphibian.co>
 * @license  GPL v3
 * @link     documentation/BasicGeneratorTest
 *
 */
class BasicGeneratorTest 
	extends BaseTest
{
    /** setUp
     *
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @param resource $connection a valid database connection resource
     *
     * @dataProvider validDatabaseConnectionMySQLiDataProvider
     *
     * @return void
     */
    protected function setUp($connection)
    {
        $this->object = $this->getMockForAbstractClass('BasicGenerator',$connection);
    }

    /** testSetTableName
     *
     * @param string $name a valid table name
     *
     * @covers BasicGenerator::setTableName
     *
     * @dataProvider tableNameDataProvider
     *
     * @return void
     */
    public function testSetTableName($name)
    {
        $this->expected = true;
        $this->actual = $this->object->setTableName($name);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetFileDestination
     *
     * @param string $destination a valid destination for files
     *
     * @covers BasicGenerator::setFileDestination
     *
     * @dataProvider goodFileLocationsDataProvider
     *
     * @return void
     */
    public function testSetFileDestination($destination)
    {
        $this->expected = true;
        $this->actual = $this->object->setFileDestination($destination);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetFileExtension
     *
     * @param string $extension a valid file extension
     *
     * @covers BasicGenerator::setFileExtension
     *
     * @dataProvider validFileExtensionDataProvider
     *
     * @return void
     */
    public function testSetFileExtension($extension)
    {
        $this->expected = true;
        $this->actual = $this->object->setFileExtension($extension);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetFileExtension
     *
     * @covers BasicGenerator::getFileExtension
     *
     * @return void
     */
    public function testGetFileExtension()
    {
        $this->expected = ".php";
        $this->actual = $this->object->getFileExtension();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testExecute
     *
     * @covers BasicGenerator::execute
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
