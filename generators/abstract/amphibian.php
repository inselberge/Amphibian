<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Carl "Tex" Morgan
 * Date: 4/23/13
 * Time: 10:54 AM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once "interfaces".DIRECTORY_SEPARATOR."amphibianInterface.php";
/**
 * Class Amphibian
 * 
 * @category Generator
 * @package  Amphibian
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/Amphibian
 */
abstract class Amphibian
    implements AmphibianInterface
{
    /**
     * @var resource connection a valid database connection
     */
    protected $connection;
    /**
     * @var array configurationList holds values for $Amphibian->configurationList
     */
    protected $configurationList;
    /**
     * @var string currentConfiguration holds values for $Amphibian->currentConfiguration
     */
    protected $currentConfiguration;

    protected $currentStep;
    /**
     * @var array tableNames holds values for $Amphibian->_tableNames
     */
    protected $tableNames;
    /**
     * @var array tableArray holds values for $Amphibian->_tableArray
     */
    protected $tableArray;
    /**
     * @var array tablesToSourceChanges holds values for $Amphibian->_tablesToSourceChanges
     */
    protected $tablesToSourceChanges;
    /**
     * @var array actionsSelected holds values for $Amphibian->_actionsSelected
     */
    protected $actionsSelected;
    /**
     * @var string html holds values for $Amphibian->_html
     */
    protected $html;
    /**
     * @var array actionsList holds values for $Amphibian->_actionsList
     */
    protected $actionsList = array( "Stored Procedures", "Database Views", "Models", "Forms", "User Interface", "Browse" );
    /**
     * @var  amphibian holds values for $Amphibian->amphibian
     */
    static protected $amphibian;

    /** scanConfigurationFiles
     * 
     * @return void
     */
    protected function scanConfigurationFiles()
    {
        $this->configurationList = FileList::instance("config.inc.php");
        $this->configurationList->setLocation("..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config/");
        $this->configurationList->execute();
        $this->configurationList->printSelectList(
            "configurationList", 
            "configurationList", 
            null, 
            array( "config.inc.php" )
        );
        echo $this->configurationList->html;
    }

    /** setConfiguration
     * 
     * @return void
     */
    protected function setConfiguration()
    {
        if ( isset($_POST["configurationList"]) ) {
            $this->currentConfiguration = $_POST["configurationList"];
        } else {
            $this->currentConfiguration = false;
        }
    }

    /** loadConfiguration
     * 
     * @return bool
     */
    protected function loadConfiguration()
    {
        try {
            if ( $this->currentConfiguration == false ) {
                throw new Exception(": Tne current configuration is not set.");
            } else {
                include_once "..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config/" . $this->currentConfiguration;
            }
        } catch ( Exception $e ) {
            echo utf8_encode(date('Y-m-d H:i:s') . " " . __CLASS__ . "::" . __FUNCTION__ . $e);
            return false;
        }
        return true;
    }

    /** initializeConnection
     * 
     * @param resource $databaseConnection a valid database connection
     * 
     * @return void
     */
    protected function initializeConnection( $databaseConnection )
    {
        $this->connection = $databaseConnection;
    }

    /** loadTableNames
     *
     * @return mixed
     */
    abstract protected function loadTableNames();

    /** makeCheckBoxes
     *
     * @return void
     */
    protected function makeCheckBoxes()
    {
        $cbx = checkBoxGroup::instance($this->tableNames, "checkTables");
        $cbx->setMultipleBreak(5);
        $cbx->setLegendLabel("All Tables");
        $cbx->execute();
        $cbx->printHTML();
        $cbx = checkBoxGroup::instance($this->actionsList, "checkActions");
        $cbx->setMultipleBreak(3);
        $cbx->setLegendLabel("All Actions");
        $cbx->execute();
        $cbx->printHTML();
    }

    /** setSourceChanges
     *
     * @return bool
     */
    protected function setSourceChanges()
    {
        foreach ( $this->tableArray as $value ) {
            if ( isset($_POST["checkTables"]) and $_POST["checkTables"] == $value ) {
                $this->tablesToSourceChanges[$value] = true;
            } else {
                $this->tablesToSourceChanges[$value] = false;
            }
        }
        if ( empty($this->tablesToSourceChanges) ) {
            return false;
        }
        return true;
    }

    /** setActionsSelected
     *
     * @return bool
     */
    protected function setActionsSelected()
    {
        foreach ( $this->actionsList as $value ) {
            if ( isset($_POST["checkActions"]) and $_POST["checkActions"] == $value ) {
                $this->actionsSelected[$value] = true;
            } else {
                $this->actionsSelected[$value] = false;
            }
        }
        if ( empty($this->actionsSelected) ) {
            return false;
        }
        return true;
    }

    /** execute
     *
     * @return mixed
     */
    abstract public function execute();

    /** runSprocGenerator
     *
     * @return mixed
     */
    abstract protected function runSprocGenerator();

    /** runViewGenerator
     *
     * @return mixed
     */
    abstract protected function runViewGenerator();

    /** runClassGenerator
     *
     * @return mixed
     */
    abstract protected function runClassGenerator();

    /** runUserInteractionGenerator
     *
     * @return mixed
     */
    abstract protected function runUserInteractionGenerator();

    /** runFormGenerator
     *
     * @return mixed
     */
    abstract protected function runFormGenerator();

    /** runBrowseGenerator
     *
     * @return mixed
     */
    abstract protected function runBrowseGenerator();

    /** printResults
     *
     * @return mixed
     */
    abstract public function printResults();

    /** show
     *
     * @return void
     */
    public function show()
    {
        print_r(self::$amphibian);
    }
}