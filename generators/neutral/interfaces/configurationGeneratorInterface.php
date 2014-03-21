<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/10/13
 * Time: 1:24 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
interface configurationGeneratorInterface {
    /** setAppName
     * @param $appName
     * @return mixed
     */
    public function setAppName( $appName );
    public function getAppName();

    /** setAppWebsite
     * @param $appWebsite
     * @return mixed
     */
    public function setAppWebsite( $appWebsite );
    public function getAppWebsite();

    /** setBaseURI
     * @param $baseURI
     * @return mixed
     */
    public function setBaseURI( $baseURI );
    public function getBaseURI();

    /** setBaseURL
     * @param $baseURL
     * @return mixed
     */
    public function setBaseURL( $baseURL );
    public function getBaseURL();
    public function execute();
}