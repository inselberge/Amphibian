<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/10/13
 * Time: 1:10 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
interface ArchitectureGeneratorInterface extends CheckInputInterface {
    /**
     * @param $URI
     */
    public function __construct( $URI );

    /** setDirectoryName
     * @param $name
     * @return mixed
     */
    public function setDirectoryName( $name );

    /** setDirectoryList
     * @param array $list
     * @return mixed
     */
    public function setDirectoryList( array $list );
    public function execute();
}