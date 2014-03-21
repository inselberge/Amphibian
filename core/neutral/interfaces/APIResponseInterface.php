<?php
/**
 * PHP Version 5.4.9-4ubuntu2.2
 * Created by PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 11/1/13
 * Time: 8:40 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */

interface APIResponseInterface
{
    static public function instance();
    static public function factory();

    /** setApplication
     * @param $application
     * @return mixed
     */
    public function setApplication( $application );
    public function getApplication();

    /** setKey
     * @param $key
     * @return mixed
     */
    public function setKey( $key );
    public function getKey();

    /** setPageSize
     * @param $pageSize
     * @return mixed
     */
    public function setPageSize( $pageSize );
    public function getPageSize();

    /** setPayload
     * @param $payload
     * @return mixed
     */
    public function setPayload( $payload );

    /** appendPayload
     * @param $payload
     * @return mixed
     */
    public function appendPayload( $payload );
    public function getPayload();

    /** setPayloadSize
     * @param $payloadSize
     * @return mixed
     */
    public function setPayloadSize( $payloadSize );
    public function getPayloadSize();

    /** setSuccess
     * @param $success
     * @return mixed
     */
    public function setSuccess( $success );
    public function getSuccess();

    /** setTimestamp
     * @param $timestamp
     * @return mixed
     */
    public function setTimestamp( $timestamp );
    public function getTimestamp();

    /** setType
     * @param $type
     * @return mixed
     */
    public function setType( $type );
    public function getType();
    public function execute();

}
 