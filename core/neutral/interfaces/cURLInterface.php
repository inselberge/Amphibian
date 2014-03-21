<?php
/**
 * PHP version 5.4.17
 * Created by JetBrains PhpStorm.
 * User: carl
 * Date: 8/15/13
 * Time: 12:51 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated
 */
interface cURLInterface
{
    static public function instance();
    public function init();

    /** setDefaultOptions
     * @param $defaultOptions
     * @return mixed
     */
    public function setDefaultOptions($defaultOptions);
    public function getDefaultOptions();

    /** setOptions
     * @param $options
     * @return mixed
     */
    public function setOptions($options);
    public function getOptions();

    /** setUrl
     * @param $url
     * @return mixed
     */
    public function setUrl($url);
    public function getUrl();

    /** setValues
     * @param $values
     * @return mixed
     */
    public function setValues($values);
    public function getValues();
    public function post();
    public function get();
    public function setOptionsArray();
    public function exec();
    public function error();
    public function getResult();
    public function setInfo();
    public function getInfo();
    public function close();

    /** check
     * @param $key
     * @return mixed
     */
    public function check($key);
}