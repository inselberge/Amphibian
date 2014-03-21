<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/24/13
 * Time: 9:41 AM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once AMPHIBIAN_CORE_ABSTRACT_INTERFACES . "BasicFrontControllerInterface.php";
/**
 * Interface BasicFrontControllerMySQLiInterface
 *
 * @category BasicFrontController
 * @package  BasicFrontControllerMySQLiInterface
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/BasicFrontControllerMySQLiInterface
 */
interface BasicFrontControllerMySQLiInterface
    extends BasicFrontControllerInterface
{
    /** instance
     *
     * @param string $url a URL
     *
     * @return BasicFrontControllerMySQLi
     */
    static public function instance($url);

    /** factory
     *
     * @param string $url a URL
     *
     * @return BasicFrontControllerMySQLi
     */
    static public function factory($url);

    /** cascadeView
     *
     * @param array $locations an array of locations to look for the views
     *
     * @return bool
     */
    public function cascadeView( array $locations);
}