<?php
/**
 * PHP version 5.4.17
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/15/13
 * Time: 9:54 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once AMPHIBIAN_CORE_ABSTRACT."BasicInteraction.php";
require_once AMPHIBIAN_CORE_MYSQLI."TableBuilderMySQLi.php";
require_once "interfaces".DIRECTORY_SEPARATOR."BasicBrowseInterface.php";
/**
 * Class BasicBrowse
 *
 * @category Core
 * @package  Amphibian
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/BasicBrowse
 */
class BasicBrowse
    extends BasicInteraction
    implements BasicBrowseInterface
{
    /**
     * @var string idName holds values for $basicBrowse->idName
     */
    protected $idName;
    /**
     * @var string renderMethod holds values for $basicBrowse->renderMethod
     */
    protected $renderMethod;
    /**
     * @var string agency holds values for $basicBrowse->agency
     */
    protected $agency;
    /**
     * @var object basicBrowse holds values for $basicBrowse->basicBrowse
     */
    public static $basicBrowse;

    /** instance
     *
     * @param object $databaseConnection a database connection
     *
     * @return basicBrowse
     */
    public static function instance($databaseConnection)
    {
        if ( !isset(self::$basicBrowse) ) {
            self::$basicBrowse = new BasicBrowse($databaseConnection);
        }
        return self::$basicBrowse;
    }

    /**  setIdName
     *
     * @param string $idName the id to use for rendering
     *
     * @return boolean
     */
    public function setIdName( $idName )
    {
        try {
            if ( CheckInput::checkNewInput($idName) ) {
                $this->idName = $idName;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": idName is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getIdName
     *
     * @return string
     */
    public function getIdName()
    {
        return $this->idName;
    }

    /**  setAgency
     *
     * @param mixed $agency the agency file name
     *
     * @return boolean
     */
    public function setAgency( $agency )
    {
        try {
            if ( CheckInput::checkNewInput($agency) ) {
                $this->agency = $agency;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": agency is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**  setRenderMethod
     *
     * @param mixed $renderMethod
     *
     * @return boolean
     */
    public function setRenderMethod( $renderMethod )
    {
        try {
            if ( CheckInput::checkNewInput($renderMethod) ) {
                $this->renderMethod = $renderMethod;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": renderMethod invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** execute
     *
     * @return bool
     */
    public function execute()
    {
        try {
            if ( CheckInput::checkSet($this->agency) ) {
                if ( $this->agency->execute() ) {
                     $this->setDataPackage($this->agency->getDataPackage());
                     $this->render();
                } else {
                    throw new ExceptionHandler(__METHOD__ . ": Agency error.");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": Agency must be set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** render
     *
     * @return bool
     */
    public function render()
    {
        try {
            if ( CheckInput::checkNewInput($this->renderMethod) ) {
                $this->forkRender();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": Render method error");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** forkRender
     *
     * @return bool
     */
    protected function forkRender()
    {
        try {
            if ( $this->renderMethod == "HTML" ) {
                $this->renderHTML();
            } elseif ($this->renderMethod == "JSON") {
                $this->renderJSON();
            } elseif ($this->renderMethod == "JQuery") {
                $this->renderJQuery();
            } elseif ($this->renderMethod == "XML") {
                $this->renderXML();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": Unknown render method.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** renderHTML
     *
     * @return void
     */
    protected function renderHTML()
    {
        TableBuilder::executeFromPayload($this->idName,$this->dataPackage->getPayload());
    }

    /** renderJSON
     *
     * @return string
     */
    protected function renderJSON()
    {
        return json_encode(utf8_encode($this->dataPackage->getPayload()));
    }

    /** renderJQuery
     *
     * @return void
     */
    protected function renderJQuery()
    {
        //TODO: make a render jQuery function
    }

    /** renderXML
     *
     * @return void
     */
    protected function renderXML()
    {
        //TODO: make a render XML function
    }
}
/*
 * Example
$brw = basicBrowse::instance($databaseConnectionBrowse);
$evAgency = viewEventAgency::instance($databaseConnectionUser);
$brw->setAgency($evAgency);
$brw->setRenderMethod("HTML");
$brw->execute();
 */