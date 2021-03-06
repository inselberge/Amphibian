<?php
/**
 * PHP version 5.4.17
 *
 * Created by JetBrains PhpStorm.
 * User: Carl "Tex" Morgan
 * Date: 10/14/13
 * Time: 11:16 AM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_CORE_NEUTRAL."JSON.php";
/**
 * Class JSONTest
 *
 * @category Test
 * @package  JSON
 * @author   Carl "Tex" Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     documentation/JSONTest
 *
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-09-08 at 17:05:30.
 *
 */
class JSONTest 
    extends BaseTest
{

    /** setUp
     *
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp()
    {
        $this->object = new JSON();
    }

    /** testPost
     *
     * @covers JSON::setURL
     *
     * @return void
     */
    public function testSetURL()
    {
        $this->arguments = "http://maps.googleapis.com/maps/api/geocode/json?latlng=-24.448674,135.684569&sensor=false";
        $this->expected = true;
        $this->actual = $this->object->setURL($this->arguments);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testPost
     *
     * @covers JSON::post
     *
     * @return void
     */
    public function testPost()
    {
        $this->object->setURL("http://maps.googleapis.com/maps/api/geocode/json?latlng=-24.448674,135.684569&sensor=false");
        $this->expected = true;
        $this->actual = $this->object->post();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGet
     *
     * @covers JSON::get
     *
     * @return void
     */
    public function testGet()
    {
        $this->object->setURL("http://maps.googleapis.com/maps/api/geocode/json?latlng=-24.448674,135.684569&sensor=false");
        $this->expected = true;
        $this->actual = $this->object->get();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetOptions
     *
     * @covers JSON::setOptions
     *
     * @return void
     */
    public function testSetOptions()
    {
        $this->expected = true;
        $this->arguments = array(CURLOPT_AUTOREFERER => true);
        $this->actual = $this->object->setOptions($this->arguments);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testResponse
     *
     * @covers JSON::response
     *
     * @return void
     */
    public function testResponse()
    {
        $this->expected = true;
        $this->actual = $this->object->response();
        $this->assertEquals($this->expected, $this->actual);
    }
}
