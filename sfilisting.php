<?php
/*
	Plugin Name: Simple Favourite Items Listing
	Plugin URI: https://aung.link/sfilisting/
	Description: Create simple data lists and display them on posts or pages.
	Version: 1.3
	Author: Aung Oo
	Author URI: https://aung.com.au/
	Text Domain: sfilisting
	Contributors: Aung Oo
	License: GPL-2.0+
	License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */
 /*
	@package 		Simple Favourite Items Listing WordPress Plugin
	@Description	Simple Favourite Items Listing is a WordPress plugin to create simple data lists (such as your favourite films, 		favourite restaurants, etc.) and display them on WordPress posts or pages.
	@author 		Aung Oo
	@license 		GPL-2.0+
	@link 			https://aung.com.au/
	@copyright 		2021 Aung Oo Aung.

 */

//	Defind the database version and table names
//	===========================================
	global $wpdb;

	global $sfilisting_db_version;
	$sfilisting_db_version = "2.20";

	global $sfilisting_groups;
	$sfilisting_groups = $wpdb->prefix . "sfilisting_groups";

	global $sfilisting_items;
	$sfilisting_items = $wpdb->prefix . "sfilisting_items";

//  Update the database
//  ===========================================
	function sfilisting_version_update() {
		global $sfilisting_db_version;
		if (get_option("sfilisting_db_version") != $sfilisting_db_version) {
			sfilisting_tables();
			sfilisting_update_tables();
		}
	}

//	Register the tables and seed the sample data
//	===========================================
	require_once dirname( __FILE__ ) . "/database.php";
	register_activation_hook( __FILE__, "sfilisting_tables" );
    register_activation_hook( __FILE__, "sfilisting_seeds" );
	add_action( "plugins_loaded", "sfilisting_version_update" );

//	Add style and JS to the admin pages
//	===========================================
	function load_sfilisting_frontend_style() {
		wp_register_style("sfilisting_displaystyle", plugins_url("display-style.css",__FILE__ ));
		wp_enqueue_style("sfilisting_displaystyle");
	}
	add_action( 'wp_enqueue_scripts', 'load_sfilisting_frontend_style' );

	function load_sfilisting_admin_style(){
		wp_register_style("sfilisting_style", plugins_url("DataTables/datatables.css",__FILE__ ));
		wp_enqueue_style("sfilisting_style");
		wp_register_script( "sfilisting_script", plugins_url("DataTables/datatables.min.js",__FILE__ ), array( "jquery" ));
		wp_enqueue_script( "sfilisting_script" );
	}
	add_action( "admin_enqueue_scripts", "load_sfilisting_admin_style" );




//	Create the admin pages
//	===========================================
	function settingPage(){
	  include "settings.php";
	}

	function manageGroup(){
	  include "managegroup.php";
	}

	function addGroup(){
	  include "addgroup.php";
	}

	function editGroup() {
		include "editgroup.php";
	}

	function manageItem(){
	  include "manageitem.php";
	}

	function addItem(){
	  include "additem.php";
	}

	function editItem() {
		include "edititem.php";
	}

//	Create the admin menu
//	===========================================
	 function sfilisting_menu() {
		add_menu_page("Favourite Items Listing", "Favourite Items","manage_options", "sfilisting", "settingPage","dashicons-heart");
		add_submenu_page("sfilisting","Manage Groups", "Manage Groups","manage_options", "managegroup", "manageGroup");
		add_submenu_page("sfilisting","Manage Items", "Manage Items","manage_options", "manageitem", "manageItem");
		add_submenu_page(null,"Add Group","Add Group","manage_options","addgroup","addGroup");
		add_submenu_page(null,"Edit Group","Edit Group","manage_options","editgroup","editGroup");
		add_submenu_page(null,"Add Item","Add Item","manage_options","additem","addItem");
		add_submenu_page(null,"Edit Item","Edit Item","manage_options","edititem","editItem");
	}
	add_action("admin_menu", "sfilisting_menu");

//	Register the shortcode
//	===========================================
	require_once dirname( __FILE__ ) . "/shortcode.php";
	function register_shortcodes(){
		add_shortcode("show-sfilisting", "sfilisting_shortcode_function");
	}
	add_action("init","register_shortcodes");


//	Add scripts to the admin footer
//	===========================================
	function sfilisting_internal_javascript(){
		echo 	"<script>
    				jQuery(document).ready(function($) {

    					$('#admingrouplisttable').DataTable(
    					{
    						columnDefs: [
    						   { targets: [3,4], orderable: false }
    						],
    						order: [
    							[ 0, 'desc' ]
    						]
    					});

    					$('#adminitemlisttable').DataTable(
    					{
    						columnDefs: [
    						   { targets: [1,6,7], orderable: false }
    						],
    						order: [
    							[ 0, 'desc' ]
    						]
    					});

              $('.form-star').change(function() {
                $('.form-star').not(this).prop('checked', false);
              });

    				});
				</script>";
	}
	add_action( 'admin_print_footer_scripts', 'sfilisting_internal_javascript' );
