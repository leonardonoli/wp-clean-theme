/* Parse the query string, put it in a JSON object, and assign it to the varaible qs */
var qs = (function(a) {
    if (a == "") return {};
    var b = {};
    for (var i = 0; i < a.length; ++i)
    {
        var p=a[i].split('=', 2);
        if (p.length == 1)
            b[p[0]] = "";
        else
            b[p[0]] = decodeURIComponent(p[1].replace(/\+/g, " "));
    }
    return b;
})(window.location.search.substr(1).split('&'));


/* Set the showWidget cookie if utm_source is present */
if(typeof qs['utm_source'] != "undefined"){
	cookie.set('showWidget', 'regular', {path: "/"});
}

/* Set the totalPageViews cookie */
var totalPageViews = cookie.get('totalPageViews',0);
totalPageViews = parseInt(totalPageViews);
if(isNaN(totalPageViews)){
    totalPageViews = 0;
}
totalPageViews++;
cookie.set('totalPageViews', totalPageViews, {path: "/"});