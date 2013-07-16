<?php
/*
Template Name: dsIDXpress Details Page
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php language_attributes(); ?>>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<title><?php wp_title(); ?></title>
	
	<?php if ( get_option('tribusThemeNameFont') ) { ?>
	<link href='http://fonts.googleapis.com/css?family=<?php echo urlencode(get_option('tribusThemeNameFont')); ?>' id="nameFontCss" rel='stylesheet' type='text/css'>
	<?php } ?>
	
	<?php if ( get_option('tribusThemeDescriptionFont') ) { ?>
	<link href='http://fonts.googleapis.com/css?family=<?php echo urlencode(get_option('tribusThemeDescriptionFont')); ?>' id="descFontCss" rel='stylesheet' type='text/css'>
	<?php } ?>
	
	<script type="text/javascript" src="http://yui.yahooapis.com/combo?2.8.0r4/build/yuiloader-dom-event/yuiloader-dom-event.js&2.8.0r4/build/animation/animation-min.js&2.8.0r4/build/datasource/datasource-min.js&2.8.0r4/build/autocomplete/autocomplete-min.js"></script>
	<?php wp_head(); ?>
<?php 
$FB_App = get_option('tribusFacebookApp');
if ($FB_App != "Y") { $FB_App = false; }
$theURL = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; 
$strStart = strpos( $theURL, 'mls-' ) + 4;
$strEnd = strpos( $theURL, '-', $strStart );
$myStrLength = $strEnd - $strStart;
$theMLSID = substr( $theURL, $strStart, $myStrLength );
if ( $FB_App ) { 
?>
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# homesilove: http://ogp.me/ns/fb/homesilove#">
	<meta property="fb:app_id"      content="<?php echo get_option('tribusFacebookAppID'); ?>" /> 
  	<meta property="og:type"        content="homesilove:home" /> 
  	<meta property="og:url"         content="<?php echo $theURL; ?>" /> 
 	<meta property="og:title"       content="<?php the_title(); ?>" /> 
 	<meta property="og:description" content="<?php the_title(); ?>" />
	<meta property="og:image" 	content="http://mls-photos.diversesolutions.com/<?php echo get_option('tribusFacebookPhotoID'); ?>/<?php echo $theMLSID; ?>/0-full.jpg" />
<div id="fb-root"></div>
  <script>
    window.fbAsyncInit = function() {
      FB.init({
        appId      : 300278526688869, // App ID
        status     : true, // check login status
        cookie     : true, // enable cookies to allow the server to access the session
        xfbml      : true  // parse XFBML
      });
console.log(FB);
    };

    // Load the SDK Asynchronously
    (function(d){
      var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
      js = d.createElement('script'); js.id = id; js.async = true;
      js.src = "//connect.facebook.net/en_US/all.js";
      d.getElementsByTagName('head')[0].appendChild(js);
    }(document));
function postLove() {
	var thislocation = location.href;
        FB.api('/me/homesilove:love?home='+thislocation,'post',function(response) {
            if (!response || response.error) {
                alert('Error occured');
		console.log(response);
            } else {
                alert('This home has been saved!');
                }
        });
}
  </script>
    <script>
	/* 
FB.init({ 
     		appId:'<?php echo get_option('tribusFacebookAppID'); ?>', cookie:true, 
     		status:true, xfbml:true, oauth:true
	});
*/
        </script>

<?php 
	} 
?>
</head>
<?php $themeColor = ( get_option('tribusThemeColor') ) ? get_option('tribusThemeColor') : 'blue'; ?>
<body class="<?php echo $themeColor; ?>">

