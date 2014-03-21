<?php
/**
 * PHP Version 5.5.3-1ubuntu2
 * Created by PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 11/14/13
 * Time: 12:19 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */

interface JSONObjectGeneratorInterface
{
    /** setRequestOrResponse
     * @param $requestOrResponse
     * @return mixed
     */
    public function setRequestOrResponse( $requestOrResponse );
    public function getRequestOrResponse();

    /** setAgencyOrModel
     * @param $agencyOrModel
     * @return mixed
     */
    public function setAgencyOrModel( $agencyOrModel );
    public function getAgencyOrModel();

    /** setTypes
     * @param $types
     * @return mixed
     */
    public function setTypes( $types );
    public function getTypes();
}
 