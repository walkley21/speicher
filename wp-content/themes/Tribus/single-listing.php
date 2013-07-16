<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
<?php
		$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
		$imageArray = wp_get_attachment_image_src($post_thumbnail_id);
?>

		<h2 class="h2-border"><?php the_title(); ?></h2>
		
		<div class="listing-photo">
			<div class="listing-image" id="main-photo">
				<?php 
					the_post_thumbnail('single_listing'); 
					$w = $imageArray[1];
					if ($w > 320) $w = 320;
					$width = $w;
				?>
			</div>
			<div class="clear"></div>

<?php
			$images =& get_children( 'post_type=attachment&order=ASC&post_mime_type=image&numberposts=-1&post_parent=' . $post->ID ); 
			if ( count($images) ) {
?>
			<div class="photo-nav">
				<?php if (count($images) > 4) { ?>
				<div class="arrow-left">
					<img src="<?php bloginfo('stylesheet_directory'); ?>/images/arrow-left.png" id="arrow-left">
				</div>
				<?php } ?>
				
				<?php
				$w = (count($images) * 89);
				$style = "width:" . $w . "px;";
				if (count($images) < 4) $style .= "margin:0 auto;";
				?>
				<div class="photo-container"<?php if (count($images) <= 4) { ?> style="margin-left:40px;"<?php } ?>>
					<div class="photos" style="<?php echo $style; ?>">
					<?php
					foreach ( $images as $attachment_id => $attachment ) {
						$img = wp_get_attachment_image_src($attachment_id, 'full');
						echo '<a href="' . $img[0] . '" rel="prettyPhoto[photos]" title="' . $attachment->post_content . '" alt="' . $attachment->post_content . '">';
						echo wp_get_attachment_image( $attachment_id, array(75,75) );
						echo '</a>';
					}
					?>
					</div>
				</div>
				<?php if (count($images) > 4) { ?>
				<div class="arrow-right">
					<img src="<?php bloginfo('stylesheet_directory'); ?>/images/arrow-right.png" id="arrow-right">
				</div>
				<?php } ?>
				<div class="clear"></div>
				
				<div class="photo-num">(<?= count($images);?> total photos)</div>
										
				<script type="text/javascript" charset="utf-8">
					var maxPhoto = <?php echo (count($images) - 4); ?>;
				</script>
			</div>
			<? } ?>
		</div>	
						
		<div class="listing-header">
			<div class="headline">
				<div class="price">$<?php echo get_post_meta($post->ID, 'listing_price', true); ?></div>
				<h1 class="title"><?php the_title(); ?></h1>
				<div class="clear"></div>
			</div>
			<?php if ( get_post_meta($post->ID, 'listing_open_house', true) ) { ?>
			<div class="open-house">
				<label>NEXT OPEN HOUSE:</label> <?php echo get_post_meta($post->ID, 'listing_open_house', true); ?>
			</div>
			<? } ?>
			
			
			<div class="data">
				<div class="data-divider data-first"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/listing-divider.png"></div>
				<div class="data-item"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/house.png"><br /><?php echo get_post_meta($post->ID, 'listing_sqft', true); ?> sf</div>
				<div class="data-divider"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/listing-divider.png"></div>
				<div class="data-item"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/garage.png"><br /><?php echo get_post_meta($post->ID, 'listing_garage', true); ?></div>
				<div class="data-divider"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/listing-divider.png"></div>
				<div class="data-item"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/beds.png"><br /><?php echo get_post_meta($post->ID, 'listing_bedrooms', true); ?> beds</div>
				<div class="data-divider"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/listing-divider.png"></div>
				<div class="data-item"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/baths.png"><br /><?php echo get_post_meta($post->ID, 'listing_bathrooms', true); ?> baths</div>
				<div class="data-divider"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/listing-divider.png"></div>
				<?
				$address = get_post_meta($post->ID, 'listing_address', true) . ", " . get_post_meta($post->ID, 'listing_city', true) . " CA, ".get_post_meta($post->ID, 'listing_zip', true);
				?>
			</div>
							
			<div class="buttons">
				<a rel="nofollow" href="<?= get_bloginfo('url');?>/forms/more-info/?address=<?= urlencode($post->post_title);?>&iframe=true&width=450&height=500" class="prettyPhoto" title="" >
					<img src="<?= get_bloginfo("stylesheet_directory");?>/images/listing-get-more.png">
				</a>
				<? if(get_post_meta($post->ID, 'listing_tour', true)) { ?>
					<a rel="external nofollow" href="<?php echo get_post_meta($post->ID, 'listing_tour', true); ?>" target="_blank"><img src="<?= get_bloginfo("stylesheet_directory");?>/images/listing-virtual-tour.png"></a>
				<? } ?>

				<!--&showdate=true-->
				<a rel="nofollow" href="<?= get_bloginfo('url');?>/forms/schedule-showing/?address=<?= urlencode($post->post_title);?>&iframe=true&width=450&height=500" class="prettyPhoto" title="" >
					<img src="<?= get_bloginfo("stylesheet_directory");?>/images/listing-schedule.png">
				</a>

				<a rel="nofollow" href="<?= get_bloginfo('url');?>/forms/detailed-report/?address=<?= urlencode($post->post_title);?>&url=<?= get_bloginfo('url') . $_SERVER['REQUEST_URI'];?>&city=<?php echo get_post_meta($post->ID, 'listing_city', true); ?>&iframe=true&width=450&height=500" class="prettyPhoto" title="">
					<img src="<?= get_bloginfo("stylesheet_directory");?>/images/listing-report.png">
				</a>
				
			</div>
		</div>
							
		<?php the_content() ?>
		<div class='clear'></div>
		
