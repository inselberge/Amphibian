<?php
/**
 * PHP Version 5.4.17
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 6/20/13
 * Time: 3:19 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR .  "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once AMPHIBIAN_CORE_NEUTRAL."CheckInput.php";
require_once "basicView.php";
require_once "interfaces".DIRECTORY_SEPARATOR."basicPageInterface.php";
/**
 * Class basicPage
 * 
 * @category Core
 * @package  Amphibian
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/basicPage
 */
abstract class basicPage
    extends basicView
    implements basicPageInterface
{
    /**
     * @var string encoding holds values for $basicPage->encoding
     */
    protected $encoding;
    /**
     * @var string language holds values for $basicPage->language
     */
    protected $language;
    /**
     * @var array javascript holds values for $basicPage->javascript
     */
    protected $javascript;
    /**
     * @var array css holds values for $basicPage->css
     */
    protected $css;
    /**
     * @var string title holds values for $basicPage->title
     */
    protected $title;
    /**
     * @var string description holds values for $basicPage->description
     */
    protected $description;
    /**
     * @var string author holds values for $basicPage->author
     */
    protected $author;
    /**
     * @var string keywords holds values for $basicPage->keywords
     */
    protected $keywords;
    /**
     * @var string keywordsNot holds values for $basicPage->keywordsNot
     */
    protected $keywordsNot;
    /**
     * @var string viewport holds values for $basicPage->viewport
     */
    protected $viewport;
    /**
     * @var string robots holds values for $basicPage->robots
     */
    protected $robots;
    /**
     * @var array dnsPrefetch holds values for $basicPage->dnsPrefetch
     */
    protected $dnsPrefetch;
    /**
     * @var string favicon holds values for $basicPage->favicon
     */
    protected $favicon;
    /**
     * @var array prefetch holds values for $basicPage->prefetch
     */
    protected $prefetch;
    /**
     * @var array prerender holds values for $basicPage->prerender
     */
    protected $prerender;
    //Extras
    /**
     * @var boolean browserCheck holds values for $basicPage->browserCheck
     */
    protected $browserCheck;
    /**
     * @var boolean pngFix holds values for $basicPage->pngFix
     */
    protected $pngFix;
    /**
     * @var boolean modernizr holds values for $basicPage->modernizr
     */
    protected $modernizr;
    /**
     * @var string jQuery holds values for $basicPage->jQuery
     */
    protected $jQuery;
    /**
     * @var string jQueryUI holds values for $basicPage->jQueryUI
     */
    protected $jQueryUI;
    /**
     * @var string jQueryMobile holds values for $basicPage->jQueryMobile
     */
    protected $jQueryMobile;    
    /**
     * @var string header holds values for $basicPage->header
     */
    protected $header;
    /**
     * @var string content holds values for $basicPage->content
     */
    protected $content;
    /**
     * @var string footer holds values for $basicPage->footer
     */
    protected $footer;    
    /**
     * @var array required holds values for $basicPage->required
     */
    protected $required;
    /**
     * @var array include holds values for $basicPage->include
     */
    protected $include;
    /**
     * @var object agencies holds values for $basicPage->agencies
     */
    protected $agencies;
    /**
     * @var object model holds values for $basicPage->model
     */
    protected $model;
    /**
     * @var object controller holds values for $basicPage->controller
     */
    protected $controller;
    /**
     * @var array views holds values for $basicPage->views
     */
    protected $views;
    /**
     * @var string load holds values for $basicPage->load
     */
    protected $load;

    /** loadDefaults
     * 
     * @return mixed
     */
    abstract protected function loadDefaults();

    /** initializePreloadVariables
     * 
     * @return void
     */
    protected function initializePreloadVariables()
    {
        $this->css = array();
        $this->javascript = array();
        $this->prefetch = array();
        $this->prerender = array();
        $this->dnsPrefetch = array();
    }

    /** loadDefaultMVCA
     * 
     * @param string $name the name of the current page, i.e. user
     * 
     * @return bool
     */
    protected function loadDefaultMVCA($name)
    {
        try {
            if ( CheckInput::checkNewInput($name) ) {
                //Generated Form Controller
                $this->setInclude(FORMS_CONTROLLERS.$name.".php");
                //Generated Agency
                $this->setInclude(GENERATED_AGENCY.$name.".php");
                //Generated Model
                $this->setInclude(MODELS_GENERATED.$name.".php");
                //Generated Form View
                $this->setInclude(VIEWS_GENERATED_FORMS.$name.".php");
                //Generated Browse View
                $this->setInclude(VIEWS_GENERATED_BROWSE.$name.".php");
            } else {
                throw new ExceptionHandler(__METHOD__ . ": invalid name.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** loadRequired
     *
     * @return bool
     */
    protected function loadRequired()
    {
        try {
            if ( CheckInput::checkNewInput($this->required) ) {
                foreach ($this->required as $re) {
                    require_once $re;
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": No required files set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** loadIncludes
     *
     * @return bool
     */
    protected function loadIncludes()
    {
        try {
            if ( CheckInput::checkNewInput($this->include) ) {
                foreach ($this->include as $incl) {
                    include $incl;
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": No required files set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** __construct
     *
     * @param resource $databaseConnection a valid database connection
     */
    public function __construct($databaseConnection=null)
    {
        $this->loadDefaults();
    }

    /**  setAgencies
     * 
     * @param mixed $agencies the agencies to use
     * 
     * @return boolean
     */
    public function setAgencies( $agencies )
    {
        try {
            if ( CheckInput::checkNewInputArray($agencies) ) {
                $this->agencies[] = $agencies;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": agencies invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getAgencies
     * 
     * @return mixed
     */
    public function getAgencies()
    {
        return $this->agencies;
    }

    /**  setAuthor
     * 
     * @param mixed $author the author of the page
     * 
     * @return boolean
     */
    public function setAuthor( $author )
    {
        try {
            if ( CheckInput::checkNewInput($author) ) {
                $this->author = $author;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": author invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getAuthor
     * 
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**  setBrowserCheck
     * 
     * @param boolean $browserCheck if we should check the browser or not
     * 
     * @return boolean
     */
    public function setBrowserCheck( $browserCheck )
    {
        try {
            if ( CheckInput::checkNewInput($browserCheck) ) {
                $this->browserCheck = $browserCheck;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": browserCheck invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getBrowserCheck
     * 
     * @return mixed
     */
    public function getBrowserCheck()
    {
        return $this->browserCheck;
    }

    /**  setContent
     * 
     * @param mixed $content anything you want put in the main body
     * 
     * @return boolean
     */
    public function setContent( $content )
    {
        try {
            if ( CheckInput::checkNewInputArray($content) ) {
                $this->content[] = $content;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": content invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getContent
     * 
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**  setController
     * 
     * @param object $controller the controller to use
     * 
     * @return boolean
     */
    public function setController( $controller )
    {
        try {
            if ( CheckInput::checkNewInput($controller) ) {
                $this->controller = $controller;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": controller invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getController
     * 
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**  setCss
     * 
     * @param string $css the custom css files to load
     * 
     * @return boolean
     */
    public function setCss( $css )
    {
        try {
            if ( CheckInput::checkNewInputArray($css) ) {
                $this->css[] = $css;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": css invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getCss
     * 
     * @return mixed
     */
    public function getCss()
    {
        return $this->css;
    }

    /**  setDescription
     * 
     * @param string $description the description of the page
     * 
     * @return boolean
     */
    public function setDescription( $description )
    {
        try {
            if ( CheckInput::checkNewInput($description) ) {
                $this->description = $description;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": description invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getDescription
     * 
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**  setDnsPrefetch
     * 
     * @param string $dnsPrefetch the URL to DNS prefetch
     * 
     * @return boolean
     */
    public function setDnsPrefetch( $dnsPrefetch )
    {
        try {
            if ( CheckInput::checkNewInputArray($dnsPrefetch) ) {
                $this->dnsPrefetch[] = $dnsPrefetch;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": dnsPrefetch invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getDnsPrefetch
     * 
     * @return mixed
     */
    public function getDnsPrefetch()
    {
        return $this->dnsPrefetch;
    }

    /**  setEncoding
     * 
     * @param string $encoding the encoding of the page
     * 
     * @return boolean
     */
    public function setEncoding( $encoding )
    {
        try {
            if ( CheckInput::checkNewInput($encoding) ) {
                $this->encoding = $encoding;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": encoding invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getEncoding
     * 
     * @return mixed
     */
    public function getEncoding()
    {
        return $this->encoding;
    }

    /**  setFavicon
     * 
     * @param string $favicon the file of the favicon
     * 
     * @return boolean
     */
    public function setFavicon( $favicon )
    {
        try {
            if ( CheckInput::checkNewInput($favicon) ) {
                $this->favicon = $favicon;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": favicon invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getFavicon
     * 
     * @return mixed
     */
    public function getFavicon()
    {
        return $this->favicon;
    }

    /**  setFooter
     * 
     * @param string $footer the file to use as the footer
     * 
     * @return boolean
     */
    public function setFooter( $footer )
    {
        try {
            if ( CheckInput::checkNewInput($footer) ) {
                $this->footer = $footer;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": footer invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getFooter
     * 
     * @return mixed
     */
    public function getFooter()
    {
        return $this->footer;
    }

    /**  setHeader
     * 
     * @param string $header the file to use as the header
     * 
     * @return boolean
     */
    public function setHeader( $header )
    {
        try {
            if ( CheckInput::checkNewInput($header) ) {
                $this->header = $header;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": header invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getHeader
     * 
     * @return mixed
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**  setInclude
     * 
     * @param string $include a file to include
     * 
     * @return boolean
     */
    public function setInclude( $include )
    {
        try {
            if ( CheckInput::checkNewInputArray($include) ) {
                $this->include[] = $include;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": include invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getInclude
     * 
     * @return mixed
     */
    public function getInclude()
    {
        return $this->include;
    }

    /**  setJQuery
     * 
     * @param string $jQuery the jQuery version to use
     * 
     * @return boolean
     */
    public function setJQuery( $jQuery )
    {
        try {
            if ( CheckInput::checkNewInput($jQuery) ) {
                $this->jQuery = $jQuery;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": jQuery invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getJQuery
     * 
     * @return mixed
     */
    public function getJQuery()
    {
        return $this->jQuery;
    }

    /**  setJQueryMobile
     * 
     * @param string $jQueryMobile the jQueryMobile version to use
     * 
     * @return boolean
     */
    public function setJQueryMobile( $jQueryMobile )
    {
        try {
            if ( CheckInput::checkNewInput($jQueryMobile) ) {
                $this->jQueryMobile = $jQueryMobile;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": jQueryMobile invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getJQueryMobile
     * 
     * @return mixed
     */
    public function getJQueryMobile()
    {
        return $this->jQueryMobile;
    }

    /**  setJQueryUI
     * 
     * @param string $jQueryUI the jQueryUI version to use
     * 
     * @return boolean
     */
    public function setJQueryUI( $jQueryUI )
    {
        try {
            if ( CheckInput::checkNewInput($jQueryUI) ) {
                $this->jQueryUI = $jQueryUI;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": jQueryUI invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getJQueryUI
     * 
     * @return mixed
     */
    public function getJQueryUI()
    {
        return $this->jQueryUI;
    }

    /**  setJs
     * 
     * @param string $javascript a JavaScript file to use
     * 
     * @return boolean
     */
    public function setJs( $javascript )
    {
        try {
            if ( CheckInput::checkNewInputArray($javascript) ) {
                $this->javascript[] = $javascript;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": javascript invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getJs
     * 
     * @return mixed
     */
    public function getJs()
    {
        return $this->javascript;
    }

    /**  setKeywords
     * 
     * @param string $keywords a keyword to use for SEO optimization 
     * 
     * @return boolean
     */
    public function setKeywords( $keywords )
    {
        try {
            if ( CheckInput::checkNewInputArray($keywords) ) {
                $this->keywords[] = $keywords;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": keywords invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getKeywords
     * 
     * @return mixed
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**  setKeywordsNot
     * 
     * @param string $keywordsNot a not keyword to use for SEO optimization
     * 
     * @return boolean
     */
    public function setKeywordsNot( $keywordsNot )
    {
        try {
            if ( CheckInput::checkNewInputArray($keywordsNot) ) {
                $this->keywordsNot[] = $keywordsNot;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": keywordsNot invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getKeywordsNot
     * 
     * @return mixed
     */
    public function getKeywordsNot()
    {
        return $this->keywordsNot;
    }

    /**  setLanguage
     * 
     * @param string $language the language of the page
     * 
     * @return boolean
     */
    public function setLanguage( $language )
    {
        try {
            if ( CheckInput::checkNewInputArray($language) ) {
                $this->language = $language;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": language invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getLanguage
     * 
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**  setLoad
     * 
     * @param boolean $load auto-load this page or not 
     * 
     * @return boolean
     */
    public function setLoad( $load )
    {
        try {
            if ( CheckInput::checkNewInput($load) ) {
                $this->load[] = $load;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": load invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getLoad
     * 
     * @return mixed
     */
    public function getLoad()
    {
        return $this->load;
    }

    /**  setModels
     * 
     * @param mixed $model a model to use on this page
     * 
     * @return boolean
     */
    public function setModels( $model )
    {
        try {
            if ( CheckInput::checkNewInput($model) ) {
                $this->model[] = $model;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": model invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getModels
     * 
     * @return mixed
     */
    public function getModels()
    {
        return $this->model;
    }

    /**  setModernizr
     * 
     * @param boolean $modernizr if we should use modernizer or not
     * 
     * @return boolean
     */
    public function setModernizr( $modernizr )
    {
        try {
            if ( CheckInput::checkNewInput($modernizr) ) {
                $this->modernizr = $modernizr;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": modernizr invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getModernizr
     * 
     * @return mixed
     */
    public function getModernizr()
    {
        return $this->modernizr;
    }

    /**  setPngFix
     * 
     * @param boolean $pngFix should we check for the PNG fix
     * 
     * @return boolean
     */
    public function setPngFix( $pngFix )
    {
        try {
            if ( CheckInput::checkNewInput($pngFix) ) {
                $this->pngFix = $pngFix;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": pngFix invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getPngFix
     * 
     * @return mixed
     */
    public function getPngFix()
    {
        return $this->pngFix;
    }

    /**  setPrefetch
     * 
     * @param string $prefetch a URL to prefetch
     * 
     * @return boolean
     */
    public function setPrefetch( $prefetch )
    {
        try {
            if ( CheckInput::checkNewInputArray($prefetch) ) {
                $this->prefetch[] = $prefetch;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": prefetch invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getPrefetch
     * 
     * @return mixed
     */
    public function getPrefetch()
    {
        return $this->prefetch;
    }

    /**  setPrerender
     * 
     * @param string $prerender a URL to prerender
     * 
     * @return boolean
     */
    public function setPrerender( $prerender )
    {
        try {
            if ( CheckInput::checkNewInputArray($prerender) ) {
                $this->prerender[] = $prerender;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": prerender invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getPrerender
     * 
     * @return mixed
     */
    public function getPrerender()
    {
        return $this->prerender;
    }

    /**  setRequired
     * 
     * @param string $required a required file to load
     * 
     * @return boolean
     */
    public function setRequired( $required )
    {
        try {
            if ( CheckInput::checkNewInputArray($required) ) {
                $this->required[] = $required;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": required invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getRequired
     * 
     * @return mixed
     */
    public function getRequired()
    {
        return $this->required;
    }

    /**  setRobots
     * 
     * @param string $robots the setting for web crawlers
     * 
     * @return boolean
     */
    public function setRobots( $robots )
    {
        try {
            if ( CheckInput::checkNewInput($robots) ) {
                $this->robots = $robots;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": robots invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getRobots
     * 
     * @return mixed
     */
    public function getRobots()
    {
        return $this->robots;
    }

    /**  setTitle
     * 
     * @param string $title the title of the page
     * 
     * @return boolean
     */
    public function setTitle( $title )
    {
        try {
            if ( CheckInput::checkNewInput($title) ) {
                $this->title = $title;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": title invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getTitle
     * 
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**  setViewport
     * 
     * @param string $viewport the viewport settings for this page
     * 
     * @return boolean
     */
    public function setViewport( $viewport )
    {
        try {
            if ( CheckInput::checkNewInput($viewport) ) {
                $this->viewport = $viewport;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": viewport invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getViewport
     * 
     * @return mixed
     */
    public function getViewport()
    {
        return $this->viewport;
    }

    /**  setViews
     * 
     * @param string $views a view to use on this page
     * 
     * @return boolean
     */
    public function setViews( $views )
    {
        try {
            if ( CheckInput::checkNewInputArray($views) ) {
                $this->views[] = $views;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": views invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getViews
     *
     * @return mixed
     */
    public function getViews()
    {
        return $this->views;
    }

    /** onAction
     *
     * @return void
     */
    public function onAction()
    {       
            $this->controller->handleAction();
    }
}
/**
 * TODO: link only when used for HTML rendering from basicView
 * TODO: use page class to dictate the layout and bookend use
 */
