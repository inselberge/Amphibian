<?php
/**
 * PHP version 5.5.3
 * Created by PhpStorm.
 * User: carl
 * Date: 4/9/14
 * Time: 8:59 PM
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_TESTS_UNIT . "baseTest.php";
require_once AMPHIBIAN_GENERATORS_NEUTRAL . "ConfigurationLoader.php";

/**
 * Class ConfigurationLoaderTest
 *
 * @category UnitTests
 * @package  ConfigurationLoaderTest
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  GPL v3
 * @link     documentation/ConfigurationLoaderTest
 */
class ConfigurationLoaderTest
    extends BaseTest
{

    /** setUp
     *
     * @return void
     */
    protected function setUp()
    {
        $this->object = ConfigurationLoader::factory("InnerAlly_SC");
    }

    /** testInstance
     *
     * @param string $projectName the project name to use
     * @param object $expected    the expected object to return
     *
     * @covers ConfigurationLoader::instance
     *
     * @dataProvider projectNameDataProvider
     *
     * @return void
     */
    public function testInstance($projectName, $expected)
    {
        $this->expected = $expected;
        $this->actual = ConfigurationLoader::instance($projectName);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** projectNameDataProvider
     *
     * @return array
     */
    public function projectNameDataProvider()
    {
        return array(
            array("InnerAlly_SC", ConfigurationLoader::factory("InnerAlly_SC")),
            array("InnerAlly_RR", ConfigurationLoader::factory("InnerAlly_RR"))
        );
    }

    /** testFactory
     *
     * @param string $projectName the project name to use
     * @param object $expected    the expected object to return
     *
     * @covers ConfigurationLoader::factory
     *
     * @dataProvider projectNameDataProvider
     *
     * @return void
     */
    public function testFactory($projectName, $expected)
    {
        $this->expected = $expected;
        $this->actual = ConfigurationLoader::factory($projectName);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetConfigurationFile
     *
     * @covers ConfigurationLoader::getConfigurationFile
     *
     * @return void
     */
    public function testGetConfigurationFile()
    {
        $this->markTestIncomplete("This has not been implemented yet.");
    }

    /** testSetConfigurationFile
     *
     * @param string $configurationFile the configuration file to load
     *
     * @covers ConfigurationLoader::setConfigurationFile
     *
     * @dataProvider goodFileNameDataProvider
     *
     * @return void
     */
    public function testSetConfigurationFile($configurationFile)
    {
        $this->expected = true;
        $this->actual = $this->object->setConfigurationFile($configurationFile);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetDatabase
     *
     * @covers ConfigurationLoader::getDatabase
     *
     * @return void
     */
    public function testGetDatabase()
    {
        $this->markTestIncomplete("This has not been implemented yet.");
    }

    /** testSetDatabase
     *
     * @param bool $databaseValue true = database configuration; false = system
     *
     * @covers ConfigurationLoader::setDatabase
     *
     * @dataProvider booleanDataProvider
     *
     * @return void
     */
    public function testSetDatabase($databaseValue)
    {
        $this->expected = true;
        $this->actual = $this->object->setDatabase($databaseValue);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetDatabaseUser
     *
     * @covers ConfigurationLoader::getDatabaseUser
     *
     * @return void
     */
    public function testGetDatabaseUser()
    {
        $this->markTestIncomplete("This has not been implemented yet.");
    }

    /** testSetDatabaseUser
     *
     * @param string $databaseUser the database user to look for in the file
     *
     * @covers ConfigurationLoader::setDatabaseUser
     *
     * @dataProvider databaseUserDataProvider
     *
     * @return void
     */
    public function testSetDatabaseUser($databaseUser)
    {
        $this->expected = true;
        $this->actual = $this->object->setDatabaseUser($databaseUser);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetProduction
     *
     * @covers ConfigurationLoader::getProduction
     *
     * @return void
     */
    public function testGetProduction()
    {
        $this->markTestIncomplete("This has not been implemented yet.");
    }

    /** testSetProduction
     *
     * @param bool $productionValue true = production; false = staging
     *
     * @covers ConfigurationLoader::setProduction
     *
     * @dataProvider booleanDataProvider
     *
     * @return void
     */
    public function testSetProduction($productionValue)
    {
        $this->expected = true;
        $this->actual = $this->object->setProduction($productionValue);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetProjectName
     *
     * @covers ConfigurationLoader::getProjectName
     *
     * @return void
     */
    public function testGetProjectName()
    {
        $this->markTestIncomplete("This has not been implemented yet.");
    }

    /** testSetProjectName
     *
     * @param string $projectName the project name to use
     *
     * @covers ConfigurationLoader::setProjectName
     *
     * @dataProvider projectNameDataProvider
     *
     * @return void
     */
    public function testSetProjectName($projectName)
    {
        $this->expected = true;
        $this->actual = $this->object->setProjectName($projectName);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testExecute
     *
     * @covers ConfigurationLoader::execute
     *
     * @return void
     */
    public function testExecute()
    {
        $this->markTestIncomplete("This has not been implemented yet.");
    }

}
 