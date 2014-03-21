<?php
/**
 * PHP Version 5.4.9-4ubuntu2.2
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 8/24/13
 * Time: 2:57 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */

interface OpenSSLInterface {
    static public function instance();

    /** setClearText
     * @param $clearText
     * @return mixed
     */
    public function setClearText( $clearText );
    public function getClearText();

    /** setPrivateKey
     * @param $privateKey
     * @return mixed
     */
    public function setPrivateKey( $privateKey );
    public function getPrivateKey();

    /** setPublicKey
     * @param $publicKey
     * @return mixed
     */
    public function setPublicKey( $publicKey );
    public function getPublicKey();

    /** setResource
     * @param $resource
     * @return mixed
     */
    public function setResource( $resource );
    public function getResource();

    /** setWorkingText
     * @param $workingText
     * @return mixed
     */
    public function setWorkingText( $workingText );
    public function getWorkingText();
    public function initResource();
    public function generatePrivateKey();
    public function generatePublicKey();
    public function encrypt();
    public function decrypt();
}
