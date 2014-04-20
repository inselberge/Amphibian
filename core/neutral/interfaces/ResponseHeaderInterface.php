<?php
/**
 * PHP version 5.3
 * Created by PhpStorm.
 * User: texmorgan
 * Date: 4/17/14
 * Time: 1:49 PM
 */
require_once AMPHIBIAN_CORE_ABSTRACT_INTERFACES."HeaderInterface.php";
/**
 * Class ResponseHeaderInterface
 *
 * @category ${NAMESPACE}
 * @package  ResponseHeaderInterface
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated
 * @link     documentation/ResponseHeaderInterface
 */
interface ResponseHeaderInterface
    extends HeaderInterface
{
    static public function instance();
    static public function factory();

    /** getAcceptRanges
     *
     * @return mixed
     */
    public function getAcceptRanges();

    /** setAcceptRanges
     *
     * @param mixed $acceptRanges
     *
     * @return bool
     */
    public function setAcceptRanges($acceptRanges);

    /** getAge
     *
     * @return mixed
     */
    public function getAge();

    /** setAge
     *
     * @param integer $startTime
     *
     * @return bool
     */
    public function setAge($startTime);

    /** getETag
     *
     * @return mixed
     */
    public function getETag();

    /** setETag
     *
     * @param mixed $eTag
     *
     * @return bool
     */
    public function setETag($eTag);

    /** getLocation
     *
     * @return mixed
     */
    public function getLocation();

    /** setLocation
     *
     * @param mixed $location
     *
     * @return bool
     */
    public function setLocation($location);

    /** getProxyAuthenticate
     *
     * @return mixed
     */
    public function getProxyAuthenticate();

    /** setProxyAuthenticate
     *
     * @param mixed $proxyAuthenticate
     *
     * @return bool
     */
    public function setProxyAuthenticate($proxyAuthenticate);

    /** getRetryAfter
     *
     * @return mixed
     */
    public function getRetryAfter();

    /** setRetryAfter
     *
     * @param mixed $retryAfter this can be either an HTTP date or # of seconds
     *
     * @return bool
     */
    public function setRetryAfter($retryAfter);

    /** getServer
     *
     * @return mixed
     */
    public function getServer();

    /** setServer
     *
     * @param mixed $server
     *
     * @return bool
     */
    public function setServer($server);

    /** getVary
     *
     * @return mixed
     */
    public function getVary();

    /** setVary
     *
     * @param mixed $vary
     *
     * @return bool
     */
    public function setVary($vary);

    /** getWwwAuthenticate
     *
     * @return mixed
     */
    public function getWwwAuthenticate();

    /** setWwwAuthenticate
     *
     * @param mixed $wwwAuthenticate
     *
     * @return bool
     */
    public function setWwwAuthenticate($wwwAuthenticate);
} 