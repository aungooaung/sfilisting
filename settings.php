<?PHP
/**
 * This file is the part of Simple Favourite Items Listing plugin for WordPress.
 * This file displays welcome page on the admin dashboard.
 * Author: Aung Oo Aung (aung.com.au)
 */
 ?>
 <h1>Simple Favourite Items Listing</h1>
 <h2>Shortcode</h2>
 <p>To display the listing on a page or a post, use shortcode <code>[show-sfilisting]</code>.</p>
 <h2>Shortcode Options</h2>
 <p>Shortcode can be used with the following options.</p>
 <table>
	<tr>
		<th>Option name</th>				<th>Description</th>
		<th>Possible values</th>
		<th>Default value</th>
	</tr>
	<tr>
		<td>group</td>				<td>Show items of the given group id.</td>
		<td><em>any valid group id</em></td>
		<td><em>empty</em></td>
	</tr>
	<tr>
		<td>orderby</td>				<td>Sort items by the given value.</td>
		<td>id, name, rate, group*<br><span style="font-size: 80%;"><em>*orderby group option is available only on displaying all groups items.</em></span></td>
		<td>id</td>
	</tr>
	<tr>
		<td>order</td>				<td>Sorting order.</td>
		<td>DESC, ASC</td>
		<td>DESC</td>
	</tr>
	<tr>
		<td>showfrom</td>				<td>Show the list of items from the given number of count.</td>
		<td><em>any number</em></td>
		<td><em>empty</em></td>
	</tr>
	<tr>
		<td>showto</td>				<td>Show the list of items until the given number of count.</td>
		<td><em>any number*<br><span style="font-size: 80%;"><em>*showto value must be greater-than or equal-to showfrom value</span></em></td>
		<td><em>empty</em></td>
	</tr>		<tr>		<td>showimg</td>		<td>Option to show images of the item.</td>		<td>true, false</td>		<td>false</td>	</tr>		<tr>		<td>imgw</td>		<td>Image width.</td>		<td><em>any number</em></td>		<td>150</td>	</tr>		<tr>		<td>imgh</td>		<td>Image height.</td>		<td><em>any number</em></td>		<td>225</td>	</tr>
 </table>
 <h2>Display Style</h2>
 <p>The following classes are used to display the frontend listing style. Overwrite them to customise.</p>
 <table>
	<tr><td>sfilisting</td><td><code>{ border: 0px; }</code></td><td>: Table Style</td></tr>
	<tr><td>sfilisting-name</td><td><code>{ font-weight: bold; font-size: 150%; }</code></td><td>: Title Style</td></tr>
	<tr><td>sfilisting-star</td><td><code>{ font-size: 150%; color: #FFD700; white-space: nowrap; }</code></td><td>: Rating Star Style</td></tr>
	<tr><td>sfilisting-details</td><td><code>{ font-size: 100%; }</code></td><td>: Details Text Style</td></tr>
	<tr><td>groupcol</td><td><code>{ font-size: 80%; color: gray; }</code></td><td>: Group Name Style</td></tr>		<tr><td>sfilisting-img</td><td><code>{ object-fit: cover; }</code></td><td>: Image Style</td></tr>
 </table>
 <hr>
 <p>You're using Simple Favourite Items Listing plugin veresion 1.3.1. For any question, bug report or support, please visit <a href="https://aung.link/sfilisting/" target="_blank">plugin site</a>. </p>
	
	