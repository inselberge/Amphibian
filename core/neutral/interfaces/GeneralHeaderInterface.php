<?php
/**
 * PHP version 5.3
 * Created by PhpStorm.
 * User: texmorgan
 * Date: 4/17/14
 * Time: 4:11 PM
 */
/**
 * Class GeneralHeaderInterface
 *
 * @category ${NAMESPACE}
 * @package  GeneralHeaderInterface
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated
 * @link     documentation/GeneralHeaderInterface
 */
interface GeneralHeaderInterface
    extends HeaderInterface
{
    static public function instance();
    static public function factory();
    public function getCacheControl();
    public function setCacheControl($cacheControl);
    public function getConnection();
    public function setConnection($connection);
    public function getDate();
    public function setDate($date);
    public function getPragma();
    public function setPragma($pragma);
    public function getTrailer();
    public function setTrailer($trailer);
    public function getTransferEncoding();
    public function setTransferEncoding($transferEncoding);
    public function getUpgrade();
    public function setUpgrade($upgrade);
    public function getVia();
    public function setVia($via);
    public function getWarning();
    public function setWarning($warning);

} 