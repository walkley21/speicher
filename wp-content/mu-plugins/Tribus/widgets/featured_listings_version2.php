<?php

class Tribus_Featured_Listings_Version2 extends WP_Widget {
	
	var $options = array(
		'widget_title' => 'Featured Listings'
	);
	
	function __construct() {
		$widget_ops = array( 'classname' => 'widget-featured-listings-version2', 'description' => __("Feature certain listings to be displayed on the Tribus Agent Theme. Use with Tripress Theme Version 2.") );
		parent::__construct('featured_listings_version2', __('Tribus Featured Listings V2'), $widget_ops);
	}
	
	function widget( $args, $current ) {
		extract( $args );
		$current = array_merge($this->options, $current);
		
               
                
		$this->new_version($current,$before_title,$after_title,$before_widget,$after_widget);
		
	}
        function new_version($current,$before_title,$after_title,$before_widget,$after_widget)
        {
            
                
            
             $listings = new WP_Query( array( 
			'post_type' => 'listing', 
			'post_status' => 'publish', 
			'posts_per_page' => 7, 
			'orderby' => 'rand', 
			'meta_key' => 'featured_listing', 
			'meta_value' => 1 
		) );
		
		if ( $listings->have_posts() ) :
			$data = array();
			while ( $listings->have_posts() ) :
				$listings->the_post();
				$price = (float) get_post_meta(get_the_ID(), 'listing_price', true);
				$data[] = array(
					'address' 		=> get_post_meta(get_the_ID(), 'listing_address', true),
					'price'			=> '$' . number_format( $price ),
					'beds'			=> get_post_meta(get_the_ID(), 'listing_bedrooms', true),
					'baths'			=> get_post_meta(get_the_ID(), 'listing_bathrooms', true),
					'info'			=> get_post_meta(get_the_ID(), 'other_listing_info', true),
					'large_image'	=> get_the_post_thumbnail(get_the_ID(), 'main_listing'),
					'small_image'	=> get_the_post_thumbnail(get_the_ID(), 'tiny_listing'),
					'permalink'		=> get_permalink(get_the_ID())
				);
			endwhile;
                 endif;       
            ?>
                <div id="featured-listing-widget-outter-wrapper">
                <div class="featured-listing-widget-inner-wrapper">
                    <?php 
					$data_elements = array();
                    
                      //   echo "[[[[$before_title]]]]";
                        echo $before_widget."";
			echo $before_title.$current['widget_title'] .''. 
                        ' <span class="more">
                            <a href="/listings">View More Listings</a>
                          </span>' . $after_title;
                        if(!empty($data))
                        foreach($data as $k=>$property)
                        {
                            if ($k==0)
                            {
                                $data_elements[$k]= $this->createLarge($property);
                            }
                            else
                            {
								
                                $data_elements[$k] =$this->createSmall($property);
								
                            }
                        }
                       
						if (isset($data_elements[0]))
								echo $data_elements[0];
						echo "<div class='row-fluid'>";
						echo "<div class='span6'>";
								if (isset($data_elements[1]))
								echo $data_elements[1];
								if (isset($data_elements[2]))
								echo $data_elements[2];
								if (isset($data_elements[3]))
								echo $data_elements[3];
								
								
								
						echo "</div>";
						echo "<div class='span6'>";
						
								if (isset($data_elements[4]))
								echo $data_elements[4];
								if (isset($data_elements[5]))
								echo $data_elements[5];
								if (isset($data_elements[6]))
								echo $data_elements[6];
						
						echo "</div>";
						
						echo "</div>";

						
                        echo $after_widget;
			wp_reset_postdata();
                    ?>
                </div>
              </div>
            <?php     
        }
        function old_version($current)
        {
            $listings = new WP_Query( array( 
			'post_type' => 'listing', 
			'post_status' => 'publish', 
			'posts_per_page' => 8, 
			'orderby' => 'rand', 
			'meta_key' => 'featured_listing', 
			'meta_value' => 1 
		) );
		
		if ( $listings->have_posts() ) :
			echo $before_widget;
			echo $before_title . $current['widget_title'] . ' <span class="more"><a href="/listings">View More</a></span>' . $after_title;
			$data = array();
			while ( $listings->have_posts() ) :
				$listings->the_post();
				$price = (float) get_post_meta(get_the_ID(), 'listing_price', true);
				$data[] = array(
					'address' 		=> get_post_meta(get_the_ID(), 'listing_address', true),
					'price'			=> '$' . number_format( $price ),
					'beds'			=> get_post_meta(get_the_ID(), 'listing_bedrooms', true),
					'baths'			=> get_post_meta(get_the_ID(), 'listing_bathrooms', true),
					'info'			=> get_post_meta(get_the_ID(), 'other_listing_info', true),
					'large_image'	=> get_the_post_thumbnail(get_the_ID(), 'blog_preview'),
					'small_image'	=> get_the_post_thumbnail(get_the_ID(), 'tiny_listing'),
					'permalink'		=> get_permalink(get_the_ID())
				);
			endwhile;
?>
			<?php if ( isset($data[0]) && !empty($data[0]) ) : ?>
			<table class="single">
				<tr>
					<th scope="col">&nbsp;</th>
					<th scope="col">Address</th>
					<th scope="col">Price</th>
					<th scope="col">Beds</th>
					<th scope="col">Baths</th>
				</tr>
				<tr>
					<td rowspan="2"><a href="<?php echo $data[0]['permalink']; ?>"><?php echo $data[0]['large_image']; ?></a></td>
					<td class="first"><a href="<?php echo $data[0]['permalink']; ?>"><strong><?php echo $data[0]['address']; ?></strong></a></td>
					<td class="first"><?php echo $data[0]['price']; ?></td>
					<td class="first"><?php echo $data[0]['beds'];  ?></td>
					<td class="first"><?php echo $data[0]['baths']; ?></td>
				</tr>
				<tr>
					<td colspan="4"  class="second"><?php echo $data[0]['info']; ?></td>
				</tr>
			</table>
			<?php endif; ?>
			
			<?php if ( isset($data[1]) && !empty($data[1]) ) : ?>
			<table>
				<tr>
					<th scope="col">&nbsp;</th>
					<th scope="col">Address</th>
					<th scope="col">Price</th>
					<th scope="col">Beds</th>
					<th scope="col">Baths</th>
					<th scope="col">&nbsp;</th>
					<?php if ( isset($data[2]) && !empty($data[2]) ) : ?>
					<th scope="col">&nbsp;</th>
					<th scope="col">Address</th>
					<th scope="col">Price</th>
					<th scope="col">Beds</th>
					<th scope="col">Baths</th>
					<?php endif; ?>
				</tr>
				<tr>
					<td><a href="<?php echo $data[1]['permalink']; ?>"><?php echo $data[1]['small_image']; ?></a></td>
					<td><a href="<?php echo $data[1]['permalink']; ?>"><?php echo $data[1]['address']; ?></a></td>
					<td><?php echo $data[1]['price']; ?></td>
					<td><?php echo $data[1]['beds']; ?></td>
					<td><?php echo $data[1]['baths']; ?></td>
					<td>&nbsp;</td>
					
					<?php if ( isset($data[2]) && !empty($data[2]) ) : ?>
						<td><a href="<?php echo $data[2]['permalink']; ?>"><?php echo $data[2]['small_image']; ?></a></td>
						<td><a href="<?php echo $data[2]['permalink']; ?>"><?php echo $data[2]['address']; ?></a></td>
						<td><?php echo $data[2]['price']; ?></td>
						<td><?php echo $data[2]['beds']; ?></td>
						<td><?php echo $data[2]['baths']; ?></td>
					<?php endif; ?>
				
				</tr>
				
				<?php if ( isset($data[3]) && !empty($data[3]) ) : ?>
				<tr>
					<td><a href="<?php echo $data[3]['permalink']; ?>"><?php echo $data[3]['small_image']; ?></a></td>
					<td><a href="<?php echo $data[3]['permalink']; ?>"><?php echo $data[3]['address']; ?></a></td>
					<td><?php echo $data[3]['price']; ?></td>
					<td><?php echo $data[3]['beds']; ?></td>
					<td><?php echo $data[3]['baths']; ?></td>
					<td>&nbsp;</td>
					
					<?php if ( isset($data[4]) && !empty($data[4]) ) : ?>
						<td><a href="<?php echo $data[4]['permalink']; ?>"><?php echo $data[4]['small_image']; ?></a></td>
						<td><a href="<?php echo $data[4]['permalink']; ?>"><?php echo $data[4]['address']; ?></a></td>
						<td><?php echo $data[4]['price']; ?></td>
						<td><?php echo $data[4]['beds']; ?></td>
						<td><?php echo $data[4]['baths']; ?></td>
					<?php endif; ?>
				
				</tr>
				<?php endif; ?>
				
				<?php if ( isset($data[5]) && !empty($data[5]) ) : ?>
				<tr>
					<td><a href="<?php echo $data[5]['permalink']; ?>"><?php echo $data[5]['small_image']; ?></a></td>
					<td><a href="<?php echo $data[5]['permalink']; ?>"><?php echo $data[5]['address']; ?></a></td>
					<td><?php echo $data[5]['price']; ?></td>
					<td><?php echo $data[5]['beds']; ?></td>
					<td><?php echo $data[5]['baths']; ?></td>
					<td>&nbsp;</td>
					
					<?php if ( isset($data[6]) && !empty($data[6]) ) : ?>
						<td><a href="<?php echo $data[6]['permalink']; ?>"><?php echo $data[6]['small_image']; ?></a></td>
						<td><a href="<?php echo $data[6]['permalink']; ?>"><?php echo $data[6]['address']; ?></a></td>
						<td><?php echo $data[6]['price']; ?></td>
						<td><?php echo $data[6]['beds']; ?></td>
						<td><?php echo $data[6]['baths']; ?></td>
					<?php endif; ?>
				
				</tr>
				<?php endif; ?>
			
			</table>
			<?php endif; ?>
			
<?php
			echo $after_widget;
			wp_reset_postdata();
		endif;
            
            
        }
	
