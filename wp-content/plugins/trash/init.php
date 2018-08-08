<?php
/*
Plugin Name: TRASH
Plugin URI: http://nokengo.com/
Description: An advertising management system for WordPress.
Version: 0.0.1
Author: Samuel Levy
Author http://nokengo.com/
License: Education
Text Domain: ams
*/

// function to create the DB / Options / Defaults					
function install() {

    global $wpdb;

    $table_name = $wpdb->prefix . "ams_blogs";
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name (
            `id` varchar(11) CHARACTER SET utf8 NOT NULL,
            `name` varchar(255) CHARACTER SET utf8 NOT NULL,
			`url` varchar(255) CHARACTER SET utf8 NOT NULL,
			`owner` varchar(255) CHARACTER SET utf8 NOT NULL,
			`document` varchar(255) CHARACTER SET utf8 NOT NULL,
			`email` varchar(255) CHARACTER SET utf8 NOT NULL,
			`whatsapp` varchar(255) CHARACTER SET utf8 NOT NULL,
			`bank` TEXT CHARACTER SET utf8 NOT NULL,
			`token` varchar(255) CHARACTER SET utf8 NOT NULL,
            PRIMARY KEY (`id`)
          ) $charset_collate; ";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
}

// run the install scripts upon plugin activation
register_activation_hook(__FILE__, 'install');

//menu items
add_action('admin_menu','ams_menu');

function ams_menu() {
	
	//this is the main item for the menu
	add_menu_page('AMS', //page title
	'AMS', //menu title
	'manage_options', //capabilities
	'ams_main', //menu slug
	'' //function
	);
	
	// //this is a submenu
	// add_submenu_page('sinetiks_schools_list', //parent slug
	// 'Adicionar blog', //page title
	// 'Novo blog', //menu title
	// 'manage_options', //capability
	// 'ams_blog_create', //menu slug
	// 'ams_blog_create'); //function

	// //this is a submenu
	// add_submenu_page('sinetiks_schools_list', //parent slug
	// 'Adicionar pagamento', //page title
	// 'Novo pagamento', //menu title
	// 'manage_options', //capability
	// 'ams_payment_create', //menu slug
	// 'ams_payment_create'); //function

	// //this is a submenu
	// add_submenu_page('sinetiks_schools_list', //parent slug
	// 'Adicionar anúncio', //page title
	// 'Novo anúncio', //menu title
	// 'manage_options', //capability
	// 'ams_ad_create', //menu slug
	// 'ams_ad_create'); //function
	
	// //this submenu is HIDDEN, however, we need to add it anyways
	// add_submenu_page(null, //parent slug
	// 'Update Blog', //page title
	// 'Update', //menu title
	// 'manage_options', //capability
	// 'ams_blog_update', //menu slug
	// 'ams_blog_update'); //function

	// //this submenu is HIDDEN, however, we need to add it anyways
	// add_submenu_page(null, //parent slug
	// 'Update Payment', //page title
	// 'Update', //menu title
	// 'manage_options', //capability
	// 'ams_payment_update', //menu slug
	// 'ams_payment_update'); //function

	// //this submenu is HIDDEN, however, we need to add it anyways
	// add_submenu_page(null, //parent slug
	// 'Update Ad', //page title
	// 'Update', //menu title
	// 'manage_options', //capability
	// 'ams_ad_update', //menu slug
	// 'ams_ad_update'); //function
}
define('ROOTDIR', plugin_dir_path(__FILE__));
require_once(ROOTDIR . 'ams_blog_create.php');
// require_once(ROOTDIR . 'schools-create.php');
// require_once(ROOTDIR . 'schools-update.php');
