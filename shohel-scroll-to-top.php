<?php 

/*
* Plugin Name: Shohel Scroll To Top
* Plugin URI: https://wordpress.org/plugins/shohel-scroll-to-top
* Description: A simple plugin to add a scroll to top button on your WordPress site.
* Version: 1.0.0
* Requires at least: 5.8
* Requires PHP: 7.0
* Author: Shohel Rana
* Author URI: https://shohelrana.top
* License: GPLv2 or later 
* License URI: https://www.gnu.org/licenses/gpl-2.0.html
* Text Domain: shohel-scroll-to-top
*/



// Including css
function shohel_scroll_to_top_enqueue_styles() {
    wp_enqueue_style( 'shohel-scroll-to-top-style', plugins_url( 'css/shohel-scroll-to-top-style.css', __FILE__ ) );
}
add_action('wp_enqueue_scripts', 'shohel_scroll_to_top_enqueue_styles');

// Including js
function shohel_scroll_to_top_enqueue_scripts(){
    wp_enqueue_script('jquery');
    wp_enqueue_script('shohel-scroll-to-top-plugin-script', plugins_url( 'js/shohel-scroll-to-top-plugin.js', __FILE__ ), array(), '1.0.0', 'true');
}
add_action('wp_enqueue_scripts', 'shohel_scroll_to_top_enqueue_scripts');


// Including css
function shohel_scroll_to_top_enqueue_admin_styles() {
    wp_enqueue_style( 'shohel-scroll-to-top-admin-style', plugins_url( 'css/shohel-scroll-to-top-admin-style.css', __FILE__ ) );
}
add_action('admin_enqueue_scripts', 'shohel_scroll_to_top_enqueue_admin_styles');


// jQuery plugin activition 
function shohel_scroll_to_top_scroll_scripts(){
    ?>

     <script>
            jQuery(document).ready(function(){
                jQuery.scrollUp();
            });
         </script> 

    <?php

}
add_action('wp_footer', 'shohel_scroll_to_top_scroll_scripts');



// Option Page
function shohel_scroll_to_top_add_admin_menu() {
    add_menu_page(
        'Shohel Scroll To Top',
        'Scroll To Top',
        'manage_options',
        'shohel_scroll_to_top',
        'shohel_scroll_to_top_options_page',
        'dashicons-arrow-up-alt2',
        101
    );
}
add_action('admin_menu', 'shohel_scroll_to_top_add_admin_menu');


// Callback function for the options page
function shohel_scroll_to_top_options_page() {
    ?>

      <div class="shohel_scroll_to_top_main">
        <div class="shohel_scroll_to_top_body_area  sohel_scroll">
           <h2 id="title_area"><?php print esc_attr('Scroll To Top Customizer') ?></h2>
              <p><?php print esc_attr('This plugin adds a scroll to top button on your WordPress site. You can customize the background color, hover color, and border radius of the button.') ?></p>
              <form action="options.php" method="post">
                <?php wp_nonce_field('update-options');?>

                <!-- Primary Color  -->
                 <label for="shohel-scroll-to-top-color" name="shohel-scroll-to-top-color"><?php print esc_attr('Primary Color'); ?></label>
                 <input type="color" name="shohel-scroll-to-top-color" value="<?php print get_option('shohel-scroll-to-top-color'); ?>">


                <!-- Hover Color  -->
                 <label for="shohel-scroll-to-top-hover-color" name="shohel-scroll-to-top-hover-color"><?php print esc_attr('Hover Color'); ?></label>
                 <input type="color" name="shohel-scroll-to-top-hover-color" value="<?php print get_option('shohel-scroll-to-top-hover-color'); ?>">

                 <!-- Button Position  -->
                  <label for="shohel-scroll-to-top-button-position"><?php print esc_attr(__('Button Position')); ?></label>
                  <select name="shohel-scroll-to-top-button-position" id="shohel-scroll-to-top-button-position">
                    <option value="true" <?php if(get_option('shohel-scroll-to-top-button-position')== 'true'){echo 'selected="selected"';} ?>>Left</option>
                    <option value="false" <?php if(get_option('shohel-scroll-to-top-button-position')== 'false'){echo 'selected="selected"';} ?>>Right</option>
                  </select>

                  <!-- Round Corner   -->
                 <label for="shohel-scroll-to-top-round-corner"><?php echo esc_attr(__('Round Corner')); ?></label>
                 <label class="radios">
                    <input type="radio" name="shohel-scroll-to-top-round-corner" id="shohel-scroll-to-top-round-corner-yes" value="true" <?php if(get_option('shohel-scroll-to-top-round-corner')== 'true'){echo 'checked="checked"';} ?>><span>No</span>
                 </label>
                 <label class="radios">
                    <input type="radio" name="shohel-scroll-to-top-round-corner" id="shohel-scroll-to-top-round-corner-no" value="true" <?php if(get_option('shohel-scroll-to-top-round-corner')== 'false') {echo 'checked="checked"';} ?>><span>Yes</span>
                 </label>



                 <input type="hidden" name="action" value="update">
                 <input type="hidden" name="page_options" value="shohel-scroll-to-top-color, shohel-scroll-to-top-hover-color, shohel-scroll-to-top-button-position">
                 <input type="button" value="<?php _e('Save Changes', 'shohel-scroll-to-top'); ?>" class="button button-primary" id="shohel_scroll_to_top_save_button">
              </form>
        </div>
        <div class="shohel_scroll_to_top_sidebar sohel_scroll">
            <div class="shohel_scroll_to_top_sidebar_area">
                <h2><?php print esc_attr('Plugin Information') ?></h2>
                <p><?php print esc_attr('This plugin is developed by Shohel Rana. You can find more plugins on the WordPress Plugin Directory.') ?></p>
                <p><?php print esc_attr('If you have any questions or suggestions, please contact me at:') ?></p>
                <a href="https://shohelrana.top" target="_blank">shohelrana.top</a>
            </div>
        </div>
      </div>



   <?php
}














