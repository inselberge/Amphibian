<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_GENERATORS_MYSQLI."amphibianMySQLi.php";
/**
 * Class amphibianMySQLiTest
 *
 * @category 
 * @package  
 * @author   
 * @license  
 * @link     documentation/amphibianMySQLiTest
 *
 */
class amphibianMySQLiTest 
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
        $this->object = AmphibianMySQLi::instance();
    }

    /** testInstance
     *
     * @covers AmphibianMySQLi::instance
     *
     * @return void
     */
    public function testInstance()
    {
        $this->expected = $this->object;
        $this->actual = AmphibianMySQLi::instance();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testExecute
     *
     * @covers AmphibianMySQLi::execute
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
