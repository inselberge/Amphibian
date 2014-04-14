<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_GENERATORS_NEUTRAL."CoreUpdate.php";
/**
 * Class CoreUpdateTest
 *
 * @category UnitTests
 * @package  CoreUpdate
 * @author   Carl "Tex" Morgan <texmorgan@amphibian.co>
 * @license  GPL v3
 * @link     documentation/CoreUpdateTest
 *
 */
class CoreUpdateTest 
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
        $this->object = CoreUpdate::instance();
    }

    /** testInstance
     *
     * @covers CoreUpdate::instance
     *
     * @return void
     */
    public function testInstance()
    {
        $this->expected = $this->object;
        $this->actual = CoreUpdate::instance();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testFactory
     *
     * @covers CoreUpdate::factory
     *
     * @return void
     */
    public function testFactory()
    {
        $this->expected = $this->object;
        $this->actual = CoreUpdate::factory();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetDestination
     *
     * @param string $location a valid file location
     *
     * @covers CoreUpdate::setDestination
     *
     * @dataProvider goodFileLocationsDataProvider
     *
     * @return void
     */
    public function testSetDestination($location)
    {
        $this->expected = true;
        $this->actual = $this->object->setDestination($location);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testExecute
     *
     * @covers CoreUpdate::execute
     *
     * @return void
     */
    public function testExecute()
    {
        $this->object->setDestination("/dev/null/");
        $this->expected = true;
        $this->actual = $this->object->execute();
        $this->assertEquals($this->expected, $this->actual);
    }
}
