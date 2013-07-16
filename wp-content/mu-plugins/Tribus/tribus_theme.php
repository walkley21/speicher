<?php
/*
Plugin Name: Tribus Default Theme Class
Plugin URI: http://www.tribus.com/
Description: Class to load custom Tribus theme as default.
Version: 1.0
Author: Jason Benesch
Author URI: http://www.jasonbenesch.com/
*/

require_once("tribus_core.php");

class TribusTheme extends TribusCore {

	var $google_fonts = array( 'Contrail One', 'Jockey One', 'Nosifer Caps', 'Creepster Caps', 'Eater Caps', 'Atomic Age', 'Quicksand', 'Linden Hill', 'Rancho', 'Sancreek', 'Amatic SC', 'Chivo', 'Astloch', 'Salsa', 'Federant', 'Gochi Hand', 'Satisfy', 'Ubuntu Mono', 'Jura', 'Poly', 'Alice', 'Ubuntu Condensed', 'Nothing You Could Do', 'Marck Script', 'Terminal Dosis', 'Coda', 'Marvel', 'Geostar', 'Sigmar One', 'Sansita One', 'Stardos Stencil', 'Love Ya Like A Sister', 'Poller One', 'Leckerli One', 'Sorts Mill Goudy', 'Gentium Book Basic', 'Changa One', 'Alike', 'Zeyada', 'Prata', 'Paytone One', 'The Girl Next Door', 'Corben', 'Alike Angular', 'Andika', 'Coustard', 'Shadows Into Light', 'Actor', 'Aclonica', 'Open Sans', 'Comfortaa', 'Syncopate', 'Bigshot One', 'Coda Caption', 'Julee', 'Podkova', 'Rochester', 'Andada', 'Allerta', 'Voltaire', 'Maiden Orange', 'Bowlby One SC', 'Shanti', 'Open Sans Condensed', 'Unna', 'Francois One', 'Ultra', 'Muli', 'Nixie One', 'Questrial', 'Radley', 'IM Fell DW Pica SC', 'Nova Oval', 'Spinnaker', 'Vast Shadow', 'Patrick Hand', 'Abril Fatface', 'Yeseva One', 'Indie Flower', 'Nova Slim', 'Cabin', 'Delius', 'Philosopher', 'Quattrocento', 'Pompiere', 'Puritan', 'Allerta Stencil', 'PT Serif', 'Buda', 'Nova Cut', 'Varela', 'Rosario', 'Goblin One', 'Chewy', 'Arimo', 'PT Serif Caption', 'Irish Grover', 'Lora', 'Gentium Basic', 'Amaranth', 'Short Stack', 'Damion', 'Allan', 'Expletus Sans', 'PT Sans Caption', 'Caudex', 'Bevan', 'Federo', 'IM Fell French Canon SC', 'Merienda One', 'Varela Round', 'EB Garamond', 'Vidaloka', 'Montez', 'IM Fell Great Primer', 'IM Fell DW Pica', 'Kreon', 'Tinos', 'Oswald', 'Josefin Slab', 'Lato', 'Raleway', 'Hammersmith One', 'PT Sans Narrow', 'Delius Unicase', 'Rationale', 'Droid Sans Mono', 'Brawler', 'Droid Serif', 'Dancing Script',  'Unkempt', 'Nobile', 'Redressed', 'Numans', 'Kameron', 'Cousine', 'Ubuntu', 'Molengo', 'Mountains of Christmas', 'Merriweather', 'Josefin Sans', 'Istok Web', 'Luckiest Guy', 'Maven Pro', 'Bangers', 'Arvo', 'Tangerine', 'Cantarell' );