	function update( $new, $old ) {
		$current = array_merge($this->options, $old, $new);
		return $current;
	}
	
	function form( $current ) {
		$current = array_merge($this->options, $current);
?>
		<p><label for="<?php echo $this->get_field_id('widget_title'); ?>"><?php _e( 'Featured Listings Section Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('widget_title'); ?>" name="<?php echo $this->get_field_name('widget_title'); ?>" type="text" value="<?php echo $current['widget_title']; ?>" /></p>
		
		<p>This widget takes up to 7 featured listings and randomly displays the listings on the home page.</p>	
			
<?php
	}
        
        function createLarge($property)
        {
            
          
           $string ='<div id="primary-listing ">';
            $string.='<ul class="primary-listing-ul row-fluid" >
                        <li class="prim-large-wrapper span3">
							<a href="'.$property['permalink'].'">'.$property['large_image'].'</a>
						</li>
                        <li class="secondary-main-listing span2">
                            <div id="address-beds-baths">
                               <div id="main-listing-address">
                                   <a id="main-listing-address-anchor" href="'.$property['permalink'].'">'.$property['address'].'</a>
                                       
                               </div>
                               <div>
                                   <span id="main-listing-beds">'.$property['beds'].' Beds </span>
                                   <span id="main-baths-address">'.$property['baths'].' Baths </span>
                               </div>
                            </div>
                        </li>
                        <li class="secondary-main-listing span4 pull-left"><div id="main-listing-description">
                            '.$property['info'].'
                        </div></li>
                        <li class="secondary-main-listing span3 pull-right  view-more-link-container">
                            <div id="main-listing-price">'.$property['price'].' </div>
							<a class="pull-right" id="view-more-link" href="'.$property['permalink'].'">View More</a>
                        </li>
                     </ul>';  
           $string.=''; 
           $string.='</div><div style="clear:both;"></div>';
           
           
           return $string;
        }
        function createSmall($property)
        {
           // print_R($property);
            
            if (empty($property)) return;
            
           		$string = '<div class="listing-features-wrapper row-fluid">';
					$string.='<div class="span2">';
					$string.= '<a href="'.$property['permalink'].'">'.$property['small_image'].'</a>';
					$string.='</div>';
					$string.='<div class="span4">';
					$string.='<a class="listing-small-address" href="'.$property['permalink'].'">'.$property['address'].'</a>';
					$string.="</div>";
               		 $string.='<div class="span2">'.$property['beds'].' Beds</div>';
                	 $string.='<div class="span2 baths">'.$property['baths'].' Baths</div>';
               		 $string.='<div class="span2 price">'.$property['price'].'</div>';
                $string.="</div>";
				
				
        
            
            return $string;
            
        }
}

