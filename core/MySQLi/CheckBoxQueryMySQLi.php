<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 6/22/13
 * Time: 2:41 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once AMPHIBIAN_CORE_MYSQLI ."DropDownMySQLi.php";
require_once AMPHIBIAN_CORE_NEUTRAL ."checkBoxGroup.php";
require_once "interfaces".DIRECTORY_SEPARATOR."CheckBoxQueryMySQLiInterface.php";
/**
 * Class CheckBoxQueryMySQLi
 *
 * @category Helper
 * @package  Core
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/CheckBoxQueryMySQLi
 */
class CheckBoxQueryMySQLi
    extends DropDownMySQLi
    implements CheckBoxQueryMySQLiInterface
{
    /**
     * @var object checkBox a checkBox object to use in generation
     */
    protected $checkBox;
    /**
     * @var array checkBoxInputArray the array of values to use
     */
    protected $checkBoxInputArray;
    /**
     * @var string idField the HTML id value
     */
    protected $idField;
    /**
     * @var object CheckBoxQueryMySQLi a singleton instance of this class
     */
    static public $CheckBoxQueryMySQLi;

    /** __construct
     *
     * @param resource $databaseConnection a valid database connection
     */
    protected function __construct($databaseConnection )
    {
        parent::__construct($databaseConnection);
    }

    /** instance
     *
     * @param resource $databaseConnection a valid database connection
     *
     * @return CheckBoxQueryMySQLi|object
     */
    static public function instance($databaseConnection)
    {
        if(!isset(self::$CheckBoxQueryMySQLi)) {
            self::$CheckBoxQueryMySQLi = new CheckBoxQueryMySQLi($databaseConnection);
        }
        return self::$CheckBoxQueryMySQLi;
    }

    /** factory
     *
     * @param resource $databaseConnection a valid database connection
     *
     * @return CheckBoxQueryMySQLi
     */
    static public function factory($databaseConnection)
    {
        return new CheckBoxQueryMySQLi($databaseConnection);
    }
    /** setIdField
     *
     * @param string $idField the value for the HTML id
     *
     * @return bool
     */
    public function setIdField( $idField )
    {
        try {
            if ( CheckInput::checkNewInput($idField) ) {
                $this->idField = $idField;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": idField is not valid");
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
            if ( $this->query->getNumberOfRows() > 0 ) {
                while ( $this->query->getRow() ) {
                    $this->iterate();
                }
                $this->makeCheckBoxGroup();
            } else {
                throw new ExceptionHandler(__METHOD__ . ":Type a message.");
            }
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
        $this->formatCheckBoxInputArray();
    }

    /** formatCheckBoxInputArray
     *
     * @return void
     */
    protected function formatCheckBoxInputArray()
    {
        $this->html = "";
        $this->addLabel();
        $this->checkBoxInputArray[]
            = array( "id" => $this->query->row[$this->idField],
            "value" => $this->query->row[$this->valueField],
            "label" => $this->getHtml() );
    }

    /** makeCheckBoxGroup
     *
     * @return void
     */
    protected function makeCheckBoxGroup()
    {
        $this->checkBox = checkBoxGroup::instance(
            $this->checkBoxInputArray, $this->name
        );
        $this->checkBox->setMultipleBreak(3);
        $this->checkBox->setLegendLabel("All Actions");
        $this->checkBox->execute();
        $this->checkBox->printHTML();
    }
}
/* Example of how to use this
require_once AMPHIBIAN_DATABASE."Members.Geekdom.mysql.config.inc.php";
require_once AMPHIBIAN_CONFIG."mysql.cfg.php";
$cbq=new CheckBoxQueryMySQLi($databaseConnection);
$cbq->setName("checkBoxTest");
$cbq->setValueField("id");
$cbq->setIdField("coworking_space");
$cbq->setLabelFields(
    array("coworking_space","address1","address2","city","state","zip")
);
$cbq->setSeparatorFields(
    array("address1"=>" - ", "address2"=>", ","city" =>", ","state"=>", ")
);
$cbq->setQuery("SELECT * FROM viewLocationCoworking;");
$cbq->execute();
*/