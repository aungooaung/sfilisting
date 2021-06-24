<?PHP
/**
 * This file is the part of Simple Favourite Items Listing plugin for WordPress.
 * This file contains the functions to help the plugin to perform specific tasks.
 * Author: Aung Oo Aung (aung.com.au)
 */

 //Functions to manage group
 //=========================

 //Create a new group
 function createGroup($name,$details) {
	global $wpdb;
	global $sfilisting_groups;
	$name = sanitize_text_field(stripslashes_deep($name));
	$details = sanitize_text_field(stripslashes_deep($details));
	if($name != ''){
		return $wpdb->query($wpdb->prepare("INSERT INTO $sfilisting_groups ( name, details ) VALUES ( %s, %s )", $name, $details));
	}
	return false;
 }

 //Edit the group
 function updateGroup($id,$name,$details) {
	global $wpdb;
	global $sfilisting_groups;
	$name = sanitize_text_field(stripslashes_deep($name));
	$details = sanitize_text_field(stripslashes_deep($details));
	if($name != ''){
		return $wpdb->query($wpdb->prepare("UPDATE $sfilisting_groups SET name = %s, details = %s WHERE id = %d", $name, $details, $id));
	}
	return false;
 }

 //Delete the group
 function deleteGroup($groupId) {
	global $wpdb;
	global $sfilisting_groups;
	return $wpdb->query($wpdb->prepare("DELETE FROM $sfilisting_groups WHERE id = %d", $groupId));
 }

 //Count total items of the group
 function countItems($groupId) {
	global $wpdb;
	global $sfilisting_items;
	return $wpdb->get_var("SELECT COUNT(*) FROM $sfilisting_items WHERE group_id = $groupId");
 }

 //Get the list of Group
 function getGroupList($orderby,$order) {
	global $wpdb;
	global $sfilisting_groups;
	return $wpdb->get_results("SELECT id, name, details FROM $sfilisting_groups ORDER BY $orderby $order");
 }

 //Get the Group name
 function getGroupName($groupId) {
	global $wpdb;
	global $sfilisting_groups;
	return $wpdb->get_row("SELECT name, details FROM $sfilisting_groups WHERE id=$groupId");
 }

 //Check if there's a group
 function hasGroup() {
	global $wpdb;
	global $sfilisting_groups;
	if($found = $wpdb->get_results("SELECT id FROM $sfilisting_groups LIMIT 1")){
		return true;
	}
	return false;
 }
 //=========================
 //Functions to manage item
 //=========================
 /* Create a new item
  * @param    array[name,details,rate,group_id]
  * @return   boolean
  */
 function createItem($data) {
	global $wpdb;
	global $sfilisting_items;
	$name = sanitize_text_field(stripslashes_deep($data['name']));
	$details = sanitize_text_field(stripslashes_deep($data['details']));
	$rate = $data['rate'];
	$group_id = $data['group_id'];
	$img_url = esc_url_raw($data['img_url']);
	if($name != '' && $details != ''){
		return $wpdb->query($wpdb->prepare("INSERT INTO $sfilisting_items ( name, details, rate, group_id, img_url ) VALUES ( %s, %s, %d, %d, %s )", $name, $details, $rate, $group_id, $img_url));
	}
	return false;
 }

 function getItem($id) {
	global $wpdb;
	global $sfilisting_items;
	return $wpdb->get_row("SELECT name, details, rate, group_id, img_url FROM $sfilisting_items WHERE id=$id");
 }

 function updateItem($data) {
	global $wpdb;
	global $sfilisting_items;
	$id = $data['id'];
	$name = sanitize_text_field(stripslashes_deep($data['name']));
	$details = sanitize_text_field(stripslashes_deep($data['details']));
	$rate = $data['rate'];
	$group_id = $data['group_id'];
	$img_url = esc_url_raw($data['img_url']);
	if($name != '' && $details != ''){
		return $wpdb->query($wpdb->prepare("UPDATE $sfilisting_items SET name = %s, details = %s, rate = %d, group_id = %d, img_url = %s WHERE id = %d", $name, $details, $rate, $group_id, $img_url, $id));
	}
	return false;
 }

 /* Get the item list
  * @param    $orderby : id,name,details,rate,group
  *			  $order   : DESC, ASC
  * @return   array
  */
 function getItemList($orderby, $order) {
	global $wpdb;
	global $sfilisting_items;
	global $sfilisting_groups;
	switch ($orderby) {
			  case "id":
				$orderby = "i.id";
				break;
			  case "name":
				$orderby = "i.name";
				break;
			  case "details":
				$orderby = "i.details";
				break;
			  case "rate":
				$orderby = "i.rate";
				break;
			  case "group":
				$orderby = "g.name";
				break;
			  default:
				$orderby = "i.id";
		   }
	return $wpdb->get_results("SELECT i.id AS id, i.name AS name, g.name AS group_name, i.details AS details, i.rate AS rate, i.img_url AS img_url FROM $sfilisting_items i LEFT JOIN $sfilisting_groups g ON i.group_id=g.id ORDER BY $orderby $order");
 }

 function getGroupItems($group_id,$orderby,$order) {
	global $wpdb;
	global $sfilisting_items;
	return $wpdb->get_results("SELECT id, name, details, rate, img_url FROM $sfilisting_items WHERE group_id=$group_id ORDER BY $orderby $order");
 }

 function showStars($rate) {
	 switch ($rate) {
			  case "1":
				$rate = "★";
				break;
			  case "2":
				$rate = "★★";
				break;
			  case "3":
				$rate = "★★★";
				break;
			  case "4":
				$rate = "★★★★";
				break;
			  case "5":
				$rate = "★★★★★";
				break;
			  default:
				$rate = "";
		  }
	return $rate;
 }

 function deleteItem($itemId) {
	global $wpdb;
	global $sfilisting_items;
	return $wpdb->query($wpdb->prepare("DELETE FROM $sfilisting_items WHERE id = %d", $itemId));
 }
