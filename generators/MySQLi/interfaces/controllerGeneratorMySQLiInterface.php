<?php
/**
 * PHP Version 5.4.9-4ubuntu2.2
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 8/21/13
 * Time: 9:12 AM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once AMPHIBIAN_GENERATORS_ABSTRACT . "interfaces".DIRECTORY_SEPARATOR."ControllerGeneratorInterface.php";

/**
 * Interface ControllerGeneratorMySQLiInterface
 *
 * @category ${NAMESPACE}
 * @package  ControllerGeneratorMySQLiInterface
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated
 * @link     documentation/ControllerGeneratorMySQLiInterface
 */
interface ControllerGeneratorMySQLiInterface
    extends ControllerGeneratorInterface
{
    /** instance
     * @param $databaseConnection
     * @return mixed
     */
    static public function instance($databaseConnection);

    /** factory
     * @param $databaseConnection
     * @return mixed
     */
    static public function factory($databaseConnection);
}
