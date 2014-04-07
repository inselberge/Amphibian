<?php
/**
 * PHP version ${PHP_VERSION}
 * Created by PhpStorm.
 * User: carl
 * Date: 3/31/14
 * Time: 10:52 PM
 */
require_once __DIR__. DIRECTORY_SEPARATOR . "..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."baseTest.php";
require_once AMPHIBIAN_TESTS . "baseTest.php";
require_once AMPHIBIAN_GENERATORS_NEUTRAL."amphibianProject.php";
/**
 * Class AmphibianProjectTest
 *
 * @category UnitTests
 * @package  AmphibianProjectTest
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  GPL v3
 * @link
 */
class AmphibianProjectTest
    extends BaseTest
{

    /** setUp
     *
     * @return void
     */
    protected function setUp()
    {
        $this->object = AmphibianProject::factory();
    }

    /** testInstance
     *
     * @covers AmphibianProject::instance
     *
     * @return void
     */
    public function testInstance()
    {
        $this->expected = $this->object;
        $this->actual = AmphibianProject::instance();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testFactory
     *
     * @covers AmphibianProject::factory
     *
     * @return void
     */
    public function testFactory()
    {
        $this->expected = $this->object;
        $this->actual = AmphibianProject::factory();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetName
     *
     * @param string $trialValue the value to try to use as a name
     * @param mixed  $expected   the expected result
     *
     * @covers AmphibianProject::setName
     *
     * @dataProvider setNameDataProvider
     *
     * @return void
     */
    public function testSetName($trialValue, $expected)
    {
        $this->expected = $expected;
        $this->actual = $this->object->setName($trialValue);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** setNameDataProvider
     *
     * @return array
     */
    public function setNameDataProvider()
    {
        return array(
            array("ProjectA", true),
            array("Project1", true),
            array(1, true),
            array("Project A", false)
        );
    }

    /** testGetName
     *
     * @param string $trialValue the value to try to get
     * @param mixed  $expected   the expected result
     *
     * @covers AmphibianProject::getName
     *
     * @dataProvider getNameDataProvider
     *
     * @return void
     */
    public function testGetName($trialValue, $expected)
    {
        $this->expected = $expected;
        $this->object->setName($trialValue);
        $this->actual = $this->object->getName();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** getNameDataProvider
     *
     * @return array
     */
    public function getNameDataProvider()
    {
        return array(
            array("ProjectA", "ProjectA"),
            array("Project1", "Project1"),
            array(1, "1"),
            array("Project A", false)
        );
    }

    /** testCheck
     *
     * @param string $trialValue the value to check
     * @param mixed  $expected   the expected result
     *
     * @covers AmphibianProject::check
     *
     * @dataProvider checkDataProvider
     *
     * @return void
     */
    public function testCheck($trialValue, $expected)
    {
        $this->expected = $expected;
        $this->actual = $this->object->check($trialValue);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** checkDataProvider
     *
     * @return array
     */
    public function checkDataProvider()
    {
        return array(
            array("ProjectA", false),
            array("Project1", false),
            array(1, false),
            array("Project A", false)
        );
    }


    /** testCreate
     *
     * @param string $trialValue the value to try to create
     * @param mixed  $expected   the expected result
     *
     * @covers AmphibianProject::create
     *
     * @dataProvider setNameDataProvider
     *
     * @return void
     */
    public function testCreate($trialValue, $expected)
    {
        $this->expected = $expected;
        $this->object->setName($trialValue);
        $this->actual = $this->object->create();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testRename
     *
     * @param string $originalValue the original value
     * @param string $trialValue    the value to try to rename to
     * @param mixed  $expected      the expected result
     *
     * @covers AmphibianProject::rename
     *
     * @return void
     */
    public function testRename($originalValue, $trialValue, $expected)
    {
        $this->expected = $expected;
        $this->object->setName($originalValue);
        $this->actual = $this->object->rename($trialValue);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testDelete
     *
     * @param string $trialValue the value to try to delete
     * @param mixed  $expected   the expected result
     *
     * @covers AmphibianProject::delete
     *
     * @dataProvider setNameDataProvider
     *
     * @return void
     */
    public function testDelete($trialValue, $expected)
    {
        $this->expected = $expected;
        $this->object->setName($trialValue);
        $this->actual = $this->object->delete();
        $this->assertEquals($this->expected, $this->actual);
    }
}
