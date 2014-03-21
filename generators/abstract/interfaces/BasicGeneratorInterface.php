<?php
/**
 * PHP Version 5.4.9-4ubuntu2.2
 * Created by PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 10/11/13
 * Time: 2:25 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */

interface BasicGeneratorInterface
{
    /** setTableName
     * @param $tableName
     * @return mixed
     */
    public function setTableName($tableName);
    public function execute();

    /** setFileDestination
     * @param $fileDestination
     * @return mixed
     */
    public function setFileDestination( $fileDestination );

    /** setFileExtension
     * @param $fileExtension
     * @return mixed
     */
    public function setFileExtension( $fileExtension );
    public function getFileExtension( );
}
 