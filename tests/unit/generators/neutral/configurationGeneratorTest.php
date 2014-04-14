<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_GENERATORS_NEUTRAL."configurationGenerator.php";
/**
 * Class ConfigurationGeneratorTest
 *
 * @category UnitTests
 * @package  ConfigurationGeneratorTest
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  GPL v3
 * @link     documentation/configurationGeneratorTest
 */
class ConfigurationGeneratorTest
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
        $this->object = ConfigurationGenerator::factory();
    }

    /** testInstance
     *
     * @covers ConfigurationGenerator::instance
     * 
     * @return void
     */
    public function testInstance()
    {
        $this->expected = $this->object;
        $this->actual = ConfigurationGenerator::instance();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testFactory
     *
     * @covers ConfigurationGenerator::factory
     * 
     * @return void
     */
    public function testFactory()
    {
        $this->expected = $this->object;
        $this->actual = ConfigurationGenerator::factory();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetAppName
     * 
     * @param string $appName the name of the application
     * 
     * @covers ConfigurationGenerator::setAppName
     *
     * @dataProvider projectNameDataProvider
     *
     * @return void
     */
    public function testSetAppName($appName)
    {
        $this->expected = true;
        $this->actual = $this->object->setAppName($appName);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetAppName
     * 
     * @covers ConfigurationGenerator::getAppName
     * 
     * @return void
     */
    public function testGetAppName()
    {
        $this->expected = "";
        $this->actual = $this->object->getAppName();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetAppWebsite
     * 
     * @param string $appWebsite the URL of the application website
     * 
     * @covers ConfigurationGenerator::setAppWebsite
     *
     * @dataProvider websiteDataProvider
     *
     * @return void
     */
    public function testSetAppWebsite($appWebsite)
    {
        $this->expected = true;
        $this->actual = $this->object->setAppWebsite($appWebsite);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetAppWebsite
     * 
     * @covers ConfigurationGenerator::getAppWebsite
     * 
     * @return void
     */
    public function testGetAppWebsite()
    {
        $this->expected = "";
        $this->actual = $this->object->getAppWebsite();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetBaseURI
     * 
     * @param string $baseURI the location of the base install
     * 
     * @covers ConfigurationGenerator::setBaseURI
     *
     * @dataProvider goodFileLocationsDataProvider
     *
     * @return void
     */
    public function testSetBaseURI($baseURI)
    {
        $this->expected = true;
        $this->actual = $this->object->setBaseURI($baseURI);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetBaseURI
     * 
     * @covers ConfigurationGenerator::getBaseURI
     * 
     * @return void
     */
    public function testGetBaseURI()
    {
        $this->expected = "";
        $this->actual = $this->object->getBaseURI();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetBaseURL
     * 
     * @param string $baseURL the URL of the base website
     * 
     * @covers ConfigurationGenerator::setBaseURL
     *
     * @dataProvider websiteDataProvider
     *
     * @return void
     */
    public function testSetBaseURL($baseURL)
    {
        $this->expected = true;
        $this->actual = $this->object->setBaseURL($baseURL);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetBaseURL
     * 
     * @covers ConfigurationGenerator::getBaseURL
     * 
     * @return void
     */
    public function testGetBaseURL()
    {
        $this->expected = "";
        $this->actual = $this->object->getBaseURL();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testExecute
     * 
     * @covers ConfigurationGenerator::execute
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
