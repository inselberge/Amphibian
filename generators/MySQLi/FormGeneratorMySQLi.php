<?php
/**
 * PHP Version: ${PHP_VERSION}
 * Created by PhpStorm.
 * User: carl
 * Date: 1/19/14
 * Time: 11:59 PM
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php";
require_once "interfaces".DIRECTORY_SEPARATOR."FormGeneratorMySQLiInterface.php";
require_once AMPHIBIAN_GENERATORS_ABSTRACT."FormGenerator.php";
/**
 * Class FormGeneratorMySQLi
 *
 * @category 
 * @package  FormGeneratorMySQLi
 * @author   Carl 'Tex' Morgan <texmorgan@inselberge.com>
* @license  All rights reserved by Inselberge Inc. unless otherwise stated.
 * @link     http://amphibian.co/documentation/
 */
class FormGeneratorMySQLi
    extends FormGenerator
    implements FormGeneratorMySQLiInterface
{
    /**
     * @var object FormGeneratorMySQLi a singleton instance of this class
     */
    static public $FormGeneratorMySQLi;
    
    /** __construct
     *
     * @param object $databaseConnection a valid database connection
    */
    protected function __construct($databaseConnection)
    {
        $this->setFileExtension(".html");
        $this->setFileDestination(VIEWS_GENERATED_FORMS);
        return parent::__construct($databaseConnection);
    }
    
    /** instance
     *
     * @param object $databaseConnection a valid database connection
     *
     * @return FormGeneratorMySQLi
     */
    static public function instance($databaseConnection)
    {
        if ( !isset(self::$FormGeneratorMySQLi) ) {
            self::$FormGeneratorMySQLi = new FormGeneratorMySQLi($databaseConnection);
        }
        return self::$FormGeneratorMySQLi;
    }
     
    /** factory
     *
     * @param object $databaseConnection a valid database connection
     *
     * @return FormGeneratorMySQLi
     */
    static public function factory($databaseConnection)
    {
        return new FormGeneratorMySQLi($databaseConnection);
    }

    /** fetchAll
     *
     * @return bool
     */
    protected function fetchAll()
    {

    }

    /** translateType
     *
     * @param      $name
     * @param      $type
     * @param null $key
     * @param null $isNULL
     *
     * @return bool|string
     */
    protected function translateType($name, $type, $key = null, $isNULL = null)
    {
        if (isset($type) AND !is_null($type)) {
            $currentType = explodeType($type);
            $required = null;
            if ($isNULL == 'NO') {
                $required = 'required';
            } else {
                $required = null;
            }
            if ($key == 'PRI' /*|| $key == 'MUL'*/) {
                return '<input type="hidden" class="hide" id="' . $name . '" name="' . $name . '" value="' . "<?php reqpostcheck('" . $name . "'" . '); ?>" ' . $required . '/>';
            }
            if ($currentType['type'] == 'date') {
                if ($name == 'start_date') {
                    return '<input type="date" data-input-type="date" class="date ajax col-lg-4" id="' . $name . '" name="' . $name . '" value="' . "<?php reqpostcheck('" . $name . "'); ?>" . '" step="1" min="' . "<?php date('Y-m-d');?>" . '" ' . $required . ' title="Please enter a valid start date"/><div id="live_' . $name . '"></div>';
                } elseif ($name == 'end_date') {
                    return '<input type="date" data-input-type="date" class="date ajax col-lg-4" id="' . $name . '" name="' . $name . '" value="' . "<?php reqpostcheck('" . $name . "'" . '); ?>' . '" step="1" min="' . "<?php date('Y-m-d');?>" . '" ' . $required . ' title="Please enter a valid end date" /><div id="live_' . $name . '"></div>' . '
              <meta charset="utf-8">
                  <script>
                $(function() {
                  var dates = $( "#start_date, #end_date" ).datepicker({
                    defaultDate: "+1w",
                    changeMonth: true,
                    numberOfMonths: 3,
                    onSelect: function( selectedDate ) {
                      var option = this.id == "start_date" ? "minDate" : "maxDate",
                        instance = $( this ).data( "datepicker" ),
                        date = $.datepicker.parseDate(
                          instance.settings.dateFormat ||
                          $.datepicker._defaults.dateFormat,
                          selectedDate, instance.settings );
                      dates.not( this ).datepicker( "option", option, date );
                    }
                  });
                });
                </script>';
                } else {
                    return '<input type="date" data-input-type="date" id="' . $name . '" placeholder="Please enter a valid date in MM/DD/YYYY form" class="date ajax col-lg-4" name="' . $name . '" value="' . "<?php reqpostcheck('" . $name . "'); ?>" . '" step="1" min="' . "<?php date('Y-m-d');?>" . '" ' . $required . ' readonly="true" title="Please enter a valid date"/><div id="live_' . $name . '"></div>';
                }
            }
            if ($name == 'email') {
                return '<input type="email" class="email ajax col-lg-4" data-input-type="email" id="' . $name . '" placeholder="Please enter a valid email address" name="' . $name . '" value="' . "<?php reqpostcheck('" . $name . "'); ?>" . '" ' . $required . ' title="Please enter a valid email address"/><div id="live_' . $name . '"></div>';
            }
            if ($name == 'url') {
                return '<input type="url" class="url ajax col-lg-4" data-input-type="web" id="' . $name . '" name="' . $name . '" placeholder="' . APP_WEBSITE . '" value="' . "<?php reqpostcheck('" . $name . "'); ?>" . '" ' . $required . 'title="Please enter a valid URL"/><div id="live_' . $name . '"></div>';
            }
            if ($name == 'password') {
                return '<input type="password" class="password ajax col-lg-4" data-input-type="password" id="' . $name . '" placeholder="Passwords are 6-20 and contain: capital letter, number, special character" name="' . $name . '" value="' . "<?php reqpostcheck('" . $name . "'); ?>" . '"  data-regexp="^(\w*(?=\w*[0-9])(?=\w*[a-z])(?=\w*[A-Z])\w*){6,20}$" ' . $required . ' title="Please enter a 6-20 character password containing 1 uppercase letter, 1 number"/><div id="live_' . $name . '"></div>';
            }
            if ($name == 'phone') {
                return '<input type="tel" class="phone ajax col-lg-4" data-input-type="phone" id="' . $name . '" name="' . $name . '" placeholder="Please enter a valid telephone number" value="' . "<?php reqpostcheck('" . $name . "'); ?>" . '" ' . $required . ' title="Please enter a valid telephone number"/><div id="live_' . $name . '"></div>';
            }
            if ($name == 'zip') {
                return '<input type="text" class="zip ajax col-lg-4" data-input-type="zip" id="' . $name . '" name="' . $name . '" placeholder="Please enter a valid zip code" value="' . "<?php reqpostcheck('" . $name . "'); ?>" . '" pattern="([0-9]{5}([\-][0-9]{4})?)" ' . $required . ' title="Please enter a valid zip code"/><div id="live_' . $name . '"></div>';
            }
            if (strstr($currentType['type'], "int") != false) {
                if ($currentType['unsigned'] == "unsigned") {
                    return '<input type="number" class="number ajax col-lg-4" data-input-type="positive-integer" placeholder="Please enter a valid positive integer" pattern="[0-9]{1,' . $currentType['size'] . '}" name="' . $name . '" id="' . $name . '"  value="' . "<?php reqpostcheck('" . $name . "'); ?>" . '" ' . $required . ' title="Please enter a valid integer"/><div id="live_' . $name . '"></div>';
                } else {
                    return '<input type="number" class="number ajax col-lg-4" data-input-type="integer" placeholder="Please enter a valid integer" pattern="[0-9]{1,' . $currentType['size'] . '}" name="' . $name . '" id="' . $name . '"  value="' . "<?php reqpostcheck('" . $name . "'); ?>" . '" ' . $required . ' title="Please enter a valid integer"/><div id="live_' . $name . '"></div>';
                }
            }
            if ($currentType['type'] == 'time') {
                return '<input type="time" data-input-type="time" class="time ajax col-lg-4" placeholder="Please enter a valid time" name="' . $name . '" id="' . $name . '"  value="' . "<?php reqpostcheck('" . $name . "'); ?>" . '" ' . $required . ' title="Please enter a valid time"/><div id="live_' . $name . '"></div>';
            }
            if ($currentType['type'] == 'datetime') {
                return '<input type="datetime" data-input-type="datetime" class="datetime ajax col-lg-4" placeholder="Please enter a datetime in the form 2013-10-20 01:20:34" name="' . $name . '" id="' . $name . '"  value="' . "<?php reqpostcheck('" . $name . "'); ?>" . '" ' . $required . ' title="Please enter a valid date time"/><div id="live_' . $name . '"></div>';
            }
            if ($currentType['type'] == 'timestamp') {
                return '<input type="datetime" data-input-type="timestamp" class="timestamp ajax col-lg-4" placeholder="Please enter a valid timestamp in the form 2013-10-20 01:20:34" name="' . $name . '" id="' . $name . '"  value="' . "<?php reqpostcheck('" . $name . "'); ?>" . '" ' . $required . ' readonly="true" />';
            }
            if ($currentType['type'] == 'decimal') {
                if ($currentType['unsigned'] == "unsigned") {
                    return '<input type="number" data-input-type="positive-decimal" class="decimal ajax col-lg-4" placeholder="Please enter a valid positive decimal number" name="' . $name . '" id="' . $name . '" pattern="[0-9]+(\.[0-9]{2,})?" value="' . "<?php reqpostcheck('" . $name . "'); ?>" . '" ' . $required . ' title="Please enter a valid decimal number" />';
                } else {
                    return '<input type="number" data-input-type="decimal" class="decimal ajax col-lg-4" placeholder="Please enter a valid decimal number" name="' . $name . '" id="' . $name . '" pattern="[0-9]+(\.[0-9]{2,})?" value="' . "<?php reqpostcheck('" . $name . "'); ?>" . '" ' . $required . ' title="Please enter a valid decimal number" />';
                }
            }
            if ($currentType['type'] == 'float') {
                if ($currentType['unsigned'] == "unsigned") {
                    return '<input type="number" data-input-type="positive-float" placeholder="Please enter a valid positive float" class="float ajax col-lg-4" name="' . $name . '" id="' . $name . '"  pattern="[0-9]+(\.[0-9]{2,})?" value="' . "<?php reqpostcheck('" . $name . "'); ?>" . '" ' . $required . ' title="Please enter a valid floating point number" />';
                } else {
                    return '<input type="number" data-input-type="float" placeholder="Please enter a valid float" class="float ajax col-lg-4" name="' . $name . '" id="' . $name . '"  pattern="[0-9]+(\.[0-9]{2,})?" value="' . "<?php reqpostcheck('" . $name . "'); ?>" . '" ' . $required . ' title="Please enter a valid floating point number" />';
                }
            }
            if ($currentType['type'] == 'double') {
                if ($currentType['unsigned'] == "unsigned") {
                    return '<input type="number" data-input-type="positive-double" placeholder="Please enter a valid positive double" class="double ajax col-lg-4" name="' . $name . '" id="' . $name . '"  pattern="[0-9]+(\.[0-9]{2,})?" value="' . "<?php reqpostcheck('" . $name . "'); ?>" . '" ' . $required . ' title="Please enter a valid double" />';
                } else {
                    return '<input type="number" data-input-type="double" placeholder="Please enter a valid double" class="double ajax col-lg-4" name="' . $name . '" id="' . $name . '"  pattern="[0-9]+(\.[0-9]{2,})?" value="' . "<?php reqpostcheck('" . $name . "'); ?>" . '" ' . $required . ' title="Please enter a valid double" />';
                }
            }
            if ($currentType['type'] == 'enum') {
                $str = '<select name="' . $name . '" id="' . $name . '" ' . $required . ' title="Please select a valid option"><option value="0" disabled selected>Pick a value</option>';
                foreach ($currentType['options'] as $key => $value) {
                    $str .= '<option value="' . $value . '"' . ' <?php if(reqpostcheck(' . "'" . $name . "'" . ') === "' . $value . '"){echo "selected";} ?>' . '>' . ucwords(
                            _ToSpace(stripQuote($value))
                        ) . '</option>';
                }
                $str .= '</select>';
                return $str;
            }
            if ($currentType['type'] == 'varchar') {
                return '<input type="text" class="text varchar ajax col-lg-4" data-input-type="name" spellcheck="true" name="' . $name . '"  pattern="[a-zA-Z0-9]+{0,' . $currentType['size'] . '}" maxlength="' . $currentType['size'] . '" id="' . $name . '"  value="' . "<?php reqpostcheck('" . $name . "'); ?>" . '" ' . $required . ' title="Please enter a valid string of letters and numbers" placeholder="Please type the ' . $name . ' here"/>';
            }
            if ($currentType['type'] == 'char') {
                return '<input type="text" class="text char ajax col-lg-4" name="' . $name . '"  pattern="[a-zA-Z]+{0,' . $currentType['size'] . '}" maxlength="' . $currentType['size'] . '" id="' . $name . '"  value="' . "<?php reqpostcheck('" . $name . "'); ?>" . '" ' . $required . ' title="Please enter a valid string of characters" placeholder="Please type the ' . $name . ' here"/>';
            }
            if ($currentType['type'] == 'text') {
                return '<input type="textbox" class="textbox text ajax col-lg-4" data-input-type="comment" spellcheck="true" name="' . $name . '" id="' . $name . '"   value="' . "<?php reqpostcheck('" . $name . "'); ?>" . '" ' . $required . ' title="Please enter only valid text" placeholder="Please type the ' . $name . ' here"/>';
            }
        } else {
            return false;
        }
        return true;
    }

    /** explodeType
     *
     * @param string $type a database type
     *
     * @return array
     */
    protected function explodeType($type)
    {
        if (substr_count($type, "unsigned")) {
            $unsigned = "unsigned";
        } else {
            $unsigned = null;
        }
        if (substr_count($type, "zerofill")) {
            $zerofill = "zerofill";
        } else {
            $zerofill = null;
        }
        if (substr_count($type, '(')) {
            $newType = explode('(', $type);
            $countUnsigned = explode(')', $newType['1']);
            if (sizeof($countUnsigned) > 1) {
                if (substr_count($countUnsigned['0'], ',') > 0) {
                    $options = explode(',', $countUnsigned['0']);
                    $array = array(
                        "type" => $newType['0'],
                        "size" => sizeof($options),
                        "options" => $options,
                        "unsigned" => $unsigned,
                        "zerofill" => $zerofill
                    );
                } else {
                    $array = array(
                        "type" => $newType['0'],
                        "size" => $countUnsigned['0'],
                        "options" => null,
                        "unsigned" => $unsigned,
                        "zerofill" => $zerofill
                    );
                }
            } else {
                $array = array(
                    "type" => $newType['0'],
                    "size" => $countUnsigned['0'],
                    "options" => null,
                    "unsigned" => $unsigned,
                    "zerofill" => $zerofill
                );
            }
            return $array;
        } else {
            $array = array(
                "type" => $type,
                "size" => null,
                "options" => null,
                "unsigned" => $unsigned,
                "zerofill" => $zerofill
            );
            return $array;
        }
    }

} 