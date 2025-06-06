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
* Text Domain: shstotop
*/



// Including css
function shstotop_enqueue_styles() {
    wp_enqueue_style( 'shstotop-style', plugins_url( 'css/shstotop-style.css', __FILE__ ) );
}
add_action('wp_enqueue_scripts', 'shstotop_enqueue_styles');

// Including js
function shstotop_enqueue_scripts(){
    wp_enqueue_script('jquery');
    wp_enqueue_script('shstotop-plugin-script', plugins_url( 'js/shstotop-plugin.js', __FILE__ ), array(), '1.0.0', 'true');
}
add_action('wp_enqueue_scripts', 'shstotop_enqueue_scripts');


// jQuery plugin activition 
function shstotop_scroll_scripts(){
    ?>

     <script>
            jQuery(document).ready(function(){
                jQuery.scrollUp();
            });
         </script> 

    <?php

}
add_action('wp_footer', 'shstotop_scroll_scripts');







// Main menu 
function my_custom_admin_menu() {
    // Main Menu
    add_menu_page(
        'Scroll To Top',              // Page title
        'Scroll To Top',              // Menu title (sidebar e dekha jabe)
        'manage_options',              // Capability
        'my-custom-page-slug',         // Menu slug
        'my_custom_menu_page_callback',// Function to show content
        'dashicons-admin-generic',       // Icon (WordPress default icon)
        30                              // Position
    );
}
add_action('admin_menu', 'my_custom_admin_menu');

// Callback for main menu
function my_custom_menu_page_callback() {
    echo '<div class="wrap"><h1>Scroll To Top </h1><p>Welcome to our Scroll To Top</p></div>';
}


// Customize 
function shstotop_scroll_customize($wp_customize){
    $wp_customize-> add_section('shstotop_scroll_section', array(
        'title' => __('Scroll To Top', 'shstotop'),
        'priority' => 10,
    ));
    $wp_customize-> add_setting('shstotop_scroll_bg_color', array(
        'default' => '#000',
        'transport' => 'refresh',
    ));
    $wp_customize-> add_control(new WP_Customize_Color_Control($wp_customize, 'shstotop_scroll_bg_color', array(
        'label' => __('Background Color', 'shstotop'),
        'setting' => 'shstotop_scroll_bg_color',
        'section' => 'shstotop_scroll_section',
    )));
     $wp_customize-> add_setting('shstotop_scroll_bghover_color', array(
        'default' => '#262626',
        'transport' => 'refresh',
    ));
    $wp_customize-> add_control(new WP_Customize_Color_Control($wp_customize, 'shstotop_scroll_bghover_color', array(
        'label' => __('Hover', 'shstotop'),
        'setting' => 'shstotop_scroll_bghover_color',
        'section' => 'shstotop_scroll_section',
    )));
     $wp_customize-> add_setting('shstotop_scroll_bd_redius', array(
        'default' => '5px',
        'transport' => 'refresh',
    ));
    $wp_customize-> add_control('shstotop_scroll_bd_redius', array(
        'label' => __('Border Redius', 'shstotop'),
        'setting' => 'shstotop_scroll_bghover_color',
        'section' => 'shstotop_scroll_section',
        'type' => 'text',
    ));
    

}
add_action('customize_register', 'shstotop_scroll_customize');


function shstotop_customize_css() {
    ?>
    <style type="text/css">
        .scrollup {
            background-color: <?php echo get_theme_mod('shstotop_scroll_bg_color', '#000'); ?>;
            border-radius: <?php echo get_theme_mod('shstotop_scroll_bd_redius', '5px'); ?>;
        }
        .scrollup:hover {
            background-color: <?php echo get_theme_mod('shstotop_scroll_bghover_color', '#262626'); ?>;
        }
    </style>
    <?php
}
add_action('wp_head', 'shstotop_customize_css');



?>