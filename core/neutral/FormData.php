<?php
/**
 * PHP version 5.4.17
 * Created by JetBrains PhpStorm.
 * User: Carl "Tex" Morgan
 * Date: 3/19/13
 * Time: 3:30 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once "CheckInput.php";
require_once "SuperGlobal.php";
require_once "interfaces".DIRECTORY_SEPARATOR."FormDataInterface.php";
/**
 * Class FormData
 *
 * @category Helper
 * @package  Core
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/FormData
 */
class FormData
    implements FormDataInterface
{
    /**
     * @var array|null post holds values for $FormData->post
     */
    protected $post;
    /**
     * @var  array|null get holds values for $FormData->get
     */
    protected $get;
    /**
     * @var  array|null session holds values for $FormData->session
     */
    protected $session;
    /**
     * @var  array|null cookie holds values for $FormData->cookie
     */
    protected $cookie;
    /**
     * @var  array|null server holds values for $FormData->server
     */
    protected $server;

    /**  __construct()
     */
    public function __construct()
    {
    }

    /** loadSuperVariables
     *
     * @return bool
     */
    public function loadSuperVariables()
    {
        try {
            if ( $this->checkCookie() ) {
                $this->setCookie($_COOKIE);
            }
            if ( $this->checkSession() ) {
                $this->setSession($_SESSION);
            }
            if ( $this->checkServer() ) {
                $this->setServer($_SERVER);
            }
            if ( $this->checkGet() ) {
                $this->setGet($_GET);
            }
            if ( $this->checkPost() ) {
                $this->setPost($_POST);
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkCookie
     *
     * @return bool
     */
    protected function checkCookie()
    {
        if ( isset($_COOKIE) ) {
            if ( count($_COOKIE) > 0 ) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /** setCookie
     *
     * @param array $cookie manually set the cookie from another array
     *
     * @return bool
     */
    public function setCookie( $cookie )
    {
        try {
            if ( CheckInput::checkNewInput($cookie) ) {
                $this->cookie = new SuperGlobal($cookie);
                if ( isset($this->cookie) ) {
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . "$cookie is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**  getCookie
     *
     * @return mixed
     */
    public function getCookie()
    {
        return $this->cookie;
    }

    /** checkGet
     *
     * @return bool
     */
    protected function checkGet()
    {
        if ( isset($_GET) ) {
            if ( count($_GET) > 0 ) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /** setGet
     *
     * @param array $get manually set the get from another array
     *
     * @return bool
     */
    public function setGet( $get )
    {
        try {
            if ( CheckInput::checkNewInput($get) ) {
                $this->get = new SuperGlobal($get);
                if ( isset($this->get) ) {
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . "$get is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getGet
     *
     * @return array|null
     */
    public function getGet()
    {
        return $this->get;
    }

    /** checkPost
     *
     * @return bool
     */
    protected function checkPost()
    {
        if ( isset($_POST) ) {
            if ( count($_POST) > 0 ) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /** setPost
     *
     * @param array $post manually set the post from another array
     *
     * @return bool
     */
    public function setPost( $post )
    {
        try {
            if ( CheckInput::checkNewInput($post) ) {
                $this->post = new SuperGlobal($post);
                if ( isset($this->post) ) {
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . "$post is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** getPost
     *
     * @return array|null
     */
    public function getPost()
    {
        return $this->post;
    }

    /** checkServer
     *
     * @return bool
     */
    protected function checkServer()
    {
        if ( isset($_SERVER) ) {
            if ( count($_SERVER) > 0 ) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /** setServer
     *
     * @param array $server manually set the server from another array
     *
     * @return bool
     */
    public function setServer( $server )
    {
        try {
            if ( CheckInput::checkNewInput($server) ) {
                $this->server = new SuperGlobal($server);
                if ( isset($this->server) ) {
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . "$server is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }


    /** getServer
     *
     * @return array|null
     */
    public function getServer()
    {
        return $this->server;
    }

    /** checkSession
     *
     * @return bool
     */
    protected function checkSession()
    {
        if ( isset($_SESSION) ) {
            if ( count($_SESSION) > 0 ) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    /** setSession
     *
     * @param array $session manually set the session from another array
     *
     * @return bool
     */
    public function setSession( $session )
    {
        try {
            if ( CheckInput::checkNewInput($session) ) {
                $this->session = new SuperGlobal($session);
                if ( isset($this->session) ) {
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . "$session is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }


    /** getSession
     *
     * @return array|null
     */
    public function getSession()
    {
        return $this->session;
    }

    /** checkRequestPost
     *
     * @param string $index checks the post variable then the get variable
     *
     * @return bool
     */
    public function checkPostGet( $index )
    {
        try {
            if ( isset($this->post[$index]) ) {
                return $this->post[$index];
            } elseif ( isset($this->get[$index]) ) {
                return $this->get[$index];
            } else {
                return false;
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** getByKey
     *
     * @param array       $arr specific array to use
     * @param string|null $key specific array key to use
     *
     * @return mixed|boolean
     */
    public function getByKey( $arr, $key )
    {
        try {
            if ( CheckInput::checkNewInputArray($arr) ) {
                if ( $this->checkKey($arr, $key) ) {
                    return $this->$arr[$key];
                } else {
                    return $this->$arr;
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": The array must be set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** getByLocalKey
     *
     * @param array       $arr specific array to use
     * @param string|null $key specific array key to use
     *
     * @return mixed
     */
    public function getByLocalKey( $arr, $key)
    {
        try {
            if ( CheckInput::checkSetArray($arr) ) {
                return $this->$arr->getLocalArrayByKey($key);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": The array must be set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** checkKey
     *
     * @param array  $arr an array to test
     * @param string $key the index in the array
     *
     * @return bool
     */
    protected function checkKey($arr, $key)
    {
        try {
            if ( !isset($this->$arr[$key]) ) {
                throw new ExceptionHandler(__METHOD__ . ": Unknown key.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkExists
     *
     * @param array  $arr an array to test
     * @param string $key the index in the array
     *
     * @return bool
     */
    public function checkExists($arr,$key)
    {
        if ( isset($key,$arr) ) {
            if ( isset( $this->$arr) ) {
                if ( isset($this->$arr[$key] ) ) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /** onGet
     *
     * @return mixed
     */
    public function onGet()
    {

    }
    /** onPost
     *
     * @return mixed
     */
    public function onPost()
    {

    }
    /** onPut
     *
     * @return mixed
     */
    public function onPut()
    {

    }
}
/*
$fd = new FormData();
$fd->loadSuperVariables();
echo '<p><h2>Pre Button</h2>';
print_r($fd);
echo '</p>';
echo $fd->getByLocalKey("server","GEOIP_ADDR");
if(isset($_SERVER["REQUEST_METHOD"])){
    if(isset($_POST["submit"])){
        $fd2 = new FormData();
        $fd2->loadSuperVariables();
        echo '<p><h2>Post Button</h2>';
        print_r($fd2);
        echo '</p>';
    }
}
?>
<form>
    <button name="submit">Press Me</button>
</form>
 */