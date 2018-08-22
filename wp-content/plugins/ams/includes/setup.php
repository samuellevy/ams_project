<?php 
add_action('admin_menu','ams_menu');

function ams_menu() {
	// AMS BLOGS MENU
	add_menu_page('AMS', //page title
	'AMS - Blogs', //menu title
	'manage_options', //capabilities
	'ams_blogs', //menu slug
	'blogs_list' //function
	);

	add_submenu_page('ams_blogs', //parent slug
	'Adicionar blog', //page title
	'Novo blog', //menu title
	'manage_options', //capability
	'blogs_create', //menu slug
	'blogs_create'); //function
	    
    add_submenu_page('ams_blogs', //parent slug
	'Listar blogs', //page title
	'Listar blogs', //menu title
	'manage_options', //capability
	'blogs_list', //menu slug
	'blogs_list'); //function

	// AMS ADS MENU
	add_menu_page('AMS', //page title
	'AMS - Anúncios', //menu title
	'manage_options', //capabilities
	'ams_ads', //menu slug
	'blogs_list' //function
    );

	add_submenu_page('ams_ads', //parent slug
	'Adicionar anúncio', //page title
	'Novo anúncio', //menu title
	'manage_options', //capability
	'ams_ads_create', //menu slug
	'ams_ads_create'); //function

	add_submenu_page('ams_ads', //parent slug
	'Listar anúncios', //page title
	'Listar anúncios', //menu title
	'manage_options', //capability
	'ads_list', //menu slug
    'ads_list'); //function

	add_submenu_page('ams_ads', //parent slug
	'Adicionar categoria', //page title
	'Nova categoria', //menu title
	'manage_options', //capability
	'ams_categories_create', //menu slug
	'ams_categories_create'); //function

	add_submenu_page('ams_ads', //parent slug
	'Listar categorias', //page title
	'Listar categorias', //menu title
	'manage_options', //capability
	'ams_categories_list', //menu slug
	'ams_categories_list'); //function

	// AMS CAMPAIGNs
	add_menu_page('AMS', //page title
	'AMS - Campanhas', //menu title
	'manage_options', //capabilities
	'ams_campaigns', //menu slug
	'ams_campaigns_list' //function
	);
	
	add_submenu_page('ams_campaigns', //parent slug
	'Adicionar campanha', //page title
	'Nova campanha', //menu title
	'manage_options', //capability
	'ams_campaign_create', //menu slug
	'ams_campaign_create'); //function
	
	add_submenu_page('ams_campaigns', //parent slug
	'Listar campanhas', //page title
	'Listar campanhas', //menu title
	'manage_options', //capability
	'ams_campaign_list', //menu slug
	'ams_campaign_list'); //function



	// ALL UPDATES
    add_submenu_page(null, //parent slug
	'Update blogs', //page title
	'Update blogs', //menu title
	'manage_options', //capability
	'blogs_update', //menu slug
	'blogs_update'); //function

	add_submenu_page(null, //parent slug
	'Update categorias', //page title
	'Update categorias', //menu title
	'manage_options', //capability
	'ams_categories_update', //menu slug
	'ams_categories_update'); //function

	add_submenu_page(null, //parent slug
	'Update ads', //page title
	'Update ads', //menu title
	'manage_options', //capability
	'ads_update', //menu slug
	'ads_update'); //function
}