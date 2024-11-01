<div class="wrap">
	<h2>Ad Integration</h2>
	<table class="form-table">
		<tr>
			<th scope="row" style="width:200px;">Ads</th>
			<td>
				<ul class="slayer_ads"><?php
					$i = 0;
					
					if(!$this->ads)
						echo '<li>No ads</li>';
					else
						foreach($this->ads as $id => $ad){
							echo '<li class="',$ad['public'] ? false : 'grey','">';
								echo '<span>';
									echo '<a title="Edit" href="',$this->info['admin_url'],'&amp;act=edit&amp;id=',$id,'"><img src="', $this->info['images'] ,'/edit.gif" alt="Edit" /> Edit</a><br/>';
									echo '<a title="Delete" onclick="if(!confirm(\'Are you sure you want to delete this ad?\')) return false;" href="',$this->info['admin_url'],'&amp;delete=',$id,'"><img src="', $this->info['images'] ,'/delete.gif" alt="Delete" /> Delete</a>';
								echo '</span>';
								
								echo '<h4>', $ad['name'] ,'</h4>';
								echo 'Code: ', htmlentities( strlen($ad['code']) > 60 ? substr($ad['code'], 0, 60) . '...' : $ad['code'] );
								echo '<div class="clear"></div>';
							echo '</li>';
							}
					
					?></ul>
				<a style="text-decoration:none;display:block;text-align:right;margin-top:10px;" href="<?php echo $this->info['admin_url']; ?>&amp;act=add"><img style="vertical-align:middle;" src="<?php echo $this->info['images']; ?>/add.gif" alt="delete" /> Add Ad</a>
			</td>
		</tr>
	</table>
	
	
	<?php require(dirname(__FILE__) . '/donate.php'); ?>
	
		
	<form id="ak_sharethis" name="ak_sharethis" action="" method="post">
		<h2>Options</h2>
		<table class="form-table">
			<tr>
				<th scope="row" style="width:200px;"><label for="default_html_before">Default HTML Before Ad</label></th>
				<td><input type="text" id="default_html_before" name="default_html_before" value="<?php echo htmlentities($this->info['default_html_before']); ?>" size="40" /></td>
			</tr>
			<tr>
				<th scope="row"><label for="default_html_after">Default HTML After Ad</label></th>
				<td><input type="text" id="default_html_after" name="default_html_after" value="<?php echo htmlentities($this->info['default_html_after']); ?>" size="40" /></td>
			</tr>
			<tr>
				<th scope="row" style="width:200px;"><label for="css">Custom CSS</label></th>
				<td><textarea id="css" cols="100" rows="10" name="css"><?php echo $this->info['css']; ?></textarea></td>
			</tr>
			<tr>
				<th scope="row"><label for="max_count_per_page">Max ad count* per page</label></th>
				<td><select id="max_count_per_page" name="max_count_per_page"><?php
					
					$n = $this->info['max_count_per_page'];
					for( $i  = 1 ; $i <= 10 ; $i++ )
						echo '<option ',$this->info['max_count_per_page'] == $i ? 'selected="selected"' : false,' value="',$i,'">',$i,'</option>';
					
				?></select> <br/>* excluding those ads that are included manualy</td>
			</tr>
		</table>
		<p class="submit">
			<input type="submit" value="<?php echo _e('Save Changes'); ?>" />
		</p>
	</form>
</div>