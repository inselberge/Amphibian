<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/9/13
 * Time: 6:12 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
interface checkBoxGroupInterface {
    /** instance
     * @param $checkboxArray
     * @param $checkboxName
     * @return mixed
     */
    static public function instance( $checkboxArray, $checkboxName );

    /** setMultipleBreak
     * @param $x
     * @return mixed
     */
    public function setMultipleBreak( $x );

    /** setHorizontalOrVertical
     * @param $x
     * @return mixed
     */
    public function setHorizontalOrVertical( $x );

    /** setLegendLabel
     * @param $name
     * @return mixed
     */
    public function setLegendLabel( $name );
    public function execute();
    public function printArray();
    public function printHTML();
}