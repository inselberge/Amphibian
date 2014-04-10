<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_CORE_NEUTRAL."DirectoryExtended.php";

/**
 * Class DirectoryExtendedTest
 *
 * @category Test
 * @package  DirectoryExtended
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     documentation/DirectoryExtendedTest
 *
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-09-08 at 17:05:31.
 *
 */
class DirectoryExtendedTest 
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
        $this->object = new DirectoryExtended();
        $this->object->setDirectoryName(__DIR__);
    }

    /** testChangeDirectory
     *
     * @covers DirectoryExtended::changeDirectory
     *
     * @return void
     */
    public function testChangeDirectory()
    {
        $this->expected = true;
        $this->actual = $this->object->changeDirectory();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testShowCurrentWorkingDirectory
     *
     * @covers DirectoryExtended::showCurrentWorkingDirectory
     *
     * @return void
     */
    public function testShowCurrentWorkingDirectory()
    {
        $this->expected = null;
        $this->actual = $this->object->showCurrentWorkingDirectory();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetDirectoryPermissions
     *
     * @param string $permissions the permissions of the directory
     *
     * @covers DirectoryExtended::setDirectoryPermissions
     *
     * @dataProvider permissionDataProvider
     *
     * @return void
     */
    public function testSetDirectoryPermissions($permissions)
    {
        $this->expected = true;
        $this->actual = $this->object->setDirectoryPermissions($permissions);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** directoryNameDataProvider
     *
     * @return array
     */
    public function directoryNameDataProvider()
    {
        return array(
            array(uniqid()),
            array(microtime())
        );
    }

    /** testSetDirectoryName
     *
     * @param string $name the name of the directory
     *
     * @covers DirectoryExtended::setDirectoryName
     *
     * @dataProvider directoryNameDataProvider
     *
     * @return void
     */
    public function testSetDirectoryName($name)
    {
        $this->expected = true;
        $this->actual = $this->object->setDirectoryName($name);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** directoryListDataProvider
     *
     * @return array
     */
    public function directoryListDataProvider()
    {
        return array(
            array(
                array(
                    uniqid(),
                    microtime(),
                    time()
                )
            )
        );
    }

    /** testSetDirectoryList
     *
     * @param array $list the list of directories
     *
     * @covers DirectoryExtended::setDirectoryList
     *
     * @dataProvider directoryListDataProvider
     *
     * @return void
     */
    public function testSetDirectoryList($list)
    {
        $this->expected = true;
        $this->actual = $this->object->setDirectoryList($list);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testOpen
     *
     * @covers DirectoryExtended::open
     *
     * @return void
     */
    public function testOpen()
    {
        $this->expected = true;
        $this->actual = $this->object->open();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testCheckIsDirectory
     *
     * @covers DirectoryExtended::checkIsDirectory
     *
     * @return void
     */
    public function testCheckIsDirectory()
    {
        $this->expected = true;
        $this->actual = $this->object->checkIsDirectory();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testRead
     *
     * @covers DirectoryExtended::read
     *
     * @return void
     */
    public function testRead()
    {
        $this->object->open();
        $this->expected = true;
        $this->actual = $this->object->read();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testRewind
     *
     * @covers DirectoryExtended::rewind
     *
     * @return void
     */
    public function testRewind()
    {
        $this->object->open();
        $this->expected = true;
        $this->actual = $this->object->rewind();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testClose
     *
     * @covers DirectoryExtended::close
     *
     * @return void
     */
    public function testClose()
    {
        $this->object->open();
        $this->expected = null;
        $this->actual = $this->object->close();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** sortingDataProvider
     *
     * @return array
     */
    public function sortingDataProvider()
    {
        return array(
            array(SCANDIR_SORT_ASCENDING),
            array(SCANDIR_SORT_DESCENDING),
            array(SCANDIR_SORT_NONE)
        );
    }

    /** testSetSortOrder
     *
     * @param string $order the order to sort the directory
     *
     * @covers DirectoryExtended::setSortOrder
     *
     * @dataProvider sortingDataProvider
     *
     * @return void
     */
    public function testSetSortOrder( $order )
    {
        $this->expected = true;
        $this->actual = $this->object->setSortOrder($order);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testScan
     *
     * @covers DirectoryExtended::scan
     *
     * @return void
     */
    public function testScan()
    {
        $this->expected = true;
        $this->actual = $this->object->scan();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testPrintContents
     *
     * @covers DirectoryExtended::printContents
     *
     * @return void
     */
    public function testPrintContents()
    {
        $this->expected = null;
        $this->actual = $this->object->printContents();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testExecute
     *
     * @covers DirectoryExtended::execute
     *
     * @return void
     */
    public function testExecute()
    {
        $this->expected = true;
        $this->actual = $this->object->execute();
        $this->assertEquals($this->expected, $this->actual);

    }

    /** testPrintItemName
     *
     * @covers DirectoryExtended::printItemName
     *
     * @return void
     */
    public function testPrintItemName()
    {
        $this->expected = null;
        $this->actual = $this->object->printItemName();
        $this->assertEquals($this->expected, $this->actual);
    }
}
