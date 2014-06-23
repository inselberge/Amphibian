<?php
require_once __DIR__ . DIRECTORY_SEPARATOR
    . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_CORE_MYSQLI."databaseQueryPreparedMySQLi.php";
/**
 * Class DatabaseQueryPreparedMySQLiTest
 *
 * @category UnitTestsCoreMySQLi
 * @package  DatabaseQueryPreparedMySQLiTest
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  GPL v3
 * @link     documentation/databaseQueryPreparedMySQLiTest
 *
 */
class databaseQueryPreparedMySQLiTest 
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
        $this->connection = DatabaseConnectionMySQLi::factory();
        $this->object = databaseQueryPreparedMySQLi::factory($this->connection);
    }

    /** testInstance
     *
     * @return void
     */
    public function testInstance()
    {
        $this->expected = $this->object;
        $this->actual = DatabaseQueryPreparedMySQLi::instance($this->connection);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testFactory
     * @return void
     */
    public function testFactory()
    {
        $this->expected = $this->object;
        $this->actual = DatabaseQueryPreparedMySQLi::factory($this->connection);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testInit
     * @param $expectedResult
     * @return void
     */
    public function testInit($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->init();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testPrepare
     * @param $query
     * @param $expectedResult
     * @return void
     */
    public function testPrepare($query, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->prepare($query);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testBind
     * @param $typesVariables
     * @param $expectedResult
     * @return void
     */
    public function testBind($typesVariables, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->bind($typesVariables);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testExecute
     * @param $expectedResult
     * @return void
     */
    public function testExecute($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->execute();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testBindResult
     * @param array $variables
     * @param $expectedResult
     * @return void
     */
    public function testBindResult(array $variables, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->bindResult($variables);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testFreeResult
     * @param $expectedResult
     * @return void
     */
    public function testFreeResult($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->freeResult();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetResult
     * @param $expectedResult
     * @return void
     */
    public function testGetResult($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getResult();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testStoreResult
     * @param $expectedResult
     * @return void
     */
    public function testStoreResult($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->storeResult();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSeek
     * @param $offset
     * @param $expectedResult
     * @return void
     */
    public function testSeek($offset, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->seek($offset);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetAttribute
     * @param $attribute
     * @param $expectedResult
     * @return void
     */
    public function testGetAttribute($attribute, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getAttribute($attribute);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetAttribute
     * @param $attribute
     * @param $mode
     * @param $expectedResult
     * @return void
     */
    public function testSetAttribute($attribute, $mode, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setAttribute($attribute, $mode);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testFetch
     * @param $expectedResult
     * @return void
     */
    public function testFetch($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->fetch();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetWarnings
     * @param $expectedResult
     * @return void
     */
    public function testGetWarnings($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getWarnings();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testMore
     *
     * @param $expectedResult
     *
     * @return void
     */
    public function testMore($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->more();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testNext
     *
     * @param $expectedResult
     *
     * @return void
     */
    public function testNext($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->next();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testResultMetadata
     *
     * @param $expectedResult
     *
     * @return void
     */
    public function testResultMetadata($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->resultMetadata();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSendLongData
     *
     * @param $parameterNumber
     * @param $data
     * @param $expectedResult
     *
     * @return void
     */
    public function testSendLongData($parameterNumber, $data, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->sendLongData($parameterNumber, $data);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testReset
     *
     * @param $expectedResult
     *
     * @return void
     */
    public function testReset($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->reset();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testClose
     *
     * @param $expectedResult
     *
     * @return void
     */
    public function testClose($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->close();
        $this->assertEquals($this->expected, $this->actual);
    }
}
