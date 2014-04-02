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
        $this->buffer='<?php '."\n";
        $this->addFileComment();
        $this->buffer.='require_once __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."config.inc.php";'."\n";
        $this->buffer.='require_once CORE."BasicAgency.php";'."\n";
        $this->buffer.='require_once CORE_INTERFACES."concreteAgencyInterface.php";'."\n";
    }

    /** addFileComment
     *
     * @return void
     */
    protected function addFileComment()
    {
        $this->buffer .= '/**' . "\n";
        $this->buffer .= ' * PHP version ' . PHP_VERSION."\n";
        $this->buffer .= ' * Created by Amphibian' . "\n";
        $this->buffer .= ' * Project: ' .APP_NAME. "\n";
        $this->buffer .= ' * User: ' . "\n";
        $this->buffer .= ' * Date: ' . date('m/d/Y')."\n";
        $this->buffer .= ' * Time: ' . date('H:i:s')."\n";
        $this->buffer .= ' */' . "\n";
    }
    /** addClassComment
     *
     * @return void
     */
    protected function addClassComment()
    {
        $this->buffer .= '/**' . "\n";
        $this->buffer .= ' * Class ' . $this->tableName.'Agency'. "\n";
        $this->buffer .= ' *' . "\n";
        $this->buffer .= ' * @category Model' . "\n";
        $this->buffer .= ' * @package  ' . $this->tableName. "\n";
        $this->buffer .= ' * @author   ' . "\n";
        $this->buffer .= ' * @license  TBD' . "\n";
        $this->buffer .= ' * @link     TBD' . "\n";
        $this->buffer .= ' */' . "\n";
    }

    /** addClassStart
     *
     * @return void
     */
    protected function addClassStart()
    {
        $this->buffer.='class '.$this->tableName.'Agency'."\n";
        $this->buffer.='    extends BasicAgency'."\n";
        $this->buffer.='    implements concreteAgencyInterface'."\n";
        $this->buffer.='{'."\n\n";
    }

    /** addAcceptableVariable
     *
     * @return void
     */
    protected function addAcceptableVars()
    {
        $this->buffer.='    /**'."\n";
        $this->buffer.='     * @var array acceptableVars holds the acceptable variables for this agency'."\n";
        $this->buffer.='     */'."\n";
        $this->buffer.='    protected $acceptableVars = array ('."\n";
        if ( $this->setTableColumns() ) {
            foreach ($this->tableColumns as $key => $column) {
                if ( $key == 0 ) {
                    $this->buffer.='        "'.$column.'"'."\n";
                } else {
                    $this->buffer.='        , "'.$column.'"'."\n";
                }
            }
        }
        $this->buffer.='    );'."\n";
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
        $this->buffer.='    public static $'.$this->tableName.'Agency;'."\n\n";
    }

    /** addStaticInstance
     *
     * @return void
     */
    protected function addStaticInstance()
    {
        $this->buffer.='    static public function instance($databaseConnection)'."\n";
        $this->buffer.='    {'."\n";
        $this->buffer.='        if(!isset(self::$'.$this->tableName.'Agency)){'."\n";
        $this->buffer.='            self::$'.$this->tableName.'Agency = new '.$this->tableName.'Agency($databaseConnection);'."\n";
        $this->buffer.='        }'."\n";
        $this->buffer.='        return self::$'.$this->tableName.'Agency;'."\n";
        $this->buffer.='    }'."\n\n";
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