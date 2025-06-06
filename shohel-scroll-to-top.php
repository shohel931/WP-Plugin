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




?>