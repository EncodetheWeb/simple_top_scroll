<?php
/* Plugin Name: Simple Top Scroll by Encode Web Projects
Plugin URI: http://encodetheweb.com/en/encode-projects/
Description: To Top Scroller. Can customize the shape and color. Fades in and out and scrolls smoothly to top when clicked.
Version: 1.0.1
Author: Encode Web Projects
Author URI: http://encodetheweb.com/en/encode-projects
License: GPLv2 or later
*/

add_action('wp_enqueue_scripts', 'encode_topScroll_files');

function encode_topScroll_files(){
    
    wp_register_style( 'scroll-top-css', plugins_url('simple_top_scroll/css/scrollTop.css'), array(), null, false);
    wp_enqueue_style( 'scroll-top-css' );
	
    wp_register_script( 'jquery-css', plugins_url('simple_top_scroll/js/jquery-2-1-3.min.js'), array(), null, false);
    wp_enqueue_script( 'jquery-css' );
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

        <?php settings_fields( 'encode-top-scroll-settings-group' ); ?>
        <?php do_settings_sections( 'encode-top-scroll-settings-group' ); ?>
	
        <table class="form-table">
            <tr valign="top">
            <th scope="row">Scroll Button Color: </th>
             <td>
	   <?php $scroll_color = get_option('scroll_color'); ?>
            <select name="scroll_color" id="scroll_color">
            <option value="rgba(0, 0, 0, 0.5)" <?php if ( $scroll_color == 'rgba(0, 0, 0, 0.5)' ) echo 'selected="selected"'; ?>>Grey (default)</option>
            <option value="rgba(0, 0, 0, 1)" <?php if ( $scroll_color == 'rgba(0, 0, 0, 1)' ) echo 'selected="selected"'; ?>>Black</option>
            <option value="rgba(0, 105, 255, 0.5)" <?php if ( $scroll_color == 'rgba(0, 105, 255, 0.5)' ) echo 'selected="selected"'; ?>>Blue</option>
            <option value="rgba(255, 0, 0, 0.5)" <?php if ( $scroll_color == 'rgba(255, 0, 0, 0.5)' ) echo 'selected="selected"'; ?>>Red</option>
	</select>
            </td>
            </tr><tr>
            <th scope="row">Scroll Button Shape: </th>
            <td>
	    <?php $scroll_shape = get_option('scroll_shape'); ?>
	    <select name="scroll_shape" id="scroll_shape">
            <option value="0px" <?php if ( $scroll_shape == '0px' ) echo 'selected="selected"'; ?>>Square (default) </option>
            <option value="200px" <?php if ( $scroll_shape == '200px' ) echo 'selected="selected"'; ?>>Round</option></select></td> </tr>
        </table>
    
        <?php submit_button(); ?>

        </form>
    </div>
    <div style="width:50%; position:fixed; left:55%;">

        <div style="width:350px;margin: 0 auto;">
            <img src="http://encodetheweb.com/img/Encode-WebProjects.png" width="350" />
        </div>
    <div style="width:350px; margin:0 auto;">

    <h1> Simple Top Scroll by Encode Web Solutions:</h1>

    <h2>Version: 1.0.1</h2>


    <h2>Check out our other open soruce Projects</h2>
    <a class="button button-primary" href="http://encodetheweb.com/en/encode-projects" target="_blank"> See More </a>

    </div>
</div>
<?php }

add_action( 'admin_init', 'encode_top_scroll_settings' );

function encode_top_scroll_settings() {
	register_setting( 'encode-top-scroll-settings-group', 'scroll_color' );
	register_setting( 'encode-top-scroll-settings-group', 'scroll_shape' );
}


add_action('wp_enqueue_scripts', 'encode_scripts');

function encode_scripts() {

    wp_enqueue_script('jquery');

    wp_register_script( 'scrollTop_init_core', plugins_url('simple_top_scroll/js/scrollTop.js'), array('jquery'), '', true);
    wp_enqueue_script( 'scrollTop_init_core' );

    wp_register_script('scrollTop_init', plugins_url('simple_top_scroll/js/scrollTop.initialize.js'), array('jquery'), '', true);
    wp_enqueue_script('scrollTop_init');

    $scroll_color = (get_option('scroll_color') == '') ? "rgba(0, 0, 0, 0.5)" : get_option('scroll_color');

    $scroll_shape = (get_option('scroll_shape') == '') ? "0px" : get_option('scroll_shape');

    $config_array = array(
            'backgroundColor' => $scroll_color,
	    'borderRadius' => $scroll_shape
        );

    wp_localize_script('scrollTop_init', 'scroll_settings', $config_array);
}
?>
