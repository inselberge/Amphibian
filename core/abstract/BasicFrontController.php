<?php
/**
 * PHP Version: ${PHP_VERSION}
 * Created by PhpStorm.
 * User: carl
 * Date: 1/30/14
 * Time: 12:01 PM
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once AMPHIBIAN_CORE_NEUTRAL."CheckInput.php";
require_once AMPHIBIAN_CORE_NEUTRAL ."URL.php";
require_once AMPHIBIAN_CORE_NEUTRAL . "Parameter.php";
require_once AMPHIBIAN_CORE_NEUTRAL ."Log.php";
require_once AMPHIBIAN_CORE_NEUTRAL ."DataPackage.php";
require_once "interfaces".DIRECTORY_SEPARATOR."BasicFrontControllerInterface.php";
/**
 * Class BasicFrontController
 *
 * @category BasicFrontController
 * @package  BasicFrontController
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/BasicFrontController
 */
abstract class BasicFrontController
    implements BasicFrontControllerInterface 
{
    /**
     * @var string defaultBranch the default value for the branch
     */
    protected $defaultBranch;
    /**
     * @var string defaultAction
     */
    protected $defaultAction = "index";
    /**
     * @var string defaultController the default controller if one is not specified
     */
    protected $defaultController;
    /**
     * @var string requestMethod the server request method
     */
    protected $requestMethod;
    /**
     * @var string putFile holds the information passed in via a PUT call
     */
    protected $putFile;
    /**
     * @var object url holds values for $basicFrontController->url
     */
    protected $url;
    /**
     * @var string scheme holds values for $basicFrontController->scheme
     */
    protected $scheme;
    /**
     * @var string host holds values for $basicFrontController->host
     */
    protected $host;
    /**
     * @var string path holds values for $basicFrontController->path
     */
    protected $path;
    /**
     * @var string protocol holds values for $basicFrontController->protocol
     */
    protected $protocol;
    /**
     * @var object log holds values for $basicFrontController->log
     */
    protected $log;
    /**
     * @var string urlBase holds values for $basicFrontController->urlBase
     */
    protected $urlBase;
    /**
     * @var string branch the specific branch of the site
     */
    protected $branch;
    /**
     * @var string renderMethod the specific way to render (html,etc.)
     */
    protected $renderMethod;
    /**
     * @var  string deviceType the specific device type (desktop, etc.)
     */
    protected $deviceType;
    /**
     * @var  string viewType the specific view type (browse, form)
     */
    protected $viewType;
    /**
     * @var  string className the name of the class to use
     */
    protected $className;
    /**
     * @var string controllerName the name of the controller to load
     */
    protected $controllerName;
    /**
     * @var object controller an instance of the specific controller
     */
    public $controller;
    /**
     * @var string action the specific action for the controller to perform
     */
    protected $action;
    /**
     * @var object parameters the specific values set from the URL parsing
     */
    protected $parameters;
    /**
     * @var object dataPackage holds all the data required to pass information
     */
    public $dataPackage;
    /**
     * @var boolean autoRender default: true, set to false for manual rendering
     */
    protected $autoRender = true;

    /**  setPutFile
     *
     * @param string $putFile the data from php://input
     *
     * @return boolean
     */
    public function setPutFile($putFile)
    {
        try {
            if (CheckInput::checkNewInput($putFile)) {
                $this->putFile = $putFile;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": putFile is not valid");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getPutFile
     *
     * @return object
     */
    public function getPutFile()
    {
        return $this->putFile;
    }

    /**  setRequestMethod
     *
     * @param string $requestMethod the value of $_SERVER["REQUEST_METHOD"]
     *
     * @return boolean
     */
    public function setRequestMethod($requestMethod)
    {
        try {
            if (CheckInput::checkNewInput($requestMethod)) {
                $this->requestMethod = $requestMethod;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": requestMethod is not valid");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getRequestMethod
     *
     * @return string
     */
    public function getRequestMethod()
    {
        return $this->requestMethod;
    }

    /** checkXHTTP
     *
     * @return bool
     */
    protected function checkXHTTP()
    {
        try {
            if (CheckInput::checkSet($this->requestMethod)) {
                if ($this->requestMethod === "POST") {
                    if (array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER)) {
                        if ($_SERVER["HTTP_X_HTTP_METHOD"] === "DELETE") {
                            $this->setRequestMethod("DELETE");
                        } elseif ($_SERVER["HTTP_X_HTTP_METHOD"] === "PUT") {
                            $this->setRequestMethod("PUT");
                        }
                    }
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": requestMethod invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setAutoRender
     *
     * @param bool $autoRender true = auto-render, false = manual render
     *
     * @return bool
     */
    public function setAutoRender($autoRender)
    {
        try {
            if (CheckInput::checkSet($autoRender)) {
                $this->autoRender = $autoRender;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": auto render invalid");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setDefaultBranch
     *
     * @param string $branch the name of a valid branch
     *
     * @return bool
     */
    public function setDefaultBranch($branch)
    {
        try {
            if (CheckInput::checkNewInput($branch)) {
                $this->defaultBranch = $branch;
            } else {
                throw new ExceptionHandler(__METHOD__ . ":invalid branch");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }


    /** setDefaultController
     *
     * @param string $controller the name of a valid controller
     *
     * @return bool
     */
    public function setDefaultController($controller)
    {
        try {
            if (CheckInput::checkNewInput($controller)) {
                $this->defaultController = $controller;
            } else {
                throw new ExceptionHandler(__METHOD__ . ":invalid controller");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setDefaultAction
     *
     * @param string $action a valid action for the controller
     *
     * @return bool
     */
    public function setDefaultAction($action)
    {
        try {
            if (CheckInput::checkNewInput($action)) {
                $this->defaultAction = $action;
            } else {
                throw new ExceptionHandler(__METHOD__ . ":invalid action");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }


    /** initURL
     *
     * @param string $url a URL
     *
     * @return bool
     */
    protected function initURL($url)
    {
        try {
            $this->url = URL::instance($url);
            if ($this->url->execute()) {
                $this->scheme = $this->url->getSchemeFromProtocol();
                $this->host = $this->url->getHost();
                $this->path = $this->url->getPath();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": initURL failed.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** initParameters
     *
     * @param string $path the path variable extracted from the URL
     *
     * @return bool
     */
    protected function initParameters($path)
    {
        try {
            if (CheckInput::checkNewInput($path)) {
                $this->parameters = Parameter::instance($path);
                if (!$this->parameters->execute()) {
                    throw new ExceptionHandler(__METHOD__ . ": execution failed.");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": invalid path.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** extractParameters
     *
     * @return bool
     */
    protected function extractParameters()
    {
        try {
            if (CheckInput::checkSet($this->parameters)) {
                $this->extractBranch();
                $this->extractController();
                $this->extractAction();
                $this->extractDataVariables();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": parameters not set.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** extractBranch
     *
     * @return bool
     */
    protected function extractBranch()
    {
        try {
            if ($this->parameters->getPathCount() >= 1) {
                $this->branch = $this->parameters->getSpecificVariable("branch");
            } else {
                $this->branch = $this->defaultBranch;
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** extractController
     *
     * @return bool
     */
    protected function extractController()
    {
        try {
            if ($this->parameters->getPathCount() >= 2) {
                $this->controllerName = $this->parameters->getSpecificVariable("controller");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** extractAction
     *
     * @return bool
     */
    protected function extractAction()
    {
        try {
            if ($this->parameters->getPathCount() >= 3) {
                $this->action = $this->parameters->getSpecificVariable("action");
            } else {
                $this->action = $this->defaultAction;
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** extractDataVariables
     *
     * @return bool
     */
    protected function extractDataVariables()
    {
        try {
            if ($this->parameters->getPathCount() > 3) {
                $this->dataPackage->setPayload($this->parameters->getDataVariables());
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**  setClassName
     *
     * @param string $className the name of the class to use
     *
     * @return boolean
     */
    public function setClassName($className)
    {
        try {
            if (CheckInput::checkNewInput($className)) {
                $this->className = $className;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": className is not valid");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getClassName
     *
     * @return string
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**  setDeviceType
     *
     * @param mixed $deviceType a string, such as "desktop", "mobile", or "default"
     *
     * @return boolean
     */
    public function setDeviceType($deviceType)
    {
        try {
            if (CheckInput::checkNewInput($deviceType)) {
                $this->deviceType = $deviceType;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": deviceType is not valid");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getDeviceType
     *
     * @return string
     */
    public function getDeviceType()
    {
        return $this->deviceType;
    }

    /** checkDeviceMobile
     *
     * @return bool
     */
    protected function checkDeviceMobile()
    {
        if ($this->deviceType === "Mobile") {
            return true;
        }
        return false;
    }

    /** checkDeviceDesktop
     *
     * @return bool
     */
    protected function checkDeviceDesktop()
    {
        if ($this->deviceType === "Desktop") {
            return true;
        }
        return false;
    }


    /**  setRenderMethod
     *
     * @param string $renderMethod a string such as "html","json", or "xml"
     *
     * @return boolean
     */
    public function setRenderMethod($renderMethod)
    {
        try {
            if (CheckInput::checkNewInput($renderMethod)) {
                $this->renderMethod = $renderMethod;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": renderMethod invalid");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getRenderMethod
     *
     * @return string
     */
    public function getRenderMethod()
    {
        return $this->renderMethod;
    }

    /**  setViewType
     *
     * @param string $viewType a string such as "browse", "form", or "partial"
     *
     * @return boolean
     */
    public function setViewType($viewType)
    {
        try {
            if (CheckInput::checkNewInput($viewType)) {
                $this->viewType = $viewType;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": viewType invalid");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getViewType
     *
     * @return string
     */
    public function getViewType()
    {
        return $this->viewType;
    }

    /** setControllerName
     *
     * @param string $controllerName the name of the controller
     *
     * @return bool
     */
    public function setControllerName($controllerName)
    {
        try {
            if (CheckInput::checkNewInput($controllerName)) {
                $this->controllerName = $controllerName;
            } else {
                throw new ExceptionHandler(__METHOD__ . "Type a message.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setAction
     *
     * @param string $action the specific action to perform
     *
     * @return bool
     */
    public function setAction($action)
    {
        try {
            if (CheckInput::checkNewInput($action)) {
                if ($this->checkActionAcceptable($action)) {
                    $this->action = $action;
                } else {
                    throw new ExceptionHandler(__METHOD__ . ": illegal action.");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": action is not setup.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkActionAcceptable
     *
     * @param string $action the specific action to perform
     *
     * @return bool
     */
    protected function checkActionAcceptable($action)
    {
        try {
            if (CheckInput::checkNewInput($action)) {
                if (!method_exists($this->controller, $action)) {
                    throw new ExceptionHandler(__METHOD__ . ": unknown action.");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": action not set.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** cascadeController
     *
     * @param array $locations an array of locations to look for the controller
     *
     * @return bool
     */
    public function cascadeController(array $locations)
    {
        try {
            $this->checkController();
            if (CheckInput::checkNewInputArray($locations)) {
                foreach ($locations as $location) {
                    if (file_exists($location . strtolower($this->controllerName) . ".php")) {
                        include_once "$location" . strtolower("$this->controllerName") . '.php';
                        return true;
                    }
                }
                throw new ExceptionHandler(__METHOD__ . ": all locations invalid.");
            } else {
                throw new ExceptionHandler(__METHOD__ . ": location must be given.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
    }

    /** cascadeView
     *
     * @param array $locations an array of locations to look for the views
     *
     * @return bool
     */
    abstract public function cascadeView(array $locations);

    /** initController
     *
     * @param object $databaseConnection a database connection
     *
     * @return bool
     */
    public function initController($databaseConnection)
    {
        try {
            if (isset($databaseConnection)) {
                if ($this->checkController()) {
                    $this->controller
                        = new $this->controllerName
                        . 'Controller(' . $databaseConnection . ')';
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": dbc invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkController
     *
     * @return bool
     */
    protected function checkController()
    {
        try {
            if (CheckInput::checkSet($this->controllerName)) {
            } elseif (CheckInput::checkSet($this->defaultController)) {
                $this->controllerName = $this->defaultController;
            } else {
                throw new ExceptionHandler(__METHOD__ . "no controller available.");
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
        // TODO: check production, log or show error
        try {
            if ($this->checkHandleAction()) {
                $this->controller->handleAction();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": action failed.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkHandleAction
     *
     * @return bool
     */
    protected function checkHandleAction()
    {
        try {
            if (!method_exists($this->controller, 'handleAction')) {
                throw new ExceptionHandler(__METHOD__ . ": handleAction unknown.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** handleAction
     *
     * @return void
     */
    public function handleAction()
    {
        if ($this->requestMethod === "GET") {
            $this->onGet();
        } elseif ($this->requestMethod === "POST") {
            $this->onPost();
        } elseif ($this->requestMethod === "PUT") {
            $this->onPut();
        } else {
            $this->checkMalicious();
        }
    }

    /** sendErrors
     *
     * @return mixed
     */
    public function sendErrors()
    {

    }

    /** onGet
     *
     * @return void
     */
    protected function onGet()
    {
        $this->controller->receive();
        if ($this->controller->checkListMode()) {
            $this->controller->browse();
        } elseif ($this->controller->checkObjectId()) {
            $this->controller->get($this->controller->getObjectId());
        }
    }

    /** onPost
     *
     * @return void
     */
    protected function onPost()
    {
        $this->controller->receive();
        if ($this->controller->checkEditMode()) {
            $this->controller->update();
        } else {
            $this->controller->insert();
        }
    }

    /** checkUpdate
     *
     * @return void
     */
    protected function checkUpdate()
    {
        if ($this->controller->checkEditMode()) {
            if ($this->controller->checkObjectId()) {
                $this->controller->update();
            } else {
                $this->controller->insert();
            }
        }
    }

    /** onPut
     *
     * @return void
     */
    protected function onPut()
    {
        if ($this->setPutFile(file_get_contents("php://input"))) {
            $this->controller->receive();
            $this->controller->insert();
        }
    }

    /** onDelete
     *
     * @return void
     */
    protected function onDelete()
    {
        /*
         * This has been intentionally left blank
         */
    }

    /** onHead
     *
     * @return void
     */
    protected function onHead()
    {
        /*
         * This has been intentionally left blank
         */
    }

    /** checkMalicious
     *
     * @return void
     */
    public function checkMalicious()
    {
        if (!in_array($this->requestMethod, array("POST", "GET", "PUT"))) {
            $this->onMalicious();
        }
    }

    /** onMalicious
     *
     * @return void
     */
    protected function onMalicious()
    {
        $this->log = Log::instance(print_r($this));
        $this->log->setLogType("Malicious");
        $this->log->execute();
        redirect_invalid_user(null, "www.sadtrombone.com/?play=true");
    }
} 