	function __construct() {
		add_action('wpmu_new_blog', array(&$this, 'add_custom_theme'), 30, 6);
		add_action( 'admin_init', array(&$this, 'tribus_register_settings'));
		add_action( 'admin_menu', array(&$this, 'tribus_admin_menu'));
		$this->setup_header_image();
		$cur_theme_path = get_bloginfo('template_directory');
		
		//echo "<h1>$cur_theme_path</h1>";
		$theme = 'TRIpressv2';
		if (strpos($cur_theme_path, $theme)===false)
		{
			// this is tripres version 1
			if ( !is_admin()   ) {
            wp_enqueue_style('prettyphoto', $cur_theme_path . '/resources/prettyPhoto/css/prettyPhoto.css');
          //  wp_enqueue_style('bootsrap-css', $cur_theme_path . '/resources/bootstrap/css/bootstrap.css');
          //  wp_enqueue_style('bootsrap-css-res', $cur_theme_path . '/resources/bootstrap/css/bootstrap-responsive.css');
          
		  
		    wp_enqueue_script( 'prettyphoto', $cur_theme_path . '/resources/prettyPhoto/js/jquery.prettyPhoto.js', array('jquery'), '3.0.1');
          
		  
		    // this has tto be included in functions.php otherwise create conflict
            }
        	add_action('wp_footer', array(&$this, 'default_js'));
		}
		else
		{
			//Tripress Version2, no need for prettyPhoto//echo  "<h1> FOUND</h1>";	
		}
		
       
		
		
		
	}
	

	
	
	
	
	function default_js() {
?>
	
	<script type="text/javascript">
	
		///alert("1111");
	
		(function($){
			
			$("a.prettyPhotoFull").prettyPhoto({theme: 'light_rounded'});
			$("a.prettyPhotoEmpty").prettyPhoto({theme: 'light_rounded', allow_resize: false });
			$("a.prettyPhoto").prettyPhoto({theme: 'light_rounded'});
			
		})(jQuery);
	
		
	</script>
	
<?php
	}
	
	function custom_title() {
		$name = get_bloginfo('name');
		//$name = 'Downtown San Diego Real Estate Information And Services';
		$count = strlen($name);
		$size_lookup = array(
			'20' => '40',
			'25' => '35',
			'30' => '30',
			'35' => '28',
			'40' => '24',
			'45' => '22',
			'50' => '20'
		);
		$url = get_bloginfo('url');
		$slogan = get_bloginfo('description');
		
		$font_size = '44';
		foreach ( $size_lookup as $len => $val ) {
			if ( $count > $len ) $font_size = $val;
		}
		
		$line_height = array(
			'44' => '56',
			'40' => '54',
			'35' => '51',
			'30' => '51',
			'28' => '50',
			'24' => '50',
			'22' => '50',
			'20' => '50'
		);
		
		//$title = '<h1  id="site-Name"  style="font-family:\'' . get_option('tribusThemeNameFont') . '\';"><a href="' . $url . '">' . $name . '</a></h1>';
		//$title .= '<h6 id="siteSlogan" style="font-family:\'' . get_option("tribusThemeDescriptionFont") . '\';">' . $slogan . '</h6>';
		
        $title = '<h1 id="site-Name" style="font-size:' . $font_size . 'px;line-height:' . $line_height[$font_size] . 'px;font-family:\'' . get_option('tribusThemeNameFont') . '\';"><a href="' . $url . '">' . $name . '</a></h1>';
		$title .= '<h6 id="siteSlogan" style="font-family:\'' . get_option("tribusThemeDescriptionFont") . '\';">' . $slogan . '</h6>';
		

		return $title;
	}
	
