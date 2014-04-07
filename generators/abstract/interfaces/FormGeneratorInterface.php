<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/10/13
 * Time: 1:15 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once AMPHIBIAN_GENERATORS_ABSTRACT_INTERFACES."BasicGeneratorInterface.php";

interface FormGeneratorInterface
    extends BasicGeneratorInterface
{
    /** setFormType
     * @param $formType
     * @return mixed
     */
    public function setFormType( $formType );
    public function execute();
}