<?php
/**
 * PHP version 5.5
 * Created by PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 11/1/13
 * Time: 8:38 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */

interface APIApplicationInterface
{
    /** setDescription
     * @param $description
     * @return mixed
     */
    public function setDescription( $description );
    public function getDescription();

    /** setEmail
     * @param $email
     * @return mixed
     */
    public function setEmail( $email );
    public function getEmail();

    /** setKey
     * @param $key
     * @return mixed
     */
    public function setKey( $key );
    public function getKey();

    /** setName
     * @param $name
     * @return mixed
     */
    public function setName( $name );
    public function getName();
    public function generate();
}
 