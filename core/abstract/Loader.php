<?php
/**
 * PHP version ${PHP_VERSION}
 * Created by PhpStorm.
 * User: carl
 * Date: 4/26/14
 * Time: 4:09 PM
 */
require_once "interfaces".DIRECTORY_SEPARATOR."LoaderInterface.php";
/**
 * Class Loader
 *
 * @category CoreAbstract
 * @package  Loader
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  GPL v2
 * @link
 */
abstract class Loader
    implements LoaderInterface
{

    /**
     * @var array possibleFiles list of the possible files that match
     */
    protected $possibleFiles = array();
    /**
     * @var array declared an array of the already declared classes
     */
    protected $declared = array();
    /**
     * @var array searchLocations an array of the locations to search
     */
    protected $searchLocations = array();
    /**
     * @var string currentLocation the current location to search
     */
    protected $currentLocation;
    /**
     * @var string selectedFile the name of the file with the class
     */
    protected $selectedFile = "";
    /**
     * @var string possibleClass the name of the class to possibly use
     */
    protected $possibleClass;
    /**
     * @var string decoratedClass the class you want to use decorated
     */
    protected $decoratedClass;
    /**
     * @var string class the class you want to use
     */
    protected $class;
    /**
     * @var string method the method you want to call
     */
    protected $method;


    /** set
     *
     * @param string $key the key to use
     * @param mixed $value the value to set
     *
     * @return bool
     */
    public function set($key, $value)
    {
        try {
            if (CheckInput::checkSet($key) AND CheckInput::checkNewInput($value)) {
                if ($this->checkVariable($key)) {
                    $this->$key = $value;
                } else {
                    throw new ExceptionHandler(__METHOD__ . ": key unknown.");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": key or value invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** get
     *
     * @param string $key the variable you want to get
     *
     * @return bool
     */
    public function get($key)
    {
        try {
            if (CheckInput::checkSet($key)) {
                if ($this->checkVariable($key)) {
                    return $this->$key;
                } else {
                    throw new ExceptionHandler(__METHOD__ . ": key unknown.");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": key invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
    }

    /** checkVariable
     *
     * @param string $key the variable you want check
     *
     * @return bool
     */
    protected function checkVariable($key)
    {
        return array_key_exists($key, get_object_vars($this));
    }

    /** loadDefaultLocations
     *
     * @return bool
     */
    abstract protected function loadDefaultLocations();

    /** loadFiles
     *
     * @return bool
     */
    protected function loadFiles()
    {
        try {
            if (CheckInput::checkSetArray($this->searchLocations)) {
                foreach ( $this->searchLocations as $this->currentLocation ) {
                    $this->possibleFiles[$this->currentLocation] = scandir($this->currentLocation);
                }
                if (!CheckInput::checkSetArray($this->possibleFiles)) {
                    throw new ExceptionHandler(__METHOD__ . ":loadFiles failed.");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": search locations required.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** loadDeclared
     *
     * @return bool
     */
    protected function loadDeclared()
    {
        try {
            $this->declared = get_declared_classes();
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** decorateClass
     *
     * @return bool
     */
    abstract protected function decorateClass();

    /** execute
     *
     * @return bool
     */
    public function execute()
    {
        try {
            if ($this->checkRequirements()) {
                if ( $this->checkDeclared() === false) {
                    if ( $this->find() ) {
                        $this->load();
                    } else {
                        throw new ExceptionHandler(__METHOD__ . ": class missing.");
                    }
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": requirements not met.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkRequirements
     *
     * @return bool
     */
    abstract protected function checkRequirements();

    /** checkDeclared
     *
     * @return bool
     */
    protected function checkDeclared()
    {
        try {
            if (CheckInput::checkSetArray($this->declared)) {
                return in_array($this->class, $this->declared);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": declared invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
    }

    /** find
     *
     * @return bool
     */
    protected function find()
    {
        try {
            $this->loadFiles();
            if (CheckInput::checkSetArray($this->possibleFiles)) {
                foreach ($this->possibleClassFiles as $this->currentLocation => $this->selectedFile) {
                    if ($this->extractClassFromFile()) {
                        $this->class = $this->possibleClass;
                        return true;
                    }
                }
                return false;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": classFiles required.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
    }

    /** extractClassFromFile
     *
     * @return bool
     */
    protected function extractClassFromFile()
    {
        try {
            if (CheckInput::checkSet($this->selectedFile)) {
                if (strstr($this->selectedFile, ".php")) {
                    list($this->possibleClass, $garbage) = explode('.php', $this->selectedFile);
                    unset($garbage);
                    return $this->checkClass();
                } else {
                    return false;
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": class file invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
    }

    /** load
     *
     * @return bool
     */
    protected function load()
    {
        try {
            if ($this->checkClass() AND $this->checkMethod()) {
                if (file_exists($this->currentLocation . $this->class . ".php")) {
                    include_once $this->currentLocation . $this->class . ".php";
                } else {
                    throw new ExceptionHandler(__METHOD__ . ": load failed.");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": load requirements not met.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkClass
     *
     * @return bool
     */
    protected function checkClass()
    {
        try {
            if ($this->checkClassEqual()) {
                if (!class_exists($this->class, false)) {
                    throw new ExceptionHandler(__METHOD__ . ": class does not exist.");
                }
            } else {
                return false;
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkClassEqual
     *
     * @return bool
     */
    protected function checkClassEqual()
    {
        if ($this->possibleClass === $this->class) {
            return true;
        } else {
            return false;
        }
    }

    /** checkMethod
     *
     * @return bool
     */
    protected function checkMethod()
    {
        try {
            if (CheckInput::checkSet($this->method)) {
                if (!method_exists($this->class, $this->method)) {
                    throw new ExceptionHandler(__METHOD__ . ": method does not exist.");
                }
                if (!$this->checkClassMethodCallable()) {
                    throw new ExceptionHandler(__METHOD__ . ": method not callable.");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": method invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkCallable
     *
     * @return bool
     */
    protected function checkCallable()
    {
        try {
            if (CheckInput::checkSet($this->method)) {
                return is_callable($this->method);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": method required.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
    }

} 