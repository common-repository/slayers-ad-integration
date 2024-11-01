<?php

// Compute current admin sub-page
$_POST['act'] = !empty($_POST['act']) ? $_POST['act'] : false;


// Do action
switch($_POST['act']){
	
	default:
		// Default action | Save main plugin options
		
		echo '<div class="updated"><p><strong>', _e('Options saved.', 'mt_trans_domain' ) ,'</strong></p></div>';
		
		// Define fileds to save ( option name => post ID )
		$data = array(
			'slayer_ad_html_before'			=> 'default_html_before',
			'slayer_ad_html_after'			=> 'default_html_after',
			'slayer_ad_css'					=> 'css',
			'slayer_ad_max_count_per_page'	=> 'max_count_per_page'
			
			);
		
		// Save data
		foreach($data as $i => $v)
			update_option($i, $this->info[$v] = isset($_POST[$v]) ? stripcslashes($_POST[$v]) : '');
			
		break;
	
	case 'edit':
		
		// Edit an ad
		
		// Find ad
		if(isset($_GET['id']) && !empty($this->ads[$_GET['id']])){
			
			// Check HTML code
			if(empty($_POST['code'])){
				echo '<div class="error"><p><strong>Error! You must fill out the code field.</strong></p></div>';
				$_GET['act'] = $_POST['act'];
				}
			else {
			
				echo '<div class="updated"><p><strong>Ad saved</strong></p></div>';
				
				// Update ad PHP variable
				$this->ads[$_GET['id']] = array(
					'name'			=> !empty($_POST['name']) ? strip_tags($_POST['name']) : 'ad ' . (count($this->ads) + 1),
					'code' 			=> stripcslashes($_POST['code']),
					'use_wrapper'	=> isset($_POST['use_wrapper']) ? $_POST['use_wrapper'] : 0,
					'max_count'		=> isset($_POST['max_count']) ? $_POST['max_count'] : 1,
					'position'		=> isset($_POST['position']) ? $_POST['position'] : 0,
					'align'			=> isset($_POST['align']) ? $_POST['align'] : 'none',
					'auto_load'		=> isset($_POST['auto_load']) ? $_POST['auto_load'] : 0,
					'public'		=> isset($_POST['public']) ? $_POST['public'] : 0,
					);
				
				// Save ads
				update_option('slayer_ad_ads', serialize($this->ads));
				
				
				}
			}
		
		break;
		
	case 'add':
		
		// Create an ad
		
		// Check HTML Code
		if(empty($_POST['code'])){
			echo '<div class="error"><p><strong>Error! You must fill out the code field.</strong></p></div>';
			$_GET['act'] = $_POST['act'];
			}
		else
			{
			echo '<div class="updated"><p><strong>Ad saved</strong></p></div>';
			
			// Generate ad PHP variable
			$this->ads[] = array(
				'name'			=> !empty($_POST['name']) ? strip_tags($_POST['name']) : 'ad ' . (count($this->ads) + 1),
				'code' 			=> stripcslashes($_POST['code']),
				'use_wrapper'	=> isset($_POST['use_wrapper']) ? $_POST['use_wrapper'] : 0,
				'max_count'		=> isset($_POST['max_count']) ? $_POST['max_count'] : 1,
				'position'		=> isset($_POST['position']) ? $_POST['position'] : 0,
				'align'			=> 'none',
				'auto_load'		=> true,
				'public'		=> true
				);
			
			// Save ads
			update_option('slayer_ad_ads', serialize($this->ads));
			
			}
		break;
	
	}


?>