<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Carl "Tex" Morgan
 * Date: 4/3/13
 * Time: 2:31 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once "interfaces".DIRECTORY_SEPARATOR."SessionExceptionInterface.php";

/**
 * Class SessionException
 *
 * @category ${NAMESPACE}
 * @package  SessionException
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated
 * @link     documentation/SessionException
 */
class SessionException
    extends Exception
    implements SessionExceptionInterface
{
    protected $message;

    /**
     * @param string $message
     */
    public function __construct( $message )
    {
        parent::__construct();
        if ( isset($message) ) {
            $this->message = $message;
        }
    }

    public function printMessage()
    {
        echo utf8_encode(date('Y-m-d H:i:s') . " " . __CLASS__ . "::" . __FUNCTION__ . $this->message);
    }
}