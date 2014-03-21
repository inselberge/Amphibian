<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/9/13
 * Time: 8:03 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once "CheckInputInterface.php";

/**
 * Interface CheckValueInterface
 *
 * @category ${NAMESPACE}
 * @package  CheckValueInterface
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated
 * @link     documentation/CheckValueInterface
 */
interface CheckValueInterface
    extends CheckInputInterface
{
    /**
     *
     */
    public function __construct();
    public function setVariables();
    public function checkVariables();

    /** setType
     * @param $type
     * @return mixed
     */
    public function setType( $type );

    /** setValue
     * @param $value
     * @return mixed
     */
    public function setValue( $value );
    public function evaluateInput();
}