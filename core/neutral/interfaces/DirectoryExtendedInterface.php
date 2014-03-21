<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/9/13
 * Time: 6:45 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once "CheckInputInterface.php";

/**
 * Interface DirectoryExtendedInterface
 *
 * @category ${NAMESPACE}
 * @package  DirectoryExtendedInterface
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated
 * @link     documentation/DirectoryExtendedInterface
 */
interface DirectoryExtendedInterface
    extends CheckInputInterface
{
    /**
     *
     */
    public function __construct();
    public function changeDirectory();
    public function showCurrentWorkingDirectory();

    /** setDirectoryPermissions
     * @param $string
     * @return mixed
     */
    public function setDirectoryPermissions( $string );

    /** setDirectoryName
     * @param $string
     * @return mixed
     */
    public function setDirectoryName( $string );

    /** setDirectoryList
     * @param $list
     * @return mixed
     */
    public function setDirectoryList( $list );
    public function open();
    public function checkIsDirectory();
    public function read();
    public function rewind();
    public function close();

    /** setSortOrder
     * @param $order
     * @return mixed
     */
    public function setSortOrder( $order );
    public function scan();
    public function printContents();
    public function execute();
    public function printItemName();
}