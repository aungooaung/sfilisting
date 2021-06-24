<?PHP
/**
 * This file is the part of Simple Favourite Items Listing plugin for WordPress.
 * This file contains the form to add a new group.
 * Author: Aung Oo Aung (aung.com.au)
 */
 ?>
	<h1>Create New Group</h1>
	<form method='post' action='?page=managegroup'>
	  <table>
		<tr>
		  <td>Name</td>
		  <td><input type='text' name='group_name' required></td>
		</tr>
		<tr>
		 <td>Description</td>
		 <td><textarea name='group_details' rows='4' cols='50'> </textarea></td>
		</tr>
		<tr>
		 <td>&nbsp;</td>
		 <td><input type='submit' name='creat_group' value='Submit'></td>
		</tr>
	 </table>
	</form>
