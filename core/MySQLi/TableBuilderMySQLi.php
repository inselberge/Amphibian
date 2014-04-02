<?php
/*
ToDo:
    pass the dynamic query type to JavaScript
    Implement AJAX append using PHP and previously specified dynamic query
    file:///home/carl/Public/AffCell/includes/jquery-tablesorter/docs/example-widgets.html
Required: 
    a valid initial result set, database connection, id for the table
css:
    //Original
	<style type="text/css">@import "../docs/css/jq.css";</style>
	<style type="text/css">@import "../themes/blue/style.css";</style>
    //Moved to:
	<style type="text/css">@import "../css/jq.css";</style>
	<style type="text/css">@import "../css/tableSorter.css";</style>

js:
    //Original
	<script type="text/javascript" src="../jquery-latest.js"></script>
	<script type="text/javascript" src="../jquery.tablesorter.js"></script>
    <script type="text/javascript" src=".js/appendTableSorter.js"></script>
	<script type="text/javascript" src="../addons/pager/jquery.tablesorter.pager.js"></script>
	<script type="text/javascript" src="js/chili/chili-1.8b.js"></script>
	<script type="text/javascript" src="js/docs.js"></script>
    //Moved to:
	<script type="text/javascript" src="../js/jquery-latest.js"></script>
	<script type="text/javascript" src="../js/jquery.tablesorter.js"></script>
    <script type="text/javascript" src="../js/appendTableSorter.js"></script>
	<script type="text/javascript" src="../js/jquery.tablesorter.pager.js"></script>
	//Doesn't seem to exist: <script type="text/javascript" src="js/chili/chili-1.8b.js"></script>
	<script type="text/javascript" src="../js/docs.js"></script>
    <script type="text/javascript" src="../js/repeatHeaders.js"></script>
*/
require_once AMPHIBIAN_CORE_ABSTRACT."TableBuilder.php";
require_once "interfaces".DIRECTORY_SEPARATOR."TableBuilderMySQLiInterface.php";
/**
 * Class TableBuilderMySQLi
 *
 * @category Helper
 * @package  Core
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/TableBuilderMySQLi
 */
class TableBuilderMySQLi
    extends TableBuilder
    implements TableBuilderMySQLiInterface
{
    /**
     * @var object TableBuilderMySQLi an instance of this class
     */
    static public $TableBuilderMySQLi;

    /** __construct
     *
     * @param object   $databaseConnection a valid database connection
     * @param resource $resultSet          a result set from a query
     * @param string   $id                 the id of the table
     */
    protected function __construct( $databaseConnection = null, $resultSet = null ,$id )
    {
        try {
            if (CheckInput::checkSet($id)) {
                parent::__construct($databaseConnection, $resultSet, $id);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": id required!");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
    }

    /** instance
     *
     * @param object   $databaseConnection a valid database connection
     * @param resource $resultSet          a result set from a query
     * @param string   $id                 the id of the table
     *
     * @return TableBuilderMySQLi
     */
    static public function instance($databaseConnection = null, $resultSet = null, $id)
    {
        if ( !isset(self::$TableBuilderMySQLi) ) {
            self::$TableBuilderMySQLi = new TableBuilderMySQLi($databaseConnection, $resultSet, $id);
        }
        return self::$TableBuilderMySQLi;
    }

    /** factory
     *
     * @param object   $databaseConnection a valid database connection
     * @param resource $resultSet          a result set from a query
     * @param string   $id                 the id of the table
     *
     * @return TableBuilderMySQLi
     */
    static public function factory($databaseConnection = null, $resultSet = null, $id)
    {
        return new TableBuilderMySQLi($databaseConnection,$resultSet, $id);
    }

    /** execute
     *
     * @return bool
     */
    public function execute()
    {
        //todo: refactor this to use database objects
        $this->printStartTable();
        $this->rowNumber = 0;
        $row      = mysqli_fetch_assoc($this->result);
        while ( $row ) {
            if ( $this->rowNumber == 0 ) {
                $this->setColumnNames($row);
                $this->setHead();
                $this->setFoot();
                $this->printHead();
                $this->printStartBody();
            }
            $this->printRow($row);
            $this->rowNumber++;
            $row = mysqli_fetch_assoc($this->result);
        }
        $this->printEndBody();
        $this->printFoot();
        $this->printEndTable();
        //$this->printPager();
    }

    /** executeFromPayload
     *
     * @param string $idValue the id of the table
     * @param array  $payload the payload of DataPackage
     *
     * @return void
     */
    static public function executeFromPayload($idValue,array $payload)
    {
        self::$TableBuilderMySQLi = new TableBuilderMySQLi(null, null, $idValue);
        self::$TableBuilderMySQLi->printStartTable();
        self::$TableBuilderMySQLi->rowNumber = 0;
        self::$TableBuilderMySQLi->setColumnNames($payload['0']);
        self::$TableBuilderMySQLi->setHead();
        self::$TableBuilderMySQLi->setFoot();
        self::$TableBuilderMySQLi->printHead();
        self::$TableBuilderMySQLi->printStartBody();
        foreach ($payload as $p) {
            self::$TableBuilderMySQLi->printRow($p);
            self::$TableBuilderMySQLi->rowNumber++;
        }
        self::$TableBuilderMySQLi->printEndBody();
        self::$TableBuilderMySQLi->printFoot();
        self::$TableBuilderMySQLi->printEndTable();
    }
}


//Set the database access information as constants:
/*
require "..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."config.inc.php";
//require_once MYSQL; todo: replace these with correct databaseConnectionMySQLi calls

$r=mysqli_query($databaseConnection,"SELECT * from Category");
$id="blargh";
try{
$tb = new TableBuilderMySQLi($databaseConnection,$r,$id);
$tb->printCSS();
$tb->printScripts();
$tb->execute();
}
catch (Exception $e){
		echo utf8_encode(date('Y-m-d H:i:s') . " " . __CLASS__ . "::" . __FUNCTION__ . ": ". $e);
}
*/