<?php
$open_house_date = get_post_meta($post->ID, 'listing_oh_date', true);
if ( !empty($open_house_date) ) {
?>

<h2 class="h2-border">Open House</h2>
<div class="details">
	<div class="detail"><label>Date:</label> <?php echo get_post_meta($post->ID, 'listing_oh_date', true); ?></div>
	<div class="detail"><label>Time Range:</label> <?php echo get_post_meta($post->ID, 'listing_oh_time', true); ?></div>
	<div class='clear'></div>
</div>


<?php } ?>
							

		<div class="features">
		<h2 class="h2-border">Property Features</h2>
						
		<div class="details">
			<div class="detail"><label>Listing Price:</label> <?php echo get_post_meta($post->ID, 'listing_price', true); ?></div>
			<div class="detail"><label>Status:</label> <?php echo get_post_meta($post->ID, 'listing_status', true); ?></div>
			<div class="detail"><label>Address:</label> <?php echo get_post_meta($post->ID, 'listing_address', true); ?></div>
			<div class="detail"><label>MLS #:</label> <?php echo get_post_meta($post->ID, 'listing_mls', true); ?></div>
			<div class="detail"><label>City:</label> <?php echo get_post_meta($post->ID, 'listing_city', true); ?></div>
			<div class="detail"><label>Square Feet:</label> <?php echo get_post_meta($post->ID, 'listing_sqft', true); ?></div>
			<div class="detail"><label>State:</label> <?php echo get_post_meta($post->ID, 'listing_state', true); ?></div>
			<div class="detail"><label>Bedrooms:</label> <?php echo get_post_meta($post->ID, 'listing_bedrooms', true); ?></div>
			<div class="detail"><label>Zip Code:</label> <?php echo get_post_meta($post->ID, 'listing_zip', true); ?></div>
			<div class="detail"><label>Bathrooms:</label> <?php echo get_post_meta($post->ID, 'listing_bathrooms', true); ?></div>
			<div class="detail"><label>County:</label> <?php echo get_post_meta($post->ID, 'listing_county', true); ?></div>
			<div class="detail"><label>Garage:</label> <?php echo get_post_meta($post->ID, 'listing_garage', true); ?></div>
			
			<div class='clear'></div>
		</div>
	</div>
	
<?php 
	$other_info = get_post_meta($post->ID, 'other_listing_info', true);
	if ( !empty($other_info) ) {
?>
	<h2 class="h2-border">Other Information</h2>
	<p><?php echo $other_info; ?></p>
<?php } ?>

		<div id="listing-about">
			<h2 class="h2-border" style="margin-bottom:0">About The Area</h2>
			<ul class="tab-nav">
				<li><a href="#aa-map" class="active">Map</a></li>
				<li><a href="#aa-parks">Parks</a></li>
				<li><a href="#aa-schools">Schools</a></li>
				<!--<li><a href="#aa-market-stats">Market Stats</a></li>-->
			</ul>
			
<?php 
			$address = get_post_meta($post->ID, 'listing_address', true); 
			$city = get_post_meta($post->ID, 'listing_city', true);
			$state = get_post_meta($post->ID, 'listing_state', true);
			$zip = get_post_meta($post->ID, 'listing_zip', true);
			$lookup = urlencode($address . ' ' . $city . ',' . $state . ' ' . $zip);
?>
			<div id="aa-map" class="tab-box">
				<iframe width="686" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=<?php echo $lookup; ?>&amp;ie=UTF8&amp;hq=&amp;hnear=<?php echo $lookup; ?>&amp;z=14&amp;output=embed"></iframe>
			</div>

			<div id="aa-parks" class="tab-box" style="display:none">
				<ul>
		<?php	
				
				$url = "http://api.local.yahoo.com/LocalSearchService/V3/localSearch?appid=YahooDemo&location={$lookup}&radius=1&query=Parks&category=&results=10";
				$resp = wp_remote_get($url);
				if( is_wp_error( $resp ) ) {
				   echo 'We could not locate any parks.';
				} else {
					$xmlObj = simplexml_load_string($resp['body']);
					foreach ( $xmlObj->Result as $park ) {
						echo '<li><a href="' . $park->Url . '" target="_blank">'. $park->Title . '</a></li>';
					}
				}
		?>
				</ul>
			</div>

			<div id="aa-schools" class="tab-box" style="display:none">
				<ul>
		<?php	
			$url = "http://api.local.yahoo.com/LocalSearchService/V3/localSearch?appid=YahooDemo&location={$lookup}&radius=1&query=Schools&category=&results=10";
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

if ( defined("DSIDXPRESS_OPTION_NAME") ) { 

	$atts = shortcode_atts(array(
		"city"			=> get_post_meta($post->ID, 'listing_city', true),
		"community"		=> "",
		"tract"			=> "",
		"zip"			=> get_post_meta($post->ID, 'listing_zip', true),
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
}
?>
		
	
	<?php endwhile; endif; ?>

<script type='text/javascript'>
	jQuery(function($){
		var currPhoto = 0;
		$("#arrow-right").click(function(){
			if (currPhoto < maxPhoto) {
				jQuery(".photos").animate({"left": "-=85px"}, "slow");
				currPhoto++;
			}
		});

		$("#arrow-left").click(function(){
			if (currPhoto > 0) {
				jQuery(".photos").animate({"left": "+=85px"}, "slow");
				currPhoto--;
			}
		});
		
		$(".photo-container img").click(function(event){
			event.preventDefault();
			var img = $(this).parent().attr('href');
			$("#main-photo img").attr('src', img);
			return false;
		});
		
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