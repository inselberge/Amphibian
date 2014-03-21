<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/9/13
 * Time: 7:29 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
interface GitInterface
{
    static public function instance();
    static public function factory();

    /** setBranchName
     * @param $branchName
     * @return mixed
     */
    public function setBranchName( $branchName );
    public function getBranchName();

    /** setRemoteHosts
     * @param $remoteHosts
     * @return mixed
     */
    public function setRemoteHosts( $remoteHosts );
    public function getRemoteHosts();

    /** setRemoteURL
     * @param $remoteURL
     * @return mixed
     */
    public function setRemoteURL( $remoteURL );
    public function getRemoteURL();

    /** setRepositoryName
     * @param $repositoryName
     * @return mixed
     */
    public function setRepositoryName( $repositoryName );
    public function getRepositoryName();

    /** setTagName
     * @param $tagName
     * @return mixed
     */
    public function setTagName( $tagName );
    public function getTagName();

    /** setUsername
     * @param $username
     * @return mixed
     */
    public function setUsername( $username );
    public function getUsername();
    public function initializeHealth();
    public function checkoutBranch();

    /** add
     * @param null $item
     * @return mixed
     */
    public function add( $item = null );

    /** move
     * @param $source
     * @param $destination
     * @return mixed
     */
    public function move( $source, $destination );

    /** remove
     * @param $array
     * @return mixed
     */
    public function remove( $array );

    /** commit
     * @param $message
     * @return mixed
     */
    public function commit( $message );

    /** tag
     * @param $tagName
     * @return mixed
     */
    public function tag( $tagName );
    public function changeBranchToMaster();
    public function mergeBranchWithMaster();
    public function deleteBranch();
    public function push();
    public function pull();
    public function fetch();
    public function cloneRepository();
    public function remote();
    public function printOutput();
    public function setupGit();
    public function tearDownGit();
    public function stash();

    /** rebase
     * @param null $branchName
     * @return mixed
     */
    public function rebase($branchName = null);
    public function pop();

}