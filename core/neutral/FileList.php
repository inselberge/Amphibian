<?php
/**
 * PHP version 5.4.17
 * Created by JetBrains PhpStorm.
 * User: Carl "Tex" Morgan
 * Date: 2/20/13
 * Time: 11:18 AM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once "interfaces".DIRECTORY_SEPARATOR."FileListInterface.php";
require_once "CheckInput.php";
/**
 * Class FileList
 *
 * @category Helper
 * @package  Core
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/FileList
 */
class FileList
    implements FileListInterface
{
    /**
     * @var string pattern a string containing the pattern
     */
    public $pattern;
    /**
     * @var string html
     */
    public $html;
    /**
     * @var array matches
     */
    public $matches;
    /**
     * @var object FileList
     */
    static protected $FileList;
    /**
     * @var string _location
     */
    private $_location;
    /**
     * @var bool _quoted
     */
    private $_quoted;
    /**
     * @var string _name
     */
    private $_name;
    /**
     * @var string _errorMessage
     */
    private $_errorMessage;
    /**
     * @var integer _countMatches
     */
    private $_countMatches;
    /**
     * @var integer _matchStatus
     */
    private $_matchStatus;

    /** __construct
     *
     * @param string $format a string denoting the format
     */
    protected function __construct($format)
    {
        try {
            if ( $this->CheckInput($format) ) {
                $this->pattern = $format;
                return true;
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** CheckInput
     *
     * @param $name
     *
     * @return bool
     *
     * @throws ExceptionHandler
     */
    private function CheckInput($name)
    {
        if ( isset($name) ) {
            if ( !is_null($name) ) {
                return true;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": the value is set to null.");
            }
        } else {
            throw new ExceptionHandler(__METHOD__ . ": the value is not set.");
        }
    }

    /** instance
     *
     * @param $format
     *
     * @return FileList
     */
    static public function instance($format)
    {
        if ( !isset(self::$FileList) ) {
            self::$FileList = new FileList($format);
        }
        return self::$FileList;
    }

    /** factory
     *
     * @param $format
     *
     * @return FileList
     */
    static public function factory($format)
    {
        return new FileList($format);
    }

    /** set_quoted
     *
     * @return void
     */
    public function set_quoted()
    {
        $this->_quoted = true;
    }

    /** execute
     *
     * @return bool
     */
    public function execute()
    {
        try {
            $this->findmatches();
            $this->sizematches();
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** findmatches
     *
     * @return bool
     */
    private function findmatches()
    {
        try {
            if ( $this->checkPattern() ) {
                if ( $this->checkDirectoryPresent() ) {
                    $this->_errorMessage = exec("cd " . $this->_location . "; ls -hrtX " . escapeshellarg($this->pattern) . "*", $this->matches, $this->_matchStatus);
                } elseif ( $this->_quoted == true ) {
                    $this->_errorMessage = exec("cd " . $this->_location . "; ls -hrtXQ *" . escapeshellarg($this->pattern) . "*", $this->matches, $this->_matchStatus);
                } else {
                    $this->_errorMessage = exec("cd " . $this->_location . "; ls -hrtX *" . escapeshellarg($this->pattern) . "*", $this->matches, $this->_matchStatus);
                }
                $this->checkStatus();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": The required pattern variable needs to be set to a valid format.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkPattern
     *
     * @return bool
     */
    private function checkPattern()
    {
        return $this->CheckInput($this->pattern);
    }

    /** checkDirectoryPresent
     *
     * @return bool
     */
    private function checkDirectoryPresent()
    {
        if ( strstr($this->pattern, '/') ) {
            return true;
        } else {
            return false;
        }
    }

    /** checkStatus
     *
     * @return bool
     *
     * @throws ExceptionHandler
     */
    private function checkStatus()
    {
        if ( $this->CheckInput($this->_matchStatus) ) {
            if ( $this->_matchStatus != 0 ) {
                throw new ExceptionHandler(__METHOD__ . ": There was a problem executing the list command.\n Most likely, $this->pattern does not exist.");
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    /** sizematches
     *
     * @return void
     *
     * @throws ExceptionHandler
     */
    private function sizematches()
    {
        if ( $this->checkmatches() ) {
            $this->_countMatches = count($this->matches);
        } else {
            throw new ExceptionHandler(__METHOD__ . ": There is a problem with the matches array, so a count can not be established.");
        }
    }

    /** checkmatches
     *
     * @return bool
     */
    private function checkmatches()
    {
        return $this->CheckInput($this->matches);
    }

    /** setLocation
     *
     * @param $location
     *
     * @return bool
     */
    public function setLocation($location)
    {
        if ( $this->CheckInput($location) ) {
            $this->_location = $location;
            return true;
        } else {
            $this->_location = ".";
            return false;
        }
    }

    /** printCount
     *
     * @return int
     */
    public function printCount()
    {
        if ( $this->_checkCount() ) {
            return $this->_countMatches;
        } else {
            return -1;
        }
    }

    /** _checkCount
     *
     * @return bool
     */
    private function _checkCount()
    {
        return $this->CheckInput($this->_countMatches);
    }

    /** printMatches
     *
     * @return void
     */
    public function printMatches()
    {
        $i = 1;
        while ( $this->_countMatches > 0 ) {
            echo "Match $i :\t" . $this->printFileName() . "\n";
            $i++;
        }
    }

    /** printFileName
     *
     * @return bool|mixed
     */
    public function printFileName()
    {
        if ( $this->_checkCount() ) {
            $this->_name = array_pop($this->matches);
            $this->sizematches();
            return $this->_name;
        } else {
            return false;
        }
    }

    //TODO: integrate with jQuery
    /** printSelectList
     *
     * @param string $id           a string containing the id of the select list
     * @param string $name         a string containing the name of the select list
     * @param string $class        a string containing the class of the select list
     * @param array  $excludeArray an array containing the items to exclude
     *
     * @return void
     */
    public function printSelectList($id = null, $name = null, $class = null, $excludeArray = null)
    {
        $this->html       = '<select id="' . $id . '" name="' . $name . '" class="' . $class . '">' . "\n";
        $option           = null;
        $excludeArrayUsed = is_array($excludeArray);
        while ( $this->_countMatches > 0 ) {
            $option = $this->printFileName();
            if ( $excludeArrayUsed ) {
                if ( in_array($option, $excludeArray, true) ) {
                } else {
                    $this->html .= "\t" . '<option value="' . $option . '">' . $option . '</option>' . "\n";
                }
            } else {
                $this->html .= "\t" . '<option value="' . $option . '">' . $option . '</option>' . "\n";
            }
        }
        $this->html .= '</select>' . "\n";
    }
}

/*
 * Example Use for Files
 *
$fl = FileList::instance("config.inc.php");
$fl->setLocation("..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config/");
$fl->execute();
$fl->printSelectList('configurationList','configurationList',null,array("config.inc.php"));
echo $fl->html;
*/
/*
 * Example Use for Directories
$fl = FileList::instance(".php");
$fl->setLocation(AMPHIBIAN_CORE."interfaces".DIRECTORY_SEPARATOR."");
$fl->execute();
print_r($fl);
echo $fl->printCount();
*/