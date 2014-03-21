<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 6/21/13
 * Time: 8:23 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
// Are we live?
$live = false;

function redirect_invalid_user( $check = 'user_id', $destination = 'index.php', $protocol = 'http://' )
{
    if ( !isset($_SESSION[$check]) ) {
        $url = $protocol . BASE_URL . $destination;
        header("Location: $url");
        exit();
    }
}

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

function _ToSpace( $string )
{
    return str_replace('_', ' ', $string);
}

function spaceTo_( $string )
{
    return str_replace(' ', '_', $string);
}

function stripQuote( $string )
{
    return preg_replace("/'/", '', $string);
}

//generate a SEO friendly url
function generate_url_from_text( $strText )
{
    $strText = preg_replace('/[^A-Za-z0-9-]/', ' ', $strText);
    $strText = preg_replace('/ +/', ' ', $strText);
    $strText = trim($strText);
    $strText = str_replace(' ', '-', $strText);
    $strText = preg_replace('/-+/', '-', $strText);
    $strText = strtolower($strText);
    return $strText;
}

function checkDirectory( $dir )
{
    if ( is_dir($dir) ) {
    } else {
        mkdir($dir, 0755, true);
    }
}