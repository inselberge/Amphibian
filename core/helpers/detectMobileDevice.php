<?php
/**
 * PHP Version 5.4.9-4ubuntu2.2
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 8/22/13
 * Time: 2:46 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
/** detectMobileDevice()
 *
 * @return bool
 */
function detectMobileDevice()
{
    if ( isset($_SERVER['HTTP_USER_AGENT']) ) {
        if ( preg_match('/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i', $_SERVER['HTTP_USER_AGENT']) ) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}