<div class="wrap">
	<h2>Add ad</h2>
	<form id="ak_sharethis" name="ak_sharethis" action="<?php echo $this->info['admin_url']; ?>" method="post">
		<table class="form-table">
			<tr>
				<th scope="row" style="width:200px;"><label for="name">Ad name</label></th>
				<?php $name = 'ad ' . (count($this->ads) + 1);  ?>
				<td><input onfocus="if(this.value == '<?php echo $name; ?>' ) this.value = '';" onblur="if(this.value == '' ) this.value = '<?php echo $name; ?>';" type="text" id="name" name="name" value="<?php echo $name ?>" size="40" /></td>
			</tr>
			<tr>
				<th scope="row" style="width:200px;"><label for="code">Ad HTML Code</label></th>
				<td><textarea id="code" <?php if(!empty($_POST)) echo 'class="error"'; ?> cols="100" rows="10" name="code"></textarea></td>
			</tr>
			<tr>
				<th scope="row"><label for="use_wrapper">Use default HTML wrapper</label></th>
				<td>
					<input checked="checked" type="radio" name="use_wrapper" value="1" /> Yes  <br/>
					<input type="radio" name="use_wrapper" value="0" /> No
				</td>
			</tr>	
			<tr>
				<th scope="row"><label for="max_count">Max repeat count on same page</label></th>
				<td><select name="max_count" id="max_count"><?php
					$n = $this->info['max_count_per_page'];
						for( $i  = 1 ; $i <= 10 ; $i++ )
							echo '<option value="',$i,'">',$i,'</option>';
				?></select> eg: for google adsense you must make sure that this value is lower than 3</td>
			</tr>
			<tr>
				<th scope="row"><label for="position">Ad position</label></th>
				<td>
					<select name="position" id="position">
						<option value="0">Top (in front of the main HTML content of every post)</option>
						<option value="1">Middle (to the nearest new line breaker from the middle of every post)</option>
						<option value="2">Bottom (after every post)</option>
					</select> 
				</td>
			</tr>
		</table>
		<p class="submit">
			<input type="submit" value="<?php echo _e('Save Changes'); ?>" />
			<a href="<?php echo $this->info['admin_url'] ?>"><input type="reset" value="<?php echo _e('Cancel'); ?>" /></a>
			<input type="hidden" value="<?php echo $_GET['act']; ?>" name="act" />
		</p>
	</form>
</div>