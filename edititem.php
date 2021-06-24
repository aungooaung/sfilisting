<?PHP
/**
 * This file is the part of Simple Favourite Items Listing plugin for WordPress.
 * This file display the edit form for the item table and update the database.
 * Author: Aung Oo Aung (aung.com.au)
 */
	require_once dirname( __FILE__ ) . "/helper.php";

	$data = getItem($_GET['editid']);
	$groupList = getGroupList('name','ASC');

?>

<h1>Edit Item</h1>
	<form method='post' action='?page=manageitem'>
	<input type="hidden" name="itemid" value="<? echo $_GET['editid'] ?>">
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
		 <td>Group</td>
		 <td>
			<select id='new_group' name='new_group'>
	<?
		foreach($groupList as $group){
			if ($group->id == $data->group_id){
				echo "<option value='".$group->id."' selected>".$group->name."</option>";
			}else{
				echo "<option value='".$group->id."'>".$group->name."</option>";
			}
		}
	?>
			</select>
		 </td>
		</tr>
		<tr>
		 <td>Rate</td>
		 <td>
			<label><input type="checkbox" id="1-star" name="new_star" class="form-star"  value="1" <? if($data->rate==1){echo "checked";} ?>/> ★</label>
			<label><input type="checkbox" id="2-star" name="new_star" class="form-star"  value="2" <? if($data->rate==2){echo "checked";} ?>/> ★★</label>
			<label><input type="checkbox" id="3-star" name="new_star" class="form-star"  value="3" <? if($data->rate==3){echo "checked";} ?>/> ★★★</label>
			<label><input type="checkbox" id="4-star" name="new_star" class="form-star"  value="4" <? if($data->rate==4){echo "checked";} ?>/> ★★★★</label>
			<label><input type="checkbox" id="5-star" name="new_star" class="form-star"  value="5" <? if($data->rate==5){echo "checked";} ?>/> ★★★★★</label>
		 </td>
		</tr>
		<tr>
		  <td>Image Url</td>
		  <td><input type='text' name='new_url' value='<?php echo $data->img_url ?>'></td>
		</tr>
		<tr>
		 <td>&nbsp;</td>
		 <td><input type='submit' name='but_edit' value='Submit'></td>
		</tr>
	 </table>
	</form>
