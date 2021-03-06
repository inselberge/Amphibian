<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_CORE_ABSTRACT . "databaseQueryPrepared.php";
/**
 * Class databaseQueryPreparedTest
 *
 * @category 
 * @package  
 * @author   
 * @license  
 * @link     documentation/databaseQueryPreparedTest
 *
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-05-09 at 23:35:57.
 *
 */
class DatabaseQueryPreparedTest
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
        $this->object = $this->GetMockForAbstractClass('DatabaseQueryPrepared');
    }

    /** testSetResult
     *
     * @param $result
     * @param $expectedResult
     *
     * @covers DatabaseQueryPrepared::setResults
     *
     * @return void
     */
    public function testSetResult($result, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setResult($result);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetResult
     *
     * @param $expectedResult
     *
     * @covers DatabaseQueryPrepared::getResults
     *
     * @return void
     */
    public function testGetResult($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getResult();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetStatement
     *
     * @param $statement
     * @param $expectedResult
     *
     * @covers DatabaseQueryPrepared::setStatement
     *
     * @return void
     */
    public function testSetStatement($statement, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setStatement($statement);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetStatement
     *
     * @param $expectedResult
     *
     * @covers DatabaseQueryPrepared::getStatement
     *
     * @return void
     */
    public function testGetStatement($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getStatement();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetAffectedRows
     *
     * @param $affectedRows
     * @param $expectedResult
     *
     * @covers DatabaseQueryPrepared::setAffectedRows
     *
     * @return void
     */
    public function testSetAffectedRows($affectedRows, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setAffectedRows($affectedRows);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetAffectedRows
     *
     * @param $expectedResult
     *
     * @covers DatabaseQueryPrepared::getAffectedRows
     *
     * @return void
     */
    public function testGetAffectedRows($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getAffectedRows();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetError
     *
     * @param $error
     * @param $expectedResult
     *
     * @covers DatabaseQueryPrepared::setError
     *
     * @return void
     */
    public function testSetError($error, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setError($error);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetError
     *
     * @param $expectedResult
     *
     * @covers DatabaseQueryPrepared::getError
     *
     * @return void
     */
    public function testGetError($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getError();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetErrorList
     *
     * @param $errorList
     * @param $expectedResult
     *
     * @covers DatabaseQueryPrepared::setErrorList
     *
     * @return void
     */
    public function testSetErrorList($errorList, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setErrorList($errorList);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetErrorList
     *
     * @param $expectedResult
     *
     * @covers DatabaseQueryPrepared::getErrorList
     *
     * @return void
     */
    public function testGetErrorList($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getErrorList();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetErrorNumber
     *
     * @param $errorNumber
     * @param $expectedResult
     *
     * @covers DatabaseQueryPrepared::setErrorNumber
     *
     * @return void
     */
    public function testSetErrorNumber($errorNumber, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setErrorNumber($errorNumber);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetErrorNumber
     *
     * @param $expectedResult
     *
     * @covers DatabaseQueryPrepared::getErrorNumber
     *
     * @return void
     */
    public function testGetErrorNumber($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getErrorNumber();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetFieldCount
     *
     * @param $fieldCount
     * @param $expectedResult
     *
     * @covers DatabaseQueryPrepared::setFieldCount
     *
     * @return void
     */
    public function testSetFieldCount($fieldCount, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setFieldCount($fieldCount);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetFieldCount
     *
     * @param $expectedResult
     *
     * @covers DatabaseQueryPrepared::getFieldCount
     *
     * @return void
     */
    public function testGetFieldCount($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getFieldCount();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetInsertId
     *
     * @param $insertId
     * @param $expectedResult
     *
     * @covers DatabaseQueryPrepared::setInsertId
     *
     * @return void
     */
    public function testSetInsertId($insertId, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setInsertId($insertId);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetInsertId
     *
     * @param $expectedResult
     *
     * @covers DatabaseQueryPrepared::getInsertId
     *
     * @return void
     */
    public function testGetInsertId($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getInsertId();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetNumberOfRows
     *
     * @param $numberOfRows
     * @param $expectedResult
     *
     * @covers DatabaseQueryPrepared::setNumberOfRows
     *
     * @return void
     */
    public function testSetNumberOfRows($numberOfRows, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setNumberOfRows($numberOfRows);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetNumberOfRows
     *
     * @param $expectedResult
     *
     * @covers DatabaseQueryPrepared::getNumberOfRows
     *
     * @return void
     */
    public function testGetNumberOfRows($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getNumberOfRows();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetParameterCount
     *
     * @param $parameterCount
     * @param $expectedResult
     *
     * @covers DatabaseQueryPrepared::setParameterCount
     *
     * @return void
     */
    public function testSetParameterCount($parameterCount, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setParameterCount($parameterCount);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetParameterCount
     *
     * @param $expectedResult
     *
     * @covers DatabaseQueryPrepared::getParameterCount
     *
     * @return void
     */
    public function testGetParameterCount($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getParameterCount();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetState
     *
     * @param $state
     * @param $expectedResult
     *
     * @covers DatabaseQueryPrepared::setState
     *
     * @return void
     */
    public function testSetState($state, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setState($state);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetState
     *
     * @param $expectedResult
     *
     * @covers DatabaseQueryPrepared::getState
     *
     * @return void
     */
    public function testGetState($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getState();
        $this->assertEquals($this->expected, $this->actual);
    }
}
