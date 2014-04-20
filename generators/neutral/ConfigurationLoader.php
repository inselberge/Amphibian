<?php
/**
 * PHP version ${PHP_VERSION}
 * Created by PhpStorm.
 * User: carl
 * Date: 4/8/14
 * Time: 11:35 PM
 */
require_once "interfaces".DIRECTORY_SEPARATOR."ConfigurationLoaderInterface.php";

/**
 * Class ConfigurationLoader
 *
 * @category GeneratorsNeutral
 * @package  ConfigurationLoader
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  GPL v3
 * @link     documentation/ConfigurationLoader
 */
class ConfigurationLoader
    implements ConfigurationLoaderInterface
{
    /**
     * @var string configurationFile the file to load
     */
    protected $configurationFile;
    /**
     * @var bool database true = config; false = database
     */
    protected $database = false;
    /**
     * @var string databaseUser the name of the database user
     */
    protected $databaseUser;
    /**
     * @var bool production true = production; false = staging
     */
    protected $production = false;
    /**
     * @var string projectName the name of the project to search
     */
    protected $projectName;
    /**
     * @var object ConfigurationLoader a singleton instance of this class
     */
    static public $ConfigurationLoader;
    
    /** __construct
     *
     * @param string $projectName the name of the project to use
    */
    protected function __construct($projectName)
    {
        try {
            if (CheckInput::checkNewInput($projectName)) {
                $this->projectName = $projectName;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": projectName invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }
    
    /** instance
     *
     * @param string $projectName the name of the project to use
     *
     * @return ConfigurationLoader
     */
    static public function instance($projectName)
    {
        if ( !isset(self::$ConfigurationLoader) ) {
            self::$ConfigurationLoader = new ConfigurationLoader($projectName);
        } else {
            self::$ConfigurationLoader->setProjectName($projectName);
        }
        return self::$ConfigurationLoader;
    }
     
    /** factory
     *
     * @param string $projectName the name of the project to use
     *
     * @return ConfigurationLoader
     */
    static public function factory($projectName)
    {
        return new ConfigurationLoader($projectName);
    }

    /**   getConfigurationFile
     *
     * @return string
     */
    public function getConfigurationFile()
    {
        return $this->configurationFile;
    }

    /**   setConfigurationFile
     *
     * @param string $configurationFile
     *
     * @return bool
     */
    public function setConfigurationFile($configurationFile)
    {
        try {
            if (CheckInput::checkNewInput($configurationFile)) {
                $this->configurationFile = $configurationFile;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": configurationFile invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getDatabase
     *
     * @return boolean
     */
    public function getDatabase()
    {
        return $this->database;
    }

    /**   setDatabase
     *
     * @param boolean $database
     *
     * @return bool
     */
    public function setDatabase($database)
    {
        try {
            if (CheckInput::checkNewInput($database)) {
                $this->database = $database;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": database invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getDatabaseUser
     *
     * @return string
     */
    public function getDatabaseUser()
    {
        return $this->databaseUser;
    }

    /**   setDatabaseUser
     *
     * @param string $databaseUser
     *
     * @return bool
     */
    public function setDatabaseUser($databaseUser)
    {
        try {
            if (CheckInput::checkNewInput($databaseUser)) {
                $this->databaseUser = $databaseUser;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": databaseUser invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getProduction
     *
     * @return boolean
     */
    public function getProduction()
    {
        return $this->production;
    }

    /**   setProduction
     *
     * @param boolean $production
     *
     * @return bool
     */
    public function setProduction($production)
    {
        try {
            if (CheckInput::checkNewInput($production)) {
                $this->production = $production;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": production invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getProjectName
     *
     * @return string
     */
    public function getProjectName()
    {
        return $this->projectName;
    }

    /**   setProjectName
     *
     * @param string $projectName
     *
     * @return bool
     */
    public function setProjectName($projectName)
    {
        try {
            if (CheckInput::checkNewInput($projectName)) {
                $this->projectName = $projectName;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": projectName invalid.");
            }
        } catch (ExceptionHandler $e) {
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
            if ( $this->checkExists() ) {
                include_once "$this->configurationFile";
            } else {
                throw new ExceptionHandler(__METHOD__ . ": configuration does not exist.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkExists
     *
     * @return bool
     */
    protected function checkExists()
    {
        try {
            if ( $this->buildLocation() ) {
                if ( $this->buildFileName() ) {
                    return file_exists($this->configurationFile);
                } else {
                    throw new ExceptionHandler(__METHOD__ . ": error building name.");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": error building location.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
    }

    /** buildLocation
     *
     * @return bool
     */
    protected function buildLocation()
    {
        try {
            if (CheckInput::checkSet($this->projectName)) {
                $this->setConfigurationFile(AMPHIBIAN_PROJECT . $this->projectName . DIRECTORY_SEPARATOR);
                $this->forkDatabase();
                $this->forkProduction();
            } else {
                throw new ExceptionHandler(__METHOD__ . ":some message.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** forkDatabase
     *
     * @return bool
     */
    protected function forkDatabase()
    {
        try {
            if (CheckInput::checkSet($this->database)) {
                if ( $this->database === true) {
                    $this->configurationFile .= "database".DIRECTORY_SEPARATOR;
                } else {
                    $this->configurationFile .= "config" . DIRECTORY_SEPARATOR;
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": database required.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** forkProduction
     *
     * @return bool
     */
    protected function forkProduction()
    {
        try {
            if (CheckInput::checkSet($this->production)) {
                if ($this->production === true) {
                    $this->configurationFile .= "production" . DIRECTORY_SEPARATOR;
                } else {
                    $this->configurationFile .= "staging" . DIRECTORY_SEPARATOR;
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": database required.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** buildFileName
     *
     * @return bool
     */
    protected function buildFileName()
    {
        try {
            if (CheckInput::checkSet($this->projectName)) {
                if ( $this->database === true) {
                    return $this->forkDatabaseUser();
                } else {
                    $this->configurationFile .= $this->projectName.".config.inc.php";
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": projectName required.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** forkDatabaseUser
     *
     * @return bool
     */
    protected function forkDatabaseUser()
    {
        try {
            if (CheckInput::checkSet($this->databaseUser)) {
                $this->configurationFile .= $this->databaseUser . ".inc.php";
            } else {
                throw new ExceptionHandler(__METHOD__ . ": databaseUser required.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }
}