	function setup_header_image() {
		global $wp_version;
		
		define( 'HEADER_TEXTCOLOR', '' );
		define( 'HEADER_IMAGE', '%s/images/headers/photo.jpg' );
		define( 'HEADER_IMAGE_WIDTH', 666 );
		//define( 'HEADER_IMAGE_WIDTH', 992 );
		
		if ( get_option("tribusThemeSiteTitleText") == 1 ) {
			define( 'HEADER_IMAGE_HEIGHT', 207 );
		}
		else {
			define( 'HEADER_IMAGE_HEIGHT', 294 );
		}
				
		define( 'NO_HEADER_TEXT', true );
		
		
		if ( version_compare( $wp_version, '3.4', '>=' ) ) {
			add_theme_support( 'custom-header' );
		} else {
			add_custom_image_header( array(&$this,'header_callback'), array(&$this,'header_callback') );
		}
		
		register_default_headers( array(
			'custom' => array(
				'url' => '%s/images/headers/photo.jpg',
				'thumbnail_url' => '%s/images/headers/photo-thumbnail.jpg',
				'description' => 'Beach side condos.'
			)
		) );
	}
	
	function header_callback() { 
	
	}
	
	function tribus_admin_menu() {
		add_menu_page(
			'Tribus Theme Settings', 
			'Tribus Theme', 
			'edit_theme_options', 
			'tribus_theme_options', 
			array(&$this, 'tribus_theme_settings'), 
			get_bloginfo('stylesheet_directory') . '/images/tribus_small.png', 
			62 
		);
	}
	
	function tribus_register_settings() {
		register_setting( 'tribusThemeSettings', 'tribusThemeColor' );
		register_setting( 'tribusThemeSettings', 'tribusThemeSiteTitleText' );
		register_setting( 'tribusThemeSettings', 'tribusThemeNameFont' );
		register_setting( 'tribusThemeSettings', 'tribusThemeDescriptionFont' );
		register_setting( 'tribusThemeSettings', 'tribusHomeCode' );
		register_setting( 'tribusThemeSettings', 'tribusCondoCode' );
		register_setting( 'tribusThemeSettings', 'tribusThemeCustomRSSLink' );
		register_setting( 'tribusThemeSettings', 'tribusThemeFlickrLink' );
		register_setting( 'tribusThemeSettings', 'tribusThemeYouTubeLink' );
		register_setting( 'tribusThemeSettings', 'tribusThemeLinkedInLink' );
		register_setting( 'tribusThemeSettings', 'tribusThemeTwitterLink' );
		register_setting( 'tribusThemeSettings', 'tribusThemeGooglePlusLink' );
		register_setting( 'tribusThemeSettings', 'tribusThemeFacebookLink' );
		register_setting( 'tribusThemeSettings', 'tribusThemePhoneNumber' );
		register_setting( 'tribusThemeSettings', 'tribusBusinessName' );
		register_setting( 'tribusThemeSettings', 'tribusBusinessLicenseNumber' );
		register_setting( 'tribusThemeSettings', 'tribusThemeMeembo' );	
		register_setting( 'tribusThemeSettings', 'tribusMarketStats' );	
		register_setting( 'tribusThemeSettings', 'tribusFacebookApp' );
		register_setting( 'tribusThemeSettings', 'tribusFacebookAppID' );
		register_setting( 'tribusThemeSettings', 'tribusFacebookNamespace' );
		register_setting( 'tribusThemeSettings', 'tribusFacebookPhotoID' );
    #
    register_setting( 'tribusThemeSettings', 'tribusDefaultArea' );
    register_setting( 'tribusThemeSettings', 'tribusDefaultAreaName' );
    register_setting( 'tribusThemeSettings', 'tribusDefaultAreaValue' );
    register_setting( 'tribusThemeSettings', 'tribusHideSearchForm' );
	   register_setting( 'tribusThemeSettings', 'tribusLogo',array(&$this,'validateSetting') );
	   register_setting( 'tribusThemeSettings', 'tribusLogoPath');
	    register_setting( 'tribusThemeSettings', 'tribusThemeFeedId');
	   register_setting( 'tribusThemeSettings', 'tribusThemeBitly');
	     register_setting( 'tribusThemeSettings', 'tribusThemeBitlyApi');
	 
	  
	}
	
	
	
