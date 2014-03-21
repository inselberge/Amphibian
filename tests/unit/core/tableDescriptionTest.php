<?php
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-06-07 at 17:49:48.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR.".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
include_once AMPHIBIAN_DATABASE."AffCell.mysql.config.inc.php";
include_once AMPHIBIAN_CONFIG."mysql.cfg.php";
require_once AMPHIBIAN_CORE . "TableDescription.php";
require_once __DIR__ . DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."baseTest.php";
/**
 * Class TableDescriptionTest
 *
 * @category Test
 * @package  Core
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/TableDescriptionTest
 */
class TableDescriptionTest
    extends BaseTest
{
    /**
     * @var resource dbc holds values for $tableDescriptionTest->dbc
     */
    protected $databaseConnection;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        global $databaseConnection;
        $this->dbc = $databaseConnection;
        $this->object = TableDescription::instance($this->dbc);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers TableDescription::instance

     */
    public function testInstance()
    {
        $this->assertEquals($this->object,TableDescription::instance($this->dbc));
    }

    /**
     * @covers TableDescription::setTableName
     *
     */
    public function testSetTableName()
    {
        $this->assertEquals(true, $this->object->setTableName("Users"));
    }

    /** testExecute
     *
     * @covers TableDescription::execute
     *
     */
    public function testExecute()
    {
        $this->object->setTableName("Users");
        $this->assertEquals(true, $this->object->execute());
    }

    public function testGetUniqueKeys()
    {
        $this->expected = array("email"=>"varchar(100)");
        $this->assertEquals($this->expected, $this->object->getUniqueKeys());
    }
    public function testGetTypeFrequencyArray()
    {
        $this->expected = array(            
            "int(10) unsigned" => 2,
            "varchar(100)" => 2,
            "enum('member','brand_member','administrator')" => 1,
            "varchar(128)" => 1,
            "varchar(32)" => 2,
            "varchar(64)" => 1,
            "timestamp" => 2,
            "enum('pending','enabled','disabled','retired')" => 1
        );
        $this->assertEquals($this->expected, $this->object->getTypeFrequencyArray());
    }
    public function testGetPrimaryKeys()
    {
        $this->expected = array("user_id"=>"int(10) unsigned");
        $this->assertEquals($this->expected, $this->object->getPrimaryKeys());
    }
    public function testGetNotNullArray()
    {
        $this->expected = array(
            "user_id" => "int(10) unsigned",
            "email" => "varchar(100)",
            "user_type" => "enum('member','brand_member','administrator')",
            "password" => "varchar(128)",
            "salt" => "varchar(32)",
            "first_name" => "varchar(32)",
            "last_name" => "varchar(64)",
            "create_date" => "timestamp",
            "status" => "enum('pending','enabled','disabled','retired')"
        );
        $this->assertEquals($this->expected, $this->object->getNotNullArray());
    }
    public function testGetIndexKeys()
    {
        $this->expected = null;
        $this->assertEquals($this->expected, $this->object->getIndexKeys());
    }
    public function testGetForeignKeys()
    {
        $this->expected = array(
            array(                    
                    "localField" => "modify_user",
                    "foreignTable" => "Users",
                    "foreignField" => "user_id"
            )
        );
        $this->assertEquals($this->expected, $this->object->getForeignKeys());
    }
    public function testGetFieldTypeArray()
    {
        $this->expected = array(
            "user_id" => "int(10) unsigned",
            "email" => "varchar(100)",
            "user_type" => "enum('member','brand_member','administrator')",
            "password" => "varchar(128)",
            "salt" => "varchar(32)",
            "first_name" => "varchar(32)",
            "last_name" => "varchar(64)",
            "create_date" => "timestamp",
            "status" => "enum('pending','enabled','disabled','retired')",
            "modify_date" => "timestamp",
            "modify_user" => "int(10) unsigned",
            "modify_reason" => "varchar(100)"
        );
        $this->assertEquals($this->expected, $this->object->getFieldTypeArray());
    }
    public function testGetAutoIncrementField()
    {
        $this->expected = "user_id";
        $this->assertEquals($this->expected, $this->object->getAutoIncrementField());
    }

    public function testGetTableArray()
    {
        $this->expected = array(
            "user_id" => array( "type" => "int(10) unsigned", "nullAllowed" => "NO", "key" => "PRI", "foreignTable" => "", "foreignField" => "", "defaultValue" => "", "extra" => "auto_increment" ),
            "email" => array( "type" => "varchar(100)", "nullAllowed" => "NO", "key" => "UNI", "foreignTable" => "", "foreignField" => "", "defaultValue" => "", "extra" => "" ),
            "user_type" => array( "type" => "enum('member','brand_member','administrator')", "nullAllowed" => "NO", "key" => "", "foreignTable" => "", "foreignField" => "", "defaultValue" => "", "extra" => "" ),
            "password" => array( "type" => "varchar(128)", "nullAllowed" => "NO", "key" => "", "foreignTable" => "", "foreignField" => "", "defaultValue" => "", "extra" => "" ),
            "salt" => array( "type" => "varchar(32)", "nullAllowed" => "NO", "key" => "", "foreignTable" => "", "foreignField" => "", "defaultValue" => "", "extra" => "" ),
            "first_name" => array( "type" => "varchar(32)", "nullAllowed" => "NO", "key" => "", "foreignTable" => "", "foreignField" => "", "defaultValue" => "", "extra" => "" ),
            "last_name" => array( "type" => "varchar(64)", "nullAllowed" => "NO", "key" => "", "foreignTable" => "", "foreignField" => "", "defaultValue" => "", "extra" => "" ),
            "create_date" => array( "type" => "timestamp", "nullAllowed" => "NO", "key" => "", "foreignTable" => "", "foreignField" => "", "defaultValue" => "CURRENT_TIMESTAMP", "extra" => "" ),
            "status" => array( "type" => "enum('pending','enabled','disabled','retired')", "nullAllowed" => "NO", "key" => "", "foreignTable" => "", "foreignField" => "", "defaultValue" => "", "extra" => "" ),
            "modify_date" => array( "type" => "timestamp", "nullAllowed" => "YES", "key" => "", "foreignTable" => "", "foreignField" => "", "defaultValue" => "0000-00-00 00:00:00", "extra" => "" ),
            "modify_user" => array( "type" => "int(10) unsigned", "nullAllowed" => "YES", "key" => "MUL", "foreignTable" => "Users", "foreignField" => "user_id", "defaultValue" => "", "extra" => "" ),
            "modify_reason" => array( "type" => "varchar(100)", "nullAllowed" => "YES", "key" => "", "foreignTable" => "", "foreignField" => "", "defaultValue" => "", "extra" => "" )
        );
        $this->assertEquals($this->expected, $this->object->getTableArray());
    }
    public function testGetColumns()
    {
        $this->expected = array("user_id","email","user_type","password","salt","first_name","last_name","create_date","status","modify_date","modify_user","modify_reason");
        $this->assertEquals($this->expected, $this->object->getColumns());
    }
}
