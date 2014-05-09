<?php
/**
 * Created by JetBrains PhpStorm.
 * User: carl
 * Date: 4/16/13
 * Time: 11:45 AM
 * To change this template use File | Settings | File Templates.
 */

abstract class ViewGeneratorCustom
{

    protected $configuration;
    protected $tableArray;
    protected $currentTableName;
    protected $tableDescription;
    protected $viewName;
    protected $viewQuery;

    /**
     *
     */
    abstract protected function __construct();
    abstract protected function makeConfigurationDropDown();
    abstract protected function loadConfiguration();
    abstract protected function getTableArray();
    abstract protected function makeTableArrayDropDown();
    abstract protected function getTableDescription();
    abstract protected function getViewName();

    abstract protected function makeViewStart();
    abstract protected function makeInArguments();
    abstract protected function makeOutArguments();

    abstract protected function addSelectClause();
    abstract protected function addFromClause();
    abstract protected function addGroupClause();
    abstract protected function addOrderClause();
    abstract protected function addWhereClause();
    abstract protected function addJoinClause();
    abstract protected function addOnClause();
    abstract protected function addLimitClause();
    abstract protected function addHavingClause();
    abstract protected function addDistinctClause();
    abstract protected function addUnionClause();
    abstract protected function addParenthesisClause();
    abstract protected function addLogicClause();

    abstract protected function makeViewEnd();
    
}