	function validateSetting($options)
	{
				
		if (!empty($_FILES['tribusLogo']['size']))
		{
			$image = $_FILES['tribusLogo'];
			
			$override = array('test_form' => false); 
			$file = wp_handle_upload( $image, $override );    
			$_POST['tribusLogoPath']= $file['url'];
		
		}
		else
		{
			//no new? then keep the same;
			$_POST['tribusLogoPath']=get_option('tribusLogoPath');
		}
		
		
	}
	
	function add_custom_theme($blog_id, $user_id, $domain, $path, $site_id, $meta ) {
        $cur_theme = get_template();
        
		if ( file_exists(ABSPATH . "wp-content/themes/".$cur_theme."/index.php") ) {
			update_blog_option($blog_id, 'template', $cur_theme);
			update_blog_option($blog_id, 'stylesheet', $cur_theme);
			update_blog_option($blog_id, 'tribusThemeColor', 'blue');
		}
	}
	
	
	function tribus_theme_settings() {
?>
		<div class="wrap">
			<div id="icon-options-general" class="icon32"><br /></div>
			<h2>Tribus Theme Settings</h2>

			<form method="post" action="options.php" enctype="multipart/form-data">
				<?php settings_fields( 'tribusThemeSettings' ); ?>
				<table class="form-table">
					
					
					<tr valign="top"> 
						<th scope="row">Theme Color</th> 
						<td>
							<select name="tribusThemeColor" id="tribusThemeColor">
								<option value="blue" <?php if ( get_option('tribusThemeColor') == "blue" ) echo 'selected'; ?>>Blue</option> 
								<option value="red" <?php if ( get_option('tribusThemeColor') == "red" ) echo 'selected'; ?>>Red</option> 
								<option value="gray" <?php if ( get_option('tribusThemeColor') == "gray" ) echo 'selected'; ?>>Gray</option>
								<option value="green" <?php if ( get_option('tribusThemeColor') == "green" ) echo 'selected'; ?>>Green</option>  
								<option value="navy blue" <?php if ( get_option('tribusThemeColor') == "navy blue" ) echo 'selected'; ?>>Navy Blue</option>
								<option value="carr" <?php if ( get_option('tribusThemeColor') == "carr" ) echo 'selected'; ?>>Minimalique</option>
								<option value="olive" <?php if ( get_option('tribusThemeColor') == "olive" ) echo 'selected'; ?>>Olive</option>  
								<option value="gold" <?php if ( get_option('tribusThemeColor') == "gold" ) echo 'selected'; ?>>Black & Gold</option>  
						
							</select>
						</td> 
					</tr>
					
					<tr valign="top">
	    				<th scope="row">Display Site Title Text?</th>
	    				<td><input type="checkbox" name="tribusThemeSiteTitleText" id="tribusThemeSiteTitleText" value="1" <?php echo ( get_option('tribusThemeSiteTitleText') == 1 ) ? "CHECKED" : ""; ?>></td>
					</tr>
									
					<tr valign="top"> 
						<th scope="row">Site Name Font Family</th> 
						<td>
							<select name="tribusThemeNameFont" id="tribusThemeNameFont">
								<?php foreach ( $this->google_fonts as $font ) { ?>
								<option value="<?php echo $font; ?>" <?php if ( get_option('tribusThemeNameFont') == $font ) echo 'selected'; ?>><?php echo $font; ?></option> 
							 	<?php } ?>
							</select>
							<span style="margin-left:20px;font-size:22px;font-family:'<?php echo get_option('tribusThemeNameFont'); ?>';" id="nameFont"><?php bloginfo('name'); ?></span>
						</td> 
					</tr>
                    
                    
                
					
					<tr valign="top"> 
						<th scope="row">Site Description Font Family</th> 
						<td>
							<select name="tribusThemeDescriptionFont" id="tribusThemeDescriptionFont">
								<?php foreach ( $this->google_fonts as $font ) { ?>
								<option value="<?php echo $font; ?>" <?php if ( get_option('tribusThemeDescriptionFont') == $font ) echo 'selected'; ?>><?php echo $font; ?></option> 
							 	<?php } ?>
							</select>
							<span style="margin-left:20px;font-size:20px;font-family:'<?php echo get_option('tribusThemeDescriptionFont'); ?>';" id="descFont"><?php bloginfo('description'); ?></span>
						</td> 
					</tr>
					<link href='http://fonts.googleapis.com/css?family=<?php echo urlencode(get_option('tribusThemeNameFont')); ?>' id="nameFontCss" rel='stylesheet' type='text/css'>
					<link href='http://fonts.googleapis.com/css?family=<?php echo urlencode(get_option('tribusThemeDescriptionFont')); ?>' id="descFontCss" rel='stylesheet' type='text/css'>
					<script type="text/javascript">
						jQuery(function($){
							var base_url = "http://fonts.googleapis.com/css?family=";
							$("#tribusThemeNameFont").change(function(){
								$("#nameFontCss").attr("href", base_url + escape($(this).val()));
								$("#nameFont").css("font-family", $(this).val());
							});
							
							$("#tribusThemeDescriptionFont").change(function(){
								$("#descFontCss").attr("href", base_url + escape($(this).val()));
								$("#descFont").css("font-family", $(this).val());
							});
						});
					</script>
					
                    
                    <tr valign="top">
                        <th scope="row">Upload Logo</th>
                        <td>
                        <input type="file" name="tribusLogo" id="tribusLogo" style="float:left;" />
                        <?php $image_path=get_option('tribusLogoPath'); ?>
                        <input name="tribusLogoPath" id="tribusLogoPath" type="hidden" value="<?php echo $image_path ?>" />
                        <?php if (!empty($image_path) ):?>
                        <img  src="<?php echo $image_path?>" />
                        <?php endif; ?>
                        <span style="display:block;font-size:10px" >Please upload a 200px X 200px, background-transparent png file. </span>
                        
                        
                        
                        </td>
                    </tr>
                    
                    
					<tr valign="top">
	    				<th scope="row">Contact Phone Number</th>
	    				<td><input type="text" name="tribusThemePhoneNumber" id="tribusThemePhoneNumber" value="<?php echo get_option('tribusThemePhoneNumber'); ?>" /></td>
	    			</tr>
	
					<?php if ( defined('MARKET_STATS') && MARKET_STATS ) { ?>
					<tr valign="top">
		    			<th scope="row">Market Stats API Key (PAI)</th>
		    			<td>
							<input type="text" name="tribusMarketStats" id="tribusMarketStats" value="<?php echo get_option('tribusMarketStats'); ?>" />
							<span class="description">You can view your market stats here: <a target="_blank" href="<?php bloginfo('url'); ?>/market-stats"><?php bloginfo('url'); ?>/market-stats</a></span>
						</td>
		    		</tr>
					<?php } ?>
	
					<?php if ( defined('INSTANT_COMMUNICATION') && INSTANT_COMMUNICATION ) { ?>
					<tr valign="top">
		    			<th scope="row">Meembo URL</th>
		    			<td>
							<input type="text" name="tribusThemeMeembo" id="tribusThemeMeembo" value="<?php echo get_option('tribusThemeMeembo'); ?>" />
							<span class="description">It should look something like this: http://widget.meebo.com/mm.swf?aBCDEFGHTAS</span>
						</td>
		    		</tr>
					<?php } ?>

          <tr valign="top">
              <th scope="row">Default Area</th>
              <td>
                <script type="text/javascript" src="http://yui.yahooapis.com/combo?2.8.0r4/build/yuiloader-dom-event/yuiloader-dom-event.js&2.8.0r4/build/animation/animation-min.js&2.8.0r4/build/datasource/datasource-min.js&2.8.0r4/build/autocomplete/autocomplete-min.js"></script>
                <input type="text" name="tribusDefaultArea" id="tribusDefaultArea" value="<?php echo get_option('tribusDefaultArea'); ?>" /> 
                <div id='autocomplete'></div>
                <input type="hidden" name="tribusDefaultAreaName" id="tribusDefaultAreaName" value="<?php echo get_post_meta($post->ID, 'tribusDefaultAreaName', true); ?>">
                <input type="hidden" name="tribusDefaultAreaValue" id="tribusDefaultAreaValue" value="<?php echo get_post_meta($post->ID, 'tribusDefaultAreaValue', true); ?>">
                
                <script type="text/javascript"> 

                  <?php $ds_opts = get_option(DSIDXPRESS_OPTION_NAME); ?>
                  
                  YAHOO.Tribus = function() {
                    this.searchType = ["nozeroprop","city","community","tract","zip","area"];
                    this.locationTypeId;
                    this.locationTypeName;
                    this.locationType = [
                      "nozeroprop",
                      "idx-q-Cities",
                      "idx-q-Communities",
                      "idx-q-TractIdentifiers",
                      "idx-q-ZipCodes",
                      "idx-q-Areas"
                    ];
                  };
            
                  YAHOO.Tribus.prototype.RemoteCustomRequest = function() {
                    var oDS = new YAHOO.util.ScriptNodeDataSource("http://api.idx.diversesolutions.com/API/Locations/<?php echo $ds_opts["AccountID"]; ?>/<?php echo $ds_opts["SearchSetupID"]; ?>?maxAreasToReturn=10&");
                    oDS.responseSchema = { resultsList: "", fields: ["LocationName","LocationCacheTypeID","TotalCount"] };
                    var oAC = new YAHOO.widget.AutoComplete("tribusDefaultArea","autocomplete", oDS);
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
                      jQuery("#tribusDefaultAreaName").val(idx.locationType[idx.locationTypeId]);
                      jQuery("#tribusDefaultAreaValue").val(idx.locationTypeName);
                      debugger;
                    };
                    oAC.itemSelectEvent.subscribe(oAC.setLocationCacheTypeId);    
                    return { oDS: oDS, oAC: oAC };
                  };
            
