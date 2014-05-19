<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR
    . ".." . DIRECTORY_SEPARATOR . "baseTest.php";

require_once AMPHIBIAN_CORE_NEUTRAL . "EntityHeader.php";
/**
 * Class GeneralHeaderTest
 *
 * @category UnitTestsCoreNeutral
 * @package  GeneralHeaderTest
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  GPL v2
 * @link     documenation/GeneralHeaderTest
 */
class GeneralHeaderTest
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
        $this->object = GeneralHeader::factory();
    }


    /** testInstance
     *
     * @covers GeneralHeader::instance
     *
     * @return void
     */
    public function testInstance()
    {
        $this->expected = $this->object;
        $this->actual = GeneralHeader::instance();
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testFactory
     *
     * @covers GeneralHeader::factory
     *
     * @return void
     */
    public function testFactory()
    {
        $this->expected = $this->object;
        $this->actual = GeneralHeader::factory();
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testGetCacheControl
     *
     * @param mixed $expectedResult the expected result of the function call
     *
     * @covers GeneralHeader::getCacheControl
     *
     * @return void
     */
    public function testGetCacheControl($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getCacheControl();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetCacheControl
     *
     * @param mixed $value          the value to use
     * @param mixed $expectedResult true = success; false = failure
     *
     * @covers GeneralHeader::setCacheControl
     *
     * @return void
     */
    public function testSetCacheControl($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setCacheControl($value);
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testGetConnection
     *
     * @param mixed $expectedResult the expected result of the function call
     *
     * @covers GeneralHeader::getConnection
     *
     * @return void
     */
    public function testGetConnection($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getConnection();
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testSetConnection
     *
     * @param mixed $value          the value to use for the Connection
     * @param mixed $expectedResult true = success; false = failure
     *
     * @covers GeneralHeader::setConnection
     *
     * @return void
     */
    public function testSetConnection($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setConnection($value);
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testGetDate
     *
     * @param mixed $expectedResult the expected result of the function call
     *
     * @covers GeneralHeader::getDate
     *
     * @return void
     */
    public function testGetDate($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getDate();
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testSetDate
     *
     * @param mixed $value          the value to use for the Date
     * @param mixed $expectedResult true = success; false = failure
     *
     * @covers GeneralHeader::setDate
     *
     * @return void
     */
    public function testSetDate($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setDate($value);
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testGetPragma
     *
     * @param mixed $expectedResult the expected result of the function call
     *
     * @covers GeneralHeader::getPragma
     *
     * @return void
     */
    public function testGetPragma($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getPragma();
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testSetPragma
     *
     * @param mixed $value          the value to use for the Pragma
     * @param mixed $expectedResult true = success; false = failure
     *
     * @covers GeneralHeader::setPragma
     *
     * @return void
     */
    public function testSetPragma($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setPragma($value);
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testGetTrailer
     *
     * @param mixed $expectedResult the expected result of the function call
     *
     * @covers GeneralHeader::getTrailer
     *
     * @return void
     */
    public function testGetTrailer($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getTrailer();
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testSetTrailer
     *
     * @param mixed $value          the value to use for the Trailer
     * @param mixed $expectedResult true = success; false = failure
     *
     * @covers GeneralHeader::setTrailer
     *
     * @return void
     */
    public function testSetTrailer($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setTrailer($value);
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testGetTransferEncoding
     *
     * @param mixed $expectedResult the expected result of the function call
     *
     * @covers GeneralHeader::getTransferEncoding
     *
     * @return void
     */
    public function testGetTransferEncoding($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getTransferEncoding();
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testSetTransferEncoding
     *
     * @param mixed $value          the value to use for TransferEncoding
     * @param mixed $expectedResult true = success; false = failure
     *
     * @covers GeneralHeader::setTransferEncoding
     *
     * @return void
     */
    public function testSetTransferEncoding($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setTransferEncoding($value);
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testGetUpgrade
     *
     * @param mixed $expectedResult the expected result of the function call
     *
     * @covers GeneralHeader::getUpgrade
     *
     * @return void
     */
    public function testGetUpgrade($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getUpgrade();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetUpgrade
     *
     * @param mixed $value          the value to use for Upgrade
     * @param mixed $expectedResult true = success; false = failure
     *
     * @covers GeneralHeader::setUpgrade
     *
     * @return void
     */
    public function testSetUpgrade($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setUpgrade($value);
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testGetVia
     *
     * @param mixed $expectedResult the expected result of the function call
     *
     * @covers GeneralHeader::getVia
     *
     * @return void
     */
    public function testGetVia($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getVia();
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testSetVia
     *
     * @param mixed $value          the value to use for via
     * @param mixed $expectedResult true = success; false = failure
     *
     * @covers GeneralHeader::setVia
     *
     * @return void
     */
    public function testSetVia($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setVia($value);
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testGetWarning
     *
     * @param mixed $expectedResult the expected result of the function call
     *
     * @covers GeneralHeader::getWarning
     *
     * @return void
     */
    public function testGetWarning($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getWarning();
        $this->assertEquals($this->expected, $this->actual);
    }


    /** testSetWarning
     *
     * @param string $value          the warning
     * @param bool   $expectedResult true = success; false = failure
     *
     * @covers GeneralHeader::setWarning
     *
     * @return void
     */
    public function testSetWarning($value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setWarning($value);
        $this->assertEquals($this->expected, $this->actual);
    }
}
