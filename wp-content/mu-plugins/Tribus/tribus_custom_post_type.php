<?php
/*
Plugin Name: Tribus Custom Post Types Class
Plugin URI: http://www.tribus.com/
Description: Class to control the display of custom post types in each blog on the network.
Version: 1.0
Author: Jason Benesch
Author URI: http://www.jasonbenesch.com/
*/

require_once("tribus_core.php");

class TribusCustomPostType extends TribusCore {
	
	var $listing_extra_fields = array(
		'listing_address'		=> '',
		'listing_city'			=> '',
		'listing_state'			=> '',
		'listing_zip'			=> '',
		'listing_county'		=> '',
		'other_listing_info'	=> '',
		'listing_status'		=> 'Active',
		'listing_mls'			=> '',
		'listing_price'			=> '',
		'listing_sqft'			=> '',
		'listing_bedrooms'		=> '',
		'listing_bathrooms'		=> '',
		'listing_garage'		=> '',
		'listing_tour'			=> '',
		'listing_google_map' 	=> '',
		'listing_oh_date'		=> '',
		'listing_oh_time'		=> '',
		'featured_listing'		=> 0
	);
	var $community_extra_fields = array(
		'community_location'	=> '',
		'community_schools'		=> '',
		'community_parks'		=> '',
		'community_events'		=> '',
		'community_shopping'	=> '',
		'community_history'		=> '',
		'community_neighborhoods'		=> '',
		'featured_community'	=> 0,
		'community_featured_listing_name' => '',
		'community_featured_listing_value' => '',
		'community_address'		=> ''
	);

	
	var $posting_extra_fields = array(
		'posting_mls'	=> '',
            	'posting_address'	=> '',
            	'posting_price'	=> '',
            	'posting_beds'	=> '',
            	'posting_baths'	=> '',
            	'posting_garage'	=> '',
            	'posting_lote'	=> '',
            	'posting_status'	=> '',
            	'posting_county'	=> '',
            	'posting_year'	=> '',
            
            	'posting_link'		=> '',
		'posting_area'		=> '',
		'posting_search_link'		=> '',
		'posting_text'		=> '',
		'posting_similar_homes'=> '',
		'posting_more'=> '',
		
		
		
	);


	function __construct() {
		add_action('init', array(&$this, 'init_custom_post_types'), 5);
		add_action('add_meta_boxes', array(&$this, 'add_meta_boxes'));
		add_action('save_post', array(&$this, 'save_listing_meta_boxes'));
		add_action('save_post', array(&$this, 'save_community_meta_boxes'));
		add_action('save_post', array(&$this, 'save_posting_meta_boxes'));
		
		
		add_filter('post_updated_messages', array(&$this, 'listing_updated_messages'));
	}
	