                  var idx = new YAHOO.Tribus;
                  idx.RemoteCustomRequest();
                </script>
                
                
              </td>
            </tr>     


					<tr valign="top">
	    				<th scope="row">Tribus Home Code</th>
	    				<td><input type="text" name="tribusHomeCode" id="tribusHomeCode" value="<?php echo get_option('tribusHomeCode'); ?>" /></td>
	    			</tr>

					<tr valign="top">
	    				<th scope="row">Tribus Condo Code</th>
	    				<td><input type="text" name="tribusCondoCode" id="tribusCondoCode" value="<?php echo get_option('tribusCondoCode'); ?>" /></td>
	    			</tr>
                    
                    <tr valign="top">
	    				<th scope="row">Feed ID</th>
	    				<td><input type="text" name="tribusThemeFeedId" id="tribusThemeFeedId" value="<?php echo get_option('tribusThemeFeedId'); ?>" /></td>
	    			</tr>
                    
                    <tr valign="top">
	    				<th scope="row">Bitly  User Name</th>
	    				<td>
                        <input type="text" name="tribusThemeBitly" id="tribusThemeBitly" value="<?php echo get_option('tribusThemeBitly'); ?>" />
                        Bitly API Key
                        <input type="text" name="tribusThemeBitlyApi" id="tribusThemeBitlyApi" value="<?php echo get_option('tribusThemeBitlyApi'); ?>" />
                        
