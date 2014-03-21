<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/15/13
 * Time: 9:54 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
interface BasicBrowseInterface
    extends basicInteractionInterface
{
    /** instance
     *
     * @param resource $databaseConnection a valid database connection
     *
     * @return object
     */
    public static function instance($databaseConnection);

    /** setAgency
     *
     * @param object $agency a valid agency object
     *
     * @return bool
     */
    public function setAgency( $agency );

    /** setRenderMethod
     *
     * @param string $renderMethod the method to render the agency
     *
     * @return bool
     */
    public function setRenderMethod( $renderMethod );

    /** execute
     *
     * @return bool
     */
    public function execute();

    /** render
     *
     * @return bool
     */
    public function render();
}