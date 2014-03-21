<?php
/**
 * PHP Version 5.4.9-4ubuntu2.2
 *
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 9/3/13
 * Time: 12:12 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once "interfaces".DIRECTORY_SEPARATOR."BasicCartographerInterface.php";
require_once "DataMap.php";
require_once "FormData.php";
/**
 * Class BasicCartographer
 *
 * @category Core
 * @package  BasicCartographer
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/BasicCartographer
 */
abstract class BasicCartographer
    implements BasicCartographerInterface
{
    /**
     * @var object map This holds a dataMap object.
     */
    protected $map;
    /**
     * @var object formData This holds a formData object.
     */
    protected $formData;
    /**
     * @var string type This should be either model or agency.
     */
    protected $type;
    /**
     * @var string action This should be the action the controller wants to perform
     */
    protected $action;
    /**
     * @var array indexNames This should be the index names of the table
     */
    protected $indexNames;
    /**
     * @var array requiredForAction This should be an array in the vein of id => true
     */
    protected $requiredForAction;

    /**  setAction
     *
     * @param string $action This should be the action the controller wants to perform
     *
     * @return boolean
     */
    public function setAction( $action )
    {
        try {
            if ( CheckInput::checkNewInput($action) ) {
                $this->action = $action;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": action is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getAction
     *
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**  setFormData
     *
     * @param object $formData This is a formData object
     *
     * @return boolean
     */
    public function setFormData( $formData )
    {
        try {
            if ( CheckInput::checkNewInput($formData) ) {
                $this->formData = $formData;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": formData is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getFormData
     *
     * @return object
     */
    public function getFormData()
    {
        return $this->formData;
    }

    /**  setIndexNames
     *
     * @param array $indexNames This should be the index names of the table
     *
     * @return boolean
     */
    public function setIndexNames( $indexNames )
    {
        try {
            if ( CheckInput::checkNewInput($indexNames) ) {
                $this->indexNames = $indexNames;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": indexNames is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getIndexNames
     *
     * @return array
     */
    public function getIndexNames()
    {
        return $this->indexNames;
    }

    /**  setRequiredForAction
     *
     * @param array $requiredForAction This should be an array in the vein of id => true
     *
     * @return boolean
     */
    public function setRequiredForAction( $requiredForAction )
    {
        try {
            if ( CheckInput::checkNewInput($requiredForAction) ) {
                $this->requiredForAction = $requiredForAction;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": requiredForAction is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getRequiredForAction
     *
     * @return array
     */
    public function getRequiredForAction()
    {
        return $this->requiredForAction;
    }

    /**  setType
     *
     * @param string $type This should be the action the controller wants to perform
     *
     * @return boolean
     */
    public function setType( $type )
    {
        try {
            if ( CheckInput::checkNewInput($type) ) {
                $this->type = $type;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": type is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getType
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**   getMap
     *
     * @return object
     */
    public function getMap()
    {
        return $this->map;
    }

    /** initMap
     *
     * @return void
     */
    public function initMap()
    {
        $this->map = dataMap::instance();
    }

}