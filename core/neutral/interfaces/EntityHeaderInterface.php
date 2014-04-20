<?php
/**
 * PHP version 5.3
 * Created by PhpStorm.
 * User: texmorgan
 * Date: 4/17/14
 * Time: 4:28 PM
 */
require_once AMPHIBIAN_CORE_ABSTRACT_INTERFACES."HeaderInterface.php";
/**
 * Class EntityHeaderInterface
 *
 * @category ${NAMESPACE}
 * @package  EntityHeaderInterface
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated
 * @link     documentation/EntityHeaderInterface
 */
interface EntityHeaderInterface
    extends HeaderInterface
{
    static public function instance();
    static public function factory();

    public function getAllow();
     public function setAllow($allow);
     public function getContentEncoding();
     public function setContentEncoding($contentEncoding);
     public function getContentLanguage();
     public function setContentLanguage($contentLanguage);
     public function getContentLength();
     public function setContentLength($contentLength);
     public function getContentLocation();
     public function setContentLocation($contentLocation);
     public function getContentMD5();
     public function setContentMD5($contentMD5);
     public function getContentRange();
     public function setContentRange($contentRange);
     public function getContentType();
     public function setContentType($contentType);
     public function getExpires();
     public function setExpires($expires);
     public function getExtensionHeader();
     public function setExtensionHeader($extensionHeader);
     public function getLastModified();
     public function setLastModified($lastModified);

} 