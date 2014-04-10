<?php
/**
 * PHP version ${PHP_VERSION}
 * Created by PhpStorm.
 * User: carl
 * Date: 4/8/14
 * Time: 11:36 PM
 */
/**
 * Class ConfigurationLoaderInterface
 *
 * @category ${NAMESPACE}
 * @package  ConfigurationLoaderInterface
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license
 * @link
 */
interface ConfigurationLoaderInterface
{
    /** instance
     *
     * @param string $projectName the name of the project to use
     *
     * @return ConfigurationLoader
     */
    static public function instance($projectName);

    /** factory
     *
     * @param string $projectName the name of the project to use
     *
     * @return ConfigurationLoader
     */
    static public function factory($projectName);
}