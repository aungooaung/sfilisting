<?PHP
/**
 * This file is the part of Simple Favourite Items Listing plugin for WordPress.
 * This file contains the form to add new group and displays the list of group from database.
 * Author: Aung Oo Aung (aung.com.au)
 */
	require_once dirname( __FILE__ ) . "/helper.php";
 ?>
	<h1>Manage Group</h1>
	<a href="?page=addgroup" class="button">Create New</a>
	<?
	//Creating a new group
	if(isset($_POST['creat_group'])){
	  if(createGroup($_POST['group_name'],$_POST['group_details'])){
		  echo "<p><span style='color:green'>A new group has been created.</span></p>";
	  } else {
		  echo "<p><span style='color:red'>CANNOT create a new group.</span></p>";
	  } 
	}
	//Updating a group
	if(isset($_POST['but_edit'])){
		if(updateGroup($_POST['groupid'],$_POST['new_name'],$_POST['new_details'])){
			echo "<p><span style='color:green'>Group ID[".$_POST['groupid']."] has been updated!</span></p>";
		} else {
			echo "<p><span style='color:red'>Problem with updating group ID[".$_POST['groupid']."].</span></p>";
		}
	}
	//Deleting a group
	if(isset($_GET['delid'])) {
		if(deleteGroup($_GET['delid'])){
			echo "<p><span style='color:red'>Group ID[".$_GET['delid']."] has deleted!</span></p>";
		} else {
			echo "<p><span style='color:red'>group ID[".$_GET['delid']."] CANNOT delete!</span></p>";
		}
	}
	?>	 
	 <p>Note: Group cannot be deleted unless there's no item attached.</p>
	 <table id="admingrouplisttable" class="display" style="width:100%">
	 <thead>
	  <tr>
		<th width='2%'>ID</th>
		<th width='20%'>Group Name</th>
		<th>Description</th>
		<th width='3%'>Items</th>
		<th width='5%'>&nbsp;</th>
		<th width='5%'>&nbsp;</th>
	  </tr>
	  </thead>
	  <tbody>
  
<? 		
	if($groupList = getGroupList('id','DESC')) {
		foreach($groupList as $entry){
		  $id = $entry->id;
		  $name = $entry->name;
		  $details = $entry->details;
		  $totalitems = countItems($id);
		  if($totalitems){
			  $delbutton = "<span style='color:gray'>Delete</span>";
		  } else {
			  $delbutton = "<a href='?page=managegroup&delid=".$id."'>Delete</a>";
		  }

		  echo "<tr>
		  <td align='right'>".$id."</td>
		  <td>".$name."</td>
		  <td>".$details."</td>
		  <td align='right'>".$totalitems."</td>
		  <td align='center'><a href='?page=editgroup&editid=".$id."'>Edit</a></td>
		  <td align='center'>".$delbutton."</td>
		  </tr>
		  ";
		}
	} else {
		echo "<tr><td colspan='6'>No group name found.</td></tr>";
	}
?>
	</tbody>
	</table>
	