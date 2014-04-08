<?php
/**
 * PHP Version 5.4.9
 *
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 9/15/13
 * Time: 8:07 PM
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once "interfaces".DIRECTORY_SEPARATOR."TranslatorInterface.php";
/**
 * Class Translator
 *
 * @category Core
 * @package  Translator
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/Translator
 *
 */
abstract class Translator
    implements TranslatorInterface
{
    /**
     * @var string original the original string
     */
    protected $original;
    /**
     * @var array tokens holds individual parts of the string
     */
    protected $tokens;
    /**
     * @var string translation the translation of the string
     */
    protected $translation;
    /**
     * @var array comparisonOperators the operators for comparisons
     */
    static protected $comparisonOperators = array("gt","lt","gte","lte","eq","neq");
    /**
     * @var array existenceOperators the operators for IS and IS NOT
     */
    static protected $existenceOperators = array("is", "isn");
    /**
     * @var array similarityOperators the operators for LIKE and NOT LIKE
     */
    static protected $similarityOperators = array("lk", "nlk");
    /**
     * @var array directions the values for ASC and DSC
     */
    static protected $directions = array("as","de");
    /**
     * @var array conjunctions the values for OR, AND, and XOR conjunctions
     */
    static protected $conjunctions = array("or","and","xor");

    /** execute
     *
     * @throws ExceptionHandler
     *
     * @return bool
     */
    abstract public function execute();

    /** iterate
     *
     * @throws ExceptionHandler
     *
     * @return void
     */
    abstract protected function iterate();

    /** translateOperator
     *
     * @param string $operator the operator to convert
     *
     * @throws ExceptionHandler
     *
     * @return string|bool
     */
    abstract protected function translateOperator($operator);

    /** translateDirection
     *
     * @param string $direction the direction to convert
     *
     * @throws ExceptionHandler
     *
     * @return string|bool
     */
    abstract protected function translateDirection($direction);

    /** translateConjunction
     *
     * @param string $conjunction the conjunction to convert
     *
     * @throws ExceptionHandler
     *
     * @return string|bool
     */
    abstract protected function translateConjunction($conjunction);

    /**  setOriginal
     *
     * @param string $original the original string to translate
     *
     * @return boolean
     */
    public function setOriginal( $original )
    {
        try {
            if ( CheckInput::checkNewInput($original) ) {
                $this->original = $original;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": original is not valid");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getOriginal
     *
     * @return string
     */
    public function getOriginal()
    {
        return $this->original;
    }

    /** setTokens
     *
     * @return bool
     */
    protected function setTokens()
    {
        try {
            if ( CheckInput::checkSet($this->original) ) {
                $this->tokens = explode(' ', $this->original);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": original must be set");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** setTranslation
     *
     * @return bool
     */
    protected function setTranslation()
    {
        try {
            if ( CheckInput::checkSetArray($this->tokens) ) {
                $this->translation = implode(' ', $this->tokens);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": tokens must be set");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**   getTranslation
     *
     * @return string
     */
    public function getTranslation()
    {
        return $this->translation;
    }

    /** checkComparisonOperators
     *
     * @param string $operator the operator to check
     *
     * @return bool
     */
    protected function checkComparisonOperators($operator)
    {
        if ( in_array($operator, static::$comparisonOperators) ) {
            return true;
        } else {
            return false;
        }
    }

    /** checkExistenceOperators
     *
     * @param string $operator the operator to check
     *
     * @return bool
     */
    protected function checkExistenceOperators($operator)
    {
        if ( in_array($operator, static::$existenceOperators) ) {
            return true;
        } else {
            return false;
        }
    }

    /** checkSimilarityOperators
     *
     * @param string $operator the operator to check
     *
     * @return bool
     */
    protected function checkSimilarityOperators($operator)
    {
        if ( in_array($operator, static::$similarityOperators) ) {
            return true;
        } else {
            return false;
        }
    }
    /** checkConjunctions
     *
     * @param string $conjunction the conjunction to check
     *
     * @return bool
     */
    protected function checkConjunctions($conjunction)
    {
        if ( in_array($conjunction, static::$conjunctions) ) {
            return true;
        } else {
            return false;
        }
    }

    /** checkDirections
     *
     * @param string $indicator the direction to check
     *
     * @return bool
     */
    protected function checkDirections($indicator)
    {
        if ( in_array($indicator, static::$directions) ) {
            return true;
        } else {
            return false;
        }
    }
}