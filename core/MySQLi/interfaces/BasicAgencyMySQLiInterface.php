<?php
/**
 * PHP Version: ${PHP_VERSION}
 * Created by PhpStorm.
 * User: carl
 * Date: 1/21/14
 * Time: 9:59 AM
 */
require_once AMPHIBIAN_CORE_ABSTRACT_INTERFACES."BasicAgencyInterface.php";
/**
 * Class BasicAgencyMySQLiInterface
 *
 * @category BasicAgency
 * @package  BasicAgencyMySQLiInterface
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
* @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/
 */
interface BasicAgencyMySQLiInterface
    extends BasicAgencyInterface
{
    /** acceptArgumentsDataPackage
     *
     * @param object $dataPackage a dataPackage object with query specifics
     *
     * @return mixed
     */
    public function acceptArgumentsDataPackage($dataPackage);
} 