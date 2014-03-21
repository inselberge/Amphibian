<?php
/**
 * PHP Version: ${PHP_VERSION}
 * Created by PhpStorm.
 * User: carl
 * Date: 1/27/14
 * Time: 11:21 AM
 */
require_once "BasicInteraction.php";
require_once "interfaces".DIRECTORY_SEPARATOR."DropDownInterface.php";
/**
 * Class DropDown
 *
 * @category DropDown
 * @package  DropDown
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/DropDown
 */
abstract class DropDown
    extends BasicInteraction
    implements DropDownInterface 
{
    /**
     * @var object query a database specific query object
     */
    protected $query;
    /**
     * @var string id holds values for $DropDown->id
     */
    protected $id;
    /**
     * @var string class holds values for $DropDown->class
     */
    protected $class;
    /**
     * @var string labelClass holds values for $DropDown->labelClass
     */
    protected $labelClass;
    /**
     * @var string name holds values for $DropDown->name
     */
    protected $name;
    /**
     * @var string selectLabel holds values for $DropDown->selectLabel
     */
    protected $selectLabel;
    /**
     * @var boolean required holds values for $DropDown->required
     */
    protected $required;
    /**
     * @var string valueField holds values for $DropDown->valueField
     */
    protected $valueField;
    /**
     * @var array labelFields holds values for $DropDown->labelFields
     */
    protected $labelFields;
    /**
     * @var array separatorFields holds values for $DropDown->separatorFields
     */
    protected $separatorFields;
    /**
     * @var integer labelFieldsCount holds values for $DropDown->labelFieldsCount
     */
    protected $labelFieldsCount;
    /**
     * @var string html holds values for $DropDown->html
     */
    protected $html;
    /**
     * @var object DropDown holds a singleton instance of this class
     */
    static public $DropDown;

    /** setClass
     *
     * @param string $class the class of the html object
     *
     * @return bool
     */
    public function setClass($class)
    {
        try {
            if (CheckInput::checkNewInput($class)) {
                $this->class = $class;
            } else {
                throw new ExceptionHandler(__METHOD__ . ":class is not valid");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getHTML
     *
     * @return string
     */
    public function getHTML()
    {
        return $this->html;
    }

    /** setId
     *
     * @param string $id a string for the html object id
     *
     * @return bool
     */
    public function setId($id)
    {
        try {
            if (CheckInput::checkNewInput($id)) {
                $this->id = $id;
            } else {
                throw new ExceptionHandler(__METHOD__ . ":id is not valid");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**  setRequired
     *
     * @param boolean $required true = required, false = not required
     *
     * @return boolean
     */
    public function setRequired($required)
    {
        try {
            if (CheckInput::checkNewInput($required)) {
                $this->required = $required;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": required is not valid");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**  setLabelClass
     *
     * @param string $labelClass a string containing class elements
     *
     * @return boolean
     */
    public function setLabelClass($labelClass)
    {
        try {
            if (CheckInput::checkNewInput($labelClass)) {
                $this->labelClass = $labelClass;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": labelClass is not valid");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setLabelFields
     *
     * @param array $labelFields an array of just the field names in the label
     *
     * @return bool
     */
    public function setLabelFields($labelFields)
    {
        try {
            if (CheckInput::checkNewInputArray($labelFields)) {
                $this->labelFields = $labelFields;
                $this->labelFieldsCount = count($this->labelFields);
            } else {
                throw new ExceptionHandler(__METHOD__ . ":labelFields is not valid");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setName
     *
     * @param string $name the name of the drop down
     *
     * @return bool
     */
    public function setName($name)
    {
        try {
            if (CheckInput::checkNewInput($name)) {
                $this->name = $name;
            } else {
                throw new ExceptionHandler(__METHOD__ . ":name is not valid");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setSelectLabel
     *
     * @param string $selectLabel the label to use for the select
     *
     * @return bool
     */
    public function setSelectLabel($selectLabel)
    {
        try {
            if (CheckInput::checkNewInput($selectLabel)) {
                $this->selectLabel = $selectLabel;
            } else {
                throw new ExceptionHandler(__METHOD__ . ":selectLabel is not valid");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getQuery
     *
     * @return databaseQueryMySQLi
     */
    public function getQuery()
    {
        return $this->query;
    }

    /** setValueField
     *
     * @param string $valueField a default value to use
     *
     * @return bool
     */
    public function setValueField($valueField)
    {
        try {
            if (CheckInput::checkNewInput($valueField)) {
                $this->valueField = $valueField;
            } else {
                throw new ExceptionHandler(__METHOD__ . ":valueField is not valid");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getValueField
     *
     * @return string
     */
    public function getValueField()
    {
        return $this->valueField;
    }

    /** setSeparatorFields
     *
     * @param array $separatorFields an array of field name => separator
     *
     * @return bool
     */
    public function setSeparatorFields($separatorFields)
    {
        try {
            if (CheckInput::checkNewInputArray($separatorFields)) {
                $this->separatorFields = $separatorFields;
            } else {
                throw new ExceptionHandler(__METHOD__ . ":separatorFields invalid");
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
            if ($this->query->getNumberOfRows() > 0) {
                $this->addSelectLabel();
                $this->startSelect();
                while ($this->query->getRow()) {
                    $this->iterate();
                }
                $this->endSelect();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": execute failed.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** addSelectLabel
     *
     * @return bool
     */
    protected function addSelectLabel()
    {
        try {
            if (isset($this->labelClass)) {
                $this->html = '<label class="'
                    . $this->labelClass
                    . '" for="'
                    . $this->id
                    . '"><strong>';
            } else {
                $this->html = '<label for="' . $this->id . '"><strong>';
            }

            if (isset($this->selectLabel)) {
                $this->html .= $this->selectLabel;
            } else {
                $this->html .= $this->id;
            }
            if (isset($this->required) AND $this->required == true) {
                $this->html .= "</strong> <span class='red'>*</span></label>\n";
            } else {
                $this->html .= "</strong></label>\n";
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** startSelect
     *
     * @return bool
     */
    protected function startSelect()
    {
        try {
            if (isset($this->html)) {
                $this->html .= "<select ";
            } else {
                $this->html = "<select ";
            }
            if (isset($this->id)) {
                $this->html .= 'id="' . $this->id . '" ';
            }
            if (isset($this->class)) {
                $this->html .= 'class="' . $this->class . '" ';
            }
            if (isset($this->name)) {
                $this->html .= 'name="' . $this->name . '" ';
            }
            $this->html .= ">\n<option disabled selected>Pick One</option>\n";
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** iterate
     *
     * @return void
     */
    protected function iterate()
    {
        $this->startOption();
        $this->addValueField();
        $this->addLabel();
        $this->endOption();
    }

    /** startOption
     *
     * @return void
     */
    protected function startOption()
    {
        $this->html .= "\t" . '<option ';
    }

    /** addValueField
     *
     * @return void
     */
    protected function addValueField()
    {
        $this->html .= 'value="' . $this->query->row[$this->valueField] . '">';
    }

    /** addLabel
     *
     * @return void
     */
    protected function addLabel()
    {
        for ($i = 0; $i < $this->labelFieldsCount; $i++) {
            if ($i == 0) {
                $this->html .= $this->query->row[$this->labelFields[$i]];
            } else {
                if (isset($this->separatorFields[$this->labelFields[$i]])) {
                    $this->html .= $this->separatorFields[$this->labelFields[$i]]
                        . $this->query->row[$this->labelFields[$i]];
                } else {
                    $this->html .= ' ' . $this->query->row[$this->labelFields[$i]];
                }
            }
        }
    }

    /** endOption
     *
     * @return void
     */
    protected function endOption()
    {
        $this->html .= "</option>\n";
    }

    /** endSelect
     *
     * @return void
     */
    protected function endSelect()
    {
        $this->html .= "</select>";
    }

    /** showHTML
     *
     * @return void
     */
    public function showHTML()
    {
        echo $this->html;
    }
} 