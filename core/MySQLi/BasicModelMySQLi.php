<?php
/**
 * PHP version 5.5
 * Created by PhpStorm.
 * User: texmorgan
 * Date: 2/18/14
 * Time: 12:59 PM
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once AMPHIBIAN_CORE_ABSTRACT."BasicModel.php";
require_once AMPHIBIAN_CORE_MYSQLI . "databaseQueryMySQLi.php";
require_once "interfaces".DIRECTORY_SEPARATOR."BasicModelMySQLiInterface.php";
/**
 * Class BasicModelMySQLi
 *
 * @category BasicModel
 * @package  BasicModelMySQLi
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated
 * @link     documentation/BasicModelMySQLi
 */
abstract class BasicModelMySQLi
    extends BasicModel
    implements BasicModelMySQLiInterface
{
    /** prepQuery
     *
     * @return bool
     */
    protected function prepQuery()
    {
        $this->query = databaseQueryMySQLi::instance($this->connection);
        if (isset($this->query)) {
            return true;
        } else {
            return false;
        }
    }
} 