<?php
/**
 * PHP Version: ${PHP_VERSION}
 * Created by PhpStorm.
 * User: carl
 * Date: 1/28/14
 * Time: 11:46 AM
 */
require_once "BasicInteraction.php";
require_once "interfaces".DIRECTORY_SEPARATOR."TableBuilderInterface.php";
/**
 * Class TableBuilder
 *
 * @category TableBuilder
 * @package  TableBuilder
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/TableBuilder
 */
abstract class TableBuilder
    extends BasicInteraction
    implements TableBuilderInterface
{
    //class variables
    /**
     * @var resource result a result set from a database query
     */
    public $result;
    /**
     * @var string id the id of the table
     */
    public $id;
    /**
     * @var array columnNames the names of each of the columns
     */
    protected $columnNames;
    /**
     * @var string tableHead the head of the table
     */
    protected $tableHead;
    /**
     * @var string tableBody the body of the table
     */
    protected $tableBody;
    /**
     * @var string tableFoot the foot of the table
     */
    protected $tableFoot;
    //options
    /**
     * @var integer limitResult a restriction on the number of results to display
     */
    public $limitResult;
    /**
     * @var string bgColor a color to use for the background
     */
    public $bgColor;
    /**
     * @var string textColor a color to use for the text
     */
    public $textColor;
    /**
     * @var string bgColorAlt a color to use for the alternate background
     */
    public $bgColorAlt;
    /**
     * @var string textColorAlt a color to use for the alternate text
     */
    public $textColorAlt;
    /**
     * @var integer width the width of the table
     */
    public $width;
    /**
     * @var integer height the height of the table
     */
    public $height;
    /**
     * @var bool checkBoxes true if you want to display checkboxes
     */
    public $checkBoxes;
    //internal variables
    /**
     * @var integer rowNumber the current row in the result set
     */
    protected $rowNumber;

    /** __construct
     *
     * @param object   $databaseConnection a valid database connection
     * @param resource $resultSet          a result set from a query
     * @param string   $id                 the id of the table
     */
    protected function __construct($databaseConnection = null, $resultSet = null, $id)
    {
        try {
            if (CheckInput::checkSet($id)) {
                if (CheckInput::checkSet($databaseConnection)) {
                    parent::__construct($databaseConnection);
                }
                if (CheckInput::checkSet($resultSet)) {
                    $this->result = $resultSet;
                }
                $this->id = $id;
                $this->setOptionDefault();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": id required.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
    }

    /** setOption
     *
     * @param string $key   the specific option to set
     * @param mixed  $value the value to use for the option
     *
     * @return bool
     */
    public function setOption($key, $value)
    {
        if (isset($key, $value) AND !is_null($key)) {
            switch ($key) {
                case 'limitResult':
                    if (is_int($value) === true) {
                        $this->limitResult = $value;
                    } else {
                        $this->limitResult = 25;
                    };
                    return true;
                    break;
                case 'bgColor':
                    if (is_string($value) === true) {
                        $this->bgColor = $value;
                    } else {
                        $this->bgColor = "white";
                    };
                    return true;
                    break;
                case 'textColor':
                    if (is_string($value) === true) {
                        $this->textColor = $value;
                    } else {
                        $this->textColor = "black";
                    };
                    return true;
                    break;
                case 'bgColorAlt':
                    if (is_string($value) === true) {
                        $this->bgColorAlt = $value;
                    } else {
                        $this->bgColorAlt = "gray";
                    };
                    return true;
                    break;
                case 'textColorAlt':
                    if (is_string($value) === true) {
                        $this->textColorAlt = $value;
                    } else {
                        $this->textColorAlt = "white";
                    };
                    return true;
                    break;
                case 'width':
                    if (is_int($value) AND ($value > 0)) {
                        $this->width = $value . "%";
                    } else {
                        $this->width = "100%";
                    };
                    return true;
                    break;
                case 'height':
                    if (is_int($value) AND ($value > 0)) {
                        $this->height = $value . "%";
                    } else {
                        $this->height = "100%";
                    };
                    return true;
                    break;
                case 'checkBoxes':
                    if ($value === true) {
                        $this->checkBoxes = $value;
                    } else {
                        $this->checkBoxes = false;
                    };
                    return true;
                    break;
                default:
                    return false;
                    break;
            }
        } else {
            //didn't pass in the required parameter
            //throw new Exception(utf8_encode(__CLASS__.'::'.__FUNCTION__.':Insufficent input.'));
            echo utf8_encode(__METHOD__ . ": FAILED due to insufficient input \n");
            return false;
        }
    }

    /** setOptionDefault
     *
     * @return void
     */
    protected function setOptionDefault()
    {
        $this->limitResult = 25;
        $this->bgColor = "white";
        $this->bgColorAlt = "gray";
        $this->textColor = "black";
        $this->textColorAlt = "white";
        $this->width = "100%";
        $this->height = "100%";
        $this->checkBoxes = false;
    }


    /** setColumnNames
     *
     * @param array $row a row from the result set
     *
     * @return void
     */
    protected function setColumnNames($row)
    {
        $finfo = array_keys($row);
        foreach ($finfo as $val) {
            $this->columnNames .= "\t\t\t";
            $this->columnNames .= '<th class="header">';
            $this->columnNames .= $val . '</th>' . "\n";
        }
        //echo $this->columnNames;
    }

    /** setHead
     *
     * @return void
     */
    protected function setHead()
    {
        $this->tableHead = "\t" . '<thead>' . "\n";
        $this->tableHead .= "\t\t" . '<tr>' . "\n";
        $this->tableHead .= $this->columnNames;
        $this->tableHead .= "\t\t" . '</tr>' . "\n";
        $this->tableHead .= "\t" . '</thead>' . "\n";
    }

    /** setFoot
     *
     * @return void
     */
    protected function setFoot()
    {
        $this->tableFoot = "\t" . '<tfoot>' . "\n";
        $this->tableFoot .= "\t\t" . '<tr>' . "\n";
        $this->tableFoot .= $this->columnNames;
        $this->tableFoot .= "\t\t" . '</tr>' . "\n";
        $this->tableFoot .= "\t" . '</tfoot>' . "\n";
    }

    /** printHead
     *
     * @return void
     */
    public function printHead()
    {
        echo $this->tableHead;
    }

    /** printBody
     *
     * @return void
     */
    public function printBody()
    {
        echo $this->tableBody;
    }

    /** printFoot
     *
     * @return void
     */
    public function printFoot()
    {
        echo $this->tableFoot;
    }

    /** printStartTable
     *
     * @return void
     */
    public function printStartTable()
    {
        echo '<p><a href="#" id="appendStart" data-input-type="append" class="ajax append">Add 25 rows of data </a> (can be clicked many times, more than a 1000 rows can be slow)</p>' . "\n";
        echo '<table id="' . $this->id . '" cellspacing="1" cellpadding="0" class="tablesorter shadow roundedSmall">' . "\n";
    }

    /** printEndTable
     *
     * @return void
     */
    static public function printEndTable()
    {
        echo '</table>' . "\n";
        echo '<p><a href="#" id="appendEnd" data-input-type="append" class="ajax append">Add 25 rows of data </a> (can be clicked many times, more than a 1000 rows can be slow)</p>' . "\n";
    }

    /** printStartBody
     *
     * @return void
     */
    static public function printStartBody()
    {
        echo "\t" . '<tbody>' . "\n";
    }

    /** printEndBody
     *
     * @return void
     */
    static public function printEndBody()
    {
        echo "\t" . '</tbody>' . "\n";
    }


    /** printRow
     *
     * @param array $row a row from the result set
     *
     * @return void
     */
    protected function printRow($row)
    {
        if (is_array($row)) {
            if (fmod($this->rowNumber, 2) == 0) {
                echo "\t\t" . '<tr class="even" bgcolor="' . $this->bgColor . '">' . "\n";
            } else {
                echo "\t\t" . '<tr class="odd" bgcolor="' . $this->bgColorAlt . '">' . "\n";
            }
            foreach ($row as $value) {
                echo "\t\t\t" . '<td>' . $value . '</td>' . "\n";
            }
            echo "\t\t" . '</tr>' . "\n";
        } else {
        }
    }

    /** printPager
     *
     * @return void
     */
    public function printPager()
    {
        echo '<div id="pager" class="pager">
	<form>
		<a class="first shadow"><<</a>
		<a class="prev shadow"><</a>
		<input type="text" class="pagedisplay shadow"/>
		<a class="next shadow">></a>
		<a class="last shadow">>></a>
		<select class="pagesize">
			<option selected="selected"  value="25">25</option>
			<option  value="50">50</option>
			<option  value="100">100</option>
		</select>
	</form>
</div>';
    }

    /** printScripts
     *
     * @return void
     */
    public function printScripts()
    {
        echo '
                    <script type="text/javascript" src="../js/jquery-latest.js"></script>
                    <script type="text/javascript" src="../js/jquery.tablesorter.js"></script>
                    <script type="text/javascript" src="../js/appendTableSorter.js"></script>
                    <script type="text/javascript" src="../js/jquery.tablesorter.pager.js"></script>
                    <script type="text/javascript" src="../js/docs.js"></script>
                    <script type="text/javascript" src="../js/repeatHeaders.js"></script>
                ';
    }

    /** printCSS
     *
     * @return void
     */
    public function printCSS()
    {
        echo '
                    <style type="text/css">@import "../css/jq.css";</style>
                    <style type="text/css">@import "../css/tableSorter.css";</style>
                ';
    }

    /** execute
     *
     * @return bool
     */
    abstract public function execute();
} 