<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/9/13
 * Time: 6:21 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once AMPHIBIAN_CORE_NEUTRAL_INTERFACES ."CheckInputInterface.php";

/**
 * Interface databaseQueryInterface
 *
 * @category ${NAMESPACE}
 * @package  databaseQueryInterface
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated
 * @link     documentation/databaseQueryInterface
 */
interface databaseQueryInterface
    extends CheckInputInterface
{
    public function show();
    public function printRow();
    public function printNumberOfRows();
    public function printAffectedRows();
    public function printFieldCount();
    public function printArray();
    public function printErrors();
    public function printWarnings();
    public function getAffectedRows();
    public function getErrors();
    public function getFieldCount();
    public function getNumberOfRows();
    public function getWarnings();
    public function getWarningCount();
    public function checkAffected();
}