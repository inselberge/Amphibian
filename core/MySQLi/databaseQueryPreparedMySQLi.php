<?php
/**
 * PHP Version: ${PHP_VERSION}
 * Created by PhpStorm.
 * User: carl
 * Date: 12/19/13
 * Time: 2:34 PM
 */
require_once "interfaces".DIRECTORY_SEPARATOR."databaseQueryPreparedMySQLiInterface.php";
require_once AMPHIBIAN_CORE_ABSTRACT."databaseQueryPrepared.php";
/**
 * Class DatabaseQueryPreparedMySQLi
 *
 * @category DatabaseQueryPrepared
 * @package  DatabaseQueryPreparedMySQLi
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
* @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/
 */
class DatabaseQueryPreparedMySQLi
    extends DatabaseQueryPrepared
    implements DatabaseQueryPreparedMySQLiInterface
{
    /**
     * @var object DatabaseQueryPreparedMySQLi a singleton instance of this class
     */
    static public $DatabaseQueryPreparedMySQLi;

    /** __construct
     *
     * @param resource $databaseConnection a valid database connection
     */
    protected function __construct( $databaseConnection )
    {
        try {
            if (CheckInput::checkNewInput($databaseConnection)) {
                $this->connection = $databaseConnection;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": databaseConnection invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
    }

    /** instance
     *
     * @param resource $databaseConnection a valid database connection
     *
     * @return DatabaseQueryPreparedMySQLi
     */
    static public function instance($databaseConnection)
    {
        if ( !isset(self::$DatabaseQueryPreparedMySQLi) ) {
            self::$DatabaseQueryPreparedMySQLi = new DatabaseQueryPreparedMySQLi($databaseConnection);
        }
        return self::$DatabaseQueryPreparedMySQLi;
    }

    /** factory
     *
     * @param resource $databaseConnection a valid database connection
     *
     * @return DatabaseQueryPreparedMySQLi
     */
    static public function factory($databaseConnection)
    {
        return new DatabaseQueryPreparedMySQLi($databaseConnection);
    }

    /** init
     *
     * @return bool
     */
    public function init()
    {
        try {
            if (CheckInput::checkSet($this->connection)) {
                $this->setStatement($this->connection->stmt_init());
            } else {
                throw new ExceptionHandler(__METHOD__ . ": connection required.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        } finally {

        }
        return true;
    }

    /** prepare
     *
     * @param string $query
     *
     * @return bool
     */
    public function prepare($query)
    {
        try {
            if (CheckInput::checkNewInput($query)) {
                $this->setStatement($this->connection->prepare($query));
            } else {
                throw new ExceptionHandler(__METHOD__ . ": query invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        } finally {

        }
        return true;
    }

    /** bind
     *
     * @param array $typesVariables
     *
     * @return bool
     */
    public function bind(array $typesVariables)
    {
        try {
            if (CheckInput::checkNewInputArray($typesVariables)) {
                foreach ($typesVariables as $key => $value) {
                    if ( !$this->statement->bind_param($key, $value) ) {
                        throw new ExceptionHandler(__METHOD__ . ": binding error: (". $this->statement->errno. ") ". $this->statement->error);
                    }
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": bind array is invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        } finally {

        }
        return true;
    }

    /** execute
     *
     * @return bool
     */
    public function execute()
    {
        try {
            if (CheckInput::checkSet($this->statement)) {
                return $this->statement->execute();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": statement required.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        } finally {

        }
        return true;

    }

    /** updateVariables
     *
     * @return bool
     */
    protected function updateVariables()
    {
        try {
            if (CheckInput::checkSet($this->statement)) {
                $this->affectedRows = $this->statement->affected_rows;
                $this->errorNumber = $this->statement->errno;
                $this->errorList = $this->statement->error_list;
                $this->error = $this->statement->error;
                $this->fieldCount = $this->statement->field_count;
                $this->insertId = $this->statement->insert_id;
                $this->numberOfRows = $this->statement->num_rows;
                $this->parameterCount = $this->statement->param_count;
                $this->state = $this->statement->sqlstate;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": statement required.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        } finally {

        }
        return true;
    }

    /** bindResult
     *
     * @param array $variables
     *
     * @return bool
     */
    public function bindResult(array $variables)
    {
        try {
            if (CheckInput::checkNewInputArray($variables)) {
                return $this->statement->bind_result($variables);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": variables required.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        } finally {

        }
        return true;
    }

    /** freeResult
     *
     * @return bool
     */
    public function freeResult()
    {
        try {
            if (CheckInput::checkSet($this->statement)) {
                $this->statement->free_result();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": statement invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        } finally {

        }
        return true;
    }

    /** getResult
     *
     * @return bool
     */
    public function getResult()
    {
        try {
            if (CheckInput::checkSet($this->statement)) {
                return $this->setResult($this->statement->get_result());
            } else {
                throw new ExceptionHandler(__METHOD__ . ": statement invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        } finally {

        }
        return true;
    }

    /** storeResult
     *
     * @return bool
     */
    public function storeResult()
    {
        try {
            if (CheckInput::checkSet($this->statement)) {
                return $this->statement->store_result();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": statement required.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        } finally {

        }
        return true;
    }

    /** seek
     *
     * @param int $offset
     *
     * @return bool
     */
    public function seek($offset)
    {
        try {
            if ( $this->checkValidOffset($offset) ) {
                $this->statement->data_seek($offset);
            } else {
                throw new ExceptionHandler(__METHOD__ . ":invalid offset.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        } finally {

        }
        return true;
    }

    /** checkValidOffset
     *
     * @param $offset
     *
     * @return bool
     */
    protected function checkValidOffset($offset)
    {
        try {
            if ( CheckInput::checkNewInput($offset) ) {
                if ( $offset >= 0 ) {
                    if ( $offset > ( $this->numberOfRows - 1) ) {
                        throw new ExceptionHandler(__METHOD__ . ": offset out of bounds.");
                    }
                } else {
                    throw new ExceptionHandler(__METHOD__ . ": offset must be >= 0.");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": offset invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        } finally {

        }
        return true;
    }

    /** getAttribute
     *
     * @param $attribute
     *
     * @return bool
     */
    public function getAttribute( $attribute )
    {
        try {
            if (CheckInput::checkNewInput($attribute)) {
                return $this->statement->attr_get($attribute);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": attribute invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        } finally {

        }
        return true;
    }

    /** setAttribute
     *
     * @param $attribute
     * @param $mode
     *
     * @return bool
     */
    public function setAttribute( $attribute, $mode )
    {
        try {
            if (CheckInput::checkNewInput($attribute) AND CheckInput::checkNewInput($mode)) {
                return $this->statement->attr_set($attribute, $mode);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": attribute or mode invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        } finally {

        }
        return true;
    }

    /** fetch
     *
     * @return bool
     */
    public function fetch()
    {
        try {
            if (CheckInput::checkSet($this->statement)) {
                return $this->statement->fetch();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": statement required.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        } finally {

        }
        return true;
    }

    /** getWarnings
     *
     * @return bool
     */
    public function getWarnings()
    {
        try {
            if (CheckInput::checkSet($this->statement)) {
                return $this->statement->get_warnings();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": statement required.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        } finally {

        }
        return true;
    }

    /** more
     *
     * @return bool
     */
    public function more()
    {
        try {
            if (CheckInput::checkSet($this->statement)) {
                return $this->statement->more_results();
            } else {
                throw new ExceptionHandler(__METHOD__ . ":statement invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        } finally {

        }
        return true;
    }

    /** next
     *
     * @return bool
     */
    public function next()
    {
        try {
            if (CheckInput::checkSet($this->statement)) {
                return $this->statement->next_result();
            } else {
                throw new ExceptionHandler(__METHOD__ . ":statement invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        } finally {

        }
        return true;
    }

    /** resultMetadata
     *
     * @return bool
     */
    public function resultMetadata()
    {
        try {
            if (CheckInput::checkSet($this->statement)) {
                return $this->statement->result_metadata();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": statement invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        } finally {

        }
        return true;
    }

    /** sendLongData
     *
     * @param $parameterNumber
     * @param $data
     *
     * @return bool
     */
    public function sendLongData($parameterNumber, $data)
    {
        try {
            if (CheckInput::checkNewInput($parameterNumber) AND CheckInput::checkNewInputArray($data)) {
                return $this->statement->send_long_data($parameterNumber, $data);
            } else {
                throw new ExceptionHandler(__METHOD__ . ":some message.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        } finally {

        }
        return true;
    }

    /** reset
     *
     * @return bool
     */
    public function reset()
    {
        try {
            if (CheckInput::checkSet($this->statement)) {
                return $this->statement->reset();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": statement required.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        } finally {

        }
        return true;
    }

    /** close
     *
     * @return bool
     */
    public function close()
    {
        try {
            if (CheckInput::checkSet($this->statement)) {
                $this->statement->close();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": statement required.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        } finally {

        }
        return true;
    }

}