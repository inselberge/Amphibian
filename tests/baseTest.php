<?php
/**
 * PHP Version 5.4.9-4ubuntu2.2
 * Created by PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 9/22/13
 * Time: 5:20 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."config.inc.php";
/**
 * Class BaseTest
 *
 * @category Test
 * @package  Test
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/BaseTest
 */
abstract class BaseTest
    extends PHPUnit_Framework_TestCase
{
    /**
     * @var object connection a valid database connection
     */
    protected $connection;
    /**
     * @var object object the object we are testing
     */
    protected $object;
    /**
     * @var mixed expected the expected return value of the action
     */
    protected $expected;
    /**
     * @var mixed actual the actual return value of the action
     */
    protected $actual;
    /**
     * @var mixed arguments arguments provided to the actual call
     */
    protected $arguments;

    /** tearDown
     *
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     *
     * @return void
     */
    protected function tearDown()
    {
        unset($this->object);
        unset($this->arguments);
        unset($this->expected);
        unset($this->actual);
    }

    /** positiveIntegerDataProvider
     *
     * @return array
     */
    public function positiveIntegerDataProvider()
    {
        return array();
    }

    /** negativeIntegerDataProvider
     *
     * @return array
     */
    public function negativeIntegerDataProvider()
    {
        return array();
    }

    /** positiveTinyIntegerDataProvider
     *
     * @return array
     */
    public function positiveTinyIntegerDataProvider()
    {
        return array();
    }

    /** negativeTinyIntegerDataProvider
     *
     * @return array
     */
    public function negativeTinyIntegerDataProvider()
    {
        return array();
    }

    /** positiveSmallIntegerDataProvider
     *
     * @return array
     */
    public function positiveSmallIntegerDataProvider()
    {
        return array();
    }

    /** negativeSmallIntegerDataProvider
     *
     * @return array
     */
    public function negativeSmallIntegerDataProvider()
    {
        return array();
    }

    /** positiveBigIntegerDataProvider
     *
     * @return array
     */
    public function positiveBigIntegerDataProvider()
    {
        return array();
    }

    /** negativeBigIntegerDataProvider
     *
     * @return array
     */
    public function negativeBigIntegerDataProvider()
    {
        return array();
    }

    /** positiveFloatDataProvider
     *
     * @return array
     */
    public function positiveFloatDataProvider()
    {
        return array();
    }

    /** negativeFloatDataProvider
     *
     * @return array
     */
    public function negativeFloatDataProvider()
    {
        return array();
    }

    /** emptyStringDataProvider
     *
     * @return array
     */
    public function emptyStringDataProvider()
    {
        return array();
    }

    /** goodNameDataProvider
     *
     * @return array
     */
    public function goodNameDataProvider()
    {
        return array();
    }

    /** badNameDataProvider
     *
     * @return array
     */
    public function badNameDataProvider()
    {
        return array();
    }

    /** goodPasswordDataProvider
     *
     * @return array
     */
    public function goodPasswordDataProvider()
    {
        return array();
    }

    /** badPasswordDataProvider
     *
     * @return array
     */
    public function badPasswordDataProvider()
    {
        return array();
    }

    /** goodEmailDataProvider
     *
     * @return array
     */
    public function goodEmailDataProvider()
    {
        return array();
    }

    /** badEmailDataProvider
     *
     * @return array
     */
    public function badEmailDataProvider()
    {
        return array();
    }

    /** goodDateDataProvider
     *
     * @return array
     */
    public function goodDateDataProvider()
    {
        return array();
    }

    /** badDateDataProvider
     *
     * @return array
     */
    public function badDateDataProvider()
    {
        return array();
    }

    /** goodDatetimeDataProvider
     *
     * @return array
     */
    public function goodDatetimeDataProvider()
    {
        return array();
    }

    /** badDatetimeDataProvider
     *
     * @return array
     */
    public function badDatetimeDataProvider()
    {
        return array();
    }

    /** goodTimestampDataProvider
     *
     * @return array
     */
    public function goodTimestampDataProvider()
    {
        return array();
    }

    /** badTimestampDataProvider
     *
     * @return array
     */
    public function badTimestampDataProvider()
    {
        return array();
    }

    /** goodZipDataProvider
     *
     * @return array
     */
    public function goodZipDataProvider()
    {
        return array(
            array(
                "78235",
                "10009",
                "77024",
                "10026",
                "11237"
            )
        );
    }

    /** badZipDataProvider
     *
     * @return array
     */
    public function badZipDataProvider()
    {
        return array();
    }

    /** emptyArrayDataProvider
     *
     * @return array
     */
    public function emptyArrayDataProvider()
    {
        return array(
            array(
                array()
            )
        );
    }

    /** goodArrayDataProvider
     *
     * @return array
     */
    public function goodArrayDataProvider()
    {
        return array();
    }

    /** badArrayDataProvider
     *
     * @return array
     */
    public function badArrayDataProvider()
    {
        return array();
    }

    /** goodFileNameDataProvider
     *
     * @return array
     */
    public function goodFileNameDataProvider()
    {
        return array(
            array(
                "Bob.txt",
                "user.php",
                "data.csv",
                "table.xml"
            )
        );
    }

    /** badFileNameDataProvider
     *
     * @return array
     */
    public function badFileNameDataProvider()
    {
        return array();
    }

    /** goodFileLocationsDataProvider
     *
     * @return array
     */
    public function goodFileLocationsDataProvider()
    {
        return array(
            array(
                array(
                    ".",
                    "/var/www",
                    "~/Public/html"
                )
            )
        );
    }

    /** badFileLocationsDataProvider
     *
     * @return array
     */
    public function badFileLocationsDataProvider()
    {
        return array();
    }

    /** permissionDataProvider
     *
     * @return array
     */
    public function permissionDataProvider()
    {
        return array(
            array(0755),
            array(0700),
            array(0777),
            array(0600),
            array(0644),
            array(0640)
        );
    }

    /** booleanDataProvider
     *
     * @return array
     */
    public function booleanDataProvider()
    {
        return array(
            array(true),
            array(false),
            array(null)
        );
    }
} 