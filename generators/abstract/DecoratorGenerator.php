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
        $this->buffer='<?php '."\n";
        $this->buffer .= '/**' . "\n";
        $this->buffer .= ' * PHP version ' . PHP_VERSION."\n";
        $this->buffer .= ' * Created by Amphibian' . "\n";
        $this->buffer .= ' * Project: ' .APP_NAME. "\n";
        $this->buffer .= ' * User: ' . "\n";
        $this->buffer .= ' * Date: ' . date('m/d/Y')."\n";
        $this->buffer .= ' * Time: ' . date('H:i:s')."\n";
        $this->buffer .= ' */' . "\n";
    }

    /** addAgencyRequired
     *
     * @return void
     */
    protected function addAgencyRequired()
    {
        $this->buffer.='require_once AGENCIES_GENERATED."' . strtolower($this->tableName).'.php";'."\n";
        $this->buffer.='require_once "interfaces".DIRECTORY_SEPARATOR."' . $this->tableName.'AgencyDecoratorInterface.php";'."\n";
    }

    /** addModelRequired
     *
     * @return void
     */
    protected function addModelRequired()
    {
        $this->buffer.='require_once MODELS_GENERATED."' . strtolower($this->tableName).'.php";'."\n";
        $this->buffer.='require_once "interfaces".DIRECTORY_SEPARATOR."' . $this->tableName.'ModelDecoratorInterface.php";'."\n";
    }

    /** addClassComment
     *
     * @return void
     */
    protected function addClassComment()
    {
        $this->buffer .= '/**' . "\n";
        if ($this->agencyOrModelFlag === "agency") {
            $this->buffer .= ' * Class ' . $this->tableName.'AgencyDecorator'. "\n";
        } else {
            $this->buffer .= ' * Class ' . $this->tableName.'ModelDecorator'. "\n";
        }
        $this->buffer .= ' *' . "\n";
        $this->buffer .= ' * @category Decorator' . "\n";
        $this->buffer .= ' * @package  ' . $this->tableName. "\n";
        $this->buffer .= ' * @author   ' . "\n";
        $this->buffer .= ' * @license  ' . "\n";
        $this->buffer .= ' * @link     ' . "\n";
        $this->buffer .= ' */' . "\n";
    }

    /** startAgencyClass
     *
     * @return void
     */
    protected function startAgencyClass()
    {
        $this->buffer.='class '.$this->tableName.'AgencyDecorator'."\n";
        $this->buffer.='    implements '.$this->tableName.'AgencyDecoratorInterface'."\n";
        $this->buffer.='{'."\n\n";
    }

    /** startModelClass
     *
     * @return void
     */
    protected function startModelClass()
    {
        $this->buffer.='class '.$this->tableName.'ModelDecorator'."\n";
        $this->buffer.='    implements '.$this->tableName.'ModelDecoratorInterface'."\n";
        $this->buffer.='{'."\n\n";
    }

    /** addConstruct
     *
     * @return void
     */
    protected function addBody()
    {
        $this->buffer.='    private $_'.$this->tableName.'Decorator;'."\n\n";
        $this->buffer.='    /** __construct'."\n";
        $this->buffer.='     *'."\n";
        $this->buffer.='     * @param object $'.$this->tableName.'Decorator a valid '.$this->tableName.' object'."\n";
        $this->buffer.='     */'."\n";
        $this->buffer.='    public function __construct($'.$this->tableName.'Decorator)'."\n";
        $this->buffer.='    {'."\n";
        $this->buffer.='        try {'."\n";
        $this->buffer.='            if ( CheckInput::checkSet($'.$this->tableName.'Decorator) ) {'."\n";
        $this->buffer.='                $this->_'.$this->tableName.'Decorator = $'.$this->tableName.'Decorator;'."\n";
        $this->buffer.='            } else {'."\n";
        $this->buffer.='                throw new ExceptionHandler(__METHOD__ . ":object not set.");'."\n";
        $this->buffer.='            }'."\n";
        $this->buffer.='        } catch ( ExceptionHandler $e ) {'."\n";
        $this->buffer.='            $e->execute();'."\n";
        $this->buffer.='            return false;'."\n";
        $this->buffer.='        }'."\n";
        $this->buffer.='        return true;'."\n";
        $this->buffer.='    }'."\n";
        $this->buffer.='}'."\n";
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