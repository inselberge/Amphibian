<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/9/13
 * Time: 5:04 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
interface concreteModelInterface
    extends basicModelInterface
{
    /** instance
     * @param $databaseConnection
     * @return mixed
     */
    static public function instance($databaseConnection);

    /** factory
     * @param $databaseConnection
     * @return mixed
     */
    static public function factory($databaseConnection);
    public function index();

    /** get
     * @param $id
     * @return mixed
     */
    public function get($id);
    public function insert();
    public function getInsertId();
    public function update();

    /** validate
     * @param $id
     * @return mixed
     */
    public function validate($id);

    /** patch
     * @param $key
     * @return mixed
     */
    public function patch( $key );
    public function delete();

    /** checkValue
     * @param $type
     * @param $max
     * @param $value
     * @return mixed
     */
    public function checkValue( $type, $max, $value );

    /** setValue
     * @param $key
     * @param $value
     * @return mixed
     */
    public function setValue($key,$value);
}