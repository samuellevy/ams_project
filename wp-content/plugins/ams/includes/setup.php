<?php
// run the install scripts upon plugin activation
register_activation_hook(__FILE__, 'install');

//menu items
add_action('admin_menu','ams_menu');

function install() {
    global $wpdb;

    $table_name = $wpdb->prefix . "ams_blogs";
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name (
            `id` varchar(11) CHARACTER SET utf8 NULL,
            `name` varchar(255) CHARACTER SET utf8 NULL,
			`url` varchar(255) CHARACTER SET utf8 NULL,
			`owner` varchar(255) CHARACTER SET utf8 NULL,
			`document` varchar(255) CHARACTER SET utf8 NULL,
			`email` varchar(255) CHARACTER SET utf8 NULL,
			`whatsapp` varchar(255) CHARACTER SET utf8 NULL,
			`bank` TEXT CHARACTER SET utf8 NULL,
			`token` varchar(255) CHARACTER SET utf8 NULL,
            PRIMARY KEY (`id`)
          ) $charset_collate; ";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);

    $table_name = $wpdb->prefix . "ams_anuncios";
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name (
            `id` varchar(11) CHARACTER SET utf8 NULL,
            `file` varchar(255) CHARACTER SET utf8 NULL,
			`text` TEXT CHARACTER SET utf8 NULL,
			`url` varchar(255) CHARACTER SET utf8 NULL,
			`value` varchar(255) CHARACTER SET utf8 NULL,
			`category` varchar(255) CHARACTER SET utf8 NULL,
            PRIMARY KEY (`id`)
          ) $charset_collate; ";
    dbDelta($sql);
}

function ams_menu() {
	//this is the main item for the menu
	add_menu_page('AMS', //page title
	'AMS', //menu title
	'manage_options', //capabilities
	'ams_main', //menu slug
	'' //function
    );
}