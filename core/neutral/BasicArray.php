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
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
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
     * * @param $value
     * @return void
     */
    public function append( $value )
    {
    }

    /** remove
     * * @param $value
     * @return void
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
     * @return void
     */
    public function merge( $array )
    {
    }

    /** keySort
     * @return void
     */
    public function keySort()
    {
        $this->array = ksort($this->array);
    }

    /** change_key_case
     * * @param $case
     * @return void
     */
    public function change_key_case( $case )
    {
    }

    /** count_values
     * @return void
     */
    public function count_values()
    {
    }

    /** diff_assoc
     * * @param $array
     * @return void
     */
    public function diff_assoc( $array )
    {
    }

    /** diff_key
     * * @param $array
     * @return void
     */
    public function diff_key( $array )
    {
    }

    /** diff_uassoc
     * * @param $array
     * @param $call
     * @return void
     */
    public function diff_uassoc( $array, $call )
    {
    }

    /** diff_ukey
     * * @param $array
     * @param $call
     * @return void
     */
    public function diff_ukey( $array, $call )
    {
    }

    /** diff
     * @return void
     */
    public function diff()
    {
    }

    /** fill_keys
     * @return void
     */
    public function fill_keys()
    {
    }

    /** fill
     * @return void
     */
    public function fill()
    {
    }

    /** filter
     * @return void
     */
    public function filter()
    {
    }

    /** flip
     * @return void
     */
    public function flip()
    {
    }

    /** intersect_assoc
     * @return void
     */
    public function intersect_assoc()
    {
    }

    /** intersect_key
     * @return void
     */
    public function intersect_key()
    {
    }

    /** intersect_uassoc
     * @return void
     */
    public function intersect_uassoc()
    {
    }

    /** intersect_ukey
     * @return void
     */
    public function intersect_ukey()
    {
    }

    /** intersect
     * @return void
     */
    public function intersect()
    {
    }

    /** key_exists
     * @return void
     */
    public function key_exists()
    {
    }

    /** keys
     * @return void
     */
    public function keys()
    {
    }

    /** map
     * @return void
     */
    public function map()
    {
    }

    /** merge_recursive
     * @return void
     */
    public function merge_recursive()
    {
    }

    /** multisort
     * @return void
     */
    public function multisort()
    {
    }

    /** pad
     * @return void
     */
    public function pad()
    {
    }

    /** pop
     * @return void
     */
    public function pop()
    {
    }

    /** product
     * @return void
     */
    public function product()
    {

    }

    /** push
     * @return void
     */
    public function push()
    {

    }

    /** rand
     * @return void
     */
    public function rand()
    {

    }

    /** reduce
     * @return void
     */
    public function reduce()
    {

    }

    /** replace_recursive
     * @return void
     */
    public function replace_recursive()
    {
    }

    /** replace
     * @return void
     */
    public function replace()
    {
    }

    /** reverse
     * @return void
     */
    public function reverse()
    {
    }

    /** search
     * @return void
     */
    public function search()
    {
    }

    /** shift
     * @return void
     */
    public function shift()
    {
    }

    /** slice
     * @return void
     */
    public function slice()
    {
    }

    /** splice
     * @return void
     */
    public function splice()
    {
    }

    /** sum
     * @return void
     */
    public function sum()
    {
    }

    /** udiff_assoc
     * @return void
     */
    public function udiff_assoc()
    {
    }

    /** udiff_uassoc
     * @return void
     */
    public function udiff_uassoc()
    {
    }

    /** udiff
     * @return void
     */
    public function udiff()
    {
    }

    /** uintersect_assoc
     * @return void
     */
    public function uintersect_assoc()
    {
    }

    /** uintersect_uassoc
     * @return void
     */
    public function uintersect_uassoc()
    {
    }

    /** uintersect
     * @return void
     */
    public function uintersect()
    {
    }

    /** unique
     * @return void
     */
    public function unique()
    {
    }

    /** unshift
     * @return void
     */
    public function unshift()
    {
    }

    /** values
     * @return void
     */
    public function values()
    {
    }

    /** walk_recursive
     * @return void
     */
    public function walk_recursive()
    {
    }

    /** walk
     * @return void
     */
    public function walk()
    {
    }

    /** arsort
     * @return void
     */
    public function arsort()
    {
    }

    /** asort
     * @return void
     */
    public function asort()
    {
    }

    /** compact
     * @return void
     */
    public function compact()
    {
    }

    /** count
     * @return void
     */
    public function count()
    {
    }

    /** current
     * @return void
     */
    public function current()
    {
    }

    /** each
     * @return void
     */
    public function each()
    {
    }

    /** end
     * @return void
     */
    public function end()
    {
    }

    /** extract
     * @return void
     */
    public function extract()
    {
    }

    /** in_array
     * @return void
     */
    public function in_array()
    {
    }

    /** key
     * @return void
     */
    public function key()
    {
    }

    /** krsort
     * @return void
     */
    public function krsort()
    {
    }

    /** ksort
     * @return void
     */
    public function ksort()
    {
    }

    /** natcasesort
     * @return void
     */
    public function natcasesort()
    {
    }

    /** natsort
     * @return void
     */
    public function natsort()
    {
    }

    /** next
     * @return void
     */
    public function next()
    {
    }

    /** pos
     * @return void
     */
    public function pos()
    {
    }

    /** prev
     * @return void
     */
    public function prev()
    {
    }

    /** range
     * @return void
     */
    public function range()
    {
    }

    /** reset
     * @return void
     */
    public function reset()
    {
    }

    /** rsort
     * @return void
     */
    public function rsort()
    {
    }

    /** shuffle
     * @return void
     */
    public function shuffle()
    {
    }

    /** sizeof
     * @return void
     */
    public function sizeof()
    {
    }

    /** sort
     * @return void
     */
    public function sort()
    {
    }

    /** uasort
     * * @param $call
     * @return void
     */
    public function uasort( $call )
    {
    }

    /** uksort
     * * @param $call
     * @return void
     */
    public function uksort( $call )
    {
    }

    /** usort
     * * @param $call
     * @return void
     */
    public function usort( $call )
    {
    }

    /** updateKeys
     * @return void
     */
    protected function updateKeys()
    {
        $this->keys     = array_keys($this->array);
        $this->keyCount = count($this->keys);
    }

    /** updateValues
     * @return void
     */
    protected function updateValues()
    {
        $this->values     = array_values($this->array);
        $this->valueCount = count($this->values);
    }
} 