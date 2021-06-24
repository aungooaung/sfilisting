<?PHP
/**
 * This file is the part of Simple Favourite Items Listing plugin for WordPress.
 * This file contains functions to create shortcodes.
 * Author: Aung Oo Aung (aung.com.au)
 */
 require_once dirname( __FILE__ ) . "/helper.php";
 
 function sfilisting_shortcode_function($atts) {
	 extract(shortcode_atts(array(
				'group' => 0,
				'orderby' => 'id',
				'order' => 'DESC',
				'showfrom' => 0,
				'showto' => 0,								'imgw' => 150,								'imgh' => 225,								'showimg' => false
			), $atts));
			
	 if($group) {
		 $displayItems = getGroupItems($group,$orderby,$order);
	 } else {
		 $displayItems = getItemList($orderby, $order);
	 }
	 
	 $return_string = '<table class="sfilisting">';
	 if($displayItems){
	   $count = 0;
	   foreach($displayItems as $displayItem){
			$id = $displayItem->id;
			$name = $displayItem->name;
			$details = $displayItem->details;
			$rate = showStars($displayItem->rate);						$img_url = $displayItem->img_url;			
			if(!$group) {
				$group_name = $displayItem->group_name;
			}
			$count++;
			if($showfrom <= $count) {				
				$return_string .= '<tr class="sfilisting">';								if($showimg == true) {										if($img_url) {											$img_file = '<img class="sfilisting-img" src="'.$img_url.'" alt="'.$name.'" width="'.$imgw.'" height="'.$imgh.'">';										} else {												$img_file = '';											}										$return_string .= '<td width="20%" class="sfilisting imgcol">'.$img_file.'</td>';									}
				$return_string .= '<td width="70%"><span class="sfilisting-name">'.$name.'</span><br><span class="sfilisting-star">'.$rate.'</span><br><span class="sfilisting-details">'.$details.'</span></td>';								$return_string .= '</tr>';
				
				if($group == 0) {
				  $return_string .= '<tr class="sfilisting">';
				  $return_string .= '<td class="sfilisting-td groupcol">'.$group_name.'</td>';
				  $return_string .= '</tr>';
				}
			}
			if ($count == $showto){
			  break;		  
			}
	   }
	}else{
	   $return_string .= '<tr><td>No data to display.</td></tr>';
	}
	$return_string .= '</table>';
	return $return_string;
 }
 /*
 function display_items_function($atts){
	global $wpdb;
	global $sfilisting_db_version;
	global $sfilisting_groups;
	global $sfilisting_items;
	extract(shortcode_atts(array(
		'group' => 0,
		'orderby' => 'i.id',
		'order' => 'DESC',
		'showfrom' => 0,
		'showto' => 0,
	), $atts));
	
	if ($orderby == 'name') {
		$orderby = 'i.name';
	} elseif ($orderby == 'rate') {
		$orderby = 'i.rate';
	}
	$return_string = '<table width="98%" style="border: none">';
 
   if($group == 0) {
	   $query_items = $wpdb->get_results("SELECT i.id AS iid, i.name AS iname, g.name AS gname, i.details AS idetails, i.rate AS irate FROM ".$sfilisting_items." i LEFT JOIN ".$sfilisting_groups." g ON i.group_id=g.id ORDER BY $orderby $order");
   } else {
	   $query_items = $wpdb->get_results("SELECT i.id AS iid, i.name AS iname, g.name AS gname, i.details AS idetails, i.rate AS irate FROM ".$sfilisting_items." i LEFT JOIN ".$sfilisting_groups." g ON i.group_id=g.id WHERE i.group_id=$group ORDER BY $orderby $order");
   }

   if(count($query_items) > 0){
	   $count = 0;  
	  
		foreach($query_items as $item){
			$id = $item->iid;
			$name = $item->iname;
			$group_name = $item->gname;
			$details = $item->idetails;
			$rate = $item->irate;
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
				$rate;
			}
			$count++;
			if($showfrom <= $count) {
				$return_string .= '<tr style="border: none">';
				$return_string .= '<td style="border: none; font-size: 120%;"><strong>'.$name.'</strong></td>';
				$return_string .= '<td width="25%" style="border: none; text-align: right;">'.$rate.'</td>';
				$return_string .= '</tr><tr style="border: none">';
				$return_string .= '<td colspan="2" style="border: none">'.$details.'</td>';
				$return_string .= '</tr>';
				if($group == 0) {
				  $return_string .= '<tr style="border: none">';
				  $return_string .= '<td colspan="2" style="border: none; color: grey;">'.$group_name.'</td>';
				  $return_string .= '</tr>';
				}
			}
			if ($count == $showto){
			  break;		  
			}
		}
   }else{
	   $return_string .= '<tr><td>No data to display.</td></tr>';
   }

	$return_string .= '</table>';

   return $return_string;
}
*/

