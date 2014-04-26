<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Carl "Tex" Morgan
 * Date: 4/1/13
 * Time: 3:45 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once AMPHIBIAN_CORE_ABSTRACT."databaseQuery.php";
require_once AMPHIBIAN_CORE_MYSQLI . "databaseConnectionMySQLi.php";
require_once AMPHIBIAN_CORE_NEUTRAL ."CheckInput.php";
require_once "interfaces".DIRECTORY_SEPARATOR."databaseQueryMySQLiInterface.php";
/**
 * Class databaseQueryMySQLi
 *
 * @category Core
 * @package  Database
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/databaseQueryMySQLi
 */
class databaseQueryMySQLi
    extends databaseQuery
    implements databaseQueryMySQLiInterface
{
    /**
     * @var databaseQueryMySQLi databaseQueryMySQLi a singleton instance of this
     */
    static public $databaseQueryMySQLi;

    /** __construct
     *
     * @param resource $databaseConnection an active database connection
     */
    protected function __construct( $databaseConnection )
    {
        $this->databaseConnection = $databaseConnection;
    }

    /** instance
     *
     * @param resource $databaseConnection an active database connection
     *
     * @return databaseQueryMySQLi
     */
    static public function instance( $databaseConnection )
    {
        if ( !isset(self::$databaseQueryMySQLi) ) {
            self::$databaseQueryMySQLi = new databaseQueryMySQLi($databaseConnection);
        } else {
            self::$databaseQueryMySQLi->clearResults();
        }
        return self::$databaseQueryMySQLi;
    }

    /** execute
     *
     * @param string $string the query string to run
     *
     * @return bool
     */
    public function execute( $string )
    {
        try {
            $this->setQuery($string);
            if ( $this->checkQuery() ) {
                $this->executeQuery();
            } else {
                throw new ExceptionHandler(__METHOD__.":Unable to perform query.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** executeQuery
     *
     * @return bool
     */
    protected function executeQuery()
    {
        try {
            $this->initErrors();
            $this->logQuery($this->query);
            $this->resultSet = mysqli_query($this->databaseConnection->getConnection(),$this->query);
            $this->handleWarnings();
            $this->handleErrors();
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** handleWarnings
     *
     * @return bool
     */
    protected function handleWarnings()
    {
        try {
            if ( !$this->checkWarnings() ) {
                $this->logWarning($this->warnings);
                $this->printWarnings();
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** handleErrors
     *
     * @return bool
     */
    protected function handleErrors()
    {
        try {
            if ( $this->checkErrors() ) {
                $this->setAffectedRows();
                $this->setNumberOfRows();
                $this->setFieldCount();
            } else {
                $this->logError($this->errors);
                //$this->printErrors();
                throw new ExceptionHandler(__METHOD__.":Unable to perform query.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }


    /** clean
     *
     * @param string $string a string to be cleaned
     *
     * @return string
     */
    public function clean( $string )
    {
        $string = trim($string);
        if ( get_magic_quotes_gpc() ) {
            $string = stripslashes($string);
        }
        return $this->databaseConnection->real_escape_string($string);
    }

    /** checkErrors
     *
     * @return bool
     */
    protected function checkErrors()
    {
        $this->errors = mysqli_error_list($this->databaseConnection->getConnection());
        if ( count($this->errors) > 0 ) {
            $this->errors["query"] = $this->query;
            return false;
        }
        return true;
    }

    /** checkWarnings
     *
     * @return bool
     */
    protected function checkWarnings()
    {
        $this->warningCount = mysqli_warning_count($this->databaseConnection->getConnection());
        if ( $this->warningCount > 0 ) {
            $this->warnings = array();
            for ( $i = 0; $i < $this->warningCount; $i++ ) {
                $this->warnings[] = mysqli_get_warnings($this->databaseConnection->getConnection());
            }
            return false;
        }
        return true;
    }

    /** setNumberOfRows
     *
     * @return bool
     */
    protected function setNumberOfRows()
    {
        if ( isset($this->resultSet) ) {
            if ( strstr($this->query, "SELECT") ) {
                $this->numberOfRows = $this->resultSet->num_rows;
            } else {
                $this->numberOfRows = $this->affectedRows;
            }
        } else {
            return false;
        }
        return true;
    }

    /** setAffectedRows
     *
     * @return bool
     */
    protected function setAffectedRows()
    {
        if ( isset($this->resultSet) ) {
            $this->affectedRows = mysqli_affected_rows($this->databaseConnection->getConnection());
        } else {
            return false;
        }
        return true;
    }

    /** setFieldCount
     *
     * @return bool
     */
    protected function setFieldCount()
    {
        if ( isset($this->resultSet) ) {
            $this->fieldCount = mysqli_field_count($this->databaseConnection->getConnection());
        } else {
            return false;
        }
        return true;
    }

    /** commit
     *
     * @return bool
     */
    public function commit()
    {
        return $this->databaseConnection->commit();
    }

    /** getArray
     *
     * @return bool
     */
    public function getArray()
    {
        try {
            if (CheckInput::checkSet($this->resultSet)) {
                $this->resultArray = $this->resultSet->fetch_all(MYSQLI_ASSOC);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": no result set.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getRow
     *
     * @return bool
     */
    public function getRow()
    {
        try {
            if (CheckInput::checkSet($this->resultSet)) {
                $this->row = $this->resultSet->fetch_assoc();
                if (isset($this->row)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": no result set.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
    }

    /** free
     *
     * @return bool
     */
    public function free()
    {
        try {
            if (CheckInput::checkSet($this->resultSet)) {
                $this->resultSet->free();
                $this->resultSet = null;
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkMoreResults
     *
     * @return bool
     */
    protected function checkMoreResults()
    {
        if ( $this->databaseConnection->more_results() ) {
            return true;
        } else {
            return false;
        }
    }

    /** clearResults
     *
     * @return void
     */
    public function clearResults()
    {
        if ( $this->checkMoreResults() ) {
            if ( $this->databaseConnection->next_result() ) {
                if ( $this->resultSet=$this->databaseConnection->store_result() ) {
                    $this->free();
                }
                $this->clearResults();
            }
        }
    }
}
/*
 * Basic Query
require_once __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."config.inc.php";
require_once AMPHIBIAN_DATABASE."AffCell.mysql.config.inc.php";
require_once AMPHIBIAN_CONFIG."mysql.cfg.php";
$dq = databaseQueryMySQLi::instance($databaseConnection);
$dq->execute("SELECT 1 FROM `Users`");
$dq->show();
*/
/*
$SSL = databaseConnectionMySQLi::instance();
$SSL->setServerName("127.0.0.1");
$SSL->setDatabaseName("InnerAlly");
$SSL->setUserName("root");
$SSL->setUserPassword('4u$t1nTX');
$SSL->openConnection();
$dq = databaseQueryMySQLi::instance($SSL);
$dq->execute("DESCRIBE `User`;");
echo "Affected:".$dq->checkAffected();
$dq->show();*/