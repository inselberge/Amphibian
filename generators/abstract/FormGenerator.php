<?php

require_once __DIR__ . DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."config.inc.php";
require_once AMPHIBIAN_GENERATORS_ABSTRACT. "BasicGenerator.php";
require_once "interfaces".DIRECTORY_SEPARATOR."FormGeneratorInterface.php";
/**
 * Class FormGenerator
 *
 * @category Generator
 * @package  FormGenerator
 * @author   Carl 'Tex' Morgan <texmorgan@amphibian.co>
 * @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/formGenerator
 */
abstract class FormGenerator
    extends BasicGenerator
    implements FormGeneratorInterface
{
    /**
     * @var string bufferMobile
     */
    protected $bufferMobile = "";
    /**
     * @var string formType the form type, either "flat" or "modal"
     */
    protected $formType = "flat";
    /**
     * @var object FileHandleMobile
     */
    protected $FileHandleMobile;
    /**
     * @var string spacedTableName
     */
    protected $spacedTableName = "";
    /**
     * @var string lowerTableName
     */
    protected $lowerTableName = "";

    /** execute
     *
     * @return bool
     */
    public function execute()
    {
        try {
            checkDirectory(VIEWS_GENERATED_FORMS);
            parent::execute();
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /**  setFormType
     *
     * @param string $formType the type of form we are producing
     *
     * @return boolean
     */
    public function setFormType($formType)
    {
        try {
            if ( CheckInput::checkNewInput($formType) ) {
                $this->formType = $formType;
            } else {
                throw new ExceptionHandler(__METHOD__ . ": formType is not valid");
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
        $this->spacedTableName = ucwords(_ToSpace($this->tableName));
        $this->lowerTableName = strtolower($this->tableName);
        //todo: double check this is the correct way to get the tableDescription now.
        $this->tableDescription = $this->connection->describeTable($this->tableName);
        $this->writeFile();
    }

    /** writeFromBuffer
     *
     * @return bool
     */
    protected function writeFromBuffer()
    {
        try {
            if (CheckInput::checkNewInput($this->bufferMobile)) {
                $this->FileHandleMobile
                    = new FileHandle(
                        $this->fileDestination . strtolower(
                            $this->tableName . ".mobile"
                        ) . $this->fileExtension
                    );
                $this->FileHandleMobile->writeFull($this->bufferMobile);
                $this->bufferMobile = "";
            } else {
                throw new ExceptionHandler(__METHOD__ . ":The buffer is empty.");
            }
            parent::writeFromBuffer();
        } catch (ExceptionHandler $e) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** writeFile
     *
     * @return bool
     */
    protected function writeFile()
    {
        try {
            if ( CheckInput::checkSet($this->tableDescription) ) {
                $this->writeFormHeading();
                $this->writeFormStart();
                $this->iterateTableDescription();
                $this->writeFormEnd();
            } else {
                throw new ExceptionHandler(__METHOD__ . ": there was a problem getting the table description for $this->tableName.");
            }
        } catch ( ExceptionHandler $e ) {
            $e->execute();
            return false;
        }
        return true;
    }

    /** writeFormHeading
     *
     * @return void
     */
    protected function writeFormHeading()
    {
        $this->buffer = '<div class="dot-border"></div>' . "\n";
        $this->buffer .= '<div class="dot-border"></div>'."\n";
        $this->buffer .= '<hgroup>'."\n";
        $this->buffer .= '    <h1>'.$this->spacedTableName.'</h1>'."\n";
        $this->buffer .= '    <h3></h3>'."\n";
        $this->buffer .= '    <h5><span class="red">*</span> indicates a required field</h5>'."\n";
        $this->buffer .= '</hgroup>'."\n";
        $this->buffer .= '<div class="dot-border"></div>'."\n";
    }

    /** writeFormStart
     *
     * @return bool
     */
    protected function writeFormStart()
    {
        if ( $this->formType == "modal" ) {
            $this->writeModalButton();
            $this->buffer .= '<div id="' . $this->lowerTableName . '-dialog" class="modal hide pop" title="' . $this->spacedTableName . '">' . "\n";
            $this->buffer .= "\t" . '<form enctype="multipart/form-data" accept-charset="utf-8" method="post" action="' . $this->lowerTableName . '.php">' . "\n";
            $this->buffer .= "\t\t" . '<div class="modal-header">' . "\n";
            $this->buffer .= "\t\t\t" . '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>' . "\n";
            $this->buffer .= "\t\t\t" . '<h3>' . $this->spacedTableName . '</h3>' . "\n";
            $this->buffer .= "\t\t" . '</div>' . "\n";
            $this->buffer .= "\t\t" . '<div class="modal-body">' . "\n";
        } else {
            $this->buffer .= '<div id="' . $this->lowerTableName ;
            $this->buffer .= '-dialog" class="container">' . "\n";
            $this->buffer .= "\t" . '<form enctype="multipart/form-data" accept-charset="utf-8" method="post" class="form-horizontal" role="form" action="' . $this->lowerTableName . '.php">' . "\n";
        }
        //mobile and desktop views should be the same at this point
        $this->bufferMobile = $this->buffer;
    }

    /** writeModalButton
     *
     * @return void
     */
    protected function writeModalButton()
    {
        $this->buffer .= '<div class="col-md-3">' . "\n";
        $this->buffer .= "\t" . '<a href="#';
        $this->buffer .= $this->lowerTableName;
        $this->buffer .= '-dialog" role="button" class="btn modal-toggle" data-toggle="modal">Add new ';
        $this->buffer .= $this->lowerTableName . '</a>' . "\n";
        $this->buffer .= '</div>' . "\n";
    }

    /** iterateTableDescription
     *
     * @return void
     */
    protected function iterateTableDescription()
    {
        foreach ( $this->tableDescription->tableArray as $index => $row ) {
            if ( CheckInput::checkNewInputArray($row) ) {
                $this->addToForm($index, 'mobile', $row);
                $this->addToForm($index, 'desktop', $row);
            }
        }
    }

    /** addToForm
     *
     * @param string $index    the name of the column
     * @param string $platform either "mobile" or "desktop"
     * @param array  $row      an array containing information about the column
     *
     * @return void
     */
    protected function addToForm($index, $platform, $row)
    {
        if ( $platform == 'mobile' ) {
            if ( !$row['key'] ) {
                $this->bufferMobile .= "\t\t\t" . '<p><label for="' ;
                $this->bufferMobile .= $index ;
                $this->bufferMobile .= '" class="ui-input-text"><strong>' ;
                $this->bufferMobile .= ucwords(_ToSpace($row['Field']));
                $this->bufferMobile .= '</strong></label><br/>' . "\n";
                $this->bufferMobile .= "\t\t\t";
                $this->bufferMobile .= $this->translateType($index, $row['type'], $row['key'], $row['nullAllowed']);
                $this->bufferMobile .= "</p>\n";
            } else {
                $this->bufferMobile .= "\t\t\t";
                $this->bufferMobile .= $this->translateType($index, $row['type'], $row['key'], $row['nullAllowed']);
                $this->bufferMobile .= "\n";
            }
        } else {
            if ( $row['Key'] != 'PRI' /*AND $row['Key']!='MUL'*/ ) {
                $this->buffer .= "\t\t\t" . '<article class="form-group">' . "\n";
                $this->buffer .= "\t\t\t\t" . '<label class="col-lg-2 control-label" for="' . $index . '"><strong>' . ucwords(_ToSpace($index)) . '</strong>';
                if ( $row['nullAllowed'] == 'NO' ) {
                    $this->buffer .= ' <span class="red">*</span>';
                }
                $this->buffer .= '</strong></label>' . "\n";
                $this->buffer .= "\t\t\t\t" . '' . $this->translateType($index, $row['type'], $row['key'], $row['nullAllowed']) . "\n";
                $this->buffer .= "\t\t\t" . '</article>' . "\n";
            } else {
                $this->buffer .= "\t\t\t" . $this->translateType($index, $row['type'], $row['key'], $row['nullAllowed']) . "\n";
            }
        }
    }

    /** translateType
     *
     * @param string $name   the name of the column
     * @param string $type   the database type of the column
     * @param string $key    denotes if the variable is a primary or foreign key
     * @param bool   $isNULL denotes if the variable can be null or not
     *
     * @return bool|string
     */
    abstract protected function translateType($name, $type, $key = null, $isNULL = null);


    /** explodeType
     *
     * @param string $type the database type of the column
     *
     * @return mixed
     */
    abstract protected function explodeType($type);

    /** writeFormEnd
     *
     * @return void
     */
    protected function writeFormEnd()
    {
        if ( $this->formType == "modal" ) {
            $this->buffer .= "\t\t" . '</div>' . "\n";
            $this->buffer .= "\t\t" . '<div class="modal-footer">' . "\n";
            $this->buffer .= "\t\t\t" . '<input type="submit" name="submit_button" value="Submit" id="submit_button" class="formbutton btn btn-primary" />' . "\n";
            $this->buffer .= "\t\t" . '</div>' . "\n";
            $this->buffer .= "\t" . '</form>' . "\n" . '</div>' . "\n";

            $this->bufferMobile .= "\t\t" . '</div>' . "\n";
            $this->bufferMobile .= "\t\t" . '<div class="modal-footer">' . "\n";
            $this->bufferMobile .= "\t\t\t" . '<input type="submit" name="submit_button" value="Submit" id="submit_button" class="formbutton btn btn-primary" />' . "\n";
            $this->bufferMobile .= "\t\t" . '</div>' . "\n";
            $this->bufferMobile .= "\t" . '</form>' . "\n" . '</div>' . "\n";
        } else {
            $this->buffer .= "\t\t" . '</div>' . "\n";
            $this->buffer .= "\t\t" . '<article class="form-group">' . "\n";
            $this->buffer .= "\t\t\t" . '<input type="submit" name="submit_button" value="Submit" id="submit_button" class="formbutton btn btn-primary red-btn col-lg-offset-2 col-lg-4" />' . "\n";
            $this->buffer .= "\t\t" . '</article>' . "\n";
            $this->buffer .= "\t" . '</form>' . "\n";
            $this->buffer .= '<div class="dot-border"></div>'."\n";
            $this->buffer .= '</div>' . "\n";

            $this->bufferMobile .= "\t\t" . '</div>' . "\n";
            $this->bufferMobile .= "\t\t" . '<article class="form-group">' . "\n";
            $this->bufferMobile .= "\t\t\t" . '<input type="submit" name="submit_button" value="Submit" id="submit_button" class="formbutton btn btn-primary red-btn col-lg-offset-2 col-lg-4" />' . "\n";
            $this->bufferMobile .= "\t\t" . '</article>' . "\n";
            $this->bufferMobile .= "\t" . '</form>' . "\n";
            $this->bufferMobile .= '<div class="dot-border"></div>' . "\n";
            $this->bufferMobile .= '</div>' . "\n";
        }
    }
}