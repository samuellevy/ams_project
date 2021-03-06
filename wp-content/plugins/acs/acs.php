<?php
/*
Plugin Name: Acs
Plugin URI: http://nokengo.com
Description: Display ADS from AMS
Version: 1.0.2 - 24/09[2018]
Author: Samuel Levy
Author URI: http://nokengo.com
*/

// Exit if accessed directly
if(!defined('ABSPATH')){
  // exit;
}

// Load Scripts
require_once(plugin_dir_path(__FILE__).'/includes/acs-scripts.php');

// Load Class
require_once(plugin_dir_path(__FILE__).'/includes/acs-class.php');

// Out widget
require_once(plugin_dir_path(__FILE__).'includes/acs-out-widget.php');

// Register Widget
function register_acs(){
  register_widget('Acs_Widget');
}

// Hook in function
$acs = new Acs();
echo('TESTE');
$widget = new Acs_Widget();

// run the install scripts upon plugin activation
register_activation_hook(__FILE__, 'installation');
add_action('widgets_init', 'register_acs');


function installation(){
  install_configs();
}

function install_configs(){
  global $wpdb;
  $table_name = $wpdb->prefix . 'acs_configs';
  $sql = "CREATE TABLE `$table_name` (
      `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
      `token` varchar(255) DEFAULT NULL,
      `title` varchar(255) DEFAULT NULL,
      `count` int(11) DEFAULT NULL,
      `url` varchar(255) DEFAULT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;";
      
      require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
      dbDelta($sql);
}