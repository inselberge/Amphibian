<?php
/**
 * PHP Version: ${PHP_VERSION}
 * Created by PhpStorm.
 * User: carl
 * Date: 1/28/14
 * Time: 11:49 AM
 */
/**
 * Interface TableBuilderInterface
 *
 * @category TableBuilder
 * @package  TableBuilderInterface
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/TableBuilderInterface
 */
interface TableBuilderInterface
    extends BasicInteractionInterface
{
    /** setOption
     * @param $key
     * @param $value
     * @return mixed
     */
    public function setOption($key, $value);

    public function printHead();

    public function printBody();

    public function printFoot();

    public function printStartTable();

    static public function printEndTable();

    static public function printStartBody();

    static public function printEndBody();

    public function printPager();

    public function printScripts();

    public function printCSS();

} 