<?php

class Tribus_Featured_Communities_Version2 extends WP_Widget {
	
	var $options = array(
		'widget_title' => 'Featured Communities'
	);

	function __construct() {
		$widget_ops = array( 'classname' => 'widget-featured-communities-version2', 'description' => __("Feature Communities to be displayed on the Tribus Agent Theme. Use with Tripress Theme Version 2.") );
		parent::__construct('featured_communities_version2', __('Tribus Featured Communities Version 2'), $widget_ops);
	}
	
	function widget( $args, $current ) {
		extract( $args );
		$current = array_merge($this->options, $current);
		
		$comms = new WP_Query( array( 
			'post_type' => 'community', 
			'post_status' => 'publish', 
			'posts_per_page' => 5, 
			'orderby' => 'rand', 
			'meta_key' => 'featured_community', 
			'meta_value' => 1 
		) );
		
		if ( $comms->have_posts() ) :
			echo $before_widget;
			echo $before_title . $current['widget_title'] . $after_title;	?>
			<div class="container-fluid">
            <div class="row-fluid inner-communities-wrapper">
            
            <?php 		
			while ( $comms->have_posts() ) :
				$comms->the_post();
?>
				<div class="span2  comm">
					<a href="<?php the_permalink(); ?>"><?php if ( has_post_thumbnail() ) the_post_thumbnail('blog_preview'); ?></a>
                    <div class="comm-title-wrapper">
					<a class="comm-title"  href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </div>
				</div>
<?php
			endwhile;
                        ?>
                        <div class="span2  more-comm" id="">
                            <div id="see-more-communities">   
                           
                             <a href="<?php echo site_url(); ?>/communities">
                               <span class="Secondary-Font">View more</span>
                                Communities
                             </a>
                            </div> 
                       </div>
            </div>           
            </div>
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

		<p><label for="<?php echo $this->get_field_id('widget_title'); ?>"><?php _e( 'Featured Community Section Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('widget_title'); ?>" name="<?php echo $this->get_field_name('widget_title'); ?>" type="text" value="<?php echo $current['widget_title']; ?>" /></p>
		
		<p>This widget takes up to 5 featured communities and randomly displays the communities on the home page.</p>	
			
<?php
	}
	
}