	function init_custom_post_types() {
		
		/** Listing Post Type **/
		$labels = array(
			'name' => _x('Listings', 'post type general name'),
			'singular_name' => _x('Listing', 'post type singular name'),
			'add_new' => _x('Add New', 'listing'),
			'add_new_item' => __('Add A New Listing'),
			'edit_item' => __('Edit Listing'),
			'new_item' => __('New Listing'),
			'view_item' => __('View Listing'),
			'search_items' => __('Search Listings'),
			'not_found' =>  __('No listings found'),
			'not_found_in_trash' => __('No listings found in Trash'), 
			'parent_item_colon' => ''
		);
		$args = array(
			'labels' => $labels,
			'public' => true,
			'has_archive' => true,
			'publicly_queryable' => true,
			'show_ui' => true, 
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'page',
			'hierarchical' => true,
			'menu_position' => 5,
			'menu_icon' => get_bloginfo('stylesheet_directory') . '/images/icons/building.png',
			'supports' => array('title','editor','thumbnail','author'),
			'rewrite' => array( 'slug' => 'listings' )
		); 		
		register_post_type('listing', $args);
		/** Listing Post Type **/
		
		
		/** Community Post Type **/
		$labels = array(
			'name' => _x('Communities', 'post type general name'),
			'singular_name' => _x('Community', 'post type singular name'),
			'add_new' => _x('Add New', 'community'),
			'add_new_item' => __('Add A New Community'),
			'edit_item' => __('Edit Community'),
			'new_item' => __('New Community'),
			'view_item' => __('View Community'),
			'search_items' => __('Search Communities'),
			'not_found' =>  __('No communities found'),
			'not_found_in_trash' => __('No communities found in Trash'), 
			'parent_item_colon' => ''
		);
		$args = array(
			'labels' => $labels,
			'public' => true,
			'has_archive' => true,
			'publicly_queryable' => true,
			'show_ui' => true, 
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'page',
			'hierarchical' => true,
			'menu_position' => 5,
			'menu_icon' => get_bloginfo('stylesheet_directory') . '/images/icons/house.png',
			'supports' => array('title','editor','thumbnail'),
			'rewrite' => array( 'slug' => 'communities' )
		); 		
		register_post_type('community', $args);
		/** Community Post Type **/
		
		
		/*Postings */
	
		$labels = array(
			'name' => _x('Postings', 'post type general name'),
			'singular_name' => _x('Posting', 'post type singular name'),
			'add_new' => _x('Add New', 'community'),
			'add_new_item' => __('Add A New POsting'),
			'edit_item' => __('Edit Posting'),
			'new_item' => __('New Posting'),
			'view_item' => __('View Posting'),
			'search_items' => __('Search Posting'),
			'not_found' =>  __('No Posting found'),
			'not_found_in_trash' => __('No Posting found in Trash'), 
			'parent_item_colon' => ''
		);
		$args = array(
			'labels' => $labels,
			'public' => true,
			'has_archive' => true,
			'publicly_queryable' => true,
			'show_ui' => true, 
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'page',
			'hierarchical' => true,
			'menu_position' => 6,
			'menu_icon' => plugins_url( 'postings/book-16x16.png', __FILE__ ),
			'supports' => array('title','editor','thumbnail'),
			'rewrite' => array( 'slug' => 'postings' )
		); 		
		register_post_type('posting', $args);
		
		
		/*Postings*/
		
		
		
		
		/** Listing Categories **/
		$labels = array(
			'name' => _x( 'Listing Categories', 'taxonomy general name' ),
			'singular_name' => _x( 'Listing Category', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Listing Categories' ),
			'all_items' => __( 'All Listing Categories' ),
			'parent_item' => __( 'Parent Listing Category' ),
			'parent_item_colon' => __( 'Parent Listing Category:' ),
			'edit_item' => __( 'Edit Listing Category' ), 
			'update_item' => __( 'Update Listing Category' ),
			'add_new_item' => __( 'Add New Listing Category' ),
			'new_item_name' => __( 'New Listing Category Name' ),
		); 	
		register_taxonomy('listingcategory', array('listing'), array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'listingcategory' ),
		));
		/** Listing Categories **/
		
		
		/** Listing Features Taxonomy **/
		$labels = array(
			'name' => _x( 'Features', 'taxonomy general name' ),
			'singular_name' => _x( 'Feature', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Features' ),
			'all_items' => __( 'All Features' ),
			'parent_item' => __( 'Parent Feature' ),
			'parent_item_colon' => __( 'Parent Feature:' ),
			'edit_item' => __( 'Edit Feature' ), 
			'update_item' => __( 'Update Feature' ),
			'add_new_item' => __( 'Add New Feature' ),
			'new_item_name' => __( 'New Feature Name' )
		); 
		register_taxonomy('feature', array('listing'), array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'feature' ),
		));
		/** Listing Features Taxonomy **/
		
		
		/** Areas Taxonomy **/
		$labels = array(
			'name' => _x( 'Areas', 'taxonomy general name' ),
			'singular_name' => _x( 'Area', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Areas' ),
			'all_items' => __( 'All Areas' ),
			'parent_item' => __( 'Parent Area' ),
			'parent_item_colon' => __( 'Parent Area:' ),
			'edit_item' => __( 'Edit Area' ), 
			'update_item' => __( 'Update Area' ),
			'add_new_item' => __( 'Add New Area' ),
			'new_item_name' => __( 'New Area Name' ),
		);
		register_taxonomy('area', array('listing'), array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'area', 'with_front' => true ),
		));
		/** Areas Taxonomy **/
		
	}
	
	function add_meta_boxes() {
		if( function_exists( 'add_meta_box' ) ) {
			add_meta_box( 'community_info', __('Community Information'), array(&$this, 'display_community_info'), 'community', 'normal', 'high');
			add_meta_box( 'featured_community', __('Featured Community'), array(&$this, 'display_featured_community'), 'community', 'side', 'high');
			
			if ( defined("DSIDXPRESS_OPTION_NAME") ) 
				add_meta_box( 'featured_community_listings', __('Featured Listings'), array(&$this, 'display_featured_community_listings'), 'community', 'side', 'high');
			
			add_meta_box( 'featured_listing', __('Featured Listing'), array(&$this, 'display_featured_listing'), 'listing', 'side', 'high');
			add_meta_box( 'listing_address', __('Listing Address'), array(&$this, 'display_listing_address'), 'listing', 'normal', 'high');
			add_meta_box( 'listing_info', __('Listing Information'), array(&$this, 'display_listing_info'), 'listing', 'normal', 'high');
			add_meta_box( 'listing_open_house', __('Open House Information'), array(&$this, 'display_listing_open_house'), 'listing', 'normal', 'high');
			
			
			
			add_meta_box( 'posting_info', __('Posting Details'), array(&$this, 'display_posting_info'), 'posting', 'normal', 'high');
			
		}
	}
	
	function display_featured_community_listings( $post ) {
		if ( defined("DSIDXPRESS_OPTION_NAME") ) : 
			$ds_opts = get_option(DSIDXPRESS_OPTION_NAME);
?>
		<!-- display-featured-community-listings -->
		<script type="text/javascript" src="http://yui.yahooapis.com/combo?2.8.0r4/build/yuiloader-dom-event/yuiloader-dom-event.js&2.8.0r4/build/animation/animation-min.js&2.8.0r4/build/datasource/datasource-min.js&2.8.0r4/build/autocomplete/autocomplete-min.js"></script>
		<table style="width:99%">
			<tr>
				<td><label for="location-search">Feature These Listings</label></td>
			</tr>
			<tr>
				<td><input name="location-search" id="location-search" class="form-field" placeholder="Enter a city, neighborhood, or zip"  size="30" value="<?php echo get_post_meta($post->ID, 'community_featured_listing_value', true); ?>" style="width:230px;"> 
				<div id='autocomplete'></div></td>
			</tr>
		</table>
		<input type="hidden" name="community_featured_listing_name" id="community_featured_listing_name" value="<?php echo get_post_meta($post->ID, 'community_featured_listing_name', true); ?>">
		<input type="hidden" name="community_featured_listing_value" id="community_featured_listing_value" value="<?php echo get_post_meta($post->ID, 'community_featured_listing_value', true); ?>">
		
		<script type="text/javascript"> 

			YAHOO.Tribus = function() {
				this.searchType = ["nozeroprop","city","community","tract","zip","area"];
				this.locationTypeId;
				this.locationTypeName;
				this.locationType = [
					"nozeroprop",
					"city",
					"community",
					"tract",
					"zip",
					"idx-q-Areas"
				];
			};

			YAHOO.Tribus.prototype.RemoteCustomRequest = function() {
				var oDS = new YAHOO.util.ScriptNodeDataSource("http://api.idx.diversesolutions.com/API/Locations/<?php echo $ds_opts["AccountID"]; ?>/<?php echo $ds_opts["SearchSetupID"]; ?>?maxAreasToReturn=10&");
				oDS.responseSchema = { resultsList: "", fields: ["LocationName","LocationCacheTypeID","TotalCount"] };
				var oAC = new YAHOO.widget.AutoComplete("location-search","autocomplete", oDS);
				oAC.queryMatchContains = true;
				oAC.queryQuestionMark = false;
				oAC.useShadow = true;
				oAC.queryDelay = .1; 
				oAC.typeAhead = false;
				oAC.allowBrowserAutocomplete = false;
				oAC.alwaysShowContainer = false;
				oAC.resultTypeList = false;
				oAC.maxResultsDisplayed = 10;
				oAC.resultTypeList = false;				
				oAC.generateRequest = function(sQuery) { return "partialName=" + sQuery + "&format=json"; };			
				oAC.formatResult = function(oResultData, sQuery, sResultMatch) {
					return ( typeof idx.searchType[oResultData.LocationCacheTypeID] != 'undefined' ) ? sResultMatch + " (" + idx.searchType[oResultData.LocationCacheTypeID] + " - " + oResultData.TotalCount + " listings)" : sResultMatch + " (" + oResultData.TotalCount + " listings)";
				};
				oAC.setLocationCacheTypeId = function(e, args) {
					idx.locationTypeName = args[2].LocationName;
					idx.locationTypeId = args[2].LocationCacheTypeID;
					
					jQuery("#community_featured_listing_name").val(idx.locationType[idx.locationTypeId]);
					jQuery("#community_featured_listing_value").val(idx.locationTypeName);
				};
				oAC.itemSelectEvent.subscribe(oAC.setLocationCacheTypeId);		
				return { oDS: oDS, oAC: oAC };
			};

			var idx = new YAHOO.Tribus;
			idx.RemoteCustomRequest();
		</script>

<?php
		endif;
	}
	
	function display_featured_community( $post ) {
		$checked = ( get_post_meta($post->ID, 'featured_community', true) == 1 ) ? 'checked' : '';
?>
		<table style="width:99%">
			<tr>
				<td><input type="checkbox" name="featured_community" id="featured_community" value="1" <?php echo $checked; ?> /></td>
				<td><label for="featured_community">Feature This Community</label></td>
			</tr>
		</table>
<?php
	}
	
	function display_featured_listing( $post ) {
		$checked = ( get_post_meta($post->ID, 'featured_listing', true) == 1 ) ? 'checked' : '';
?>
		<table style="width:99%">
			<tr>
				<td><input type="checkbox" name="featured_listing" id="featured_listing" value="1" <?php echo $checked; ?> /></td>
				<td><label for="featured_listing">Feature This Listing</label></td>
			</tr>
		</table>
<?php	
	}
	
	function save_listing_meta_boxes( $post_id ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
		
		$post_data = array_merge($this->listing_extra_fields, $_POST);
		
		foreach( $this->listing_extra_fields as $key => $value ) {
			update_post_meta( $post_id, $key, $post_data[$key]);
		}
	}
	
	function save_community_meta_boxes( $post_id ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
		
		$post_data = array_merge($this->community_extra_fields, $_POST);
		
		foreach( $this->community_extra_fields as $key => $value ) {
			update_post_meta( $post_id, $key, $post_data[$key]);
		}
	}
	
	
	function save_posting_meta_boxes( $post_id ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
		
		$post_data = array_merge($this->posting_extra_fields, $_POST);
		
		foreach( $this->posting_extra_fields as $key => $value ) {
			update_post_meta( $post_id, $key, $post_data[$key]);
		}
	}
	
	function display_community_info( $post ) {
		//wp_nonce_field( plugin_basename( __FILE__ ), 'add_community_nonce' );
?>
		<table style="width:99%">
			<tr>
				<td width="100" align="right" style="padding-right:5px;"><label>Community Address</label></td>
				<td><input type="text" name="community_address" id="community_address" value="<?php echo get_post_meta($post->ID, 'community_address', true); ?>" style="width:100%" /></td>
			</tr>
			<tr>
				<td width="100" align="right" style="padding-right:5px;"><label>Description of Location</label></td>
				<td><textarea name="community_location" id="community_location" style="width:100%;height:180px;"><?php echo get_post_meta($post->ID, 'community_location', true); ?></textarea></td>
			</tr>
			
			<tr>
				<td align="right" style="padding-right:5px;"><label>Description of Local Schools</label></td>
				<td><textarea name="community_schools" id="community_schools" style="width:100%;height:180px;"><?php echo get_post_meta($post->ID, 'community_schools', true); ?></textarea></td>
			</tr>
			
			<tr>
				<td align="right" style="padding-right:5px;"><label>Description of Local Parks</label></td>
				<td><textarea name="community_parks" id="community_parks" style="width:100%;height:180px;"><?php echo get_post_meta($post->ID, 'community_parks', true); ?></textarea></td>
			</tr>
			
			<tr>
				<td align="right" style="padding-right:5px;"><label>Local Events</label></td>
				<td><textarea name="community_events" id="community_events" style="width:100%;height:180px;"><?php echo get_post_meta($post->ID, 'community_events', true); ?></textarea></td>
			</tr>
			
			<tr>
				<td align="right" style="padding-right:5px;"><label>Attractions and Shopping</label></td>
				<td><textarea name="community_shopping" id="community_shopping" style="width:100%;height:180px;"><?php echo get_post_meta($post->ID, 'community_shopping', true); ?></textarea></td>
			</tr>
			
			<tr>
				<td align="right" style="padding-right:5px;"><label>Area History and Information</label></td>
				<td><textarea name="community_history" id="community_history" style="width:100%;height:180px;"><?php echo get_post_meta($post->ID, 'community_history', true); ?></textarea></td>
			</tr>
				<td align="right" style="padding-right:5px;"><label>Communities</label></td>
				<td><textarea name="community_neighborhoods" id="community_neighborhoods" style="width:100%;height:180px;"><?php echo get_post_meta($post->ID, 'community_neighborhoods', true); ?></textarea></td>
			</tr>
		</table>

<?php
	}
	
	
	function display_posting_info( $post ) {
		//wp_nonce_field( plugin_basename( __FILE__ ), 'add_community_nonce' );
?>
                <script>
                    
                    (function($) {
                            
                            $("#post").submit(function (){
                                
                                var mls = ($("#posting_mls").val());
                                var add = ($("#posting_address").val());
                                
                                if (mls=='' && add =='')
                                {
                                    alert("Please provide a MLS number or address");
                                    return false;
                                }
                                
                               
                                
                            });
                    //plugin code
                    })(jQuery);

                    
                </script>
                
		<table style="width:99%">
			<tr>
				<td width="100" align="right" style="padding-right:5px;"><label>Enter an MLS listing</label></td>
				<td><input type="text" name="posting_mls" id="posting_mls" 
                		   value="<?php echo get_post_meta($post->ID, 'posting_mls', true); ?>" style="width:100%" /></td>
			</tr>
                        <tr>
				<td width="260" align="right" style="padding-right:5px;">
                                    <label>Enter Address(if no mls was provided)</label>
                                </td>
				<td>
                                  <input type="text" name="posting_address" id="posting_address" style="width:100%;" 
                			value="<?php echo get_post_meta($post->ID, 'posting_address', true); ?>" />
                                </td>
			</tr>
                         <tr>
				<td width="260" align="right" style="padding-right:5px;">
                                    <label>Enter Price(if no MLS was provided)</label>
                                </td>
				<td>
                                  <input type="text" name="posting_price" id="posting_price" style="width:100%;" 
                			value="<?php echo get_post_meta($post->ID, 'posting_price', true); ?>" />
                                </td>
			</tr>
                          <tr>
				<td width="260" align="right" style="padding-right:5px;">
                                    <label>Enter # of Beds(if no MLS was provided)</label>
                                </td>
				<td>
                                  <input type="text" name="posting_beds" id="posting_beds" style="width:100%;" 
                			value="<?php echo get_post_meta($post->ID, 'posting_beds', true); ?>" />
                                </td>
			</tr>
                         <tr>
				<td width="260" align="right" style="padding-right:5px;">
                                    <label>Enter # of Baths(if no MLS was provided)</label>
                                </td>
				<td>
                                  <input type="text" name="posting_baths" id="posting_baths" style="width:100%;" 
                			value="<?php echo get_post_meta($post->ID, 'posting_baths', true); ?>" />
                                </td>
			</tr>
                        
                         <tr>
				<td width="260" align="right" style="padding-right:5px;">
                                    <label>Enter # of Garage(if no MLS was provided)</label>
                                </td>
				<td>
                                  <input type="text" name="posting_garage" id="posting_garage" style="width:100%;" 
                			value="<?php echo get_post_meta($post->ID, 'posting_garage', true); ?>" />
                                </td>
			</tr>
                        
                        
                         <tr>
				<td width="260" align="right" style="padding-right:5px;">
                                    <label>Enter Lot Size(if no MLS was provided)</label>
                                </td>
				<td>
                                  <input type="text" name="posting_lote" id="posting_lote" style="width:100%;" 
                			value="<?php echo get_post_meta($post->ID, 'posting_lote', true); ?>" />
                                </td>
			</tr>
                       
                         <tr>
				<td width="260" align="right" style="padding-right:5px;">
                                    <label>Enter Status e.g. Active,Inactive,etc(if no MLS was provided)</label>
                                </td>
				<td>
                                  <input type="text" name="posting_status" id="posting_status" style="width:100%;" 
                			value="<?php echo get_post_meta($post->ID, 'posting_status', true); ?>" />
                                </td>
			</tr>
                        
                         <tr>
				<td width="260" align="right" style="padding-right:5px;">
                                    <label>Enter County(if no MLS was provided)</label>
                                </td>
				<td>
                                  <input type="text" name="posting_county" id="posting_county" style="width:100%;" 
                			value="<?php echo get_post_meta($post->ID, 'posting_county', true); ?>" />
                                </td>
			</tr>
                         <tr>
				<td width="260" align="right" style="padding-right:5px;">
                                    <label>Enter Year Built(if no MLS was provided)</label>
                                </td>
				<td>
                                  <input type="text" name="posting_year" id="posting_year" style="width:100%;" 
                			value="<?php echo get_post_meta($post->ID, 'posting_year', true); ?>" />
                                </td>
			</tr>
			<tr>
				<td width="100" align="right" style="padding-right:5px;"><label>Enter Featured Area Name</label></td>
				<td><input type="text" name="posting_area" id="posting_area" style="width:100%;" 
                			value="<?php echo get_post_meta($post->ID, 'posting_area', true); ?>" /></td>
			</tr>
			
			<tr>
				<td align="right" style="padding-right:5px;"><label>Enter A Featured Area Search Link</label></td>
				<td><input type="text" name="posting_search_link" id="posting_search_link" style="width:100%;"
                
                		 value="<?php echo get_post_meta($post->ID, 'posting_search_link', true); ?>" /></td>
			</tr>
			
			<tr>
				<td align="right" style="padding-right:5px;"><label>Enter Feature Listing Text</label></td>
				<td><input type="text" name="posting_text" id="posting_text" style="width:100%;" 
                			value="<?php echo get_post_meta($post->ID, 'posting_text', true); ?>" /></td>
			</tr>
			
			<tr>
				<td align="right" style="padding-right:5px;"><label>Enter A Featured Link</label></td>
				<td><input type="text" name="posting_link" id="posting_link" style="width:100%;" 
                			value="<?php echo get_post_meta($post->ID, 'posting_link', true); ?>" /></td>
			</tr>
			<tr>
				<td align="right" style="padding-right:5px;"><label>Similar Homes Link</label></td>
				<td><input type="text" name="posting_similar_homes" id="posting_similar_homes" style="width:100%;" 
                			value="<?php echo get_post_meta($post->ID, 'posting_similar_homes', true); ?>" /></td>
			</tr>
			<tr>
				<td align="right" style="padding-right:5px;"><label>More Info Link</label></td>
				<td><input type="text" name="posting_more" id="posting_more" style="width:100%;" 
                			value="<?php echo get_post_meta($post->ID, 'posting_more', true); ?>" /></td>
			</tr>
			
		</table>

<?php
	}	
	
		
	function display_listing_info( $post ) {
?>

		<script type="text/javascript">
			<!--
		  	function isNumberKey(evt) {
				var charCode = (evt.which) ? evt.which : event.keyCode
			 	if (charCode > 31 && (charCode < 48 || charCode > 57)) return false;
			 	return true;
		  	}
		  	//-->
	   	</script>
		
		<table style="width:99%">
			<tr>
				<td align="right" style="padding-right:5px;" valign="top"><label>Other Info</label></td>
				<td><textarea name="other_listing_info" style="width:100%;height:180px;"><?php echo get_post_meta($post->ID, 'other_listing_info', true); ?></textarea>
			</tr>
			
			<tr>
				<td width="100" align="right" style="padding-right:5px;"><label>Status</label></td>
				<td><select name="listing_status">
					<?php 
					$options = array('Active', 'In Escrow', 'Under Contract', 'Sold', 'For Lease', 'Leased', 'Coming Soon');
					foreach($options as $option) {
						echo '<option label="' . $option . '" value="' . $option . '"';
						if (get_post_meta($post->ID, 'listing_status', true) == $option) echo ' selected="selected"';
						echo '>' . $option . '</option>';
					} ?>
				</select></td>				
			</tr>
			
			<tr>
				<td width="100" align="right" style="padding-right:5px;"><label>MLS#</label></td>
				<td><input type="text" name="listing_mls" id="listing_mls" value="<?php echo get_post_meta($post->ID, 'listing_mls', true); ?>" style="width:100%" /></td>
			</tr>
			
			<tr>
				<td align="right" style="padding-right:5px;"><label>Price</label></td>
				<td><input type="text" name="listing_price" id="listing_price" value="<?php echo get_post_meta($post->ID, 'listing_price', true); ?>" style="width:100%" onkeypress="return isNumberKey(event)" /></td>
			</tr>
			
			<tr>
				<td align="right" style="padding-right:5px;"><label>Square Feet</label></td>
				<td><input type="text" name="listing_sqft" id="listing_sqft" value="<?php echo get_post_meta($post->ID, 'listing_sqft', true); ?>" style="width:100px;" /></td>
			</tr>
			
			<tr>
				<td align="right" style="padding-right:5px;"><label>Bedrooms</label></td>
				<td><input type="text" name="listing_bedrooms" id="listing_bedrooms" value="<?php echo get_post_meta($post->ID, 'listing_bedrooms', true); ?>" style="width:100px;" /></td>
			</tr>
			
			<tr>
				<td align="right" style="padding-right:5px;"><label>Bathrooms</label></td>
				<td><input type="text" name="listing_bathrooms" id="listing_bathrooms" value="<?php echo get_post_meta($post->ID, 'listing_bathrooms', true); ?>" style="width:100px;" /></td>
			</tr>
			
			<tr>
				<td align="right" style="padding-right:5px;"><label>Garage</label></td>
				<td><input type="text" name="listing_garage" id="listing_garage" value="<?php echo get_post_meta($post->ID, 'listing_garage', true); ?>" style="width:100px;" /></td>
			</tr>

			<tr>
				<td align="right" style="padding-right:5px;"><label>Virtual Tour</label></td>
				<td><input type="text" name="listing_tour" id="listing_tour" value="<?php echo get_post_meta($post->ID, 'listing_tour', true); ?>" style="width:100%;" /></td>
			</tr>
			
			<tr>
				<td align="right" style="padding-right:5px;" valign="top"><label>Google Map Code</label></td>
				<td><textarea name="listing_google_map" style="width:100%;height:180px;"><?php echo get_post_meta($post->ID, 'listing_google_map', true); ?></textarea>
			</tr>
		</table>
		
<?php
	}
	
	function display_listing_open_house( $post ) {
?>
		<table style="width:99%">
			<tr>
				<td width="100" align="right" style="padding-right:5px;"><label>Date</label></td>
				<td><input type="text" name="listing_oh_date" id="listing_oh_date" value="<?php echo get_post_meta($post->ID, 'listing_oh_date', true); ?>" style="width:100%" /></td>
			</tr>
			
			<tr>
				<td align="right" style="padding-right:5px;"><label>Time Range</label></td>
				<td><input type="text" name="listing_oh_time" id="listing_oh_time" value="<?php echo get_post_meta($post->ID, 'listing_oh_time', true); ?>" style="width:100%" /></td>
			</tr>
		</table>
<?php
	}
	
	function display_listing_address( $post ) {
		//wp_nonce_field( plugin_basename( __FILE__ ), 'add_listing_nonce' );
?>		
		<table style="width:99%">
			<tr>
				<td width="100" align="right" style="padding-right:5px;"><label>Street Address</label></td>
				<td><input type="text" name="listing_address" id="listing_address" value="<?php echo get_post_meta($post->ID, 'listing_address', true); ?>" style="width:100%" /></td>
			</tr>
			
			<tr>
				<td align="right" style="padding-right:5px;"><label>City</label></td>
				<td><input type="text" name="listing_city" id="listing_city" value="<?php echo get_post_meta($post->ID, 'listing_city', true); ?>" style="width:100%" /></td>
			</tr>
			
			<tr>
				<td align="right" style="padding-right:5px;"><label>State</label></td>
				<td><input type="text" name="listing_state" id="listing_state" value="<?php echo get_post_meta($post->ID, 'listing_state', true); ?>" style="width:100%" /></td>
			</tr>
			
			<tr>
				<td align="right" style="padding-right:5px;"><label>Zip Code</label></td>
				<td><input type="text" name="listing_zip" id="listing_zip" value="<?php echo get_post_meta($post->ID, 'listing_zip', true); ?>" style="width:100%" /></td>
			</tr>
			
			<tr>
				<td align="right" style="padding-right:5px;"><label>County</label></td>
				<td><input type="text" name="listing_county" id="listing_county" value="<?php echo get_post_meta($post->ID, 'listing_county', true); ?>" style="width:100%" /></td>
			</tr>
		</table>		
<?php
	}
		
	function listing_updated_messages( $messages ) {
		global $post_ID, $post;
		$messages['listing'] = array(
			0 => '', // Unused. Messages start at index 1.
			1 => sprintf( __('Listing updated. <a href="%s">View listing</a>'), esc_url( get_permalink($post_ID) ) ),
			2 => __('Custom field updated.'),
			3 => __('Custom field deleted.'),
			4 => __('Listing updated.'),
			/* translators: %s: date and time of the revision */
			5 => isset($_GET['revision']) ? sprintf( __('Listing restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6 => sprintf( __('Listing published. <a href="%s">View listing</a>'), esc_url( get_permalink($post_ID) ) ),
			7 => __('Listing saved.'),
			8 => sprintf( __('Listing submitted. <a target="_blank" href="%s">Preview listing</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
			9 => sprintf( __('Listing scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview listing</a>'),
			// translators: Publish box date format, see http://php.net/date
			date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
			10 => sprintf( __('Listing draft updated. <a target="_blank" href="%s">Preview listing</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		);
		$messages['community'] = array(
			0 => '', // Unused. Messages start at index 1.
			1 => sprintf( __('Community updated. <a href="%s">View Community</a>'), esc_url( get_permalink($post_ID) ) ),
			2 => __('Custom field updated.'),
			3 => __('Custom field deleted.'),
			4 => __('Community updated.'),
			5 => isset($_GET['revision']) ? sprintf( __('Community restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6 => sprintf( __('Community published. <a href="%s">View Community</a>'), esc_url( get_permalink($post_ID) ) ),
			7 => __('Community saved.'),
			8 => sprintf( __('Community submitted. <a target="_blank" href="%s">Preview Community</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
			9 => sprintf( __('Community scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Community</a>'),
			date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
			10 => sprintf( __('Community draft updated. <a target="_blank" href="%s">Preview Community</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		);
		
		return $messages;
	}
	
}

