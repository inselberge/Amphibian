<?php
require_once __DIR__ . DIRECTORY_SEPARATOR
    . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_CORE."BasicModelMySQLi.php";
/**
 * Class BasicModelMySQLiTest
 *
 * @category UnitTestsCoreMySQLi
 * @package  BasicModelMySQLi
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  GPL v3
 * @link     documentation/BasicModelMySQLiTest
 *
 */
class BasicModelMySQLiTest 
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
        $this->object = $this->getMockForAbstractClass('BasicModelMySQLi');
    }
}
