<?php
/**
 * PHP version 5.4.17
 *
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 6/30/13
 * Time: 10:23 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once "interfaces".DIRECTORY_SEPARATOR."BasicControllerInterface.php";
require_once AMPHIBIAN_CORE_ABSTRACT."BasicInteraction.php";
require_once AMPHIBIAN_CORE_NEUTRAL."FormData.php";
/**
 * Class BasicController
 *
 * @category Core
 * @package  Core
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/BasicController
 */
abstract class BasicController
    extends BasicInteraction
    implements BasicControllerInterface
{
    /**
     * @var object startFormData an instance of formData with data collected on load
     */
    protected $startFormData;
    /**
     * @var object endFormData an instance of formData with data collected after load
     */
    protected $endFormData;
    /**
     * @var array differences an array of differences between the start and end
     */
    protected $differences = [];
    /**
     * @var boolean listMode a boolean signaling to list records or not
     */
    protected $listMode;
    /**
     * @var integer objectId the id of a single record
     */
    protected $objectId;
    /**
     * @var boolean editMode a boolean signaling to edit the record or not
     */
    protected $editMode;
    /**
     * @var string action the desired action to call on either the agency or model
     */
    protected $action;
    /**
     * @var array actionsAvailable the possible actions to call
     */
    protected $actionsAvailable = ["index","get","insert","update","patch","delete","validate","browse", "search"];
    /**
     * @var object model a model for the controller to call
     */
    protected $model;
    /**
     * @var object agency an agency for the controller to call
     */
    protected $agency;

    /** __construct
     *
     * @param resource $databaseConnection a database connection
     */
    protected function __construct( $databaseConnection )
    {
        try {
            parent::__construct($databaseConnection);
            $this->onLoad();
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** onLoad
     *
     * @return bool
     */
    public function onLoad()
    {
        try {
            $this->startFormData = new formData();
            $this->getStartFormData();
            $this->defaultModes();
            //TODO: check frontController handles this properly
            if ( CheckInput::checkSetArray($this->startFormData) ) {

            } else {
                throw new ExceptionHandler(__METHOD__ . ": error setting start form data.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** defaultModes
     *
     * @return void
     */
    protected function defaultModes()
    {
        $this->editMode=0;
        $this->listMode=0;
        $this->objectId=null;
    }


    /** getStartFormData
     *
     * @return void
     */
    protected function getStartFormData()
    {
        $this->startFormData->loadSuperVariables();
    }

    /**  setEditMode
     *
     * @param boolean $editMode a boolean denoting if edit mode is on or off
     *
     * @return boolean
     */
    public function setEditMode( $editMode )
    {
        try {
            if ( CheckInput::checkSet($editMode) ) {
                $this->editMode = $editMode;
            } else {
                throw new ExceptionHandler(__METHOD__.": setEditMode failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**  setListMode
     *
     * @param boolean $listMode a boolean denoting if list mode is on or off
     *
     * @return boolean
     */
    public function setListMode( $listMode )
    {
        try {
            if ( CheckInput::checkSet($listMode) ) {
                $this->listMode = $listMode;
            } else {
                throw new ExceptionHandler(__METHOD__.": setListMode failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**  setObjectId
     *
     * @param string $objectId the id of the object
     *
     * @return boolean
     */
    public function setObjectId( $objectId )
    {
        try {
            if ( CheckInput::checkSet($objectId) ) {
                $this->objectId = $objectId;
            } else {
                throw new ExceptionHandler(__METHOD__.": setObjectId failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** receive
     *
     * @return void
     */
    public function receive()
    {
        $this->endFormData = new formData();
        $this->getEndFormData();
        $this->forkRequestMethod();
        $this->extractAction();
    }

    /** getEndFormData
     *
     * @return void
     */
    protected function getEndFormData()
    {
        $this->endFormData->loadSuperVariables();
    }

    /** checkDifferences
     *
     * @return bool
     */
    public function checkDifferences()
    {
        try {
            if ( $this->checkCompleteFormData() ) {
                $this->addDifferences();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": incomplete data.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkCompleteFormData
     *
     * @return bool
     */
    protected function checkCompleteFormData()
    {
        if ( $this->checkStartFormData() AND $this->checkEndFormData() ) {
            return true;
        } else {
            return false;
        }
    }

    /** addDifferences
     *
     * @return bool
     */
    protected function addDifferences()
    {
        try {
            foreach ( $this->startFormData as $superArray ) {
                $this->differences[] = array_diff_assoc(
                    $this->endFormData->$superArray,
                    $superArray
                );
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getDifferences
     *
     * @return mixed
     */
    public function getDifferences()
    {
        return $this->differences;
    }

    // $BasicControllerObject->acceptViewDataPackage($viewObject->getDataPackage());
    /** acceptViewDataPackage
     *
     * @param object $viewDataPackage a dataPackage for a view
     *
     * @return bool
     */
    public function acceptViewDataPackage($viewDataPackage)
    {
        try {
            if ( $this->checkDataPackage($viewDataPackage) ) {
                $this->ferret($viewDataPackage);
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** ferret
     *
     * @param object $viewDataPackage a dataPackage for a view
     *
     * @return bool
     */
    protected function ferret($viewDataPackage)
    {
        try {
            $tmpPayload = $viewDataPackage->getPayload();
            if ( CheckInput::checkNewInputArray($tmpPayload) ) {
                foreach ($tmpPayload as $formDataArray => $index ) {
                    $this->addToPayload($formDataArray, $index);
                }
            } else {
                throw new ExceptionHandler(__METHOD__.": View payload is empty.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }
    //TODO: move to dataPackage Helper
    /** addToPayload
     *
     * @param array  $formDataArray a specific array from formData
     * @param string $index         a specific index in the array
     *
     * @return bool
     */
    protected function addToPayload($formDataArray,$index)
    {
        try {
            if ( $this->checkArrayIndex($formDataArray, $index) ) {
                $tmpValue = null;
                $tmpValue = $this->getValueByKey($formDataArray, $index);
                $this->dataPackage->addToArray("payload", [$index, $tmpValue]);
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkArrayIndex
     *
     * @param array  $formDataArray a specific array from formData
     * @param string $index         a specific index in the array
     *
     * @return bool
     */
    protected function checkArrayIndex($formDataArray,$index)
    {
        try {
            if ( CheckInput::checkNewInput($formDataArray) ) {
                if (! CheckInput::checkNewInput($index) ) {
                    throw new ExceptionHandler(__METHOD__ . ": index invalid.");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": formDataArray invalid.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getValueByKey
     *
     * @param array  $formDataArray a specific array from formData
     * @param string $index         a specific index in the array
     *
     * @return mixed
     */
    protected function getValueByKey($formDataArray,$index)
    {
        try {
            if ( $this->checkEndFormData() ) {
                return $this->endFormData->getByKey($formDataArray, $index);
            } elseif ($this->checkStartFormData()) {
                return $this->startFormData->getByKey($formDataArray, $index);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": data not found");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** checkEndFormData
     *
     * @return bool
     */
    protected function checkEndFormData()
    {
        if ( !empty($this->endFormData) ) {
            return true;
        } else {
            return false;
        }
    }

    /** checkStartFormData
     *
     * @return bool
     */
    protected function checkStartFormData()
    {
        if ( !empty($this->startFormData) ) {
            return true;
        } else {
            return false;
        }
    }

    /**  setAction
     *
     * @param string $action the action you wish to perform
     *
     * @return boolean
     */
    public function setAction( $action )
    {
        try {
            if ( CheckInput::checkNewInput($action) ) {
                $this->action = $action;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": action is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getAction
     *
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**  setActionsAvailable
     *
     * @param array $actionsAvailable an array of available actions
     *
     * @return boolean
     */
    public function setActionsAvailable( $actionsAvailable )
    {
        try {
            if ( CheckInput::checkNewInput($actionsAvailable) ) {
                $this->actionsAvailable = $actionsAvailable;
            } else {
                throw new ExceptionHandler(__METHOD__ . ":actionsAvailable invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getActionsAvailable
     *
     * @return array
     */
    public function getActionsAvailable()
    {
        return $this->actionsAvailable;
    }

    /**  setAgency
     *
     * @param object $agency the agency to use
     *
     * @return boolean
     */
    public function setAgency( $agency )
    {
        try {
            if ( CheckInput::checkNewInput($agency) ) {
                $this->agency = $agency;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": agency is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getAgency
     *
     * @return object
     */
    public function getAgency()
    {
        return $this->agency;
    }

    /**  setModel
     *
     * @param object $model the model to use
     *
     * @return boolean
     */
    public function setModel( $model )
    {
        try {
            if ( CheckInput::checkNewInput($model) ) {
                $this->model = $model;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": model is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getModel
     *
     * @return object
     */
    public function getModel()
    {
        return $this->model;
    }

    /** forkRequestMethod
     *
     * @return bool
     */
    protected function forkRequestMethod()
    {
        try {
            if ( isset($_SERVER["REQUEST_METHOD"]) ) {
                if ( $_SERVER["REQUEST_METHOD"] == "POST" ) {
                    $this->editMode = true;
                } else {
                    $this->editMode = false;
                }
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** extractAction
     *
     * @return bool
     */
    public function extractAction()
    {
        try {
            if ( !CheckInput::checkSet($this->action) ) {
                if ( $this->isIndex() ) {
                    $this->action = "index";
                }
                if ( $this->isGet() ) {
                    $this->action = "get";
                    $this->setActionAvailable($this->model);
                }
                if ( $this->isEdit() ) {
                    $this->action = "update";
                    $this->setActionAvailable($this->model);
                }
                if ( $this->isInsert() ) {
                    $this->action = "insert";
                    $this->setActionAvailable($this->model);
                }
                if ( $this->isValidate() ) {
                    $this->action = "validate";
                    $this->setActionAvailable($this->model);
                }
                if ( $this->isList() ) {
                    $this->action = "browse";
                    $this->setActionAvailable($this->agency);
                }
                if ( $this->isSearch() ) {
                    $this->action = "search";
                    $this->setActionAvailable($this->agency);
                }
                if ( !CheckInput::checkSet($this->action) ) {
                    throw new ExceptionHandler(__METHOD__ . ": extractAction failed.");
                }
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** isIndex
     *
     * @return bool
     */
    protected function isIndex()
    {
        if ( $this->editMode || $this->listMode || $this->objectId ) {
            return false;
        } else {
            return true;
        }
    }

    /** isInsert
     *
     * @return bool
     */
    protected function isInsert()
    {
        if ( $this->editMode && !$this->objectId ) {
            return true;
        } else {
            return false;
        }
    }

    /** isGet
     *
     * @return bool
     */
    protected function isGet()
    {
        if ( !$this->editMode && $this->objectId ) {
            return true;
        } else {
            return false;
        }

    }

    /** isEdit
     *
     * @return bool
     */
    protected function isEdit()
    {
        if ( $this->editMode && $this->objectId ) {
            return true;
        } else {
            return false;
        }

    }

    /** isList
     *
     * @return bool
     */
    protected function isList()
    {
        if ( $this->listMode ) {
            return true;
        } else {
            return false;
        }

    }

    /** isValidate
     *
     * @return bool
     */
    protected function isValidate()
    {
        if ( $this->listMode && $this->objectId ) {
            return true;
        } else {
            return false;
        }

    }

    /** isSearch
     *
     * @return bool
     */
    protected function isSearch()
    {
        if ( $this->listMode && $this->editMode ) {
            return true;
        } else {
            return false;
        }
    }

    /** checkActionAvailable
     *
     * @return bool
     */
    protected function checkActionAvailable()
    {
        if ( in_array($this->action, $this->actionsAvailable) ) {
            return true;
        } else {
            return false;
        }
    }

    /** setActionAvailable
     *
     * @param object $agencyOrModelObject either an agency or model to use
     *
     * @return bool
     */
    protected function setActionAvailable($agencyOrModelObject)
    {
        try {
            $this->actionsAvailable = get_class_methods($agencyOrModelObject);
            if (! CheckInput::checkNewInputArray($this->actionsAvailable) ) {
                throw new ExceptionHandler(__METHOD__ . ": setActionsAvailable failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkAction
     *
     * @return bool
     */
    public function checkAction()
    {
        try {
            if ( CheckInput::checkSet($this->action) ) {
                $this->handleAction();
            } else {
                $this->extractAction();
                if ( $this->checkActionAvailable() ) {
                    $this->handleAction();
                }
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** handleAction
     *
     * @return bool
     */
    public function handleAction()
    {
        try {
            $this->receive();
            if ( CheckInput::checkSet($this->endFormData) ) {
                switch ( $this->action ) {
                case "insert":
                    $this->insert();
                    break;
                case "get":
                    $this->get();
                    break;
                case "validate":
                    $this->validate();
                    break;
                case "update":
                    $this->update();
                    break;
                case "search":
                    $this->search();
                    break;
                case "browse":
                    $this->browse();
                    break;
                case "index":
                    $this->index();
                    break;
                case "delete":
                    $this->delete();
                    break;
                case "patch":
                    $this->patch();
                    break;
                default:
                    break;
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": handleAction failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** prepAgency
     *
     * @return void
     */
    protected function prepAgency()
    {
        $this->agency->acceptArgumentsDataPackage($this->dataPackage);
    }

    /** prepModel
     *
     * @return void
     */
    protected function prepModel()
    {
        $this->model->setDataPackage($this->dataPackage);
        $this->model->extractPayload();
    }

    /** get
     *
     * @return void
     */
    protected function get()
    {
        $this->prepGetPayload();
        $this->prepModel();
        $this->model->get($this->objectId);
    }

    /** insert
     *
     * @return void
     */
    protected function insert()
    {
        $this->prepInsertPayload();
        $this->prepModel();
        $this->model->insert();
    }

    /** update
     *
     * @return void
     */
    protected function update()
    {
        $this->prepUpdatePayload();
        $this->prepModel();
        $this->model->update();

    }

    /** validate
     *
     * @return void
     */
    protected function validate()
    {
        $this->prepValidatePayload();
        $this->prepModel();
        $this->model->validate($this->objectId);
    }

    /** search
     *
     * @return void
     */
    protected function search()
    {
        $this->prepSearchPayload();
        $this->prepAgency();
        $this->agency->execute();
    }

    /** browse
     *
     * @return void
     */
    protected function browse()
    {
        $this->prepBrowsePayload();
        $this->prepAgency();
        $this->agency->execute();
    }

    /** patch
     *
     * @return void
     */
    protected function patch()
    {
        $this->prepPatchPayload();
        $this->prepModel();
        $this->model->patch();
    }

    /** delete
     *
     * @return void
     */
    protected function delete()
    {
        $this->prepDeletePayload();
        $this->prepModel();
        $this->model->delete();
    }

    /** index
     *
     * @return void
     */
    protected function index()
    {
        $this->prepIndexPayload();
        $this->prepModel();
        $this->model->index();
    }

    /** prepGetPayload
     *
     * @return bool
     */
    abstract protected function prepGetPayload();

    /** prepInsertPayload
     *
     * @return bool
     */
    abstract protected function prepInsertPayload();

    /** prepUpdatePayload
     *
     * @return bool
     */
    abstract protected function prepUpdatePayload();

    /** prepSearchPayload
     *
     * @return bool
     */
    abstract protected function prepSearchPayload();

    /** prepValidatePayload
     *
     * @return bool
     */
    abstract protected function prepValidatePayload();

    /** prepBrowsePayload
     *
     * @return bool
     */
    abstract protected function prepBrowsePayload();

    /** prepIndexPayload
     *
     * @return bool
     */
    abstract protected function prepIndexPayload();

    /** prepPatchPayload
     *
     * @return bool
     */
    abstract protected function prepPatchPayload();

    /** prepDeletePayload
     *
     * @return bool
     */
    abstract protected function prepDeletePayload();

    //TODO: possibly move cascadeGetPost up to the FrontController
    /** cascadeGetPost
     *
     * @param string $name the name of the variable
     *
     * @return mixed
     */
    protected function cascadeGetPost($name)
    {
        if ( isset($name) ) {
            if ( isset($_POST["$name"]) AND !is_null($_POST["$name"]) AND strlen($_POST["$name"]) > 0 ) {
                return $_POST["$name"];
            } elseif ( isset($_GET["$name"]) AND !is_null($_GET["$name"]) AND strlen($_GET["$name"]) > 0 ) {
                return $_GET["$name"];
            } else {
                return null;
            }
        } else {
            return null;
        }
    }
}