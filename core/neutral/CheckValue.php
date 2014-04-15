<?php
/*
 * TODO: Integrate back in escape_data
 * TODO: Add more specific error messages
 * TODO: Remove some of the duplicate checks, i.e. email
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once "CheckInput.php";
require_once "interfaces".DIRECTORY_SEPARATOR."CheckValueInterface.php";
/**
 * Class CheckValue
 *
 * @category Helper
 * @package  Core
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/CheckValue
 */
class CheckValue
    extends CheckInput
    implements CheckValueInterface
{
    /**
     * @var mixed value holds values for $CheckValue->value
     */
    protected $value;
    /**
     * @var integer type holds values for $CheckValue->type
     */
    protected $type;

    /**
     * @var array acceptableTypes the only acceptable values for type
     */
    static protected $acceptableTypes = array(
        2,3,4,5,6,7,8,9,10,11,12,
        13,14,15,16,17,18,19,20,21,
        22,23,24,25,26,27,28,29,30,
        31,32
    );

    const  URL_FORMAT = '/^(https?):\/\/(([a-z0-9$_\.\+!\*\'\(\),;\?&=-]|%[0-9a-f]{2})+(:([a-z0-9$_\.\+!\*\'\(\),;\?&=-]|%[0-9a-f]{2})+)?@)?(?#)((([a-z0-9]\.|[a-z0-9][a-z0-9-]*[a-z0-9]\.)*[a-z][a-z0-9-]*[a-z0-9]|((\d|[1-9]\d|1\d{2}|2[0-4][0-9]|25[0-5])\.){3}(\d|[1-9]\d|1\d{2}|2[0-4][0-9]|25[0-5]))(:\d+)?)(((\/+([a-z0-9$_\.\+!\*\'\(\),;:@&=-]|%[0-9a-f]{2})*)*(\?([a-z0-9$_\.\+!\*\'\(\),;:@&=-]|%[0-9a-f]{2})*)?)?)?(#([a-z0-9$_\.\+!\*\'\(\),;:@&=-]|%[0-9a-f]{2})*)?$/i';

    /** __construct
     */
    public function __construct()
    {
        $this->value = null;
        $this->type  = null;
    }

    /**  setType
     *
     * @param integer $type the value type
     *
     * @return boolean
     */
    public function setType( $type )
    {
        try {
            if ( CheckInput::checkNewInput($type) ) {
                if(in_array($type, self::$acceptableTypes)){
                    $this->type = $type;
                } else {
                    throw new ExceptionHandler(__METHOD__ . ": unacceptable type");
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": type is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**  setValue
     *
     * @param mixed $value the value to check
     *
     * @return boolean
     */
    public function setValue( $value )
    {
        try {
            if ( CheckInput::checkNewInput($value) ) {
                $this->value = $value;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": value is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** evaluateInput
     *
     * @return void
     */
    public function evaluateInput()
    {
        $this->value = stripslashes(trim($this->value));
        switch ( $this->type ) {
            //password - at least one number, lowercase letter, uppercase letter, special character, and be 6-20 characters
        case 2:
            $this->forkResponse($this->checkRegEx("/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{6,20}$/"));
            break;
        //first or last name
        case 3:
            $this->forkResponse($this->checkRegEx("/^[A-Z \'.-]{2,32}$/i"));
            break;
        //City
        case 4:
            $this->forkResponse($this->checkRegEx("/^[A-Za-z \'-]{2,15}$/"));
            break;
        //State
        case 5:
            $this->forkResponse($this->checkRegEx("/^[A-Z]{2,2}$/"));
            break;
        //Zip
        case 6:
            $this->forkResponse($this->checkRegEx("/^[0-9]{5,5}$/"));
            break;
        //Phone
        case 7:
            $this->forkResponse($this->checkRegEx("/^[0-9]{10,10}$/"));
            break;
        //Email
        case 8:
            $this->forkResponse($this->checkRegEx("/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/"));
            break;
        //Address
        case 9:
            $this->forkResponse($this->checkRegEx("/^[A-Za-z0-9\.\'\- \,#]{4,32}$/"));
            break;
        //Comments
        case 10:
            $this->forkResponse($this->checkSafety($this->value));
            break;
        //Month
        case 11:
            $this->forkResponse($this->checkRegEx("/^[[1-9]|1[0-2]]{1,2}$/"));
            break;
        //Year
        case 12:
            $this->forkResponse($this->checkRegEx("/^[19[0-9][0-9]|20[0-3][0-9]]$/"));
            break;
        //Day
        case 13:
            $this->forkResponse($this->checkRegEx("/^[[1-9]|[1-2][0-9]|3[0-1]]$/"));
            break;
        //Hour
        case 14:
            $this->forkResponse($this->checkRegEx("/^[[0-9]|1[0-9]|2[0-3]]{1,2}$/"));
            break;
        //Minute
        case 15:
            $this->forkResponse($this->checkRegEx("/^[[0-9]|[1-5][0-9]]{1,2}$/"));
            break;
        //Web Page
        case 16:
            $this->forkResponse($this->checkRegEx(self::URL_FORMAT));
            //$this->forkResponse($this->checkRegEx("/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:.[A-Z0-9][A-Z0-9_-]*)+):?(d+)?/?/i"));
            break;
        //Email 2
        case 17:
            $this->forkResponse($this->checkRegEx("/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/"));
            break;
        //Phone 2
        case 18:
            $this->forkResponse($this->validateTelephoneNumber());
            break;
        //Full Date MM-DD-YYYY or MM/DD/YYYY
        case 19:
            $this->forkResponse($this->validateDate());
            break;
        //Time
        case 20:
            $this->forkResponse($this->validateTime());
            break;
        //Positive Integer
        case 21:
            $this->forkResponse($this->checkPositiveInteger());
            break;
        //Negative Integer
        case 22:
            $this->forkResponse($this->checkNegativeInteger());
            break;
        //Integer
        case 23:
            $this->forkResponse($this->checkInteger());
            break;
        //Positive Float
        case 24:
            $this->forkResponse($this->checkPositiveNumber());
            break;
        //Negative Float
        case 25:
            $this->forkResponse($this->checkNegativeNumber());
            break;
        //Float
        case 26:
            $this->forkResponse($this->checkNumber());
            break;
        //IPv4
        case 27:
            $this->forkResponse($this->checkIPv4());
            break;
        //No Input
        case 28:
            $this->forkResponse($this->checkNoInput());
            break;
        //Blanks
        case 29:
            $this->forkResponse($this->checkBlank());
            break;
        //Returns
        case 30:
            $this->forkResponse($this->checkReturnLine());
            break;
        //Email 3
        case 31:
            $this->forkResponse($this->checkEmail());
            break;
        //Over 18
        case 32:
            $this->forkResponse($this->checkBirthday());
            break;
        //Default
        default:
            $this->bad();
            break;
        }
    }

    /** forkResponse
     * 
     * @param bool $response the response of a check
     * 
     * @return void
     */    
    protected function forkResponse( $response )
    {
        if ( $response === true ) {
            $this->good();
        } else {
            $this->bad();
        }
    }
    
    /** good
     *
     * @return void
     */
    protected function good()
    {
        echo "<span class='success'>:)</span>";
    }

    /** bad
     *
     * @return void
     */
    protected function bad()
    {
        echo '<div class="ui-widget col-lg-3">
<div class="ui-state-error ui-corner-all" style="">
<span class="ui-icon ui-icon-alert" style="float: left;"></span>
<strong>Alert:</strong>
Please correct this value.
</div>
</div>';
    }

    /** setVariables
     *
     * @return bool
     */
    public function setVariables()
    {
        try {
            if ( isset($_GET['v']) AND !is_null($_GET['v']) ) {
                $this->setValue($_GET['v']);
            } else {
                $this->value = null;
            }
            if ( isset($_GET['t']) AND $_GET['t'] !== null ) {
                $this->setType($_GET['t']);
            } else {
                $this->type = null;
            }
            if ( !CheckInput::checkNewInput($this->type) ) {
                throw new ExceptionHandler(__METHOD__ . ": invalid type");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** validateTelephoneNumber
     *
     * @return bool
     */
    protected function validateTelephoneNumber()
    {
        $formats = array( '###-###-####',
            '(###)###-####',
            '##########',
            '###.###.####',
            '(###) ###-####'
        );
        $format  = trim(preg_replace("/[0-9]/", "#", $this->value));
        if ( in_array($format, $formats) ) {
            return true;
        } else {
            return false;
        }
    }

    /** validateDate
     *
     * @return bool
     */
    protected function validateDate()
    {
        if ( preg_match("/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/", $this->value, $parts) ) {
            if ( checkdate($parts[1], $parts[2], $parts[3]) ) {
                return true;
            }
        } else {
            if ( preg_match("/^([0-9]{2})-([0-9]{2})-([0-9]{4})$/", $this->value, $parts) ) {
                if ( checkdate($parts[1], $parts[2], $parts[3]) ) {
                    return true;
                }
            }
        }
        return false;
    }

    /** validateTime
     *
     * @return bool
     */
    protected function validateTime()
    {
        if ( !preg_match("/^[0-2][0-9]:[0-9]{2}/", $this->value) ) {
            return false;
        } else {
            return true;
        }
    }

    /** checkVariables
     *
     * @return bool
     */
    public function checkVariables()
    {
        if ( isset($this->value, $this->type) AND !is_null($this->value) AND !is_null($this->type) ) {
            return true;
        } else {
            return false;
        }
    }

    /** checkPositiveInteger
     *
     * @return bool
     */
    protected function checkPositiveInteger()
    {
        return $this->checkRegEx("/^[0-9]+$/");
    }

    /** checkNegativeInteger
     *
     * @return bool
     */
    protected function checkNegativeInteger()
    {
        return $this->checkRegEx("/^-[0-9]+$/");
    }

    /** checkInteger
     *
     * @return bool
     */
    protected function checkInteger()
    {
        return $this->checkRegEx("/^-{0,1}[0-9]+$/");
    }

    /** checkPositiveNumber
     *
     * @return bool
     */
    protected function checkPositiveNumber()
    {
        return $this->checkRegEx("/^[0-9]*\.{0,1}[0-9]+$/");
    }

    /** checkNegativeNumber
     *
     * @return bool
     */
    protected function checkNegativeNumber()
    {
        return $this->checkRegEx("/^-[0-9]*\.{0,1}[0-9]+$/");
    }

    /** checkNumber
     *
     * @return bool
     */
    protected function checkNumber()
    {
        return $this->checkRegEx("/^-{0,1}[0-9]*\.{0,1}[0-9]+$/");
    }

    /** checkIPv4
     *
     * @return bool
     */
    protected function checkIPv4()
    {
        return $this->checkRegEx("/^(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/");
    }

    /** checkNoInput
     *
     * @return bool
     */
    protected function checkNoInput()
    {
        return $this->checkRegEx("/^$/");
    }

    /** checkBlank
     *
     * @return bool
     */
    protected function checkBlank()
    {
        return $this->checkRegEx("/^\s*$/");
    }

    /** checkReturnLine
     *
     * @return bool
     */
    protected function checkReturnLine()
    {
        return $this->checkRegEx("/[\r\n]|$/");
    }

    /** checkEmail
     *
     * @return bool
     */
    protected function checkEmail()
    {
        return $this->checkRegEx("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/");
    }

    /** checkRegEx
     *
     * @param string $regex a regular expression
     *
     * @return bool
     */
    protected function checkRegEx( $regex )
    {
        if ( preg_match($regex, $this->value) ) {
            return true;
        } else {
            return false;
        }
    }

    /** checkBirthday
     *
     * @return bool
     */
    protected function checkBirthday()
    {
        $birthday = new DateTime($this->value);
        $birthday->format('Y-m-d');
        $cutoff = new DateTime("now");
        date_sub($cutoff, date_interval_create_from_date_string('18 years'));
        $interval = $birthday->diff($cutoff);

        if ( $interval->format('%r%a') > 0 ) {
            return true;
        } else {
            return false;
        }
    }
}

$vc = new CheckValue();
$vc->setVariables();
if ( $vc->checkVariables() ) {
    $vc->evaluateInput();
} else {
    return false;
}
