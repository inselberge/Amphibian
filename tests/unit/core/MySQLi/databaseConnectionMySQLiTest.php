<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_CORE_MYSQLI . "databaseConnectionMySQLi.php";
/**
 * Class DatabaseConnectionMySQLiTest
 *
 * @category Test
 * @package  DatabaseConnectionMySQLi
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/DatabaseConnectionMySQLiTest
 *
 */
class DatabaseConnectionMySQLiTest
    extends BaseTest
{
    /** setUp
     *
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp()
    {
        $this->object = DatabaseConnectionMySQLi::instance();
    }

    /** testInstance
     *
     * @covers DatabaseConnectionMySQLi::instance
     *
     * @return void
     */
    public function testInstance()
    {

        $this->expected = $this->object;
        $this->actual = DatabaseConnectionMySQLi::instance();
        $this->assertEquals($this->expected, $this->actual);

    }

    /** testFactory
     *
     * @covers DatabaseConnectionMySQLi::factory
     *
     * @return void
     */
    public function testFactory()
    {

        $this->expected = $this->object;
        $this->actual = DatabaseConnectionMySQLi::factory();
        $this->assertEquals($this->expected, $this->actual);

    }

    /** testSet
     *
     * @param $key
     * @param $value
     * @param $expectedResult
     *
     * @covers DatabaseConnectionMySQLi::set
     *
     * @dataProvider setDataProvider
     *
     * @return void
     */
    public function testSet($key, $value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->set($key,$value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** setDataProvider
     *
     * @return array
     */
    public function setDataProvider()
    {
        return array(
            array("userName","root", true),
            array("serverName", "127.0.0.1", true),
            array("databaseName", "mysql", true),
            array("userPassword", '4u$t1nTX', true),
            array("databasePort", "3306", true)
        );
    }

    /** testSetSSL
     *
     * @param $keyPath
     * @param $certificatePath
     * @param $authorityPath
     * @param $pemPath
     * @param $cipher
     * @param $expectedResult
     *
     * @covers DatabaseConnectionMySQLi::setSSL
     *
     * @dataProvider setSSLDataProvider
     *
     * @return void
     */
    public function testSetSSL($keyPath, $certificatePath, $authorityPath, $pemPath, $cipher, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setSSL($keyPath, $certificatePath, $authorityPath, $pemPath, $cipher);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** setSSLDataProvider
     *
     * @return array
     */
    public function setSSLDataProvider()
    {
        return array(
            array(
                "/etc/mysql/client-key.pem",
                "/etc/mysql/client-cert.pem",
                "/etc/mysql/ca-cert.pem",
                "/etc/mysql/",
                'DHE-RSA-AES256-SHA',
                true
            )
        );
    }

    /** testInit
     *
     * @covers DatabaseConnectionMySQLi::init
     *
     * @return void
     */
    public function testInit()
    {
        $this->expected = true;
        $this->actual = $this->object->init();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetOptions
     *
     * @param $option
     * @param $value
     * @param $expectedResult
     *
     * @covers DatabaseConnectionMySQLi::setOptions
     *
     * @dataProvider setOptionsDataProvider
     *
     * @return void
     */
    public function testSetOptions($option, $value, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setOptions($option, $value);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** setOptionsDataProvider
     *
     * @return array
     */
    public function  setOptionsDataProvider()
    {
        return array(
            array(MYSQLI_OPT_CONNECT_TIMEOUT, 10, true),
            array(MYSQLI_SERVER_PUBLIC_KEY, "/etc/mysql/my.cnf", true),
            array(MYSQLI_OPT_LOCAL_INFILE, true, true),
            array(MYSQLI_OPT_LOCAL_INFILE, false, true),
            array(MYSQLI_INIT_COMMAND, "SELECT CURRENT_TIMESTAMP;",true),
            array(MYSQLI_READ_DEFAULT_GROUP, "mysql", true),
            array(MYSQLI_READ_DEFAULT_FILE, "/etc/mysql/my.cnf", true)
        );
    }

    /** testOpenConnection
     *
     * @covers DatabaseConnectionMySQLi::openConnection
     *
     * @return void
     */
    public function testOpenConnection()
    {
        $this->expected = true;
        $this->actual = $this->object->openConnection();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testOpenConnectionSSL
     *
     * @covers DatabaseConnectionMySQLi::openConnectionSSL
     *
     * @return void
     */
    public function testOpenConnectionSSL()
    {
        $this->markTestIncomplete("This needs to be uncommented once the handshaking is resolved");
        /*
        $this->expected = true;
        $this->actual = $this->object->openConnectionSSL();
        $this->assertEquals($this->expected, $this->actual);
        */
    }

    /** testPing
     *
     * @covers DatabaseConnectionMySQLi::ping
     *
     * @return void
     */
    public function testPing()
    {
        $this->expected = true;
        $this->actual = $this->object->ping();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testPrintError
     *
     * @covers DatabaseConnectionMySQLi::printError
     *
     * @return void
     */
    public function testPrintError()
    {
        $this->expected = null;
        $this->actual = $this->object->printError();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetCharacterSet
     *
     * @param $newCharacterSet
     * @param $expectedResult
     *
     * @covers DatabaseConnectionMySQLi::setCharacterSet
     *
     * @dataProvider charactersetDataProvider
     *
     * @return void
     */
    public function testSetCharacterSet($newCharacterSet, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->setCharacterSet($newCharacterSet);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** charactersetDataProvider
     *
     * @return array
     */
    public function charactersetDataProvider()
    {
        return array(
            array("latin1", true),
            array("binary",true),
            array("utf8",true)
        );
    }

    /** testPrintCharacterSet
     *
     * @covers DatabaseConnectionMySQLi::printCharacterSet
     *
     * @return void
     */
    public function testPrintCharacterSet()
    {
        $this->expected = true;
        $this->actual = $this->object->printCharacterSet();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testPrintHostInfo
     *
     * @covers DatabaseConnectionMySQLi::printHostInfo
     *
     * @return void
     */
    public function testPrintHostInfo()
    {
        $this->expected = true;
        $this->actual = $this->object->printHostInfo();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetTables
     *
     * @param $expectedResult
     *
     * @covers DatabaseConnectionMySQLi::getTables
     *
     * @dataProvider getTablesDataProvider
     *
     * @return void
     */
    public function testGetTables($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getTables();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** getTablesDataProvider
     *
     * @return array
     */
    public function getTablesDataProvider()
    {
        return array(
            array(array(
                'columns_priv',
                'db',
                'event',
                'func',
                'help_category',
                'help_keyword',
                'help_relation',
                'help_topic',
                'host',
                'ndb_binlog_index',
                'plugin',
                'proc',
                'procs_priv',
                'proxies_priv',
                'servers',
                'tables_priv',
                'time_zone',
                'time_zone_leap_second',
                'time_zone_name',
                'time_zone_transition',
                'time_zone_transition_type',
                'user'
            ))
        );
    }

    /** testGetPrimaryKeys
     *
     * @param $expectedResult
     *
     * @covers DatabaseConnectionMySQLi::getPrimaryKeys
     *
     * @dataProvider getPrimaryKeysDataProvider
     *
     * @return void
     */
    public function testGetPrimaryKeys($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getPrimaryKeys();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** getPrimaryKeysDataProvider
     * @return array
     */
    public function getPrimaryKeysDataProvider()
    {
        return array(
            array(
                array(
                    'columns_priv' => array('Host', 'Db', 'User', 'Table_name','Column_name'),
                    'db' => array('Host', 'Db','User'),
                    'event'=>array('db', 'name'),
                    'func'=> array('name'),
                    'help_category' => array( 'help_category_id'),
                    'help_keyword'=> array('help_keyword_id'),
                    'help_relation'=> array('help_keyword_id', 'help_topic_id'),
                    'help_topic' => array('help_topic_id'),
                    'host' => array('Host', 'Db'),
                    'ndb_binlog_index'=> array('epoch'),
                    'plugin' => array('name'),
                    'proc' => array('db', 'name', 'type'),
                    'procs_priv' => array('Host', 'Db', 'User', 'Routine_name', 'Routine_type'),
                    'proxies_priv' => array('Host', 'User', 'Proxied_host', 'Proxied_user'),
                    'servers' => array('Server_name'),
                    'tables_priv' => array('Host', 'Db', 'User', 'Table_name'),
                    'time_zone'=> array('Time_zone_id'),
                    'time_zone_leap_second'=> array('Transition_time'),
                    'time_zone_name'=> array('Name'),
                    'time_zone_transition' => array('Time_zone_id', 'Transition_time'),
                    'time_zone_transition_type' =>array('Time_zone_id', 'Transition_type_id'),
                    'user'=> array('Host', 'User')
                )
            )
        );
    }
    /** testGetViews
     *
     * @param $expectedResult
     *
     * @covers DatabaseConnectionMySQLi::getViews
     *
     * @dataProvider getViewsDataProvider
     *
     * @return void
     */
    public function testGetViews($expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getViews();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** getViewsDataProvider
     *
     * @return array
     */
    public function getViewsDataProvider()
    {
        //todo: use a database table that has views, mysql does not
        return array(
            array(false)
        );
    }

    /** testDescribeTable
     *
     * @param $table
     * @param $expectedResult
     *
     * @covers DatabaseConnectionMySQLi::describeTable
     *
     * @dataProvider describeTableDataProvider
     *
     * @return void
     */
    public function testDescribeTable($table, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->describeTable($table);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** describeTableDataProvider
     *
     * @return array
     */
    public function describeTableDataProvider()
    {
        return array(
            array("time_zone",
                array(
                    array("Field"=>'Time_zone_id', "Type"=>'int(10) unsigned', "Null"=>'NO', "Key"=>'PRI', "Default"=>NULL, "Extra"=>'auto_increment'),
                    array("Field" =>'Use_leap_seconds', "Type" =>'enum(\'Y\',\'N\')', "Null" =>'NO', "Key" =>'', "Default" =>'N', "Extra" =>'')
                )
            )
        );
    }


    /** testShowKeysTable
     *
     * @param $table
     * @param $expectedResult
     *
     * @covers DatabaseConnectionMySQLi::showKeysTable
     *
     * @dataProvider showKeysTableDataProvider
     *
     * @return void
     */
    public function testShowKeysTable($table, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->showKeysTable($table);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** showKeysTableDataProvider
     *
     * @return array
     */
    public function showKeysTableDataProvider()
    {
        return array(
            array(
                "time_zone",
                array(
                    array(
                        "Table" => "time_zone",
                        "Non_unique" => "0",
                        "Key_name" => "PRIMARY",
                        "Seq_in_index" => "1",
                        "Column_name" => "Time_zone_id",
                        "Collation" => "A",
                        "Cardinality" => "0",
                        "Sub_part" => "",
                        "Packed" => "" ,
                        "Null" => "",
                        "Index_type" => "BTREE",
                        "Comment" => "",
                        "Index_comment" => ""
                    )
                )
            )
        );
    }

    /** testGetPrimaryKeysTable
     *
     * @param $table
     * @param $expectedResult
     *
     * @covers DatabaseConnectionMySQLi::getPrimaryKeysTable
     *
     * @dataProvider getPrimaryKeysTableDataProvider
     *
     * @return void
     */
    public function testGetPrimaryKeysTable($table, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getPrimaryKeysTable($table);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** getPrimaryKeysTableDataProvider
     *
     * @return array
     */
    public function getPrimaryKeysTableDataProvider()
    {
        return array(
            array(
                "time_zone",
                array(
                    array("column_name"=>"Time_zone_id")
                )
            )
        );
    }

    /** testGetForeignKeysTable
     *
     * @param $table
     * @param $expectedResult
     *
     * @covers DatabaseConnectionMySQLi::getForeignKeysTable
     *
     * @dataProvider getForeignKeysTableDataProvider
     *
     * @return void
     */
    public function testGetForeignKeysTable($table, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getForeignKeysTable($table);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** getForeignKeysTableDataProvider
     *
     * @return array
     */
    public function getForeignKeysTableDataProvider()
    {
        //todo: add a test that has foreign keys
        return array(
            array(
                "db",
                false
            )
        );
    }

    /** testGetRequiredColumnsList
     *
     * @param $tableDescription
     * @param $expectedResult
     *
     * @covers DatabaseConnectionMySQLi::getRequiredColumnsList
     *
     * @dataProvider getRequiredColumnsListDataProvider
     *
     * @return void
     */
    public function testGetRequiredColumnsList($tableDescription, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getRequiredColumnsList($tableDescription);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** getRequiredColumnsListDataProvider
     *
     * @return array
     */
    public function getRequiredColumnsListDataProvider()
    {
        //todo: test with non-empty array
        return array(
            array(
                array(),
                false
            )
        );
    }

    /** testGetColumnList
     *
     * @param $table
     * @param $expectedResult
     *
     * @covers DatabaseConnectionMySQLi::getColumnList
     *
     * @dataProvider getColumnListDataProvider
     *
     * @return void
     */
    public function testGetColumnList($table, $expectedResult)
    {
        $this->expected = $expectedResult;
        $this->actual = $this->object->getColumnList($table);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** getColumnListDataProvider
     *
     * @return array
     */
    public function getColumnListDataProvider()
    {
        return array(
            array(
                "time_zone",
                array(
                    'Time_zone_id',
                    'Use_leap_seconds'
                )
            )
        );
    }

    /** testGetAllColumnTypes
     *
     * @param $expectedResult
     *
     * @covers DatabaseConnectionMySQLi::getAllColumnTypes
     *
     * @dataProvider columnsTypeDataProvider
     *
     * @return void
     */
    public function testGetAllColumnTypes($expectedResult)
    {

        $this->expected = $expectedResult;
        $this->actual = $this->object->getAllColumnTypes();
        $this->assertEquals($this->expected, $this->actual);

    }

    /** columnsTypeDataProvider
     *
     * @return array
     */
    public function columnsTypeDataProvider()
    {
        return array(
            array(
                array(
                    array("column_type"=>"char(60)"),
                    array("column_type" => "char(64)"),
                    array("column_type" => "char(16)"),
                    array("column_type" => "timestamp"),
                    array("column_type" => "set('Select','Insert','Update','References')"),
                    array("column_type" => "enum('N','Y')"),
                    array("column_type" => "longblob"),
                    array("column_type" => "char(77)"),
                    array("column_type" => ""),
                    array("column_type" => ""),
                    array("column_type" => ""),
                    array("column_type" => ""),
                    array("column_type" => ""),
                    array("column_type" => ""),
                    array("column_type" => ""),
                    array("column_type" => ""),
                    array("column_type" => ""),
                    array("column_type" => ""),
                    array("column_type" => ""),
                    array("column_type" => ""),
                    array("column_type" => ""),
                    array("column_type" => ""),
                    array("column_type" => ""),
                    array("column_type" => ""),
                    array("column_type" => ""),
                    array("column_type" => ""),
                    array("column_type" => ""),
                    array("column_type" => ""),
                    array("column_type" => ""),
                    array("column_type" => ""),
                    array("column_type" => ""),
                    array("column_type" => "blob"),
                    array("column_type" => "set('Execute','Alter Routine','Grant')"),
                    array("column_type" => "int(4)"),
                    array("column_type" => "time"),
                    array("column_type" => "varchar(512)"),
                    array("column_type" => "set('Select','Insert','Update','Delete','Create','Drop','Grant','References','Index','Alter','Create View','Show view','Trigger')"),
                    array("column_type" => "enum('Y','N')"),
                    array("column_type" => "bigint(20)"),
                    array("column_type" => "tinyint(3) unsigned"),
                    array("column_type" => "char(8)"),
                    array("column_type" => "char(41)"),
                    array("column_type" => "enum('','ANY','X509','SPECIFIED')"),
                    array("column_type" => "int(11) unsigned")
                )
            )
        );
    }

    /** testCloseConnection
     *
     * @covers DatabaseConnectionMySQLi::closeConnection
     *
     * @return void
     */
    public function testCloseConnection()
    {
        $this->expected = true;
        $this->actual = $this->object->closeConnection();
        $this->assertEquals($this->expected, $this->actual);
    }
}