// Customize 
function shohel_scroll_to_top_scroll_customize($wp_customize){
    $wp_customize-> add_section('shohel_scroll_to_top_scroll_section', array(
        'title' => __('Scroll To Top', 'shohel-scroll-to-top'),
        'priority' => 10,
    ));
    $wp_customize-> add_setting('shohel_scroll_to_top_scroll_bg_color', array(
        'default' => '#000',
        'transport' => 'refresh',
    ));
    $wp_customize-> add_control(new WP_Customize_Color_Control($wp_customize, 'shohel_scroll_to_top_scroll_bg_color', array(
        'label' => __('Background Color', 'shohel-scroll-to-top'),
        'setting' => 'shohel_scroll_to_top_scroll_bg_color',
        'section' => 'shohel_scroll_to_top_scroll_section',
    )));
     $wp_customize-> add_setting('shohel_scroll_to_top_scroll_bghover_color', array(
        'default' => '#262626',
        'transport' => 'refresh',
    ));
    $wp_customize-> add_control(new WP_Customize_Color_Control($wp_customize, 'shohel_scroll_to_top_scroll_bghover_color', array(
        'label' => __('Hover', 'shohel-scroll-to-top'),
        'setting' => 'shohel_scroll_to_top_scroll_bghover_color',
        'section' => 'shohel_scroll_to_top_scroll_section',
    )));
     $wp_customize-> add_setting('shohel_scroll_to_top_scroll_bd_redius', array(
        'default' => '25px',
        'transport' => 'refresh',
    ));
    $wp_customize-> add_control('shohel_scroll_to_top_scroll_bd_redius', array(
        'label' => __('Border Redius', 'shohel-scroll-to-top'),
        'setting' => 'shohel_scroll_to_top_scroll_bd_redius',
        'section' => 'shohel_scroll_to_top_scroll_section',
        'type' => 'text',
    ));
    

}
add_action('customize_register', 'shohel_scroll_to_top_scroll_customize');


function shohel_scroll_to_top_customize_css() {
    ?>
    <style type="text/css">
        #scrollUp {
            background-color: <?php echo get_theme_mod('shohel_scroll_to_top_scroll_bg_color', '#000'); ?>;
            border-radius: <?php echo get_theme_mod('shohel_scroll_to_top_scroll_bd_redius', '25px'); ?>;
        }
        #scrollUp:hover {
            background-color: <?php echo get_theme_mod('shohel_scroll_to_top_scroll_bghover_color', '#262626'); ?>;
        }
    </style>
    <?php
}
add_action('wp_head', 'shohel_scroll_to_top_customize_css');


?>