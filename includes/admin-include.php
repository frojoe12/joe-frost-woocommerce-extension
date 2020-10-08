<?php

// abort if file called directly
if (!defined('ABSPATH')) {
    die;
}

// wp-admin notices and warnings
function woocommerce_needs_to_be_installed_admin_notice() {
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
    add_action('admin_notices','woocommerce_needs_to_be_installed_admin_notice');
}