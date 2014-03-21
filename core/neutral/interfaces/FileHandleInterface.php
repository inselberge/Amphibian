<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/9/13
 * Time: 7:37 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
interface FileHandleInterface {
    /**
     * @param $fileName
     */
    public function __construct( $fileName );

    /** instance
     * @param $fileName
     * @return mixed
     */
    static public function instance( $fileName );

    /** setOpenOption
     * @param $openOption
     * @return mixed
     */
    public function setOpenOption( $openOption );

    /** write
     * @param $string
     * @return mixed
     */
    public function write( $string );

    /** writeFull
     * @param $string
     * @return mixed
     */
    public function writeFull( $string );
    /*
     * TODO: generators/core/interfaces/FileHandleInterface.php: 16: read
        Double check to be sure that all input accepted from an external data source
        does not exceed the limits of the variable being used to hold it.  Also make
        sure that the input cannot be used in such a manner as to alter
        your program's behaviour in an undesirable way.
     */
    public function read();
    public function readClean();
    public function readFull();
    public function open();
    public function close();
}