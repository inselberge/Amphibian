<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/13/13
 * Time: 8:37 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once "BasicGenerator.php";
require_once "interfaces".DIRECTORY_SEPARATOR."agencyGeneratorInterface.php";
/**
 * Class AgencyGenerator
 * 
 * @category Generator
 * @package  Agency
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/AgencyGenerator
 */
abstract class AgencyGenerator
    extends BasicGenerator
    implements agencyGeneratorInterface
{
    /** addPHPTag
     *
     * @return void
     */
    protected function addPHPTag()
    {
        $this->buffer='<?php '.PHP_EOL;
        $this->addFileComment();
        $this->buffer.='require_once __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."config.inc.php";'.PHP_EOL;
        $this->buffer.='require_once CORE."BasicAgency.php";'.PHP_EOL;
        $this->buffer.='require_once CORE_INTERFACES."concreteAgencyInterface.php";'.PHP_EOL;
    }

    /** addFileComment
     *
     * @return void
     */
    protected function addFileComment()
    {
        $this->buffer .= '/**' . PHP_EOL;
        $this->buffer .= ' * PHP version ' . PHP_VERSION.PHP_EOL;
        $this->buffer .= ' * Created by Amphibian' . PHP_EOL;
        $this->buffer .= ' * Project: ' .APP_NAME. PHP_EOL;
        $this->buffer .= ' * User: ' . PHP_EOL;
        $this->buffer .= ' * Date: ' . date('m/d/Y').PHP_EOL;
        $this->buffer .= ' * Time: ' . date('H:i:s').PHP_EOL;
        $this->buffer .= ' */' . PHP_EOL;
    }
    /** addClassComment
     *
     * @return void
     */
    protected function addClassComment()
    {
        $this->buffer .= '/**' . PHP_EOL;
        $this->buffer .= ' * Class ' . $this->tableName.'Agency'. PHP_EOL;
        $this->buffer .= ' *' . PHP_EOL;
        $this->buffer .= ' * @category Model' . PHP_EOL;
        $this->buffer .= ' * @package  ' . $this->tableName. PHP_EOL;
        $this->buffer .= ' * @author   ' . PHP_EOL;
        $this->buffer .= ' * @license  TBD' . PHP_EOL;
        $this->buffer .= ' * @link     TBD' . PHP_EOL;
        $this->buffer .= ' */' . PHP_EOL;
    }

    /** addClassStart
     *
     * @return void
     */
    protected function addClassStart()
    {
        $this->buffer.='class '.$this->tableName.'Agency'.PHP_EOL;
        $this->buffer.='    extends BasicAgency'.PHP_EOL;
        $this->buffer.='    implements concreteAgencyInterface'.PHP_EOL;
        $this->buffer.='{'.PHP_EOL . PHP_EOL;
    }

    /** addAcceptableVariable
     *
     * @return void
     */
    protected function addAcceptableVars()
    {
        $this->buffer.='    /**'.PHP_EOL;
        $this->buffer.='     * @var array acceptableVars holds the acceptable variables for this agency'.PHP_EOL;
        $this->buffer.='     */'.PHP_EOL;
        $this->buffer.='    protected $acceptableVars = array ('.PHP_EOL;
        if ( $this->setTableColumns() ) {
            foreach ($this->tableColumns as $key => $column) {
                if ( $key === 0 ) {
                    $this->buffer.='        "'.$column.'"'.PHP_EOL;
                } else {
                    $this->buffer.='        , "'.$column.'"'.PHP_EOL;
                }
            }
        }
        $this->buffer.='    );'.PHP_EOL;
    }

    /** setTableColumns
     *
     * @return bool
     */
    abstract protected function setTableColumns();

    /** addStaticVariable
     *
     * @return void
     */
    protected function addStaticVariable()
    {
        $this->buffer.='    public static $'.$this->tableName.'Agency;'.PHP_EOL . PHP_EOL;
    }

    /** addStaticInstance
     *
     * @return void
     */
    protected function addStaticInstance()
    {
        $this->buffer.='    static public function instance($databaseConnection)'.PHP_EOL;
        $this->buffer.='    {'.PHP_EOL;
        $this->buffer.='        if(!isset(self::$'.$this->tableName.'Agency)){'.PHP_EOL;
        $this->buffer.='            self::$'.$this->tableName.'Agency = new '.$this->tableName.'Agency($databaseConnection);'.PHP_EOL;
        $this->buffer.='        }'.PHP_EOL;
        $this->buffer.='        return self::$'.$this->tableName.'Agency;'.PHP_EOL;
        $this->buffer.='    }'.PHP_EOL . PHP_EOL;
    }

    /** addForkQuery
     *
     * @return void
     */
    abstract protected function addForkQuery();

    /** addClassEnd
     *
     * @return void
     */
    protected function addClassEnd()
    {
        $this->buffer.='}';
    }
}
/*
 * An example of Agency Generation
 *
 *
//require_once AMPHIBIAN_CONFIG."Coworks.In.config.inc.php";
//require_once AMPHIBIAN_CONFIG."InnerAlly.config.inc.php";
//require_once MYSQL; todo: replace these with correct databaseConnectionMySQLi calls
$ag = AgencyGenerator::instance($databaseConnection);
//$ag->setTableName("viewNet_Promoter_Score");
$ag->execute();
 */