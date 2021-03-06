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
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." .DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."config.inc.php";
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
        if ( isset($this->connection)) {
            $this->connection->closeConnection();
        }
        unset($this->connection);
    }

    /** positiveIntegerDataProvider
     *
     * @return array
     */
    public function positiveIntegerDataProvider()
    {
        return array(
            array(3245),
            array(4008),
            array(212)
        );
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
        return array(
            array("Tom Jones"),
            array("Tex Morgan"),
            array("Jane Jones")
        );
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
        return array(
            array("texmorgan@amphibian.co"),
            array("support@amphibian.co"),
            array("blah@mail.com")
        );
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
            array(false)
        );
    }

    /** databaseUserDataProvider
     *
     * @return array
     */
    public function databaseUserDataProvider()
    {
        return array(
            array("browse"),
            array("user"),
            array("pwrUser"),
            array("Adm1n")
        );
    }

    /** projectNameDataProvider
     *
     * @return array
     */
    public function projectNameDataProvider()
    {
        return array(
            array("ProjectA"),
            array("ProjectB"),
            array("ProjectX")
        );
    }

    /** websiteDataProvider
     *
     * @return array
     */
    public function websiteDataProvider()
    {
        return array(
            array("https://duckduckgo.com"),
            array("http://inselberge.com"),
            array("http://innerally.com")
        );
    }

    /** validDatabaseConnectionMySQLiDataProvider
     *
     * @return array
     */
    public function validDatabaseConnectionMySQLiDataProvider()
    {
        require_once AMPHIBIAN_CORE_MYSQLI."databaseConnectionMySQLi.php";
        $this->connection = DatabaseConnectionMySQLi::instance();
        /*
        $this->connection->setOptions(MYSQLI_OPT_CONNECT_TIMEOUT, 10);
        $this->connection->setOptions(MYSQLI_SERVER_PUBLIC_KEY, "/etc/mysql/my.cnf");
        $this->connection->setSSL(
            "/etc/mysql/client-key.pem",
            "/etc/mysql/client-cert.pem",
            "/etc/mysql/ca-cert.pem",
            "/etc/mysql/",
            'DHE-RSA-AES256-SHA'
        );
        */
        $this->connection->setServerName("127.0.0.1");
        $this->connection->setDatabaseName("InnerAlly");
        $this->connection->setUserName("root");
        $this->connection->setUserPassword('4u$t1nTX');
        $this->connection->openConnection();

        return array(
            array($this->connection->getConnection())
        );
    }

    /** validFileExtensionDataProvider
     *
     * @return array
     */
    public function validFileExtensionDataProvider()
    {
        return array(
            array(".json"),
            array(".csv"),
            array(".xml"),
            array(".html"),
            array(".js"),
            array(".css"),
            array(".php")
        );
    }

    /** tableNameDataProvider
     *
     * @return array
     */
    public function tableNameDataProvider()
    {
        return array(
            array("Users"),
            array("Login")
        );
    }

    /** DatabaseServerDataProvider
     *
     * @return array
     */
    public function databaseServerDataProvider()
    {
        return array(
            array(
                array(
                    "MARIADB",
                    "MONGODB",
                    "MSSQL",
                    "MYSQLI",
                    "PDO",
                    "POSTGRE",
                    "SQLITE",
                    "SQLITE3",
                    "SQLSRV"
                )
            ),
            array(
                array(
                    "MYSQL",
                    "SQLITE3"
                )
            )
        );
    }

    /** httpAllowMethodDataProvider
     * @return array
     */
    public function httpAllowMethodDataProvider()
    {
        return array(
            array("GET, PUT, OPTIONS, HEAD, POST, DELETE, PATCH"),
            array("GET, PUT, POST"),
        );
    }

    /** httpContentEncodingDataProvider
     * @return array
     */
    public function httpContentEncodingDataProvider()
    {
        return array(
            array("gzip,deflate,sdch"),
            array("gzip")
        );
    }

    /** httpContentLanguageDataProvider
     * @return array
     */
    public function httpContentLanguageDataProvider()
    {
        return array(
            array("fr-FR,fr;q=0.8,en-US;q=0.6,en;q=0.4 "),
            array("en, da, de, mi")
        );
    }

    /** httpContentLocationDataProvider
     * @return array
     */
    public function httpContentLocationDataProvider()
    {
        return array(
            array("/var/log"),
            array("/var/www"),
            array("/tmp")
        );
    }

    /** httpContentRangeDataProvider
     * @return array
     */
    public function httpContentRangeDataProvider()
    {
        return array(
            array("bytes 0-499/1234"),
            array("bytes 500-999/1234"),
            array("bytes 500-1233/1234")
        );
    }

    /** httpContentTypeDataProvider
     * @return array
     */
    public function httpContentTypeDataProvider()
    {
        return array(
            array("text/html; charset=ISO-8859-4"),
            array("text/html; charset=UTF-8"),
            array("text/plain;")
        );
    }

    /** httpDateDataProvider
     * @return array
     */
    public function httpDateDataProvider()
    {
        return array(
            array("Thu, 01 Dec 1994 16:00:00 GMT"),
            array("Sat, 19 Apr 2014 09:00:00 GMT")
        );
    }

    /** XMLVersionProvider
     *
     * @return array
     */
    public function XMLVersionProvider()
    {
        return array(
            array("1.0", true),
            array("1.1", true),
            array("Omaha", false)
        );
    }

    /** encodingDataProvider
     *
     * @return array
     */
    public function encodingDataProvider()
    {
        return array(
            array("UTF-8", true),
            array("ISO-8859-1", true),
            array("", false)
        );
    }
}