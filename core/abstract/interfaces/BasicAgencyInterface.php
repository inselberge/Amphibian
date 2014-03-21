<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/13/13
 * Time: 6:29 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once "BasicInteractionInterface.php";
/**
 * Class BasicAgencyInterface

 * @category Interface
 * @package  Core
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/BasicAgencyInterface
 */
interface BasicAgencyInterface
    extends BasicInteractionInterface
{

    /**  setChangeList
     *
     * @param array $changeList an array of the primary key values for mass changes
     *
     * @return boolean
     */
    public function setChangeList($changeList);

    /** appendChangeList
     *
     * @param array $changeList values to add to the change list
     *
     * @return bool
     */
    public function appendChangeList($changeList);

    /**   getChangeList
     *
     * @return array
     */
    public function getChangeList();

    /**  setAcceptableVars
     *
     * @param array $acceptableVars holds the acceptable variables for this agency
     *
     * @return boolean
     */
    public function setAcceptableVars($acceptableVars);

    /**   getAcceptableVars
     *
     * @return array
     */
    public function getAcceptableVars();

    /** checkVariable
     *
     * @param string $variable a variable name to try to use
     *
     * @return bool
     */
    public function checkVariable($variable);

    /** execute
     *
     * @return mixed
     */
    public function execute();
}