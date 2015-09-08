(function ( $ ) {

$.fn.topScroll = function(options) {

j$ = jQuery.noConflict();

    var e = j$.extend({
        // These are the defaults.
        backgroundColor: "rgba(0, 0, 0, 0.5)",
        borderRadius: "0px"
    }, options );
 
    j$(window).scroll(function () {
        if (j$(this).scrollTop() > 100) {
            j$('#scrolltoTop').fadeIn();
        } else {
            j$('#scrolltoTop').fadeOut();
        }
    });

    j$('#scrolltoTop').click(function () {
        j$("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });
    
    return this.css({
            backgroundColor: e.backgroundColor,
            borderRadius: e.borderRadius
    });
};

}( jQuery ));
