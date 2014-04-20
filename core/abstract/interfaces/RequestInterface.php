<?php
/**
 * PHP version 5.3
 * Created by PhpStorm.
 * User: texmorgan
 * Date: 4/17/14
 * Time: 5:24 PM
 */
/**
 * Class RequestInterface
 *
 * @category ${NAMESPACE}
 * @package  RequestInterface
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated
 * @link     documentation/RequestInterface
 */
 interface RequestInterface {
    static public function instance();
    static public function factory();
} 