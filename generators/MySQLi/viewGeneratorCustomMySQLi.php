<?php
/**
 * Created by JetBrains PhpStorm.
 * User: carl
 * Date: 4/16/13
 * Time: 11:50 AM
 * To change this template use File | Settings | File Templates.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once AMPHIBIAN_GENERATORS_ABSTRACT . "viewGeneratorCustom.php";
require_once AMPHIBIAN_GENERATORS_MYSQLI_INTERFACES."ViewGeneratorCustomMySQLiInterface.php";
class ViewGeneratorCustomMySQLi
    extends viewGeneratorCustom
    implements ViewGeneratorCustomMySQLiInterface
{

    protected function __construct()
    {
    }

    static public function instance()
    {

    }

    static public function factory()
    {

    }

    protected function makeConfigurationDropDown()
    {
    }

    protected function loadConfiguration()
    {
    }

    protected function getTableArray()
    {
    }

    protected function makeTableArrayDropDown()
    {
    }

    protected function getTableDescription()
    {
    }

    protected function getViewName()
    {
    }

    protected function makeViewStart()
    {
    }

    protected function makeInArguments()
    {
    }

    protected function makeOutArguments()
    {
    }

    protected function addSelectClause()
    {
    }

    protected function addFromClause()
    {
    }

    protected function addGroupClause()
    {
    }

    protected function addOrderClause()
    {
    }

    protected function addWhereClause()
    {
    }

    protected function addJoinClause()
    {
    }

    protected function addOnClause()
    {
    }

    protected function addLimitClause()
    {
    }

    protected function addHavingClause()
    {
    }

    protected function addDistinctClause()
    {
    }

    protected function addUnionClause()
    {
    }

    protected function addParenthesisClause()
    {
    }

    protected function addLogicClause()
    {
    }

    protected function makeViewEnd()
    {
    }
}