<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<h2 class="h2-border"><?php the_title(); ?></h2>
	<div class="community-body">
		<div class="community-photo">
			<?php if ( has_post_thumbnail() ) the_post_thumbnail('single_listing'); ?>
		</div>
		<?php the_content(); ?>
	</div>

	<div style="clear:both;width:100%;height:1px;display:block;"></div>
<div id="listing-about">
	<h2 class="h2-border" style="margin-bottom:0">About The Area</h2>
	<?php
		//$widget = new About_The_Area();
		//$widget->widget(array('name'=>$post->post_name, 'city'=> $post->post_title), '');
		$address = get_post_meta($post->ID, 'community_address', true);
		if ( isset($address) && !empty($address) ) {
			$lookup = urlencode($address);
		} else {
			$lookup = urlencode($post->post_name);
		}
	?>
	
	<?php
	  /*
	  if($_GET['test'] == 1) {
	    print_r($post);
	  }
    */
	?>
	
	<?php $com_location = get_post_meta($post->ID, 'community_location', true); ?>
	<?php $com_schools = get_post_meta($post->ID, 'community_schools', true); ?>
	<?php $com_parks = get_post_meta($post->ID, 'community_parks', true); ?>
	<?php $com_events = get_post_meta($post->ID, 'community_events', true); ?>
	<?php $com_shopping = get_post_meta($post->ID, 'community_shopping', true); ?>
	<?php $com_history = get_post_meta($post->ID, 'community_history', true); ?>
	<?php $com_neighborhoods = get_post_meta($post->ID, 'community_neighborhoods', true); ?>

	<ul class="tab-nav">
		<li><a href="#aa-map" class="active">Map</a></li>
		<?php if ( isset($com_location) && !empty($com_location) ) { ?>
		<li><a href="#aa-location">Location</a></li>
		<?php } ?>
		<li><a href="#aa-parks">Parks</a></li>
		<li><a href="#aa-schools">Schools</a></li>
		<?php if ( isset($com_events) && !empty($com_events) ) { ?>
		<li><a href="#aa-events">Events</a></li>
		<?php } ?>
		<?php if ( isset($com_shopping) && !empty($com_shopping) ) { ?>
		<li><a href="#aa-shopping">Shopping</a></li>
		<?php } ?>
		<?php if ( isset($com_history) && !empty($com_history) ) { ?>
		<li><a href="#aa-history">History</a></li>
		<?php } ?>
		<?php if ( isset($com_neighborhoods) && !empty($com_neighborhoods) ) { ?>
		<li><a href="#aa-neighborhoods">Neighborhoods</a></li>
		<?php } ?>
		<!--<li><a href="#aa-market-stats">Market Stats</a></li>-->
	</ul>
	
	<?php if ( isset($com_location) && !empty($com_location) ) { ?>
	<div id="aa-location" class="tab-box" style="display:none">
		<p><?php echo $com_location; ?></p>
	</div>
	<?php } ?>
	
	<?php if ( isset($com_events) && !empty($com_events) ) { ?>
	<div id="aa-events" class="tab-box" style="display:none">
		<p><?php echo $com_events; ?></p>
	</div>
	<?php } ?>
	
	<?php if ( isset($com_shopping) && !empty($com_shopping) ) { ?>
	<div id="aa-shopping" class="tab-box" style="display:none">
		<p><?php echo $com_shopping; ?></p>
	</div>
	<?php } ?>
	
	<?php if ( isset($com_history) && !empty($com_history) ) { ?>
	<div id="aa-history" class="tab-box" style="display:none">
		<p><?php echo $com_history; ?></p>
	</div>
	<?php } ?>

	<?php if ( isset($com_neighborhoods) && !empty($com_neighborhoods) ) { ?>
	<div id="aa-neighborhoods" class="tab-box" style="display:none">
		<p><?php echo $com_neighborhoods; ?></p>
	</div>
	<?php } ?>
	
	<div id="aa-map" class="tab-box">
		<iframe width="686" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=<?php echo $lookup; ?>&amp;ie=UTF8&amp;hq=&amp;hnear=<?php echo $lookup; ?>&amp;z=14&amp;output=embed"></iframe>
	</div>

	<div id="aa-parks" class="tab-box" style="display:none">
		<?php if ( isset($com_parks) && !empty($com_parks) ) { ?>
			<p><?php echo $com_parks; ?></p>
		<?php } ?>
		<ul>
<?php	
		
    // $appid = '7DUkYTDV34ER8QnwR09A9RW9xLFwP2p.DIgwl64QqACz4sqtf1djbyBC.LWRss8n8w--';
    $appid = 'c1abe1b05321fd0a4305843a605867b5';
		$url = "http://api.local.yahoo.com/LocalSearchService/V3/localSearch?appid=$appid&location={$lookup}&radius=1&query=Parks&category=&results=10";
    // print $url;
		$resp = wp_remote_get($url);
    // print_r($resp);
		if( is_wp_error( $resp ) ) {
		   echo 'We could not locate any parks.';
		} else {
			$xmlObj = simplexml_load_string($resp['body']);
      // print_r($xmlObj);
			foreach ( $xmlObj->Result as $park ) {
				echo '<li><a href="' . $park->Url . '" target="_blank">'. $park->Title . '</a></li>';
			}
		}
