<?php
/**
 * PHP Version 5.4.9-4ubuntu2.2
 *
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 9/1/13
 * Time: 9:44 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once "interfaces".DIRECTORY_SEPARATOR."DataMapInterface.php";
require_once "CheckInput.php";
/**
 * Class DataMap
 *
 * @category Helper
 * @package  Core
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/DataMap
 */
class DataMap
    extends CheckInput
    implements DataMapInterface
{
    /**
     * @var array map holds values for $DataMap->map
     */
    protected $map;
    /**
     * @var array arrays the super global arrays that can be used
     */
    static protected $arrays = array("post", "get", "session", "cookie", "server", "file");
    /**
     * @var  DataMap holds values for $DataMap->DataMap
     */
    static public $DataMap;

    /** __construct
     */
    protected function __construct()
    {
        $this->map = array();
    }

    /** instance
     *
     * @return DataMap
     */
    static public function instance()
    {
        if ( !isset(self::$DataMap) ) {
            self::$DataMap = new DataMap(); 
        }
        return self::$DataMap;
    }

    /** initMap
     *
     * @param array $arr the keys of the map
     *
     * @return bool
     */
    public function initMap(array $arr)
    {
        try {
            if ( CheckInput::checkNewInputArray($arr) ) {
                foreach ( $arr as $key) {
                    $this->map[$key]=null;
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": array invalid.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setMapByKey
     * Use this when you want to set specific values to a location,
     * i.e. first_name => post, last_name => post, session_id => session
     *
     * @param array $map an array of values matched to their location
     *
     * @return bool
     */
    public function setMapByKey( array $map)
    {
        try {
            if ( CheckInput::checkNewInputArray($map) ) {
                foreach ($map as $key => $value ) {
                    if ( CheckInput::checkSet($value) ) {
                        $this->map[$key] = $value;
                    }
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": map is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getMapByKey
     *
     * @param string $key the key of the location data you want, i.e. first_name
     *
     * @return mixed
     */
    public function getMapByKey($key)
    {
        try {
            if ( CheckInput::checkNewInput($key) ) {
                $this->checkKey($key);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": key must be set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return $this->map[$key];
    }

    /** checkKey
     *
     * @param string $key the key of the location data you want, i.e. first_name
     *
     * @return bool
     */
    protected function checkKey($key)
    {
        try {
            if ( !array_key_exists($key, $this->map) ) {
                throw new ExceptionHandler(__METHOD__ . ": key does not exist.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**  setMap
     * Use this when you want to set all the locations at once
     *
     * @param array $map an array of values matched to their location
     *
     * @return boolean
     */
    public function setMap( array $map )
    {
        try {
            if ( CheckInput::checkNewInputArray($map) ) {
                $this->map = $map;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": map is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getMap
     *
     * @return mixed
     */
    public function getMap()
    {
        return $this->map;
    }

    /** getMapType
     *
     * @param string $key the key of the location data you want, i.e. first_name
     *
     * @return bool|string
     */
    public function getMapType($key)
    {
        try {
            if ( CheckInput::checkNewInput($key) ) {
                if ( in_array($this->getMapByKey($key), self::$arrays) ) {
                    return "array";
                } else {
                    return "code";
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": type cannot be checked.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }
}
/*
$dm = DataMap::instance();
$arr = array("id", "user_id", "title", "description", "start_time", "end_time", "url", "status", "create_date", "thread", "modify_date", "modify_user", "modify_reason");
$dm->initMap($arr);
$dm->setMapByKey(array("user_id"=>"session","start_time"=> date('Y-m-d H:i:s')));
echo $dm->getMapType("user_id");
echo $dm->getMapType("start_time");
print_r($dm);
*/