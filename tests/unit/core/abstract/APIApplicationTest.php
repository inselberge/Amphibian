<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "baseTest.php";
require_once AMPHIBIAN_CORE_ABSTRACT."APIApplication.php";
/**
 * Class APIApplicationTest
 *
 * @category UnitTests
 * @package  APIApplication
 * @author   Carl "Tex" Morgan <texmorgan@amphibian.co>
 * @license  GPL v3
 * @link     documentation/APIApplicationTest
 *
 */
class APIApplicationTest 
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
        $this->object = $this->getMockForAbstractClass('ApiApplication');
    }

    /** testSetDescription
     *
     * @covers APIApplication::setDescription
     *
     * @return void
     */
    public function testSetDescription()
    {
        $this->expected = true;
        $this->actual = $this->object->setDescription("Description");
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetDescription
     *
     * @covers APIApplication::getDescription
     *
     * @return void
     */
    public function testGetDescription()
    {
        $this->object->setDescription("Description");
        $this->expected = "Description";
        $this->actual = $this->object->getDescription();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetEmail
     *
     * @param string $email an email account
     *
     * @covers APIApplication::setEmail
     *
     * @dataProvider goodEmailDataProvider
     *
     * @return void
     */
    public function testSetEmail($email)
    {
        $this->expected = true;
        $this->actual = $this->object->setEmail($email);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetEmail
     *
     * @param string $email an email account
     *
     * @covers APIApplication::getEmail
     *
     * @dataProvider goodEmailDataProvider
     *
     * @return void
     */
    public function testGetEmail($email)
    {
        $this->object->setEmail($email);
        $this->expected = $email;
        $this->actual = $this->object->getEmail();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testSetKey
     *
     * @param string $key a valid API key
     *
     * @covers APIApplication::setKey
     *
     * @dataProvider apiKeyDataProvider
     *
     * @return void
     */
    public function testSetKey($key)
    {
        $this->expected = true;
        $this->actual = $this->object->setKey($key);
        $this->assertEquals($this->expected, $this->actual);

    }

    /** apiKeyDataProvider
     *
     * @return array
     */
    public function apiKeyDataProvider()
    {
        return array(
            array(hash('snefru',microtime(true)."a")),
            array(hash('snefru', microtime(true)."b")),
            array(hash('snefru', microtime(true)."c"))
        );
    }


    /** testGetKey
     *
     * @param string $key a valid API key
     *
     * @covers APIApplication::getKey
     *
     * @dataProvider apiKeyDataProvider
     *
     * @return void
     */
    public function testGetKey($key)
    {
        $this->object->setKey($key);
        $this->expected = $key;
        $this->actual = $this->object->getKey();
        $this->assertEquals($this->expected, $this->actual);

    }

    /** testSetName
     *
     * @param string $name a valid name
     *
     * @covers APIApplication::setName
     *
     * @dataProvider goodNameDataProvider
     *
     * @return void
     */
    public function testSetName($name)
    {
        $this->expected = true;
        $this->actual = $this->object->setName($name);
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGetName
     *
     * @param string $name a valid name
     *
     * @covers APIApplication::getName
     *
     * @dataProvider goodNameDataProvider
     *
     * @return void
     */
    public function testGetName($name)
    {
        $this->object->setName($name);
        $this->expected = $name;
        $this->actual = $this->object->getName();
        $this->assertEquals($this->expected, $this->actual);
    }

    /** testGenerate
     *
     * @param string $name a valid name
     *
     * @covers APIApplication::generate
     *
     * @dataProvider goodNameDataProvider
     *
     * @return void
     */
    public function testGenerate($name)
    {
        $this->object->setName($name);
        $this->expected = true;
        $this->actual = $this->object->generate();
        $this->assertEquals($this->expected, $this->actual);
    }
}
