<?php

require_once "CheckInput.php";
require_once "interfaces".DIRECTORY_SEPARATOR."UserLevelCheckInterface.php";
/**
 * Class UserLevelCheck
 *
 * @category Core
 * @package  Helper
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/userLevelCheck
 */
class UserLevelCheck
    implements UserLevelCheckInterface
{
    /**
     * @var array userType the current user's various roles
     */
    protected $userType;
    /**
     * @var array permitAll the user types allowed all functionality
     */
    protected $permitAll;
    /**
     * @var array permitCreate the user types allowed to create
     */
    protected $permitCreate;
    /**
     * @var array permitUpdate the user types allowed to update
     */
    protected $permitUpdate;
    /**
     * @var array permitRead the user types allowed to read
     */
    protected $permitRead;
    /**
     * @var array permitNone the user types not allowed
     */
    protected $permitNone;
    /**
     * @var string currentRole the current role being tested
     */
    protected $currentRole;
    /**
     * @var array response holds if the user is allowed or not to perform a function
     */
    protected $response;

    /** __construct
     */
    public function __construct()
    {
        $this->permitAll = array();
        $this->permitCreate = array();
        $this->permitNone = array();
        $this->permitRead = array();
        $this->permitUpdate = array();
        $this->response = array(
            "all"=>null,
            "create"=>null,
            "update"=>null,
            "read"=>null,
            "none"=>null
        );
    }

    /**  setPermitAll
     *
     * @param array $permitAll the user types allowed all functionality
     *
     * @return boolean
     */
    public function setPermitAll( $permitAll )
    {
        try {
            if ( CheckInput::checkNewInputArray($permitAll) ) {
                $this->permitAll = $permitAll;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": permitAll is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**  setPermitCreate
     *
     * @param array $permitCreate the user types allowed create functionality
     *
     * @return boolean
     */
    public function setPermitCreate( $permitCreate )
    {
        try {
            if ( CheckInput::checkNewInputArray($permitCreate) ) {
                $this->permitCreate = $permitCreate;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": permitCreate is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**  setPermitNone
     *
     * @param array $permitNone the user types not allowed any functionality
     *
     * @return boolean
     */
    public function setPermitNone( $permitNone )
    {
        try {
            if ( CheckInput::checkNewInputArray($permitNone) ) {
                $this->permitNone = $permitNone;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": permitNone is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**  setPermitRead
     *
     * @param array $permitRead the user types allowed read functionality
     *
     * @return boolean
     */
    public function setPermitRead( $permitRead )
    {
        try {
            if ( CheckInput::checkNewInputArray($permitRead) ) {
                $this->permitRead = $permitRead;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": permitRead is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**  setPermitUpdate
     *
     * @param array $permitUpdate the user types allowed update functionality
     *
     * @return boolean
     */
    public function setPermitUpdate( $permitUpdate )
    {
        try {
            if ( CheckInput::checkNewInputArray($permitUpdate) ) {
                $this->permitUpdate = $permitUpdate;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": permitUpdate is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**  setUserType
     *
     * @param array $userType the current user's various roles
     *
     * @return boolean
     */
    public function setUserType( $userType )
    {
        try {
            if ( CheckInput::checkNewInputArray($userType) ) {
                $this->userType = $userType;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": userType is not valid");
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
            if ( CheckInput::checkNewInputArray($this->userType) ) {
                foreach ( $this->userType as $this->currentRole) {
                    $this->iterate();
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": user type not set");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** iterate
     *
     * @return void
     */
    protected function iterate()
    {
        $this->checkPermitAll();
        $this->checkPermitCreate();
        $this->checkPermitNone();
        $this->checkPermitRead();
        $this->checkPermitUpdate();
    }

    /** checkPermitAll
     *
     * @return bool
     */
    protected function checkPermitAll()
    {
        try {
            if ( in_array($this->currentRole, $this->permitAll) ) {
                if ( !CheckInput::checkSet($this->response["all"]) ) {
                    $this->response["all"] = true;
                }
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkPermitCreate
     *
     * @return bool
     */
    protected function checkPermitCreate()
    {
        try {
            if ( in_array($this->currentRole, $this->permitCreate) ) {
                if ( !CheckInput::checkSet($this->response["create"]) ) {
                    $this->response["create"] = true;
                }
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;

    }

    /** checkPermitUpdate
     *
     * @return bool
     */
    protected function checkPermitUpdate()
    {
        try {
            if ( in_array($this->currentRole, $this->permitUpdate) ) {
                if ( !CheckInput::checkSet($this->response["update"]) ) {
                    $this->response["update"] = true;
                }
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkPermitNone
     *
     * @return bool
     */
    protected function checkPermitNone()
    {
        try {
            if ( in_array($this->currentRole, $this->permitNone) ) {
                if ( !CheckInput::checkSet($this->response["none"]) ) {
                    $this->response["none"] = true;
                }
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkPermitRead
     *
     * @return bool
     */
    protected function checkPermitRead()
    {
        try {
            if ( in_array($this->currentRole, $this->permitRead) ) {
                if ( !CheckInput::checkSet($this->response["read"]) ) {
                    $this->response["read"] = true;
                }
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** checkSessionSet
     *
     * @return bool
     */
    protected function checkSessionSet()
    {
        if ( isset($_SESSION['user_type']) AND !is_null($_SESSION['user_type']) ) {
            return true;
        } else {
            return false;
        }
    }

    /** getResponse
     *
     * @return array|bool
     */
    public function getResponse()
    {
        try {
            if ( CheckInput::checkSetArray($this->response) ) {
                return $this->response;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": response invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** getSpecificResponse
     *
     * @param string $key the permission to get
     *
     * @return bool
     */
    public function getSpecificResponse($key)
    {
        try {
            if ( CheckInput::checkNewInput($key) ) {
                if ( $this->response[$key] == true ) {
                    return true;
                } else {
                    return false;
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": key must be set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }
}
/*
$uc = new UserLevelCheck();
$_SESSION["user_type"]=array("prospective","desk","mentor","administrator");
$uc->setPermitAll(array("administrator"));
$uc->setPermitCreate(array("mentor"));
$uc->setPermitUpdate(array("administrator","operations_management"));
$uc->setPermitRead(array("community","desk","mentor"));
$uc->setUserType($_SESSION["user_type"]);
$uc->execute();
print_r($uc->getResponse());
*/