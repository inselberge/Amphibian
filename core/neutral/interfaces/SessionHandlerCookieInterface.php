<?php
/**
 * PHP version 5.4.17
 * Created by JetBrains PhpStorm.
 * User: carl
 * Date: 9/17/13
 * Time: 11:36 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated
 */

interface SessionHandlerCookieInterface
{
    static public function instance();

    /** open
     * @param $savePath
     * @return mixed
     */
    public function open($savePath);

    /** read
     * @param $id
     * @return mixed
     */
    public function read($id);

    /** write
     * @param $id
     * @param $data
     * @return mixed
     */
    public function write($id, $data);

    /** destroy
     * @param $id
     * @return mixed
     */
    public function destroy($id);
}