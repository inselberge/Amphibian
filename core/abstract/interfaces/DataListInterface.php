<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/9/13
 * Time: 6:33 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
interface DataListInterface
    extends basicInteractionInterface
{
    /** setClass
     * @param $class
     * @return mixed
     */
    public function setClass( $class );
    public function getHtml();

    /** setId
     * @param $id
     * @return mixed
     */
    public function setId( $id );

    /** setTitle
     * @param $title
     * @return mixed
     */
    public function setTitle( $title );

    /** setPlaceholder
     * @param $placeholder
     * @return mixed
     */
    public function setPlaceholder( $placeholder );

    /** setLabelFields
     * @param $labelFields
     * @return mixed
     */
    public function setLabelFields( $labelFields );

    /** setName
     * @param $name
     * @return mixed
     */
    public function setName( $name );

    /** setLabel
     * @param $label
     * @return mixed
     */
    public function setLabel( $label );
    public function getQuery();

    /** setValueField
     * @param $valueField
     * @return mixed
     */
    public function setValueField( $valueField );
    public function getValueField();

    /** setSeparatorFields
     * @param $separatorFields
     * @return mixed
     */
    public function setSeparatorFields( $separatorFields );
    public function execute();
    public function showHTML();

    /** write
     * @param $fileName
     * @return mixed
     */
    public function write($fileName);

}