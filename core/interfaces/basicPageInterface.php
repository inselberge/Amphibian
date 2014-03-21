<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/9/13
 * Time: 5:11 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
interface basicPageInterface  {
    /** setAgencies
     * @param $agencies
     * @return mixed
     */
    public function setAgencies( $agencies );
    public function getAgencies();

    /** setAuthor
     * @param $author
     * @return mixed
     */
    public function setAuthor( $author );
    public function getAuthor();

    /** setBrowserCheck
     * @param $browserCheck
     * @return mixed
     */
    public function setBrowserCheck( $browserCheck );
    public function getBrowserCheck();

    /** setContent
     * @param $content
     * @return mixed
     */
    public function setContent( $content );
    public function getContent();

    /** setControllers
     * @param $controllers
     * @return mixed
     */
    public function setControllers( $controllers );
    public function getControllers();

    /** setCss
     * @param $css
     * @return mixed
     */
    public function setCss( $css );
    public function getCss();

    /** setDatabaseConnections
     * @param $databaseConnections
     * @return mixed
     */
    public function setDatabaseConnections( $databaseConnections );
    public function getDatabaseConnections();

    /** setDescription
     * @param $description
     * @return mixed
     */
    public function setDescription( $description );
    public function getDescription();

    /** setDnsPrefetch
     * @param $dnsPrefetch
     * @return mixed
     */
    public function setDnsPrefetch( $dnsPrefetch );
    public function getDnsPrefetch();

    /** setEncoding
     * @param $encoding
     * @return mixed
     */
    public function setEncoding( $encoding );
    public function getEncoding();

    /** setFavicon
     * @param $favicon
     * @return mixed
     */
    public function setFavicon( $favicon );
    public function getFavicon();

    /** setFooter
     * @param $footer
     * @return mixed
     */
    public function setFooter( $footer );
    public function getFooter();

    /** setHeader
     * @param $header
     * @return mixed
     */
    public function setHeader( $header );
    public function getHeader();

    /** setInclude
     * @param $include
     * @return mixed
     */
    public function setInclude( $include );
    public function getInclude();

    /** setJQuery
     * @param $jQuery
     * @return mixed
     */
    public function setJQuery( $jQuery );
    public function getJQuery();

    /** setJQueryMobile
     * @param $jQueryMobile
     * @return mixed
     */
    public function setJQueryMobile( $jQueryMobile );
    public function getJQueryMobile();

    /** setJQueryUI
     * @param $jQueryUI
     * @return mixed
     */
    public function setJQueryUI( $jQueryUI );
    public function getJQueryUI();

    /** setJs
     * @param $js
     * @return mixed
     */
    public function setJs( $js );
    public function getJs();

    /** setKeywords
     * @param $keywords
     * @return mixed
     */
    public function setKeywords( $keywords );
    public function getKeywords();

    /** setKeywordsNot
     * @param $keywordsNot
     * @return mixed
     */
    public function setKeywordsNot( $keywordsNot );
    public function getKeywordsNot();

    /** setLanguage
     * @param $language
     * @return mixed
     */
    public function setLanguage( $language );
    public function getLanguage();

    /** setLoad
     * @param $load
     * @return mixed
     */
    public function setLoad( $load );
    public function getLoad();

    /** setModels
     * @param $models
     * @return mixed
     */
    public function setModels( $models );
    public function getModels();

    /** setModernizr
     * @param $modernizr
     * @return mixed
     */
    public function setModernizr( $modernizr );
    public function getModernizr();

    /** setPngFix
     * @param $pngFix
     * @return mixed
     */
    public function setPngFix( $pngFix );
    public function getPngFix();

    /** setPrefetch
     * @param $prefetch
     * @return mixed
     */
    public function setPrefetch( $prefetch );
    public function getPrefetch();

    /** setPrerender
     * @param $prerender
     * @return mixed
     */
    public function setPrerender( $prerender );
    public function getPrerender();

    /** setRequired
     * @param $required
     * @return mixed
     */
    public function setRequired( $required );
    public function getRequired();

    /** setRobots
     * @param $robots
     * @return mixed
     */
    public function setRobots( $robots );
    public function getRobots();

    /** setSuperGlobals
     * @param $SuperGlobals
     * @return mixed
     */
    public function setSuperGlobals( $SuperGlobals );
    public function getSuperGlobals();

    /** setTitle
     * @param $title
     * @return mixed
     */
    public function setTitle( $title );
    public function getTitle();

    /** setViewport
     * @param $viewport
     * @return mixed
     */
    public function setViewport( $viewport );
    public function getViewport();

    /** setViews
     * @param $views
     * @return mixed
     */
    public function setViews( $views );
    public function getViews();
    public function onAction();
}