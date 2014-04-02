<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Carl "Tex" Morgan
 * Date: 4/2/13
 * Time: 11:09 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once AMPHIBIAN_CORE_ABSTRACT . "BasicInteraction.php";
require_once "interfaces".DIRECTORY_SEPARATOR."sprocGeneratorInterface.php";

/**
 * Class SprocGenerator
 *
 * @category Generator
 * @package  SprocGenerator
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/SprocGenerator
 */
abstract class SprocGenerator
    extends BasicInteraction
    implements SprocGeneratorInterface
{
    /**
     * @var  _tableDescription
     */
    protected $_tableDescription;
    /**
     * @var  _connection
     */
    protected $_connection;
    /**
     * @var  _FileHandle
     */
    protected $_FileHandle;
    /**
     * @var  _tableNames
     */
    protected $_tableNames;
    /**
     * @var  currentTableName
     */
    protected $currentTableName;
    /**
     * @var  autoIncrementColumnName
     */
    protected $autoIncrementColumnName;
    /**
     * @var  _currentTableInputVariableList
     */
    protected $_currentTableInputVariableList;
    /**
     * @var  _currentTableColumnsCommaList
     */
    protected $_currentTableColumnsCommaList;
    /**
     * @var  _currentTableUpdatePairsList
     */
    protected $_currentTableUpdatePairsList;


    /** setTableNames
     *
     * @param array $array
     *
     * @return mixed
     */
    abstract public function setTableNames( array $array );

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

    /** writeAllSprocs
     *
     * @return mixed
     */
    abstract protected function writeAllSprocs();


    /** buildSprocQuery
     *
     * @param $queryType
     * @param $queryBody
     *
     * @return mixed
     */
    abstract protected function buildSprocQuery( $queryType, $queryBody );

    /** sprocGet
     *
     * @return mixed
     */
    abstract protected function sprocGet();

    /** sprocUpdate
     *
     * @return mixed
     */
    abstract protected function sprocUpdate();

    /** sprocInsert
     *
     * @return mixed
     */
    abstract protected function sprocInsert();

    /** sprocValidate
     *
     * @return mixed
     */
    abstract protected function sprocValidate();

    /** extractRequiredColumnsFromDescription
     *
     * @return mixed
     */
    abstract protected function extractRequiredColumnsFromDescription();

    /** extractPrimaryKeyColumnsFromDescription
     *
     * @return mixed
     */
    abstract protected function extractPrimaryKeyColumnsFromDescription();

    /** extractForeignKeyColumnsFromDescription
     *
     * @return mixed
     */
    abstract protected function extractForeignKeyColumnsFromDescription();

    /** makeInputVariableList
     *
     * @return mixed
     */
    abstract protected function makeInputVariableList();

    /** makeColumnsCommaList
     *
     * @return mixed
     */
    abstract protected function makeColumnsCommaList();

    /** makeUpdatePairsList
     *
     * @return mixed
     */
    abstract protected function makeUpdatePairsList();
}