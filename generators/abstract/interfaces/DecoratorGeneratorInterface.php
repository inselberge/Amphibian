<?php
/**
 * PHP Version 5.4.9-4ubuntu2.2
 * Created by PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 10/11/13
 * Time: 2:23 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once "BasicGeneratorInterface.php";

/**
 * Interface DecoratorGeneratorInterface
 *
 * @category ${NAMESPACE}
 * @package  DecoratorGeneratorInterface
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated
 * @link     documentation/DecoratorGeneratorInterface
 */
interface DecoratorGeneratorInterface
    extends BasicGeneratorInterface
{
    /** setAgencyOrModelFlag
     * @param $agencyOrModelFlag
     * @return mixed
     */
    public function setAgencyOrModelFlag( $agencyOrModelFlag );
}
 