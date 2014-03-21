<?php
/**
 * PHP Version 5.4.9-4ubuntu2.2
 * Created by PhpStorm.
 * Project: Coworks.In
 * User: Carl "Tex" Morgan
 * Date: 9/25/13
 * Time: 3:15 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */

interface PasswordInterface
{
    /** checkPasswordRegEx
     * @param $pass
     * @return mixed
     */
    static public function checkPasswordRegEx( $pass );
    static public function instance();

    /** setAlgorithm
     * @param $algorithm
     * @return mixed
     */
    public function setAlgorithm( $algorithm );
    public function getAlgorithm();

    /** setLength
     * @param $length
     * @return mixed
     */
    public function setLength( $length );
    public function getLength();

    /** setPassword
     * @param $password
     * @return mixed
     */
    public function setPassword( $password );
    public function getPassword();
    public function getHash();
    public function randomPassword();
    public function execute();

    /** compare
     * @param $password2
     * @return mixed
     */
    public function compare($password2);
}
 