<?php $content_class = ( is_home() && !defined('INTERIOR') ) ? 'home' : 'interior'; ?>

	<div class="innerBody">
		
		<div class="toplinks">
			<p class="email"><a href="<?= get_bloginfo('url');?>/forms/email-us/?iframe=true&width=450&height=500" class="prettyPhoto">Email Us</a></p>
			
			<?php if ( defined('INSTANT_COMMUNICATION') && INSTANT_COMMUNICATION && get_option('tribusThemeMeembo') ) { ?>
			<p class="chat"><a class="meebo" href="#">Live Chat</a></p>
			<script type="text/javascript">
				jQuery(function($){
					$("a.meebo").click(function(event){
						event.preventDefault();
						window.open('<?php bloginfo("url"); ?>/meebo/', 'mywindow', 'width=265,height=330,resizable=no,scrollbars=no,toolbar=no,location=no,directories=no,status=no,menubar=no,copyhistory=no');
						return false;
					});
				});
			</script>
			
			<?php } ?>
			
			<?php if ( get_option('tribusThemePhoneNumber') ) { ?>
			<p class="phone"><?php echo get_option('tribusThemePhoneNumber'); ?></p>
			<?php } ?>
			
<?php 
			$fb_link = get_option('tribusThemeFacebookLink'); 
			if ( $fb_link ) {
				$fb = ( substr($fb_link, 0, 7) == "http://" ) ? $fb_link : "http://{$fb_link}";
?>
			<a href="<?php echo $fb; ?>" target="_blank" rel="nofollow"><img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/sn_fb.png" alt="facebook"/></a>
			<?php } ?>
			
<?php 
			$tw_link = get_option('tribusThemeTwitterLink');
			if ( $tw_link ) { 
				$tw = ( substr($tw_link, 0, 7) == "http://" ) ? $tw_link : "http://{$tw_link}";
?>
			<a href="<?php echo $tw; ?>" target="_blank" rel="nofollow"><img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/sn_tw.png" alt="twitter"/></a>
			<?php } ?>
			
<?php 
			$li_link = get_option('tribusThemeLinkedInLink');
			if ( $li_link ) { 
				$li = ( substr($li_link, 0, 7) == "http://" ) ? $li_link : "http://{$li_link}";
?>
			<a href="<?php echo $li; ?>" target="_blank" rel="nofollow"><img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/sn_li.png" alt="linked in"/></a>
			<?php } ?>
			
<?php 
			$yt_link = get_option('tribusThemeYouTubeLink');
			if ( $yt_link ) { 
				$yt = ( substr($yt_link, 0, 7) == "http://" ) ? $yt_link : "http://{$yt_link}";
?>
			<a href="<?php echo $yt; ?>" target="_blank" rel="nofollow"><img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/sn_yt.png" alt="youtube"/></a>
			<?php } ?>
			
<?php 
			$fl_link = get_option('tribusThemeFlickrLink');
			if ( $fl_link ) {
				$fl = ( substr($fl_link, 0, 7) == "http://" ) ? $fl_link : "http://{$fl_link}";
?>
			<a href="<?php echo $fl; ?>" target="_blank" rel="nofollow"><img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/sn_fl.png" alt="flickr"/></a>
			<?php } ?>
			
<?php 
			$rss_link = get_option('tribusThemeCustomRSSLink');
			if ( $rss_link ) {
				$rs = ( substr($rss_link, 0, 7) == "http://" ) ? $rss_link : "http://{$rss_link}";
			} else {
				$rs =  get_bloginfo('url') . '/feed';
			}
