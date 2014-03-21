/**
 * Created by JetBrains PhpStorm.
 * User: Carl "Tex" Morgan
 * Date: 2/19/13
 * Time: 1:12 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
//from: http://byatool.com/ui/jquery-check-all-checkboxes-toggle-method-thingy/
function toggleCheckboxes ( buttonId, checkBoxNamePrefix, checked ) {
  //Get all checkboxes with the prefix name and check/uncheck
  jQuery( '[id*=' + checkBoxNamePrefix + ']' ).attr( 'checked', checked );

  //remove any click handlers from the button
  //  Why?  Because jQuery(buttonId).click() will just add another handler
  jQuery( buttonId ).unbind( 'click' );

  //Add the new click handler
  jQuery( buttonId ).click(
      function () {
        toggleCheckboxes( buttonId, checkBoxNamePrefix, !checked );
      }
  );
}

//example
jQuery( '#buttonName' ).click(
    function () {
      toggleCheckboxes( '#buttonName', 'someCheckBoxName', true );
    }
);