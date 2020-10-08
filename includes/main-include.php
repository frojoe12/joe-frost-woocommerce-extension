<?php

// abort if file called directly
if (!defined('ABSPATH')) {
    die;
}

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
