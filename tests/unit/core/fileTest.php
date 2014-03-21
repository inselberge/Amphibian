<?php
require_once __DIR__ . DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR.".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once __DIR__ . DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."baseTest.php";
require_once AMPHIBIAN_CORE."File.php";
/**
 * Class FileTest
 *
 * @category Test
 * @package  File
 * @author   Carl "Tex" Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     documentation/FileTest
 *
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-09-08 at 17:05:31.
 *
 */
class FileTest 
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
        $this->object = new File();
    }

    /** nameDataProvider
     *
     * @return array
     */
    public function nameDataProvider()
    {
        return array(
            array(microtime().".csv"),
            array(uniqid().".txt"),
            array("bob.xml")
        );
    }

    /** testCascade
     *
     * @param string $name the name of the File
     *
     * @covers File::setName
     *
     * @dataProvider nameDataProvider
     *
     * @return void
     */
    public function testSetName($name)
    {
        $this->expected = true;
        $this->actual = $this->object->setName($name);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** locationDataProvider
     *
     * @return array
     */
    public function locationDataProvider()
    {
        return array(
            array(__DIR__, __DIR__."/../")
        );
    }

    /** testCascade
     *
     * @param array $locations the places to look
     *
     * @covers File::cascade
     *
     * @dataProvider locationDataProvider
     *
     * @return void
     */
    public function testCascade($locations)
    {
        $this->expected = true;
        $this->actual = $this->object->cascade($locations);
        $this->assertEquals($this->expected, $this->actual);

    }

    /** testCopy
     *
     * @param string $destination the new destination
     *
     * @covers File::copy
     *
     * @dataProvider destinationDataProvider
     *
     * @return void
     */
    public function testCopy($destination)
    {
        $this->expected = true;
        $this->actual = $this->object->copy($destination);
        $this->assertEquals($this->expected, $this->actual);

    }

    /** testRename
     *
     * @param string $name the new name
     *
     * @covers File::rename
     *
     * @dataProvider nameDataProvider
     *
     * @return void
     */
    public function testRename($name)
    {
        $this->expected = true;
        $this->actual = $this->object->rename($name);
        $this->assertEquals($this->expected, $this->actual);

    }

    /** testDelete
     *
     * @covers File::delete
     *
     * @return void
     */
    public function testDelete()
    {
        $this->expected = true;
        $this->actual = $this->object->delete();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** ownerDataProvider
     *
     * @return array
     */
    public function ownerDataProvider()
    {
        return array(
            array("www-data"),
            array("root"),
            array("daemon"),
            array("syslog")
        );
    }

    /** testChangeOwner
     *
     * @param string $owner the new owner
     *
     * @covers File::changeOwner
     *
     * @dataProvider ownerDataProvider
     *
     * @return void
     */
    public function testChangeOwner($owner)
    {
        $this->expected = true;
        $this->actual = $this->object->changeOwner($owner);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** groupDataProvider
     *
     * @return array
     */
    public function groupDataProvider()
    {
        return array(
            array("sudo"),
            array("adm"),
            array("cdrom")
        );
    }

    /** testChangeGroup
     *
     * @param string $group the new group name
     *
     * @covers File::changeGroup
     *
     * @dataProvider groupDataProvider
     *
     * @return void
     */
    public function testChangeGroup($group)
    {
        $this->expected = true;
        $this->actual = $this->object->changeGroup($group);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testChangePermissions
     *
     * @param string $permissions the new permissions
     *
     * @covers File::changePermissions
     *
     * @dataProvider permissionDataProvider
     *
     * @return void
     */
    public function testChangePermissions($permissions)
    {
        $this->expected = true;
        $this->actual = $this->object->changePermissions($permissions);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testPrintAccessTime
     *
     * @covers File::printAccessTime
     *
     * @return void
     */
    public function testPrintAccessTime()
    {
        $this->expected = true;
        $this->actual = $this->object->printAccessTime();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testPrintChangeTime
     *
     * @covers File::printChangeTime
     *
     * @return void
     */
    public function testPrintChangeTime()
    {
        $this->expected = true;
        $this->actual = $this->object->printChangeTime();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testPrintFileGroup
     *
     * @covers File::printFileGroup
     *
     * @return void
     */
    public function testPrintFileGroup()
    {
        $this->expected = true;
        $this->actual = $this->object->printFileGroup();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testPrintFileOwner
     *
     * @covers File::printFileOwner
     *
     * @return void
     */
    public function testPrintFileOwner()
    {
        $this->expected = true;
        $this->actual = $this->object->printFileOwner();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testPrintFilePermissions
     *
     * @covers File::printFilePermissions
     *
     * @return void
     */
    public function testPrintFilePermissions()
    {
        $this->expected = true;
        $this->actual = $this->object->printFilePermissions();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testPrintFileSize
     *
     * @covers File::printFileSize
     *
     * @return void
     */
    public function testPrintFileSize()
    {
        $this->expected = true;
        $this->actual = $this->object->printFileSize();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testPrintFileType
     *
     * @covers File::printFileType
     *
     * @return void
     */
    public function testPrintFileType()
    {
        $this->expected = true;
        $this->actual = $this->object->printFileType();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testPrintDirectoryName
     *
     * @covers File::printDirectoryName
     *
     * @return void
     */
    public function testPrintDirectoryName()
    {
        $this->expected = true;
        $this->actual = $this->object->printDirectoryName();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testPrintBaseName
     *
     * @covers File::printBaseName
     *
     * @return void
     */
    public function testPrintBaseName()
    {
        $this->expected = true;
        $this->actual = $this->object->printBaseName();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testPrintExtension
     *
     * @covers File::printExtension
     *
     * @return void
     */
    public function testPrintExtension()
    {
        $this->expected = true;
        $this->actual = $this->object->printExtension();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testPrintFileName
     *
     * @covers File::printFileName
     *
     * @return void
     */
    public function testPrintFileName()
    {
        $this->expected = true;
        $this->actual = $this->object->printFileName();
        $this->assertEquals($this->expected, $this->actual);
    }
}