                        </td>
	    			</tr>
                    
                    
					<tr valign="top">
	    				<th scope="row">Facebook URL</th>
	    				<td><input type="text" name="tribusThemeFacebookLink" id="tribusThemeFacebookLink" value="<?php echo get_option('tribusThemeFacebookLink'); ?>" /></td>
	    			</tr>
	
					<tr valign="top">
	    				<th scope="row">Twitter URL</th>
	    				<td><input type="text" name="tribusThemeTwitterLink" id="tribusThemeTwitterLink" value="<?php echo get_option('tribusThemeTwitterLink'); ?>" /></td>
	    			</tr>
					<tr valign="top">
	    				<th scope="row">Google Plus URL</th>
	    				<td><input type="text" name="tribusThemeGooglePlusLink" id="tribusThemeGooglePlusLink" value="<?php echo get_option('tribusThemeGooglePlusLink'); ?>" /></td>
	    			</tr>
	
					<tr valign="top">
	    				<th scope="row">LinkedIn URL</th>
	    				<td><input type="text" name="tribusThemeLinkedInLink" id="tribusThemeLinkedInLink" value="<?php echo get_option('tribusThemeLinkedInLink'); ?>" /></td>
	    			</tr>
	
					<tr valign="top">
	    				<th scope="row">YouTube URL</th>
	    				<td><input type="text" name="tribusThemeYouTubeLink" id="tribusThemeYouTubeLink" value="<?php echo get_option('tribusThemeYouTubeLink'); ?>" /></td>
	    			</tr>
	
