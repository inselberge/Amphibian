<?php
/**
 * PHP version ${PHP_VERSION}
 * Created by PhpStorm.
 * User: carl
 * Date: 4/6/14
 * Time: 9:52 PM
 */
/**
 * Class ViewGeneratorCustomMySQLiInterface
 *
 * @category ${NAMESPACE}
 * @package  ViewGeneratorCustomMySQLiInterface
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license
 * @link
 */
interface ViewGeneratorCustomMySQLiInterface
{
    /** instance
     * 
     * @return object
     */
    static public function instance();
    /** factory
     * 
     * @return object
     */
    static public function factory();
} 