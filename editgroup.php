<?PHP
/**
 * This file is the part of Simple Favourite Items Listing plugin for WordPress.
 * This file display the edit form for the group table and update the database.
 * Author: Aung Oo Aung (aung.com.au)
 */
	require_once dirname( __FILE__ ) . "/helper.php";	
	$data = getGroupName($_GET['editid']);

?>
	<h1>Edit Group</h1>
	<form method='post' action='?page=managegroup'>
	<input type="hidden" name="groupid" value="<? echo $_GET['editid'] ?>">
	  <table>
		<tr>
		  <td>Name</td>
		  <td><input type='text' name='new_name' value='<?php echo $data->name ?>' required></td>
		</tr>
		<tr>
		 <td>Description</td>
		 <td><textarea name='new_details' rows='4' cols='50'><?php echo $data->details ?></textarea></td>
		</tr>
		<tr>
		 <td>&nbsp;</td>
		 <td><input type='submit' name='but_edit' value='Update'></td>
		</tr>
	 </table>
	</form>