?>
			<a href="<?php echo $rs; ?>" target="_blank" rel="nofollow"><img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/sn_rss.png" alt="rss"/></a>
			<br class="clear">
		</div>
		<div class="content_top"></div>
		
		<div class="content <?php echo $content_class; ?>">

			<div class="header">
	
				<div class="logo">
				<?php 
					global $Tribus; 
					echo $Tribus->tribus_theme->custom_title(); 
				?>
				</div>
				
				<img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" style="margin-left:4px;" />
				<div class="search">
					<h3>Quick Search</h3>
					<div class="searchform">
						
						<p>
							<label style="margin-right:20px;">What type of home?</label>
						
							<input type="checkbox" name="idx-q-PropertyTypes" value="180" checked>
							<label style="margin-right:8px;">Homes</label>
						
							<input type="checkbox" name="idx-q-PropertyTypes" value="143">
							<label>Condos</label>
						</p>
						
						<p> 
							<label>Where?</label> 
							<input name="location-search" id="location-search" class="form-field" onblur="if (this.value == '') {this.value = 'Enter a city, neighborhood, or zip';}" onfocus="if (this.value == 'Enter a city, neighborhood, or zip') {this.value = '';}" size="30" value="Enter a city, neighborhood, or zip" style="width:230px;"> 
							<div id='autocomplete'></div>
						</p> 

						<p>
							<label>How Much? (min)</label> 
							<input name="idx-q-PriceMin" id="idx-q-PriceMin" class="form-field-small" style="width:173px;"> 
						</p> 

						<p> 
							<label>How Much? (max)</label> 
							<input name="idx-q-PriceMax" id="idx-q-PriceMax" class="form-field-small" style="width:169px;"> 
						</p> 

						<p> 
							<label>Beds</label> 
							<select name="idx-q-BedsMin" id="idx-q-BedsMin" class="form-select-small"> 
								<option value="1">1+</option> 
								<option value="2">2+</option> 
								<option value="3" selected>3+</option> 
								<option value="4">4+</option> 
								<option value="5">5+</option> 
							</select> 

							<label>Baths</label> 
							<select name="idx-q-BathsMin" id="idx-q-BathsMin" class="form-select-small"> 
								<option value="1">1+</option> 
								<option value="2" selected>2+</option> 
								<option value="3">3+</option> 
								<option value="4">4+</option> 
								<option value="5">5+</option> 
							</select>
						</p>
						
						<button type="submit" id="submitIdxSearch">Search Now </button>

<?php 

	if ( defined("DSIDXPRESS_OPTION_NAME") ) : 
		$ds_opts = get_option(DSIDXPRESS_OPTION_NAME);

?>
<script type="text/javascript"> 

	YAHOO.Tribus = function() {
		this.formFields = [
			"idx-q-PropertyTypes",
			"idx-q-PriceMin",
			"idx-q-PriceMax",
			"idx-q-BedsMin",
			"idx-q-BathsMin",
			"location-search"
		];
		
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
		this.queryString = "/idx/?";
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
		};
		oAC.itemSelectEvent.subscribe(oAC.setLocationCacheTypeId);		
		return { oDS: oDS, oAC: oAC };
	};

	var idx = new YAHOO.Tribus;
	idx.RemoteCustomRequest();

	jQuery(function($){
		$("#submitIdxSearch").click(function(e){
			e.preventDefault();
			var i, j, val, qStr = '', qObj = {};
			$.each(idx.formFields, function(i,v){
				if ( v == "idx-q-PropertyTypes" ) {
					qObj["idx-q-PropertyTypes"] = '';
					/*
					qObj["idx-q-PropertyTypes"] = [];
					$("input[name='idx-q-PropertyTypes']:checked").each(function(index,el){
						qObj["idx-q-PropertyTypes"].push($(el).val());
					});
					*/
				} else if ( v == "location-search" ) {
					qObj[idx.locationType[idx.locationTypeId]] = escape(idx.locationTypeName);
				} else {
					qObj[v] = $("#" + v).val();
				}
			});
			for ( i in qObj ) {
				if ( typeof qObj[i] != "string" ) {
					for ( j = 0; j < qObj[i].length; j++ ) {
						qStr += i + "<" + j + ">=" + qObj[i][j] + "&";
					}
				} else if ( qObj[i] != '' ) {
					qStr += i + "=" + qObj[i] + "&";
				}
			}
			window.location = "http://" + window.location.hostname + idx.queryString + qStr.slice(0,-1);
			return false;
		});
	});

</script>
<?php endif; ?>
							
					</div>
				</div> <!-- end search -->

			</div> <!-- end header -->
	
			<div class="navContainer">
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav', 'container_class' => 'nav' ) ); ?>				
			</div> <!--end navContainer -->
			
			<div class="main">

				<div class="blogidx">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<h2 class="title"><?php the_title(); ?></h2>
<?php
if ( $FB_App ) {
?>
Want to save Homes? Save Using Facebook: <div class="fb-add-to-timeline" data-show-faces="false" data-mode="button"></div><form><input type="button" value="Love" onclick="postLove()" /> this home and save for future reference.
</form>
<?php
		}
