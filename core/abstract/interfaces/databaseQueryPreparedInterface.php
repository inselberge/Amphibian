<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/9/13
 * Time: 6:30 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */

interface DatabaseQueryPreparedInterface
{
    /** setResult
     * @param $result
     * @return mixed
     */
    public function setResult($result);
    public function getResult();

    /** setStatement
     * @param $statement
     * @return mixed
     */
    public function setStatement($statement);
    public function getStatement();

    /** setAffectedRows
     * @param $affectedRows
     * @return mixed
     */
    public function setAffectedRows($affectedRows);
    public function getAffectedRows();

    /** setError
     * @param $error
     * @return mixed
     */
    public function setError($error);
    public function getError();

    /** setErrorList
     * @param $errorList
     * @return mixed
     */
    public function setErrorList($errorList);
    public function getErrorList();

    /** setErrorNumber
     * @param $errorNumber
     * @return mixed
     */
    public function setErrorNumber($errorNumber);
    public function getErrorNumber();

    /** setFieldCount
     * @param $fieldCount
     * @return mixed
     */
    public function setFieldCount($fieldCount);
    public function getFieldCount();

    /** setInsertId
     * @param $insertId
     * @return mixed
     */
    public function setInsertId($insertId);
    public function getInsertId();

    /** setNumberOfRows
     * @param $numberOfRows
     * @return mixed
     */
    public function setNumberOfRows($numberOfRows);
    public function getNumberOfRows();

    /** setParameterCount
     * @param $parameterCount
     * @return mixed
     */
    public function setParameterCount($parameterCount);
    public function getParameterCount();

    /** setState
     * @param $state
     * @return mixed
     */
    public function setState($state);
    public function getState();
}