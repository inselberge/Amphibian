<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/9/13
 * Time: 5:00 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once AMPHIBIAN_CORE_ABSTRACT_INTERFACES . "BasicInteractionInterface.php";

/**
 * Interface BasicModelInterface
 *
 * @category BasicModel
 * @package  BasicModelInterface
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
* @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/
 */
interface BasicModelInterface
    extends BasicInteractionInterface
{
    /** setFilter
     *
     * @param string $key the index attempted to set
     * @param object $filter a filter object
     *
     * @return bool
     */
    public function setFilter($key, $filter);

    /** setValidator
     *
     * @param string $key the index attempted to set
     * @param object $validator a validator object
     *
     * @return bool
     */
    public function setValidator($key, $validator);

    /** setSanitizer
     *
     * @param string $key the index attempted to set
     * @param object $sanitizer a sanitizer object
     *
     * @return bool
     */
    public function setSanitizer($key, $sanitizer);

    /** setValuesFromRow
     *
     * @return bool
     */
    public function setValuesFromRow();

    /** extract
     *
     * @return bool
     */
    public function extract();

    /** extractPayload
     *
     * @return bool
     */
    public function extractPayload();

    /** getAcceptableKeys
     *
     * @return array
     */
    public function getAcceptableKeys();
}