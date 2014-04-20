<?php
/**
 * PHP version 5.3
 * Created by PhpStorm.
 * User: texmorgan
 * Date: 4/17/14
 * Time: 3:28 PM
 */
/**
 * Class HeaderInterface
 *
 * @category ${NAMESPACE}
 * @package  HeaderInterface
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated
 * @link     documentation/HeaderInterface
 */
interface HeaderInterface
{
    /** extractHeaderArray
     *
     * @return bool
     */
    public function extractHeaderArray();

    /** getCount
     *
     * @return int
     */
    public function getCount();

    /** checkCount
     *
     * @return bool
     */
    public function checkCount();

    /** getHeaderArray
     *
     * @return array
     */
    public function getHeaderArray();

    /** remove
     *
     * @param string $header an index in the headerArray
     *
     * @return bool
     */
    public function remove($header);

    /** __isset
     *
     * @param string $index an index in the header array
     *
     * @return bool
     */
    public function __isset($index);

    /** sent
     *
     * @param string &$file the file string to use
     * @param int &$line the line number in the file
     *
     * @return bool
     */
    public function sent(&$file = null, &$line = null);
} 