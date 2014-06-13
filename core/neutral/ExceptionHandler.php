<?php
/**
 * PHP version 5.4.17
 * Created by JetBrains PhpStorm.
 * User: Carl "Tex" Morgan
 * Date: 4/3/13
 * Time: 2:38 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."config.inc.php";
require_once AMPHIBIAN_CORE_NEUTRAL."Log.php";
require_once AMPHIBIAN_CORE_NEUTRAL ."CheckInput.php";
require_once "interfaces".DIRECTORY_SEPARATOR."ExceptionHandlerInterface.php";
/**
 * Class ExceptionHandler
 *
 * @category Core
 * @package  ExceptionHandler
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/ExceptionHandler
 */
class ExceptionHandler
    extends Exception
    implements ExceptionHandlerInterface
{
    /**
     * @var object log the log object to use
     */
    protected $log;
    /**
     * @var string class the class where the exception occurred
     */
    protected $class;
    /**
     * @var string method the method where the exception occurred
     */
    protected $method;
    /**
     * @var object ExceptionHandler a singleton instance of this class
     */
    public static $ExceptionHandler;

    /** __construct
     *
     * @param string    $message  the exception message
     * @param int       $code     the error code of the exception
     * @param Exception $previous the previous exception
     */
    public function __construct( $message, $code = 0, $previous = null )
    {
        $message = date('Y-m-d H:i:s') . " " . $message . PHP_EOL;
        $message .= "Trigger Source: $this->file ($this->line)" . PHP_EOL;
        $message .= "Stack Trace:" . PHP_EOL . $this->getTraceAsString() . PHP_EOL . PHP_EOL;
        $message = utf8_encode($message);
        parent::__construct($message, $code, $previous);
    }

    /** instance
     *
     * @param string $msg the exception message
     *
     * @return ExceptionHandler
     */
    public static function instance( $msg )
    {
        if ( !isset(self::$ExceptionHandler) ) {
            self::$ExceptionHandler = new ExceptionHandler($msg);
        }
        return self::$ExceptionHandler;
    }

    /** execute
     *
     * @return bool
     */
    public function execute()
    {
        try {
            $this->sendToLog();
            if ( $this->checkStatus() ) {
                $this->redirect500();
            } else {
                //$this->show();
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setClass
     *
     * @param string $class the class used
     *
     * @return bool
     */
    protected function setClass( $class )
    {
        try {
            if ( CheckInput::checkNewInput($class) ) {
                $this->class = $class;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": setClass failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setMethod
     *
     * @param string $method the method called
     *
     * @return bool
     */
    protected function setMethod( $method )
    {
        try {
            if ( CheckInput::checkNewInput($method) ) {
                $this->method = $method;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": setMethod failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkStatus
     *
     * @return bool
     */
    protected function checkStatus()
    {
        if ( isset($live) AND $live === true ) {
            return true;
        } else {
            return false;
        }
    }

    /** sendToLog
     *
     * @return void
     */
    protected function sendToLog()
    {
        $this->log = Log::instance($this->message);
        $this->log->setLogType("Error");
        $this->log->execute();
    }

    /** __toString
     *
     * @return string
     */
    public function __toString()
    {
        return utf8_encode(
            date('Y_m_d__H.i.s')
            . " " . $this->class
            . "::"
            . $this->method
            . ":"
            . $this->message . PHP_EOL
        );
    }

    /** redirect500
     *
     * @return void
     */
    protected function redirect500()
    {
        redirect_invalid_user(null, "error500.php");
    }

    /** show
     *
     * @return void
     */
    protected function show()
    {
        print_r($this);
    }
}
/*
$eh = ExceptionHandler::instance("Blah");
$eh->execute();
*/