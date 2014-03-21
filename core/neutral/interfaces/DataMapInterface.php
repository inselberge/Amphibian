<?php
/**
 * PHP Version 5.4.9-4ubuntu2.2
 *
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 9/1/13
 * Time: 10:08 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once "CheckInputInterface.php";

/**
 * Interface dataMapInterface
 *
 * @category ${NAMESPACE}
 * @package  dataMapInterface
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated
 * @link     documentation/dataMapInterface
 */
interface dataMapInterface
    extends CheckInputInterface
{
    static public function instance();

    /** initMap
     * @param array $arr
     * @return mixed
     */
    public function initMap(array $arr);

    /** setMapByKey
     * @param array $map
     * @return mixed
     */
    public function setMapByKey( array $map);

    /** getMapByKey
     * @param $key
     * @return mixed
     */
    public function getMapByKey($key);

    /** setMap
     * @param array $map
     * @return mixed
     */
    public function setMap( array $map );
    public function getMap();

    /** getMapType
     * @param $key
     * @return mixed
     */
    public function getMapType($key);
}
