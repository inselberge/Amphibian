<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/9/13
 * Time: 7:52 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
interface ValidatorInterface
{
    static public function instance();
    static public function factory();

    /** setArgumentArray
     * @param $argumentArray
     * @return mixed
     */
    public function setArgumentArray( $argumentArray );

    /** getSpecificValidator
     * @param $index
     * @return mixed
     */
    public function getSpecificValidator($index);

    /** setSpecificValidator
     * @param $index
     * @param $validator
     * @return mixed
     */
    public function setSpecificValidator($index,$validator);

    /** setSpecificFlags
     * @param $index
     * @param $flags
     * @return mixed
     */
    public function setSpecificFlags($index,$flags);

    /** setSpecificOptions
     * @param $index
     * @param $option
     * @param $optionValue
     * @return mixed
     */
    public function setSpecificOptions($index, $option, $optionValue);
    public function getArgumentArray();

    /** setDataArray
     * @param $dataArray
     * @return mixed
     */
    public function setDataArray( $dataArray );

    /** setSpecificDataArray
     * @param $index
     * @param $value
     * @return mixed
     */
    public function setSpecificDataArray($index, $value);
    public function getDataArray();
    public function execute();
    public function getResultArray();

    /** getSpecificResult
     * @param $index
     * @return mixed
     */
    public function getSpecificResult($index);
}