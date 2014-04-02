<?php
/**
 * PHP version ${PHP_VERSION}
 * Created by PhpStorm.
 * User: carl
 * Date: 3/31/14
 * Time: 10:23 PM
 */
/**
 * Class amphibianProjectInterface
 *
 * @category ${NAMESPACE}
 * @package  amphibianProjectInterface
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license
 * @link
 */
 interface amphibianProjectInterface {
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