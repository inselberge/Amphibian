<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/9/13
 * Time: 7:40 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
interface sanitizerInterface
{
    /** setFlags
     * @param $flags
     * @return mixed
     */
    public function setFlags( $flags );

    public function getFlags();

    /** setVariable
     * @param $variable
     * @return mixed
     */
    public function setVariable( $variable );

    public function getVariable();

    /** setSanitationFilter
     * @param $sanitationFilter
     * @return mixed
     */
    public function setSanitationFilter( $sanitationFilter );

    public function getSanitationFilter();

    public function execute();
}