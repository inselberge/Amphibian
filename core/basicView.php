<?php
/**
 * PHP version 5.4.9
 *
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/9/13
 * Time: 8:25 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once "interfaces".DIRECTORY_SEPARATOR."basicViewInterface.php";
require_once AMPHIBIAN_CORE_ABSTRACT."BasicInteraction.php";
/**
 * Class basicView
 * 
 * @category Core
 * @package  Core
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/basicView
 */
abstract class basicView
    extends BasicInteraction
    implements basicViewInterface
{
    /**
     * @var  string fileName holds value of $basicView->fileName (class.dev.render)
     */
    protected $fileName;
    /**
     * @var string fileLocation the file location
     */
    protected $fileLocation;
    /**
     * @var resource viewCustomBrowse the location of custom browse
     */
    protected $viewCustomBrowse;
    /**
     * @var resource viewCustomForm the location of custom forms
     */
    protected $viewCustomForm;
    /**
     * @var resource viewCustomPartials the location of custom partials
     */
    protected $viewCustomPartials;
    /**
     * @var resource viewGeneratedBrowse the location of generated browse
     */
    protected $viewGeneratedBrowse;
    /**
     * @var resource viewGeneratedForm holds value of $basicView->viewGeneratedForm
     */
    protected $viewGeneratedForm;
    /**
     * @var resource viewGenPartials the location of generated partials
     */
    protected $viewGenPartials;
    /**
     * @var array selectedValues holds values of ids to use
     */
    protected $selectedValues;
    /**
     * @var resource selectedView holds value of $basicView->selectedView
     */
    protected $selectedView;

    /** setViewCustomBrowse
     *
     * @param string $view stores the full file name
     *
     * @return bool
     */
    public function setViewCustomBrowse( $view )
    {
        try {
            if ( $this->checkViewExists($view) ) {
                $this->viewCustomBrowse=$view;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": existence check failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setViewCustomForm
     *
     * @param string $view stores the full file name
     *
     * @return bool
     */
    public function setViewCustomForm( $view )
    {
        try {
            if ( $this->checkViewExists($view) ) {
                $this->viewCustomForm=$view;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": existence check failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setViewCustomPartials
     *
     * @param string $view stores the full file name
     *
     * @return bool
     */
    public function setViewCustomPartials( $view )
    {
        try {
            if ( $this->checkViewExists($view) ) {
                $this->viewCustomPartials=$view;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": existence check failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkViewExists
     *
     * @param string $view complete file path containing the view
     *
     * @return bool
     */
    protected function checkViewExists($view)
    {
        try {
            if ( CheckInput::checkNewInput($view) ) {
                if ( !file_exists($view) ) {
                    throw new ExceptionHandler(__METHOD__ .": view existence fail.");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": view is not set.");
            }
        } catch ( ExceptionHandler $e ) {
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
            if ( CheckInput::checkNewInput($this->renderMethod) ) {
                $this->waterfall();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": renderMethod not set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** waterfall
     *
     * @return bool
     */
    protected function waterfall()
    {
        try {
            if ( $this->precheck() ) {
                $this->buildFileName();
                $this->forkWaterfall();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": Pre-check failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** pre-check
     *
     * @return bool
     */
    protected function precheck()
    {
        try {
            if ( CheckInput::checkNewInput($this->viewType) ) {
                if ( CheckInput::checkNewInput($this->renderMethod) ) {
                    if ( ! CheckInput::checkNewInput($this->className)) {
                        throw new ExceptionHandler(__METHOD__ ."className invalid.");
                    }
                } else {
                    throw new ExceptionHandler(__METHOD__ . "renderMethod invalid.");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": viewType invalid.");
            }
        } catch ( ExceptionHandler $e ) {
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
            $this->fileName = $this->className;
            if ( $this->checkDeviceMobile() || $this->checkDeviceDesktop() ) {
                $this->fileName .= '.'.$this->deviceType;
            }
            $this->fileName .= '.'.$this->renderMethod;
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** forkWaterfall
     *
     * @return bool
     */
    protected function forkWaterfall()
    {
        try {
            if ( $this->checkBrowse() ) {
                $this->waterfallBrowse();
            } elseif ( $this->checkForm() ) {
                $this->waterfallForm();
            } elseif ( $this->viewType === "Partial" ) {
                $this->waterfallPartials();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": Unknown waterfall path.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkBrowse
     *
     * @return bool
     */
    protected function checkBrowse()
    {
        if ( $this->viewType === "Browse" ) {
            return true;
        }
        return false;
    }

    /** waterfallBrowse
     *
     * @return bool
     */
    protected function waterfallBrowse()
    {
        try {
            if ( $this->checkCustomBrowse() ) {
                $this->fileLocation = $this->viewCustomBrowse;
            } elseif ( $this->checkGeneratedBrowse() ) {
                $this->fileLocation = $this->viewGeneratedBrowse;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": waterfallBrowse failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkCustomBrowse
     *
     * @return bool
     */
    protected function checkCustomBrowse()
    {
        if ( file_exists($this->viewCustomBrowse.$this->fileName) ) {
            return true;
        }
        return false;
    }

    /** checkGeneratedBrowse
     *
     * @return bool
     */
    protected function checkGeneratedBrowse()
    {
        if ( file_exists($this->viewGeneratedBrowse.$this->fileName) ) {
            return true;
        }
        return false;
    }

    /** checkForm
     *
     * @return bool
     */
    protected function checkForm()
    {
        if ( $this->viewType === "Form" ) {
            return true;
        }
        return false;
    }

    /** waterfallForm
     *
     * @return bool
     */
    protected function waterfallForm()
    {
        try {
            if ( $this->checkCustomForm() ) {
                $this->fileLocation = $this->viewCustomForm;
            } elseif ( $this->checkGeneratedForm() ) {
                $this->fileLocation = $this->viewGeneratedForm;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": Unknown device setting.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkCustomForm
     *
     * @return bool
     */
    protected function checkCustomForm()
    {
        if ( file_exists($this->viewCustomForm.$this->fileName) ) {
            return true;
        }
        return false;
    }

    /** checkGeneratedForm
     *
     * @return bool
     */
    protected function checkGeneratedForm()
    {
        if ( file_exists($this->viewGeneratedForm.$this->fileName) ) {
            return true;
        }
        return false;
    }

    /** checkPartial
     *
     * @return bool
     */
    protected function checkPartial()
    {
        if ( $this->viewType === "Partial" ) {
            return true;
        }
        return false;
    }

    /** waterfallPartials
     *
     * @return bool
     */
    protected function waterfallPartials()
    {
        try {
            if ( $this->checkCustomPartials() ) {
                $this->fileLocation = $this->viewCustomPartials;
            } elseif ( $this->checkGeneratedPartials() ) {
                $this->fileLocation = $this->viewGenPartials;
            } else {
                throw new ExceptionHandler(__METHOD__ .":waterfallPartials failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkCustomPartials
     *
     * @return bool
     */
    protected function checkCustomPartials()
    {
        if ( file_exists($this->viewCustomPartials.$this->fileName) ) {
            return true;
        }
        return false;
    }

    /** checkGeneratedPartials
     *
     * @return bool
     */
    protected function checkGeneratedPartials()
    {
        if ( file_exists($this->viewGenPartials.$this->fileName) ) {
            return true;
        }
        return false;
    }

    /** setViewGeneratedBrowse
     *
     * @param resource $pathToGenBrowse the path to the generated browse files
     *
     * @return bool
     */
    public function setViewGeneratedBrowse( $pathToGenBrowse )
    {
        try {
            if ( CheckInput::checkNewInput($pathToGenBrowse) ) {
                $this->viewGeneratedBrowse = $pathToGenBrowse;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": pathToGenBrowse invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setViewGeneratedForm
     *
     * @param resource $pathToGenForm the path to the generated form files
     *
     * @return bool
     */
    public function setViewGeneratedForm( $pathToGenForm )
    {
        try {
            if ( CheckInput::checkNewInput($pathToGenForm) ) {
                $this->viewGeneratedForm = $pathToGenForm;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": pathToGenForm invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setViewGeneratedPartials
     *
     * @param resource $pathToGenPartials the path to the generated partial files
     *
     * @return bool
     */
    public function setViewGeneratedPartials( $pathToGenPartials )
    {
        try {
            if ( CheckInput::checkNewInput($pathToGenPartials) ) {
                $this->viewGenPartials = $pathToGenPartials;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": pathToGenPartials invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setSelectedView
     *
     * @return bool
     */
    protected function setSelectedView()
    {
        try {
            if ( CheckInput::checkNewInput($this->fileLocation) ) {
                $this->selectedView = $this->fileLocation.$this->fileName;
            } else {
                throw new ExceptionHandler(__METHOD__ . "fileLocation invalid.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**  setSelectedValues
     *
     * @param array $selectedValues holds list of specific ids you want, i.e. email
     *
     * @return boolean
     */
    public function setSelectedValues( $selectedValues )
    {
        try {
            if ( CheckInput::checkNewInputArray($selectedValues) ) {
                $this->selectedValues = array_merge($this->selectedValues, $selectedValues);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": selectedValues invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getSelectedValues
     *
     * @return mixed
     */
    public function getSelectedValues()
    {
        return $this->selectedValues;
    }

    /** render
     *
     * @return bool
     */
    public function render()
    {
        try {
            if ( CheckInput::checkNewInput($this->selectedView) ) {
                include_once "$this->selectedView";
            } else {
                throw new ExceptionHandler(__METHOD__ . "Render method is not set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** renderPartial
     *
     * @return void
     */
    public function renderPartial()
    {
        $this->render();
    }
}
/*
 * The views themselves will have access to specific ids in the payload
 * via $this->dataPackage->getSpecificPayload($id), so no need to copy them.
 * For errors, the call is $this->dataPackage->getSpecificError($id).
 */