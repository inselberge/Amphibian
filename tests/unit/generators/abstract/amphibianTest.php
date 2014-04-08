<?php
require_once AMPHIBIAN_TESTS."baseTest.php";
require_once AMPHIBIAN_GENERATORS_ABSTRACT."amphibian.php";
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-06-07 at 17:49:30.
 */
class amphibianTest
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
        $this->object = $this->getMockForAbstractClass("Amphibian");
    }

    /** testShow
     *
     * @covers Amphibian::show
     *
     * @return void
     */
    public function testShow()
    {
        $this->expected = null;
        $this->actual = $this->object->show();
        $this->assertEquals($this->expected, $this->actual);
    }
}