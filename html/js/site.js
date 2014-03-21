/**
 * Created by PhpStorm.
 * User: Carl "Tex" Morgan
 * Date: 11/11/13
 * Time: 5:38 PM
 * All rights reserved by Inselberge Inc. unless otherwise stated.
 */
var Utils = {
    classToggle: function (element, tclass) {
        "use strict";

    },
    q : function (query) {
        "use strict";
        if (document.querySelectorAll) {
            var res = document.querySelectorAll(query);
        } else {
            var d = document,
                a = d.styleSheets[0] || d.createStyleSheet();
            a.addRule(query,’f:b’);
            for(var l=d.all,b=0,c=[],f=l.length;b<f;b++) {
                l[b].currentStyle.f && c.push(l[b]);
                a.removeRule(0);
                var res = c;
            }
            return res;
        }
    }
};
window.onload = function() {
    "use strict";
    var lazy = Utils.q(‘[data-src]’);
    var collapse = document.getElementById(‘nav-collapse’);
    var nav = document.getElementById(‘nav’);
    var navItem = nav.getElementsByTagName(‘li’);

    //is it floated?
    var floated = navItem[0].currentStyle ? el.currentStyle[‘float’] :
    document.defaultView.getComputedStyle(navItem[0],null).
        getPropertyValue(‘float’);

    for (var i = 0; i < lazy.length; i++) {
        var source = lazy[i].getAttribute(‘data-src’);
        //create the image
        var img = new Image();
        img.src = source;
        //insert it inside of the link
        lazy[i].insertBefore(img, lazy[i].firstChild);
    };

    if (floated != ‘left’) {
        var collapse = document.getElementById(‘nav-collapse’);
        Utils.classToggle(nav, ‘hide’);
        Utils.classToggle(collapse, ‘active’);
        collapse.onclick = function() {
            Utils.classToggle(nav, ‘hide’);

            return false;
        }
    }
    //toggle class utility function
    function classToggle( element, tclass ) {
        var classes = element.className,
            pattern = new RegExp( tclass );
        var hasClass = pattern.test( classes );
        //toggle the class
        classes = hasClass ? classes.replace( pattern, ‘’ ) :
        classes + ‘ ‘ + tclass;
        element.className = classes.trim();

    };

    classToggle(nav, ‘hide’);
    classToggle(collapse, ‘active’);
    collapse.onclick = function() {
        classToggle(nav, ‘hide’);
        return false;
    }
}