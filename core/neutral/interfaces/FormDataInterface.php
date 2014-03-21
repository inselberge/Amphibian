<?php
/**
 * Created by JetBrains PhpStorm.
 * Project Amphibian
 * User Carl "Tex" Morgan
 * Date 7/9/13
 * Time 732 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
interface FormDataInterface {
    /**
     *
     */
    public function __construct();
    public function loadSuperVariables();

    /** setCookie
     * @param $cookie
     * @return mixed
     */
    public function setCookie( $cookie );
    public function getCookie();

    /** setGet
     * @param $get
     * @return mixed
     */
    public function setGet( $get );
    public function getGet();

    /** setPost
     * @param $post
     * @return mixed
     */
    public function setPost( $post );
    public function getPost();

    /** setServer
     * @param $server
     * @return mixed
     */
    public function setServer( $server );
    public function getServer();

    /** setSession
     * @param $session
     * @return mixed
     */
    public function setSession( $session );
    public function getSession();

    /** checkPostGet
     * @param $index
     * @return mixed
     */
    public function checkPostGet( $index );

    /** getByKey
     * @param $arr
     * @param $key
     * @return mixed
     */
    public function getByKey($arr,$key);
}