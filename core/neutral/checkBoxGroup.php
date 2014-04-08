<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Carl "Tex" Morgan
 * Date: 4/22/13
 * Time: 10:04 AM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once "interfaces".DIRECTORY_SEPARATOR."checkBoxGroupInterface.php";
/**
 * Class checkBoxGroup
 *
 * @category Helper
 * @package  CheckBoxGroup
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/checkBoxGroup
 */
class checkBoxGroup
    implements checkBoxGroupInterface
{
    /**
     * @var string uppercaseWordsValue first letter capitalized string
     */    
    protected $uppercaseWordsValue;
    /**
     * @var string legendLabel holds values for $checkBoxGroup->legendLabel
     */
    protected $legendLabel;
    /**
     * @var string checkboxName holds values for $checkBoxGroup->checkboxName
     */
    protected $checkboxName;
    /**
     * @var int breakMultiple holds values for $checkBoxGroup->breakMultiple
     */
    protected $breakMultiple;
    /**
     * @var string safeId holds values for $checkBoxGroup->safeId
     */
    protected $safeId;
    /**
     * @var int horizontalOrVertical denotes direction
     */
    protected $horizontalOrVertical;
    /**
     * @var array checkboxValueArray array of values to use
     */
    protected $checkboxValueArray;
    /**
     * @var string html holds values for $checkBoxGroup->html
     */
    protected $html;
    /**
     * @var object checkBoxGroup a singleton instance of this class
     */
    static public $checkBoxGroup;

    /** __construct
     *
     * @param array  $checkboxArray an array of values to use
     * @param string $checkboxName  the name of the checkbox group
     */
    protected function __construct( $checkboxArray, $checkboxName )
    {
        $this->breakMultiple        = 3;
        $this->horizontalOrVertical = 1;
        $this->html                 = null;
        $this->checkboxValueArray   = $checkboxArray;
        $this->checkboxName         = $checkboxName;
    }

    /** instance
     *
     * @param array  $checkboxArray an array of values to use
     * @param string $checkboxName  the name of the checkbox group
     *
     * @return checkBoxGroup
     */
    static public function instance( $checkboxArray, $checkboxName )
    {
        if ( isset(self::$checkBoxGroup) ) {
        } else {
            self::$checkBoxGroup = new checkBoxGroup($checkboxArray, $checkboxName);
        }
        return self::$checkBoxGroup;
    }

    /** setMultipleBreak
     *
     * @param int $breakMultiple the number of elements
     *
     * @return bool
     */
    public function setMultipleBreak( $breakMultiple )
    {
        if ( isset($breakMultiple) AND !is_null($breakMultiple) ) {
            $this->breakMultiple = $breakMultiple;
        } else {
            return false;
        }
        return true;
    }

    /** setHorizontalOrVertical
     *
     * @param int $horizontalOrVertical is it horizontal or vertical
     *
     * @return bool
     */
    public function setHorizontalOrVertical( $horizontalOrVertical )
    {
        if ( isset($horizontalOrVertical) ) {
            if ( $horizontalOrVertical === 1 ) {
                $this->horizontalOrVertical = 1;
            } else {
                $this->horizontalOrVertical = 2;
            }
        } else {
            return false;
        }
        return true;
    }

    /** setLegendLabel
     *
     * @param string $name the legend label
     *
     * @return bool
     */
    public function setLegendLabel( $name )
    {
        if ( isset($name) AND !is_null($name) ) {
            $this->legendLabel = $name;
        } else {
            return false;
        }
        return true;
    }

    /** execute
     *
     * @return void
     */
    public function execute()
    {
        $this->startFieldSet();
        $this->buildCheckbox();
        $this->endCheckboxGroup();
        $this->endFieldSet();
    }

    /** checkMultipleBreak
     *
     * @param int $currentCount the current number of elements
     *
     * @return bool
     */
    protected function checkMultipleBreak( $currentCount )
    {
        if ( $currentCount % $this->breakMultiple === 0 ) {
            if ( $currentCount === 0 ) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    /** startFieldSet
     *
     * @return void
     */
    protected function startFieldSet()
    {
        $this->html .= '<fieldset>' . "\n";
    }

    /** buildCheckAllCheckbox
     *
     * @return void
     */
    protected function buildCheckAllCheckbox()
    {
        $this->html .= "\t" . '<legend><input type="checkbox" name="';
        $this->html .= $this->checkboxName . '"';
        $this->html .= ' id="'. $this->checkboxName .'" value="everything" />';
        $this->html .= $this->legendLabel . '</legend>' . "\n";
    }

    /** startCheckboxGroup
     *
     * @return void
     */
    protected function startCheckboxGroup()
    {
        if ( $this->horizontalOrVertical === 1 ) {
            $this->html .= "\t";
            $this->html .= '<div data-role="controlgroup" data-type="horizontal">';
            $this->html .=  "\n";
        } else {
            $this->html .= "\t";
            $this->html .= '<div data-role="controlgroup">';
            $this->html .=  "\n";
        }
    }

    /** buildCheckbox
     *
     * @return bool
     */
    protected function buildCheckbox()
    {
        if ( isset($this->checkboxValueArray) AND is_array($this->checkboxValueArray) ) {
            $index = 0;
            foreach ( $this->checkboxValueArray as $valueArray ) {
                if ( $index == 0 ) {
                    $this->buildCheckAllCheckbox();
                    $this->startCheckboxGroup();
                }

                if ( $this->checkMultipleBreak($index) ) {
                    $this->endCheckboxGroup();
                    $this->startCheckboxGroup();
                }

                $this->uppercaseWordsValue = ucwords($valueArray["id"]);
                $this->setSafeId($this->uppercaseWordsValue);
                $this->html .= "\t\t" . '<label for="' . $this->safeId . '">';

                if ( isset($valueArray["label"]) ) {
                    $this->html .= $valueArray["label"] . '</label>' . "\n";
                } else {
                    $this->html .= $this->uppercaseWordsValue . '</label>' . "\n";
                }

                $this->html .= "\t\t";
                $this->html .= '<input type="checkbox" name="';
                $this->html .= $this->checkboxName . '" ';
                $this->html .= 'id="' . $this->safeId . '" ';
                $this->html .= 'value="' . $valueArray["value"] . '"/>' . "\n";
                $index++;
            }
        } else {
            return false;
        }
        return true;
    }

    /** setSafeId
     *
     * @param string $originalID the original id value
     *
     * @return void
     */
    protected function setSafeId( $originalID )
    {
        $this->safeId = str_replace(' ', '_', $originalID);
    }

    /** endCheckboxGroup
     *
     * @return void
     */
    protected function endCheckboxGroup()
    {
        $this->html .= "\t" . '</div>' . "\n";
    }

    /** endFieldSet
     *
     * @return void
     */
    protected function endFieldSet()
    {
        $this->html .= '</fieldset>' . "\n";
    }

    /** printArray
     *
     * @return void
     */
    public function printArray()
    {
        print_r($this->checkboxValueArray);
    }

    /** printHTML
     *
     * @return void
     */
    public function printHTML()
    {
        echo $this->html;
    }
}
/* Example of how to use this
$_actionsList[] = array ("id"=>"Stored Procedures", "value"=>"1");
$_actionsList[]=array ("id"=>"Database Views", "value"=>"2");
$_actionsList[]=array ("id"=>"Models", "value"=>"3");
$_actionsList[]=array ("id"=>"Forms", "value"=>"4");
$_actionsList[]=array ("id"=>"User Interface", "value"=>"5");
$_actionsList[]=array ("id"=>"Browse", "value"=>"6");
$cby = checkBoxGroup::instance($_actionsList,"checkboxAction");
$cby->setMultipleBreak(3);
$cby->setLegendLabel("All Actions");
$cby->execute();
$cby->printHTML();
*/
/*
$_actionsList[] = array ("id"=>"Prospect", "value"=>"prospect");
$_actionsList[]=array ("id"=>"Community", "value"=>"community");
$_actionsList[]=array ("id"=>"Desk", "value"=>"desk");
$_actionsList[]=array ("id"=>"Mentor", "value"=>"mentor");
$_actionsList[]=array ("id"=>"Operations_Management", "value"=>"operations_management");
$_actionsList[]=array ("id"=>"Business_Management", "value"=>"business_management");
$_actionsList[]=array ("id"=>"Administrator", "value"=>"administrator");
$cby = checkBoxGroup::instance($_actionsList,"checkboxAction");
$cby->setMultipleBreak(1);
$cby->setLegendLabel("All Actions");
$cby->execute();
$cby->printHTML();
*/