?>
        
	<?php 
		
		$data = get_the_content();
		$replace = '<div id="idx-buttons"><a href="' . get_bloginfo('siteurl') . '/forms/more-info/?address=' . urlencode(get_the_title()) . '&iframe=true&width=450&height=500" class="prettyPhoto" title="" ><img src="' . get_bloginfo("stylesheet_directory") . '/images/listing-get-more.png"></a>	
						<a href="' . get_bloginfo('siteurl') . '/forms/schedule-showing/?showdate=true&address=' . urlencode(get_the_title()) . '&iframe=true&width=450&height=500" class="prettyPhoto" title="" ><img src="' . get_bloginfo("stylesheet_directory") . '/images/listing-schedule.png"></a>
						<a href="' . get_bloginfo('siteurl') . '/forms/detailed-report/?address=' . urlencode(get_the_title()) . '&url=' . urlencode(get_permalink()) . '&city=' . $post->city . '&iframe=true&width=450&height=500" class="prettyPhoto" title=""><img src="'.get_bloginfo("stylesheet_directory").'/images/listing-report.png"></a></div><table id="dsidx-primary-data">';
		
		$content = str_replace('<table id="dsidx-primary-data">', $replace, $data);
		echo $content;
	
	?>

<?php endwhile; endif; ?>

<?php
	$url = $_SERVER['REQUEST_URI'];
	$zip = substr($url, -5);
	$atts = shortcode_atts(array(
		"city"			=> "",
		"community"		=> "",
		"tract"			=> "",
		"zip"			=> $zip,
		"minprice"		=> "",
		"maxprice"		=> "",
		"propertytypes"	=> "",
		"linkid"		=> "",
		"count"			=> "6",
		"orderby"		=> "DateAdded",
		"orderdir"		=> "DESC",
		"showlargerphotos"	=> "false"
	), $atts);

	$apiRequestParams = array();
	$apiRequestParams["responseDirective.ViewNameSuffix"] = "shortcode";
	$apiRequestParams["responseDirective.IncludeMetadata"] = "true";
	$apiRequestParams["responseDirective.IncludeLinkMetadata"] = "true";
	$apiRequestParams["responseDirective.ShowLargerPhotos"] = $atts["showlargerphotos"];
	$apiRequestParams["query.Cities"] = htmlspecialchars_decode($atts["city"]);
	$apiRequestParams["query.Communities"] = htmlspecialchars_decode($atts["community"]);
	$apiRequestParams["query.TractIdentifiers"] = htmlspecialchars_decode($atts["tract"]);
	$apiRequestParams["query.ZipCodes"] = $atts["zip"];
	$apiRequestParams["query.PriceMin"] = $atts["minprice"];
	$apiRequestParams["query.PriceMax"] = $atts["maxprice"];

	if ( $atts["propertytypes"] ) {
		$propertyTypes = explode(",", str_replace(" ", "", $atts["propertytypes"]));
		$propertyTypes = array_combine(range(0, count($propertyTypes) - 1), $propertyTypes);
		foreach ($propertyTypes as $key => $value)
			$apiRequestParams["query.PropertyTypes[{$key}]"] = $value;
	}

	if ($atts["linkid"]) {
		$apiRequestParams["query.LinkID"] = $atts["linkid"];
		$apiRequestParams["query.ForceUsePropertySearchConstraints"] = "true";
	}

	$apiRequestParams["directive.ResultsPerPage"] = $atts["count"];
	$apiRequestParams["directive.SortOrders[0].Column"] = $atts["orderby"];
	$apiRequestParams["directive.SortOrders[0].Direction"] = $atts["orderdir"];
	$apiHttpResponse = dsSearchAgent_ApiRequest::FetchData("Results", $apiRequestParams);

	if ( !strstr($apiHttpResponse['body'], "Sorry, but") ) {
?>

	<div class="community-header" id="similar-properties">
		<h2 class="h2-border">other properties you might like</h2>
		<?php echo $apiHttpResponse['body']; ?>
		<div class="break"></div>
	</div>
<?php
 	}
?>

<?php get_footer(); ?>