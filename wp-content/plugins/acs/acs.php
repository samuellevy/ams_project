<?php
/*
Plugin Name: Acs
Plugin URI: http://nokengo.com
Description: Display ADS from AMS
Version: 1.0.1
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