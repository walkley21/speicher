<?php
/*
Plugin Name: Tribus Custom Widgets
Plugin URI: http://www.tribus.com/
Description: Class to load custom Tribus widgets.
Version: 1.0
Author: Jason Benesch
Author URI: http://www.jasonbenesch.com/
*/

require_once("tribus_core.php");

class TribusWidgets extends TribusCore {
	
	function __construct() {
		global $blog_id;
		
		require_once('widgets/cta_boxes.php');
                require_once('widgets/buttons.php');
                
		require_once('widgets/featured_category.php');
		require_once('widgets/featured_category_version2.php');
		
		require_once('widgets/agent_info.php');
		require_once('widgets/about_the_area.php');
		require_once('widgets/home_worth.php');
		require_once('widgets/idx_search.php');
		require_once('widgets/idx_search_v2.php');
		require_once('widgets/idx_search_horizontal.php');
		
		add_action('widgets_init', array(&$this, 'tribus_default_widgets_init'));
		
		if ( get_blog_option($blog_id, 'tribus_custom_post_type') == 'Y' ) {
			require_once('widgets/featured_listings.php');
			require_once('widgets/featured_listings_version2.php');
			
			require_once('widgets/featured_communities.php');
			require_once('widgets/featured_communities_version2.php');
			
			add_action('widgets_init', array(&$this, 'tribus_upgrade_widgets_init'));
		}
	}
	
	function tribus_default_widgets_init() {
		register_widget('Agent_Info');
		register_widget('About_The_Area');
		register_widget('Home_Worth');
		register_widget('IDX_Search');
		
		
		/*2-july-2013*/
		register_widget('IDX_SearchV2');
		/*2-july-2013*/
		
		register_widget('IDX_Search_Horizontal');
		
		register_widget('Tribus_Cta_Boxes');
                
                register_widget('Tribus_Buttons');
                
				register_widget('Tribus_Cta_Boxes_Sidebar');
				register_widget('Tribus_Cta_Boxes_Slider');
				
				
		register_widget('Tribus_Featured_Category');
		register_widget('Tribus_Featured_Category_Version2');
		
		
		
		
	}
	
	function tribus_upgrade_widgets_init() {
		register_widget('Tribus_Featured_Listings');
		register_widget('Tribus_Featured_Listings_Version2');
		
		register_widget('Tribus_Featured_Communities');
		register_widget('Tribus_Featured_Communities_Version2');
		
		/*26 apr 2013*/
		//echo "widgets registered";
		
	}
	
}
