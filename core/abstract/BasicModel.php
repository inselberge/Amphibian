<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/9/13
 * Time: 11:01 AM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once "BasicInteraction.php";
require_once "interfaces".DIRECTORY_SEPARATOR."BasicModelInterface.php";
/**
 * Class BasicModel
 *
 * @category Core
 * @package  Model
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/BasicModel
 */
abstract class BasicModel
    extends BasicInteraction
    implements BasicModelInterface
{
    /**
     * @var array acceptableKeys the values that are accessible
     */
    protected $acceptableKeys;
    /**
     * @var object query a databaseQuery object
     */
    protected $query;
    /**
     * @var array filters the filters to apply to the model
     */
    protected $filters = array();
    /**
     * @var array validators the validators to apply to the model
     */
    protected $validators = array();
    /**
     * @var array sanitizers the sanitizers to apply to the model
     */
    protected $sanitizers = array();
    /**
     * @var object BasicModel a singleton instance of this class
     */
    public static $BasicModel;


    /** prepQuery
     *
     * @return bool
     */
    abstract protected function prepQuery();

    /** get
     *
     * @param integer $id the primary key id
     *
     * @return boolean
     */
    abstract public function get( $id );

    /** insert
     *
     * @return boolean
     */
    abstract public function insert();

    /** getInsertId
     *
     * @return integer
     */
    abstract public function getInsertId();

    /** update
     *
     * @return boolean
     */
    abstract public function update();

    /** validate
     *
     * @param integer $id the primary key id
     *
     * @return boolean
     */
    abstract public function validate( $id );

    /** patch
     *
     * @param string $key the specific element to update
     *
     * @return boolean
     */
    abstract public function patch( $key );

    /** delete
     *
     * @return boolean
     */
    abstract public function delete();

    /** index
     *
     * @return boolean
     */
    abstract public function index();

    /** checkValue
     *
     * @param string  $type  the type in the database
     * @param integer $max   the max length
     * @param mixed   $value the value attempted to set
     *
     * @return boolean
     */
    abstract public function checkValue( $type, $max, $value );

    /** setValue
     *
     * @param string $key   the index attempted to set
     * @param mixed  $value the value attempted to set
     *
     * @return boolean
     */
    abstract public function setValue( $key, $value );

    /** checkRequired
     *
     * @return boolean
     */
    abstract protected function checkRequired();

    /** setFilter
     *
     * @param string $key    the index attempted to set
     * @param object $filter a filter object
     *
     * @return bool
     */
    public function setFilter( $key, $filter )
    {
        try {
            if ( CheckInput::checkNewInputArray($filter) ) {
                if ( $this->checkKey($key) ) {
                    $this->filters[$key] = $filter;
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . "The filter must be set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setValidator
     *
     * @param string $key       the index attempted to set
     * @param object $validator a validator object
     *
     * @return bool
     */
    public function setValidator( $key, $validator )
    {
        try {
            if ( CheckInput::checkNewInput($validator) ) {
                if ( $this->checkKey($key) ) {
                    $this->validators[$key] = $validator;
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": validator invalid.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setSanitizer
     *
     * @param string $key       the index attempted to set
     * @param object $sanitizer a sanitizer object
     *
     * @return bool
     */
    public function setSanitizer( $key, $sanitizer )
    {
        try {
            if ( CheckInput::checkNewInput($sanitizer) ) {
                if ( $this->checkKey($key) ) {
                    $this->sanitizers[$key] = $sanitizer;
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": sanitizer invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkKey
     *
     * @param string $key the index attempted to set
     *
     * @return bool
     */
    protected function checkKey( $key )
    {
        try {
            if ( !CheckInput::checkNewInput($key) ) {
                throw new ExceptionHandler(__METHOD__ . "The key must be set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** prewash
     *
     * @return bool
     */
    protected function prewash()
    {
        try {
            $this->prewashFilters();
            $this->prewashSanitizers();
            $this->prewashValidators();
            if ( !empty($this->errors) ) {
                throw new ExceptionHandler(__METHOD__ . ": Prewash failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** prewashFilters
     *
     * @return void
     */
    protected function prewashFilters()
    {
        if ( !empty($this->filters) ) {
            foreach ( $this->filters as $key => $filter ) {
                if ( !$filter->execute() ) {
                    $this->errors[] = "failed to filter $key";
                }
            }
        }
    }

    /** prewashSanitizers
     *
     * @return void
     */
    protected function prewashSanitizers()
    {
        if ( !empty($this->sanitizers) ) {
            foreach ( $this->sanitizers as $key => $sanitizer ) {
                if ( !$sanitizer->execute() ) {
                    $this->errors[] = "failed to sanitize $key";
                }
            }
        }
    }

    /** prewashValidators
     *
     * @return void
     */
    protected function prewashValidators()
    {
        if ( !empty($this->validators) ) {
            foreach ( $this->validators as $key => $validator ) {
                if ( !$validator->execute() ) {
                    $this->errors[] = "failed to validate $key";
                }
            }
        }
    }

    /** setValuesFromRow
     *
     * @return bool
     */
    public function setValuesFromRow()
    {
        try {
            if ( CheckInput::checkSetArray($this->query->row) ) {
                $this->extract();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": setValuesFromRow failed");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** extract
     *
     * @return bool
     */
    public function extract()
    {
        try {
            foreach ( $this->query->row as $key => $value ) {
                if ( !$this->setValue($key, $value) ) {
//                    throw new ExceptionHandler(__METHOD__ . ": $key=>$value failed");
                }
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** extractPayload
     *
     * @return bool
     */
    public function extractPayload()
    {
        try {
            if ( $this->checkAcceptableKeys() ) {
                foreach ( $this->acceptableKeys as $key ) {
                    if ( $this->dataPackage->checkKeyInArray("payload", $key) ) {
                        if ( !$this->setValue($key, $this->dataPackage->getSpecificPayload($key)) ) {
                            $this->errors[$key] = "could not extract from the payload";
                        }
                    }
                }
            } else {
                throw new ExceptionHandler(__METHOD__.": acceptableKeys invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkAcceptableKeys
     *
     * @return bool
     */
    protected function checkAcceptableKeys()
    {
        if ( CheckInput::checkSetArray($this->acceptableKeys) ) {
            return true;
        } else {
            return false;
        }
    }

    /** getAcceptableKeys
     *
     * @return array
     */
    public function getAcceptableKeys()
    {
        return $this->acceptableKeys;
    }
}