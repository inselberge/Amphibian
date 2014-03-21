<?php
/**
 * PHP Version: ${PHP_VERSION}
 * Created by PhpStorm.
 * User: carl
 * Date: 1/22/14
 * Time: 11:45 PM
 */
require_once AMPHIBIAN_CORE_ABSTRACT."DataList.php";
require_once "databaseQueryMySQLi.php";
require_once "interfaces".DIRECTORY_SEPARATOR."DataListMySQLiInterface.php";
/**
 * Class DataListMySQLi
 *
 * @category DataList
 * @package  DataListMySQLi
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
* @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/
 */
class DataListMySQLi
    extends DataList
    implements DataListMySQLiInterface
{
    /**
     * @var object DataListMySQLi a singleton instance of this class
     */
    static public $DataListMySQLi;

    /** __construct
     *
     * @param resource $databaseConnection a valid databaseConnection
     */
    protected function __construct($databaseConnection)
    {
        parent::__construct($databaseConnection);
    }

    /** instance
     *
     * @param resource $databaseConnection a valid databaseConnection
     *
     * @return DataListMySQLi
     */
    static public function instance($databaseConnection)
    {
        if ( !isset(self::$DataListMySQLi) ) {
            self::$DataListMySQLi = new DataListMySQLi($databaseConnection);
        }
        return self::$DataListMySQLi;
    }

    /** factory
     *
     * @param resource $databaseConnection a valid databaseConnection
     *
     * @return DataListMySQLi
     */
    static public function factory($databaseConnection)
    {
        return new DataListMySQLi($databaseConnection);
    }

    /** setQuery
     *
     * @param string $query the query string to run
     *
     * @return bool
     */
    public function setQuery($query)
    {
        try {
            if (CheckInput::checkNewInput($query)) {
                $this->query = databaseQueryMySQLi::instance($this->connection);
                if (isset($this->query)) {
                    $this->query->execute($query);
                } else {
                    throw new ExceptionHandler(__METHOD__ . ": not connected");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": query is not valid");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }
}
/* Example of how to use this
require_once AMPHIBIAN_CONFIG."Members.Geekdom.config.inc.php";
require_once AMPHIBIAN_DATABASE."Members.Geekdom.mysql.config.inc.php";
require_once AMPHIBIAN_CONFIG."mysql.cfg.php";

$tables = array(
"Circle","Company","Conference_Room","Coworking_Space",
"Event","Help","Job","Office","Question","Response"
);
$testArray=array("Circles","Company","Event","Help","Job","Question","Response");
foreach ($tables as $t) {
    $dd=new datalist($databaseConnection);
    $dd->setId($t."_DataList");
    $dd->setName($t."_DataList");
    $dd->setValueField("id");
    if(in_array($t,$testArray)){
        $dd->setLabelFields(array("title"));
        $dd->setQuery("SELECT id,title FROM `$t` WHERE status='enabled';");
        $dd->execute();
    } elseif (in_array($t,array("Conference_Room","Coworking_Space","Office"))){
        $dd->setLabelFields(array("name"));
        $dd->setQuery("SELECT id,name FROM `$t` WHERE status='enabled';");
        $dd->execute();
    }
    $dd->write(VIEWS_GENERATED_PARTIALS.$t."_DataList.html");
    unset($dd);
}
*/

/*
 * User

$dd=new datalist($databaseConnection);
$dd->setId("User_DataList");
$dd->setName("User_DataList");
$dd->setValueField("id");
$dd->setLabelFields(array("fullName","email"));
$dd->setSeparatorFields(array( "email"=>" - " ));
$dd->setQuery("SELECT `id`,`fullName`,`email` FROM `User` WHERE status='enabled';");
$dd->execute();
$dd->write(VIEWS_GENERATED_PARTIALS."User_DataList.html");
*/

/*
 * Tag
$dd=new datalist($databaseConnection);
$dd->setId("Tags_DataList");
$dd->setName("Tags_DataList");
$dd->setValueField("id");
$dd->setLabelFields(array("tag"));
$dd->setQuery("SELECT id,tag FROM `Tags` WHERE status='enabled';");
$dd->execute();
$dd->write(VIEWS_GENERATED_PARTIALS."Tags_DataList.html");
*/