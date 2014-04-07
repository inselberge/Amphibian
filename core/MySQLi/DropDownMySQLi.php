<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Carl "Tex" Morgan
 * Date: 4/22/13
 * Time: 11:53 AM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once AMPHIBIAN_CORE_ABSTRACT . "DropDown.php";
require_once AMPHIBIAN_CORE_MYSQLI . "databaseQueryMySQLi.php";
require_once "interfaces".DIRECTORY_SEPARATOR."DropDownMySQLiInterface.php";
/**
 * Class DropDownMySQLi
 *
 * @category DropDown
 * @package  DropDownMySQLi
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/DropDownMySQLi
 */
class DropDownMySQLi
    extends DropDown
    implements DropDownMySQLiInterface
{
    /** __construct
     *
     * @param resource $databaseConnection a valid database connection
     */
    protected function __construct($databaseConnection)
    {
        parent::__construct($databaseConnection);
        $this->query = databaseQueryMySQLi::instance($this->connection);
    }

    /** instance
     *
     * @param resource $databaseConnection a valid database connection
     *
     * @return DropDown|object
     */
    static public function instance($databaseConnection)
    {
        if ( !isset(self::$DropDown) ) {
            self::$DropDown = new DropDownMySQLi($databaseConnection);
        }
        return self::$DropDown;
    }


    /** factory
     *
     * @param resource $databaseConnection a valid database connection
     *
     * @return DropDown
     */
    static public function factory($databaseConnection)
    {
        return new DropDownMySQLi($databaseConnection);
    }


    /** setQuery
     *
     * @param string $query the database query to run
     *
     * @return bool
     */
    public function setQuery( $query )
    {
        try {
            if ( CheckInput::checkNewInput($query) ) {
                $this->query = databaseQueryMySQLi::instance($this->connection);
                if ( isset($this->query) ) {
                    $this->query->execute($query);
                } else {
                    throw new ExceptionHandler(__METHOD__.":query is not connected");
                }
            } else {
                throw new ExceptionHandler(__METHOD__.":query is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }


}
/* Example of how to use this
require_once AMPHIBIAN_DATABASE."Members.Geekdom.mysql.config.inc.php";
require_once AMPHIBIAN_CONFIG."mysql.cfg.php";
$dd=new DropDown($databaseConnection);
$dd->setId("testDropDown");
$dd->setName("testDropDown");
$dd->setValueField("id");
$dd->setLabelFields(array("coworking_space",
"address1",
"address2",
"city",
"state",
"zip"));
$dd->setSeparatorFields(array("address1"=>" - ",
"address2"=>", ",
"city" =>", ",
"state"=>", "));
$dd->setQuery("SELECT * FROM viewLocationCoworking;");
$dd->execute();
$dd->showHTML();
*/