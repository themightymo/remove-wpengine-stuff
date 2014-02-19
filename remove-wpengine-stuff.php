<?php
/*
 * Plugin Name: Dashboard Cleanup by The Mighty Mo! Design Co.
 * Plugin URI: https://github.com/themightymo/
 * Description: Removes WPEngine stuff from the dashboard for non-tobys
 * Author: The Mighty Mo! Design Co. LLC
 * Author URI: http://www.themightymo.com/
 * License: GPLv2 (or later)
 * Version: 1.4
 */
 
// Remove all evidence of WP Engine from the Dashboard, unless the logged in user is "wpengine" 
// via http://jeremypry.com/hide-wp-engine-dashboard-extras/

require_once(ABSPATH . '/wp-includes/pluggable.php');
global $current_user;
get_currentuserinfo();

if ( $current_user->user_login != 'wpengine' && $current_user->user_login != 'toby' && $current_user->user_login != 'MightyMo' && $current_user->user_login != 'themightymo') {
	add_action( 'admin_init', 'jpry_remove_menu_pages' );
	add_action( 'admin_bar_menu', 'jpry_remove_admin_bar_links', 999 );
}

/**
 * Remove the WP Engine menu page
 */
function jpry_remove_menu_pages() {
	remove_menu_page( 'wpengine-common' );
}
 
/**
 * Remove the "WP Engine Quick Links" from the menu bar
 */
function jpry_remove_admin_bar_links( $wp_admin_bar ) {
	$wp_admin_bar->remove_node( 'wpengine_adminbar' );
}

// Hide this plugin from the plugins list in the dashboard - via http://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
function tmm_remove_wpengine_stuff_enqueue_admin_styles($hook) {
    if( 'plugins.php' != $hook )
        return;
    wp_register_style('tmm-remove-wpengine-stuff-enqueue-admin-styles', plugins_url('/admin-style.css', __FILE__));
    wp_enqueue_style( 'tmm-remove-wpengine-stuff-enqueue-admin-styles' );
}
add_action( 'admin_enqueue_scripts', 'tmm_remove_wpengine_stuff_enqueue_admin_styles' );
