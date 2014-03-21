<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Carl "Tex" Morgan
 * Date: 4/24/13
 * Time: 12:26 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */

class constantsPHP {

    static protected $constantsPHP = array(
        "PHP_VERSION"=>PHP_VERSION,
        "PHP_MAJOR_VERSION"=>PHP_MAJOR_VERSION,
        "PHP_MINOR_VERSION"=> PHP_MINOR_VERSION,
        "PHP_RELEASE_VERSION"=> PHP_RELEASE_VERSION,
        "PHP_VERSION_ID"=> PHP_VERSION_ID,
        "PHP_EXTRA_VERSION"=> PHP_EXTRA_VERSION,
        "PHP_ZTS"=> PHP_ZTS,
        "PHP_DEBUG"=> PHP_DEBUG,
        "PHP_MAXPATHLEN"=> PHP_MAXPATHLEN,
        "PHP_OS"=> PHP_OS,
        "PHP_SAPI"=> PHP_SAPI,
        "PHP_EOL"=> PHP_EOL,
        "PHP_INT_MAX"=> PHP_INT_MAX,
        "PHP_INT_SIZE"=> PHP_INT_SIZE,
        "DEFAULT_INCLUDE_PATH"=> DEFAULT_INCLUDE_PATH,
        "PEAR_INSTALL_DIR"=>PEAR_INSTALL_DIR,
        "PEAR_EXTENSION_DIR"=> PEAR_EXTENSION_DIR,
        "PHP_EXTENSION_DIR"=> PHP_EXTENSION_DIR,
        "PHP_PREFIX"=> PHP_PREFIX,
        "PHP_BINDIR"=> PHP_BINDIR,
        "PHP_BINARY"=> PHP_BINARY,
        "PHP_MANDIR"=> PHP_MANDIR,
        "PHP_LIBDIR"=> PHP_LIBDIR,
        "PHP_DATADIR"=>PHP_DATADIR,
        "PHP_SYSCONFDIR"=> PHP_SYSCONFDIR,
        "PHP_LOCALSTATEDIR"=> PHP_LOCALSTATEDIR,
        "PHP_CONFIG_FILE_PATH"=> PHP_CONFIG_FILE_PATH,
        "PHP_CONFIG_FILE_SCAN_DIR"=> PHP_CONFIG_FILE_SCAN_DIR,
        "PHP_SHLIB_SUFFIX"=> PHP_SHLIB_SUFFIX,
        "DIRECTORY_SEPARATOR"=>DIRECTORY_SEPARATOR,
        "PATH_SEPARATOR"=>PATH_SEPARATOR
    );

    static public function printConstants(){
        print_r(self::$constantsPHP);
    }
}

constantsPHP::printConstants();

print_r($_SERVER);