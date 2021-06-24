<?PHP
/**
 * This file is the part of Simple Favourite Items Listing plugin for WordPress.
 * This file contains the add item form.
 * Author: Aung Oo Aung (aung.com.au)
 */
	require_once dirname( __FILE__ ) . "/helper.php";
	?>
	<h1>Manage Item</h1>
	<?
	if(hasGroup()) {
		echo "<a href='?page=additem' class='button'>Create New</a>";
	} else {
		echo "<p><span style='color:red'>You need to <a href='?page=addgroup'>create a group</a> before creating an item.</span></p>";
	}
	
	// Delete record
	if(isset($_GET['delid'])) {
		if(deleteItem($_GET['delid'])) {
			echo "<p><span style='color:red'>Item ID[".$_GET['delid']."] has deleted!</span></p>";
		} else {
			echo "<p><span style='color:red'>Item ID[".$_GET['delid']."] CANNOT delete!</span></p>";
		}
	}
	
	//update item
	if(isset($_POST['but_edit'])){	  
	  $newdata = array("id" => $_POST['itemid'], "name" => $_POST['new_name'], "details" => $_POST['new_details'], "rate" => $_POST['new_star'], "group_id" => $_POST['new_group'], "img_url" => $_POST['new_url']);
	  if(updateItem($newdata)){
		  echo "<p><span style='color:green'>Item ID[".$_POST['itemid']."] has been updated!</span></p>";
	  } else {
		  echo "<p><span style='color:red'>Problem with updating item ID[".$_POST['itemid']."].</span></p>";
	  }   
	}
	
	// Add record
	if(isset($_POST['but_submit'])){	  
	  $data = array("name" => $_POST['txt_name'], "details" => $_POST['txt_details'], "rate" => $_POST['star'], "group_id" => $_POST['sel_group'], "img_url" => $_POST['txt_url']);
	  if(createItem($data)){
		  echo "<p><span style='color:green'>A new item has been created.</span></p>";
	  } else {
		  echo "<p><span style='color:red'>CANNOT create a new item.</span></p>";
	  }   
	}	
	?>
	<p>Note: Items must be attached to a group.</p>
	 <table id="adminitemlisttable" class="display" style="width:100%">
	 <thead>
	  <tr>
	   <th width='2%'>ID</th>
	   <th>Image</th>
	   <th>Item</th>
	   <th width='10%'>Group</th>
	   <th>Description</th>
	   <th width='5%'>Rating</th>
	   <th width='5%'>&nbsp;</th>
	   <th width='5%'>&nbsp;</th>
	  </tr>
	 </thead>
	 <tbody>
	<?
	if($entriesList = getItemList('id','DESC')){
		foreach($entriesList as $entry){
		  $id = $entry->id;
		  $name = $entry->name;
		  $group_name = $entry->group_name;
		  $details = $entry->details;
		  $rate = showStars($entry->rate);
		  $img_url = $entry->img_url;
		  if($img_url){
				$img_url = "<img src='".$img_url."' alt='".$name."' style='width: 128px; height: 128px; object-fit: cover;'>";
		  } else {
				$img_url = "<img src='https://via.placeholder.com/128x128.jpg?text=No+Image' alt='no image'>";
		  }
		  echo "<tr>
		  <td align='right'>".$id."</td>
		  <td>".$img_url."</td>
		  <td>".$name."</td>
		  <td>".$group_name."</td>
		  <td>".$details."</td>
		  <td align='right'>".$rate."</td>
		  <td align='center'><a href='?page=edititem&editid=".$id."'>Edit</a></td>
		  <td align='center'><a href='?page=manageitem&delid=".$id."'>Delete</a></td>
		  </tr>";
		}
	}else{
		echo "<tr><td colspan='7'>No item found.</td></tr>";
	}
?>
	</tbody>
	</table>


