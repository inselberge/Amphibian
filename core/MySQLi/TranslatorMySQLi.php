<?php
/**
 * PHP Version 5.4.9-4ubuntu2.2
 *
 * Created by JetBrains PhpStorm.
 * Project: Amphibian
 * User: Carl "Tex" Morgan
 * Date: 9/15/13
 * Time: 8:05 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
require_once "interfaces".DIRECTORY_SEPARATOR."TranslatorMySQLiInterface.php";
require_once AMPHIBIAN_CORE_ABSTRACT ."Translator.php";
/**
 * Class TranslatorMySQLi
 *
 * @category Core
 * @package  Translator
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/TranslatorMySQLi
 */
class TranslatorMySQLi
    extends Translator
    implements TranslatorMySQLiInterface
{
    /**
     * @var string currentKey holds the current key
     */
    protected $currentKey;
    /**
     * @var string currentToken holds the current token
     */
    protected $currentToken;
    /**
     * @var  translatorMySQLi holds values for $TranslatorMySQLi->translatorMySQLi
     */
    static public $translatorMySQLi;

    /** __construct
     */
    protected function __construct()
    {
    
    }

    /** instance
     *
     * @throws ExceptionHandler
     *
     * @return TranslatorMySQLi
     */
    static public function instance()
    {
        if ( !isset(self::$translatorMySQLi) ) {
            self::$translatorMySQLi = new translatorMySQLi(); 
        }
        return self::$translatorMySQLi;
    }

    /** execute
     *
     * @throws ExceptionHandler
     *
     * @return bool
     */
    public function execute()
    {
        try {
            if ( CheckInput::checkNewInput($this->original) ) {
                if ( $this->setTokens() ) {
                    foreach ( $this->tokens as $this->currentKey => $this->currentToken ) {
                        $this->iterate();
                    }
                }
            } else {
                throw new ExceptionHandler(__METHOD__ . ": original not set.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** iterate
     *
     * @throws ExceptionHandler
     *
     * @return void
     */
    protected function iterate()
    {

    }

    /** translateOperator
     *
     * @param string $operator the operator to translate
     *
     * @throws ExceptionHandler
     *
     * @return bool|string
     */
    protected function translateOperator($operator)
    {
        try {
            if ( $this->checkComparisonOperators($operator) ) {
                return $this->translateComparisonOperator($operator);
            } elseif ( $this->checkExistenceOperators($operator) ) {
                return $this->translateExistenceOperator($operator);
            } elseif ( $this->checkSimilarityOperators($operator)) {
                return $this->translateSimilarityOperator($operator);
            } else {
                throw new ExceptionHandler(__METHOD__ . ": unknown operator.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** translateComparisonOperator
     *
     * @param string $operator the operator to translate
     *
     * @return bool|string
     */
    protected function translateComparisonOperator($operator)
    {
        try {
            if ( $operator == 'gt' ) {
                return ' > ';
            } elseif ($operator == 'lt') {
                return ' < ';
            } elseif ($operator == 'gte') {
                return ' >= ';
            } elseif ($operator == 'lte') {
                return ' <= ';
            } elseif ($operator == 'eg') {
                return ' = ';
            } elseif ($operator == 'neg') {
                return ' != ';
            } else {
                throw new ExceptionHandler(__METHOD__ . ": unknown operator");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** translateExistenceOperator
     *
     * @param string $operator the operator to translate
     *
     * @return bool|string
     */
    protected function translateExistenceOperator($operator)
    {
        try {
            if ($operator == 'is') {
                return ' IS ';
            } elseif ($operator == 'isn') {
                return ' IS NOT ';
            } else {
                throw new ExceptionHandler(__METHOD__ . ": unknown operator");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** translateSimilarityOperator
     *
     * @param string $operator the operator to translate
     *
     * @return bool|string
     */
    protected function translateSimilarityOperator($operator)
    {
        try {
            if ($operator == 'lk') {
                return ' LIKE ';
            } elseif ($operator == 'nlk') {
                return ' NOT LIKE ';
            } else {
                throw new ExceptionHandler(__METHOD__ . ": unknown operator");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** translateDirection
     *
     * @param string $direction the direction of the sorting
     *
     * @throws ExceptionHandler
     *
     * @return bool|string
     */
    protected function translateDirection( $direction )
    {
        try {
            if ( $direction == "as" ) {
                return ' ASC ';
            } elseif ( $direction == "de" ) {
                return ' DESC ';
            } else {
                throw new ExceptionHandler(__METHOD__ . ": invalid direction");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
    }

    /** translateConjunction
     *
     * @param string $conjunction the conjunction to convert
     *
     * @throws ExceptionHandler
     *
     * @return bool|string
     */
    protected function translateConjunction($conjunction)
    {
        try {
            if ( CheckInput::checkNewInput($conjunction) ) {
                if ( $conjunction == "and" ) {
                    return ' AND ';
                } elseif ( $conjunction == "or") {
                    return ' OR ';
                } elseif ( $conjunction == "xor") {
                    return ' XOR ';
                } else {
                    throw new ExceptionHandler(__METHOD__.": unknown conjunction");
                }
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }
}