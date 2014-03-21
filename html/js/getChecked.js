/**
 * Created by JetBrains PhpStorm.
 * User: Carl "Tex" Morgan
 * Date: 2/19/13
 * Time: 1:22 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
function getChecked ( checkList ) {
  var idList = new Array();
  var loopCounter = 0;
  //find all the checked checkboxes
  jQuery( "input[name=" + checkList + "]:checked" ).each
      (
          function () {
            //fill the array with the values
            idList[loopCounter] = jQuery( this ).val();
            loopCounter += 1;
          }
      );
  //do more stuff with the checked items
}