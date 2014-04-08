<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Carl "Tex" Morgan
 * Date: 4/2/13
 * Time: 12:28 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 * Child Classes: databaseSession, flatfileSession
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once "CheckInput.php";
require_once "interfaces".DIRECTORY_SEPARATOR."SessionInterface.php";
/**
 * Class Session
 *
 * @category Helper
 * @package  Session
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/Session
 */
class Session
    extends CheckInput
    implements SessionInterface
{
    /**
     * @var array _acceptableStatuses a list of acceptable statuses
     */
    static private $_acceptableStatuses
        = array(
            PHP_SESSION_DISABLED,
            PHP_SESSION_NONE,
            PHP_SESSION_ACTIVE
        );
    /**
     * @var integer _status
     */
    private $_status;
    /**
     * @var string _name
     */
    private $_name;
    /**
     * @var string _id
     */
    private $_id;
    /**
     * @var array _payload
     */
    private $_payload;
    /**
     * @var string _namespace
     */
    private $_namespace;

    /**
     * @var  _session
     */
    static private $_session;

    /** __construct
     *
     */
    protected function __construct()
    {
        $this->_payload = array();
        $this->_namespace = array();
    }

    /** instance
     *
     * @return Session
     */
    static public function instance()
    {
        if ( self::$_session === null ) {
            self::$_session = new Session();
        }
        return self::$_session;
    }

    /** get
     *
     * @param string $namespace the namespace to get
     * @param array  $data      the specific data to get
     *
     * @return bool
     */
    public function get( $namespace, array $data )
    {
        try {
            if ( $this->checkNamespaceExists($namespace) ) {
                return $this->extractFromPayload($namespace, $data);
            } else {
                throw new ExceptionHandler(__METHOD__.": invalid namespace");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** set
     *
     * @param string $namespace the namespace to use
     * @param array  $data      the data to set
     *
     * @return bool
     */
    public function set( $namespace, array $data )
    {
        try {
            if ( $this->checkNewInput($namespace) ) {
                if ( $this->checkNamespaceExists($namespace) ) {
                } else {
                    $this->_namespace[] = $namespace;
                }
                $this->extractIntoPayload($namespace, $data);
            } else {
                throw new ExceptionHandler(__METHOD__.": invalid namespace");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** extractIntoPayload
     *
     * @param string $namespace the namespace to check
     * @param array  $data      the data to use
     *
     * @return bool
     */
    protected function extractIntoPayload( $namespace, array $data )
    {
        try {
            if ( count($data) > 0 ) {
                foreach ( $data as $key => $value ) {
                    $this->_payload[$namespace][$key] = $value;
                }
            } else {
                throw new ExceptionHandler(__METHOD__.": data is empty.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** extractFromPayload
     *
     * @param string $namespace the namespace to investigate
     * @param array  $data      the data requested
     *
     * @return mixed
     */
    protected function extractFromPayload($namespace, array $data)
    {
        $temp = array();
        try {
            if ( count($data) > 0 ) {

                foreach ( $data as $key => $value ) {
                    if ( isset($this->_payload[$namespace][$key]) ) {
                        $temp[$namespace][$key]
                            = $this->_payload[$namespace][$key];
                    }
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": imaginary data.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return $temp;
    }

    /** checkNamespaceExists
     *
     * @param string $namespace the namespace to check
     *
     * @return bool
     */
    protected function checkNamespaceExists( $namespace )
    {
        if ( in_array($namespace, $this->_namespace) ) {
            return true;
        } else {
            return false;
        }
    }

    /** updateStatus
     *
     * @param string $status the new status
     *
     * @return bool
     */
    protected function updateStatus( $status )
    {
        try {
            if ( $this->checkNewInput($status) ) {
                if ( in_array($status, self::$_acceptableStatuses) ) {
                    $this->_status = $status;
                } else {
                    throw new ExceptionHandler(__METHOD__.": status provided is unacceptable.");
                }
            } else {
                throw new ExceptionHandler(__METHOD__.": failed to update session status.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** start
     *
     * @return bool
     */
    protected function start()
    {
        try {
            if ( $this->_status === PHP_SESSION_DISABLED ) {
                throw new ExceptionHandler(__METHOD__.": sessions are not currently supported. Check php.ini");
            } elseif ( $this->_status === PHP_SESSION_NONE ) {
                return session_start();
            } elseif ( $this->_status === PHP_SESSION_ACTIVE ) {
                return $this->reanimate();
            } else {
                throw new ExceptionHandler(__METHOD__.": status has not been initialized.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** rename
     *
     * @param string $name the new name
     *
     * @return bool
     */
    protected function rename( $name )
    {
        try {
            if ( $this->checkNewInput($name) ) {
                $this->_name = $name;
            } else {
                throw new ExceptionHandler(__METHOD__.": failed to update session name.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** reanimate
     *
     * @return bool
     */
    protected function reanimate()
    {
        return session_regenerate_id();
    }

    /** serializePayload
     *
     * @return string
     */
    protected function serializePayload()
    {
        return serialize($this->_payload);
    }

    /** deserializePayload
     *
     * @param mixed $payload the serialized payload
     *
     * @return mixed
     */
    protected function deserializePayload( $payload )
    {
        return unserialize($payload);
    }

    /** clear
     *
     * @return void
     */
    protected function clear()
    {
        unset(self::$_session);
        $_SESSION = array();
    }

    /** destroy
     *
     * @return bool
     */
    protected function destroy()
    {
        return session_destroy();
    }

    /** show
     *
     * @return void
     */
    protected function show()
    {
        print_r(self::$_session);
    }
}