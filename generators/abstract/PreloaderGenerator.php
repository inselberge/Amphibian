<?php
/**
 * PHP Version: ${PHP_VERSION}
 * Created by PhpStorm.
 * User: carl
 * Date: 1/13/14
 * Time: 1:32 PM
 */
require_once "interfaces".DIRECTORY_SEPARATOR."PreloaderGeneratorInterface.php";
require_once "BasicGenerator.php";
/**
 * Class PreloaderGenerator
 *
 * @category 
 * @package  PreloaderGenerator
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/PreloaderGenerator
 */
abstract class PreloaderGenerator
    extends BasicGenerator
    implements PreloaderGeneratorInterface
{
    /** fetchAll
     *
     * @return bool
     */
    protected function fetchAll()
    {
        try {
            if (CheckInput::checkSet($this->connection)) {
                $this->tableArray = $this->connection->getTables();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": Connection is dead.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** iterate
     *
     * @return bool
     */
    protected function iterate()
    {
        return $this->addToBuffer();
    }

    /** addToBuffer
     *
     * @return bool
     */
    protected function addToBuffer()
    {
        try {
            if (CheckInput::checkSet($this->tableName)) {
                $this->buffer .= '/*'.PHP_EOL;
                $this->buffer .='* SEO specific to this page' . PHP_EOL;
                $this->buffer .='*/' . PHP_EOL;
                $this->buffer .='$author;' . PHP_EOL;
                $this->buffer .='$description;' . PHP_EOL;
                $this->buffer .='$keywords;' . PHP_EOL;
                $this->buffer .='$keywords_not;' . PHP_EOL;
                $this->buffer .='$page_title = "' . APP_NAME . ' - ';
                $this->buffer .= ucwords(_ToSpace($this->tableName)) . '";' . PHP_EOL;
                $this->buffer .='/*' . PHP_EOL;
                $this->buffer .=' * JavaScript and CSS specific to this page' . PHP_EOL;
                $this->buffer .=' */' . PHP_EOL;
                $this->buffer .='$js = array();' . PHP_EOL;
                $this->buffer .='$css = array();' . PHP_EOL;
                $this->buffer .='$prefetch = array();' . PHP_EOL;
                $this->buffer .='$dns = array();' . PHP_EOL;
                $this->buffer .='$prerender = array();' . PHP_EOL;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": tableName invalid.");
            }
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

} 