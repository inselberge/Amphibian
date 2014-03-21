<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/10/13
 * Time: 4:58 AM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
interface basicViewInterface
{
    /** setViewCustomBrowse
     * @param $view
     * @return mixed
     */
    public function setViewCustomBrowse( $view );

    /** setViewCustomForm
     * @param $view
     * @return mixed
     */
    public function setViewCustomForm( $view );

    /** setViewCustomPartials
     * @param $view
     * @return mixed
     */
    public function setViewCustomPartials( $view );
    public function execute();

    /** setDeviceType
     * @param $deviceType
     * @return mixed
     */
    public function setDeviceType( $deviceType );
    public function getDeviceType();

    /** setRenderMethod
     * @param $renderMethod
     * @return mixed
     */
    public function setRenderMethod( $renderMethod );
    public function getRenderMethod();

    /** setViewType
     * @param $viewType
     * @return mixed
     */
    public function setViewType( $viewType );
    public function getViewType();
}