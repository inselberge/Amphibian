<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/9/13
 * Time: 4:55 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once AMPHIBIAN_CORE_NEUTRAL_INTERFACES."CheckInputInterface.php";

/**
 * Interface BasicInteractionInterface
 */
interface BasicInteractionInterface
    extends CheckInputInterface
{
    /** printByKey
     *
     * @param string $key the name of the variable you want to print
     *
     * @return bool
     */
    public function printByKey( $key );

    /** getByKey
     *
     * @param string $key the name of the variable you want to get
     *
     * @return mixed
     */
    public function getByKey( $key );

    /** showSelf
     *
     * @return bool
     */
    public function showSelf();

    /** getErrors
     *
     * @return array
     */
    public function getErrors();

    /** setDataPackage
     *
     * @param object $dataPackage a valid DataPackage object
     *
     * @return bool
     */
    public function setDataPackage($dataPackage);

    /** getDataPackage
     *
     * @return object
     */
    public function getDataPackage();

    /** checkDataPackageSet
     *
     * @return bool
     */
    public function checkDataPackageSet();
}