<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/9/13
 * Time: 7:39 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once "CheckInputInterface.php";

/**
 * Interface SessionInterface
 *
 * @category ${NAMESPACE}
 * @package  SessionInterface
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated
 * @link     documentation/SessionInterface
 */
interface SessionInterface
    extends CheckInputInterface
{
    static public function instance();

    /** get
     * @param $namespace
     * @param array $data
     * @return mixed
     */
    public function get( $namespace, array $data );

    /** set
     * @param $namespace
     * @param array $data
     * @return mixed
     */
    public function set( $namespace, array $data );
}