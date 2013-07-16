<?php
get_header();

$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
query_posts( array( 'post_type' => 'listing', 'posts_per_page' => 8, 'caller_get_posts' => 1, 'paged' => $paged ) );

?>
<div id="page">
	<div id="listing-content" class="listings-page">

		<div id="listings-header">Featured Listings</div><br><br>
	
		<?php while ( have_posts() ) : the_post() ?>
		<div id="post-<?php the_ID() ?>" class="listings">
			<?
				$default_attr = array(
			'class'	=> "listings-img");
				
			 $terms = wp_get_post_terms( $post->ID, 'propertycategory');
			?>
			<?php the_post_thumbnail( array(180), $default_attr ); ?>
			<div class="listings-data">
				<h2 class="listings-title"><a href="<?php the_permalink() ?>" title="<?php the_title() ?>" rel="bookmark"><?php echo get_post_meta($post->ID, 'listing_address', true); ?>, <?php echo get_post_meta($post->ID, 'listing_city', true); ?>, <?php echo get_post_meta($post->ID, 'listing_state', true); ?></a></h2>
				<div class="details">
							<div class="detail"><label>Listing Price:</label> <?php echo get_post_meta($post->ID, 'listing_price', true); ?></div>
							<div class="detail"><label>Status:</label> <?php echo get_post_meta($post->ID, 'listing_status', true); ?></div>
							<div class="detail"><label>MLS #:</label> <?php echo get_post_meta($post->ID, 'listing_mls', true); ?></div>
							<div class="detail"><label>City:</label> <?php echo get_post_meta($post->ID, 'listing_city', true); ?></div>
							<div class="detail"><label>Square Feet:</label> <?php echo get_post_meta($post->ID, 'listing_sqft', true); ?></div>
							<div class="detail"><label>State:</label> <?php echo get_post_meta($post->ID, 'listing_state', true); ?></div>
							<div class="detail"><label>Bedrooms:</label> <?php echo get_post_meta($post->ID, 'listing_bedrooms', true); ?></div>
							<div class="detail"><label>Zip Code:</label> <?php echo get_post_meta($post->ID, 'listing_zip', true); ?></div>
							<div class="detail"><label>Bathrooms:</label> <?php echo get_post_meta($post->ID, 'listing_bathrooms', true); ?></div>
							<div class="detail"><label>County:</label> <?php echo get_post_meta($post->ID, 'listing_county', true); ?></div>
							<div class="detail"><label>Garage:</label> <?php echo get_post_meta($post->ID, 'listing_garage', true); ?></div>
							<div class="break"></div>
						</div>

				<?
				$features = get_the_terms($post->ID, 'feature');
				$terms = "";
				if($features)
				{
					foreach($features as $term)
					{
						$terms .= $term->name . ", ";
					}
					$terms = rtrim($terms, ", ");
				}
				?>
				<!--<div class="listings-info"><label>Features:</label> <?= $terms;  ?></div>-->
			</div>
			<div class="break"></div>
		</div><!-- .post -->
		<?php endwhile ?>

		<div class="navigation">
			<div class="navleft"><?php next_posts_link('&laquo; Older Posts', '0') ?></div>
			<div class="navright"><?php previous_posts_link('Newer Posts &raquo;', '0') ?></div>
		</div>

<?php get_footer(); ?>