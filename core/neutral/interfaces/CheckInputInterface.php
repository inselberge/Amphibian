<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/9/13
 * Time: 5:07 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
interface CheckInputInterface
{
    /** checkNewInput
     * @param $value
     * @return mixed
     */
    static public function checkNewInput( $value );

    /** checkNewBoolean
     *
     * @param mixed $value the value to check
     *
     * @return bool
     */
    static public function checkNewBoolean($value);

    /** checkNewCallable
     *
     * @param mixed $value the value to check
     * @param bool $syntax_only If set to TRUE the function only verifies that name might be a function or method
     * @param null $callable_name
     *
     * @return bool
     */
    static public function checkNewCallable($value, $syntax_only = false, &$callable_name = null);

    /** checkNewFloat
     *
     * @param mixed $value the value to check
     * @param bool $unsigned true = unsigned; false = signed
     * @param null|int $min the minimum value
     * @param null|int $max the maximum value
     * @param null|int $precision the number of decimal places
     *
     * @return bool
     */
    static public function checkNewFloat($value, $unsigned = null, $min = null, $max = null, $precision = null);

    /** checkNewInt
     *
     * @param mixed $value the value to check
     * @param bool $unsigned true = unsigned; false = signed
     * @param null|int $min the minimum value
     * @param null|int $max the maximum value
     *
     * @return bool
     */
    static public function checkNewInt($value, $unsigned = false, $min = null, $max = null);

    /** checkNewNumeric
     *
     * @param mixed $value the value to check
     *
     * @return bool
     */
    static public function checkNewNumeric($value);

    /** checkNewResource
     *
     * @param mixed $value the value to check
     *
     * @return bool
     */
    static public function checkNewResource($value);

    /** checkNewString
     *
     * @param mixed $value the value to check
     *
     * @param null|int $min minimum number of characters
     *
     * @param null|int $max maximum number of characters
     *
     * @return bool
     */
    static public function checkNewString($value, $min = null, $max = null);

    /** checkNewInputArray
     * @param $array
     * @return mixed
     */
    static public function checkNewInputArray( $array );

    /** checkSet
     * @param $key
     * @return mixed
     */
    static public function checkSet($key);

    /** checkSetArray
     * @param $array
     * @return mixed
     */
    static public function checkSetArray($array);
}