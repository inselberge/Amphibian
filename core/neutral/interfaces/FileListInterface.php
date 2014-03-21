<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/9/13
 * Time: 7:35 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
interface FileListInterface {
    /** instance
     * @param $format
     * @return mixed
     */
    static public function instance( $format );

    /** factory
     * @param $format
     * @return mixed
     */
    static public function factory($format);
    public function set_quoted();
    public function execute();
    public function printFileName();

    /** setLocation
     * @param $location
     * @return mixed
     */
    public function setLocation( $location );
    public function printCount();
    public function printMatches();

    /** printSelectList
     * @param $id
     * @param $name
     * @param $class
     * @param $excludeArray
     * @return mixed
     */
    public function printSelectList( $id , $name , $class , $excludeArray  );
}