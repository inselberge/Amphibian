<?php

require_once __DIR__ . DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR.".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once __DIR__ . DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."baseTest.php";
require_once AMPHIBIAN_CORE . "FileLocation.php";
/**
 * Class fileLocationTest
 *
 * @category Test
 * @package  FileLocation
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     documentation/fileLocationTest
 *
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-09-08 at 17:05:31.
 *
 */
class fileLocationTest 
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
        $this->object = fileLocation::instance();
    }

    /** testInstance
     *
     * @covers fileLocation::instance
     *
     * @return void
     */
    public function testInstance()
    {
        $this->expected = $this->object;
        $this->actual = fileLocation::instance();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetFileName
     *
     * @param string $name the name to set
     *
     * @covers fileLocation::setFileName
     *
     * @dataProvider goodFileNameDataProvider
     *
     * @return void
     */
    public function testSetFileName($name)
    {
        $this->expected = true;
        $this->actual = $this->object->setFileName($name);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetFileName
     *
     * @covers fileLocation::getFileName
     *
     * @return void
     */
    public function testGetFileName()
    {
        $this->expected = "Bob.txt";
        $this->actual = $this->object->getFileName();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetSearchLocations
     *
     * @param array $locations the places to look
     *
     * @covers fileLocation::setSearchLocations
     *
     * @dataProvider goodFileLocationsDataProvider
     *
     * @return void
     */
    public function testSetSearchLocations($locations)
    {
        $this->expected = true;
        $this->actual = $this->object->setSearchLocations($locations);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetSearchLocations
     *
     * @covers fileLocation::getSearchLocations
     *
     * @return void
     */
    public function testGetSearchLocations()
    {
        $this->expected = array( ".", "/var/www", "~/Public/html" );
        $this->actual = $this->object->getSearchLocations();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetValidLocations
     *
     * @covers fileLocation::getValidLocations
     *
     * @return void
     */
    public function testGetValidLocations()
    {
        $this->expected = array();
        $this->actual = $this->object->getValidLocations();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testExecute
     *
     * @covers fileLocation::execute
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
