<?php
/**
 * PHP version 5.3
 * Created by PhpStorm.
 * User: texmorgan
 * Date: 4/17/14
 * Time: 4:48 PM
 */
require_once AMPHIBIAN_CORE_ABSTRACT_INTERFACES."HeaderInterface.php";
/**
 * Class RequestHeaderInterface
 *
 * @category ${NAMESPACE}
 * @package  RequestHeaderInterface
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated
 * @link     documentation/RequestHeaderInterface
 */
interface RequestHeaderInterface
    extends HeaderInterface
{
    static public function instance();
    static public function factory();

     public function getTE();
     public function setTE($TE);
     public function getAccept();
     public function setAccept($accept);
     public function getAcceptCharset();
     public function setAcceptCharset($acceptCharset);
     public function getAcceptEncoding();
     public function setAcceptEncoding($acceptEncoding);
     public function getAcceptLanguage();
     public function setAcceptLanguage($acceptLanguage);
     public function getAuthorization();
     public function setAuthorization($authorization);
     public function getExpect();
     public function setExpect($expect);
     public function getFrom();
     public function setFrom($from);
     public function getHost();
     public function setHost($host);
     public function getIfMatch();
     public function setIfMatch($ifMatch);
     public function getIfModifiedSince();
     public function setIfModifiedSince($ifModifiedSince);
     public function getIfNoneMatch();
     public function setIfNoneMatch($ifNoneMatch);
     public function getIfRange();
     public function setIfRange($ifRange);
     public function getIfUnmodifiedSince();
     public function setIfUnmodifiedSince($ifUnmodifiedSince);
     public function getMaxForwards();
     public function setMaxForwards($maxForwards);
     public function getProxyAuthorization();
     public function setProxyAuthorization($proxyAuthorization);
     public function getRange();
     public function setRange($range);
     public function getReferer();
     public function setReferer($referer);
     public function getUserAgent();
     public function setUserAgent($userAgent);
     
} 