<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/9/13
 * Time: 7:54 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
interface TableDescriptionInterface
    extends basicInteractionInterface
{
    /** setTableName
     * @param $name
     * @return mixed
     */
    public function setTableName( $name );
    public function execute();
    public function getUniqueKeys();
    public function getTypeFrequencyArray();
    public function getPrimaryKeys();
    public function getNotNullArray();
    public function getIndexKeys();
    public function getForeignKeys();
    public function getFieldTypeArray();
    public function getAutoIncrementField();
    public function getTableArray();
    public function getColumns();

}