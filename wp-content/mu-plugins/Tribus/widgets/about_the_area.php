<?php

class About_The_Area extends WP_Widget {

	function About_The_Area() {
		$widget_ops = array('description' => __("About The Area") );
		$this->WP_Widget('About_The_Area', __('About The Area'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$text = apply_filters( 'widget_text', $instance['text'] );
		$link = $instance['link'];
		echo $before_widget;
		
		//wp_reset_query();
		global $post;
		
		if(!$args['city']) { ?>
		<h2>About The Area</h2>
		<? } ?>
		<div class="about-area">
			<ul class="nav">
				<li id="about-area-static-1" style="display:none;"><a href="Javascript:doToggle(1);">map</a></li>
				<li id="about-area-hilite-1" class="hilite" style="">map</li>
				
				<li id="about-area-static-2" style=""><a href="Javascript:doToggle(2);">parks</a></li>
				<li id="about-area-hilite-2" style="display:none;" class="hilite">parks</li>
				
				<li id="about-area-static-3" style=""><a href="Javascript:doToggle(3);">schools</a></li>
				<li id="about-area-hilite-3" style="display:none;" class="hilite">schools</li>
				
				
				<li id="about-area-static-4" style=""><a href="Javascript:doToggle(4);"><? if(!$args['community']) { ?>community<? } ?></a></li>
				<li id="about-area-hilite-4" style="display:none;" class="hilite">community</li>
				

				<li id="about-area-static-5" style=""><a href="Javascript:doToggle(5);">market stats</a></li>
				<li id="about-area-hilite-5" style="display:none;" class="hilite">market stats</li>
			</ul>
			
			<div class="map" id="about-area-1" style="">
				<?php
				if($args['city']) //this is a community page
				{
					$address = $args['city']. ", CA";
					$width = 600;
					$height = 380;
				}
				else if(!$post->zip) //this is a listing page
				{ 
				$address = urlencode(str_replace(",", " ", get_post_meta($post->ID, 'listing_address', true)));
				$address .= "+" . urlencode(str_replace(",", " ", get_post_meta($post->ID, 'listing_city', true)));
				$address .= "+" . urlencode(get_post_meta($post->ID, 'listing_state', true));
				$address .= "+" . urlencode(get_post_meta($post->ID, 'listing_zip', true));
				$width = 600;
				$height = 380;
				}
				else //this is an idx listing page
				{
					$address = $post->street;
					$address .= "+" . $post->city;
					$address .= "+" . "CA";
					$address .= "+" . $post->zip;
					$width = 250;
					$height = 250;
				}
				?>
				<iframe width="<?= $width;?>" height="<?= $height;?>" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=<?php echo $address; ?>&amp;ie=UTF8&amp;hq=&amp;hnear=<?php echo $address; ?>&amp;z=14&amp;output=embed"></iframe>
				<? if($post->zip) { ?>
				<div class="search">
				<form action="" method="post">
					<input class="google-search" value="Get Directions" id="googleDirections"  onfocus="if (this.value == 'Get Directions') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Get Directions';}">
					<input name="submit" class="submit" type="button" onClick="sendToGoogle();" />
					<input type="hidden" id="googleEnd" value="<?= $address;?>">
				</form>
				</div>
				<? } ?>
			</div>
			
			<div class="parks" id="about-area-2" style="display:none;">
				<ul>
				<?php	
				$xmlUrl = "http://api.local.yahoo.com/LocalSearchService/V3/localSearch?appid=YahooDemo&location=";
				$xmlUrl .= urlencode(str_replace(",", " ", get_post_meta($post->ID, 'listing_address', true)));
				$xmlUrl .= "+" . urlencode(str_replace(",", " ", get_post_meta($post->ID, 'listing_city', true)));
				$xmlUrl .= "+" . urlencode(get_post_meta($post->ID, 'listing_state', true));
				$xmlUrl .= "+" . urlencode(get_post_meta($post->ID, 'listing_zip', true));
				$xmlUrl .= "&radius=1&query=Parks&category=&results=10";
				$xmlStr = file_get_contents($xmlUrl);
				$xmlObj = simplexml_load_string($xmlStr);
				$arrXml = objectsIntoArray($xmlObj);
				foreach($arrXml['Result'] as $item) {
					//error_log(print_r($item, 1));
					echo '<li><a href="' . $item['Url'] . '" target="_blank">'. $item['Title'] . '</a></li>';
				}
				?>
				</ul>
			</div>
			
			<div class="schools" id="about-area-3" style="display:none;">
				<ul>
				<?php	
				$xmlUrl = "http://api.local.yahoo.com/LocalSearchService/V3/localSearch?appid=YahooDemo&location=";
				$xmlUrl .= urlencode(str_replace(",", " ", get_post_meta($post->ID, 'listing_address', true)));
				$xmlUrl .= "+" . urlencode(str_replace(",", " ", get_post_meta($post->ID, 'listing_city', true)));
				$xmlUrl .= "+" . urlencode(get_post_meta($post->ID, 'listing_state', true));
				$xmlUrl .= "+" . urlencode(get_post_meta($post->ID, 'listing_zip', true));
				$xmlUrl .= "&radius=1&query=Schools&category=&results=10";
				$xmlStr = file_get_contents($xmlUrl);
				$xmlObj = simplexml_load_string($xmlStr);
				$arrXml = objectsIntoArray($xmlObj);
				foreach($arrXml['Result'] as $item) {
					echo '<li><a href="' . $item['Url'] . '" target="_blank">'. $item['Title'] . '</a></li>';
				}
				?>
				</ul>
			</div>
			
			<div class="community" id="about-area-4" style="display:none;">
				<?php	

				if($args['city']) //this is a community page
				{
					$city = $args['city'];
					$page = get_page_by_title($args['city']);
				}
				else if(!$post->zip) //this is a regular listing
				{
					$city = get_post_meta($post->ID, 'listing_city', true);
					$zip = get_post_meta($post->ID, 'listing_zip', true);
					$sz = "g";

					$cat = get_the_category($post->ID);
					$page = get_page_by_slug($cat[0]->slug);
				}
				else //this is an idx page
				{
					$city = trim($post->city);
					$zip = trim($post->zip);
					$sz = "s";

					$page = get_page_by_title($post->city);
				}

				$content = apply_filters('the_content', $page->post_content);
				echo "<div class=\"area-community-header\">". $page->post_title."</div>";
				echo trunc($content, 35);
				echo "<a href=\"". get_bloginfo('siteurl') ."/". $page->post_name."\" id=\"listing-read-more\">read more</a>";
				?>
			</div>

			<div class="market-stats" id="about-area-5" style="display:none;">

				<?
					if($args['city']) //this is a community page
					{
						$city = $args['city'];
						$zip = $args['zip'];
						$page = get_page_by_title($args['city']);
						$tempid = $page->ID;
						$sz = "l";
					}
					else if(!$post->zip) //this is a regular listing
					{
						$city = get_post_meta($post->ID, 'listing_city', true);
						$zip = get_post_meta($post->ID, 'listing_zip', true);
						$sz = "l";

						$cat = get_the_category($post->ID);
						$page = get_page_by_slug($cat[0]->slug);
						$tempid = $page->ID;
					}
					else //this is an idx page
					{
						$city = trim($post->city);
						$zip = trim($post->zip);
						$sz = "s";

						$page = get_page_by_title($post->city);
						$tempid = $page->ID;
					}

					
					?>
				<img src="http://charts.altosresearch.com/altos/app?s=inventory:r,median:l,&ra=c&q=a&st=CA&c=<?= $city;?>&z=<?= $zip;?>&sz=<?= $sz;?>&ts=e&rt=sf&service=chart&pai=53003254&co=0&endDate=&startDate=">
				<p class="stats-text"><?= nl2br(get_post_meta($tempid, 'stats_info', true));?></p>
			</div>
			
			<div class="break"></div>
		</div>
		<?php
		echo $after_widget;
	}
}

