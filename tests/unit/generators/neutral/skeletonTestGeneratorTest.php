<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_GENERATORS_NEUTRAL."skeletonTestGenerator.php";

/**
 * Class SkeletonTestGeneratorTest
 *
 * @category UnitTests
 * @package  SkeletonTestGeneratorTest
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  GPL v3
 * @link     documentation/SkeletonTestGeneratorTest
 */
class SkeletonTestGeneratorTest
    extends BaseTest
{
    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp()
    {
        $this->object = SkeletonTestGenerator::instance(".");
    }

    /** testInstance
     *
     * @param string $source the source directory
     *
     * @covers skeletonTestGenerator::instance
     *
     * @return void
     */
    public function testInstance($source)
    {
        $this->expected = $this->object;
        $this->actual = SkeletonTestGenerator::instance($source);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetDestination
     *
     * @param string $destination a valid destination for the test
     *
     * @covers skeletonTestGenerator::setDestination
     *
     * @return void
     */
    public function testSetDestination($destination)
    {
        $this->expected = true;
        $this->actual = $this->object->setDestination($destination);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testExecute
     *
     * @covers skeletonTestGenerator::execute
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
