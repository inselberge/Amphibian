<?php
//userInteractionsGenerator.php
require_once __DIR__ . DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."config.inc.php";
//require_once AMPHIBIAN_CONFIG."Members.Geekdom.config.inc.php";
//require_once AMPHIBIAN_CONFIG."Coworks.In.config.inc.php";
//require_once AMPHIBIAN_CONFIG."InnerAlly.config.inc.php";
require_once MYSQL;
require_once AMPHIBIAN_CORE . "BasicInteraction.php";
require_once "interfaces".DIRECTORY_SEPARATOR."userInteractionGeneratorInterface.php";
/**
 * Class UserInteractionGenerator
 */
class UserInteractionGenerator
    extends BasicInteraction
    implements UserInteractionGeneratorInterface
{
    private $_allTables;
    private $_FileHandle;
    private $_currentTableName;
    private $_lowerCurrentTableName;
    private $_query;
    private $_queryResult;

    /**
     * @param $name
     * @return bool
     */
    public function setTableName( $name )
    {
        try {
            if ( $this->checkNewInput($name) ) {
                $this->_currentTableName      = $name;
                $this->_lowerCurrentTableName = strtolower($name);
                return true;
            } else {
                throw new Exception(__CLASS__ . "::" . __FUNCTION__ . ": Tne current table name could not be set.");
            }
        } catch ( Exception $e ) {
            echo utf8_encode(date('Y-m-d H:i:s') . " " . __CLASS__ . "::" . __FUNCTION__ . ": " . $e);
            return false;
        }
    }

    /**
     * @return bool
     */
    public function execute()
    {
        try {
            if ( isset($this->_currentTableName) ) {
                $this->iterate();
            } elseif ( $this->getAllTables() ) {
                foreach ( $this->_allTables as $key => $this->_currentTableName ) {
                    $this->_lowerCurrentTableName = strtolower($this->_currentTableName);
                    $this->iterate();
                }
            } else {
                throw new Exception(__CLASS__ . "::" . __FUNCTION__ . ": Generation of the user interaction pages failed.");
            }
        } catch ( Exception $e ) {
            echo utf8_encode(date('Y-m-d H:i:s') . " " . __CLASS__ . "::" . __FUNCTION__ . ": " . $e);
            return false;
        }
        return true;
    }

    /**
     * @return bool
     */
    private function getAllTables()
    {
        try {
            $this->_allTables = getTables($this->connection);
            if ( is_array($this->_allTables) ) {
            } else {
                throw new Exception(__CLASS__ . "::" . __FUNCTION__ . ": Failed to get the table names.");
            }
        } catch ( Exception $e ) {
            echo utf8_encode(date('Y-m-d H:i:s') . " " . __CLASS__ . "::" . __FUNCTION__ . ": " . $e);
            return false;
        }
        return true;
    }

    /**
     * @return bool
     */
    private function iterate()
    {
        try {
            if ( $this->verifyTable() ) {
                $this->openFilePointer();
                $this->writeUserInteraction();
                $this->closeFilePointer();
            } else {
                throw new Exception(__CLASS__ . "::" . __FUNCTION__ . ": Failed to verify the table.");
            }
        } catch ( Exception $e ) {
            echo utf8_encode(date('Y-m-d H:i:s') . " " . __CLASS__ . "::" . __FUNCTION__ . ": " . $e);
            return false;
        }
        return true;
    }

    /**
     * @return bool
     */
    private function verifyTable()
    {
        try {
            $this->_query       = "SELECT count(1) FROM `" . $this->_currentTableName . "`";
            $this->_queryResult = mysqli_query($this->connection, $this->_query);
            if ( mysqli_num_rows($this->_queryResult) >= 0 ) {
                return true;
            } else {
                throw new Exception(__CLASS__ . "::" . __FUNCTION__ . ": Failed to select from $this->_currentTableName.");
            }
        } catch ( Exception $e ) {
            echo utf8_encode(date('Y-m-d H:i:s') . " " . __CLASS__ . "::" . __FUNCTION__ . ": " . $e);
            return false;
        }
    }

    /**
     * @internal param $this ->_currentTableName
     * @return resource
     */
    private function openFilePointer()
    {
        try {
            checkDirectory(PUBLIC_BASE_URI);
            $this->_FileHandle = fopen(PUBLIC_BASE_URI . $this->_lowerCurrentTableName . ".php", "w");
        } catch ( Exception $e ) {
            echo utf8_encode(date('Y-m-d H:i:s') . " " . __CLASS__ . "::" . __FUNCTION__ . ": " . $e);
            return false;
        }
        return true;
    }

    /**
     * @internal param $this ->_FileHandle
     * @internal param $this ->_currentTableName
     */
    private function writeUserInteraction()
    {
        fwrite($this->_FileHandle, '<?php
require_once __DIR__."/../config/config.inc.php";
/*
* SEO specific to this page
*/
$author;
$description;
$keywords;
$keywords_not;
$page_title = "' . APP_NAME . ' - ' . ucwords(_ToSpace($this->_currentTableName)) . '";
/*
 * JavaScript and CSS specific to this page
 */
$js = array();
$css = array();
$prefetch = array();
$dns = array();
$prerender = array();
// Include the header file:
include BOOKENDS."header.html";
// For storing errors:
$errors = array();' . "\n");
        fwrite($this->_FileHandle, 'require_once MODELS_GENERATED."' . $this->_lowerCurrentTableName . '.php";' . "\n");
        fwrite($this->_FileHandle, '$'.$this->_lowerCurrentTableName.'Model = new ' . $this->_currentTableName . 'Model($databaseConnectionUser);' . "\n");
        fwrite($this->_FileHandle, 'include_once AGENCIES_GENERATED."view' . $this->_lowerCurrentTableName . '.php";' . "\n");
        fwrite($this->_FileHandle, '$'.$this->_lowerCurrentTableName.'Agency = view' . $this->_currentTableName . 'Agency::instance($databaseConnectionBrowse);' . "\n");
        //fwrite($this->_FileHandle, "echo '" . '<div class="hero-unit shadow"><hgroup><h1>' . ucwords(_ToSpace($this->_currentTableName)) . '</h1><h3></h3></hgroup></div>' . "';" . "\n");
        fwrite($this->_FileHandle, 'require_once CONTROLLERS_GENERATED . "' . $this->_lowerCurrentTableName . '.php";' . "\n");

        fwrite($this->_FileHandle, 'switch($'.$this->_lowerCurrentTableName.'Controller->getAction()){'."\n");
        fwrite($this->_FileHandle, '    case "browse":'."\n");
        fwrite($this->_FileHandle, '        echo '."'".'<div class="dot-border"></div><hgroup><h1>'.ucwords(_ToSpace($this->_currentTableName)).'</h1><h3></h3></hgroup><div class="dot-border"></div>'."'".';'."\n");
        fwrite($this->_FileHandle, '        include_once VIEWS_GENERATED_BROWSE."'.$this->_lowerCurrentTableName.'.html";'."\n");
        fwrite($this->_FileHandle, '        echo '."'".'<div class="dot-border"></div>'."'".';'."\n");;
        fwrite($this->_FileHandle, '        break;'."\n");
        fwrite($this->_FileHandle, '    case "search":'."\n");
        fwrite($this->_FileHandle, '        echo '."'".'<div class="dot-border"></div><hgroup><h1>'.ucwords(_ToSpace($this->_currentTableName)).'</h1><h3></h3></hgroup><div class="dot-border"></div>'."'".';'."\n");
        fwrite($this->_FileHandle, '        include_once VIEWS_GENERATED_BROWSE."'.$this->_lowerCurrentTableName.'.html";'."\n");
        fwrite($this->_FileHandle, '        echo '."'".'<div class="dot-border"></div>'."'".';'."\n");
        fwrite($this->_FileHandle, '        break;'."\n");
        fwrite($this->_FileHandle, '    case "insert": include_once VIEWS_GENERATED_FORMS."'.$this->_lowerCurrentTableName.'.desktop.html";break;'."\n");
        fwrite($this->_FileHandle, '    case "get": include_once VIEWS_GENERATED_FORMS."'.$this->_lowerCurrentTableName.'.desktop.html";break;'."\n");
        fwrite($this->_FileHandle, '    case "update": include_once VIEWS_GENERATED_FORMS."'.$this->_lowerCurrentTableName.'.desktop.html";break;'."\n");
        fwrite($this->_FileHandle, '    case "index": include_once VIEWS_GENERATED_FORMS."'.$this->_lowerCurrentTableName.'.desktop.html";break;'."\n");
        fwrite($this->_FileHandle, '}'."\n");
        //fwrite($this->_FileHandle, 'include BROWSE_ELEMENTS."' . $this->_lowerCurrentTableName . '.html";' . "\n");
        //fwrite($this->_FileHandle, '//Check for edit mode and the id being set' . "\n");
        //fwrite($this->_FileHandle, 'if($edit_mode && $the_id){' . "\n\t" . '$' . $this->_lowerCurrentTableName . '->get($databaseConnection,$the_id);' . "\n" . '}' . "\n");
        //fwrite($this->_FileHandle, '//Build the ' . $this->_lowerCurrentTableName . ' form' . "\n");
        //fwrite($this->_FileHandle, '$' . $this->_lowerCurrentTableName . '->makeForm();' . "\n");
        fwrite($this->_FileHandle, '// Include the HTML footer:' . "\n" . 'include BOOKENDS."footer.html";' . "\n");
        fwrite($this->_FileHandle, '?>' . "\n");
    }

    /**
     * @internal param $this ->_currentTableName
     * @return resource
     */
    private function closeFilePointer()
    {
        try {
            fclose($this->_FileHandle);
        } catch ( Exception $e ) {
            echo utf8_encode(date('Y-m-d H:i:s') . " " . __CLASS__ . "::" . __FUNCTION__ . ": " . $e);
            return false;
        }
        return true;
    }
}

/*
 * Test for single table
$ui = new UserInteractionGenerator($databaseConnection);
$ui->setTableName("Net_Promoter_Score");
$ui->execute();
*/
/*
 * Test for all tables
 $ui = new UserInteractionGenerator($databaseConnection);
 $ui->execute();
*/