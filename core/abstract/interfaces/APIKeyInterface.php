<?php
/**
 * PHP Version 5.4.9-4ubuntu2.2
 * Created by PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 11/1/13
 * Time: 8:39 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */

interface APIKeyInterface
{

    /** setApplication
     *
     * @param $application
     *
     * @return mixed
     */
    public function setApplication( $application );

    /** getApplication
     * @return mixed
     */
    public function getApplication();

    /** setExpiration
     *
     * @param $expiration
     *
     * @return mixed
     */
    public function setExpiration( $expiration );

    /** getExpiration
     *
     * @return mixed
     */
    public function getExpiration();

    /** setKey
     *
     * @param $key
     *
     * @return mixed
     */
    public function setKey( $key );

    /** getKey
     *
     * @return mixed
     */
    public function getKey();

    /** setLimit
     *
     * @param $limit
     *
     * @return mixed
     */
    public function setLimit( $limit );

    /** getLimit
     *
     * @return mixed
     */
    public function getLimit();

    /** setRequests
     *
     * @param $requests
     *
     * @return mixed
     */
    public function setRequests( $requests );

    /** getRequests
     *
     * @return mixed
     */
    public function getRequests();

    /** setResponses
     *
     * @param $responses
     *
     * @return mixed
     */
    public function setResponses( $responses );

    /** getResponses
     *
     * @return mixed
     */
    public function getResponses();

    /** generate
     *
     * @return mixed
     */
    public function generate();

    /** renew
     *
     * @return mixed
     */
    public function renew();

    /** resetCounters
     *
     * @return mixed
     */
    public function resetCounters();
}
 