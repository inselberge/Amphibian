<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/24/13
 * Time: 9:37 AM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once AMPHIBIAN_CORE_ABSTRACT . "BasicFrontController.php";
require_once "interfaces".DIRECTORY_SEPARATOR."BasicFrontControllerMySQLiInterface.php";
/**
 * Class BasicFrontControllerMySQLi
 *
 * @category BasicFrontController
 * @package  BasicFrontControllerMySQLi
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/BasicFrontControllerMySQLi
 */
class BasicFrontControllerMySQLi
    extends BasicFrontController
    implements BasicFrontControllerMySQLiInterface
{
    /**
     * @var object BasicFrontControllerMySQLi a singleton instance of this class
     */
    static public $BasicFrontControllerMySQLi;

    /** __construct
     *
     * @param string $url a URL
     */
    public function __construct($url)
    {
        try {
            if ( isset($_SERVER["REQUEST_METHOD"]) ) {
                $this->requestMethod = $_SERVER["REQUEST_METHOD"];
                $this->checkXHTTP();
            }
            $this->dataPackage = new dataPackage();
            if ( CheckInput::checkNewInput($url) ) {
                if ( $this->initURL($url) ) {
                    if ( $this->initParameters($this->path) ) {
                        $this->extractParameters();
                    }
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": URL required!");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** instance
     *
     * @param string $url a URL
     *
     * @return BasicFrontControllerMySQLi
     */
    static public function instance($url)
    {
        if ( !isset(self::$BasicFrontControllerMySQLi) ) {
            self::$BasicFrontControllerMySQLi = new BasicFrontControllerMySQLi($url);
        }
        return self::$BasicFrontControllerMySQLi;
    }

    /** factory
     *
     * @param string $url a URL
     *
     * @return BasicFrontControllerMySQLi
     */
    static public function factory($url)
    {
        return new BasicFrontControllerMySQLi($url);
    }

    /** cascadeView
     *
     * @param array $locations an array of locations to look for the views
     *
     * @return bool
     */
    public function cascadeView(array $locations)
    {
        try {
            if (CheckInput::checkNewInputArray($locations)) {
                foreach ($locations as $location) {
                    if (file_exists(
                        $location . $this->controllerName . '.' .
                        "$this->deviceType" .
                        "$this->renderMethod"
                    )
                    ) {
                        include_once "$location" .
                            "$this->controllerName" .
                            '.' .
                            "$this->deviceType" .
                            "BasicFrontControllerMySQLi.php";
                        return true;
                    }
                }
                throw new ExceptionHandler(__METHOD__ . ": all locations invalid.");
            } else {
                throw new ExceptionHandler(__METHOD__ . ": location must be given.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
    }
}
/*
require_once __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."config.inc.php";
require_once __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."Coworks.In.config.inc.php";
//require_once MYSQL; todo: replace these with correct databaseConnectionMySQLi calls
*/
/*
 * A simple testing example for show
$bfc = BasicFrontControllerMySQLi::instance("http://coworks.in/Geekdom/user/show/id/587");
$bfc->initController($databaseConnection);
$bfc->execute();
 */

/*
 * A simple testing example for search
$bfc = BasicFrontControllerMySQLi::instance("http://coworks.in/Geekdom/user/search/where/id/eq/587");
$bfc->initController($databaseConnection);
$bfc->execute();
 */

/*
 * A simple testing example for list
 *  $bfc = BasicFrontControllerMySQLi::instance("http://coworks.in/Geekdom/user/browse/limit/25/offset/50");
$bfc->initController($databaseConnection);
$bfc->execute();
 */

/*
 * A simple testing example for insert
 *
 *
$bfc = BasicFrontControllerMySQLi::instance("http://coworks.in/Geekdom/user/insert/first_name/Tex/last_name/Morgan/email/texmorgan@gmail.com/");
$bfc->initController($databaseConnection);
$bfc->execute();
*/

/*
 * A simple testing example for update
 *  $bfc = BasicFrontControllerMySQLi::instance("http://coworks.in/Geekdom/user/update/id/587/first_name/Carl");
$bfc->initController($databaseConnection);
$bfc->execute();
 */

/*
 * A simple testing example for validate
 * $bfc = BasicFrontControllerMySQLi::instance("http://coworks.in/Geekdom/user/validate/id/587");
$bfc->initController($databaseConnection);
$bfc->execute();
 */

/*
 * A simple testing example for index
$bfc = BasicFrontControllerMySQLi::instance("http://coworks.in/Geekdom");
$bfc->setDefaultController("Coworking_Space");
$bfc->cascadeController(array(CONTROLLERS_CUSTOM,CONTROLLERS_GENERATED));
$bfc->initController($databaseConnection);
$bfc->execute();
 */