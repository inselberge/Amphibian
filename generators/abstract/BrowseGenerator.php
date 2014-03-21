<?php
/**
 * PHP Version: ${PHP_VERSION}
 * Created by PhpStorm.
 * User: carl
 * Date: 1/13/14
 * Time: 3:01 PM
 */
require_once "BasicGenerator.php";
require_once "interfaces".DIRECTORY_SEPARATOR."BrowseGeneratorInterface.php";
/**
 * Class BrowseGenerator
 *
 * @category 
 * @package  BrowseGenerator
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/BrowseGenerator
 */
abstract class BrowseGenerator
    extends BasicGenerator
    implements BrowseGeneratorInterface 
{

} 