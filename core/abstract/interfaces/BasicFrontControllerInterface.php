<?php
/**
 * PHP Version: ${PHP_VERSION}
 * Created by PhpStorm.
 * User: carl
 * Date: 1/30/14
 * Time: 12:01 PM
 */
/**
 * Class BasicFrontControllerInterface
 *
 * @category BasicFrontController
 * @package  BasicFrontControllerInterface
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/BasicFrontControllerInterface
 */
interface BasicFrontControllerInterface
{

    /**  setPutFile
     *
     * @param string $putFile the data from php://input
     *
     * @return boolean
     */
    public function setPutFile($putFile);

    /**   getPutFile
     *
     * @return object
     */
    public function getPutFile();

    /**  setRequestMethod
     *
     * @param string $requestMethod the value of $_SERVER["REQUEST_METHOD"]
     *
     * @return boolean
     */
    public function setRequestMethod($requestMethod);

    /**   getRequestMethod
     *
     * @return string
     */
    public function getRequestMethod();

    /** setAutoRender
     *
     * @param bool $autoRender true = auto-render, false = manual render
     *
     * @return bool
     */
    public function setAutoRender($autoRender);

    /** setDefaultBranch
     *
     * @param string $branch the name of a valid branch
     *
     * @return bool
     */
    public function setDefaultBranch($branch);

    /** setDefaultController
     *
     * @param string $controller the name of a valid controller
     *
     * @return bool
     */
    public function setDefaultController($controller);

    /** setDefaultAction
     *
     * @param string $action a valid action for the controller
     *
     * @return bool
     */
    public function setDefaultAction($action);

    /**  setClassName
     *
     * @param string $className the name of the class to use
     *
     * @return boolean
     */
    public function setClassName($className);

    /**   getClassName
     *
     * @return string
     */
    public function getClassName();

    /**  setDeviceType
     *
     * @param string $deviceType a string, such as "desktop", "mobile", or "default"
     *
     * @return boolean
     */
    public function setDeviceType($deviceType);

    /**   getDeviceType
     *
     * @return string
     */
    public function getDeviceType();

    /**  setRenderMethod
     *
     * @param string $renderMethod a string such as "html","json", or "xml"
     *
     * @return boolean
     */
    public function setRenderMethod($renderMethod);

    /**   getRenderMethod
     *
     * @return string
     */
    public function getRenderMethod();

    /**  setViewType
     *
     * @param string $viewType a string such as "browse", "form", or "partial"
     *
     * @return boolean
     */
    public function setViewType($viewType);

    /**   getViewType
     *
     * @return string
     */
    public function getViewType();

    /** setControllerName
     *
     * @param string $controllerName the name of the controller
     *
     * @return bool
     */
    public function setControllerName($controllerName);

    /** setAction
     *
     * @param string $action the specific action to perform
     *
     * @return bool
     */
    public function setAction($action);

    /** cascadeController
     *
     * @param array $locations an array of locations to look for the controller
     *
     * @return bool
     */
    public function cascadeController(array $locations);

    /** initController
     *
     * @param object $databaseConnection a database connection
     *
     * @return bool
     */
    public function initController($databaseConnection);

    /** execute
     *
     * @return bool
     */
    public function execute();

    /** handleAction
     *
     * @return void
     */
    public function handleAction();

    /** sendErrors
     *
     * @return mixed
     */
    public function sendErrors();

    /** checkMalicious
     *
     * @return void
     */
    public function checkMalicious();
} 