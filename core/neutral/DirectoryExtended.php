<?php
/**
 * PHP version 5.4.17
 * Created by JetBrains PhpStorm.
 * User: Carl "Tex" Morgan
 * Date: 3/24/13
 * Time: 12:02 AM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once "interfaces".DIRECTORY_SEPARATOR."DirectoryExtendedInterface.php";
require_once "CheckInput.php";
/**
 * Class DirectoryExtended
 * 
 * @category Helper
 * @package  Core
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/DirectoryExtended
 */
class DirectoryExtended
    extends CheckInput
    implements DirectoryExtendedInterface
{
    /**
     * @var array _acceptableSortingOrders the acceptable sorting orders
     */
    private static $_acceptableSortingOrders 
        = array(SCANDIR_SORT_ASCENDING, SCANDIR_SORT_DESCENDING, SCANDIR_SORT_NONE );
    /**
     * @var array directoryList an array of directories
     */
    protected $directoryList;
    /**
     * @var string currentDirectory the current directory
     */
    protected $currentDirectory;
    /**
     * @var string currentWorkingDirectory where you currently are
     */
    protected $currentWorkingDirectory;
    /**
     * @var string directoryPermission permission of the directory
     */
    protected $directoryPermission;
    /**
     * @var resource resource a resource for the directory
     */
    protected $resource;
    /**
     * @var int sortOrder direction to sort the directories
     */
    protected $sortOrder;
    /**
     * @var array contentsArray an array of the contents
     */
    protected $contentsArray;
    /**
     * @var string itemName the name of an item
     */
    protected $itemName;

    /** __construct
     */
    public function __construct()
    {
    }

    /** changeDirectory
     *
     * @return bool
     */
    public function changeDirectory()
    {
        try {
            if ( chdir($this->currentDirectory) ) {
                $this->getCurrentWorkingDirectory();
            } else {
                throw new ExceptionHandler(__METHOD__.": changeDirectory failed");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getCurrentWorkingDirectory
     *
     * @return bool
     */
    protected function getCurrentWorkingDirectory()
    {
        try {
            $this->currentWorkingDirectory = getcwd();
            if ( $this->currentWorkingDirectory ) {
                $this->showCurrentWorkingDirectory();
            } else {
                throw new ExceptionHandler(__METHOD__.": could not get current working directory!");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** showCurrentWorkingDirectory
     *
     * @return void
     */
    public function showCurrentWorkingDirectory()
    {
        echo "Current working directory: " . $this->currentWorkingDirectory;
    }

    /** setDirectoryPermissions
     *
     * @param string $string the new directory permissions
     *
     * @return bool
     */
    public function setDirectoryPermissions( $string )
    {
        try {
            if ( $this->checkNewInput($string) ) {
                $this->directoryPermission = $string;
                return true;
            } else {
                throw new ExceptionHandler(__METHOD__.": setDirectoryPermissions failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** setDirectoryName
     *
     * @param string $string the directory name
     *
     * @return bool
     */
    public function setDirectoryName( $string )
    {
        try {
            if ( $this->checkNewInput($string) ) {
                $this->currentDirectory = $string;
                return true;
            } else {
                throw new ExceptionHandler(__METHOD__.": setDirectoryName failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** setDirectoryList
     *
     * @param $list
     *
     * @return bool
     */
    public function setDirectoryList( $list )
    {
        try {
            if ( $this->checkNewInput($list) AND is_array($list) ) {
                $this->directoryList = $list;
                return true;
            } else {
                throw new ExceptionHandler(__METHOD__.": setDirectoryList failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** open
     *
     * @return bool
     */
    public function open()
    {
        try {
            if ( $this->checkIsDirectory($this->currentDirectory) ) {
                $this->resource = opendir($this->currentDirectory);
                if ( $this->resource ) {
                } else {
                    throw new ExceptionHandler(__METHOD__.": open dir failed.");
                }
            } else {
                throw new ExceptionHandler(__METHOD__.": open failed");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkIsDirectory
     *
     * @return bool
     */
    public function checkIsDirectory()
    {
        if ( is_dir(realpath($this->currentDirectory)) ) {
            return true;
        } else {
            return false;
        }
    }

    /** read
     *
     * @return bool
     */
    public function read()
    {
        try {
            if ( $this->resource ) {
                $this->itemName = readdir($this->resource);
                if ( $this->itemName === false ) {
                    throw new ExceptionHandler(__METHOD__.": read dir failed.");
                }
            } else {
                throw new ExceptionHandler(__METHOD__.": read failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** rewind
     *
     * @return bool
     */
    public function rewind()
    {
        try {
            if ( $this->resource ) {
                rewinddir($this->resource);
            } else {
                throw new ExceptionHandler(__METHOD__.": rewind failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** close
     *
     * @return void
     */
    public function close()
    {
        closedir($this->resource);
    }

    /** setSortOrder
     *
     * @param integer $order the sort order
     *
     * @return bool
     */
    public function setSortOrder( $order )
    {
        try {
            if ( $this->checkNewInput($order) ) {
                if ( $this->checkOrderAcceptable($order) ) {
                    $this->sortOrder = $order;
                } else {
                    throw new ExceptionHandler(__METHOD__.": invalid sort option.");
                }
            } else {
                throw new ExceptionHandler(__METHOD__.": setSortOrder failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkOrderAcceptable
     *
     * @param integer $order the sort order
     *
     * @return bool
     */
    protected function checkOrderAcceptable( $order )
    {
        if ( in_array($order, self::$_acceptableSortingOrders) ) {
            return true;
        } else {
            return false;
        }
    }

    /** scan
     *
     * @return bool
     */
    public function scan()
    {
        try {
            if ( $this->currentDirectory ) {
                if ( $this->sortOrder ) {
                    $this->contentsArray
                        = scandir($this->currentDirectory, $this->sortOrder);
                } else {
                    $this->contentsArray = scandir($this->currentDirectory);
                }
            } else {
                throw new ExceptionHandler(__METHOD__.": scan failed");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** printContents
     *
     * @return void
     */
    public function printContents()
    {
        print_r($this->contentsArray);
    }

    /** checkSlash
     *
     * @return bool
     */
    protected function checkSlash()
    {
        if ( substr($this->currentDirectory, -1) === '/' ) {
            return true;
        } else {
            return false;
        }
    }

    /** checkCreateDirectory
     *
     * @return bool
     */
    protected function checkCreateDirectory()
    {
        if ( $this->createDirectory() ) {
            return true;
        } else {
            return false;
        }
    }

    /** createDirectory
     *
     * @return bool
     */
    protected function createDirectory()
    {
        try {
            if ( mkdir($this->currentDirectory, $this->directoryPermission) ) {
                return true;
            } else {
                throw new ExceptionHandler(__METHOD__.": $this->currentDirectory was not created.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** execute
     *
     * @return bool
     */
    public function execute()
    {
        try {
            if ( $this->currentDirectory ) {
                $this->iterate();
            } elseif ( is_array($this->directoryList) ) {
                foreach ( $this->directoryList as  $this->currentDirectory ) {
                    $this->iterate();
                }
            } else {
                throw new ExceptionHandler(__METHOD__.": no directory was created.");
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
            if ( $this->checkIsDirectory() ) {
            } else {
                if ( $this->checkCreateDirectory() ) {
                    echo "Created: " . $this->currentDirectory . PHP_EOL;
                } else {
                    throw new ExceptionHandler(__METHOD__.": failed!");
                }
                //throw new ExceptionHandler(__METHOD__.": not a directory!");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** printItemName
     *
     * @return void
     */
    public function printItemName()
    {
        echo $this->itemName;
    }
}