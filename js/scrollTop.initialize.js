$(function () {
	j$ = jQuery.noConflict();
    j$('#scrolltoTop').topScroll({
		backgroundColor : scroll_settings.backgroundColor,
		borderRadius : scroll_settings.borderRadius
    });
});
