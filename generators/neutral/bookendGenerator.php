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
 * Class bookendGenerator
 *
 * @category Generator
 * @package  Bookend
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/bookendGenerator
 */
class bookendGenerator
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
        $this->fileBuffer .= '<?php' . "\n";
        $this->fileBuffer .= '////require_once MYSQL; todo: replace these with correct databaseConnectionMySQLi calls' . "\n";
        $this->fileBuffer .= '?>' . "\n";
        $this->fileBuffer .= '<!doctype html>' . "\n";
        $this->fileBuffer .= '<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->' . "\n";
        $this->fileBuffer .= '<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->' . "\n";
        $this->fileBuffer .= '<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->' . "\n";
        $this->fileBuffer .= '<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->' . "\n";
        $this->fileBuffer .= '<head>' . "\n";
    }

    /** addStandardMeta
     *
     * @return void
     */
    protected function addStandardMeta()
    {
        $this->fileBuffer .= '    <meta charset="utf-8">' . "\n";
        $this->fileBuffer .= '    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">' . "\n";
        $this->fileBuffer .= '    <meta name="description" content="">' . "\n";
        $this->fileBuffer .= '    <meta name="author" content="' . APP_NAME . '">' . "\n";
        $this->fileBuffer .= '    <meta name="keywords" content="' . APP_NAME . '"/>' . "\n";
        $this->fileBuffer .= '    <meta name="keywords-not" content="" />' . "\n";
        $this->fileBuffer .= '    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">' . "\n";
        $this->fileBuffer .= '    <meta name="robots" content="noindex, follow">' . "\n";
    }


    /** addTitle
     *
     * @return void
     */
    protected function addTitle()
    {
        $this->fileBuffer .= '    <?php' . "\n";
        $this->fileBuffer .= '    if(isset($page_title)){' . "\n";
        $this->fileBuffer .= '        echo "<title>".$page_title."</title>";' . "\n";
        $this->fileBuffer .= '    }' . "\n";
        $this->fileBuffer .= '    else{' . "\n";
        $this->fileBuffer .= '        echo "<title>"' . APP_NAME . '"</title>";' . "\n";
        $this->fileBuffer .= '    }' . "\n";
        $this->fileBuffer .= '    ?>' . "\n";
    }


    /** addDNSPrefetching
     *
     * @return void
     */
    protected function addDNSPrefetching()
    {
        $this->fileBuffer .= '    <link rel="dns-prefetch" href="//fonts.googleapis.com">' . "\n";
        $this->fileBuffer .= '    <link rel="dns-prefetch" href="//google-analytics.com">' . "\n";
        $this->fileBuffer .= '    <link rel="dns-prefetch" href="//www.google-analytics.com">' . "\n";
        $this->fileBuffer .= '    <link rel="dns-prefetch" href="//ajax.googleapis.com">' . "\n";
        $this->fileBuffer .= '    <link rel="dns-prefetch" href="//code.jquery.com">' . "\n";
        $this->fileBuffer .= '    <link rel="dns-prefetch" href="//modernizr.com">' . "\n";
        $this->fileBuffer .= '    <?php' . "\n";
        $this->fileBuffer .= '        if(isset($dns) AND !is_null($dns)){' . "\n";
        $this->fileBuffer .= '            preLoader("dns",$dns);' . "\n";
        $this->fileBuffer .= '        }' . "\n";
        $this->fileBuffer .= '    ?>' . "\n";

    }


    /** addFavicon
     *
     * @return void
     */
    protected function addFavicon()
    {
        $this->fileBuffer .= '    <link rel="shortcut icon" href="" />' . "\n";
    }


    /** addCSSBlock
     *
     * @return void
     */
    protected function addCSSBlock()
    {
        $this->fileBuffer .= '    <!--CSS-->' . "\n";
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
        $this->fileBuffer .= '    <link type="text/css" href="http://code.jquery.com/ui/' . JQUERY_UI_VERSION . '/themes/smoothness/jquery-ui.css" rel="stylesheet" />' . "\n";
    }


    /** addjQueryMobileCSS
     *
     * @return void
     */
    protected function addjQueryMobileCSS()
    {
        $this->fileBuffer .= '    <?php' . "\n";
        $this->fileBuffer .= '        if(isset($is_mobile) AND !is_null($is_mobile)){' . "\n";
        $this->fileBuffer .= '    ?>' . "\n";
        $this->fileBuffer .= '          <link rel="stylesheet" href="http://code.jquery.com/mobile/' . JQUERY_MOBILE_VERSION . '/jquery.mobile-' . JQUERY_MOBILE_VERSION . '.min.css">' . "\n";
        $this->fileBuffer .= '    <?php' . "\n";
        $this->fileBuffer .= '        }' . "\n";
        $this->fileBuffer .= '    ?>' . "\n";


    }


    /** addCSSPreloader
     *
     * @return void
     */
    protected function addCSSPreloader()
    {
        $this->fileBuffer .= '    <!-- Custom CSS -->' . "\n";
        $this->fileBuffer .= '    <?php' . "\n";
        $this->fileBuffer .= '        if(isset($css) AND !is_null($css)){' . "\n";
        $this->fileBuffer .= '            preLoader("css",$css);' . "\n";
        $this->fileBuffer .= '        }' . "\n";
        $this->fileBuffer .= '    ?>' . "\n";
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
        $this->fileBuffer .= '    <!-- PNG FIX for IE6 -->' . "\n";
        $this->fileBuffer .= '    <!-- http://24ways.org/2007/supersleight-transparent-png-in-ie6 -->' . "\n";
        $this->fileBuffer .= '    <!--[if lte IE 6]>' . "\n";
        $this->fileBuffer .= '		<script type="text/javascript" src="js/pngfix/supersleight-min.js"></script>' . "\n";
        $this->fileBuffer .= '    <![endif]-->' . "\n";
    }


    /** addPrefetching
     *
     * @return void
     */
    protected function addPrefetching()
    {
        $this->fileBuffer .= '    <!-- Prefetch the following assets -->' . "\n";
        $this->fileBuffer .= '    <?php' . "\n";
        $this->fileBuffer .= '        if(isset($prefetch) AND !is_null($prefetch)){' . "\n";
        $this->fileBuffer .= '            preLoader("prefetch",$prefetch);' . "\n";
        $this->fileBuffer .= '        }' . "\n";
        $this->fileBuffer .= '    ?>' . "\n";
    }


    /** addPrerendering
     *
     * @return void
     */
    protected function addPrerendering()
    {
        $this->fileBuffer .= '    <!-- Prerender the following links -->' . "\n";
        $this->fileBuffer .= '    <?php' . "\n";
        $this->fileBuffer .= '        if(isset($prerender) AND !is_null($prerender)){' . "\n";
        $this->fileBuffer .= '            preLoader("prerender",$prerender);' . "\n";
        $this->fileBuffer .= '        }' . "\n";
        $this->fileBuffer .= '    ?>' . "\n";
    }


    /** addModernizr
     *
     * @return void
     */
    protected function addModernizr()
    {
        $this->fileBuffer .= '    <script src="http://modernizr.com/downloads/modernizr-latest.js"></script>' . "\n";
    }


    /** addJavaScriptPreloader
     *
     * @return void
     */
    protected function addJavaScriptPreloader()
    {
        $this->fileBuffer .= '    <!--All JQuery, custom JS has to be loaded after this -->' . "\n";
        $this->fileBuffer .= '    <?php' . "\n";
        $this->fileBuffer .= '        if(isset($js) AND !is_null($js)){' . "\n";
        $this->fileBuffer .= '            preLoader("js",$js);' . "\n";
        $this->fileBuffer .= '        }' . "\n";
        $this->fileBuffer .= '    ?>' . "\n";
    }


    /** endHead
     *
     * @return void
     */
    protected function endHead()
    {
        $this->fileBuffer .= '</head>' . "\n";
    }


    /** startBody
     *
     * @return void
     */
    protected function startBody()
    {
        $this->fileBuffer .= '    <body data-role="page">' . "\n";
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
        $this->fileBuffer .= '        <div data-role="header" class="header-container">' . "\n";
        $this->fileBuffer .= '            <header>' . "\n";
        $this->fileBuffer .= '                <hgroup>' . "\n";
        $this->fileBuffer .= '                    <h1 class="title"></h1>' . "\n";
        $this->fileBuffer .= '                </hgroup>' . "\n";
    }


    /** addNav
     *
     * @return void
     */
    protected function addNav()
    {
        $this->fileBuffer .= '                <nav>' . "\n";
        $this->fileBuffer .= '                    <ul>' . "\n";
        $this->fileBuffer .= '                        <li><a href="#"></a></li>' . "\n";
        $this->fileBuffer .= '                        <li><a href="#"></a></li>' . "\n";
        $this->fileBuffer .= '                        <li><a href="#"></a></li>' . "\n";
        $this->fileBuffer .= '                    </ul>' . "\n";
        $this->fileBuffer .= '                </nav>' . "\n";
    }


    /** endHeader
     *
     * @return void
     */
    protected function endHeader()
    {
        $this->fileBuffer .= '            </header>' . "\n";
        $this->fileBuffer .= '        </div>' . "\n";
    }


    /** startContent
     *
     * @return void
     */
    protected function startContent()
    {
        $this->fileBuffer .= '        <div data-role="content" class="content container clearfix">' . "\n";
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
        $this->fileBuffer .= '        </div>' . "\n";
    }


    /** startFooter
     *
     * @return void
     */
    protected function startFooter()
    {
        $this->fileBuffer .= '        <div data-role="footer" class="footer-container">' . "\n";
        $this->fileBuffer .= '            <footer class="wrapper">' . "\n";
    }


    /** endFooter
     *
     * @return void
     */
    protected function endFooter()
    {
        $this->fileBuffer .= '            </footer>' . "\n";
        $this->fileBuffer .= '        </div>' . "\n";
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
        $this->fileBuffer .= '        <!-- jQuery Minimized -->' . "\n";
        $this->fileBuffer .= '        <script src="//ajax.googleapis.com/ajax/libs/jquery/' . JQUERY_VERSION . '/jquery.min.js"></script>' . "\n";
        $this->fileBuffer .= '        <script>window.jQuery || document.write(' . "'" . '<script src="//ajax.googleapis.com/ajax/libs/jquery/' . JQUERY_VERSION . '/jquery.min.js"><\/script>' . "'" . ')</script>' . "\n";
        $this->fileBuffer .= '        <script src="js/plugins.js"></script>' . "\n";
        $this->fileBuffer .= '        <script src="js/main.js"></script>' . "\n";
    }


    /** addjQueryUI
     *
     * @return void
     */
    protected function addjQueryUI()
    {
        $this->fileBuffer .= '        <!-- jQuery UI -->' . "\n";
        $this->fileBuffer .= '        <script src="http://code.jquery.com/ui/' . JQUERY_UI_VERSION . '/jquery-ui.js"></script>' . "\n";
    }


    /** addjQueryMobile
     *
     * @return void
     */
    protected function addjQueryMobile()
    {
        $this->fileBuffer .= '    <?php' . "\n";
        $this->fileBuffer .= '        if(isset($is_mobile) AND !is_null($is_mobile)){' . "\n";
        $this->fileBuffer .= '    ?>' . "\n";
        $this->fileBuffer .= '        <!-- jQuery Mobile -->' . "\n";
        $this->fileBuffer .= '        <script src="http://code.jquery.com/mobile/' . JQUERY_MOBILE_VERSION . '/jquery.mobile-' . JQUERY_MOBILE_VERSION . '.min.js"></script>' . "\n";
        $this->fileBuffer .= '    <?php' . "\n";
        $this->fileBuffer .= '        }' . "\n";
        $this->fileBuffer .= '    ?>' . "\n";
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
        $this->fileBuffer .= '        <!-- Google Analytics: change UA-XXXXX-X to be your site ID. -->' . "\n";
        $this->fileBuffer .= '        <script>' . "\n";
        $this->fileBuffer .= '            var _gaq=[["_setAccount","UA-XXXXX-X"],["_trackPageview"]];' . "\n";
        $this->fileBuffer .= '            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];' . "\n";
        $this->fileBuffer .= '            g.src="//www.google-analytics.com/ga.js";' . "\n";
        $this->fileBuffer .= '            s.parentNode.insertBefore(g,s)}(document,"script"));' . "\n";
        $this->fileBuffer .= '        </script>' . "\n";
    }


    /** endBody
     *
     * @return void
     */
    protected function endBody()
    {
        $this->fileBuffer .= '    </body>' . "\n";
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