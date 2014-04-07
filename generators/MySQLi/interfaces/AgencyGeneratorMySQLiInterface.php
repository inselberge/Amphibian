<?php
/**
 * PHP version 5.5
 *
 * Created by PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 12/15/13
 * Time: 6:42 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once AMPHIBIAN_GENERATORS_ABSTRACT_INTERFACES."agencyGeneratorInterface.php";
//
/**
 * Interface AgencyGeneratorMySQLiInterface
 *
 * @category Generators
 * @package  AgencyGeneratorMySQLiInterface
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated
 * @link     documentation/AgencyGeneratorMySQLiInterface
 */
interface AgencyGeneratorMySQLiInterface
    extends AgencyGeneratorInterface
{
    /** instance
     *
     * @param $databaseConnection
     *
     * @return object
     */
    static public function instance($databaseConnection);

    /** factory
     *
     * @param $databaseConnection
     *
     * @return object
     */
    static public function factory($databaseConnection);
}
 