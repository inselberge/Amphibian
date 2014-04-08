<?php

require_once __DIR__ . DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."config.inc.php";
require_once AMPHIBIAN_TESTS . "baseTest.php";
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
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-09-08 at 17:05:30.
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

    public function testInstance()
    {
        $this->expected = $this->object;
        $this->actual = DatabaseConnectionMySQLi::instance();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testAutocommit
     *
     * @covers mysqli::autocommit
     *
     * @todo   Implement testAutocommit().
     *
     * @return void
     */
    public function testAutocommit()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /** testChange_user
     *
     * @covers mysqli::change_user
     *
     * @todo   Implement testChange_user().
     *
     * @return void
     */
    public function testChange_user()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /** testCharacter_set_name
     *
     * @covers mysqli::character_set_name
     *
     * @todo   Implement testCharacter_set_name().
     *
     * @return void
     */
    public function testCharacter_set_name()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /** testClose
     *
     * @covers mysqli::close
     *
     * @todo   Implement testClose().
     *
     * @return void
     */
    public function testClose()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /** testCommit
     *
     * @covers mysqli::commit
     *
     * @todo   Implement testCommit().
     *
     * @return void
     */
    public function testCommit()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /** testConnect
     *
     * @covers mysqli::connect
     *
     * @todo   Implement testConnect().
     *
     * @return void
     */
    public function testConnect()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /** testDump_debug_info
     *
     * @covers mysqli::dump_debug_info
     *
     * @todo   Implement testDump_debug_info().
     *
     * @return void
     */
    public function testDump_debug_info()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /** testDebug
     *
     * @covers mysqli::debug
     *
     * @todo   Implement testDebug().
     *
     * @return void
     */
    public function testDebug()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /** testGet_charset
     *
     * @covers mysqli::get_charset
     *
     * @todo   Implement testGet_charset().
     *
     * @return void
     */
    public function testGet_charset()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /** testGet_client_info
     *
     * @covers mysqli::get_client_info
     *
     * @todo   Implement testGet_client_info().
     *
     * @return void
     */
    public function testGet_client_info()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /** testGet_connection_stats
     *
     * @covers mysqli::get_connection_stats
     *
     * @todo   Implement testGet_connection_stats().
     *
     * @return void
     */
    public function testGet_connection_stats()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /** testGet_server_info
     *
     * @covers mysqli::get_server_info
     *
     * @todo   Implement testGet_server_info().
     *
     * @return void
     */
    public function testGet_server_info()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /** testGet_warnings
     *
     * @covers mysqli::get_warnings
     *
     * @todo   Implement testGet_warnings().
     *
     * @return void
     */
    public function testGet_warnings()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /** testInit
     *
     * @covers mysqli::init
     *
     * @todo   Implement testInit().
     *
     * @return void
     */
    public function testInit()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /** testKill
     *
     * @covers mysqli::kill
     *
     * @todo   Implement testKill().
     *
     * @return void
     */
    public function testKill()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /** testMulti_query
     *
     * @covers mysqli::multi_query
     *
     * @todo   Implement testMulti_query().
     *
     * @return void
     */
    public function testMulti_query()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /** testMore_results
     *
     * @covers mysqli::more_results
     *
     * @todo   Implement testMore_results().
     *
     * @return void
     */
    public function testMore_results()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /** testNext_result
     *
     * @covers mysqli::next_result
     *
     * @todo   Implement testNext_result().
     *
     * @return void
     */
    public function testNext_result()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /** testOptions
     *
     * @covers mysqli::options
     *
     * @todo   Implement testOptions().
     *
     * @return void
     */
    public function testOptions()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /** testPing
     *
     * @covers mysqli::ping
     *
     * @todo   Implement testPing().
     *
     * @return void
     */
    public function testPing()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /** testPoll
     *
     * @covers mysqli::poll
     *
     * @todo   Implement testPoll().
     *
     * @return void
     */
    public function testPoll()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /** testPrepare
     *
     * @covers mysqli::prepare
     *
     * @todo   Implement testPrepare().
     *
     * @return void
     */
    public function testPrepare()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /** testQuery
     *
     * @covers mysqli::query
     *
     * @todo   Implement testQuery().
     *
     * @return void
     */
    public function testQuery()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /** testReal_connect
     *
     * @covers mysqli::real_connect
     *
     * @todo   Implement testReal_connect().
     *
     * @return void
     */
    public function testReal_connect()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /** testReal_escape_string
     *
     * @covers mysqli::real_escape_string
     *
     * @todo   Implement testReal_escape_string().
     *
     * @return void
     */
    public function testReal_escape_string()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /** testReap_async_query
     *
     * @covers mysqli::reap_async_query
     *
     * @todo   Implement testReap_async_query().
     *
     * @return void
     */
    public function testReap_async_query()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /** testEscape_string
     *
     * @covers mysqli::escape_string
     *
     * @todo   Implement testEscape_string().
     *
     * @return void
     */
    public function testEscape_string()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /** testReal_query
     *
     * @covers mysqli::real_query
     *
     * @todo   Implement testReal_query().
     *
     * @return void
     */
    public function testReal_query()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /** testRollback
     *
     * @covers mysqli::rollback
     *
     * @todo   Implement testRollback().
     *
     * @return void
     */
    public function testRollback()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /** testSelect_db
     *
     * @covers mysqli::select_db
     *
     * @todo   Implement testSelect_db().
     *
     * @return void
     */
    public function testSelect_db()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /** testSet_charset
     *
     * @covers mysqli::set_charset
     *
     * @todo   Implement testSet_charset().
     *
     * @return void
     */
    public function testSet_charset()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /** testSet_opt
     *
     * @covers mysqli::set_opt
     *
     * @todo   Implement testSet_opt().
     *
     * @return void
     */
    public function testSet_opt()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /** testSsl_set
     *
     * @covers mysqli::ssl_set
     *
     * @todo   Implement testSsl_set().
     *
     * @return void
     */
    public function testSsl_set()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /** testStat
     *
     * @covers mysqli::stat
     *
     * @todo   Implement testStat().
     *
     * @return void
     */
    public function testStat()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /** testStmt_init
     *
     * @covers mysqli::stmt_init
     *
     * @todo   Implement testStmt_init().
     *
     * @return void
     */
    public function testStmt_init()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /** testStore_result
     *
     * @covers mysqli::store_result
     *
     * @todo   Implement testStore_result().
     *
     * @return void
     */
    public function testStore_result()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /** testThread_safe
     *
     * @covers mysqli::thread_safe
     *
     * @todo   Implement testThread_safe().
     *
     * @return void
     */
    public function testThread_safe()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /** testUse_result
     *
     * @covers mysqli::use_result
     *
     * @todo   Implement testUse_result().
     *
     * @return void
     */
    public function testUse_result()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /** testRefresh
     *
     * @covers mysqli::refresh
     *
     * @todo   Implement testRefresh().
     *
     * @return void
     */
    public function testRefresh()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }
}