<?php
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-08-23 at 22:51:32.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."../../config/config.inc.php";
require_once AMPHIBIAN_CORE . "BasicController.php";
require_once AMPHIBIAN_DATABASE."Coworks.In.mysql.config.inc.php";
require_once __DIR__."/../baseTest.php";

class basicControllerTest extends BaseTest
{
    /**
     * @var basicController
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        require_once AMPHIBIAN_CONFIG."mysql.cfg.php";
        $this->object = $this->getMockForAbstractClass('BasicController', array($databaseConnection));
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        unset($this->object);
    }

    /**
     * @covers basicController::onLoad
     */
    public function testOnLoad()
    {
        $this->assertEquals(true, $this->object->onLoad());
    }

    /**
     * @covers basicController::setEditMode
     */
    public function testSetEditMode()
    {
        $this->assertEquals(true,$this->object->setEditMode(1));
        $this->assertEquals(true,$this->object->setEditMode(0));
        /*
        $this->setExpectedException('ExceptionHandler');
        try {
            $this->assertEquals(false,$this->object->setEditMode(null));
        } catch ( ExceptionHandler $e ) {
            $this->assertEquals('ExceptionHandler',$this->getExpectedException());
            return ;
        }
        */
    }

    /**
     * @covers basicController::setListMode
     */
    public function testSetListMode()
    {

    }

    /**
     * @covers basicController::setObjectId
     */
    public function testSetObjectId()
    {

    }

    /**
     * @covers basicController::receive
     */
    public function testReceive()
    {

    }

    /**
     * @covers basicController::checkDifferences
     */
    public function testCheckDifferences()
    {

    }

    /**
     * @covers basicController::getDifferences
     */
    public function testGetDifferences()
    {

    }

    /**
     * @covers basicController::acceptViewDataPackage
     */
    public function testAcceptViewDataPackage()
    {

    }

    /**
     * @covers basicController::setAction
     */
    public function testSetAction()
    {

    }

    /**
     * @covers basicController::getAction
     */
    public function testGetAction()
    {

    }

    /**
     * @covers basicController::setActionsAvailable
     */
    public function testSetActionsAvailable()
    {

    }

    /**
     * @covers basicController::getActionsAvailable
     */
    public function testGetActionsAvailable()
    {

    }

    /**
     * @covers basicController::setAgency
     */
    public function testSetAgency()
    {

    }

    /**
     * @covers basicController::getAgency
     */
    public function testGetAgency()
    {

    }

    /**
     * @covers basicController::setModel
     */
    public function testSetModel()
    {

    }

    /**
     * @covers basicController::getModel
     */
    public function testGetModel()
    {

    }

    /**
     * @covers basicController::extractAction
     */
    public function testExtractAction()
    {

    }

    /**
     * @covers basicController::checkAction
     */
    public function testCheckAction()
    {

    }

    /**
     * @covers basicController::handleAction
     */
    public function testHandleAction()
    {

    }
}
