<?php
/**
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 7/9/13
 * Time: 6:56 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
interface emailInterface {
    static public function instance();

    /** setAdditionalHeaders
     * @param $additionalHeaders
     * @return mixed
     */
    public function setAdditionalHeaders( $additionalHeaders );

    /** setAdditionalParameters
     * @param $additionalParameters
     * @return mixed
     */
    public function setAdditionalParameters( $additionalParameters );

    /** setBcc
     * @param $bcc
     * @return mixed
     */
    public function setBcc( $bcc );

    /** setCc
     * @param $cc
     * @return mixed
     */
    public function setCc( $cc );

    /** setFrom
     * @param $from
     * @return mixed
     */
    public function setFrom( $from );

    /** setMessage
     * @param $message
     * @return mixed
     */
    public function setMessage( $message );

    /** setSubject
     * @param $subject
     * @return mixed
     */
    public function setSubject( $subject );

    /** setTo
     * @param $to
     * @return mixed
     */
    public function setTo( $to );
    public function sendHTML();
    public function send();

    /** addToHTMLHead
     * @param $str
     * @return mixed
     */
    public function addToHTMLHead( $str );

    /** sendDefaultEmail
     * @param $from
     * @param $to
     * @param $subject
     * @param $message
     * @return mixed
     */
    static public function sendDefaultEmail($from,$to,$subject,$message);
}