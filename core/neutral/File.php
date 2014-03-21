<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Carl "Tex" Morgan
 * Date: 2/18/13
 * Time: 10:44 AM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once "interfaces".DIRECTORY_SEPARATOR."FileInterface.php";
require_once AMPHIBIAN_CORE_NEUTRAL ."CheckInput.php";
/**
 * Class File
 *
 * @category Helper
 * @package  Core
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/file
 */
class File
    implements fileInterface
{
    /**
     * @var string name holds the name of the file
     */
    protected $name;
    /**
     * @var string type the type of file
     */
    protected $type;
    /**
     * @var mixed pathInformation
     */
    protected $pathInformation;
    /**
     * @var string realPath where the file is really located
     */
    protected $realPath;
    /**
     * @var array statistics an array with information regarding the file
     */
    protected $statistics;

    /** __construct

     */
    public function __construct()
    {
    }

    /**  setName
     *
     * @param string $name
     *
     * @return boolean
     */
    public function setName( $name )
    {
        try {
            if ( CheckInput::checkNewInput($name) ) {
                $this->name = $name;
                $this->getStatistics();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": name is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }



    /** cascade
     *
     * @param array $locations an array of places to look
     *
     * @return bool|string
     */
    public function cascade( $locations )
    {
        try {
            if ( CheckInput::checkNewInputArray($locations) ) {
                foreach ( $locations as $l ) {
                    if ( file_exists($l . $this->name) ) {
                        return $l . $this->name;
                    }
                }
                throw new ExceptionHandler(__METHOD__ . ": file not found.");
            } else {
                throw new ExceptionHandler(__METHOD__ . ": cascade failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** copy
     *
     * @param string $destinationName where to copy the file
     *
     * @return bool
     */
    public function copy( $destinationName )
    {
        try {
            if ( CheckInput::checkNewInput($destinationName) ) {
                if (! copy($this->name, $destinationName) ) {
                    throw new ExceptionHandler(__METHOD__ . ": copy failed.");
                }
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** rename
     *
     * @param string $destinationName the new name
     *
     * @return bool
     */
    public function rename( $destinationName )
    {
        try {
            if ( CheckInput::checkNewInput($destinationName) ) {
                if ( !rename($this->name, $destinationName) ) {
                    throw new ExceptionHandler(__METHOD__ . ": rename failed.");
                }
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** delete
     *
     * @return bool
     */
    public function delete()
    {
        /*
         * TODO: generators/core/File.php:60: Low: exec
            A potential race condition vulnerability exists here.
            Normally a call to this
            function is vulnerable only when a match check precedes it.  No check was
            detected, however one could still exist that could not be detected.
         */
        try {
            if ( !system("rm -rf $this->name") ) {
                throw new ExceptionHandler(__METHOD__ . ": delete failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** changeOwner
     *
     * @param string $name the name of the new owner
     *
     * @return bool
     */
    public function changeOwner( $name )
    {
        try {
            if ( CheckInput::checkNewInput($name) ) {
                /*
                 * TODO: generators/core/File.php:79: Low: chown
                    A potential race condition vulnerability exists here.
                    Normally a call to this function is vulnerable only
                    when a match check precedes it.  No check was
                    detected, however one could still exist that could not be detected.
                 */
                if ( chown($this->name, $name) ) {
                } else {
                    throw new ExceptionHandler(__METHOD__ . ": changeOwner failed.");
                }
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** changeGroup
     *
     * @param string $name the name of the new group
     *
     * @return bool
     */
    public function changeGroup( $name )
    {
        try {
            if ( CheckInput::checkNewInput($name) ) {
                if ( chgrp($this->name, $name) ) {
                } else {
                    throw new ExceptionHandler(__METHOD__ . ": changeGroup failed.");
                }
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** changePermissions
     *
     * @param string $newPermissions the new file permission
     *
     * @return bool
     */
    public function changePermissions( $newPermissions )
    {
        try {
            if ( $this->checkPermisions($newPermissions) ) {
                /*
                 * TODO: generators/core/File.php:124: Low: chmod
                    A potential race condition vulnerability exists here.
                    Normally a call to this
                    function is vulnerable only when a match check precedes it.
                    No check was
                    detected, however one could still exist
                    that could not be detected.
                 */
                if ( chmod($this->name, $newPermissions) ) {
                } else {
                    throw new ExceptionHandler(__METHOD__ . ": changePermissions failed.");
                }
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkPermisions
     *
     * @param string $newPermissions the new permissions
     *
     * @return bool
     */
    protected function checkPermisions( $newPermissions )
    {
        try {
            if ( !CheckInput::checkNewInput($newPermissions) ) {
                throw new ExceptionHandler(__METHOD__ . ": invalid new permission.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** printAccessTime
     *
     * @return bool
     */
    public function printAccessTime()
    {
        try {
            if ( isset($this->statistics['atime']) ) {
                echo $this->statistics['atime'];
            } else {
                throw new ExceptionHandler(__METHOD__ . ": access time invalid.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** printChangeTime
     *
     * @return bool
     */
    public function printChangeTime()
    {
        try {
            if ( isset($this->statistics['ctime']) ) {
                echo $this->statistics['ctime'];
            } else {
                throw new ExceptionHandler(__METHOD__ . ": change time invalid.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** printFileGroup
     *
     * @return bool
     */
    public function printFileGroup()
    {
        try {
            if ( isset($this->statistics['gid']) ) {
                echo $this->statistics['gid'];
            } else {
                throw new ExceptionHandler(__METHOD__ . ": group id invalid.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** printFileOwner
     *
     * @return bool
     */
    public function printFileOwner()
    {
        try {
            if ( isset($this->statistics['uid']) ) {
                echo $this->statistics['uid'];
            } else {
                throw new ExceptionHandler(__METHOD__ . ": user id invalid.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** printFilePermissions
     *
     * @return bool
     */
    public function printFilePermissions()
    {
        try {
            if ( isset($this->statistics['mode']) ) {
                echo $this->statistics['mode'];
            } else {
                throw new ExceptionHandler(__METHOD__ . ": mode invalid.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** printFileSize
     *
     * @return bool
     */
    public function printFileSize()
    {
        try {
            if ( isset($this->statistics['size']) ) {
                echo $this->statistics['size'];
            } else {
                throw new ExceptionHandler(__METHOD__ . ": size invalid.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** printFileType
     *
     * @return bool
     */
    public function printFileType()
    {
        try {
            if ( isset($this->type) ) {
                echo $this->type;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": File type is not set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** printDirectoryName
     *
     * @return bool
     */
    public function printDirectoryName()
    {
        try {
            if ( isset($this->pathInformation['dirname']) ) {
                echo $this->pathInformation['dirname'];
            } else {
                throw new ExceptionHandler(__METHOD__ . ": Directory name invalid.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** printBaseName
     *
     * @return bool
     */
    public function printBaseName()
    {
        try {
            if ( isset($this->pathInformation['basename']) ) {
                echo $this->pathInformation['basename'];
            } else {
                throw new ExceptionHandler(__METHOD__ . ": Base name is not set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** printExtension
     *
     * @return bool
     */
    public function printExtension()
    {
        try {
            if ( isset($this->pathInformation['extension']) ) {
                echo $this->pathInformation['extension'];
            } else {
                throw new ExceptionHandler(__METHOD__ . ": Extension is not set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** printFileName
     *
     * @return bool
     */
    public function printFileName()
    {
        try {
            if ( isset($this->pathInformation['filename']) ) {
                echo $this->pathInformation['filename'];
            } else {
                throw new ExceptionHandler(__METHOD__ . ": File name is not set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** touch
     *
     * @return bool
     */
    protected function touch()
    {
        return touch($this->name);
    }

    /** getPathInformation
     *
     * @return void
     */
    protected function getPathInformation()
    {
        $this->pathInformation = pathinfo($this->name);
    }

    /** getRealPathInformation
     *
     * @return void
     */
    protected function getRealPathInformation()
    {
        $this->realPath = realpath($this->name);
    }

    /** checkExists
     *
     * @return bool
     */
    protected function checkExists()
    {
        try {
            if ( !file_exists($this->name) ) {
                throw new ExceptionHandler(__METHOD__ . ": file does not exist.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getStatistics
     *
     * @return bool
     */
    protected function getStatistics()
    {
        try {
            $this->statistics = stat($this->name);
            if ( !is_array($this->statistics) ) {
                throw new ExceptionHandler(__METHOD__ . ": getStatistics failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** clearStatistics
     *
     * @return void
     */
    protected function clearStatistics()
    {
        clearstatcache();
        $this->getStatistics();
    }
}
