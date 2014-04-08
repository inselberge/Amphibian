<?php
/**
 * PHP version ${PHP_VERSION}
 * Created by PhpStorm.
 * User: carl
 * Date: 3/31/14
 * Time: 10:22 PM
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once AMPHIBIAN_CORE_NEUTRAL."CheckInput.php";
require_once "interfaces".DIRECTORY_SEPARATOR."amphibianProjectInterface.php";
/**
 * Class amphibianProject
 *
 * @category Generators
 * @package  AmphibianProject
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  GPL v3
 * @link
 */
class AmphibianProject
    implements amphibianProjectInterface
{
    /**
     * @var string name the name of the new project
     */
    protected $name;
    /**
     * @var object amphibianProject a singleton instance of this class
     */
    static public $amphibianProject;

    /** __construct
     */
    protected function __construct()
    {

    }

    /** instance
     *
     * @return amphibianProject
     */
    static public function instance()
    {
        if ( !isset(self::$amphibianProject) ) {
            self::$amphibianProject = new amphibianProject();
        }
        return self::$amphibianProject;
    }

    /** factory
     *
     * @return amphibianProject
     */
    static public function factory()
    {
        return new amphibianProject();
    }

    /** getName
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /** setName
     *
     * @param string $name the project Name
     *
     * @return bool
     */
    public function setName($name)
    {
        try {
            if (CheckInput::checkNewInput($name) AND $this->validName($name) === 1) {
                $this->name = $name;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": name invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** validName
     *
     * @param string $name the name of the project
     *
     * @return int
     */
    protected function validName($name)
    {
        return preg_match('/^[\w]+$/',$name);
    }

    /** check
     *
     * @param string $name the name of a current project
     *
     * @return bool
     */
    public function check($name)
    {
        try {
            if (CheckInput::checkSet($name)) {
                return is_dir(AMPHIBIAN_PROJECT.$name);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": name required!");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
    }

    /** create
     * 
     * @return bool
     */
    public function create()
    {
        try {
            if (CheckInput::checkSet($this->name)) {
                $this->makeDirectory(AMPHIBIAN_PROJECT.$this->name.DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."production");
                $this->makeDirectory(AMPHIBIAN_PROJECT . $this->name . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "staging");
                $this->makeDirectory(AMPHIBIAN_PROJECT . $this->name . DIRECTORY_SEPARATOR . "database" . DIRECTORY_SEPARATOR . "production");
                $this->makeDirectory(AMPHIBIAN_PROJECT . $this->name . DIRECTORY_SEPARATOR . "database" . DIRECTORY_SEPARATOR . "staging");
            } else {
                throw new ExceptionHandler(__METHOD__ . ": name required!");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** makeDirectory
     *
     * @param string $directory the new directory
     *
     * @return bool
     */
    protected function makeDirectory($directory)
    {
        try {
            if (CheckInput::checkSet($directory) AND $this->check($directory) === false) {
                mkdir($directory, 0755, true);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": directory exists!");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** rename
     * 
     * @param string $newName the new name of the project
     * 
     * @return bool
     */
    public function rename($newName)
    {
        try {
            if (CheckInput::checkSet($newName)) {

            } else {
                throw new ExceptionHandler(__METHOD__ . ":some message.");
            }
        } catch (ExceptionHandler $e) {
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
        try {
            if ($this->check($this->name)) {
                rmdir(AMPHIBIAN_PROJECT .$this->name);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": directory invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }
}
/*
$project = AmphibianProject::instance();
$project->setName("YourProject");
$project->create();
*/