<?php
/**
 * PHP version 5.4.17
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/13/13
 * Time: 6:27 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once "BasicInteraction.php";
require_once "interfaces".DIRECTORY_SEPARATOR."BasicAgencyInterface.php";
/**
 * Class BasicAgency
 *
 * @category Core
 * @package  Amphibian
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/BasicAgency
 */
abstract class BasicAgency
    extends basicInteraction
    implements BasicAgencyInterface
{
    /**
     * @var object query holds values for $BasicAgency->query
     */
    protected $query;
    /**
     * @var string argument holds values for $BasicAgency->argument
     */
    protected $argument;
    /**
     * @var string queryStringAddendum holds values to add to the query
     */
    protected $queryStringAddendum;
    /**
     * @var array acceptableVars holds the acceptable variables for this agency
     */
    protected $acceptableVars;
    /**
     * @var array changeList an array of the primary key values for mass changes
     */
    protected $changeList;

    /**  setChangeList
     *
     * @param array $changeList an array of the primary key values for mass changes
     *
     * @return boolean
     */
    public function setChangeList( $changeList )
    {
        try {
            if ( CheckInput::checkNewInputArray($changeList) ) {
                $this->changeList = $changeList;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": changeList is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** appendChangeList
     *
     * @param array $changeList values to add to the change list
     *
     * @return bool
     */
    public function appendChangeList( $changeList )
    {
        try {
            if ( CheckInput::checkNewInputArray($changeList) ) {
                $this->changeList = array_merge($this->changeList, $changeList);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": changeList is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }


    /**   getChangeList
     *
     * @return array
     */
    public function getChangeList()
    {
        return $this->changeList;
    }

    /** execute
     *
     * @return bool
     */
    public function execute()
    {
        try {
            if ( $this->prepQuery() ) {
                if ( $this->forkQuery() ) {
                    $this->getResults();
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": agency action failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** prepQuery
     *
     * @return bool
     */
    abstract protected function prepQuery();

    /** forkQuery
     *
     * @return bool
     */
    abstract protected function forkQuery();

    /** getResults
     *
     * @return void
     */
    protected function getResults()
    {
        $this->forkMax($this->query->getNumberOfRows());
        $this->query->free();
    }

    /** forkMax
     *
     * @param integer $max number of rows returned by a query
     *
     * @return void
     */
    protected function forkMax($max)
    {
        if ( $max > 0 ) {
            for ($i=0;$i<$max;$i++) {
                $this->iterate();
            }
        } elseif ($max==0) {
            //no results, no payload, nor errors
        } else {
            $this->dataPackage->addToArray(
                "errors",
                array("agency_error",
                    "There was a problem with the agency query."
                )
            );
        }
    }

    /** iterate
     *
     * @return void
     */
    protected function iterate()
    {
        if ($this->query->getRow() ) {
            $this->dataPackage->appendToArray(
                "payload",
                array($this->query->row)
            );
        }
    }

    /** acceptArgumentsDataPackage
     *
     * @param object $dataPackage the dataPackage the Agency needs
     *
     * @return bool
     */
    abstract public function acceptArgumentsDataPackage($dataPackage);

    /** addToQueryStringAddendum
     *
     * @param string $string a string to add to the query
     *
     * @return bool
     */
    protected function addToQueryStringAddendum($string)
    {
        try {
            if ( CheckInput::checkNewInput($string) ) {
                if ( $this->checkQueryStringAddendum() ) {
                    $this->queryStringAddendum=" ".$string;
                } else {
                    $this->queryStringAddendum.=" ".$string;
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": Could not add string.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkQueryStringAddendum
     *
     * @return bool
     */
    protected function checkQueryStringAddendum()
    {
        if ( isset($this->queryStringAddendum) ) {
            if ( !is_null($this->queryStringAddendum) ) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**  setAcceptableVars
     *
     * @param array $acceptableVars holds the acceptable variables for this agency
     *
     * @return boolean
     */
    public function setAcceptableVars( $acceptableVars )
    {
        try {
            if ( CheckInput::checkNewInputArray($acceptableVars) ) {
                $this->acceptableVars = $acceptableVars;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": acceptableVars is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getAcceptableVars
     *
     * @return array
     */
    public function getAcceptableVars()
    {
        return $this->acceptableVars;
    }

    /** checkVariable
     *
     * @param string $variable a variable name to try to use
     *
     * @return bool
     */
    public function checkVariable( $variable )
    {
        try {
            if ( $this->checkPrepared() ) {
                $this->checkAcceptable($variable);
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkAcceptable
     *
     * @param string $variable a variable name to try to use
     *
     * @return bool
     */
    protected function checkAcceptable($variable)
    {
        try {
            if ( !in_array($variable, $this->acceptableVars) ) {
                throw new ExceptionHandler(__METHOD__ . ": invalid field.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkPrepared
     *
     * @return bool
     */
    protected function checkPrepared()
    {
        try {
            if ( !CheckInput::checkSetArray($this->acceptableVars) ) {
                throw new ExceptionHandler(__METHOD__ . ": acceptableVars not prepared.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }
}