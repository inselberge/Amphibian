<?php
/**
 * PHP Version 5.4.9-4ubuntu2.2
 * Created by PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 10/11/13
 * Time: 2:25 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."config.inc.php";
require_once AMPHIBIAN_CONFIG . "Amphibian.config.inc.php";
require_once AMPHIBIAN_CORE_NEUTRAL . "FileHandle.php";
require_once AMPHIBIAN_CORE_NEUTRAL . "CheckInput.php";
require_once AMPHIBIAN_CORE_ABSTRACT . "TableDescription.php";
require_once AMPHIBIAN_CORE_NEUTRAL . "Git.php";
require_once "interfaces".DIRECTORY_SEPARATOR."BasicGeneratorInterface.php";
/**
 * Class BasicGenerator
 *
 * @category Generator
 * @package  BasicGenerator
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/Amphibian/documentation/BasicGenerator
 */
abstract class BasicGenerator
    implements BasicGeneratorInterface
{
    /**
     * @var object connection holds the database connection
     */
    protected $connection;
    /**
     * @var string fileDestination where the file will be written
     */
    protected $fileDestination;
    /**
     * @var object FileHandle the file to write
     */
    protected $FileHandle;
    /**
     * @var string fileExtension the file extension to use for the FileHandle
     */
    protected $fileExtension = ".php";
    /**
     * @var object git the Git object to use for versioning
     */
    protected $git;
    /**
     * @var string tableName the name of the current table
     */
    protected $tableName;
    /**
     * @var array tableArray the tables to go through
     */
    protected $tableArray;
    /**
     * @var array tableColumns the columns of the agency from the database
     */
    protected $tableColumns;
    /**
     * @var object tableDescription a description of the current table
     */
    protected $tableDescription;
    /**
     * @var string buffer the values to write to the file
     */
    protected $buffer;

    /** __construct
     *
     * @param object $databaseConnection a valid database connection
     */
    protected function __construct($databaseConnection)
    {
        try {
            if ( CheckInput::checkNewInput($databaseConnection) ) {
                $this->connection = $databaseConnection;
                $this->git = Git::factory();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": invalid connection");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** setTableName
     *
     * @param string $tableName the name of the table
     *
     * @return bool
     */
    public function setTableName($tableName)
    {
        try {
            if ( CheckInput::checkNewInput($tableName) ) {
                $this->tableName = $tableName;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": table name invalid.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**  setFileDestination
     *
     * @param string $fileDestination where to save the file
     *
     * @return boolean
     */
    public function setFileDestination( $fileDestination )
    {
        try {
            if ( CheckInput::checkNewInput($fileDestination) ) {
                $this->fileDestination = $fileDestination;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": fileDestination is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**  setFileExtension
     *
     * @param string $fileExtension the file extension to use for the FileHandle
     *
     * @return boolean
     */
    public function setFileExtension( $fileExtension )
    {
        try {
            if ( CheckInput::checkNewInput($fileExtension) ) {
                $this->fileExtension = $fileExtension;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": fileExtension is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getFileExtension
     *
     * @return string
     */
    public function getFileExtension()
    {
        return $this->fileExtension;
    }

    /** execute
     *
     * @return bool
     */
    public function execute()
    {
        try {
            if ( $this->checkFileDestination() ) {
                //$this->git->setupGit();
                if ( isset($this->tableName) ) {
                    $this->iterate();
                    $this->writeFromBuffer();
                    $this->setupForNext();
                } else {
                    $this->fetchAll();
                    foreach ($this->tableArray as $this->tableName ) {
                        $this->iterate();
                        $this->writeFromBuffer();
                        $this->setupForNext();
                    }
                }
                //todo: double check this works --> $this->git->teardownGit();
            } else {
                throw new ExceptionHandler(__METHOD__.": fileDestination invalid.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkFileDestination
     *
     * @return bool
     */
    protected function checkFileDestination()
    {
        if ( CheckInput::checkSet($this->fileDestination) ) {
            return true;
        } else {
            return false;
        }
    }

    /** iterate
     *
     * @return bool
     */
    abstract protected function iterate();

    /** fetchAll
     *
     * @return bool
     */
    abstract protected function fetchAll();

    /** writeFromBuffer
     *
     * @return bool
     */
    protected function writeFromBuffer()
    {
        try {
            if ( CheckInput::checkNewInput($this->buffer) ) {
                $this->FileHandle = new FileHandle($this->fileDestination. strtolower($this->tableName) . $this->fileExtension);
                $this->FileHandle->writeFull($this->buffer);
                $this->clearBuffer();
            } else {
                throw new ExceptionHandler(__METHOD__.":The buffer is empty.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** clearBuffer
     *
     * @return void
     */
    protected function clearBuffer()
    {
        $this->buffer = null;
    }

    /** clearTableName
     *
     * @return void
     */
    protected function clearTableName()
    {
        $this->tableName = null;
    }

    /** setupForNext
     *
     * @return void
     */
    protected function setupForNext()
    {
        $this->FileHandle    = null;
        $this->tableName     = null;
    }

    /** addFileComment
     *
     * @return void
     */
    protected function addFileComment()
    {
        $this->buffer .= '/**' . "\n";
        $this->buffer .= ' * PHP version ' . PHP_VERSION . "\n";
        $this->buffer .= ' * Created by Amphibian' . "\n";
        $this->buffer .= ' * Project: ' . APP_NAME . "\n";
        $this->buffer .= ' * User: ' . "\n";
        $this->buffer .= ' * Date: ' . date('m/d/Y') . "\n";
        $this->buffer .= ' * Time: ' . date('H:i:s') . "\n";
        $this->buffer .= ' */' . "\n";
    }

} 