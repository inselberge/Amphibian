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

interface APIRequestInterface
{
    static public function instance();
    static public function factory();

    /** setAction
     * @param $action
     * @return mixed
     */
    public function setAction( $action );
    public function getAction();

    /** setApplication
     * @param $application
     * @return mixed
     */
    public function setApplication( $application );
    public function getApplication();

    /** setArguments
     * @param $arguments
     * @return mixed
     */
    public function setArguments( $arguments );
    public function getArguments();

    /** setBranch
     * @param $branch
     * @return mixed
     */
    public function setBranch( $branch );
    public function getBranch();

    /** setKey
     * @param $key
     * @return mixed
     */
    public function setKey( $key );
    public function getKey();

    /** setType
     * @param $type
     * @return mixed
     */
    public function setType( $type );
    public function getType();

    /** setTimestamp
     * @param $timestamp
     * @return mixed
     */
    public function setTimestamp( $timestamp );
    public function getTimestamp();
}
 