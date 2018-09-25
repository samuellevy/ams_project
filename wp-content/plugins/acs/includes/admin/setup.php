<?php 
add_action('admin_menu','acs_menu');

function acs_menu() {
	// AMS BLOGS MENU
	add_menu_page('AMS', //page title
	'ACS', //menu title
	'manage_options', //capabilities
	'acs_dashboard_menu', //menu slug
	'acs_dashboard_index' //function
	);

	add_submenu_page('acs_dashboard_menu', //parent slug
	'Configurações', //page title
	'Configurações', //menu title
	'manage_options', //capability
	'acs_dashboard_index', //menu slug
	'acs_dashboard_index'); //function
}