					<tr valign="top">
	    				<th scope="row">Flickr URL</th>
	    				<td><input type="text" name="tribusThemeFlickrLink" id="tribusThemeFlickrLink" value="<?php echo get_option('tribusThemeFlickrLink'); ?>" /></td>
	    			</tr>
	
					<tr valign="top">
	    				<th scope="row">Custom RSS Feed URL</th>
	    				<td><input type="text" name="tribusThemeCustomRSSLink" id="tribusThemeCustomRSSLink" value="<?php echo get_option('tribusThemeCustomRSSLink'); ?>" /></td>
	    			</tr>
	
					<tr valign="top">
	    				<th scope="row">Business Name/Brokerage</th>
	    				<td><input type="text" name="tribusBusinessName" id="tribusBusinessName" value="<?php echo get_option('tribusBusinessName'); ?>" /></td>
	    			</tr>
	
					<tr valign="top">
	    				<th scope="row">Business License Number (DRE#)</th>
	    				<td><input type="text" name="tribusBusinessLicenseNumber" id="tribusBusinessLicenseNumber" value="<?php echo get_option('tribusBusinessLicenseNumber'); ?>" /></td>
	    			</tr>
					<tr valign="top">
	    				<th scope="row">Facebook App?</th>
	    				<td><input type="checkbox" name="tribusFacebookApp" id="tribusFacebookApp" value="Y" <?php echo ( get_option('tribusFacebookApp') == 'Y' ) ? "CHECKED" : ""; ?>></td>
  				</tr>

					<tr valign="top">
	    				<th scope="row">Facebook App ID</th>
	    				<td><input type="text" name="tribusFacebookAppID" id="tribusFacebookAppID" value="<?php echo get_option('tribusFacebookAppID'); ?>" /></td>
	    			</tr>

					<tr valign="top">
	    				<th scope="row">Facebook Namespace</th>
	    				<td><input type="text" name="tribusFacebookNamespace" id="tribusFacebookNamespace" value="<?php echo get_option('tribusFacebookNamespace'); ?>" /></td>
	    			</tr>
					<tr valign="top">
	    				<th scope="row">Facebook Photo ID</th>
	    				<td><input type="text" name="tribusFacebookPhotoID" id="tribusFacebookPhotoID" value="<?php echo get_option('tribusFacebookPhotoID'); ?>" /></td>
	    			</tr>			
					
          <tr valign="top">
              <th scope="row">Hide Search Form?</th>
              <td><input type="checkbox" name="tribusHideSearchForm" id="tribusFacebookApp" value="Y" <?php echo ( get_option('tribusHideSearchForm') == 'Y' ) ? "CHECKED" : ""; ?>></td>
          </tr>


		

				</table>
				<p class="submit">
					<input type="submit" class="button-primary" value="<?php _e('Update Settings') ?>" />
				</p>
			</form>
		</div>


<?php
	}
	
}
