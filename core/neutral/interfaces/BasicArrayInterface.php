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

interface BasicArrayInterface
{
    static public function instance();
    static public function factory();

    /** append
     * @param $value
     * @return mixed
     */
    public function append( $value );

    /** remove
     * @param $value
     * @return mixed
     */
    public function remove( $value );

    /** chunk
     * @param $size
     * @param bool $preserve
     * @return mixed
     */
    public function chunk( $size, $preserve = false );

    /** combine
     * @param $values
     * @return mixed
     */
    public function combine( $values );

    /** column
     * @param $key
     * @param null $index
     * @return mixed
     */
    public function column( $key, $index = null );

    /** merge
     * @param $array
     * @return mixed
     */
    public function merge( $array );
    public function keySort();

    /** change_key_case
     * @param $case
     * @return mixed
     */
    public function change_key_case( $case );
    public function count_values();

    /** diff_assoc
     * @param $array
     * @return mixed
     */
    public function diff_assoc( $array );

    /** diff_key
     * @param $array
     * @return mixed
     */
    public function diff_key( $array );

    /** diff_uassoc
     * @param $array
     * @param $call
     * @return mixed
     */
    public function diff_uassoc( $array, $call );

    /** diff_ukey
     * @param $array
     * @param $call
     * @return mixed
     */
    public function diff_ukey( $array, $call );
    public function diff();
    public function fill_keys();
    public function fill();
    public function filter();
    public function flip();
    public function intersect_assoc();
    public function intersect_key();
    public function intersect_uassoc();
    public function intersect_ukey();
    public function intersect();
    public function key_exists();
    public function keys();
    public function map();
    public function merge_recursive();
    public function multisort();
    public function pad();
    public function pop();
    public function product();
    public function push();
    public function rand();
    public function reduce();
    public function replace_recursive();
    public function replace();
    public function reverse();
    public function search();
    public function shift();
    public function slice();
    public function splice();
    public function sum();
    public function udiff_assoc();
    public function udiff_uassoc();
    public function udiff();
    public function uintersect_assoc();
    public function uintersect_uassoc();
    public function uintersect();
    public function unique();
    public function unshift();
    public function values();
    public function walk_recursive();
    public function walk();
    public function arsort();
    public function asort();
    public function compact();
    public function count();
    public function current();
    public function each();
    public function end();
    public function extract();
    public function in_array();
    public function key();
    public function krsort();
    public function ksort();
    public function natcasesort();
    public function natsort();
    public function next();
    public function pos();
    public function prev();
    public function range();
    public function reset();
    public function rsort();
    public function shuffle();
    public function sizeof();
    public function sort();

    /** uasort
     * @param $call
     * @return mixed
     */
    public function uasort( $call );

    /** uksort
     * @param $call
     * @return mixed
     */
    public function uksort( $call );

    /** usort
     * @param $call
     * @return mixed
     */
    public function usort( $call );
}
 