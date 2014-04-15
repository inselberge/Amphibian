<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 6/27/13
 * Time: 4:07 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once "CheckInput.php";
require_once "interfaces".DIRECTORY_SEPARATOR."PreLoaderInterface.php";
/**
 * Class PreLoader
 *
 * @category Helper
 * @package  Core
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/PreLoader
 */
class PreLoader
    implements PreLoaderInterface
{
    /**
     * @var string type a string containing the type
     */
    protected $type;
    /**
     * @var array array an array of values to load
     */
    protected $array;
    /**
     * @var object PreLoader a singleton instance of this class
     */
    public static $PreLoader;


    /** __construct
     *
     * @param string $type  the string denoting the type
     * @param array  $array the array of values to pre-load

     */
    protected function __construct($type, $array)
    {
        $this->setArray($array);
        $this->setType($type);
    }

    /** instance
     *
     * @param string $type  the string denoting the type
     * @param array  $array the array of values to pre-load
     *
     * @return PreLoader
     */
    public static function instance($type, $array)
    {
        if ( !isset(self::$PreLoader) ) {
            self::$PreLoader = new PreLoader($type, $array);
        } else {
            self::$PreLoader->setType($type);
            self::$PreLoader->setArray($array);
        }
        return self::$PreLoader;
    }

    /** setArray
     *
     * @param array $array the array of values
     *
     * @return bool
     */
    public function setArray($array)
    {
        try {
            if ( CheckInput::checkNewInputArray($array) ) {
                $this->array = $array;
            } else {
                throw new ExceptionHandler(__METHOD__ . "$array is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setType
     *
     * @param string $type a string denoting the type of load
     *
     * @return bool
     */
    public function setType($type)
    {
        try {
            if ( CheckInput::checkNewInput($type) ) {
                $this->type = $type;
            } else {
                throw new ExceptionHandler("$type is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** execute
     *
     * @return bool
     */
    public function execute()
    {
        try {
            if ( isset($this->type) ) {
                if ( $this->type === 'css' ) {
                    $this->printCSS();
                }
                if ( $this->type === 'dns' ) {
                    $this->printDNSPrefetch();
                }
                if ( $this->type === 'js' ) {
                    $this->printJavaScript();
                }
                if ( $this->type === 'prefetch' ) {
                    $this->printPrefetch();
                }
                if ( $this->type === 'prerend' ) {
                    $this->printPrerender();
                }
            } else {
                throw new ExceptionHandler(__METHOD__.": unsuported type");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** printCSS
     *
     * @return void
     */
    protected function printCSS()
    {
        foreach ( $this->array as $value ) {
            echo '<link rel="stylesheet" type="text/css" href="css/'
                 . $value
                 . '" />' . "\n";
        }
    }

    /** printDNSPrefetch
     *
     * @return void
     */
    protected function printDNSPrefetch()
    {
        foreach ( $this->array as $value ) {
            echo '<link rel="dns-prefetch" href="' . $value . '" />' . "\n";
        }
    }

    /** printJavaScript
     *
     * @return void
     */
    protected function printJavaScript()
    {
        foreach ( $this->array as $value ) {
            echo '<script type="text/javascript" src="js/'
                 . $value
                 . '"></script>' . "\n";
        }
    }

    /** printPrefetch
     *
     * @return void
     */
    protected function printPrefetch()
    {
        foreach ( $this->array as $value ) {
            echo '<link rel="prefetch" href="' . $value . '" />' . "\n";
        }
    }

    /** printPrerender
     *
     * @return void
     */
    protected function printPrerender()
    {
        foreach ( $this->array as $value ) {
            echo '<link rel="prerender" href="' . $value . '" />' . "\n";
        }
    }
}
/*
$pre = PreLoader::instance(
    'dns',
    array(
        "//fonts.googleapis.com",
        "//google-analytics.com",
        "//www.google-analytics.com"
    )
);
$pre->execute();
*/