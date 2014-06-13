<?php
/**
 * PHP Version 5.4.9-4ubuntu2.2
 * Created by PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 10/11/13
 * Time: 2:16 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once "BasicGenerator.php";
require_once "interfaces".DIRECTORY_SEPARATOR."DecoratorGeneratorInterface.php";
/**
 * Class DecoratorGenerator
 *
 * @category Generator
 * @package  Decorators
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/Amphibian/documentation/DecoratorGenerator
 */
abstract class DecoratorGenerator
    extends BasicGenerator
    implements DecoratorGeneratorInterface
{
    /**
     * @var string agencyOrModelFlag "model" or "agency" only
     */
    protected $agencyOrModelFlag;

    /**  setAgencyOrModelFlag
     *
     * @param string $agencyOrModelFlag "model" or "agency" only
     *
     * @return boolean
     */
    public function setAgencyOrModelFlag( $agencyOrModelFlag )
    {
        try {
            if ( CheckInput::checkNewInput($agencyOrModelFlag) ) {
                if ( $agencyOrModelFlag === "agency" OR $agencyOrModelFlag === "model") {
                    $this->agencyOrModelFlag = $agencyOrModelFlag;
                } else {
                    throw new ExceptionHandler(__METHOD__ . ": agencyOrModelFlag illegal");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": agencyOrModelFlag is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** fetchAll
     *
     * @return bool
     */
    protected function fetchAll()
    {
        try {
            if ( CheckInput::checkNewInput($this->agencyOrModelFlag) ) {
                switch ($this->agencyOrModelFlag)
                {
                case "agency":
                    $this->fetchAllViews();
                    break;
                case "model":
                    $this->fetchAllTables();
                    break;
                default:
                    break;
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": invalid flag.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** fetchAllViews
     *
     * @return bool
     */
    abstract protected function fetchAllViews();

    /** fetchAllTables
     *
     * @return bool
     */
    abstract protected function fetchAllTables();

    /** iterate
     *
     * @return bool
     */
    protected function iterate()
    {
        $this->startFile();
        if ($this->agencyOrModelFlag === "agency") {
            $this->addAgencyRequired();
            $this->addClassComment();
            $this->startAgencyClass();
        }
        if ($this->agencyOrModelFlag === "model") {
            $this->addModelRequired();
            $this->addClassComment();
            $this->startModelClass();
        }
        $this->addBody();
    }

    /** startFile
     *
     * @return void
     */
    protected function startFile()
    {
        $this->buffer='<?php '.PHP_EOL;
        $this->buffer .= '/**' . PHP_EOL;
        $this->buffer .= ' * PHP version ' . PHP_VERSION.PHP_EOL;
        $this->buffer .= ' * Created by Amphibian' . PHP_EOL;
        $this->buffer .= ' * Project: ' .APP_NAME. PHP_EOL;
        $this->buffer .= ' * User: ' . PHP_EOL;
        $this->buffer .= ' * Date: ' . date('m/d/Y').PHP_EOL;
        $this->buffer .= ' * Time: ' . date('H:i:s').PHP_EOL;
        $this->buffer .= ' */' . PHP_EOL;
    }

    /** addAgencyRequired
     *
     * @return void
     */
    protected function addAgencyRequired()
    {
        $this->buffer.='require_once AGENCIES_GENERATED."' . strtolower($this->tableName).'.php";'.PHP_EOL;
        $this->buffer.='require_once "interfaces".DIRECTORY_SEPARATOR."' . $this->tableName.'AgencyDecoratorInterface.php";'.PHP_EOL;
    }

    /** addModelRequired
     *
     * @return void
     */
    protected function addModelRequired()
    {
        $this->buffer.='require_once MODELS_GENERATED."' . strtolower($this->tableName).'.php";'.PHP_EOL;
        $this->buffer.='require_once "interfaces".DIRECTORY_SEPARATOR."' . $this->tableName.'ModelDecoratorInterface.php";'.PHP_EOL;
    }

    /** addClassComment
     *
     * @return void
     */
    protected function addClassComment()
    {
        $this->buffer .= '/**' . PHP_EOL;
        if ($this->agencyOrModelFlag === "agency") {
            $this->buffer .= ' * Class ' . $this->tableName.'AgencyDecorator'. PHP_EOL;
        } else {
            $this->buffer .= ' * Class ' . $this->tableName.'ModelDecorator'. PHP_EOL;
        }
        $this->buffer .= ' *' . PHP_EOL;
        $this->buffer .= ' * @category Decorator' . PHP_EOL;
        $this->buffer .= ' * @package  ' . $this->tableName. PHP_EOL;
        $this->buffer .= ' * @author   ' . PHP_EOL;
        $this->buffer .= ' * @license  ' . PHP_EOL;
        $this->buffer .= ' * @link     ' . PHP_EOL;
        $this->buffer .= ' */' . PHP_EOL;
    }

    /** startAgencyClass
     *
     * @return void
     */
    protected function startAgencyClass()
    {
        $this->buffer.='class '.$this->tableName.'AgencyDecorator'.PHP_EOL;
        $this->buffer.='    implements '.$this->tableName.'AgencyDecoratorInterface'.PHP_EOL;
        $this->buffer.='{'.PHP_EOL . PHP_EOL;
    }

    /** startModelClass
     *
     * @return void
     */
    protected function startModelClass()
    {
        $this->buffer.='class '.$this->tableName.'ModelDecorator'.PHP_EOL;
        $this->buffer.='    implements '.$this->tableName.'ModelDecoratorInterface'.PHP_EOL;
        $this->buffer.='{'.PHP_EOL . PHP_EOL;
    }

    /** addConstruct
     *
     * @return void
     */
    protected function addBody()
    {
        $this->buffer.='    private $_'.$this->tableName.'Decorator;'.PHP_EOL . PHP_EOL;
        $this->buffer.='    /** __construct'.PHP_EOL;
        $this->buffer.='     *'.PHP_EOL;
        $this->buffer.='     * @param object $'.$this->tableName.'Decorator a valid '.$this->tableName.' object'.PHP_EOL;
        $this->buffer.='     */'.PHP_EOL;
        $this->buffer.='    public function __construct($'.$this->tableName.'Decorator)'.PHP_EOL;
        $this->buffer.='    {'.PHP_EOL;
        $this->buffer.='        try {'.PHP_EOL;
        $this->buffer.='            if ( CheckInput::checkSet($'.$this->tableName.'Decorator) ) {'.PHP_EOL;
        $this->buffer.='                $this->_'.$this->tableName.'Decorator = $'.$this->tableName.'Decorator;'.PHP_EOL;
        $this->buffer.='            } else {'.PHP_EOL;
        $this->buffer.='                throw new ExceptionHandler(__METHOD__ . ":object not set.");'.PHP_EOL;
        $this->buffer.='            }'.PHP_EOL;
        $this->buffer.='        } catch ( ExceptionHandler $e ) {'.PHP_EOL;
        $this->buffer.='            $e->execute();'.PHP_EOL;
        $this->buffer.='            return false;'.PHP_EOL;
        $this->buffer.='        }'.PHP_EOL;
        $this->buffer.='        return true;'.PHP_EOL;
        $this->buffer.='    }'.PHP_EOL;
        $this->buffer.='}'.PHP_EOL;
    }
}
//require_once AMPHIBIAN_CONFIG . "Coworks.In.config.inc.php";
//require_once AMPHIBIAN_CONFIG . "InnerAlly.config.inc.php";
////require_once MYSQL; todo: replace these with correct databaseConnectionMySQLi calls
/*
 * Agency Decorators
 *

$ad = DecoratorGenerator::instance($databaseConnection);
$ad->setAgencyOrModelFlag("agency");
$ad->setFileDestination(AGENCIES_DECORATORS);
$ad->execute();
*/
/*
 * Model Decorators
require_once AMPHIBIAN_CONFIG . "InnerAlly.config.inc.php";
//require_once MYSQL; todo: replace these with correct databaseConnectionMySQLi calls
$md = DecoratorGenerator::instance($databaseConnection);
$md->setAgencyOrModelFlag("model");
$md->setFileDestination(MODELS_DECORATORS);
$md->execute();
 *
 */