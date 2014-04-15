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
        $this->buffer = '<?php ' . "\n";
        $this->addFileComment();
        $this->buffer .= 'require_once __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."config.inc.php";' . "\n";
        $this->buffer .= 'require_once CORE_ABSTRACT."BasicController.php";' . "\n";
        $this->buffer .= '/**' . "\n";
        $this->buffer .= ' * Class ' . $this->tableName . 'Controller' . "\n";
        $this->buffer .= ' *' . "\n";
        $this->buffer .= ' * @category Controller' . "\n";
        $this->buffer .= ' * @package  ' . $this->tableName . "\n";
        $this->buffer .= ' * @author   Carl "Tex" Morgan <texmorgan@amphibian.co>' . "\n";
        $this->buffer .= ' * @license  https://www.gnu.org/licenses/gpl-3.0.html GPLv3' . "\n";
        $this->buffer .= ' * @link     TBD' . "\n";
        $this->buffer .= ' */' . "\n";
        $this->buffer .= 'class ' . $this->tableName . 'Controller' . "\n";
        $this->buffer .= '    extends BasicController' . "\n";
        //$this->buffer .= '    implements concreteControllerInterface'."\n";
        $this->buffer .= '{' . "\n";
        return true;
    }

    /** addVariables
     *
     * @return bool
     */
    protected function addVariables()
    {
        $this->buffer .= '    static public $' . $this->tableName . 'Controller;' . "\n";
        $this->buffer .= "\n\n";
        return true;
    }

    /** addConstruct
     *
     * @return void
     */
    protected function addConstruct()
    {
        $this->buffer .= '    ' . '/** __construct' . "\n";
        $this->buffer .= '    ' . ' *' . "\n";
        $this->buffer .= '    ' . ' * @param resource $databaseConnection a valid database connection' . "\n";
        $this->buffer .= '    ' . '*/' . "\n";
        $this->buffer .= '    ' . 'public function __construct($databaseConnection)' . "\n";
        $this->buffer .= '    ' . '{' . "\n";
        $this->buffer .= '    ' . '    parent::__construct($databaseConnection);' . "\n";
        $this->buffer .= '    ' . '}' . "\n\n";
    }


    /** addInstance
     *
     * @return void
     */
    protected function addInstance()
    {
        $this->buffer .= '    ' . '/** instance' . "\n";
        $this->buffer .= '    ' . ' *' . "\n";
        $this->buffer .= '    ' . ' * @param resource $databaseConnection a valid database connection' . "\n";
        $this->buffer .= '    ' . ' *' . "\n";
        $this->buffer .= '    ' . ' * @return object' . "\n";
        $this->buffer .= '    ' . '*/' . "\n";
        $this->buffer .= '    ' . 'static public function instance($databaseConnection)' . "\n";
        $this->buffer .= '    ' . '{' . "\n";
        $this->buffer .= '    ' . '    if (!isset(self::$' . $this->tableName . 'Controller) ) {' . "\n";
        $this->buffer .= '    ' . '        self::$' . $this->tableName . 'Controller = new ' . $this->tableName . 'Controller($databaseConnection);' . "\n";
        $this->buffer .= '    ' . '    } else {' . "\n";
        $this->buffer .= '    ' . '        self::$' . $this->tableName . 'Controller->connection = $databaseConnection;' . "\n";
        $this->buffer .= '    ' . '    }' . "\n";
        $this->buffer .= '    ' . '    return self::$' . $this->tableName . 'Controller;' . "\n";
        $this->buffer .= '    ' . '}' . "\n\n";
    }

    /** addFactory
     *
     * @return void
     */
    protected function addFactory()
    {
        $this->buffer .= '    ' . '/** factory' . "\n";
        $this->buffer .= '    ' . ' *' . "\n";
        $this->buffer .= '    ' . ' * @param resource $databaseConnection a valid database connection' . "\n";
        $this->buffer .= '    ' . ' *' . "\n";
        $this->buffer .= '    ' . ' * @return object' . "\n";
        $this->buffer .= '    ' . '*/' . "\n";
        $this->buffer .= '    ' . 'static public function factory($databaseConnection)' . "\n";
        $this->buffer .= '    ' . '{' . "\n";
        $this->buffer .= '    ' . '    return new ' . $this->tableName . 'Controller($databaseConnection);' . "\n";
        $this->buffer .= '    ' . '}' . "\n\n";
    }

    /** addcheckAction
     *
     * @return void
     */
    protected function addcheckAction()
    {
        $this->buffer .= '    ' . '/** checkAction' . "\n";
        $this->buffer .= '    ' . ' *' . "\n";
        $this->buffer .= '    ' . ' * @return bool' . "\n";
        $this->buffer .= '    ' . '*/' . "\n";
        $this->buffer .= '    ' . 'public function checkAction()' . "\n";
        $this->buffer .= '    ' . '{' . "\n";
        $this->buffer .= '    ' . '}' . "\n\n";
    }

    /** addHandleAction
     *
     * @return void
     */
    protected function addHandleAction()
    {
        $this->buffer .= '    ' . '/** handleAction' . "\n";
        $this->buffer .= '    ' . ' *' . "\n";
        $this->buffer .= '    ' . ' * @return bool' . "\n";
        $this->buffer .= '    ' . '*/' . "\n";
        $this->buffer .= '    ' . 'public function handleAction()' . "\n";
        $this->buffer .= '    ' . '{' . "\n";
        $this->buffer .= '    ' . '}' . "\n\n";

    }

    /** addSendErrors
     *
     * @return void
     */
    protected function addSendErrors()
    {
        $this->buffer .= '    ' . '/** sendErrors' . "\n";
        $this->buffer .= '    ' . ' *' . "\n";
        $this->buffer .= '    ' . ' * @return void' . "\n";
        $this->buffer .= '    ' . '*/' . "\n";
        $this->buffer .= '    ' . 'public function sendErrors()' . "\n";
        $this->buffer .= '    ' . '{' . "\n";
        $this->buffer .= '    ' . '}' . "\n\n";
    }


    /** addPrepGetPayload
     *
     * @return void
     */
    protected function addPrepGetPayload()
    {
        $this->buffer .= '    ' . '/** prepGetPayload' . "\n";
        $this->buffer .= '    ' . ' *' . "\n";
        $this->buffer .= '    ' . ' * @return bool' . "\n";
        $this->buffer .= '    ' . '*/' . "\n";
        $this->buffer .= '    ' . 'public function prepGetPayload()' . "\n";
        $this->buffer .= '    ' . '{' . "\n";
        $this->buildPrepTemplate("get");
        $this->buffer .= '    ' . '}' . "\n\n";
    }

    /** addPrepInsertPayload
     *
     * @return void
     */
    protected function addPrepInsertPayload()
    {
        $this->buffer .= '    ' . '/** prepInsertPayload' . "\n";
        $this->buffer .= '    ' . ' *' . "\n";
        $this->buffer .= '    ' . ' * @return bool' . "\n";
        $this->buffer .= '    ' . '*/' . "\n";
        $this->buffer .= '    ' . 'public function prepInsertPayload()' . "\n";
        $this->buffer .= '    ' . '{' . "\n";
        $this->buildPrepTemplate("insert");
        $this->buffer .= '    ' . '}' . "\n\n";
    }

    /** addPrepUpdatePayload
     *
     * @return void
     */
    protected function addPrepUpdatePayload()
    {
        $this->buffer .= '    ' . '/** prepUpdatePayload' . "\n";
        $this->buffer .= '    ' . ' *' . "\n";
        $this->buffer .= '    ' . ' * @return bool' . "\n";
        $this->buffer .= '    ' . '*/' . "\n";
        $this->buffer .= '    ' . 'public function prepUpdatePayload()' . "\n";
        $this->buffer .= '    ' . '{' . "\n";
        $this->buildPrepTemplate("update");
        $this->buffer .= '    ' . '}' . "\n\n";
    }

    /** addPrepUpdatePayload
     *
     * @return void
     */
    protected function addPrepPatchPayload()
    {
        $this->buffer .= '    ' . '/** prepPatchPayload' . "\n";
        $this->buffer .= '    ' . ' *' . "\n";
        $this->buffer .= '    ' . ' * @return bool' . "\n";
        $this->buffer .= '    ' . '*/' . "\n";
        $this->buffer .= '    ' . 'public function prepPatchPayload()' . "\n";
        $this->buffer .= '    ' . '{' . "\n";
        $this->buildPrepTemplate("patch");
        $this->buffer .= '    ' . '}' . "\n\n";
    }

    /** addPrepUpdatePayload
     *
     * @return void
     */
    protected function addPrepDeletePayload()
    {
        $this->buffer .= '    ' . '/** prepDeletePayload' . "\n";
        $this->buffer .= '    ' . ' *' . "\n";
        $this->buffer .= '    ' . ' * @return bool' . "\n";
        $this->buffer .= '    ' . '*/' . "\n";
        $this->buffer .= '    ' . 'public function prepDeletePayload()' . "\n";
        $this->buffer .= '    ' . '{' . "\n";
        $this->buildPrepTemplate("delete");
        $this->buffer .= '    ' . '}' . "\n\n";
    }

    /** addPrepValidatePayload
     *
     * @return void
     */
    protected function addPrepValidatePayload()
    {
        $this->buffer .= '    ' . '/** prepValidatePayload' . "\n";
        $this->buffer .= '    ' . ' *' . "\n";
        $this->buffer .= '    ' . ' * @return bool' . "\n";
        $this->buffer .= '    ' . '*/' . "\n";
        $this->buffer .= '    ' . 'public function prepValidatePayload()' . "\n";
        $this->buffer .= '    ' . '{' . "\n";
        $this->buildPrepTemplate("validate");
        $this->buffer .= '    ' . '}' . "\n\n";
    }

    /** addPrepSearchPayload
     *
     * @return void
     */
    protected function addPrepSearchPayload()
    {
        $this->buffer .= '    ' . '/** prepSearchPayload' . "\n";
        $this->buffer .= '    ' . ' *' . "\n";
        $this->buffer .= '    ' . ' * @return bool' . "\n";
        $this->buffer .= '    ' . '*/' . "\n";
        $this->buffer .= '    ' . 'public function prepSearchPayload()' . "\n";
        $this->buffer .= '    ' . '{' . "\n";
        $this->buildPrepTemplate("search");
        $this->buffer .= '    ' . '}' . "\n\n";
    }

    /** addPrepBrowsePayload
     *
     * @return void
     */
    protected function addPrepBrowsePayload()
    {
        $this->buffer .= '    ' . '/** prepBrowsePayload' . "\n";
        $this->buffer .= '    ' . ' *' . "\n";
        $this->buffer .= '    ' . ' * @return bool' . "\n";
        $this->buffer .= '    ' . '*/' . "\n";
        $this->buffer .= '    ' . 'public function prepBrowsePayload()' . "\n";
        $this->buffer .= '    ' . '{' . "\n";
        $this->buildPrepTemplate("browse");
        $this->buffer .= '    ' . '}' . "\n\n";
    }

    /** addPrepIndexPayload
     *
     * @return void
     */
    protected function addPrepIndexPayload()
    {
        $this->buffer .= '    ' . '/** prepIndexPayload' . "\n";
        $this->buffer .= '    ' . ' *' . "\n";
        $this->buffer .= '    ' . ' * @return bool' . "\n";
        $this->buffer .= '    ' . '*/' . "\n";
        $this->buffer .= '    ' . 'public function prepIndexPayload()' . "\n";
        $this->buffer .= '    ' . '{' . "\n";
        $this->buildPrepTemplate("index");
        $this->buffer .= '    ' . '}' . "\n\n";
    }

    /** buildPrepTemplate
     *
     * @param string $type the type of action
     *
     * @return void
     */
    protected function buildPrepTemplate($type)
    {
        $this->buffer .= '    ' . '    try {' . "\n";
        $this->buffer .= '    ' . '        $prepArray = array();' . "\n";
        $this->buildArray($type);
        $this->buffer .= '    ' . '        if ( !$this->dataPackage->setPayload($prepArray) ) {' . "\n";
        $this->buffer .= '    ' . '            throw new ExceptionHandler(__METHOD__ . ": preparation failed.");' . "\n";
        $this->buffer .= '    ' . '        }' . "\n";
        $this->buffer .= '    ' . '    } catch ( ExceptionHandler $e ) {' . "\n";
        $this->buffer .= '    ' . '        $e->execute();' . "\n";
        $this->buffer .= '    ' . '        return false;' . "\n";
        $this->buffer .= '    ' . '    }' . "\n";
        $this->buffer .= '    ' . '    return true;' . "\n";

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
                    $this->buffer .= '    ' . '        $prepArray["id"] = $_GET["id"];' . "\n";
                } elseif ($type === "insert") {
                    $columnArray = $this->tableDescription->getColumns();
                    foreach ($columnArray as $columnName) {
                        $this->buffer .= '    ' . '        $prepArray["' . $columnName . '"] = $this->cascadeGetPost("' . $columnName . '");' . "\n";
                    }
                } elseif ($type === "update") {
                    $columnArray = $this->tableDescription->getColumns();
                    foreach ($columnArray as $columnName) {
                        $this->buffer .= '    ' . '        $prepArray["' . $columnName . '"] = $this->cascadeGetPost("' . $columnName . '");' . "\n";
                    }
                } elseif ($type === "patch") {
                    $columnArray = $this->tableDescription->getColumns();
                    foreach ($columnArray as $columnName) {
                        $this->buffer .= '    ' . '        $prepArray["' . $columnName . '"] = $_POST["' . $columnName . '"];' . "\n";
                    }
                } elseif ($type === "delete") {
                    $this->buffer .= '    ' . '        $prepArray["id"] = $_POST["id"];' . "\n";
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
        $this->buffer .= '}' . "\n";
    }
} 