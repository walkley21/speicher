<?php

class Tribus_Featured_Category extends WP_Widget {
	
	var $options = array(
		'widget_title' => 'Featured Category',
		'category_id' => ''
	);

	function __construct() {
		$widget_ops = array( 'classname' => 'widget-featured-category', 'description' => __("Feature posts from a category to be displayed on the Tribus Agent Theme.") );
		parent::__construct('featured_category', __('Tribus Featured Category'), $widget_ops);
	}
	
	function widget( $args, $current ) {
		extract( $args );
		$current = array_merge($this->options, $current);
		
		$cats = new WP_Query( array( 'cat' => $current['category_id'], 'posts_per_page' => 2 ) );
		if ( $cats->have_posts() ) :
			echo $before_widget;
			echo $before_title . $current['widget_title'] . $after_title;
			echo '<div class="excerpts">';
			while ( $cats->have_posts() ) :
				$cats->the_post();
?>
			<div class="excerpt">
				<?php if ( has_post_thumbnail() ) the_post_thumbnail('blog_preview'); ?>
				<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<p><?php the_excerpt(); ?></p>
			</div>
<?php
			endwhile;
			echo '<br class="clear"/></div><!-- end excerpts -->';
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

		<p><label for="<?php echo $this->get_field_id('widget_title'); ?>"><?php _e( 'Featured Category Section Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('widget_title'); ?>" name="<?php echo $this->get_field_name('widget_title'); ?>" type="text" value="<?php echo $current['widget_title']; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('category_id'); ?>"><?php _e( 'Featured Category:' ); ?></label>
		<?php wp_dropdown_categories(array('name' => $this->get_field_name('category_id'), 'id' => $this->get_field_id('category_id'), 'selected' => $current['category_id'])); ?></p>	
			
<?php
	}
	
}


