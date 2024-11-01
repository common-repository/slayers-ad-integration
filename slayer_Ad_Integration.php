<?php
/*
Plugin Name: Ad Integration
Plugin URI: http://www.thaslayer.com/2008/08/10/wordpress-plugin-slayers-ad-integration-v-10/
Description: Ad Integration
Author: ThaSlayer
Version: 1.1
Author URI: http://www.thaslayer.com/
*/



	
	/*
	 * 
	 * PHP Code by mucenica.bogdan@yahoo.com | Romania 2008
	 *
	 *
	 * Create date: July 25, 2008
	 * Revesion date: August 18, 2008
	 *
	*/

class slayer_Ad_Integration{
	
	/*
	 * Cotains all ads
	 * 
	 * access public
	 * type: array -> unserialize form db (options)
	 *
	*/
	public $ads;
	
	/*
	 * Counts the number of ads curently on page
	 * 
	 * access public
	 * type: int
	 *
	*/
	public $count;
	
	/*
	 * Triggers the initialization
	 * 
	 * access public
	 * type: bool
	 *
	*/
	private $first;
	
	/*
	 * Cotains information regarding the plugin
	 * 
	 * access public
	 * type: array
	 *
	*/
	public $info;
	
	/*
	 * Cotains public ads
	 * 
	 * access public
	 * type: array
	 *
	*/	
	public $to_show;
	
	
	
