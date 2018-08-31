<?php
/*
Plugin Name: AMS - Ads Management System by Nokengo
Plugin URI: http://nokengo.com/
Description: An advertising management system for WordPress.
Version: 0.0.1
Author: Samuel Levy
Author http://nokengo.com/
License: Education
Text Domain: ams
*/
define('ROOTDIR', plugin_dir_path(__FILE__));
require_once(ROOTDIR . 'includes/setup.php');
require_once(ROOTDIR . 'includes/blogs_create.php');
require_once(ROOTDIR . 'includes/blogs_list.php');
require_once(ROOTDIR . 'includes/blogs_update.php');

require_once(ROOTDIR . 'includes/ads_create.php');
require_once(ROOTDIR . 'includes/ads_list.php');
require_once(ROOTDIR . 'includes/ads_update.php');

require_once(ROOTDIR . 'includes/categories_create.php');
require_once(ROOTDIR . 'includes/categories_list.php');
require_once(ROOTDIR . 'includes/categories_update.php');

require_once(ROOTDIR . 'includes/campaign_create.php');
require_once(ROOTDIR . 'includes/campaign_list.php');
// require_once(ROOTDIR . 'includes/ams_campaigns_update.php');

require_once(ROOTDIR . 'includes/clicks_list.php');

function install(){
    install_blog();
    install_ads();
    install_categories();
    install_campaigns();
    install_campaigns_ads();
    install_clicks();
}

function install_blog(){
    global $wpdb;
    $table_name = $wpdb->prefix . 'ams_blogs';
    $sql = "CREATE TABLE `$table_name` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
        `url` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
        `owner` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
        `document` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
        `email` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
        `whatsapp` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
        `bank` text CHARACTER SET utf8 DEFAULT NULL,
        `token` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
        
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta($sql);
}
    
function install_ads(){
    global $wpdb;
    $table_name = $wpdb->prefix . 'ams_anuncios';
    $sql = "CREATE TABLE `$table_name` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `url` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
        `value` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
        `text` text CHARACTER SET utf8 DEFAULT NULL,
        `file_id` int(11) DEFAULT NULL,
        `file_url` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
        `category_id` int(11) DEFAULT NULL,
        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
}

function install_categories(){
    global $wpdb;
    $table_name = $wpdb->prefix . 'ams_categories';
    $sql = "CREATE TABLE `$table_name` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
}

function install_campaigns(){
    global $wpdb;
    $table_name = $wpdb->prefix . 'ams_campaigns';
    $sql = "CREATE TABLE `$table_name` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `title` varchar(255) DEFAULT NULL,
        `url` varchar(255) DEFAULT NULL,
        `value` decimal(11,2) DEFAULT NULL,
        `blog_id` int(11) DEFAULT NULL,
        `owner` varchar(255) DEFAULT NULL,
        `obs` text DEFAULT NULL,
        `date` datetime DEFAULT NULL,
        `status` int(11) DEFAULT NULL,
        `clicks` int(11) DEFAULT 0,
        `click_goal` int(11) DEFAULT 0,
        `token` varchar(255) DEFAULT NULL,
        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
}

function install_campaigns_ads(){
    global $wpdb;
    $table_name = $wpdb->prefix . 'ams_campaigns_ads';
    $sql = "CREATE TABLE `$table_name` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `campaign_id` int(11) DEFAULT NULL,
        `ad_id` int(11) DEFAULT NULL,
        `clicks` int(11) DEFAULT 0,
        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
}

function install_clicks(){
    global $wpdb;
    $table_name = $wpdb->prefix . 'ams_clicks';
    $sql = "CREATE TABLE `$table_name` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `campaign_id` int(11) DEFAULT NULL,
        `ad_id` int(11) DEFAULT NULL,
        `ip` varchar(255) DEFAULT NULL,
        `created` datetime DEFAULT current_timestamp(),
        PRIMARY KEY (`id`)
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
}
// run the install scripts upon plugin activation
register_activation_hook(__FILE__, 'install');