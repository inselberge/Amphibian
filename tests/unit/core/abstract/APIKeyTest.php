<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_CORE_ABSTRACT."APIKey.php";
/**
 * Class APIKeyTest
 *
 * @category UnitTestsAbstract
 * @package  APIKeyTest
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  GPL v3
 * @link     documentation/APIKeyTest
 */
class APIKeyTest
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
        $this->object = $this->getMockForAbstractClass('APIKey');
    }

    /** testSetApplication
     *
     * @param string $value          the application value
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers APIKey::setApplication
     *
     * @return void
     */
    public function testSetApplication($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setApplication($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetApplication
     *
     * @param mixed $expectedResult the expected return
     *
     * @covers APIKey::getApplication
     *
     * @return void
     */
    public function testGetApplication($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getApplication();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetExpiration
     *
     * @param string $value          the expiration value
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers APIKey::setExpiration
     *
     * @return void
     */
    public function testSetExpiration($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setExpiration($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetExpiration
     *
     * @param mixed $expectedResult the expected return
     *
     * @covers APIKey::getExpiration
     *
     * @return void
     */
    public function testGetExpiration($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getExpiration();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetKey
     *
     * @param string $value          the key value
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers APIKey::setKey
     *
     * @return void
     */
    public function testSetKey($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setResponses($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetKey
     *
     * @param mixed $expectedResult the expected return
     *
     * @covers APIKey::getKey
     *
     * @return void
     */
    public function testGetKey($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getKey();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetLimit
     *
     * @param string $value          the limit value
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers APIKey::setLimit
     *
     * @return void
     */
    public function testSetLimit($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setLimit($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetLimit
     *
     * @param mixed $expectedResult the expected return
     *
     * @covers APIKey::getLimit
     *
     * @return void
     */
    public function testGetLimit($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getLimit();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetRequests
     *
     * @param string $value          the requests value
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers APIKey::setRequests
     *
     * @return void
     */
    public function testSetRequests($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setResponses($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetRequests
     *
     * @param mixed $expectedResult the expected return
     *
     * @covers APIKey::getRequests
     *
     * @return void
     */
    public function testGetRequests($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getRequests();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetResponses
     *
     * @param string $value          the responses value
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers APIKey::setResponses
     *
     * @return void
     */
    public function testSetResponses($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setResponses($value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetResponses
     *
     * @param mixed $expectedResult the expected return
     *
     * @covers APIKey::getResponses
     *
     * @return void
     */
    public function testGetResponses($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getResponses();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGenerate
     *
     * @covers APIKey::generate
     *
     * @return void
     */
    public function testGenerate()
    {
        $this->expected = true;
        $this->actual = $this->object->generate();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testRenew
     *
     * @covers APIKey::renew
     *
     * @return void
     */
    public function testRenew()
    {
        $this->expected = true;
        $this->actual = $this->object->renew();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testResetCounters
     *
     * @covers APIKey::resetCounters
     *
     * @return void
     */
    public function testResetCounters()
    {
        $this->expected = true;
        $this->actual = $this->object->resetCounters();
        $this->assertEquals($this->expected, $this->actual);
    }
}