	/*
	 * Object constructor
	 *
	*/
	public function __construct(){
		
		// Initialization
		$this->first = true;
		$this->count = 1;
		$this->to_show = array();
		
		// Main plugin options
		$this->info = array(
			// Admin query string
			'admin_url'					=> '?page=' . (!empty($_GET['page']) ? $_GET['page'] : false),
			
			// Ad CSS for wrappers
			'css'						=> get_option('slayer_ad_css'),
			
			// Start HTML code for wrapper
			'default_html_before'		=> get_option('slayer_ad_html_before'),
			
			// End HTML code for wrapper
			'default_html_after'		=> get_option('slayer_ad_html_after'),
			
			// Plugin directory name
			'dir'						=> array_pop(explode("/", str_replace("\\", "/", dirname(__FILE__)))),
			
			// Start of manual insert HTML code
			'manual_insert_code_after'	=> '-->',
			
			// End of manul insert HTML code
			'manual_insert_code_before'	=> '<!--slayer_ad_integration_',
			
			// The maximum number of ads to show on any given page
			'max_count_per_page'		=> get_option('slayer_ad_max_count_per_page')
			
			);
		
		$this->info['max_count_per_page'] = $this->info['max_count_per_page'] !== false ? $this->info['max_count_per_page'] : 1;
		
		
		// Compute option page link
		$this->info['url'] =  WP_PLUGIN_URL . '/' . $this->info['dir'];
		
		// Compute plugin images link
		$this->info['images'] = $this->info['url'] . '/images';
		
		// Grab options from db | Unserializa if necesary
		$this->ads = get_option('slayer_ad_ads');
		$this->ads = is_string($this->ads) ? unserialize($this->ads) : ( $this->ads ? $this->ads : array());
		
		
		// Hook to the wordpress framework
		add_filter('the_content', 	array(&$this, 'insert'));
		add_action('admin_head', 	array(&$this, 'add_admin_css'));
		add_action('wp_head', 		array(&$this, 'add_css'));
		add_action('admin_menu', 	array(&$this, 'add_admin_menu'));
		
		}
	
	
	/*
	 * Style admin panel page through CSS head inseriton
	 * 
	*/
	public function add_admin_css(){
		
		echo '<style type="text/css">
			
			.slayer_ads{list-style:none;padding:5px;margin:0px;display:block;line-height:normal;height:200px;background:#FFF;overflow:auto;border:1px solid #C6D9E9;}
			.slayer_ads li{padding:5px;border-bottom:1px solid #C6D9E9;}
			.slayer_ads span{float:right;}
			.slayer_ads h4{margin:0px;}
			.slayer_ads a,.slayer_ads a:visited{text-decoration:none;}
			.slayer_ads .grey{color:#BBB;}
			.slayer_paypal{display:block;margin:10px 0px;text-align:center;}
			.slayer_donate_wrapper{margin:10px 0px;}
			</style>';
		
		}
	
	
	/*
	 * Add new submeniu under the admin settings page
	 * 
	*/
	public function add_admin_menu() {
	    
	    add_menu_page('Slayer`s Ad Integration', 'Slayer`s Ad Integration', 8, __FILE__ , array(&$this, 'admin_page'));
    
		}

	
	/*
	 * Render admin page controllers
	 * 
	*/
	public function admin_page() {
		
		// If data was sent through POST, process it
		if(!empty($_POST))
			require(dirname(__FILE__) . '/admin_actions.php');
			
		
		// Handdel ad removal
		if(isset($_GET['delete']) && !empty($this->ads[$_GET['delete']])){
			
			unset($this->ads[$_GET['delete']]);
			
			update_option('slayer_ad_ads', $this->ads);
			
			echo '<div class="updated"><p><strong>Ad deleted!</strong></p></div>';
			
			}
		
		// Compute current admin sub page
		$_GET['act'] = !empty($_GET['act']) ? $_GET['act'] : 'main';
		
		// Find current page
		if(!file_exists( $f = dirname(__FILE__) . '/admin_template_' . $_GET['act'] . '.php' ))	{
			$_GET['act'] = 'main';
			$f = dirname(__FILE__) . '/admin_template_' . $_GET['act'] . '.php';
			}
		
		//Render current page
		require($f);
		
		

		
		}

	
	/*
	 * Style wrappers by injecting CSS in to the header
	 * 
	*/
	public function add_css() {
		
		if($this->info['css'])
			echo '<style type="text/css">' , $this->info['css'] , '</style>';
		
		}
	
	
	/*
	 * Initialize the plugin
	 * 
	*/
	public function init(){
		
		$this->first = false;
		
		// Walk all ads and compute public ads
		foreach($this->ads as $id => $ad){
			
			// Compute HTML code
			if($ad['use_wrapper'])
				$ad['code'] = $this->ads[$id]['code'] = $this->info['default_html_before'] . $ad['code'] . $this->info['default_html_after'];
			
			// Align
			if($ad['align'] != 'none')
				switch($ad['align']){
					case 'left': $ad['code'] = '<div style="float:left">' . $ad['code'] . '</div>'; break;
					case 'right': $ad['code'] = '<div style="float:right">' . $ad['code'] . '</div>'; break;
					}
			
			// Check for ad status
			if($ad['public'] && $ad['auto_load']) 
				// Compute random priority
				for( $i = 0 ; $i < $ad['max_count'] ; $i++)
					$this->to_show[] = $ad;
			
			}
		
		// If there are more posts than ads, fill out with blank ads
		$c = count($this->to_show);
		if( $c < $GLOBALS['wp_query']->post_count ){
			$c = $GLOBALS['wp_query']->post_count - $c;
			for( $i = 0 ; $i < $c ; $i++)
				$this->to_show[] = array(
					'code'			=> '',
					);
			}
		}
	
	
	/*
	 * Insert ads into posts wordpress hook
	 * 
	*/
	public function insert($content){
		
		// Initialize if necesary
		if($this->first)	$this->init();
		
		$ad = '';
		$offset = 0;
		
		// Search post content for manual ad insertion
		while( ($p = strpos($content, $this->info['manual_insert_code_before'],$offset) ) !== false){
			
			// Compute ad ID
			$end = strpos($content, $this->info['manual_insert_code_after']);
			$id = substr($content, $p + strlen($this->info['manual_insert_code_before']), $end - $p - strlen($this->info['manual_insert_code_before']));
			
			
			
			// Find ad by id and check if it is public
			if(!empty($this->ads[$id]) && $this->ads[$id]['public']){
				
				$ad = $this->ads[$id];
				
				// Replace ad manual code width ad HTML code
				$content = substr($content, 0, $p) . $ad['code'] . substr($content , $end + strlen($this->info['manual_insert_code_after']) );
				
				// Recalculate offset
				$offset = $p + strlen($ad['code']);
				
				}
			else
				// Recalculate offset
				$offset += $end + strlen($end);
			}
		
	
		// Insert random ad into posts if limit hasn't been exceded
		if(!$ad && $this->count <= $this->info['max_count_per_page']){
			
			// Get random ad ID
			$id = array_rand($this->to_show);
			
			
			// Find ad by ID
			if(!empty($this->to_show[$id])){
			
				// Get ad data
				$ad = $this->to_show[$id];
				
				// Remove current ad form random list
				unset($this->to_show[$id]);
				
				// Recalculate index order of random list
				$this->to_show = array_merge(array(), $this->to_show);
				
				// Render ad HTML, inserting it into the content
				switch($ad['position']){
						
					case 0:
						// Position top
						$content = $ad['code'] . $content ;
						break;
					
					case 1:
						// Position middle
						
						// Get content length
						$len = strlen($content);
						
						// Compute the middle
						$p = (int)($len / 2);
						
						// Define breakers
						$breakers = array(' ','.',',',"\n");
						
						// Find nearest breaker to the right of the middle
						while($p < $len && !in_array($content{$p},$breakers)) $p++;
						
						// Insert ad
						$content = substr($content, 0, $p) . $ad['code'] . substr($content, $p+1);
						
						break;
					
					default:
						// Position bottom
						$content .= $ad['code'];
						break;
					}
				
				// Increment ad count
				
				if(isset($ad['name']))
					$this->count++;
				
				}
			}
		
		
		// Return the computed content
		return $content;
		
		
		}
		
	}

new slayer_Ad_Integration;



// I'm done :)



?>