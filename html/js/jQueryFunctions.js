/**
 * Created by PhpStorm.
 * User: Carl "Tex" Morgan
 * Date: 1/24/14
 * Time: 3:45 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
$(document).ready(function () {
    $(".menu").menu(
        {position: {my: "right bottom", at: "right top"}}
    );

    $(".dangerous").on("click", function () {
        "use strict";
        var answer = confirm("You have selected one or more dangerous functions to run. Are you sure, you want to continue?");
        if (answer) {
            $(".form").submit();
        }
    });
});