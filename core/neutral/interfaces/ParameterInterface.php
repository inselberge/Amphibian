<?php
/**
 * PHP Version 5.4.9-4ubuntu2.2
 *
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 9/12/13
 * Time: 2:19 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once "CheckInputInterface.php";
/**
 * Class ParameterInterface
 *
 * @category Interface
 * @package  Core
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/parameterInterface
 */
interface ParameterInterface
    extends CheckInputInterface
{
    /** instance
     * @param $path
     * @return mixed
     */
    static public function instance($path);
    public function execute();

    /** setVariables
     * @param array $vars
     * @return mixed
     */
    public function setVariables( array $vars );
    public function getVariables();
    public function getPathCount();

    /** getSpecificVariable
     * @param $key
     * @return mixed
     */
    public function getSpecificVariable($key);

    /** setSpecificVariable
     * @param $key
     * @param $value
     * @return mixed
     */
    public function setSpecificVariable($key,$value);

    /** appendSpecificVariable
     * @param $key
     * @param $value
     * @return mixed
     */
    public function appendSpecificVariable($key,$value);
    public function getDataVariables();
}