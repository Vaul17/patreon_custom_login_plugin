<?php
/**
 * Plugin Name: Patreon Custom Login Plugin
 * Description: Makes the "Login with Patreon" button the only login option for non-admins on wp-login.php, replaces the WordPress logo, and hides the "Lost your password?" link.
 * Version: 1.0.5
 * Author: Vau17
 */

if (!defined('ABSPATH')) {
    die;
}

// Enqueue custom CSS to hide default login form elements and customize logo
add_action('login_enqueue_scripts', 'patreon_only_login_styles');
function patreon_only_login_styles() {
    $custom_logo_url = 'https://your-site-url/your_image.jpeg';
    echo '<style type="text/css">
        /* Hide default login form elements for non-admins */
        #loginform p:not([class*="patreon"]):not([id*="patreon"]),
        #loginform label,
        #loginform .wp-pwd,
        #loginform .wp-pwd-toggle,
        #loginform .toggle-password,
        #loginform .forgetmenot,
        #loginform .submit,
        #nav,
        #loginform ~ p.nav {
            display: none !important;
        }

        /* Replace WordPress logo with custom image */
        .login h1 a {
            background-image: url(' . esc_url($custom_logo_url) . ') !important;
            background-size: contain !important;
            background-repeat: no-repeat !important;
            background-position: center !important;
            width: 100% !important;
            height: 100px !important; /* Adjust height based on your image */
            display: block !important;
            text-indent: -9999px !important;
        }
    </style>';
}

// Remove link to WordPress.org from logo
add_filter('login_headerurl', 'patreon_custom_login_headerurl');
function patreon_custom_login_headerurl($url) {
    return home_url();
}

?>