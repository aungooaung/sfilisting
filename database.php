<?php
/**
 * This file is the part of Simple Favourite Items Listing plugin for WordPress.
 * This file contains database functions.
 * Author: Aung Oo Aung (aung.com.au)
 */
 
//	Create new tables in the database
//	==================================== 
	function sfilisting_tables()
	{
		global $wpdb;
		global $sfilisting_db_version;
		global $sfilisting_groups;
		global $sfilisting_items;
		
		$charset_collate = $wpdb->get_charset_collate();
		
		$groups =	"CREATE TABLE " . $sfilisting_groups . " (
					id MEDIUMINT(9) NOT NULL AUTO_INCREMENT,
					name TINYTEXT NOT NULL,
					details TINYTEXT NULL,
					PRIMARY KEY (id)
					) " . $charset_collate . " ;";
		
		$items =	"CREATE TABLE " . $sfilisting_items . " (
					id MEDIUMINT(9) NOT NULL AUTO_INCREMENT,
					name TINYTEXT NOT NULL,
					details TINYTEXT NOT NULL,
					rate TINYINT(1) UNSIGNED NULL,
					group_id MEDIUMINT(9) NULL,
					PRIMARY KEY (id)
					) " . $charset_collate . " ;";
					
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $groups );
		dbDelta( $items );

		add_option( 'sfilisting_db_version', $sfilisting_db_version );
	}

//	Update tables
//	==================================== 	
	function sfilisting_update_tables()
	{
		global $wpdb;
		global $sfilisting_db_version;
		global $sfilisting_items;
		$wpdb->query("ALTER TABLE $sfilisting_items ADD img_url VARCHAR(255) NULL AFTER group_id");
		$wpdb->query("ALTER TABLE $sfilisting_items MODIFY details TEXT NOT NULL");
		
		update_option( "sfilisting_db_version", $sfilisting_db_version );
	}
	
//	Seed sample data to the newly created tables
//	==================================== 	

	function sfilisting_seeds()
	{
		global $wpdb;
		global $sfilisting_groups;
		global $sfilisting_items;
		$wpdb->query(sprintf("SELECT * FROM " . $sfilisting_groups));
		if($wpdb->num_rows === 0) {		
			$group_name = "Sample Group";
			$group_details = "This is the sample group. You can assign items to a group, and display items of the selected group."; 
			
			$item_name = "Hello World";
			$item_details = "This is the sample item. Create new items and you may assign them to a group.";
					
			$wpdb->insert( 
			$sfilisting_groups, 
				array( 
					'id' => 1,
					'name' => $group_name,			
					'details' => $group_details
				) 
			);
			
			$wpdb->insert( 
			$sfilisting_items, 
				array( 
					'name' => $item_name,			
					'details' => $item_details,
					'rate' => 5,
					'group_id' => 1
				) 
			);
		}
	}
		
		

