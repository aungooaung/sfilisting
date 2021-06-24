<?PHP
/**
 * This file is the part of Simple Favourite Items Listing plugin for WordPress.
 * This file contains the form to create a new item.
 * Author: Aung Oo Aung (aung.com.au)
 */

	require_once dirname( __FILE__ ) . "/helper.php";

	if($groupList = getGroupList('id','ASC')) {
	?>
	<h1>Create New Item</h1>
	<form method='post' action='?page=manageitem'>
	  <table>
		<tr>
		  <td>Name</td>
		  <td><input type='text' name='txt_name'></td>
		</tr>
		<tr>
		 <td>Description</td>
		 <td><textarea name='txt_details' rows='4' cols='50'> </textarea></td>
		</tr>
		<tr>
		 <td>Group</td>
		 <td>
			<select id='sel_group' name='sel_group'>
	<?
		foreach($groupList as $group){
			echo "<option value=".$group->id.">".$group->name."</option>";
		}
	?>
			</select>
		 </td>
		</tr>
		<tr>
		 <td>Rate</td>
		 <td>
    <!--
			<input type="radio" id="1-star" name="star" value="1">
			<label for="1-star">★</label><br>
			<input type="radio" id="2-star" name="star" value="2">
			<label for="2-star">★★</label><br>
			<input type="radio" id="3-star" name="star" value="3">
			<label for="3-star">★★★</label><br>
			<input type="radio" id="4-star" name="star" value="4">
			<label for="4-star">★★★★</label><br>
			<input type="radio" id="5-star" name="star" value="5">
			<label for="5-star">★★★★★</label>
    -->
      <label><input type="checkbox" name="star" class="form-star"  value="1" /> ★</label>
      <label><input type="checkbox" name="star" class="form-star"  value="2" /> ★★</label>
      <label><input type="checkbox" name="star" class="form-star"  value="3" /> ★★★</label>
      <label><input type="checkbox" name="star" class="form-star"  value="4" /> ★★★★</label>
      <label><input type="checkbox" name="star" class="form-star"  value="5" /> ★★★★★</label>

		 </td>
		</tr>
    <tr>
      <td>Image Url</td>
      <td><input type='text' name='txt_url'></td>
    </tr>
		<tr>
		 <td>&nbsp;</td>
		 <td><input type='submit' name='but_submit' value='Submit'></td>
		</tr>
	 </table>
	</form>
	<?
	} else {
		echo "<p>You need to <a href='?page=addgroup'>create a group</a> before creating an item.</p>";
		exit;
	}
