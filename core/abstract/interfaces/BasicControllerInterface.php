<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/9/13
 * Time: 4:43 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once "BasicInteractionInterface.php";

/**
 * Interface BasicControllerInterface
 *
 * @category ${NAMESPACE}
 * @package  BasicControllerInterface
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated
 * @link     documentation/BasicControllerInterface
 */
interface BasicControllerInterface
    extends BasicInteractionInterface
{
    /**
     * @param $databaseConnection
     */
    public function __construct( $databaseConnection );
    public function onLoad();

    /** setEditMode
     * @param $editMode
     * @return mixed
     */
    public function setEditMode( $editMode );

    /** setListMode
     * @param $listMode
     * @return mixed
     */
    public function setListMode( $listMode );

    /** setObjectId
     * @param $objectId
     * @return mixed
     */
    public function setObjectId( $objectId );
    public function receive();
    public function checkDifferences();
    public function getDifferences();

    /** acceptViewDataPackage
     * @param $viewDataPackage
     * @return mixed
     */
    public function acceptViewDataPackage($viewDataPackage);

    /** setAction
     * @param $action
     * @return mixed
     */
    public function setAction( $action );
    public function getAction();

    /** setActionsAvailable
     * @param $actionsAvailable
     * @return mixed
     */
    public function setActionsAvailable( $actionsAvailable );
    public function getActionsAvailable();

    /** setAgency
     * @param $agency
     * @return mixed
     */
    public function setAgency( $agency );
    public function getAgency();

    /** setModel
     * @param $model
     * @return mixed
     */
    public function setModel( $model );
    public function getModel();
    public function extractAction();
    public function checkAction();
    public function handleAction();

}