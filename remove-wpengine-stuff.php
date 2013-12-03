<?php
/*
 * Plugin Name: Dashboard Cleanup by The Mighty Mo! Design Co.
 * Plugin URI: https://github.com/themightymo/
 * Description: Removes WPEngine stuff from the dashboard for non-tobys
 * Author: The Mighty Mo! Design Co. LLC
 * Author URI: http://www.themightymo.com/
 * License: GPLv2 (or later)
 * Version: 1.1
 */
 
// Remove all evidence of WP Engine from the Dashboard, unless the logged in user is "wpengine" 
// via http://jeremypry.com/hide-wp-engine-dashboard-extras/

require_once(ABSPATH . '/wp-includes/pluggable.php');
global $current_user;
get_currentuserinfo();

if ( $current_user->user_login != 'wpengine' && $current_user->user_login != 'toby' ) {
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
