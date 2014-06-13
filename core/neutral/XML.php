<?php
/**
 * PHP version 5.4.17
 * Created by JetBrains PhpStorm.
 * User: carl
 * Date: 8/6/13
 * Time: 11:39 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once "interfaces".DIRECTORY_SEPARATOR."XMLInterface.php";
require_once "CheckInput.php";
require_once "FileHandle.php";
/**
 * Class XML
 *
 * @category Helper
 * @package  Core
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/XML
 * 
 */
class XML
    implements XMLInterface
{

    /**
     * @var string charset the character set to use
     */
    protected $charset;
    /**
     * @var float version the XML version to use
     */
    protected $version;
    /**
     * @var string tableName the name of the table
     */
    protected $tableName;
    /**
     * @var array tableColumns the column names
     */
    protected $tableColumns;
    /**
     * @var array dataArray the raw data from the database
     */
    protected $dataArray;
    /**
     * @var resource FileHandle a file to write the XML contents
     */
    protected $FileHandle;
    /**
     * @var string buffer a buffer to fill before either printing or saving
     */
    protected $buffer;
    /**
     * @var object writer a XMLWriter object
     */
    protected $writer;
    /**
     * @var object reader a XMLReader object
     */
    protected $reader;
    /**
     * @var bool readOrWrite false = read, true = write
     */
    protected $readOrWrite;
    /**
     * @var object XML a singleton instance of this class
     */
    static public $XML;

    /** __construct
     *
     */
    protected function __construct()
    {
        $this->readOrWrite = false;
    }

    /** instance
     *
     * @return XML
     */
    static public function instance()
    {
        if ( !isset(self::$XML) ) {
            self::$XML = new XML();
        }
        return self::$XML;
    }

    /** factory
     *
     * @return XML
     */
    static public function factory()
    {
        return new XML();
    }

    /**  setReadOrWrite
     *
     * @param boolean $readOrWrite false = read, true = write
     *
     * @return boolean
     */
    public function setReadOrWrite( $readOrWrite )
    {
        try {
            if ( CheckInput::checkNewInput($readOrWrite) ) {
                $this->readOrWrite = $readOrWrite;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": readOrWrite is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getReadOrWrite
     *
     * @return boolean
     */
    public function getReadOrWrite()
    {
        return $this->readOrWrite;
    }

    /**  setFileHandle
     *
     * @param resource $FileHandle
     *
     * @return boolean
     */
    public function setFileHandle( $FileHandle )
    {
        try {
            if ( CheckInput::checkNewInput($FileHandle) ) {
                $this->FileHandle = $FileHandle;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": FileHandle is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getFileHandle
     *
     * @return resource
     */
    public function getFileHandle()
    {
        return $this->FileHandle;
    }

    /**  setCharset
     *
     * @param string $charset
     *
     * @return boolean
     */
    public function setCharset( $charset )
    {
        try {
            if ( CheckInput::checkNewInput($charset) ) {
                $this->charset = $charset;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": charset is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getCharset
     *
     * @return string
     */
    public function getCharset()
    {
        return $this->charset;
    }

    /**  setDataArray
     *
     * @param array $dataArray
     *
     * @return boolean
     */
    public function setDataArray( $dataArray )
    {
        try {
            if ( CheckInput::checkNewInput($dataArray) ) {
                $this->dataArray = $dataArray;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": dataArray is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getDataArray
     *
     * @return array
     */
    public function getDataArray()
    {
        return $this->dataArray;
    }

    /**  setTableColumns
     *
     * @param array $tableColumns
     *
     * @return boolean
     */
    public function setTableColumns( $tableColumns )
    {
        try {
            if ( CheckInput::checkNewInput($tableColumns) ) {
                $this->tableColumns = $tableColumns;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": tableColumns is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**  setTableName
     *
     * @param string $tableName
     *
     * @return boolean
     */
    public function setTableName( $tableName )
    {
        try {
            if ( CheckInput::checkNewInput($tableName) ) {
                $this->tableName = $tableName;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": tableName is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getBuffer
     *
     * @return string
     */
    public function getBuffer()
    {
        return $this->buffer;
    }

    /**  setVersion
     *
     * @param float $version
     *
     * @return boolean
     */
    public function setVersion( $version )
    {
        try {
            if ( CheckInput::checkNewInput($version) ) {
                $this->version = $version;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": version is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getVersion
     *
     * @return float
     */
    public function getVersion()
    {
        return $this->version;
    }

    /** execute
     *
     * @return bool
     */
    public function execute()
    {

    }

    /** setupHeader
     *
     * @return void
     */
    protected function setupHeader()
    {
        header("content-type: text/xml charset=utf-8");
    }

    /** initWrite
     *
     * @return bool
     */
    protected function initWrite()
    {
        try {
            $this->writer = new XMLWriter();
            if ( CheckInput::checkSet($this->writer) ) {
                $this->writer->openMemory();
                $this->writer->setIndent(true);
                $this->writer->startDocument('1.0', 'UTF-8');
            } else {
                throw new ExceptionHandler(__METHOD__ . "Type a message.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** startWrite
     *
     * @return bool
     */
    protected function startWrite()
    {
        try {
            if ( CheckInput::checkSet($this->writer) ) {
                $this->writer->startElement('callback');
                $this->writer->writeAttribute('xmlns:xsi','http://www.w3.org/2001/XMLSchema-instance');
                $this->writer->writeAttribute('xsi:noNamespaceSchemaLocation','schema.xsd');
            } else {
                throw new ExceptionHandler(__METHOD__ . ": writer not set");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** write
     *
     * @param mixed $data the dataArray
     *
     * @return bool
     */
    public function write($data)
    {
        try {
            if ( CheckInput::checkNewInput($data) ) {
                foreach ( $data as $key=>$value ) {
                    if ( is_array($value) ) {
                        $this->writer->startElement($key);
                        $this->write($value);
                        $this->writer->endElement();
                    }
                    $this->writer->writeElement($key, $value);
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": data not set");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** endWrite
     *
     * @return bool
     */
    protected function endWrite()
    {
        try {
            if ( CheckInput::checkSet($this->writer) ) {
                $this->writer->endElement();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": writer not set");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** printXML
     *
     * @return bool
     */
    public function printXML()
    {
        try {
            if ( CheckInput::checkSet($this->writer) ) {
                echo $this->writer->outputMemory(true);
            } else {
                throw new ExceptionHandler(__METHOD__ . ":invalid XMLWriter");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** initRead
     *
     * @return bool
     */
    protected function initRead()
    {
        try {
            $this->reader = new XMLReader();
            if ( CheckInput::checkSet($this->reader) ) {
            } else {
                throw new ExceptionHandler(__METHOD__ . ":initRead failed");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    protected function startRead()
    {

    }

    public function read()
    {

    }

    protected function endRead()
    {

    }
    /** getColumns
     *
     * @return void
     */
    protected function getColumns()
    {
        $this->tableColumns = array_keys($this->dataArray);
    }

    /** iterate
     *
     * @return void
     */
    protected function iterate()
    {
    
    }

    /** startXML
     *
     * @return void
     */
    protected function startXML()
    {
        $this->buffer.='<?xml version="1.0" charset="utf-8">'.PHP_EOL;
    }

    /** startDataSet
     *
     * @return void
     */
    protected function startDataSet()
    {
        $this->buffer.='    <dataset>'.PHP_EOL;
    }

    /** startTable
     *
     * @return void
     */
    protected function startTable()
    {
        $this->buffer.='        <table name="'.$this->tableName.'">'.PHP_EOL;
    }

    /** addColumn
     * @param $value
     *
     * @return void
     */
    protected function addColumn($value)
    {
        $this->buffer .= '            <column>'.$value.'</column>'.PHP_EOL;
    }

    /** startRow
     *
     * @return void
     */
    protected function startRow()
    {
        $this->buffer.='            <row>'.PHP_EOL;
    }

    /** addValue
     *
     * @param $value
     *
     * @return void
     */
    protected function addValue($value)
    {
        if ( $this->check($value) ) {
            $this->buffer .= '                <value>'.$value.'</value>'.PHP_EOL;
        } else {
            $this->buffer .= '                <null/>'.PHP_EOL;
        }
    }

    /** endRow
     *
     * @return void
     */
    protected function endRow()
    {
        $this->buffer.='            </row>'.PHP_EOL;
    }

    /** endTable
     *
     * @return void
     */
    protected function endTable()
    {
        $this->buffer.='        </table>'.PHP_EOL;
    }

    /** endDataSet
     *
     * @return void
     */
    protected function endDataSet()
    {
        $this->buffer.='    </dataset>'.PHP_EOL;
    }

    /** check
     *
     * @param $key
     *
     * @return bool
     */
    public function check($key)
    {
        if ( isset($this->$key) ) {
            if ( !is_null($this->$key) ) {
                return true;
            } else {
                return false;
            }            
        } else {
            return false;
        }
    }

    /** show
     *
     * @return void
     */
    public function show()
    {
        echo $this->buffer;
    }
}