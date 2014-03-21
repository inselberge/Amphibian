<?php
/**
 * PHP Version 5.4.9-4ubuntu2.2
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 8/14/13
 * Time: 10:46 AM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
interface fileLocationInterface {

    static public function instance();

    /** setFileName
     * @param $fileName
     * @return mixed
     */
    public function setFileName( $fileName );
    public function getFileName();

    /** setSearchLocations
     * @param $searchLocations
     * @return mixed
     */
    public function setSearchLocations( $searchLocations );
    public function getSearchLocations();
    public function getValidLocations();
    public function execute();

}
