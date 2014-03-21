<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/9/13
 * Time: 7:03 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
interface FileInterface
{
    /**
     *
     */
    public function __construct();

    /** setName
     * @param $name
     * @return mixed
     */
    public function setName($name);

    /** cascade
     * @param $locations
     * @return mixed
     */
    public function cascade($locations);

    /** copy
     * @param $destinationName
     * @return mixed
     */
    public function copy( $destinationName );

    /** rename
     * @param $destinationName
     * @return mixed
     */
    public function rename( $destinationName );
    public function delete();

    /** changeOwner
     * @param $name
     * @return mixed
     */
    public function changeOwner( $name );

    /** changeGroup
     * @param $name
     * @return mixed
     */
    public function changeGroup( $name );

    /** changePermissions
     * @param $newPermissions
     * @return mixed
     */
    public function changePermissions( $newPermissions );
    public function printAccessTime();
    public function printChangeTime();
    public function printFileGroup();
    public function printFileOwner();
    public function printFilePermissions();
    public function printFileSize();
    public function printFileType();
    public function printDirectoryName();
    public function printBaseName();
    public function printExtension();
    public function printFileName();
}