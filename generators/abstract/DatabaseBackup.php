<?php
/**
 * PHP Version: ${PHP_VERSION}
 * Created by PhpStorm.
 * User: carl
 * Date: 1/16/14
 * Time: 4:57 PM
 */
require_once "interfaces".DIRECTORY_SEPARATOR."DatabaseBackupInterface.php";
require_once AMPHIBIAN_CORE . "CheckInput.php";
require_once AMPHIBIAN_CORE."Git.php";
/**
 * Class DatabaseBackup
 *
 * @category Generator
 * @package  DatabaseBackup
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/DatabaseBackup
 */
abstract class DatabaseBackup
    implements DatabaseBackupInterface 
{

    protected $command = "";
    protected $output = [];
    protected $returnStatus = null;
    protected $options = [];
    protected $host = "localhost";
    protected $database = "";
    protected $tables = [];
    protected $port = "";
    protected $socket = "";
    protected $user = "";
    protected $password = "";
    protected $protocol = "";
    protected $printOutputFlag = false;

    protected $destination = ".";
    protected $git;

    /**   setCommand
     *
     * @param string $command the command to run when all the arguments are set properly
     *
     * @return bool
     */
    public function setCommand($command)
    {
        try {
            if (CheckInput::checkNewInput($command)) {
                $this->command = $command;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": command invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        } finally {

        }
        return true;
    }

    /**   getCommand
     *
     * @return string
     */
    public function getCommand()
    {
        return $this->command;
    }

    /** appendCommand
     *
     * @param string $string a valid string to add to the command
     *
     * @return bool
     */
    public function appendCommand($string)
    {
        try {
            if (CheckInput::checkNewInput($string)) {
                $this->setCommand($this->getCommand().$string);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": string invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        } finally {

        }
        return true;
    }
    /**   setDatabase
     *
     * @param string $database the name of the database to backup
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
        } finally {

        }
        return true;
    }

    /**   getDatabase
     *
     * @return string
     */
    public function getDatabase()
    {
        return $this->database;
    }

    /**   setDestination
     *
     * @param string $destination where we want to save the file
     *
     * @return bool
     */
    public function setDestination($destination)
    {
        try {
            if (CheckInput::checkNewInput($destination)) {
                $this->destination = $destination;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": destination invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        } finally {

        }
        return true;
    }

    /**   getDestination
     *
     * @return string
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**   setHost
     *
     * @param string $host the server where the database is located
     *
     * @return bool
     */
    public function setHost($host)
    {
        try {
            if (CheckInput::checkNewInput($host)) {
                $this->host = $host;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": host invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        } finally {

        }
        return true;
    }

    /**   getHost
     *
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**   setOptions
     *
     * @param array $options the options to use in the command
     *
     * @return bool
     */
    public function setOptions($options)
    {
        try {
            if (CheckInput::checkNewInputArray($options)) {
                $this->options = $options;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": options invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        } finally {

        }
        return true;
    }

    /**   getOptions
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**   setPassword
     *
     * @param string $password the password to use to connect to the database
     *
     * @return bool
     */
    public function setPassword($password)
    {
        try {
            if (CheckInput::checkNewInput($password)) {
                $this->password = $password;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": password invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        } finally {

        }
        return true;
    }

    /**   getPassword
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**   setPort
     *
     * @param string $port the port to connect to the database
     *
     * @return bool
     */
    public function setPort($port)
    {
        try {
            if (CheckInput::checkNewInput($port)) {
                $this->port = $port;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": port invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        } finally {

        }
        return true;
    }

    /**   getPort
     *
     * @return string
     */
    public function getPort()
    {
        return $this->port;
    }

    /**   setProtocol
     *
     * @param string $protocol the protocol to use to backup the database
     *
     * @return bool
     */
    public function setProtocol($protocol)
    {
        try {
            if (CheckInput::checkNewInput($protocol)) {
                $this->protocol = $protocol;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": protocol invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        } finally {

        }
        return true;
    }

    /**   getProtocol
     *
     * @return string
     */
    public function getProtocol()
    {
        return $this->protocol;
    }

    /**   setSocket
     *
     * @param string $socket the database socket to use
     *
     * @return bool
     */
    public function setSocket($socket)
    {
        try {
            if (CheckInput::checkNewInput($socket)) {
                $this->socket = $socket;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": socket invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        } finally {

        }
        return true;
    }

    /**   getSocket
     *
     * @return string
     */
    public function getSocket()
    {
        return $this->socket;
    }

    /**   setTables
     *
     * @param array $tables the tables to backup
     *
     * @return bool
     */
    public function setTables($tables)
    {
        try {
            if (CheckInput::checkNewInputArray($tables)) {
                $this->tables = $tables;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": tables invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        } finally {

        }
        return true;
    }

    /**   getTables
     *
     * @return array
     */
    public function getTables()
    {
        return $this->tables;
    }

    /**   setUser
     *
     * @param string $user the user name to use for logging into the database
     *
     * @return bool
     */
    public function setUser($user)
    {
        try {
            if (CheckInput::checkNewInput($user)) {
                $this->user = $user;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": user invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        } finally {

        }
        return true;
    }

    /**   getUser
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /** execute
     *
     * @return bool
     */
    public function execute()
    {
        try {
            if (CheckInput::checkSet($this->destination)) {
                $this->git = Git::instance();
                $this->git->setupGit();
                if ( $this->buildCommand() ) {
                    $this->executeCommand();
                }
                $this->git->tearDownGit();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": destination invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        } finally {

        }
        return true;
    }

    /** buildCommand
     *
     * @return bool
     */
    abstract protected function buildCommand();

    /** executeCommand
     *
     * @return bool
     */
    protected function executeCommand()
    {
        try {
            if (CheckInput::checkSet($this->command)) {
                exec($this->command, $this->output, $this->returnStatus);
                if ( $this->printOutputFlag ) {
                    echo "Return status: $this->returnStatus \n";
                    print_r($this->output);
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": command invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        } finally {

        }
        return true;
    }
} 