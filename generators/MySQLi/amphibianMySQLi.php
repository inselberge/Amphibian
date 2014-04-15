<?php
/**
 * Created by JetBrains PhpStorm.
 * User: carl
 * Date: 4/10/13
 * Time: 9:07 AM
 * To change this template use File | Settings | File Templates.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once AMPHIBIAN_GENERATORS_ABSTRACT."amphibian.php";
require_once "interfaces".DIRECTORY_SEPARATOR."amphibianMySQLiInterface.php";

/**
 * Class AmphibianMySQLi
 *
 * @category
 * @package  AmphibianMySQLi
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
* @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/
 */
class AmphibianMySQLi
    extends Amphibian
    implements amphibianMySQLiInterface
{

    /** __construct
     */
    protected function __construct()
    {
    }


    /** instance
     *
     * @return Amphibian|AmphibianMySQLi
     */
    static public function instance()
    {
        if ( isset(self::$amphibian) ) {
        } else {
            self::$amphibian = new AmphibianMySQLi();
        }
        return self::$amphibian;
    }

    /** loadTableNames
     *
     * @return void
     */
    protected function loadTableNames()
    {
        $this->tableNames = $this->connection->getTables();
    }

    /** execute
     *
     * @return void
     */
    public function execute()
    {
        if ( $this->actionsSelected["Stored Procedures"] === true ) {
            $this->runSprocGenerator();
        }
        if ( $this->actionsSelected["Database Views"] === true ) {
            $this->runViewGenerator();
        }
        if ( $this->actionsSelected["Models"] === true ) {
            $this->runClassGenerator();
        }
        if ( $this->actionsSelected["Forms"] === true ) {
            $this->runFormGenerator();
        }
        if ( $this->actionsSelected["User Interface"] === true ) {
            $this->runUserInteractionGenerator();
        }
        if ( $this->actionsSelected["Browse"] === true ) {
            $this->runBrowseGenerator();
        }
    }

    /** runSprocGenerator
     *
     * @return void
     */
    protected function runSprocGenerator()
    {
        $this->currentStep = SprocGeneratorMySQLi::instance($this->connection);
        $this->currentStep->setTableNames($this->tablesToSourceChanges);
        $this->currentStep->execute();
    }

    /** runViewGenerator
     *
     * @return void
     */
    protected function runViewGenerator()
    {
        $this->currentStep = StandardViewGeneratorMySQLi::instance($this->connection);
        $this->currentStep->setTableNames($this->tablesToSourceChanges);
        $this->currentStep->execute();
    }

    /** runClassGenerator
     *
     * @return void
     */
    protected function runClassGenerator()
    {
        $this->currentStep = ClassGeneratorMySQLi::instance($this->connection);
        $this->currentStep->setTableNames($this->tablesToSourceChanges);
        $this->currentStep->execute();
    }

    /** runUserInteractionGenerator
     *
     * @return void
     */
    protected function runUserInteractionGenerator()
    {
        $this->currentStep = UIGeneratorMySQLi::instance($this->connection);
        $this->currentStep->setTableNames($this->tablesToSourceChanges);
        $this->currentStep->execute();
    }

    /** runFormGenerator
     *
     * @return void
     */
    protected function runFormGenerator()
    {
        $this->currentStep = FormGeneratorMySQLi::instance($this->connection);
        $this->currentStep->setTableNames($this->tablesToSourceChanges);
        $this->currentStep->execute();
    }

    /** runBrowseGenerator
     *
     * @return void
     */
    protected function runBrowseGenerator()
    {
        $this->currentStep = BrowseGeneratorMySQLi::instance($this->connection);
        $this->currentStep->setTableNames($this->tablesToSourceChanges);
        $this->currentStep->execute();
    }

    /** printResults
     *
     * @return void
     */
    public function printResults()
    {

    }
}
$amp = AmphibianMySQLi::instance();
$amp->execute();
$amp->show();