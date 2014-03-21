<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Carl "Tex" Morgan
 * Date: 5/4/13
 * Time: 2:44 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once "interfaces".DIRECTORY_SEPARATOR."databaseViewGeneratorInterface.php";
/**
 * Class DatabaseViewGenerator
 *
 * @category
 * @package  DatabaseViewGenerator
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/DatabaseViewGenerator
 */
abstract class DatabaseViewGenerator
    implements DatabaseViewGeneratorInterface
{
    /**
     * @var
     */
    protected $tableNames;
    /**
     * @var
     */
    protected $currentTable;
    /**
     * @var
     */
    protected $tableDescription;
    /**
     * @var
     */
    protected $requiredColumns;
    /**
     * @var
     */
    protected $connection;
    /**
     * @var
     */
    protected $query;
    /**
     * @var
     */
    protected $delimiter;
    /**
     * @var
     */
    protected $databaseQuery;
    /**
     * @var
     */
    protected $FileHandle;

    /** __autoload
     *
     * @return mixed
     */
    abstract protected function __autoload();

    /** __clone
     *
     * @return mixed
     */
    abstract protected function __clone();

    /** __construct
     *
     */
    abstract protected function __construct();

    /** setTableNames
     *
     * @param $array
     *
     * @return mixed
     */
    abstract public function setTableNames( $array );

    /** execute
     *
     * @return mixed
     */
    abstract public function execute();

    /** iterate
     *
     * @return mixed
     */
    abstract protected function iterate();

    /** initializeFileHandle
     *
     * @return mixed
     */
    abstract protected function initializeFileHandle();

    /** buildQuery
     *
     * @return mixed
     */
    abstract protected function buildQuery();

    /** changeDelimiter
     * @param $delim
     *
     * @return mixed
     */
    abstract protected function changeDelimiter( $delim );

    /** dropPreviousView
     *
     * @return mixed
     */
    abstract protected function dropPreviousView();

    /** getTableDescription
     *
     * @return mixed
     */
    abstract protected function getTableDescription();

    /** getRequiredColumns
     *
     * @return mixed
     */
    abstract protected function getRequiredColumns();

    /** buildView
     *
     * @return mixed
     */
    abstract protected function buildView();

    /** writeView
     *
     * @return mixed
     */
    abstract protected function writeView();

    /** loadView
     *
     * @return mixed
     */
    abstract protected function loadView();
}