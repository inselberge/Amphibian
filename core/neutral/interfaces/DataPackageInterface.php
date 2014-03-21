<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/11/13
 * Time: 4:09 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
interface dataPackageInterface {
    /**
     *
     */
    public function __construct();

    /** setErrors
     * @param $errors
     * @return mixed
     */
    public function setErrors( $errors );
    public function getErrors();

    /** setPayload
     * @param $payload
     * @return mixed
     */
    public function setPayload( $payload );
    public function getPayload();

    /** setQueryArguments
     * @param $queryArguments
     * @return mixed
     */
    public function setQueryArguments( $queryArguments );

    /** checkKeyInArray
     * @param $arrayName
     * @param $key
     * @return mixed
     */
    public function checkKeyInArray($arrayName, $key);

    /** addToArray
     * @param $arrayName
     * @param $arrayValues
     * @return mixed
     */
    public function addToArray($arrayName,$arrayValues);
    public function getQueryArguments();

    /** getSpecificPayload
     * @param $id
     * @return mixed
     */
    public function getSpecificPayload($id);

    /** getSpecificError
     * @param $id
     * @return mixed
     */
    public function getSpecificError($id);

    /** getSpecificQueryArguments
     * @param $id
     * @return mixed
     */
    public function getSpecificQueryArguments($id);
}