<?php get_header(); ?>

<script>
    (function($){
        $(document).ready(function(){
        
       
        });
    })(jQuery);
</script>


<link rel="stylesheet" href="<?php echo bloginfo('template_directory')?>/js/prettyPhoto/css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />


<div id="mainWrapper" class="Listing-Detail">

<div id="widget-in-details-page">
<?php dynamic_sidebar('details-page-widget-area') ?>
</div>
<div style="clear:both"></div>


<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
<?php
		$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
		$imageArray = wp_get_attachment_image_src($post_thumbnail_id);
?>

		<!--<h2 class="h2-border"><?php the_title(); ?></h2>-->
		
		<div class="listing-photo" id="listing-main-photo-wrapper">
			<div class="listing-image" id="main-photo">
				<?php 
					the_post_thumbnail(array(830,341)); 
					$w = $imageArray[1];
					//if ($w > 320) $w = 320;
					//$width = $w;
				?>
			</div>
			<div class="clear"></div>

<?php
			$images =& get_children( 'post_type=attachment&order=ASC&post_mime_type=image&numberposts=-1&post_parent=' . $post->ID ); 
			if ( count($images) ) { 
?>			
			<div class="photo-nav">
				<?php if (count($images) > 5) : ?>
				<div class="arrow-left">
					<img src="<?php bloginfo('stylesheet_directory'); ?>/images/arrow-left.png" id="arrow-left">
				</div>
				<?php else: ?>
				<div id='padding-images-left'></div>
                <?php endif;?>
				<div class="photo-container" >
					
                    <div class="photos" id="photos" >
                    
					<?php
					foreach ( $images as $attachment_id => $attachment ) {
						$img = wp_get_attachment_image_src($attachment_id, array(830,341));
						echo '<a href="' . $img[0] . '" title="' . $attachment->post_content . '" alt="' . $attachment->post_content . '">';
						echo wp_get_attachment_image( $attachment_id, array(125,125) );
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
				
				<!--<div class="photo-num">(<?= count($images);?> total photos)</div>-->
										
				<script type="text/javascript" charset="utf-8">
					var maxPhoto = <?php echo (count($images) - 4); ?>;
				</script>
			</div>
			<? } ?>
		</div>	
                <div id="listing-side-attributes-wrapper" > 				
                    <div class="listing-header" id="listing-side-attributes">
                            <div class="headline">
                            <?php $address = get_post_meta($post->ID, 'listing_address', true); ?>
                            <?php $city = get_post_meta($post->ID, 'listing_city', true); ?>
                        <?php $state = get_post_meta($post->ID, 'listing_state', true); ?>
                        <?php $zip = get_post_meta($post->ID, 'listing_zip', true); ?>
                                            <h1  class="address"><?php echo $address ?></h1>
                        <div class="city"><?php echo $city ?></div>
                        <div class="state"><?php echo "$state,$zip" ?></div>

                        <div class="price">
                            Offered at $<?php echo number_format(get_post_meta($post->ID, 'listing_price', true)); ?>
                        </div>

                                    <div class="clear"></div>
                            </div>



                            <div class="data">






                                    <div class="data-item listing-details-sf">
                                    
                                        <span>
                                            <?php echo get_post_meta($post->ID, 'listing_sqft', true); ?> sf
                                        </span>    
                                    </div>
                                    <div class="data-item listing-details-garage">
                                    
                                     <span><?php echo get_post_meta($post->ID, 'listing_garage', true); ?></span>   
                                    </div>
                                    <div class="data-item listing-details-beds">
                                        
                                     <span><?php echo get_post_meta($post->ID, 'listing_bedrooms', true); ?> beds</span></div>
                                    <div class="data-item listing-details-baths">
                                   <span><?php echo get_post_meta($post->ID, 'listing_bathrooms', true); ?> baths</span>
                    </div>
                                    <?
                                    $address = get_post_meta($post->ID, 'listing_address', true) . ", " . get_post_meta($post->ID, 'listing_city', true) . " CA, ".get_post_meta($post->ID, 'listing_zip', true);
                                    ?>
                            </div>

                            <div class="buttons">
                                        <a  data-toggle="modal" data-target="#myModal-register"  href="<?= get_bloginfo('url');?>/forms/more-info/?address=<?= urlencode($post->post_title);?>&iframe=true&width=450&height=500" class="listing-get-more-image cta-button" title="" >
                                        </a>
                                    <? if(get_post_meta($post->ID, 'listing_tour', true)) { ?>
                                        <a rel="external nofollow" class="listing-tour-image cta-button"  href="<?php echo get_post_meta($post->ID, 'listing_tour', true); ?>" target="_blank">
                                        </a>
                                    <? } ?>

                                    <!--&showdate=true-->
                                    <a data-toggle="modal" data-target="#myModal-schedule"  href="<?= get_bloginfo('url');?>/forms/schedule-showing/?address=<?= urlencode($post->post_title);?>&iframe=true&width=450&height=510" class="listing-schedule-image cta-button" title="" >
                                    </a>
                                    <a  data-toggle="modal" data-target="#myModal-report" href="<?= get_bloginfo('url');?>/forms/detailed-report/?address=<?= urlencode($post->post_title);?>&url=<?= get_bloginfo('url') . $_SERVER['REQUEST_URI'];?>&city=<?php echo get_post_meta($post->ID, 'listing_city', true); ?>" class="listing-report-image cta-button" title="">
                                    </a>

                            </div>
                    </div>
                </div>    
		<div class="clear"></div>	
        <h1 class="title-single-listing"><?php the_title() ?></h1>
        				
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
        
			<div class="detail ev"><label>Listing Price:</label> <?php echo get_post_meta($post->ID, 'listing_price', true); ?></div>
			<div class="detail ev"><label>Status:</label> <?php echo get_post_meta($post->ID, 'listing_status', true); ?></div>
			<div class="detail od"><label>Address:</label> <?php echo get_post_meta($post->ID, 'listing_address', true); ?></div>
			<div class="detail od"><label>MLS #:</label> <?php echo get_post_meta($post->ID, 'listing_mls', true); ?></div>
			<div class="detail ev"><label>City:</label> <?php echo get_post_meta($post->ID, 'listing_city', true); ?></div>
			<div class="detail ev"><label>Square Feet:</label> <?php echo get_post_meta($post->ID, 'listing_sqft', true); ?></div>
			<div class="detail od"><label>State:</label> <?php echo get_post_meta($post->ID, 'listing_state', true); ?></div>
			<div class="detail od"><label>Bedrooms:</label> <?php echo get_post_meta($post->ID, 'listing_bedrooms', true); ?></div>
			<div class="detail ev"><label>Zip Code:</label> <?php echo get_post_meta($post->ID, 'listing_zip', true); ?></div>
			<div class="detail ev"><label>Bathrooms:</label> <?php echo get_post_meta($post->ID, 'listing_bathrooms', true); ?></div>
			<div class="detail od"><label>County:</label> <?php echo get_post_meta($post->ID, 'listing_county', true); ?></div>
			<div class="detail od"><label>Garage:</label> <?php echo get_post_meta($post->ID, 'listing_garage', true); ?></div>
			
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

		<div id="listing-about" style="">
			<h2 class="h2-border" style="margin-bottom:0">About The Area</h2>
			<ul class="tab-nav">
				<li><a href="#aa-map" class="active">Map</a></li>
				
				
			</ul>
			
<?php 
			$address = get_post_meta($post->ID, 'listing_address', true); 
			$city = get_post_meta($post->ID, 'listing_city', true);
			$state = get_post_meta($post->ID, 'listing_state', true);
			$zip = get_post_meta($post->ID, 'listing_zip', true);
			$lookup = urlencode($address . ' ' . $city . ',' . $state . ' ' . $zip);
?>

			<div id="aa-map" class="tab-box">
				<iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=<?php echo $lookup; ?>&amp;ie=UTF8&amp;hq=&amp;hnear=<?php echo $lookup; ?>&amp;z=14&amp;output=embed"></iframe>
			</div>

			

			
			

		</div>
        <div style="clear:both; height:10px;"></div>

<?php

$TEST = isset($_GET["test"])?1:NULL;


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
		"showlargerphotos"	=> "true"
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
	
	
	
	 if (!empty($TEST))
	{
		$apiRequestParams["query.Cities"] = '';
		$apiRequestParams["query.Communities"] ='';
		$apiRequestParams["query.ZipCodes"]='92660'; 
		
	}
	
	$apiHttpResponse = dsSearchAgent_ApiRequest::FetchData("Results", $apiRequestParams);

	if ( !strstr($apiHttpResponse['body'], "Sorry, but") ) {
?>
	<!-- design does not includde this part -->
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
		
		var offset = 120;
		var currPhoto = 0;
		var howmany = 0;
		var max_width=0;
			$('#photos a').each(function(){
				
				max_width+= $(this).width();
				 howmany++;
			});
			
			
		if (howmany<4)
		$("#photos").css("width",520);
		else
		$("#photos").css("width",max_width);
		
		$("#arrow-right").click(function(){
			if (currPhoto < maxPhoto) {
				jQuery(".photos").animate({"left": "-=130px"}, "slow");
				currPhoto++;
			}
		});

		$("#arrow-left").click(function(){
			if (currPhoto > 0) {
				jQuery(".photos").animate({"left": "+=130px"}, "slow");
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
			//event.preventDefault();
			$('ul.tab-nav li a').removeClass('active');
			$(this).addClass('active');
			$('.tab-box').hide();
			//alert();
			$($(this).attr('href')).show();
			return false; 
		});
		
	});
</script>

<script type="text/javascript">
	jQuery(function($){
	
			
		
 			$("a.prettyPhoto2").prettyPhoto({social_tools:''});/**/
		
		
    });
</script>

</div><!--  ends wrapper -->	
<?php get_footer(); ?>