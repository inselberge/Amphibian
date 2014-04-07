<?php
/**
 * PHP Version: ${PHP_VERSION}
 * Created by PhpStorm.
 * User: carl
 * Date: 1/21/14
 * Time: 9:59 AM
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once AMPHIBIAN_CORE_ABSTRACT . "BasicAgency.php";
require_once AMPHIBIAN_CORE_MYSQLI."databaseQueryMySQLi.php";
require_once "interfaces".DIRECTORY_SEPARATOR."BasicAgencyMySQLiInterface.php";
/**
 * Class BasicAgencyMySQLi
 *
 * @category BasicAgency
 * @package  BasicAgencyMySQLi
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
* @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/
 */
abstract class BasicAgencyMySQLi
    extends BasicAgency
    implements BasicAgencyMySQLiInterface
{
    /** prepQuery
     *
     * @return bool
     */
    protected function prepQuery()
    {
        $this->query = databaseQueryMySQLi::instance($this->connection);
        if (isset($this->query)) {
            return true;
        } else {
            return false;
        }
    }

    /** acceptArgumentsDataPackage
     *
     * @param object $dataPackage the dataPackage the Agency needs
     *
     * @return bool
     */
    public function acceptArgumentsDataPackage($dataPackage)
    {
        try {
            if ($this->checkDataPackage($dataPackage)) {
                $this->getWhereClauses($dataPackage);
                $this->getGroupByClauses($dataPackage);
                $this->getHavingClauses($dataPackage);
                $this->getOrderByClauses($dataPackage);
                $this->getLimitClauses($dataPackage);
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getWhereClauses
     *
     * @param object $dataPackage the dataPackage to check for Where
     *
     * @return void
     */
    protected function getWhereClauses($dataPackage)
    {
        $this->argument = $dataPackage->getSpecificQueryArguments("WHERE");
        if (isset($this->argument)) {
            $this->addToQueryStringAddendum("WHERE " . $this->argument);
        }
        unset($this->argument);
    }

    /** getGroupByClauses
     *
     * @param object $dataPackage the dataPackage to check for Group By
     *
     * @return void
     */
    protected function getGroupByClauses($dataPackage)
    {
        $this->argument = $dataPackage->getSpecificQueryArguments("GROUP");
        if (isset($this->argument)) {
            $this->addToQueryStringAddendum("GROUP BY " . $this->argument);
        }
        unset($this->argument);
    }

    /** getHavingClauses
     *
     * @param object $dataPackage the dataPackage to check for Having
     *
     * @return void
     */
    protected function getHavingClauses($dataPackage)
    {
        $this->argument = $dataPackage->getSpecificQueryArguments("HAVING");
        if (isset($this->argument)) {
            $this->addToQueryStringAddendum("HAVING " . $this->argument);
        }
        unset($this->argument);
    }

    /** getOrderByClauses
     *
     * @param object $dataPackage the dataPackage to check for Ordering
     *
     * @return void
     */
    protected function getOrderByClauses($dataPackage)
    {
        $this->argument = $dataPackage->getSpecificQueryArguments("ORDER");
        if (isset($this->argument)) {
            $this->addToQueryStringAddendum("ORDER BY " . $this->argument);
        }
        unset($this->argument);
    }

    /** getLimitClauses
     *
     * @param object $dataPackage the dataPackage to check for Limits
     *
     * @return void
     */
    protected function getLimitClauses($dataPackage)
    {
        $this->argument = $dataPackage->getSpecificQueryArguments("LIMIT");
        if (isset($this->argument)) {
            $this->addToQueryStringAddendum("LIMIT " . $this->argument);
        }
        unset($this->argument);
    }

}