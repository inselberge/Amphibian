<?php
/**
 * PHP Version 5.4.9-4ubuntu2.2
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 8/14/13
 * Time: 10:45 AM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once "interfaces".DIRECTORY_SEPARATOR."FileLocationInterface.php";
require_once "CheckInput.php";
/**
 * Class FileLocation
 *
 * @category Helper
 * @package  File
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/FileLocation
 */
class FileLocation 
    implements FileLocationInterface
{
    /**
     * @var string fileName the file to look for in the searchLocations
     */
    protected $fileName;
    /**
     * @var string currentLocation the current location to test
     */
    protected $currentLocation;
    /**
     * @var array searchLocations the various locations to check for the file
     */
    protected $searchLocations;
    /**
     * @var array validLocations the locations from searchLocations that are valid
     */
    protected $validLocations;
    /**
     * @var object FileLocation a singleton instance of this class
     */
    static public $FileLocation;

    /** __construct
     */
    protected function __construct()
    {
        $this->init();
    }

    /** init
     *
     * @return void
     */
    protected function init()
    {
        $this->fileName= null;
        $this->searchLocations = array();
        $this->validLocations = array();
    }

    /** instance
     *
     * @return FileLocation|object
     */
    static public function instance()
    {
        if ( !isset(self::$FileLocation) ) {
            self::$FileLocation = new FileLocation(); 
        }
        return self::$FileLocation;
    }

    /**  setFileName
     * 
     * @param string $fileName the name of the file
     * 
     * @return boolean
     */
    public function setFileName( $fileName )
    {
        try {
            if ( CheckInput::checkNewInput($fileName) ) {
                $this->fileName = $fileName;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": fileName invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getFileName
     * 
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**  setSearchLocations
     * 
     * @param array $searchLocations the locations to search for $this->fileName
     * 
     * @return boolean
     */
    public function setSearchLocations( $searchLocations )
    {
        try {
            if ( CheckInput::checkNewInputArray($searchLocations) ) {
                $this->searchLocations = $searchLocations;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": searchLocations invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getSearchLocations
     * 
     * @return array
     */
    public function getSearchLocations()
    {
        return $this->searchLocations;
    }

    /**   getValidLocations
     * 
     * @return array
     */
    public function getValidLocations()
    {
        return $this->validLocations;
    }

    /** execute
     *
     * @return bool
     */
    public function execute()
    {
        try {
            if ( CheckInput::checkNewInputArray($this->searchLocations) ) {
                foreach ($this->searchLocations as $this->currentLocation) {
                    if ( !$this->iterate() ) {
                        throw new ExceptionHandler(__METHOD__ . ": iterate failed.");
                    }
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": execute failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** iterate
     *
     * @return bool
     */
    protected function iterate()
    {
        try {
            if ( CheckInput::checkSet($this->fileName) ) {
                $this->checkLocation();;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": fileName invalid.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkLocation
     *
     * @return bool
     */
    protected function checkLocation()
    {
        try {
            if ( CheckInput::checkSet($this->currentLocation) ) {
                $this->testFullFile();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": location invalid.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** testFullFile
     *
     * @return void
     */
    protected function testFullFile()
    {
        if ( file_exists($this->currentLocation.$this->fileName) ) {
            $this->validLocations[] = $this->currentLocation;
        }
    }
}