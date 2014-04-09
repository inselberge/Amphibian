<?php

require_once __DIR__ . DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."config.inc.php";
require_once AMPHIBIAN_CORE_MYSQLI."DropDownMySQLi.php";
require_once AMPHIBIAN_CORE_MYSQLI . "databaseConnectionMySQLi.php";
require_once AMPHIBIAN_TESTS_UNIT."baseTest.php";
/**
 * Class dropDownTest
 *
 * @category Test
 * @package  Core
 * @author   Carl "Tex" Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     documentation/dropDownTest
 *
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-09-08 at 17:05:31.
 *
 */
class DropDownMySQLiTest
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
        $databaseConnection = databaseConnectionMySQLi::instance();
        $this->object = DropDownMySQLi::instance($databaseConnection);
    }

    /** testInstance
     *
     * @covers dropDown::instance
     *
     * @return void
     */
    public function testInstance()
    {
        $this->expected = $this->object;
        $databaseConnection = databaseConnectionMySQLi::instance();
        $this->actual = DropDown::instance($databaseConnection);
        $this->assertEquals($this->expected, $this->actual);

    }

    /** classDataProvider
     *
     * @return array
     */
    public function classDataProvider()
    {
        return array(
            array("red"),
            array("btn"),
            array("col-lg-4 black")
        );
    }

    /** testSetClass
     *
     * @param string $class the class of the HTML element
     *
     * @covers dropDown::setClass
     *
     * @dataProvider classDataProvider
     *
     * @return void
     */
    public function testSetClass($class)
    {
        $this->expected = true;
        $this->actual = $this->object->setLabelClass($class);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetHTML
     *
     * @covers dropDown::getHTML
     *
     * @return void
     */
    public function testGetHTML()
    {
        $this->expected = null;
        $this->actual = $this->object->getHTML();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetId
     *
     * @param string $identification a string for the HTML
     *
     * @covers dropDown::setId
     *
     * @dataProvider idDataProvider
     *
     * @return void
     */
    public function testSetId($identification)
    {
        $this->expected = true;
        $this->actual = $this->object->setRequired($identification);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetRequired
     *
     * @param boolean $required a boolean, or lack there of
     *
     * @covers dropDown::setRequired
     *
     * @dataProvider booleanDataProvider
     *
     * @return void
     */
    public function testSetRequired($required)
    {
        $this->expected = true;
        $this->actual = $this->object->setRequired($required);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetLabelClass
     *
     * @param string $class the class of the label
     *
     * @covers dropDown::setLabelClass
     *
     * @dataProvider labelClassDataProvider
     *
     * @return void
     */
    public function testSetLabelClass($class)
    {
        $this->expected = true;
        $this->actual = $this->object->setLabelClass($class);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** labelFieldsDataProvider
     *
     * @return array
     */
    public function labelFieldsDataProvider()
    {
        return array(
            array(),
            array(),
            array()
        );
    }

    /** testSetLabelFields
     *
     * @param array $fields the fields to use for the label
     *
     * @covers dropDown::setLabelFields
     *
     * @dataProvider labelFieldsDataProvider
     *
     * @return void
     */
    public function testSetLabelFields($fields)
    {
        $this->expected = true;
        $this->actual = $this->object->setLabelFields($fields);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetName
     *
     * @param string $name the name to use
     *
     * @covers dropDown::setName
     *
     * @dataProvider nameDataProvider
     *
     * @return void
     */
    public function testSetName($name)
    {
        $this->expected = true;
        $this->actual = $this->object->setName($name);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** labelDataProvider
     *
     * @return array
     */
    public function labelDataProvider()
    {
        return array(
            array("First Name"),
            array("Email"),
            array("Location")
        );
    }

    /** testSetSelectLabel
     *
     * @param string $label the label to use
     *
     * @covers dropDown::setSelectLabel
     *
     * @dataProvider labelDataProvider
     *
     * @return void
     */
    public function testSetSelectLabel($label)
    {
        $this->expected = true;
        $this->actual = $this->object->setSelectLabel($label);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** queryDataProvider
     *
     * @return array
     */
    public function queryDataProvider()
    {
        return array(
            array(),
            array(),
            array()
        );
    }

    /** testSetQuery
     *
     * @param string $query the database query to run
     *
     * @covers dropDown::setQuery
     *
     * @dataProvider queryDataProvider
     *
     * @return void
     */
    public function testSetQuery($query)
    {
        $this->expected = true;
        $this->actual = $this->object->setQuery($query);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetQuery
     *
     * @covers dropDown::getQuery
     *
     * @return void
     */
    public function testGetQuery()
    {
        $this->expected = null;
        $this->actual = $this->object->getQuery();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** fieldDataProvider
     *
     * @return array
     */
    public function fieldDataProvider()
    {
        return array(
            array("first_name"),
            array("email"),
            array("location")
        );
    }

    /** testSetValueField
     *
     * @param string $field the field to use for data
     *
     * @covers dropDown::setValueField
     *
     * @dataProvider fieldDataProvider
     *
     * @return void
     */
    public function testSetValueField($field)
    {
        $this->expected = true;
        $this->actual = $this->object->setValueField($field);
        $this->assertEquals($this->expected, $this->actual);

    }

    /** testGetValueField
     *
     * @covers dropDown::getValueField
     *
     * @return void
     */
    public function testGetValueField()
    {
        $this->expected = true;
        $this->actual = $this->object->getValueField();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** separatorDataProviders
     *
     * @return array
     */
    public function separatorDataProviders()
    {
        return array(
            array(
                array()
            ),
            array(
                array()
            )
        );
    }

    /** testSetSeparatorFields
     *
     * @param array $separators separators for the label
     *
     * @covers dropDown::setSeparatorFields
     *
     * @dataProvider separatorDataProviders
     *
     * @return void
     */
    public function testSetSeparatorFields($separators)
    {
        $this->expected = true;
        $this->actual = $this->object->setSeparatorFields($separators);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testExecute
     *
     * @covers dropDown::execute
     *
     * @return void
     */
    public function testExecute()
    {
        $this->expected = true;
        $this->actual = $this->object->execute();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testShowHTML
     *
     * @covers dropDown::showHTML
     *
     * @return void
     */
    public function testShowHTML()
    {
        $this->expected = null;
        $this->actual = $this->object->showHTML();
        $this->assertEquals($this->expected, $this->actual);
    }
}
