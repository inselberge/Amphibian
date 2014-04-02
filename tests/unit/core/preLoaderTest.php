<?php

require_once __DIR__ . DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR.".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once AMPHIBIAN_TESTS . "baseTest.php";
require_once AMPHIBIAN_CORE_NEUTRAL . "PreLoader.php";
/**
 * Class preLoaderTest
 *
 * @category Test
 * @package  PreLoader
 * @author   Carl "Tex" Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     documentation/preLoaderTest
 *
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-09-08 at 17:05:30.
 */
class preLoaderTest
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
        $this->object = preLoader::instance(
            'dns',
            array(
                "//fonts.googleapis.com",
                "//google-analytics.com",
                "//www.google-analytics.com"
            )
        );
    }

    /** preLoaderDataProvider
     *
     * @return array
     */
    public function preLoaderDataProvider()
    {
        return array(
            array(
                "js",
                "http://code.jquery.com/jquery-1.9.1.js"
            ),
            array(
                "css",
                "http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"
            ),
            array(
                "dns",
                "http://jqueryui.com/"
            ),
            array(
                "prerender",
                "http://jqueryui.com/"
            ),
            array(
                "prefetch",
                "http://jqueryui.com/"
            )
        );
    }

    /** preLoaderTypeDataProvider
     *
     * @return array
     */
    public function preLoaderTypeDataProvider()
    {
        return array(
            array("js", "css", "prefetch", "dns", "prerender")
        );
    }

    /** preLoaderArrayDataProvider
     *
     * @return array
     */
    public function preLoaderArrayDataProvider()
    {
        return array(
            array(
                array(
                    'http://yahoo.com',
                    'http://google.com',
                    'http://facebook.com',
                    'http://twitter.com'
                )
            ),
            array(
                array(
                    'http://jquery.com',
                    'http://jqueryui.com'
                )
            )
        );
    }

    /** testInstance
     *
     * @covers preLoader::instance
     *
     * @return void
     */
    public function testInstance()
    {
        $this->expected = $this->object;
        $this->actual   = preLoader::instance(
            "css",
            array("http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css")
        );
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetArray
     *
     * @param array $array the array to use for testing
     *
     * @covers         preLoader::setArray
     *
     * @dataProvider   preLoaderArrayDataProvider
     *
     * @return void
     */
    public function testSetArray( $array )
    {
        $this->expected = true;
        $this->actual = $this->object->setArray($array);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetType
     *
     * @param string $type the type of preloader
     *
     * @covers       preLoader::setType
     *
     * @dataProvider preLoaderTypeDataProvider
     *
     * @return void
     */
    public function testSetType( $type )
    {
        $this->expected = true;
        $this->actual = $this->object->setType($type);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testExecute
     *
     * @covers preLoader::execute
     *
     * @return void
     */
    public function testExecute()
    {
        $this->expected = true;
        $this->actual = $this->object->execute();
        $this->assertEquals($this->expected, $this->actual);
    }
}
