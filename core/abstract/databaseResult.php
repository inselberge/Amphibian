<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Carl "Tex" Morgan
 * Date: 4/1/13
 * Time: 1:57 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once "interfaces".DIRECTORY_SEPARATOR."databaseResultInterface.php";
/**
 * Class databaseResult
 * 
 * @category Core
 * @package  DatabaseQuery
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/databaseResult
 */
abstract class databaseResult
    implements databaseResultInterface
{
    /**
     * @var object databaseResult the result itself
     */
    protected $databaseResult;
    /**
     * @var int _numberOfFields the number of fields per row
     */
    protected $numberOfFields;
    /**
     * @var int _fieldLengths the length of each field
     */
    protected $fieldLengths;
    /**
     * @var int _numberOfRows the number of rows in the result
     */
    protected $numberOfRows;

    /** __construct
     */
    abstract protected function __construct();

    /** instance
     *
     * @param databaseConnection $databaseConnection a valid database connection
     *
     * @return databaseResult
     */
    abstract public function instance( databaseConnection $databaseConnection );

    /** seek
     *
     * @param int $offset the number of rows to offset
     *
     * @return bool
     */
    abstract public function seek( $offset );

    /** fetchAssociative
     *
     * @return array
     */
    abstract public function fetchAssociative();

    /** fetchNumeric
     *
     * @return array
     */
    abstract public function fetchNumeric();

    /** fetchAll
     *
     * @return array
     */
    abstract public function fetchAll();

    /** fetchObject
     *
     * @return mixed
     */
    abstract public function fetchObject();

    /** fetchRow
     *
     * @return mixed
     */
    abstract public function fetchRow();

    /** free
     *
     * @return mixed
     */
    abstract public function free();
}