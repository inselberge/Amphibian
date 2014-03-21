<?php
/**
 * PHP Version 5.4.9-4ubuntu2.2
 * Created by PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 9/24/13
 * Time: 2:21 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
interface userLevelCheckInterface
{
    /**
     *
     */
    public function __construct();

    /** setPermitAll
     * @param $permitAll
     * @return mixed
     */
    public function setPermitAll( $permitAll );

    /** setPermitCreate
     * @param $permitCreate
     * @return mixed
     */
    public function setPermitCreate( $permitCreate );

    /** setPermitNone
     * @param $permitNone
     * @return mixed
     */
    public function setPermitNone( $permitNone );

    /** setPermitRead
     * @param $permitRead
     * @return mixed
     */
    public function setPermitRead( $permitRead );

    /** setPermitUpdate
     * @param $permitUpdate
     * @return mixed
     */
    public function setPermitUpdate( $permitUpdate );

    /** setUserType
     * @param $userType
     * @return mixed
     */
    public function setUserType( $userType );
    public function execute();
    public function getResponse();

    /** getSpecificResponse
     * @param $key
     * @return mixed
     */
    public function getSpecificResponse($key);
}
 