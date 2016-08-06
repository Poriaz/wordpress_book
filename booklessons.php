<?php
/*
Plugin Name: Book Your Lessons
Plugin URI: http://zulutime.com
Description: Book Your Lessons
Author: Unknown
Author URI: http://zulutime.com
*/

ob_start();

//define all the constants
define( 'PLUGIN_SLUG', 'book-your-lessons' );
define( 'bookings_URL', plugin_dir_url(__FILE__) );
define( 'bookings_PATH', plugin_dir_path(__FILE__) );
define( 'bookings_BASENAME', plugin_basename( __FILE__ ) );
define('pluginFilePath',dirname(__FILE__) . DIRECTORY_SEPARATOR);
define( 'bookings_VERSION', '1' );
define( 'bookings_DB_VERSION', '1' );


function bookings_callback($buffer) {
	return $buffer;
}


function bookings_buffer_start() { ob_start("callback"); }
function bookings_buffer_end() { ob_end_flush(); }
add_action('wp_head', 'bookings_buffer_start');
add_action('wp_footer', 'bookings_buffer_end');
 


add_action( 'admin_init', 'bookings_activation');
add_action('admin_head', 'bookings_jquery_ui_css');
function bookings_jquery_ui_css() {
   //load js and css files here	
}

add_action('admin_footer', 'bookings_admin_init_admin_head');
function bookings_admin_init_admin_head(){

}
	/* call a function on activation of plugin */
register_activation_hook( __FILE__, 'bookings_activation');
	/* call a function on deactivation of plugin */
register_deactivation_hook(__FILE__, 'bookings_deactivation');
function bookings_activation() {
	//initialize database querys ,create tables etc.
}
function bookings_deactivation() {
	//remove plugin options from admin panel
}


function bookings_admin_menu(){
	/*main menu on the dashboard*/
	add_menu_page("Bookings", "Bookings", 1, "book-your-lessons", "bookings_main",plugin_dir_url( __FILE__ ) . 'assets/images/flightbooking.png');  
	/*Manage flight experience submenu for the main menu*/
	add_submenu_page("book-your-lessons", "Manage Flights", "Manage Flights", 1, "booking-manage-flights", "booking_manage_flights");
	add_submenu_page("book-your-lessons", "Manage Instructors", "Manage Instructors", 1, "booking-manage-instructors", "booking_manage_instructors");
	add_submenu_page("book-your-lessons", "Manage Schedules", "Manage Schedules", 1, "booking-schedules", "booking_schedules");
	
	/*Manage second option submenu for the main menu*/
	
    add_submenu_page("book-your-lessons", "Manage Live Session Bookings", "Manage Live Session Bookings", 1, "bookings-live-session", "bookings_live_session");
     add_submenu_page("book-your-lessons", "Manage Live Session Flights", "Manage Live Session Flights", 1, "booking-manage-live-session-flights", "booking_manage_live_session_flights");
	add_submenu_page("book-your-lessons", "Manage Live Session Instructors", "Manage Live Session Instructors", 1, "booking-manage-live-session-instructors", "booking_manage_live_session_instructors");
	add_submenu_page("book-your-lessons", "Manage Live Session Schedules", "Manage Live Session Schedules", 1, "booking-live-session-schedules", "booking_live_session_schedules");
	add_submenu_page("book-your-lessons", "Manage Live Session Jeppesen Lessons", "Manage Live Session Jeppesen Lessons", 1, "bookings-jeppeson", "bookings_jeppeson");
	add_submenu_page("book-your-lessons", "Manage Live Session Sujects", "Manage Live Session Sujects", 1, "bookings-subjects", "bookings_subjects"); 
     add_submenu_page("book-your-lessons", "Settings", "Settings", 1, "bookings-settings", "booking_settings");
}
//add a menu on the dashboard
add_action('admin_menu', 'bookings_admin_menu');
/* this action handles the dashboard data */
function bookings_main() {
	global $wpdb;
	require_once dirname( __FILE__ ) . '/booklessons-home.php';
}
/* this action handles flight booking experience data */

/* this action handles B data */
function bookings_live_session() {
	global $wpdb;
	require_once dirname( __FILE__ ) . '/booklessons_live_session.php';
}
function booking_settings(){
	global $wpdb;
	require_once dirname( __FILE__ ) . '/booklesson_settings.php';
}
function booking_schedules(){
	global $wpdb;
	require_once dirname( __FILE__ ) . '/booklesson_schedules.php';
}
function booking_manage_flights(){
	global $wpdb;
	require_once dirname( __FILE__ ) . '/booking_manage_flights.php';
}
function booking_manage_instructors(){
	global $wpdb;
	require_once dirname( __FILE__ ) . '/booking_manage_instructors.php';
}
function booking_manage_live_session_flights(){
	global $wpdb;
	require_once dirname( __FILE__ ) . '/booking_manage_live_session_flights.php';
}
function booking_manage_live_session_instructors(){
	global $wpdb;
	require_once dirname( __FILE__ ) . '/booking_manage_live_session_instructors.php';
}
function booking_live_session_schedules(){
	global $wpdb;
	require_once dirname( __FILE__ ) . '/booking_manage_live_session_schedules.php';
}
function bookings_jeppeson(){
	global $wpdb;
	require_once dirname( __FILE__ ) . '/booking_manage_live_session_jeppeson.php';
}
function bookings_subjects(){
	global $wpdb;
	require_once dirname( __FILE__ ) . '/booking_manage_live_session_subjects.php';
}
