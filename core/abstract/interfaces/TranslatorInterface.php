<?php
/**
 * PHP Version 5.4.9-4ubuntu2.2
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 9/15/13
 * Time: 8:22 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */

interface TranslatorInterface
{
    /** setOriginal
     * @param $original
     * @return mixed
     */
    public function setOriginal( $original );
    public function getOriginal();
    public function getTranslation();
}
