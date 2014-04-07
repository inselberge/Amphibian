<?php
/**
 * PHP Version 5.4.9-4ubuntu2.2
 * Created by PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 11/9/13
 * Time: 4:20 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once AMPHIBIAN_CORE_NEUTRAL . "FileList.php";
require_once "interfaces".DIRECTORY_SEPARATOR."CoreUpdateInterface.php";
/**
 * Class CoreUpdate
 *
 * @category Generator
 * @package  CoreUpdate
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/Amphibian/documentation/CoreUpdate
 */
class CoreUpdate 
    implements CoreUpdateInterface
{
    /**
     * @var array list the list of files in core to copy
     */
    protected $list;
    /**
     * @var string destination the location where the core files are sent
     */
    protected $destination;
    /**
     * @var string source the location where the core files are located
     */
    protected $source;
    /**
     * @var object CoreUpdate holds values for $CoreUpdate->CoreUpdate
     */
    static public $CoreUpdate;

    /** __construct
     */
    protected function __construct()
    {
    
    }

    /** instance
     *
     * @return CoreUpdate
     */
    static public function instance()
    {
        if ( !isset(self::$CoreUpdate ) ) {
            self::$CoreUpdate = new CoreUpdate(); 
        }
        return self::$CoreUpdate;
    }

    /** factory
     *
     * @return CoreUpdate
     */
    static public function factory()
    {
        return new CoreUpdate();
    }

    /**  setDestination
     *
     * @param string $destination the location where the core files are sent
     *
     * @return boolean
     */
    public function setDestination( $destination )
    {
        try {
            if ( CheckInput::checkNewInput($destination) ) {
                $this->destination = $destination;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": destination invalid.");
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
            $this->copyClasses();
            $this->copyInterfaces();
            if ( $this->checkDestination() ) {

            } else {
                throw new ExceptionHandler(__METHOD__ . ": destination required.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** copyClasses
     *
     * @return bool
     */
    protected function copyClasses()
    {
        try {
            if ( $this->checkDestination() ) {
                $this->getClasses();
                $this->source = AMPHIBIAN_CORE;
                foreach ($this->list->matches as $file) {
                    $this->iterate($file);
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ":destination required.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkDestination
     *
     * @return bool
     */
    protected function checkDestination()
    {
        return file_exists($this->destination);
    }

    /** copyInterfaces
     *
     * @return bool
     */
    protected function copyInterfaces()
    {
        try {
            $this->destination.="interfaces".DIRECTORY_SEPARATOR;
            if ( $this->checkDestination() ) {
                $this->getInterfaces();
                $this->source.="interfaces".DIRECTORY_SEPARATOR;
                foreach ($this->list->matches as $file) {
                    $this->iterate($file);
                }

            } else {
                throw new ExceptionHandler(__METHOD__ . ": interfaces folder required.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getClasses
     *
     * @return bool
     */
    protected function getClasses()
    {
        try {
            if ( CheckInput::checkSet(AMPHIBIAN_CORE) ) {
                $this->list = FileList::factory(".php");
                $this->list->setLocation(AMPHIBIAN_CORE);
                $this->list->execute();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": Amphibian Core not set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getInterfaces
     *
     * @return bool
     */
    protected function getInterfaces()
    {
        try {
            if ( CheckInput::checkSet(AMPHIBIAN_CORE) ) {
                $this->list = FileList::factory(".php");
                $this->list->setLocation(AMPHIBIAN_CORE."interfaces".DIRECTORY_SEPARATOR."");
                $this->list->execute();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": Amphibian Core not set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** iterate
     *
     * @param string $file the file to copy
     *
     * @return bool
     */
    protected function iterate($file)
    {
        try {
            if ( !copy($this->source.$file, $this->destination.$file) ) {
                throw new ExceptionHandler(__METHOD__ . ": copy failed");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }
}
/*
require_once AMPHIBIAN_CONFIG."InnerAlly.config.inc.php";
$CoreUpdate = CoreUpdate::instance();
$CoreUpdate->setDestination(CORE);
$CoreUpdate->execute();
*/