?>
		</ul>
	</div>

	<div id="aa-schools" class="tab-box" style="display:none">
		<?php if ( isset($com_schools) && !empty($com_schools) ) { ?>
			<p><?php echo $com_schools; ?></p>
		<?php } ?>
		<ul>
<?php	
	$url = "http://api.local.yahoo.com/LocalSearchService/V3/localSearch?appid=$appid&location={$lookup}&radius=1&query=Schools&category=&results=10";
	$resp = wp_remote_get($url);
	if( is_wp_error( $resp ) ) {
		echo 'We could not locate any schools.';
	} else {
		$xmlObj = simplexml_load_string($resp['body']);
		foreach ( $xmlObj->Result as $school ) {
			echo '<li><a href="' . $school->Url . '" target="_blank">'. $school->Title . '</a></li>';
		}
	}
?>
		</ul>
	</div>
	
	<!--
	<div id="aa-market-stats" class="tab-box" style="display:none">
		<img src="http://charts.altosresearch.com/altos/app?s=inventory:r,median:l&amp;ra=c&amp;q=a&amp;st=CA&amp;c=<?= $city;?>&amp;z=<?= $zip;?>&amp;sz=l&amp;ts=e&amp;rt=sf&amp;service=chart&amp;pai=53003254&amp;co=0&amp;endDate=&amp;startDate=">
	</div>
	-->

</div>

	<?php

		$listing = new WP_Query( array( 
			'post_type' => 'listing', 
			'post_status' => 'publish', 
			'posts_per_page' => 1, 
			'orderby' => 'rand',
			'tax_query' => array(
				array(
						'taxonomy' => 'area',
						'field' => 'slug',
						'terms' => $post->post_name
					)
				)
		) );
		
		if ( $listing->have_posts() ) :
?>
<div id="featured_listing">
	<h2 class="h2-border">Featured Listing</h2>
<?php
			while ( $listing->have_posts() ) :
				$listing->the_post();
?>

				<div class="community-listing-info">
					<div class="community-listing-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
					<div class="community-detail"><label>Listing Price:</label> <?php echo get_post_meta(get_the_ID(), 'listing_price', true); ?></div>
					<div class="community-detail"><label>MLS #:</label> <?php echo get_post_meta(get_the_ID(), 'listing_mls', true); ?></div>
					<div class="community-detail"><label>Square Feet:</label> <?php echo get_post_meta(get_the_ID(), 'listing_sqft', true); ?></div>
					<div class="community-detail"><label>Bedrooms:</label> <?php echo get_post_meta(get_the_ID(), 'listing_bedrooms', true); ?></div>
					<div class="community-detail"><label>Bathrooms:</label> <?php echo get_post_meta(get_the_ID(), 'listing_bathrooms', true); ?></div>
					<div class="community-detail"><label>Garage:</label> <?php echo get_post_meta(get_the_ID(), 'listing_garage', true); ?></div>
				</div>
				
				<a href="<?php the_permalink(); ?>"><?php if ( has_post_thumbnail() ) the_post_thumbnail('listings'); ?></a>
				
				<div class="clear"></div>

				<div class="community-listing-text">
					<?php the_content(); ?>
					<a href="<?php the_permalink(); ?>" rel="bookmark"><img src="<? bloginfo("stylesheet_directory"); ?>/images/get-more-info.png" border="0"></a>
					<div class="clear"></div>
				</div>


<?php endwhile; ?>
</div>
<?php endif; ?>



<?php

if ( defined("DSIDXPRESS_OPTION_NAME") ) { 
	$defaults = array(
		"city"			=> "",
		"community"		=> "",
		"tract"			=> "",
		"zip"			=> "",
		"minprice"		=> "",
		"maxprice"		=> "",
		"propertytypes"	=> "",
		"linkid"		=> "",
		"count"			=> "6",
		"orderby"		=> "DateAdded",
		"orderdir"		=> "DESC",
		"showlargerphotos"	=> "false"
	);
	$n = get_post_meta($post->ID, 'community_featured_listing_name', true);
	$v = get_post_meta($post->ID, 'community_featured_listing_value', true);
	$q = array_merge($defaults, array( $n => $v ));
	$atts = shortcode_atts($q, $atts);

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
		<h2 class="h2-border">Homes In This Community</h2>
		<?php echo $apiHttpResponse['body']; ?>
		<div class="break"></div>
	</div>
<?php
 	} 
}
?>

<?php endwhile; endif; ?>

<script type='text/javascript'>
	jQuery(function($){		
		$('ul.tab-nav li a').click(function(event){
			event.preventDefault();
			$('ul.tab-nav li a').removeClass('active');
			$(this).addClass('active');
			$('.tab-box').hide();
			$( $(this).attr('href') ).show();
			return false; 
		});
	});
</script>

<?php get_footer(); ?>