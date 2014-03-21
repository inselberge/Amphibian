/**
 * Created by JetBrains PhpStorm.
 * User: Carl "Tex" Morgan
 * Date: 2/19/13
 * Time: 1:10 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
//from:
function isValidDate ( controlName, format ) {
  var isValid = true;

  try {
    jQuery.datepicker.parseDate( format, jQuery( '#' + controlName ).val(), null );
  }
  catch ( error ) {
    isValid = false;
  }

  return isValid;
}