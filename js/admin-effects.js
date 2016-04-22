var $c = jQuery.noConflict();

$c(function(){

	$c('.top_scroll_color').iris();

	$c('.select_toggle2').hide();

	$c('.top_scroll_color').click(function() { 
		$c('.select_toggle2').toggle();
	});

	$c('.top_scroll_color').bind("keyup input paste change", function() {
        var scolor = $c(this).val();
        $c('.top_scroll_color_bg').css({'background-color': scolor});
	});

    $c('.select_toggle2').click(function (e) {
	$c('.select_toggle2').toggle();
	
	var scolor2 = $c('.top_scroll_color').val();
          $c('.top_scroll_color_bg').css({'background-color': scolor2}); 
        if (!$c(e.target).is(".top_scroll_color, .iris-picker, .iris-picker-inner")) {
            $c('.top_scroll_color').iris('hide');
            return false;
        }
    });
    
	$c('.top_scroll_color').click(function (event) {
        $c('.top_scroll_color').iris('hide');
        $c(this).iris('show');
        return false;
    });
	
});