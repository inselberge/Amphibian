<?php
/**
 * PHP Version 5.5.3-1ubuntu2
 * Created by PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 11/12/13
 * Time: 6:57 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */

interface DatabaseConnectionSQLSRVInterface
{
    static public function instance();
    static public function factory();

    /** set
     * @param $key
     * @param $value
     * @return mixed
     */
    public function set( $key, $value );

    /** setOptions
     * @param $option
     * @param $value
     * @return mixed
     */
    public function setOptions( $option, $value );

    /** setApplication
     * @param $application
     * @return mixed
     */
    public function setApplication( $application );
    public function getApplication();

    /** setApplicationIntent
     * @param $applicationIntent
     * @return mixed
     */
    public function setApplicationIntent( $applicationIntent );
    public function getApplicationIntent();

    /** setAttachDBFileName
     * @param $attachDBFileName
     * @return mixed
     */
    public function setAttachDBFileName( $attachDBFileName );
    public function getAttachDBFileName();

    /** setCharacterSet
     * @param $characterSet
     * @return mixed
     */
    public function setCharacterSet( $characterSet );
    public function getCharacterSet();

    /** setConnectionPooling
     * @param $connectionPooling
     * @return mixed
     */
    public function setConnectionPooling( $connectionPooling );
    public function getConnectionPooling();

    /** setEncrypt
     * @param $encrypt
     * @return mixed
     */
    public function setEncrypt( $encrypt );
    public function getEncrypt();

    /** setFailoverPartner
     * @param $failoverPartner
     * @return mixed
     */
    public function setFailoverPartner( $failoverPartner );
    public function getFailoverPartner();

    /** setLoginTimeout
     * @param $loginTimeout
     * @return mixed
     */
    public function setLoginTimeout( $loginTimeout );
    public function getLoginTimeout();

    /** setMultiSubnetFailover
     * @param $multiSubnetFailover
     * @return mixed
     */
    public function setMultiSubnetFailover( $multiSubnetFailover );
    public function getMultiSubnetFailover();

    /** setMultipleActiveResultSets
     * @param $multipleActiveResultSets
     * @return mixed
     */
    public function setMultipleActiveResultSets( $multipleActiveResultSets );
    public function getMultipleActiveResultSets();

    /** setQuotedId
     * @param $quotedId
     * @return mixed
     */
    public function setQuotedId( $quotedId );
    public function getQuotedId();

    /** setReturnDatesAsStrings
     * @param $returnDatesAsStrings
     * @return mixed
     */
    public function setReturnDatesAsStrings( $returnDatesAsStrings );
    public function getReturnDatesAsStrings();

    /** setScrollable
     * @param $scrollable
     * @return mixed
     */
    public function setScrollable( $scrollable );
    public function getScrollable();

    /** setTraceFile
     * @param $traceFile
     * @return mixed
     */
    public function setTraceFile( $traceFile );
    public function getTraceFile();

    /** setTransactionIsolation
     * @param $transactionIsolation
     * @return mixed
     */
    public function setTransactionIsolation( $transactionIsolation );
    public function getTransactionIsolation();

    /** setTraceOn
     * @param $traceOn
     * @return mixed
     */
    public function setTraceOn( $traceOn );
    public function getTraceOn();

    /** setTrustServerCertificate
     * @param $trustServerCertificate
     * @return mixed
     */
    public function setTrustServerCertificate( $trustServerCertificate );
    public function getTrustServerCertificate();

    /** setWorkstationId
     * @param $workstationId
     * @return mixed
     */
    public function setWorkstationId( $workstationId );
    public function getWorkstationId();
    public function openConnection();
    public function printClientInfo();
    public function printHostInfo();
    public function closeConnection();
}
 