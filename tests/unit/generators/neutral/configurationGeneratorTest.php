<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_GENERATORS_NEUTRAL."configurationGenerator.php";
/**
 * Class configurationGeneratorTest
 *
 * @category UnitTests
 * @package  configurationGeneratorTest
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  GPL v3
 * @link     documentation/configurationGeneratorTest
 */
class configurationGeneratorTest extends BaseTest
{
    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = ConfigurationGenerator::factory();
    }

    /** testInstance
     *
     * @covers ConfigurationGenerator::instance
     * 
     * @returns void
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
     * @returns void
     */
    public function testFactory()
    {
        $this->expected = $this->object;
        $this->actual = ConfigurationGenerator::factory();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetAppName
     * 
     * @param $appName
     * 
     * @covers ConfigurationGenerator::setAppName
     *
     * @dataProvider projectNameDataProvider
     *
     * @returns void
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
     * @returns void
     */
    public function testGetAppName()
    {
        $this->expected = "";
        $this->actual = $this->object->getAppName();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetAppWebsite
     * 
     * @param $appWebsite
     * 
     * @covers ConfigurationGenerator::setAppWebsite
     *
     * @dataProvider websiteDataProvider
     *
     * @returns void
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
     * @returns void
     */
    public function testGetAppWebsite()
    {
        $this->expected = "";
        $this->actual = $this->object->getAppWebsite();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetBaseURI
     * 
     * @param $baseURI
     * 
     * @covers ConfigurationGenerator::setBaseURI
     *
     * @dataProvider goodFileLocationsDataProvider
     *
     * @returns void
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
     * @returns void
     */
    public function testGetBaseURI()
    {
        $this->expected = "";
        $this->actual = $this->object->getBaseURI();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetBaseURL
     * 
     * @param $baseURL
     * 
     * @covers ConfigurationGenerator::setBaseURL
     *
     * @dataProvider websiteDataProvider
     *
     * @returns void
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
     * @returns void
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
     * @returns void
     */
    public function testExecute()
    {
        $this->expected = true;
        $this->actual = $this->object->execute();
        $this->assertEquals($this->expected, $this->actual);
    }

}
