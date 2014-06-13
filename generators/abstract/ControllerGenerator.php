<?php
/**
 * PHP Version: ${PHP_VERSION}
 * Created by PhpStorm.
 * User: carl
 * Date: 1/17/14
 * Time: 6:15 PM
 */
require_once "interfaces".DIRECTORY_SEPARATOR."ControllerGeneratorInterface.php";
require_once "BasicGenerator.php";
/**
 * Class ControllerGenerator
 *
 * @category ControllerGenerator
 * @package  ControllerGenerator
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/ControllerGenerator
 */
abstract class ControllerGenerator
    extends BasicGenerator
    implements ControllerGeneratorInterface 
{

    /** iterate
     *
     * @return void
     */
    protected function iterate()
    {
        $this->getTableDescription();
        $this->startClass();
        $this->addVariables();
        $this->addConstruct();
        $this->addInstance();
        $this->addFactory();
        $this->addPrepGetPayload();
        $this->addPrepInsertPayload();
        $this->addPrepUpdatePayload();
        $this->addPrepPatchPayload();
        $this->addPrepDeletePayload();
        $this->addPrepValidatePayload();
        $this->addPrepBrowsePayload();
        $this->addPrepSearchPayload();
        $this->addPrepIndexPayload();
        $this->addFileEnd();
    }

    /** getTableDescription
     *
     * @return bool
     */
    abstract protected function getTableDescription();

    /** startClass
     *
     * @return bool
     */
    protected function startClass()
    {
        $this->buffer = '<?php ' . PHP_EOL;
        $this->addFileComment();
        $this->buffer .= 'require_once __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."config.inc.php";' . PHP_EOL;
        $this->buffer .= 'require_once CORE_ABSTRACT."BasicController.php";' . PHP_EOL;
        $this->buffer .= '/**' . PHP_EOL;
        $this->buffer .= ' * Class ' . $this->tableName . 'Controller' . PHP_EOL;
        $this->buffer .= ' *' . PHP_EOL;
        $this->buffer .= ' * @category Controller' . PHP_EOL;
        $this->buffer .= ' * @package  ' . $this->tableName . PHP_EOL;
        $this->buffer .= ' * @author   Carl "Tex" Morgan <texmorgan@amphibian.co>' . PHP_EOL;
        $this->buffer .= ' * @license  https://www.gnu.org/licenses/gpl-3.0.html GPLv3' . PHP_EOL;
        $this->buffer .= ' * @link     TBD' . PHP_EOL;
        $this->buffer .= ' */' . PHP_EOL;
        $this->buffer .= 'class ' . $this->tableName . 'Controller' . PHP_EOL;
        $this->buffer .= '    extends BasicController' . PHP_EOL;
        //$this->buffer .= '    implements concreteControllerInterface'.PHP_EOL;
        $this->buffer .= '{' . PHP_EOL;
        return true;
    }

    /** addVariables
     *
     * @return bool
     */
    protected function addVariables()
    {
        $this->buffer .= '    static public $' . $this->tableName . 'Controller;' . PHP_EOL;
        $this->buffer .= PHP_EOL . PHP_EOL;
        return true;
    }

    /** addConstruct
     *
     * @return void
     */
    protected function addConstruct()
    {
        $this->buffer .= '    ' . '/** __construct' . PHP_EOL;
        $this->buffer .= '    ' . ' *' . PHP_EOL;
        $this->buffer .= '    ' . ' * @param resource $databaseConnection a valid database connection' . PHP_EOL;
        $this->buffer .= '    ' . '*/' . PHP_EOL;
        $this->buffer .= '    ' . 'public function __construct($databaseConnection)' . PHP_EOL;
        $this->buffer .= '    ' . '{' . PHP_EOL;
        $this->buffer .= '    ' . '    parent::__construct($databaseConnection);' . PHP_EOL;
        $this->buffer .= '    ' . '}' . PHP_EOL . PHP_EOL;
    }


    /** addInstance
     *
     * @return void
     */
    protected function addInstance()
    {
        $this->buffer .= '    ' . '/** instance' . PHP_EOL;
        $this->buffer .= '    ' . ' *' . PHP_EOL;
        $this->buffer .= '    ' . ' * @param resource $databaseConnection a valid database connection' . PHP_EOL;
        $this->buffer .= '    ' . ' *' . PHP_EOL;
        $this->buffer .= '    ' . ' * @return object' . PHP_EOL;
        $this->buffer .= '    ' . '*/' . PHP_EOL;
        $this->buffer .= '    ' . 'static public function instance($databaseConnection)' . PHP_EOL;
        $this->buffer .= '    ' . '{' . PHP_EOL;
        $this->buffer .= '    ' . '    if (!isset(self::$' . $this->tableName . 'Controller) ) {' . PHP_EOL;
        $this->buffer .= '    ' . '        self::$' . $this->tableName . 'Controller = new ' . $this->tableName . 'Controller($databaseConnection);' . PHP_EOL;
        $this->buffer .= '    ' . '    } else {' . PHP_EOL;
        $this->buffer .= '    ' . '        self::$' . $this->tableName . 'Controller->connection = $databaseConnection;' . PHP_EOL;
        $this->buffer .= '    ' . '    }' . PHP_EOL;
        $this->buffer .= '    ' . '    return self::$' . $this->tableName . 'Controller;' . PHP_EOL;
        $this->buffer .= '    ' . '}' . PHP_EOL . PHP_EOL;
    }

    /** addFactory
     *
     * @return void
     */
    protected function addFactory()
    {
        $this->buffer .= '    ' . '/** factory' . PHP_EOL;
        $this->buffer .= '    ' . ' *' . PHP_EOL;
        $this->buffer .= '    ' . ' * @param resource $databaseConnection a valid database connection' . PHP_EOL;
        $this->buffer .= '    ' . ' *' . PHP_EOL;
        $this->buffer .= '    ' . ' * @return object' . PHP_EOL;
        $this->buffer .= '    ' . '*/' . PHP_EOL;
        $this->buffer .= '    ' . 'static public function factory($databaseConnection)' . PHP_EOL;
        $this->buffer .= '    ' . '{' . PHP_EOL;
        $this->buffer .= '    ' . '    return new ' . $this->tableName . 'Controller($databaseConnection);' . PHP_EOL;
        $this->buffer .= '    ' . '}' . PHP_EOL . PHP_EOL;
    }

    /** addcheckAction
     *
     * @return void
     */
    protected function addcheckAction()
    {
        $this->buffer .= '    ' . '/** checkAction' . PHP_EOL;
        $this->buffer .= '    ' . ' *' . PHP_EOL;
        $this->buffer .= '    ' . ' * @return bool' . PHP_EOL;
        $this->buffer .= '    ' . '*/' . PHP_EOL;
        $this->buffer .= '    ' . 'public function checkAction()' . PHP_EOL;
        $this->buffer .= '    ' . '{' . PHP_EOL;
        $this->buffer .= '    ' . '}' . PHP_EOL . PHP_EOL;
    }

    /** addHandleAction
     *
     * @return void
     */
    protected function addHandleAction()
    {
        $this->buffer .= '    ' . '/** handleAction' . PHP_EOL;
        $this->buffer .= '    ' . ' *' . PHP_EOL;
        $this->buffer .= '    ' . ' * @return bool' . PHP_EOL;
        $this->buffer .= '    ' . '*/' . PHP_EOL;
        $this->buffer .= '    ' . 'public function handleAction()' . PHP_EOL;
        $this->buffer .= '    ' . '{' . PHP_EOL;
        $this->buffer .= '    ' . '}' . PHP_EOL . PHP_EOL;

    }

    /** addSendErrors
     *
     * @return void
     */
    protected function addSendErrors()
    {
        $this->buffer .= '    ' . '/** sendErrors' . PHP_EOL;
        $this->buffer .= '    ' . ' *' . PHP_EOL;
        $this->buffer .= '    ' . ' * @return void' . PHP_EOL;
        $this->buffer .= '    ' . '*/' . PHP_EOL;
        $this->buffer .= '    ' . 'public function sendErrors()' . PHP_EOL;
        $this->buffer .= '    ' . '{' . PHP_EOL;
        $this->buffer .= '    ' . '}' . PHP_EOL . PHP_EOL;
    }


    /** addPrepGetPayload
     *
     * @return void
     */
    protected function addPrepGetPayload()
    {
        $this->buffer .= '    ' . '/** prepGetPayload' . PHP_EOL;
        $this->buffer .= '    ' . ' *' . PHP_EOL;
        $this->buffer .= '    ' . ' * @return bool' . PHP_EOL;
        $this->buffer .= '    ' . '*/' . PHP_EOL;
        $this->buffer .= '    ' . 'public function prepGetPayload()' . PHP_EOL;
        $this->buffer .= '    ' . '{' . PHP_EOL;
        $this->buildPrepTemplate("get");
        $this->buffer .= '    ' . '}' . PHP_EOL . PHP_EOL;
    }

    /** addPrepInsertPayload
     *
     * @return void
     */
    protected function addPrepInsertPayload()
    {
        $this->buffer .= '    ' . '/** prepInsertPayload' . PHP_EOL;
        $this->buffer .= '    ' . ' *' . PHP_EOL;
        $this->buffer .= '    ' . ' * @return bool' . PHP_EOL;
        $this->buffer .= '    ' . '*/' . PHP_EOL;
        $this->buffer .= '    ' . 'public function prepInsertPayload()' . PHP_EOL;
        $this->buffer .= '    ' . '{' . PHP_EOL;
        $this->buildPrepTemplate("insert");
        $this->buffer .= '    ' . '}' . PHP_EOL . PHP_EOL;
    }

    /** addPrepUpdatePayload
     *
     * @return void
     */
    protected function addPrepUpdatePayload()
    {
        $this->buffer .= '    ' . '/** prepUpdatePayload' . PHP_EOL;
        $this->buffer .= '    ' . ' *' . PHP_EOL;
        $this->buffer .= '    ' . ' * @return bool' . PHP_EOL;
        $this->buffer .= '    ' . '*/' . PHP_EOL;
        $this->buffer .= '    ' . 'public function prepUpdatePayload()' . PHP_EOL;
        $this->buffer .= '    ' . '{' . PHP_EOL;
        $this->buildPrepTemplate("update");
        $this->buffer .= '    ' . '}' . PHP_EOL . PHP_EOL;
    }

    /** addPrepUpdatePayload
     *
     * @return void
     */
    protected function addPrepPatchPayload()
    {
        $this->buffer .= '    ' . '/** prepPatchPayload' . PHP_EOL;
        $this->buffer .= '    ' . ' *' . PHP_EOL;
        $this->buffer .= '    ' . ' * @return bool' . PHP_EOL;
        $this->buffer .= '    ' . '*/' . PHP_EOL;
        $this->buffer .= '    ' . 'public function prepPatchPayload()' . PHP_EOL;
        $this->buffer .= '    ' . '{' . PHP_EOL;
        $this->buildPrepTemplate("patch");
        $this->buffer .= '    ' . '}' . PHP_EOL . PHP_EOL;
    }

    /** addPrepUpdatePayload
     *
     * @return void
     */
    protected function addPrepDeletePayload()
    {
        $this->buffer .= '    ' . '/** prepDeletePayload' . PHP_EOL;
        $this->buffer .= '    ' . ' *' . PHP_EOL;
        $this->buffer .= '    ' . ' * @return bool' . PHP_EOL;
        $this->buffer .= '    ' . '*/' . PHP_EOL;
        $this->buffer .= '    ' . 'public function prepDeletePayload()' . PHP_EOL;
        $this->buffer .= '    ' . '{' . PHP_EOL;
        $this->buildPrepTemplate("delete");
        $this->buffer .= '    ' . '}' . PHP_EOL . PHP_EOL;
    }

    /** addPrepValidatePayload
     *
     * @return void
     */
    protected function addPrepValidatePayload()
    {
        $this->buffer .= '    ' . '/** prepValidatePayload' . PHP_EOL;
        $this->buffer .= '    ' . ' *' . PHP_EOL;
        $this->buffer .= '    ' . ' * @return bool' . PHP_EOL;
        $this->buffer .= '    ' . '*/' . PHP_EOL;
        $this->buffer .= '    ' . 'public function prepValidatePayload()' . PHP_EOL;
        $this->buffer .= '    ' . '{' . PHP_EOL;
        $this->buildPrepTemplate("validate");
        $this->buffer .= '    ' . '}' . PHP_EOL . PHP_EOL;
    }

    /** addPrepSearchPayload
     *
     * @return void
     */
    protected function addPrepSearchPayload()
    {
        $this->buffer .= '    ' . '/** prepSearchPayload' . PHP_EOL;
        $this->buffer .= '    ' . ' *' . PHP_EOL;
        $this->buffer .= '    ' . ' * @return bool' . PHP_EOL;
        $this->buffer .= '    ' . '*/' . PHP_EOL;
        $this->buffer .= '    ' . 'public function prepSearchPayload()' . PHP_EOL;
        $this->buffer .= '    ' . '{' . PHP_EOL;
        $this->buildPrepTemplate("search");
        $this->buffer .= '    ' . '}' . PHP_EOL . PHP_EOL;
    }

    /** addPrepBrowsePayload
     *
     * @return void
     */
    protected function addPrepBrowsePayload()
    {
        $this->buffer .= '    ' . '/** prepBrowsePayload' . PHP_EOL;
        $this->buffer .= '    ' . ' *' . PHP_EOL;
        $this->buffer .= '    ' . ' * @return bool' . PHP_EOL;
        $this->buffer .= '    ' . '*/' . PHP_EOL;
        $this->buffer .= '    ' . 'public function prepBrowsePayload()' . PHP_EOL;
        $this->buffer .= '    ' . '{' . PHP_EOL;
        $this->buildPrepTemplate("browse");
        $this->buffer .= '    ' . '}' . PHP_EOL . PHP_EOL;
    }

    /** addPrepIndexPayload
     *
     * @return void
     */
    protected function addPrepIndexPayload()
    {
        $this->buffer .= '    ' . '/** prepIndexPayload' . PHP_EOL;
        $this->buffer .= '    ' . ' *' . PHP_EOL;
        $this->buffer .= '    ' . ' * @return bool' . PHP_EOL;
        $this->buffer .= '    ' . '*/' . PHP_EOL;
        $this->buffer .= '    ' . 'public function prepIndexPayload()' . PHP_EOL;
        $this->buffer .= '    ' . '{' . PHP_EOL;
        $this->buildPrepTemplate("index");
        $this->buffer .= '    ' . '}' . PHP_EOL . PHP_EOL;
    }

    /** buildPrepTemplate
     *
     * @param string $type the type of action
     *
     * @return void
     */
    protected function buildPrepTemplate($type)
    {
        $this->buffer .= '    ' . '    try {' . PHP_EOL;
        $this->buffer .= '    ' . '        $prepArray = array();' . PHP_EOL;
        $this->buildArray($type);
        $this->buffer .= '    ' . '        if ( !$this->dataPackage->setPayload($prepArray) ) {' . PHP_EOL;
        $this->buffer .= '    ' . '            throw new ExceptionHandler(__METHOD__ . ": preparation failed.");' . PHP_EOL;
        $this->buffer .= '    ' . '        }' . PHP_EOL;
        $this->buffer .= '    ' . '    } catch ( ExceptionHandler $e ) {' . PHP_EOL;
        $this->buffer .= '    ' . '        $e->execute();' . PHP_EOL;
        $this->buffer .= '    ' . '        return false;' . PHP_EOL;
        $this->buffer .= '    ' . '    }' . PHP_EOL;
        $this->buffer .= '    ' . '    return true;' . PHP_EOL;

    }

    /** buildArray
     *
     * @param string $type the type of action
     *
     * @return bool
     */
    protected function buildArray($type)
    {
        try {
            if (CheckInput::checkNewInput($type)) {
                if ($type === "get" OR $type === "validate") {
                    $this->buffer .= '    ' . '        $prepArray["id"] = $_GET["id"];' . PHP_EOL;
                } elseif ($type === "insert") {
                    $columnArray = $this->tableDescription->getColumns();
                    foreach ($columnArray as $columnName) {
                        $this->buffer .= '    ' . '        $prepArray["' . $columnName . '"] = $this->cascadeGetPost("' . $columnName . '");' . PHP_EOL;
                    }
                } elseif ($type === "update") {
                    $columnArray = $this->tableDescription->getColumns();
                    foreach ($columnArray as $columnName) {
                        $this->buffer .= '    ' . '        $prepArray["' . $columnName . '"] = $this->cascadeGetPost("' . $columnName . '");' . PHP_EOL;
                    }
                } elseif ($type === "patch") {
                    $columnArray = $this->tableDescription->getColumns();
                    foreach ($columnArray as $columnName) {
                        $this->buffer .= '    ' . '        $prepArray["' . $columnName . '"] = $_POST["' . $columnName . '"];' . PHP_EOL;
                    }
                } elseif ($type === "delete") {
                    $this->buffer .= '    ' . '        $prepArray["id"] = $_POST["id"];' . PHP_EOL;
                } elseif ($type === "search") {

                } elseif ($type === "browse") {

                } else {

                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": buildArray failed.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** addFileEnd
     *
     * @return void
     */
    protected function addFileEnd()
    {
        $this->buffer .= '}' . PHP_EOL;
    }
} 