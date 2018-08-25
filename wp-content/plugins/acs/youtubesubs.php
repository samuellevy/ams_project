<?php
/*
Plugin Name: Acs Subs
Plugin URI: http://traversymedia.com
Description: Display YouTube sub button and count
Version: 1.0.0
Author: Brad Traversy
Author URI: http://traversymedia.com
*/

// Exit if accessed directly
if(!defined('ABSPATH')){
  exit;
}

// Load Scripts
require_once(plugin_dir_path(__FILE__).'/includes/acs-scripts.php');

// Load Class
require_once(plugin_dir_path(__FILE__).'/includes/acs-class.php');

// Register Widget
function register_acs(){
  register_widget('Acs_Widget');
}

// Hook in function
add_action('widgets_init', 'register_acs');