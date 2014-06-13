<?php
/**
 * PHP version 5.4.17
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 6/22/13
 * Time: 6:49 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once "CheckInput.php";
require_once "interfaces".DIRECTORY_SEPARATOR."EmailInterface.php";
/**
 * Class Email
 * 
 * @category Core
 * @package  Core
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/Email
 */
class Email
    implements EmailInterface
{
    /**
     * @var string to where the Email is being sent
     */
    protected $to;
    /**
     * @var string from where the Email originated
     */
    protected $from;
    /**
     * @var string replyTo to whom we should reply
     */
    protected $replyTo;
    /**
     * @var string cc who we should carbon copy
     */
    protected $cc;
    /**
     * @var string bcc who we should blank carbon copy
     */
    protected $bcc;
    /**
     * @var string subject the subject of the Email
     */
    protected $subject;
    /**
     * @var string message the message to send
     */
    protected $message;
    /**
     * @var string additionalHeaders the additional headers to the Email
     */
    protected $additionalHeaders;
    /**
     * @var string additionalParameters the additional parameters for sending
     */
    protected $additionalParameters;
    /**
     * @var string htmlHead the head of the html Email
     */
    protected $htmlHead;
    /**
     * @var string html holds the content of the Email
     */
    protected $html;
    /**
     * @var object Email a singleton instance of this class
     */
    public static $Email;

    /** __construct
     */
    protected function __construct()
    {
    }

    /** instance
     *
     * @return Email|object
     */
    public static function instance()
    {
        if ( !isset(self::$Email) ) {
            self::$Email = new Email();
        }
        return self::$Email;
    }

    /** setAdditionalHeaders
     *
     * @param string $additionalHeaders additional headers to add to the Email
     *
     * @return bool
     */
    public function setAdditionalHeaders( $additionalHeaders )
    {
        try {
            if ( CheckInput::checkNewInput($additionalHeaders) ) {
                if ( isset($this->additionalHeaders) ) {
                    $this->additionalHeaders .= $additionalHeaders;
                } else {
                    $this->additionalHeaders = $additionalHeaders;
                }
            } else {
                throw new ExceptionHandler(__METHOD__.":additionalHeaders invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setAdditionalParameters
     *
     * @param string $additionalParameters additional parameters to send Email
     *
     * @return bool
     */
    public function setAdditionalParameters( $additionalParameters )
    {
        try {
            if ( CheckInput::checkNewInput($additionalParameters) ) {
                if ( isset($this->additionalParameters) ) {
                    $this->additionalParameters .= $additionalParameters;
                } else {
                    $this->additionalParameters = $additionalParameters;
                }
            } else {
                throw new ExceptionHandler(__METHOD__.":additionalParameters invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setBcc
     *
     * @param string $bcc the values of blank carbon copy
     *
     * @return bool
     */
    public function setBcc( $bcc )
    {
        try {
            if ( CheckInput::checkNewInput($bcc) ) {
                if ( isset($this->bcc) ) {
                    $this->bcc .= ", " . $bcc;
                } else {
                    $this->bcc = $bcc;
                }
            } else {
                throw new ExceptionHandler(__METHOD__.":bcc invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setCc
     *
     * @param string $cc the values of carbon copy
     *
     * @return bool
     */
    public function setCc( $cc )
    {
        try {
            if ( CheckInput::checkNewInput($cc) ) {
                if ( isset($this->cc) ) {
                    $this->cc .= ", " . $cc;
                } else {
                    $this->cc = $cc;
                }
            } else {
                throw new ExceptionHandler(__METHOD__.":cc invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setFrom
     *
     * @param string $from the source of the Email
     *
     * @return bool
     */
    public function setFrom( $from )
    {
        try {
            if ( CheckInput::checkNewInput($from) ) {
                $this->from = $from;
            } else {
                throw new ExceptionHandler(__METHOD__.":from invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }


    /** setMessage
     *
     * @param string $message the message to send in the Email
     *
     * @return bool
     */
    public function setMessage( $message )
    {
        try {
            if ( CheckInput::checkNewInput($message) ) {
                if ( isset($this->message) ) {
                    $this->message .= wordwrap($message, 70, "\r" . PHP_EOL);
                } else {
                    $this->message = wordwrap($message, 70, "\r" . PHP_EOL);
                }
            } else {
                throw new ExceptionHandler(__METHOD__.":message invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setSubject
     *
     * @param string $subject the subject of the Email
     *
     * @return bool
     */
    public function setSubject( $subject )
    {
        try {
            if ( CheckInput::checkNewInput($subject) ) {
                if ( isset($this->subject) ) {
                    $this->subject .= $subject;
                } else {
                    $this->subject = $subject;
                }
            } else {
                throw new ExceptionHandler(__METHOD__.":subject invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }


    /** setTo
     *
     * @param string $to the destination of the Email
     *
     * @return bool
     */
    public function setTo( $to )
    {
        try {
            if ( CheckInput::checkNewInput($to) ) {
                if ( isset($this->to) ) {
                    $this->to .= ", " . $to;
                } else {
                    $this->to = $to;
                }
            } else {
                throw new ExceptionHandler(__METHOD__.":to invalid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** sendHTML
     *
     * @return bool
     */
    public function sendHTML()
    {
        if ( $this->checkRequired() ) {
            $this->setDefaultHTMLHeaders();
            $this->buildAdditionalHeaders();
            $this->buildHTMLMessage();
            return mail(
                $this->to,
                $this->subject,
                $this->html,
                $this->additionalHeaders
            );
        } else {
            return false;
        }
    }

    /** send
     *
     * @return bool
     */
    public function send()
    {
        if ( $this->checkRequired() ) {
            $this->buildAdditionalHeaders();
            /*
             * TODO: Arguments 1, 2, 4 and 5 of this function may be passed to an
             * external program.
             * (Usually sendmail).
             * Under Windows, they will be passed to a
             * remote Email server. If these values are derived from user input, make
             * sure they are properly formatted and contain no unexpected characters
             * or extra data.
             */
            return mail(
                $this->to,
                $this->subject,
                $this->message,
                $this->additionalHeaders
            );
        } else {
            return false;
        }
    }

    /** checkRequired
     *
     * @return bool
     */
    protected function checkRequired()
    {
        if ( isset($this->to, $this->subject, $this->message, $this->from) ) {
            return true;
        } else {
            return false;
        }
    }

    /** addToHTMLHead
     *
     * @param string $str string to add to the HTML head
     *
     * @return bool
     */
    public function addToHTMLHead( $str )
    {
        try {
            if ( CheckInput::checkNewInput($str) ) {
                if ( isset($this->htmlHead) ) {
                    $this->htmlHead .= $str;
                } else {
                    $this->htmlHead = $str;
                }
            } else {
                throw new ExceptionHandler(__METHOD__.":addToHTMLHead failed.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setDefaultHTMLHeaders
     *
     * @return void
     */
    protected function setDefaultHTMLHeaders()
    {
        $this->additionalHeaders = 'MIME-Version: 1.0' . "\r" . PHP_EOL;
        $this->additionalHeaders 
            .= 'Content-type: text/html; charset=utf-8' . "\r" . PHP_EOL;
    }

    /** buildAdditionalHeaders
     *
     * @return void
     */
    protected function buildAdditionalHeaders()
    {
        if ( CheckInput::checkSet($this->to) ) {
            //$this->addTo();
        }
        if ( CheckInput::checkSet($this->from) ) {
            $this->addFrom();
        }
        if ( CheckInput::checkSet($this->replyTo) ) {
            $this->addReplyTo();
        }
        if ( CheckInput::checkSet($this->cc) ) {
            $this->addCC();
        }
        if ( CheckInput::checkSet($this->bcc) ) {
            $this->addBCC();
        }
    }

    /** addTo
     *
     * @return void
     */
    protected function addTo()
    {
        $this->additionalHeaders .= 'To: ' . "\r" . PHP_EOL;
    }

    /** addFrom
     *
     * @return void
     */
    protected function addFrom()
    {
        $this->additionalHeaders .= 'From: ' . $this->from . "\r" . PHP_EOL;
    }

    /** addReplyTo
     *
     * @return void
     */
    protected function addReplyTo()
    {
        $this->additionalHeaders .= 'Reply-To: ' . $this->replyTo . "\r" . PHP_EOL;
    }

    /** addCC
     *
     * @return void
     */
    protected function addCC()
    {
        $this->additionalHeaders .= 'Cc: ' . $this->cc . "\r" . PHP_EOL;
    }

    /** addBCC
     *
     * @return void
     */
    protected function addBCC()
    {
        $this->additionalHeaders .= 'Bcc: ' . $this->bcc . "\r" . PHP_EOL;
    }

    /** buildHTMLMessage
     *
     * @return void
     */
    protected function buildHTMLMessage()
    {
        $this->startHTMLHead();
        $this->addTitle();
        if ( CheckInput::checkSet($this->htmlHead) ) {
            $this->html .= $this->htmlHead;
        }
        $this->endHTMLHead();
        $this->startHTMLBody();
        $this->addContent();
        $this->endHTMLBody();
    }

    /** startHTMLHead
     *
     * @return void
     */
    protected function startHTMLHead()
    {
        $this->html = '<html><head>';
    }

    /** addTitle
     *
     * @return void
     */
    protected function addTitle()
    {
        $this->html .= '<title>' . $this->subject . '</title>';
    }

    /** endHTMLHead
     *
     * @return void
     */
    protected function endHTMLHead()
    {
        $this->html .= '</head>';
    }

    /** startHTMLBody
     *
     * @return void
     */
    protected function startHTMLBody()
    {
        $this->html .= '<body>';
    }

    /** addContent
     *
     * @return void
     */
    protected function addContent()
    {
        $this->html .= $this->message;
    }

    /** endHTMLBody
     *
     * @return void
     */
    protected function endHTMLBody()
    {
        $this->html .= '</body></html>';
    }

    /** sendDefaultEmail
     *
     * @param string $from    the source of the Email
     * @param string $to      the destination of the Email
     * @param string $subject the subject of the Email
     * @param string $message the message to send
     *
     * @return void
     */
    static public function sendDefaultEmail($from,$to,$subject,$message)
    {
        self::$Email=self::instance();
        self::$Email->setTo(trim($to));
        self::$Email->setFrom($from);
        self::$Email->setSubject($subject);
        self::$Email->setMessage($message);
        self::$Email->sendHTML();
        //print_r(self::$Email);
    }
}
/*
$em = Email::instance();
$em->setFrom("texmorgan@gmail.com");
$em->setSubject("Testing " . date('Y-m-d H:i:s'));
$em->setTo("texmorgan@gmail.com");
$em->setMessage("Hello, I am a test Email");
echo $em->send();
print_r($em);
*/
/*
$notify_Email="no-reply@members.geekdom.com";
Email::sendDefaultEmail($notify_Email,
    "texmorgan@gmail.com",
    "Members.Geekdom: Your password has been reset",
    "Your password is now: dfanklne3\r\nPlease log in and change it.");
*/
