<?php
/**
 * PHP version 5.4.17
 * Created by JetBrains PhpStorm.
 * User: Carl "Tex" Morgan
 * Date: 4/22/13
 * Time: 11:53 AM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once AMPHIBIAN_CORE_ABSTRACT . "BasicInteraction.php";
require_once AMPHIBIAN_CORE_NEUTRAL . "FileHandle.php";
require_once "interfaces".DIRECTORY_SEPARATOR."DataListInterface.php";
/**
 * Class DataList
 *
 * @category Helper
 * @package  Core
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/DataList
 */
abstract class DataList
    extends BasicInteraction
    implements DataListInterface
{
    /**
     * @var object query a database query
     */
    protected $query;
    /**
     * @var string the id of the datalist
     */
    protected $id;
    /**
     * @var string placeholder a string to use as a placeholder
     */
    protected $placeholder;
    /**
     * @var string title a string to use as the title
     */
    protected $title;
    /**
     * @var string class the classes of the datalist
     */
    protected $class;
    /**
     * @var string name the name of the datalist
     */
    protected $name;
    /**
     * @var string label the label for the datalist
     */
    protected $label;
    /**
     * @var string valueField the value of the datalist
     */
    protected $valueField;
    /**
     * @var array labelFields the individual labels
     */
    protected $labelFields;
    /**
     * @var array separatorFields the separators of the labels
     */
    protected $separatorFields;
    /**
     * @var integer labelFieldsCount the number of labels
     */
    protected $labelFieldsCount;
    /**
     * @var string html the HTML generated
     */
    protected $html;
    /**
     * @var object FileHandle where the HTML gets written to when done
     */
    protected $FileHandle;

    /** setClass
     *
     * @param string $class the class of the datalist
     *
     * @return bool
     */
    public function setClass( $class )
    {
        try {
            if ( CheckInput::checkNewInput($class) ) {
                $this->class = $class;
            } else {
                throw new ExceptionHandler(__METHOD__.":class is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getHtml
     *
     * @return string
     */
    public function getHtml()
    {
        return $this->html;
    }

    /** setId
     *
     * @param string $id the id of the datalist
     *
     * @return bool
     */
    public function setId( $id )
    {
        try {
            if ( CheckInput::checkNewInput($id) ) {
                $this->id = $id;
            } else {
                throw new ExceptionHandler(__METHOD__.": id is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**  setTitle
     *
     * @param string $title the title to use
     *
     * @return boolean
     */
    public function setTitle( $title )
    {
        try {
            if ( CheckInput::checkNewInput($title) ) {
                $this->title = $title;
            } else {
                throw new ExceptionHandler(__METHOD__ . ":title is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**  setPlaceholder
     *
     * @param string $placeholder the placeholder to use in HTML
     *
     * @return boolean
     */
    public function setPlaceholder( $placeholder )
    {
        try {
            if ( CheckInput::checkNewInput($placeholder) ) {
                $this->placeholder= $placeholder;
            } else {
                throw new ExceptionHandler(__METHOD__ . ":placeholder is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setLabelFields
     *
     * @param array $labelFields the individual labels
     *
     * @return bool
     */
    public function setLabelFields( $labelFields )
    {
        try {
            if ( CheckInput::checkNewInputArray($labelFields) ) {
                $this->labelFields = $labelFields;
                $this->labelFieldsCount=count($this->labelFields);
            } else {
                throw new ExceptionHandler(__METHOD__.":labelFields is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setName
     *
     * @param string $name the name of the datalist
     *
     * @return bool
     */
    public function setName( $name )
    {
        try {
            if ( CheckInput::checkNewInput($name) ) {
                $this->name = $name;
            } else {
                throw new ExceptionHandler(__METHOD__.":name is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setLabel
     *
     * @param string $label the label of the datalist
     *
     * @return bool
     */
    public function setLabel( $label )
    {
        try {
            if ( CheckInput::checkNewInput($label) ) {
                $this->label = $label;
            } else {
                throw new ExceptionHandler(__METHOD__.":label is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setQuery
     *
     * @param string $query the query string to run
     *
     * @return bool
     */
    abstract public function setQuery($query);

    /** getQuery
     *
     * @return string
     */
    public function getQuery()
    {
        return $this->query;
    }

    /** setValueField
     *
     * @param string $valueField the value of the datalist
     *
     * @return bool
     */
    public function setValueField( $valueField )
    {
        try {
            if ( CheckInput::checkNewInput($valueField) ) {
                $this->valueField = $valueField;
            } else {
                throw new ExceptionHandler(__METHOD__.":valueField is not valid");
            }
        } catch ( ExceptionHandler $e ) {
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
     * @param array $separatorFields the separators of the labels
     *
     * @return bool
     */
    public function setSeparatorFields( $separatorFields )
    {
        try {
            if ( CheckInput::checkNewInputArray($separatorFields) ) {
                $this->separatorFields = $separatorFields;
            } else {
                throw new ExceptionHandler(__METHOD__.": setSeparatorFields failed");
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
            if ($this->query->getNumberOfRows() > 0) {
                $this->addDatalistLabel();
                $this->addInput();
                $this->startDatalist();
                while ( $this->query->getRow() ) {
                    $this->iterate();
                }
                $this->endDatalist();
            } elseif ($this->query->getNumberOfRows() === 0) {
                echo "No data found.";
            } else {
                throw new ExceptionHandler(__METHOD__.":Type a message.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** addDatalistLabel
     *
     * @return bool
     */
    protected function addDatalistLabel()
    {
        try {
            $this->html='<label for="'.$this->id.'"><strong>';
            if (isset($this->label)) {
                $this->html.=$this->label;
            } else {
                $this->html.=$this->id;
            }
            $this->html.="</strong></label>\n";
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** addInput
     *
     * @return bool
     */
    protected function addInput()
    {
        try {
            if ( CheckInput::checkNewInput($this->id) ) {
                if ( isset($this->html) ) {
                    $this->html.='<input type="search" autocomplete="on" list="';
                } else {
                    $this->html='<input list="';
                }
                $this->html.=$this->id;
                $this->html.='" ';
                if (isset($this->title)) {
                    $this->html.='title="'.$this->title.'" ';
                } else {
                    $this->html.= 'title="begin typing to see the results for ';
                    $this->html.= $this->id.'" ';
                }
                if (isset($this->class)) {
                    $this->html.='class="'.$this->class.'" ';
                }
                if (isset($this->name)) {
                    $this->html.='name="'.$this->name.'" ';
                }
                if (isset($this->placeholder)) {
                    $this->html.='placeholder="'.$this->placeholder.'" ';
                }

                $this->html.='>'."\n";
            } else {
                throw new ExceptionHandler(__METHOD__ . "id must be set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** startDatalist
     *
     * @return bool
     */
    protected function startDatalist()
    {
        try {
            if ( isset($this->html) ) {
                $this->html.="<datalist ";
            } else {
                $this->html="<datalist ";
            }
            if (isset($this->id)) {
                    $this->html.='id="'.$this->id.'" ';
            }
            $this->html.=">\n";
        } catch ( ExceptionHandler $e ) {
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
        $this->addOption();
    }

    /** addOption
     *
     * @return void
     */
    protected function addOption()
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
        $this->html.="\t".'<option ';
    }

    /** addValueField
     *
     * @return void
     */
    protected function addValueField()
    {
        //$this->html.='value="'.$this->query->row[$this->valueField].'">';
        $this->html.='value="'.$this->query->row[$this->labelFields['0']].'">';
        $this->html.='<input type="hidden" name="';
        $this->html.= $this->name.'Hidden" value="';
        $this->html.= $this->query->row[$this->valueField].'"/>';
    }

    /** addLabel
     *
     * @return void
     */
    protected function addLabel()
    {
        for ( $i=0;$i<$this->labelFieldsCount;$i++) {
            if ( $i==0 ) {
                $this->html.= $this->query->row[$this->labelFields[$i]];
            } else {
                if ( isset($this->separatorFields[$this->labelFields[$i]]) ) {
                    $this->html.=$this->separatorFields[$this->labelFields[$i]];
                    $this->html.= $this->query->row[$this->labelFields[$i]];
                } else {
                    $this->html.=' '.$this->query->row[$this->labelFields[$i]];
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
        $this->html.="</option>\n";
    }

    /** endDatalist
     *
     * @return void
     */
    protected function endDatalist()
    {
        $this->html.="</datalist>";
    }

    /** showHTML
     *
     * @return void
     */
    public function showHTML()
    {
        echo $this->html;
    }

    /** write
     *
     * @param string $fileName the name of the file
     *
     * @return bool
     */
    public function write($fileName)
    {
        try {
            if ( CheckInput::checkNewInput($fileName) ) {
                $this->FileHandle = new FileHandle($fileName);
                $this->writeToHandle();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": write failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** writeToHandle
     *
     * @return bool
     */
    protected function writeToHandle()
    {
        try {
            if (CheckInput::checkNewInput($this->FileHandle) ) {
                $this->FileHandle->writeFull($this->html);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": writeToHandle failed");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

}