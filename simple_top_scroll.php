<?php
/* Plugin Name: Simple Top Scroll by Encode Web Projects
Plugin URI: https://github.com/PlatinumJay/simple_top_scroll/
Description: To Top Scroller. Can customize the shape and color. Fades in and out and scrolls smoothly to top when clicked.
Version: 1.0.1
Author: Jayson Exel
Author URI: https://github.com/PlatinumJay/simple_top_scroll/
License: GPLv2 or later
*/

add_action('admin_enqueue_scripts', 'encode_topScroll_files');

function encode_topScroll_files(){
	
    wp_register_script( 'jquery-x', plugins_url('simple_top_scroll/js/jquery-2-1-3.min.js'), array(), null, false);
    wp_enqueue_script( 'jquery-x' );
	
	wp_enqueue_media();
	
	wp_enqueue_script('thickbox');
    
    wp_enqueue_style('thickbox');
 
    wp_enqueue_script('media-upload');

	wp_enqueue_style( 'wp-color-picker' );

	wp_enqueue_script('wp-color-picker', admin_url( 'js/color-picker.min.js' ), array( 'iris' ), false, 1);

	wp_enqueue_script('iris', admin_url( 'js/iris.min.js' ), array( 'jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch' ), false, 1);
	
	wp_register_script( 'jquery-admin', plugins_url('simple_top_scroll/js/admin-effects.js'), array(), null, false);
    wp_enqueue_script( 'jquery-admin' );
}

add_action('wp_head', 'encode_topScroll_anchor');

function encode_topScroll_anchor(){ ?>
    
    <a href="#" id="scrolltoTop"></a>
    
    <?php    
}

add_action('admin_menu', 'encode_topScroll_menu');

function encode_topScroll_menu() {
    $encode_web_icon = 'http://encodetheweb.com/wordpress-theme-img/projects.png';

	add_menu_page('Encode Web Projects - Top Scroll Settings', 'Simple Top Scroll Settings', 'administrator', 'encode-top-scroll-settings', 'encode_top_scroll_settings_page', $encode_web_icon);
}

function encode_top_scroll_settings_page() { ?>

    <div class="wrap">

    <div style="width:50%;">
        <h2>Simple Top Scroll Settings</h2>

        <form method="post" action="options.php">

        <?php
		settings_fields("encode-top-scroll-settings-group"); 
        do_settings_sections("encode-top-scroll-settings-group");
		?>
	
        <table class="form-table">
            <tr valign="top">
            <th scope="row">Scroll Button Colour: </th>
            <td>
			<?php $default_hcolor = '#ffffff'; 	?>
			<div class="top_scroll_color_bg" style="width:100px; height:50px; display:inline-block; background-color: <?php echo get_option('top_scroll_color', $default_hcolor ); ?>"> 
				<input type="text" data-default-color="#effeff" name="top_scroll_color" id="top_scroll_color" class="top_scroll_color button" value="<?php echo get_option('top_scroll_color'); ?>" style="margin-left:30px; width: 100px; height:50px;"/>
			</div>
			<a href="#" class="select_toggle2 button" style="display:none; width:100px; height:50px; margin-left:50px; line-height: 48px!important;">Pick Color</a>
			</td>
			<tr>
			<th>Scroll Button Shape: </th>
			<td>
		<?php $scroll_shape = get_option('scroll_shape'); ?>
		
			<input type="radio" id="scroll_shape" name="scroll_shape" <?php if($scroll_shape == '200px') echo 'checked="checked"'; ?> value="200px" />
			<img src="<?php echo plugins_url('simple_top_scroll/img/round.png') ?>" style="width: 100px;" /><br>
			<input type="radio" id="scroll_shape" name="scroll_shape" <?php if($scroll_shape == '0px') echo 'checked="checked"'; ?> value="0px" />
			<img src="<?php echo plugins_url('simple_top_scroll/img/square.png') ?>" style="width: 100px;" /><br>
			</tr>
			</td>
		</table>
    
        <?php submit_button(); ?>

        </form>
    </div>
    <div style="width:50%; position:fixed; left:55%;top: 100px;">

        <div style="width:350px;margin: 0 auto;">
            <img src="http://encodetheweb.com/img/Encode-WebProjects.png" width="350" />
        </div>
    <div style="width:350px; margin:0 auto;">

    <h1> Simple Top Scroll by Encode Web Solutions:</h1>

    <h2>Version: 1.0.1</h2>


    <h2>Check out our other open source Projects</h2>
    <a class="button button-primary" href="https://github.com/PlatinumJay/" target="_blank"> See More </a>

    </div>
</div>
<?php }

add_action( 'admin_init', 'encode_top_scroll_settings' );

function encode_top_scroll_settings() {
	register_setting( 'encode-top-scroll-settings-group', 'scroll_shape' );
    register_setting("encode-top-scroll-settings-group", "top_scroll_color");
}

add_action('wp_enqueue_scripts', 'encode_scripts');

function encode_scripts() {

    wp_enqueue_script('jquery');

    wp_register_script( 'scrollTop_init_core', plugins_url('simple_top_scroll/js/scrollTop.js'), array('jquery'), '', true);
    wp_enqueue_script( 'scrollTop_init_core' );

    wp_register_script('scrollTop_init', plugins_url('simple_top_scroll/js/scrollTop.initialize.js'), array('jquery'), '', true);
    wp_enqueue_script('scrollTop_init'); 
	
	wp_register_style( 'scroll-top-css', plugins_url('simple_top_scroll/css/scrollTop.css'), array(), null, false);
    wp_enqueue_style( 'scroll-top-css' );

    $scroll_color = (get_option('top_scroll_color') == '') ? "rgba(0, 0, 0, 0.5)" : get_option('top_scroll_color');

    $scroll_shape = (get_option('scroll_shape') == '') ? "0px" : get_option('scroll_shape');

    $config_array = array(
            'backgroundColor' => $scroll_color,
	    'borderRadius' => $scroll_shape
        );

    wp_localize_script('scrollTop_init', 'scroll_settings', $config_array);
}
?>
