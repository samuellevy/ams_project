
<?php
  // Add Scripts
  function acs_add_scripts(){
    // Add Main CSS
    wp_enqueue_style('acs-main-style', plugins_url(). '/acs/css/style.css');
    // Add Main JS

    wp_enqueue_script('acs-main-jquery', 'https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js');
    wp_enqueue_script('acs-main-script', plugins_url(). '/acs/js/main.js', '', '0.15');

    // Add Google Script
    wp_register_script('google', 'https://apis.google.com/js/platform.js');
    wp_enqueue_script('google');
  }

  add_action('wp_enqueue_scripts', 'acs_add_scripts');