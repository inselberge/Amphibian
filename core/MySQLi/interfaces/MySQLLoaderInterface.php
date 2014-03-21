<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/9/13
 * Time: 7:47 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
interface mysqlLoaderInterface {
    /**
     *
     */
    public function __construct();

    /** setFileName
     * @param $name
     * @return mixed
     */
    public function setFileName( $name );

    /** setDirectory
     * @param $name
     * @return mixed
     */
    public function setDirectory( $name );
    public function execute();

}