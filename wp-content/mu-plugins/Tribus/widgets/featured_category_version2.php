<?php

class Tribus_Featured_Category_Version2 extends WP_Widget {
	
	var $options = array(
		'widget_title' => 'Featured Category',
		'category_id' => ''
	);

	function __construct() {
		$widget_ops = array( 'classname' => 'widget-featured-category-version2', 'description' => __("Feature posts from a category to be displayed on the Tribus Agent Theme.Use with Tripress Version 2") );
		parent::__construct('featured_category_version2', __('Tribus Featured Category Version 2'), $widget_ops);
	}
	
	function widget( $args, $current ) {
		extract( $args );
		$current = array_merge($this->options, $current);
		//echo "[".$current['category_no']."]";
		
		$classes[1]['class']="span12";
		$classes[1]['size']="large";
		
		$classes[2]['class']="span6";
		$classes[2]['size']="medium";
		
		$classes[3]['class']="span4";
		$classes[3]['size']="medium";
		
		$classes[4]['class']="span3";
		$classes[4]['size']="medium";
		
		$classes[6]['class']="span2";
		$classes[6]['size']="medium";
		
		
		
		
		
		
		
                $numberofposts = $current['category_no'];
                if (empty($numberofposts)) $numberofposts = 2;
		$cats = new WP_Query( array( 'cat' => $current['category_id'], 'posts_per_page' =>$numberofposts ) );
	
		if ( $cats->have_posts() ) :
                        echo '<div  id="featured-category-wrapper"  class="container-fluid">';	
						echo '<div  class="container-fluid inner-category-wrapper">';	
                        echo $before_widget;
                        
			echo $before_title . $current['widget_title'] . $after_title;
			echo '<div class="excerpts row-fluid">';
			
			while ( $cats->have_posts() ) :
				$cats->the_post();
				
				
?>		
                <div class="excerpt <?php echo $classes[$numberofposts]['class']?>">
               
                
                    <?php if ( has_post_thumbnail() ) ?>
                                        <div class="featured-category-thumbnail">
                                        <a href="<?php the_permalink(); ?>" >    
                                            <?php the_post_thumbnail($classes[$numberofposts]['size']); ?>
                                        </a>    
                                        </div>
                    <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <p><?php the_excerpt(); ?></p>
               
                </div>
<?php
			
			endwhile;
			
			echo $after_widget;
                        echo '</div></div></div>';
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
		
                <p><label for="<?php echo $this->get_field_id('category_no'); ?>"><?php _e( 'Number of posts:' ); ?></label>
                    <select name="<?php echo $this->get_field_name('category_no') ?>" id="<?php echo $this->get_field_name('category_no') ?>">
                        <?php for($i=1; $i<=6;$i++):?>
                        <?php if ($i==5) continue; ?>
                        <option  <?php echo ($current['category_no']==$i)?'selected="selected"':'';  ?> value="<?php echo $i?>"><?php echo $i; ?></option>
                        <?php endfor;?>
                    </select>
                </p>	
			
<?php
	}
	
}


