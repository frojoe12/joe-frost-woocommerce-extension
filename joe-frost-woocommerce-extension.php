<?php

/*
* Plugin Name:          Joe Frost Woocommerce Extension
* Plugin URL:           https://github.com/frojoe12/joe_frost_woocommerce_extension
* Description:          Adds extended functionality to woocommerce
* Version:              0.1
* Author:               Joe Frost
* Author URI:           https://www.joefrost.co.uk
* License:              GPL v2+
* License URI:          https://www.gnu.org.licensed/gpl-2.0.html
* Text Domain:          jfwe
*/

// abort if file called directly
if (!defined('ABSPATH')) {
    die;
}

/*
* load stylesheet
*/

function pre($input) {
   echo "<pre>".var_dump($input)."</pre>";
}

function jfwe_load_stylesheet() {
    if (apply_filters( 'jfwe_load_styles', true)) {
        if (is_single()) { // only load if single post
                wp_enqueue_style('jfwe_stylesheet', plugin_dir_url(__FILE__) . 'css/jfwe-styles.css');
            }    
        }
        wp_enqueue_style('jfwe_stylesheet', plugin_dir_url(__FILE__) . 'css/jfwe-styles-admin.css');
    }

function jfwe_load_stylesheet_admin() {
        wp_enqueue_style('jfwe_stylesheet', plugin_dir_url(__FILE__) . 'css/jfwe-styles-admin.css');
    }   
// add_filter('jfwe_load_styles','__return_false');    

add_action('wp_enqueue_scripts','jfwe_load_stylesheet');
add_action('admin_enqueue_scripts','jfwe_load_stylesheet_admin');
// register a custom sidebar
function jfwe_register_sidebar() {
    register_sidebar(array(
        'name'  =>  __('Single Post CTA','jfwe'),
        'id'    =>  'jfwe-sidebar',
        'description'   =>  __( 'Displays widget area on single posts.', 'jfwe' ),
        'before_widget' => '<div class="widget jfwe">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle jfwe-title">',
        'after_title' => '</h2>',
    ));
}
add_action('widgets_init','jfwe_register_sidebar');

// display side bar on single posts
function jfwe_display_sidebar($content) {
    if (get_post_type() === "post" && is_single()) {
        dynamic_sidebar( 'jfwe-sidebar' );
    }
    return $content;
}

function woocommerce_notice() {
    ?>
    <div id='jfwe-admin-warning' class='jfwe-warning-admin'>
        ! <strong>WooCommerce plugin</strong> needs to be installed to use the <strong>Joe Frost WooCommerce Extension</strong> plugin
        <?php
            if (strtok($_SERVER["REQUEST_URI"], '?') !== "/wp-admin/plugins.php") {
        ?>
        <a href='/wp-admin/plugins.php' class='jfwe-warning-link-button'>Go to plugins page</a>
        <?php
            }
        ?>
        <button id='dismiss-jfwe-admin-warning' class='jfwe-warning-admin-button'>Close</button>
        <script>
            document.getElementById("dismiss-jfwe-admin-warning").addEventListener('click',function() {
                document.getElementById("jfwe-admin-warning").style="display:none;"
            })
        </script>
    <?php
    echo "</div>";
}


add_filter( 'the_content','jfwe_display_sidebar', 10 );
if (!function_exists('is_plugin_active')) {
    require_once ABSPATH . '/wp-admin/includes/plugin.php';
}
if (!is_plugin_active('woocommerce/woocommerce.php')) {
    add_action('admin_notices','woocommerce_notice');
}


