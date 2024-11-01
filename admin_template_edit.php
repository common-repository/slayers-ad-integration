<?php

$ad = false;

// Find ad by ID
if(isset($_GET['id']) && !empty($this->ads[$_GET['id']]))
	$ad = $this->ads[$_GET['id']];


if(!$ad)
	echo '<div class="error"><p><strong>Error! Could not find ad.</strong></p></div>';
else {

?><div class="wrap">
	<h2>Edit ad</h2>
	<form id="ak_sharethis" name="ak_sharethis" action="" method="post">
		<table class="form-table">
			<tr>
				<th scope="row" style="width:200px;"><label for="name">Ad name</label></th>
				<td><input type="text" id="name" name="name" value="<?php echo $ad['name'] ?>" size="40" /></td>
			</tr>
			<tr>
				<th scope="row" style="width:200px;"><label for="code">Ad HTML Code</label></th>
				<td><textarea id="code" cols="100" rows="10" name="code"><?php echo $ad['code']; ?></textarea></td>
			</tr>
			<tr>
				<th scope="row"><label for="use_wrapper">Use default HTML wrapper</label></th>
				<td>
					<input  type="radio" name="use_wrapper" <?php echo $ad['use_wrapper'] ? 'checked="checked"' : false; ?> value="1" /> Yes  <br/>
					<input type="radio" name="use_wrapper" <?php echo !$ad['use_wrapper'] ? 'checked="checked"' : false; ?> value="0" /> No
				</td>
			</tr>	
			<tr>
				<th scope="row"><label for="max_count">Max repeat count on same page(in random mode)</label></th>
				<td><select name="max_count" id="max_count"><?php
					$n = $this->info['max_count_per_page'];
						for( $i  = 1 ; $i <= 10 ; $i++ )
							echo '<option ', $ad['max_count'] == $i ? 'selected="selected"' : false,' value="',$i,'">',$i,'</option>';
				?></select> eg: for google adsense you must make sure that this value is lower than 3</td>
			</tr>
			<tr>
				<th scope="row"><label for="position">Ad position</label></th>
				<td>
					<select name="position" id="position">
						<option <?php echo $ad['position'] == 0 ? 'selected="selected"' : false; ?> value="0">Top (in front of the main HTML content of every post)</option>
						<option <?php echo $ad['position'] == 1 ? 'selected="selected"' : false; ?> value="1">Middle (to the nearest new line breaker from the middle of every post)</option>
						<option <?php echo $ad['position'] == 2 ? 'selected="selected"' : false; ?> value="2">Bottom (after every post)</option>
					</select> 
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="html_after">Align</label></th>
				<td>
					<input type="radio" name="align" <?php echo $ad['align']=='none' ? 'checked="checked"' : false; ?> value="none" /> None<br/>
					<input type="radio" name="align" <?php echo $ad['align']=='left' ? 'checked="checked"' : false; ?> value="left" /> Left <br/>
					<input type="radio" name="align" <?php echo $ad['align']=='right' ? 'checked="checked"' : false; ?> value="right" /> Right
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="auto_load">Load type</label></th>
				<td>
					<input  type="radio" name="auto_load" <?php echo $ad['auto_load'] ? 'checked="checked"' : false; ?> value="1" /> Auto (random list) <br/>
					<input type="radio" name="auto_load" <?php echo !$ad['auto_load'] ? 'checked="checked"' : false; ?> value="0" /> Manual <br/>Manual insertion HTML Code <input class="readonly" type="text" readonly="readonly" id="manual" value="<?php echo $this->info['manual_insert_code_before'], $_GET['id'],$this->info['manual_insert_code_after']; ?>" size="40" />
				</td>
			</tr>	
			<tr>
				<th scope="row"><label for="html_after">Public</label></th>
				<td>
					<input type="radio" name="public" <?php echo $ad['public'] ? 'checked="checked"' : false; ?> value="1" /> Yes<br/>
					<input type="radio" name="public" <?php echo !$ad['public'] ? 'checked="checked"' : false; ?> value="0" /> No
				</td>
			</tr>
		</table>
		<p class="submit">
			<input type="submit" value="<?php echo _e('Save Changes'); ?>" />
			<a href="<?php echo $this->info['admin_url'] ?>"><input type="reset" value="<?php echo _e('Cancel'); ?>" /></a>
			<input type="hidden" value="<?php echo $_GET['act']; ?>" name="act" />
		</p>
	</form>
</div><?php } ?>