<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Carl "Tex" Morgan
 * Date: 6/4/13
 * Time: 4:45 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once AMPHIBIAN_CORE_NEUTRAL . "CheckInput.php";
require_once AMPHIBIAN_CORE_NEUTRAL . "FileHandle.php";
require_once "interfaces".DIRECTORY_SEPARATOR."bookendGeneratorInterface.php";
/**
 * Class BookendGenerator
 *
 * @category Generator
 * @package  Bookend
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/bookendGenerator
 */
class BookendGenerator
    implements bookendGeneratorInterface
{
    /**
     * @var string fileBuffer holds values for $bookendGenerator->fileBuffer
     */
    protected $fileBuffer;
    /**
     * @var object headerFile holds values for $bookendGenerator->headerFile
     */
    protected $headerFile;
    /**
     * @var object footerFile holds values for $bookendGenerator->footerFile
     */
    protected $footerFile;
    /**
     * @var object bookendGenerator a singleton instance of this class
     */
    public static $bookendGenerator;

    /** __construct
     *
     */
    protected function __construct()
    {
    }

    /** instance
     *
     * @return bookendGenerator|object
     */
    public static function instance()
    {
        if ( isset(self::$bookendGenerator) ) {
        } else {
            self::$bookendGenerator = new bookendGenerator();
        }
        return self::$bookendGenerator;
    }

    /** execute
     *
     * @return bool
     */
    public function execute()
    {
        try {
            if ( $this->createHeader() ) {
            } else {
                throw new ExceptionHandler("There were problems within the header creation process.");
            }
            if ( $this->createFooter() ) {
            } else {
                throw new ExceptionHandler("There were problems within the footer creation process.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** createHeader
     *
     * @return bool
     */
    protected function createHeader()
    {
        try {
            if ( $this->makeHeaderFile() ) {
                $this->addHead();
                $this->startBody();
                $this->addHeader();
                $this->startContent();
                if ( CheckInput::checkNewInput($this->fileBuffer) ) {
                    $this->writeHeader();
                } else {
                    throw new ExceptionHandler("the file buffer is empty.");
                }
            } else {
                throw new ExceptionHandler("header.html could not be created.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** makeHeaderFile
     *
     * @return bool
     */
    protected function makeHeaderFile()
    {
        $this->headerFile = new FileHandle(BOOKENDS . "header.html");
        $this->fileBuffer = null;
        if ( CheckInput::checkNewInput($this->headerFile) ) {
            return true;
        } else {
            return false;
        }
    }

    /** addHead
     *
     * @return void
     */
    protected function addHead()
    {
        $this->startHead();
        $this->addStandardMeta();
        $this->addTitle();
        $this->addDNSPrefetching();
        $this->addFavicon();
        $this->addCSSBlock();
        $this->addOptimizations();
        $this->endHead();
    }

    /** startHead
     *
     * @return void
     */
    protected function startHead()
    {
        $this->fileBuffer .= '<?php' . PHP_EOL;
        $this->fileBuffer .= '////require_once MYSQL; todo: replace these with correct databaseConnectionMySQLi calls' . PHP_EOL;
        $this->fileBuffer .= '?>' . PHP_EOL;
        $this->fileBuffer .= '<!doctype html>' . PHP_EOL;
        $this->fileBuffer .= '<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->' . PHP_EOL;
        $this->fileBuffer .= '<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->' . PHP_EOL;
        $this->fileBuffer .= '<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->' . PHP_EOL;
        $this->fileBuffer .= '<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->' . PHP_EOL;
        $this->fileBuffer .= '<head>' . PHP_EOL;
    }

    /** addStandardMeta
     *
     * @return void
     */
    protected function addStandardMeta()
    {
        $this->fileBuffer .= '    <meta charset="utf-8">' . PHP_EOL;
        $this->fileBuffer .= '    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">' . PHP_EOL;
        $this->fileBuffer .= '    <meta name="description" content="">' . PHP_EOL;
        $this->fileBuffer .= '    <meta name="author" content="' . APP_NAME . '">' . PHP_EOL;
        $this->fileBuffer .= '    <meta name="keywords" content="' . APP_NAME . '"/>' . PHP_EOL;
        $this->fileBuffer .= '    <meta name="keywords-not" content="" />' . PHP_EOL;
        $this->fileBuffer .= '    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">' . PHP_EOL;
        $this->fileBuffer .= '    <meta name="robots" content="noindex, follow">' . PHP_EOL;
    }


    /** addTitle
     *
     * @return void
     */
    protected function addTitle()
    {
        $this->fileBuffer .= '    <?php' . PHP_EOL;
        $this->fileBuffer .= '    if(isset($page_title)){' . PHP_EOL;
        $this->fileBuffer .= '        echo "<title>".$page_title."</title>";' . PHP_EOL;
        $this->fileBuffer .= '    }' . PHP_EOL;
        $this->fileBuffer .= '    else{' . PHP_EOL;
        $this->fileBuffer .= '        echo "<title>"' . APP_NAME . '"</title>";' . PHP_EOL;
        $this->fileBuffer .= '    }' . PHP_EOL;
        $this->fileBuffer .= '    ?>' . PHP_EOL;
    }


    /** addDNSPrefetching
     *
     * @return void
     */
    protected function addDNSPrefetching()
    {
        $this->fileBuffer .= '    <link rel="dns-prefetch" href="//fonts.googleapis.com">' . PHP_EOL;
        $this->fileBuffer .= '    <link rel="dns-prefetch" href="//google-analytics.com">' . PHP_EOL;
        $this->fileBuffer .= '    <link rel="dns-prefetch" href="//www.google-analytics.com">' . PHP_EOL;
        $this->fileBuffer .= '    <link rel="dns-prefetch" href="//ajax.googleapis.com">' . PHP_EOL;
        $this->fileBuffer .= '    <link rel="dns-prefetch" href="//code.jquery.com">' . PHP_EOL;
        $this->fileBuffer .= '    <link rel="dns-prefetch" href="//modernizr.com">' . PHP_EOL;
        $this->fileBuffer .= '    <?php' . PHP_EOL;
        $this->fileBuffer .= '        if(isset($dns) AND !is_null($dns)){' . PHP_EOL;
        $this->fileBuffer .= '            preLoader("dns",$dns);' . PHP_EOL;
        $this->fileBuffer .= '        }' . PHP_EOL;
        $this->fileBuffer .= '    ?>' . PHP_EOL;

    }


    /** addFavicon
     *
     * @return void
     */
    protected function addFavicon()
    {
        $this->fileBuffer .= '    <link rel="shortcut icon" href="" />' . PHP_EOL;
    }


    /** addCSSBlock
     *
     * @return void
     */
    protected function addCSSBlock()
    {
        $this->fileBuffer .= '    <!--CSS-->' . PHP_EOL;
        $this->addjQueryUICSS();
        $this->addjQueryMobileCSS();
        $this->addCSSPreloader();
    }


    /** addjQueryUICSS
     *
     * @return void
     */
    protected function addjQueryUICSS()
    {
        $this->fileBuffer .= '    <link type="text/css" href="http://code.jquery.com/ui/' . JQUERY_UI_VERSION . '/themes/smoothness/jquery-ui.css" rel="stylesheet" />' . PHP_EOL;
    }


    /** addjQueryMobileCSS
     *
     * @return void
     */
    protected function addjQueryMobileCSS()
    {
        $this->fileBuffer .= '    <?php' . PHP_EOL;
        $this->fileBuffer .= '        if(isset($is_mobile) AND !is_null($is_mobile)){' . PHP_EOL;
        $this->fileBuffer .= '    ?>' . PHP_EOL;
        $this->fileBuffer .= '          <link rel="stylesheet" href="http://code.jquery.com/mobile/' . JQUERY_MOBILE_VERSION . '/jquery.mobile-' . JQUERY_MOBILE_VERSION . '.min.css">' . PHP_EOL;
        $this->fileBuffer .= '    <?php' . PHP_EOL;
        $this->fileBuffer .= '        }' . PHP_EOL;
        $this->fileBuffer .= '    ?>' . PHP_EOL;


    }


    /** addCSSPreloader
     *
     * @return void
     */
    protected function addCSSPreloader()
    {
        $this->fileBuffer .= '    <!-- Custom CSS -->' . PHP_EOL;
        $this->fileBuffer .= '    <?php' . PHP_EOL;
        $this->fileBuffer .= '        if(isset($css) AND !is_null($css)){' . PHP_EOL;
        $this->fileBuffer .= '            preLoader("css",$css);' . PHP_EOL;
        $this->fileBuffer .= '        }' . PHP_EOL;
        $this->fileBuffer .= '    ?>' . PHP_EOL;
    }


    /** addOptimizations
     *
     * @return void
     */
    protected function addOptimizations()
    {
        $this->addPNGFix();
        $this->addPrefetching();
        $this->addPrerendering();
        $this->addModernizr();
        $this->addJavaScriptPreloader();
    }


    /** addPNGFix
     *
     * @return void
     */
    protected function addPNGFix()
    {
        $this->fileBuffer .= '    <!-- PNG FIX for IE6 -->' . PHP_EOL;
        $this->fileBuffer .= '    <!-- http://24ways.org/2007/supersleight-transparent-png-in-ie6 -->' . PHP_EOL;
        $this->fileBuffer .= '    <!--[if lte IE 6]>' . PHP_EOL;
        $this->fileBuffer .= '        <script type="text/javascript" src="js/pngfix/supersleight-min.js"></script>' . PHP_EOL;
        $this->fileBuffer .= '    <![endif]-->' . PHP_EOL;
    }


    /** addPrefetching
     *
     * @return void
     */
    protected function addPrefetching()
    {
        $this->fileBuffer .= '    <!-- Prefetch the following assets -->' . PHP_EOL;
        $this->fileBuffer .= '    <?php' . PHP_EOL;
        $this->fileBuffer .= '        if(isset($prefetch) AND !is_null($prefetch)){' . PHP_EOL;
        $this->fileBuffer .= '            preLoader("prefetch",$prefetch);' . PHP_EOL;
        $this->fileBuffer .= '        }' . PHP_EOL;
        $this->fileBuffer .= '    ?>' . PHP_EOL;
    }


    /** addPrerendering
     *
     * @return void
     */
    protected function addPrerendering()
    {
        $this->fileBuffer .= '    <!-- Prerender the following links -->' . PHP_EOL;
        $this->fileBuffer .= '    <?php' . PHP_EOL;
        $this->fileBuffer .= '        if(isset($prerender) AND !is_null($prerender)){' . PHP_EOL;
        $this->fileBuffer .= '            preLoader("prerender",$prerender);' . PHP_EOL;
        $this->fileBuffer .= '        }' . PHP_EOL;
        $this->fileBuffer .= '    ?>' . PHP_EOL;
    }


    /** addModernizr
     *
     * @return void
     */
    protected function addModernizr()
    {
        $this->fileBuffer .= '    <script src="http://modernizr.com/downloads/modernizr-latest.js"></script>' . PHP_EOL;
    }


    /** addJavaScriptPreloader
     *
     * @return void
     */
    protected function addJavaScriptPreloader()
    {
        $this->fileBuffer .= '    <!--All JQuery, custom JS has to be loaded after this -->' . PHP_EOL;
        $this->fileBuffer .= '    <?php' . PHP_EOL;
        $this->fileBuffer .= '        if(isset($js) AND !is_null($js)){' . PHP_EOL;
        $this->fileBuffer .= '            preLoader("js",$js);' . PHP_EOL;
        $this->fileBuffer .= '        }' . PHP_EOL;
        $this->fileBuffer .= '    ?>' . PHP_EOL;
    }


    /** endHead
     *
     * @return void
     */
    protected function endHead()
    {
        $this->fileBuffer .= '</head>' . PHP_EOL;
    }


    /** startBody
     *
     * @return void
     */
    protected function startBody()
    {
        $this->fileBuffer .= '    <body data-role="page">' . PHP_EOL;
    }


    /** addHeader
     *
     * @return void
     */
    protected function addHeader()
    {
        $this->startHeader();
        $this->addNav();
        $this->endHeader();
    }


    /** startHeader
     *
     * @return void
     */
    protected function startHeader()
    {
        $this->fileBuffer .= '        <div data-role="header" class="header-container">' . PHP_EOL;
        $this->fileBuffer .= '            <header>' . PHP_EOL;
        $this->fileBuffer .= '                <hgroup>' . PHP_EOL;
        $this->fileBuffer .= '                    <h1 class="title"></h1>' . PHP_EOL;
        $this->fileBuffer .= '                </hgroup>' . PHP_EOL;
    }


    /** addNav
     *
     * @return void
     */
    protected function addNav()
    {
        $this->fileBuffer .= '                <nav>' . PHP_EOL;
        $this->fileBuffer .= '                    <ul>' . PHP_EOL;
        $this->fileBuffer .= '                        <li><a href="#"></a></li>' . PHP_EOL;
        $this->fileBuffer .= '                        <li><a href="#"></a></li>' . PHP_EOL;
        $this->fileBuffer .= '                        <li><a href="#"></a></li>' . PHP_EOL;
        $this->fileBuffer .= '                    </ul>' . PHP_EOL;
        $this->fileBuffer .= '                </nav>' . PHP_EOL;
    }


    /** endHeader
     *
     * @return void
     */
    protected function endHeader()
    {
        $this->fileBuffer .= '            </header>' . PHP_EOL;
        $this->fileBuffer .= '        </div>' . PHP_EOL;
    }


    /** startContent
     *
     * @return void
     */
    protected function startContent()
    {
        $this->fileBuffer .= '        <div data-role="content" class="content container clearfix">' . PHP_EOL;
    }


    /** writeHeader
     *
     * @return void
     */
    protected function writeHeader()
    {
        $this->headerFile->writeFull($this->fileBuffer);
    }


    /** createFooter
     *
     * @return bool
     */
    protected function createFooter()
    {
        try {
            if ( $this->makeFooterFile() ) {
                $this->endContent();
                $this->startFooter();
                $this->addNav();
                $this->endFooter();
                $this->addJavaScriptBlock();
                $this->endBody();
                if ( CheckInput::checkNewInput($this->fileBuffer) ) {
                    $this->writeFooter();
                } else {
                    throw new ExceptionHandler("the file buffer is empty.");
                }
            } else {
                throw new ExceptionHandler("footer.html could not be created.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }


    /** makeFooterFile
     *
     * @return bool
     */
    protected function makeFooterFile()
    {
        $this->footerFile = new FileHandle(BOOKENDS . "footer.html");
        $this->fileBuffer = null;
        if ( CheckInput::checkNewInput($this->footerFile) ) {
            return true;
        } else {
            return false;
        }
    }


    /** endContent
     *
     * @return void
     */
    protected function endContent()
    {
        $this->fileBuffer .= '        </div>' . PHP_EOL;
    }


    /** startFooter
     *
     * @return void
     */
    protected function startFooter()
    {
        $this->fileBuffer .= '        <div data-role="footer" class="footer-container">' . PHP_EOL;
        $this->fileBuffer .= '            <footer class="wrapper">' . PHP_EOL;
    }


    /** endFooter
     *
     * @return void
     */
    protected function endFooter()
    {
        $this->fileBuffer .= '            </footer>' . PHP_EOL;
        $this->fileBuffer .= '        </div>' . PHP_EOL;
    }


    /** addJavaScriptBlock
     *
     * @return void
     */
    protected function addJavaScriptBlock()
    {
        $this->addjQuery();
        $this->addjQueryUI();
        $this->addjQueryMobile();
        $this->addGoogleAnalytics();
    }


    /** addjQuery
     *
     * @return void
     */
    protected function addjQuery()
    {
        $this->fileBuffer .= '        <!-- jQuery Minimized -->' . PHP_EOL;
        $this->fileBuffer .= '        <script src="//ajax.googleapis.com/ajax/libs/jquery/' . JQUERY_VERSION . '/jquery.min.js"></script>' . PHP_EOL;
        $this->fileBuffer .= '        <script>window.jQuery || document.write(' . "'" . '<script src="//ajax.googleapis.com/ajax/libs/jquery/' . JQUERY_VERSION . '/jquery.min.js"><\/script>' . "'" . ')</script>' . PHP_EOL;
        $this->fileBuffer .= '        <script src="js/plugins.js"></script>' . PHP_EOL;
        $this->fileBuffer .= '        <script src="js/main.js"></script>' . PHP_EOL;
    }


    /** addjQueryUI
     *
     * @return void
     */
    protected function addjQueryUI()
    {
        $this->fileBuffer .= '        <!-- jQuery UI -->' . PHP_EOL;
        $this->fileBuffer .= '        <script src="http://code.jquery.com/ui/' . JQUERY_UI_VERSION . '/jquery-ui.js"></script>' . PHP_EOL;
    }


    /** addjQueryMobile
     *
     * @return void
     */
    protected function addjQueryMobile()
    {
        $this->fileBuffer .= '    <?php' . PHP_EOL;
        $this->fileBuffer .= '        if(isset($is_mobile) AND !is_null($is_mobile)){' . PHP_EOL;
        $this->fileBuffer .= '    ?>' . PHP_EOL;
        $this->fileBuffer .= '        <!-- jQuery Mobile -->' . PHP_EOL;
        $this->fileBuffer .= '        <script src="http://code.jquery.com/mobile/' . JQUERY_MOBILE_VERSION . '/jquery.mobile-' . JQUERY_MOBILE_VERSION . '.min.js"></script>' . PHP_EOL;
        $this->fileBuffer .= '    <?php' . PHP_EOL;
        $this->fileBuffer .= '        }' . PHP_EOL;
        $this->fileBuffer .= '    ?>' . PHP_EOL;
    }


    /** addBootstrap
     *
     * @return void
     */
    protected function addBootstrap()
    {
        $this->fileBuffer .= '';
    }


    /** addGoogleAnalytics
     *
     * @return void
     */
    protected function addGoogleAnalytics()
    {
        $this->fileBuffer .= '        <!-- Google Analytics: change UA-XXXXX-X to be your site ID. -->' . PHP_EOL;
        $this->fileBuffer .= '        <script>' . PHP_EOL;
        $this->fileBuffer .= '            var _gaq=[["_setAccount","UA-XXXXX-X"],["_trackPageview"]];' . PHP_EOL;
        $this->fileBuffer .= '            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];' . PHP_EOL;
        $this->fileBuffer .= '            g.src="//www.google-analytics.com/ga.js";' . PHP_EOL;
        $this->fileBuffer .= '            s.parentNode.insertBefore(g,s)}(document,"script"));' . PHP_EOL;
        $this->fileBuffer .= '        </script>' . PHP_EOL;
    }


    /** endBody
     *
     * @return void
     */
    protected function endBody()
    {
        $this->fileBuffer .= '    </body>' . PHP_EOL;
        $this->fileBuffer .= '</html>';
    }


    /** writeFooter
     *
     * @return void
     */
    protected function writeFooter()
    {
        $this->footerFile->writeFull($this->fileBuffer);
    }
}

/*
 * Test for current site
 *
require_once __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."InnerAlly.config.inc.php";
$bg = bookendGenerator::instance();
$bg->execute();
 */