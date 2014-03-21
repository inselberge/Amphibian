<?php

require __DIR__ . DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."config.inc.php";
require_once AMPHIBIAN_GENERATORS_ABSTRACT."BasicGenerator.php";
require_once "interfaces".DIRECTORY_SEPARATOR."StandardViewBuilderInterface.php";
/**
 * Class StandardViewBuilder
 *
 * @category StandardViewBuilder
 * @package  StandardViewBuilder
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/StandardViewBuilder
 */
abstract class StandardViewBuilder
    extends BasicGenerator
    implements StandardViewBuilderInterface
{
    /**
     * @var string requiredColumnList the list of columns to use in the view
     */
    protected $requiredColumnList = "";

    /** iterate
     *
     * @return void
     */
    protected function iterate()
    {
        if ($this->setupRequiredColumnList() ) {
            $this->buildView();
        }
    }

    /** setupRequiredColumnList
     *
     * @return bool
     */
    abstract protected function setupRequiredColumnList();

    /** buildView
     *
     * @return bool
     */
    abstract protected function buildView();
}