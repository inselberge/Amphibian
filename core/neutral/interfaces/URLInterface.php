<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/25/13
 * Time: 11:07 AM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
interface URLInterface {
    /** instance
     * @param $urlString
     * @return mixed
     */
    static public function instance( $urlString );

    /** setUrlString
     * @param $urlString
     * @return mixed
     */
    public function setUrlString( $urlString );
    public function execute();
    public function explodeURLFull();
    public function getFragment();
    public function getHost();
    public function getPass();
    public function getPath();
    public function getPort();
    public function getQuery();
    public function getSchemeFromProtocol();
    public function getScheme();
    public function getUser();

    /** setRawURL
     * @param $rawURL
     * @return mixed
     */
    public function setRawURL( $rawURL );
    public function getRawURL();
    public function rawEncode();
    public function rawDecode();
    public function encode();
    public function decode();

    /** setHeaders
     * @param $headers
     * @return mixed
     */
    public function setHeaders( $headers );
    public function getHeaders();
    public function extractHeaders();

    /** setMetaTags
     * @param $metaTags
     * @return mixed
     */
    public function setMetaTags( $metaTags );
    public function getMetaTags();
    public function extractMetaTags();
}