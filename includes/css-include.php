<?php

// abort if file called directly
if (!defined('ABSPATH')) {
    die;
}

// load stylesheet
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