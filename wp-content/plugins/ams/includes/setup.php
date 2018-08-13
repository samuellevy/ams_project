<?php 
add_action('admin_menu','ams_menu');

function ams_menu() {
	//this is the main item for the menu
	add_menu_page('AMS', //page title
	'AMS', //menu title
	'manage_options', //capabilities
	'ams_main', //menu slug
	'blogs_list' //function
    );

    add_submenu_page('ams_main', //parent slug
	'Adicionar blog', //page title
	'Novo blog', //menu title
	'manage_options', //capability
	'blogs_create', //menu slug
	'blogs_create'); //function
	
	add_submenu_page('ams_main', //parent slug
	'Adicionar anúncio', //page title
	'Novo anúncio', //menu title
	'manage_options', //capability
	'ams_ads_create', //menu slug
	'ams_ads_create'); //function
    
    add_submenu_page('ams_main', //parent slug
	'Listar blogs', //page title
	'Listar blogs', //menu title
	'manage_options', //capability
	'blogs_list', //menu slug
	'blogs_list'); //function
	
	add_submenu_page('ams_main', //parent slug
	'Listar anúncios', //page title
	'Listar anúncios', //menu title
	'manage_options', //capability
	'ads_list', //menu slug
    'ads_list'); //function
    
    add_submenu_page(null, //parent slug
	'Update blogs', //page title
	'Update blogs', //menu title
	'manage_options', //capability
	'blogs_update', //menu slug
	'blogs_update'); //function

	add_submenu_page(null, //parent slug
	'Update ads', //page title
	'Update ads', //menu title
	'manage_options', //capability
	'ads_update', //menu slug
	'ads_update'); //function
}