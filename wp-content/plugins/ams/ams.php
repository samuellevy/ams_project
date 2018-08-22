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

function install(){
    install_blog();
    install_ads();
    install_categories();
}

function install_blog()
{
    global $wpdb;
    
    $table_name = $wpdb->prefix . "ams_blogs";
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name (
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
        ) $charset_collate; ";
        
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta($sql);
}
    
function install_ads(){
    global $wpdb;
    
    $table_name = $wpdb->prefix . "ams_anuncios";
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        `url` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
        `value` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
        `text` text CHARACTER SET utf8 DEFAULT NULL,
        `file_id` int(11) DEFAULT NULL,
        `file_url` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
        `category_id` int(11) DEFAULT NULL,
        PRIMARY KEY (`id`)
        ) $charset_collate; ";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
}

function install_categories(){
    global $wpdb;
    
    $table_name = $wpdb->prefix . "ams_categories";
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `name` varchar(255) DEFAULT NULL,
        PRIMARY KEY (`id`)
        ) $charset_collate; ";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
}
// run the install scripts upon plugin activation
register_activation_hook(__FILE__, 'install');