<?php
/**
 * PHP Version 5.5.3-1ubuntu2
 * Created by PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 11/18/13
 * Time: 4:22 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR 
    . ".." . DIRECTORY_SEPARATOR 
    . ".." . DIRECTORY_SEPARATOR 
    . "config" . DIRECTORY_SEPARATOR 
    . "config.inc.php";
require_once "CheckInput.php";
require_once "interfaces".DIRECTORY_SEPARATOR."BasicArrayInterface.php";
/**
 * Class BasicArray
 *
 * @category Core
 * @package  BasicArray
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/Amphibian/documentation/BasicArray
 */
class BasicArray
    implements BasicArrayInterface
{
    /**
     * @var array keys all the keys in the array
     */
    protected $keys = array();
    /**
     * @var array values all the values in the array
     */
    protected $values = array();
    /**
     * @var integer keyCount the number of keys in the array
     */
    protected $keyCount = 0;
    /**
     * @var integer valueCount the number of values in the array
     */
    protected $valueCount = 0;
    /**
     * @var int index the current element to look at in the array
     */
    protected $index = 0;
    /**
     * @var array unique all the unique values
     */
    protected $unique = array();
    /**
     * @var array array the array we are manipulating
     */
    protected $array = array();
    /**
     * @var object BasicArray a singleton instances of this class
     */
    static public $BasicArray;

    /** __construct
     */
    protected function __construct()
    {
    }

    /** instance
     *
     * @return BasicArray
     */
    static public function instance()
    {
        if ( !isset(self::$BasicArray) ) {
            self::$BasicArray = new BasicArray();
        }
        return self::$BasicArray;
    }

    /** factory
     *
     * @return BasicArray
     */
    static public function factory()
    {
        return new BasicArray();
    }

    /** append
     * 
     * @param $value
     * 
     * @return bool
     */
    public function append( $value )
    {
    }

    /** remove
     *
     * @param $value
     *
     * @return bool
     */
    public function remove( $value )
    {
    }

    /** chunk
     * * @param $size
     * @param bool $preserve
     * @return array|bool
     */
    public function chunk( $size, $preserve = false )
    {
        try {
            if ( CheckInput::checkNewInput($size) ) {
                return array_chunk($this->array, $size, $preserve);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": size required.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** combine
     * * @param $values
     * @return array|bool|mixed
     */
    public function combine( $values )
    {
        try {
            if ( CheckInput::checkNewInputArray($values) ) {
                if ( $this->keyCount === count($values) ) {
                    return array_combine($this->array, $values);
                } else {
                    throw new ExceptionHandler(__METHOD__ . ": unmatched arrays.");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": values required.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** column
     * * @param $key
     * @param null $index
     * @return bool
     */
    public function column( $key, $index = null )
    {
        try {
            if ( CheckInput::checkNewInput($key) ) {
                return array_column($this->array, $key, $index);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": key required.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** merge
     * * @param $array
     * @return bool
     */
    public function merge( $array )
    {
    }

    /** keySort
     * @return bool
     */
    public function keySort()
    {
        $this->array = ksort($this->array);
    }

    /** change_key_case
     * * @param $case
     * @return bool
     */
    public function change_key_case( $case )
    {
    }

    /** count_values
     * @return bool
     */
    public function count_values()
    {
    }

    /** diff_assoc
     * * @param $array
     * @return bool
     */
    public function diff_assoc( $array )
    {
    }

    /** diff_key
     * * @param $array
     * @return bool
     */
    public function diff_key( $array )
    {
    }

    /** diff_uassoc
     * * @param $array
     * @param $call
     * @return bool
     */
    public function diff_uassoc( $array, $call )
    {
    }

    /** diff_ukey
     * * @param $array
     * @param $call
     * @return bool
     */
    public function diff_ukey( $array, $call )
    {
    }

    /** diff
     * @return bool
     */
    public function diff()
    {
    }

    /** fill_keys
     * @return bool
     */
    public function fill_keys()
    {
    }

    /** fill
     * @return bool
     */
    public function fill()
    {
    }

    /** filter
     * @return bool
     */
    public function filter()
    {
    }

    /** flip
     * @return bool
     */
    public function flip()
    {
    }

    /** intersect_assoc
     * @return bool
     */
    public function intersect_assoc()
    {
    }

    /** intersect_key
     * @return bool
     */
    public function intersect_key()
    {
    }

    /** intersect_uassoc
     * @return bool
     */
    public function intersect_uassoc()
    {
    }

    /** intersect_ukey
     * @return bool
     */
    public function intersect_ukey()
    {
    }

    /** intersect
     * @return bool
     */
    public function intersect()
    {
    }

    /** key_exists
     * @return bool
     */
    public function key_exists()
    {
    }

    /** keys
     * @return bool
     */
    public function keys()
    {
    }

    /** map
     * @return bool
     */
    public function map()
    {
    }

    /** merge_recursive
     * @return bool
     */
    public function merge_recursive()
    {
    }

    /** multisort
     * @return bool
     */
    public function multisort()
    {
    }

    /** pad
     * @return bool
     */
    public function pad()
    {
    }

    /** pop
     * @return bool
     */
    public function pop()
    {
    }

    /** product
     * @return bool
     */
    public function product()
    {

    }

    /** push
     * @return bool
     */
    public function push()
    {

    }

    /** rand
     * @return bool
     */
    public function rand()
    {

    }

    /** reduce
     * @return bool
     */
    public function reduce()
    {

    }

    /** replace_recursive
     * @return bool
     */
    public function replace_recursive()
    {
    }

    /** replace
     * @return bool
     */
    public function replace()
    {
    }

    /** reverse
     * @return bool
     */
    public function reverse()
    {
    }

    /** search
     * @return bool
     */
    public function search()
    {
    }

    /** shift
     * @return bool
     */
    public function shift()
    {
    }

    /** slice
     * @return bool
     */
    public function slice()
    {
    }

    /** splice
     * @return bool
     */
    public function splice()
    {
    }

    /** sum
     * @return bool
     */
    public function sum()
    {
    }

    /** udiff_assoc
     * @return bool
     */
    public function udiff_assoc()
    {
    }

    /** udiff_uassoc
     * @return bool
     */
    public function udiff_uassoc()
    {
    }

    /** udiff
     * @return bool
     */
    public function udiff()
    {
    }

    /** uintersect_assoc
     * @return bool
     */
    public function uintersect_assoc()
    {
    }

    /** uintersect_uassoc
     * @return bool
     */
    public function uintersect_uassoc()
    {
    }

    /** uintersect
     * @return bool
     */
    public function uintersect()
    {
    }

    /** unique
     * @return bool
     */
    public function unique()
    {
    }

    /** unshift
     * @return bool
     */
    public function unshift()
    {
    }

    /** values
     * @return bool
     */
    public function values()
    {
    }

    /** walk_recursive
     * @return bool
     */
    public function walk_recursive()
    {
    }

    /** walk
     * @return bool
     */
    public function walk()
    {
    }

    /** arsort
     * @return bool
     */
    public function arsort()
    {
    }

    /** asort
     * @return bool
     */
    public function asort()
    {
    }

    /** compact
     * @return bool
     */
    public function compact()
    {
    }

    /** count
     * @return bool
     */
    public function count()
    {
    }

    /** current
     * @return bool
     */
    public function current()
    {
    }

    /** each
     * @return bool
     */
    public function each()
    {
    }

    /** end
     * @return bool
     */
    public function end()
    {
    }

    /** extract
     * @return bool
     */
    public function extract()
    {
    }

    /** in_array
     * @return bool
     */
    public function in_array()
    {
    }

    /** key
     * @return bool
     */
    public function key()
    {
    }

    /** krsort
     * @return bool
     */
    public function krsort()
    {
    }

    /** ksort
     * @return bool
     */
    public function ksort()
    {
    }

    /** natcasesort
     * @return bool
     */
    public function natcasesort()
    {
    }

    /** natsort
     * @return bool
     */
    public function natsort()
    {
    }

    /** next
     * @return bool
     */
    public function next()
    {
    }

    /** pos
     * @return bool
     */
    public function pos()
    {
    }

    /** prev
     * @return bool
     */
    public function prev()
    {
    }

    /** range
     * @return bool
     */
    public function range()
    {
    }

    /** reset
     * @return bool
     */
    public function reset()
    {
    }

    /** rsort
     * @return bool
     */
    public function rsort()
    {
    }

    /** shuffle
     * @return bool
     */
    public function shuffle()
    {
    }

    /** sizeof
     * @return bool
     */
    public function sizeof()
    {
    }

    /** sort
     * @return bool
     */
    public function sort()
    {
    }

    /** uasort
     *
     * @param $call
     *
     * @return bool
     */
    public function uasort( $call )
    {
    }

    /** uksort
     *
     * @param $call
     *
     * @return bool
     */
    public function uksort( $call )
    {
    }

    /** usort
     *
     * @param $call
     *
     * @return bool
     */
    public function usort( $call )
    {
    }

    /** updateKeys
     * @return bool
     */
    protected function updateKeys()
    {
        $this->keys     = array_keys($this->array);
        $this->keyCount = count($this->keys);
    }

    /** updateValues
     * @return bool
     */
    protected function updateValues()
    {
        $this->values     = array_values($this->array);
        $this->valueCount = count($this->values);
    }
} 