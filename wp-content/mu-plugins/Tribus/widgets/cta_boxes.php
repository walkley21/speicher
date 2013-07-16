<?php

class Tribus_Cta_Boxes extends WP_Widget {
	
	var $options = array(
		'widget_title' => 'More Info',
		'first_picture' => 'cta_house',
		'first_title' => 'Search Homes',
		'first_link' => '',
		'first_page' => '',
		'first_text' => 'Search all homes with our custom homes search.',
		'second_picture' => 'cta_buildings',
		'second_title' => 'Communities',
		'second_link' => '',
		'second_page' => '',
		'second_text' => 'Search all homes with our custom homes search.',
		'third_picture' => 'cta_search',
		'third_title' => 'Market Watch',
		'third_link' => '',
		'third_page' => '',
		'third_text' => 'Search all homes with our custom homes search.'
	);
	var $pictures = array(
		'cta_arrow' => 'Arrow',
		'cta_buildings' => 'Building',
		'cta_calc' => 'Calculator',
		'cta_calendar' => 'Calendar',
		'cta_chart' => 'Chart',
		'cta_chat' => 'Chat Bubble',
		'cta_house' => 'House',
		'cta_mail' => 'Envelope',
		'cta_mobile' => 'Cell Phone',
		'cta_pencil' => 'Pencil',
		'cta_search' => 'Magnifying Glass',
		'cta_stats' => 'Graph',
		'cta_tag' => 'Tag',
		'cta_value' => 'Value'
	);
	
	function __construct() {
		$widget_opts = array( 'classname' => 'widget-ctas', 'description' => __("A custom set of call to action widgets designed for the Tribus Agent Theme.") );
		$control_opts = array( 'width' => 300, 'height' => 350 );
		parent::__construct('cta_boxes', __('Tribus Call To Actions Boxes Homepage'), $widget_opts, $control_opts);
	}
	
	function widget( $args, $current ) {
		extract( $args );
		$current = array_merge($this->options, $current);
		
		echo $before_widget;
		echo $before_title . $current['widget_title'] . $after_title;
		
		$link1 = ( !empty( $current['first_link'] ) ) ? $current['first_link'] : get_permalink($current['first_page']);
		$link2 = ( !empty( $current['second_link'] ) ) ? $current['second_link'] : get_permalink($current['second_page']);
		$link3 = ( !empty( $current['third_link'] ) ) ? $current['third_link'] : get_permalink($current['third_page']);
		
?>
		<div class="cta">

			<div class="cta-item <?php echo $current['first_picture']; ?>">
				<div class="icon"></div>
				<h3><a href="<?php echo $link1; ?>"><?php echo $current['first_title']; ?></a></h3>
				<p><?php echo $current['first_text']; ?></p>
			</div>

			<div class="cta-item <?php echo $current['second_picture']; ?>">
				<div class="icon"></div>
				<h3><a href="<?php echo $link2; ?>"><?php echo $current['second_title']; ?></a></h3>
				<p><?php echo $current['second_text']; ?></p>
			</div>

			<div class="cta-item last <?php echo $current['third_picture']; ?>">
				<div class="icon"></div>
				<h3><a href="<?php echo $link3; ?>"><?php echo $current['third_title']; ?></a></h3>
				<p><?php echo $current['third_text']; ?></p>
			</div>

		</div>
		
<?php
		echo $after_widget;
	}
	
	function update( $new, $old ) {
		$current = array_merge($this->options, $old, $new);
		return $current;
	}
	
	function form( $current ) {
		$current = array_merge($this->options, $current);
?>

		<p><label for="<?php echo $this->get_field_id('widget_title'); ?>"><?php _e( 'CTA Section Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('widget_title'); ?>" name="<?php echo $this->get_field_name('widget_title'); ?>" type="text" value="<?php echo $current['widget_title']; ?>" /></p>
		
		
		
		<p><label for="<?php echo $this->get_field_id('first_picture'); ?>"><?php _e( 'First CTA Picture:' ); ?></label>
		<select id="<?php echo $this->get_field_id('first_picture'); ?>" name="<?php echo $this->get_field_name('first_picture'); ?>">
			<?php foreach ( $this->pictures as $img => $name ) : ?>
				<option value="<?php echo $img; ?>" <?php if ( $img == $current['first_picture'] ) { echo 'selected'; } ?>><?php echo $name; ?></option>
			<?php endforeach; ?>
		</select>
		
		<p><label for="<?php echo $this->get_field_id('first_title'); ?>"><?php _e( 'First CTA Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('first_title'); ?>" name="<?php echo $this->get_field_name('first_title'); ?>" type="text" value="<?php echo $current['first_title']; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('first_page'); ?>"><?php _e( 'Connect CTA To A Page:' ); ?></label>
		<?php wp_dropdown_pages(array('name' => $this->get_field_name('first_page'), 'id' => $this->get_field_id('first_page'), 'selected' => $current['first_page'])); ?></p>	
			
		<p><label for="<?php echo $this->get_field_id('first_link'); ?>"><?php _e( 'Or Create A Custom Link:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('first_link'); ?>" name="<?php echo $this->get_field_name('first_link'); ?>" type="text" value="<?php echo $current['first_link']; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('first_text'); ?>"><?php _e( 'First CTA Text:' ); ?></label>
		<textarea class="widefat" id="<?php echo $this->get_field_id('first_text'); ?>" name="<?php echo $this->get_field_name('first_text'); ?>"><?php echo $current['first_text']; ?></textarea></p>
		
		
		
		
		<p><label for="<?php echo $this->get_field_id('second_picture'); ?>"><?php _e( 'Second CTA Picture:' ); ?></label>
		<select id="<?php echo $this->get_field_id('second_picture'); ?>" name="<?php echo $this->get_field_name('second_picture'); ?>">
			<?php foreach ( $this->pictures as $img => $name ) : ?>
				<option value="<?php echo $img; ?>" <?php if ( $img == $current['second_picture'] ) { echo 'selected'; } ?>><?php echo $name; ?></option>
			<?php endforeach; ?>
		</select>
		
		<p><label for="<?php echo $this->get_field_id('second_title'); ?>"><?php _e( 'Second CTA Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('second_title'); ?>" name="<?php echo $this->get_field_name('second_title'); ?>" type="text" value="<?php echo $current['second_title']; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('second_page'); ?>"><?php _e( 'Connect CTA To A Page:' ); ?></label>
		<?php wp_dropdown_pages(array('name' => $this->get_field_name('second_page'), 'id' => $this->get_field_id('second_page'), 'selected' => $current['second_page'])); ?></p>
			
		<p><label for="<?php echo $this->get_field_id('second_link'); ?>"><?php _e( 'Or Create A Custom Link:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('second_link'); ?>" name="<?php echo $this->get_field_name('second_link'); ?>" type="text" value="<?php echo $current['second_link']; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('second_text'); ?>"><?php _e( 'Second CTA Text:' ); ?></label>
		<textarea class="widefat" id="<?php echo $this->get_field_id('second_text'); ?>" name="<?php echo $this->get_field_name('second_text'); ?>"><?php echo $current['second_text']; ?></textarea></p>
		
		
		
		
		<p><label for="<?php echo $this->get_field_id('third_picture'); ?>"><?php _e( 'Third CTA Picture:' ); ?></label>
		<select id="<?php echo $this->get_field_id('third_picture'); ?>" name="<?php echo $this->get_field_name('third_picture'); ?>">
			<?php foreach ( $this->pictures as $img => $name ) : ?>
				<option value="<?php echo $img; ?>" <?php if ( $img == $current['third_picture'] ) { echo 'selected'; } ?>><?php echo $name; ?></option>
			<?php endforeach; ?>
		</select>
		
		<p><label for="<?php echo $this->get_field_id('third_title'); ?>"><?php _e( 'Third CTA Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('third_title'); ?>" name="<?php echo $this->get_field_name('third_title'); ?>" type="text" value="<?php echo $current['third_title']; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('third_page'); ?>"><?php _e( 'Connect CTA To A Page:' ); ?></label>
		<?php wp_dropdown_pages(array('name' => $this->get_field_name('third_page'), 'id' => $this->get_field_id('third_page'), 'selected' => $current['third_page'])); ?></p>
		
		<p><label for="<?php echo $this->get_field_id('third_link'); ?>"><?php _e( 'Or Create A Custom Link:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('third_link'); ?>" name="<?php echo $this->get_field_name('third_link'); ?>" type="text" value="<?php echo $current['third_link']; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('third_text'); ?>"><?php _e( 'Third CTA Text:' ); ?></label>
		<textarea class="widefat" id="<?php echo $this->get_field_id('third_text'); ?>" name="<?php echo $this->get_field_name('third_text'); ?>"><?php echo $current['third_text']; ?></textarea></p>
		

<?php
	}
	
}

class Tribus_Cta_Boxes_Sidebar extends WP_Widget {
    
    var $options = array(
        'widget_title' => 'More Info',
        'first_picture' => 'cta_house',
        'first_title' => 'Search Homes',
        'first_link' => '',
        'first_page' => '',
        'first_text' => 'Search all homes with our custom homes search.',
        'second_picture' => 'cta_buildings',
        'second_title' => 'Communities',
        'second_link' => '',
        'second_page' => '',
        'second_text' => 'Search all homes with our custom homes search.',
        'third_picture' => 'cta_search',
        'third_title' => 'Market Watch',
        'third_link' => '',
        'third_page' => '',
        'third_text' => 'Search all homes with our custom homes search.'
    );
    var $pictures = array(
        'cta_arrow' => 'Arrow',
        'cta_buildings' => 'Building',
        'cta_calc' => 'Calculator',
        'cta_calendar' => 'Calendar',
        'cta_chart' => 'Chart',
        'cta_chat' => 'Chat Bubble',
        'cta_house' => 'House',
        'cta_mail' => 'Envelope',
        'cta_mobile' => 'Cell Phone',
        'cta_pencil' => 'Pencil',
        'cta_search' => 'Magnifying Glass',
        'cta_stats' => 'Graph',
        'cta_tag' => 'Tag',
        'cta_value' => 'Value'
    );
    
    function __construct() {
        $widget_opts = array( 'classname' => 'widget-ctas', 'description' => __("A custom set of call to action widgets designed for the Tribus Agent Theme.") );
        $control_opts = array( 'width' => 300, 'height' => 350 );
        parent::__construct('cta_boxes_sidebar', __('Tribus Call To Actions Boxes Sidebar'), $widget_opts, $control_opts);
    }
    
    function widget( $args, $current ) {
        extract( $args );
        $current = array_merge($this->options, $current);
        
        echo $before_widget;
        echo $before_title . $current['widget_title'] . $after_title;
        
        $link1 = ( !empty( $current['first_link'] ) ) ? $current['first_link'] : get_permalink($current['first_page']);
        $link2 = ( !empty( $current['second_link'] ) ) ? $current['second_link'] : get_permalink($current['second_page']);
        $link3 = ( !empty( $current['third_link'] ) ) ? $current['third_link'] : get_permalink($current['third_page']);
        
?>
        <div class="cta-side"  id="buttonsvertical">

            <div class="cta-item <?php echo $current['first_picture']; ?>">
                <div class="icon"></div>
                <h3><a href="<?php echo $link1; ?>"><?php echo $current['first_title']; ?></a></h3>
                <p><?php echo $current['first_text']; ?></p>
            </div>

            <div class="cta-item <?php echo $current['second_picture']; ?>">
                <div class="icon"></div>
                <h3><a href="<?php echo $link2; ?>"><?php echo $current['second_title']; ?></a></h3>
                <p><?php echo $current['second_text']; ?></p>
            </div>

            <div class="cta-item last <?php echo $current['third_picture']; ?> another-last" >
                <div class="icon"></div>
                <h3><a href="<?php echo $link3; ?>"><?php echo $current['third_title']; ?></a></h3>
                <p><?php echo $current['third_text']; ?></p>
            </div>

        </div>
        <div id="buttonsvertical_bottom" style="clear:both"  class="this_is_injected_within_the_plugin"></div>
        
<?php
        echo $after_widget;
    }
    
    function update( $new, $old ) {
        $current = array_merge($this->options, $old, $new);
        return $current;
    }
    
    function form( $current ) {
        $current = array_merge($this->options, $current);
?>

        <p><label for="<?php echo $this->get_field_id('widget_title'); ?>"><?php _e( 'CTA Section Title:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('widget_title'); ?>" name="<?php echo $this->get_field_name('widget_title'); ?>" type="text" value="<?php echo $current['widget_title']; ?>" />
        </p>
        
        
        
        <p><label for="<?php echo $this->get_field_id('first_picture'); ?>"><?php _e( 'First CTA Picture:' ); ?></label>
        <select id="<?php echo $this->get_field_id('first_picture'); ?>" name="<?php echo $this->get_field_name('first_picture'); ?>">
            <?php foreach ( $this->pictures as $img => $name ) : ?>
                <option value="<?php echo $img; ?>" <?php if ( $img == $current['first_picture'] ) { echo 'selected'; } ?>><?php echo $name; ?></option>
            <?php endforeach; ?>
        </select>
        
        <p><label for="<?php echo $this->get_field_id('first_title'); ?>"><?php _e( 'First CTA Title:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('first_title'); ?>" name="<?php echo $this->get_field_name('first_title'); ?>" type="text" value="<?php echo $current['first_title']; ?>" /></p>
        
        <p><label for="<?php echo $this->get_field_id('first_page'); ?>"><?php _e( 'Connect CTA To A Page:' ); ?></label>
        <?php wp_dropdown_pages(array('name' => $this->get_field_name('first_page'), 'id' => $this->get_field_id('first_page'), 'selected' => $current['first_page'])); ?></p>    
            
        <p><label for="<?php echo $this->get_field_id('first_link'); ?>"><?php _e( 'Or Create A Custom Link:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('first_link'); ?>" name="<?php echo $this->get_field_name('first_link'); ?>" type="text" value="<?php echo $current['first_link']; ?>" /></p>
        
        <p><label for="<?php echo $this->get_field_id('first_text'); ?>"><?php _e( 'First CTA Text:' ); ?></label>
        <textarea class="widefat" id="<?php echo $this->get_field_id('first_text'); ?>" name="<?php echo $this->get_field_name('first_text'); ?>"><?php echo $current['first_text']; ?></textarea></p>
        
        
        
        
        <p><label for="<?php echo $this->get_field_id('second_picture'); ?>"><?php _e( 'Second CTA Picture:' ); ?></label>
        <select id="<?php echo $this->get_field_id('second_picture'); ?>" name="<?php echo $this->get_field_name('second_picture'); ?>">
            <?php foreach ( $this->pictures as $img => $name ) : ?>
                <option value="<?php echo $img; ?>" <?php if ( $img == $current['second_picture'] ) { echo 'selected'; } ?>><?php echo $name; ?></option>
            <?php endforeach; ?>
        </select>
        
        <p><label for="<?php echo $this->get_field_id('second_title'); ?>"><?php _e( 'Second CTA Title:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('second_title'); ?>" name="<?php echo $this->get_field_name('second_title'); ?>" type="text" value="<?php echo $current['second_title']; ?>" /></p>
        
        <p><label for="<?php echo $this->get_field_id('second_page'); ?>"><?php _e( 'Connect CTA To A Page:' ); ?></label>
        <?php wp_dropdown_pages(array('name' => $this->get_field_name('second_page'), 'id' => $this->get_field_id('second_page'), 'selected' => $current['second_page'])); ?></p>
            
        <p><label for="<?php echo $this->get_field_id('second_link'); ?>"><?php _e( 'Or Create A Custom Link:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('second_link'); ?>" name="<?php echo $this->get_field_name('second_link'); ?>" type="text" value="<?php echo $current['second_link']; ?>" /></p>
        
        <p><label for="<?php echo $this->get_field_id('second_text'); ?>"><?php _e( 'Second CTA Text:' ); ?></label>
        <textarea class="widefat" id="<?php echo $this->get_field_id('second_text'); ?>" name="<?php echo $this->get_field_name('second_text'); ?>"><?php echo $current['second_text']; ?></textarea></p>
        
        
        
        
        <p><label for="<?php echo $this->get_field_id('third_picture'); ?>"><?php _e( 'Third CTA Picture:' ); ?></label>
        <select id="<?php echo $this->get_field_id('third_picture'); ?>" name="<?php echo $this->get_field_name('third_picture'); ?>">
            <?php foreach ( $this->pictures as $img => $name ) : ?>
                <option value="<?php echo $img; ?>" <?php if ( $img == $current['third_picture'] ) { echo 'selected'; } ?>><?php echo $name; ?></option>
            <?php endforeach; ?>
        </select>
        
        <p><label for="<?php echo $this->get_field_id('third_title'); ?>"><?php _e( 'Third CTA Title:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('third_title'); ?>" name="<?php echo $this->get_field_name('third_title'); ?>" type="text" value="<?php echo $current['third_title']; ?>" /></p>
        
        <p><label for="<?php echo $this->get_field_id('third_page'); ?>"><?php _e( 'Connect CTA To A Page:' ); ?></label>
        <?php wp_dropdown_pages(array('name' => $this->get_field_name('third_page'), 'id' => $this->get_field_id('third_page'), 'selected' => $current['third_page'])); ?></p>
        
        <p><label for="<?php echo $this->get_field_id('third_link'); ?>"><?php _e( 'Or Create A Custom Link:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('third_link'); ?>" name="<?php echo $this->get_field_name('third_link'); ?>" type="text" value="<?php echo $current['third_link']; ?>" /></p>
        
        <p><label for="<?php echo $this->get_field_id('third_text'); ?>"><?php _e( 'Third CTA Text:' ); ?></label>
        <textarea class="widefat" id="<?php echo $this->get_field_id('third_text'); ?>" name="<?php echo $this->get_field_name('third_text'); ?>"><?php echo $current['third_text']; ?></textarea></p>
        

<?php
    }
    
}



/*-----------------------  over slider --------------*/

class Tribus_Cta_Boxes_Slider extends WP_Widget {
    
   
   var $options = array(
		'widget_title' => 'More Info',
		'first_picture' => 'cta_search',
		'first_title' => 'Search Homes',
		'first_link' => '/listings',
		'first_page' => '',
		'first_text' => 'View available homes for sale with our custom homes search.',
		
		'second_picture' => 'cta_buildings',
		'second_title' => 'Communities',
		'second_link' => '/communities/',
		'second_page' => '',
		'second_text' => 'Local area information, shopping, events, parks, and schools.',
		
		'third_picture' => 'cta_chat',
		'third_title' => 'Real Estate News',
		'third_link' => ' /blog/',
		'third_page' => '',
		'third_text' => 'Read up to date community news, market reports, and more!'
	);
   
    var $pictures = array(
        'cta_arrow' => 'Arrow',
        'cta_buildings' => 'Building',
        'cta_calc' => 'Calculator',
        'cta_calendar' => 'Calendar',
        'cta_chart' => 'Chart',
        'cta_chat' => 'Chat Bubble',
        'cta_house' => 'House',
        'cta_mail' => 'Envelope',
        'cta_mobile' => 'Cell Phone',
        'cta_pencil' => 'Pencil',
        'cta_search' => 'Magnifying Glass',
        'cta_stats' => 'Graph',
        'cta_tag' => 'Tag',
        'cta_value' => 'Value'
    );
    
    function __construct() {
        $widget_opts = array( 'classname' => 'widget-ctas', 'description' => __("A custom set of call to action buttons to display over the slider.") );
        $control_opts = array( 'width' => 300, 'height' => 350 );
        parent::__construct('cta_boxes_slider', __('Tribus Call To Actions Boxes over Slider'), $widget_opts, $control_opts);
    }
    
    function widget( $args, $current ) {
        extract( $args );
        $current = array_merge($this->options, $current);
        
        echo $before_widget;
        echo $before_title . $current['widget_title'] . $after_title;
        
        $link1 = ( !empty( $current['first_link'] ) ) ? $current['first_link'] : get_permalink($current['first_page']);
        $link2 = ( !empty( $current['second_link'] ) ) ? $current['second_link'] : get_permalink($current['second_page']);
        $link3 = ( !empty( $current['third_link'] ) ) ? $current['third_link'] : get_permalink($current['third_page']);
        
?>
        <div class="cta-slider"  id="buttonsvertical">
			<a href="<?php echo $link1; ?>">
            <div class="cta-slider-item <?php echo $current['first_picture']; ?>">
                <div class="icon"></div>
                <h3><?php echo $current['first_title']; ?></h3>
                <p><?php echo $current['first_text']; ?></p>
            </div>
            </a>
			<a href="<?php echo $link2; ?>">
            <div class="cta-slider-item <?php echo $current['second_picture']; ?>">
                <div class="icon"></div>
                <h3><?php echo $current['second_title']; ?></h3>
                <p><?php echo $current['second_text']; ?></p>
            </div>
			</a>

			<a href="<?php echo $link3; ?>">
            <div class="cta-slider-item last <?php echo $current['third_picture']; ?> another-last" >
                <div class="icon"></div>
                <h3><?php echo $current['third_title']; ?></h3>
                <p><?php echo $current['third_text']; ?></p>
            </div>
			</a>
            
        </div>
        <div id="buttonsvertical_bottom" style="clear:both"  class="this_is_injected_within_the_plugin"></div>
        
<?php
        echo $after_widget;
    }
    
    function update( $new, $old ) {
        $current = array_merge($this->options, $old, $new);
        return $current;
    }
    
    function form( $current ) {
        $current = array_merge($this->options, $current);
?>

        <p><label for="<?php echo $this->get_field_id('widget_title'); ?>"><?php _e( 'CTA Section Title:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('widget_title'); ?>" name="<?php echo $this->get_field_name('widget_title'); ?>" type="text" value="<?php echo $current['widget_title']; ?>" />
        </p>
        
        
        
        <p><label for="<?php echo $this->get_field_id('first_picture'); ?>"><?php _e( 'First CTA Picture:' ); ?></label>
        <select id="<?php echo $this->get_field_id('first_picture'); ?>" name="<?php echo $this->get_field_name('first_picture'); ?>">
            <?php foreach ( $this->pictures as $img => $name ) : ?>
                <option value="<?php echo $img; ?>" <?php if ( $img == $current['first_picture'] ) { echo 'selected'; } ?>><?php echo $name; ?></option>
            <?php endforeach; ?>
        </select>
        
        <p><label for="<?php echo $this->get_field_id('first_title'); ?>"><?php _e( 'First CTA Title:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('first_title'); ?>" name="<?php echo $this->get_field_name('first_title'); ?>" type="text" value="<?php echo $current['first_title']; ?>" /></p>
        
        <p><label for="<?php echo $this->get_field_id('first_page'); ?>"><?php _e( 'Connect CTA To A Page:' ); ?></label>
        <?php wp_dropdown_pages(array('name' => $this->get_field_name('first_page'), 'id' => $this->get_field_id('first_page'), 'selected' => $current['first_page'])); ?></p>    
            
        <p><label for="<?php echo $this->get_field_id('first_link'); ?>"><?php _e( 'Or Create A Custom Link:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('first_link'); ?>" name="<?php echo $this->get_field_name('first_link'); ?>" type="text" value="<?php echo $current['first_link']; ?>" /></p>
        
        <p><label for="<?php echo $this->get_field_id('first_text'); ?>"><?php _e( 'First CTA Text:' ); ?></label>
        <textarea class="widefat" id="<?php echo $this->get_field_id('first_text'); ?>" name="<?php echo $this->get_field_name('first_text'); ?>"><?php echo $current['first_text']; ?></textarea></p>
        
        
        
        
        <p><label for="<?php echo $this->get_field_id('second_picture'); ?>"><?php _e( 'Second CTA Picture:' ); ?></label>
        <select id="<?php echo $this->get_field_id('second_picture'); ?>" name="<?php echo $this->get_field_name('second_picture'); ?>">
            <?php foreach ( $this->pictures as $img => $name ) : ?>
                <option value="<?php echo $img; ?>" <?php if ( $img == $current['second_picture'] ) { echo 'selected'; } ?>><?php echo $name; ?></option>
            <?php endforeach; ?>
        </select>
        
        <p><label for="<?php echo $this->get_field_id('second_title'); ?>"><?php _e( 'Second CTA Title:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('second_title'); ?>" name="<?php echo $this->get_field_name('second_title'); ?>" type="text" value="<?php echo $current['second_title']; ?>" /></p>
        
        <p><label for="<?php echo $this->get_field_id('second_page'); ?>"><?php _e( 'Connect CTA To A Page:' ); ?></label>
        <?php wp_dropdown_pages(array('name' => $this->get_field_name('second_page'), 'id' => $this->get_field_id('second_page'), 'selected' => $current['second_page'])); ?></p>
            
        <p><label for="<?php echo $this->get_field_id('second_link'); ?>"><?php _e( 'Or Create A Custom Link:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('second_link'); ?>" name="<?php echo $this->get_field_name('second_link'); ?>" type="text" value="<?php echo $current['second_link']; ?>" /></p>
        
        <p><label for="<?php echo $this->get_field_id('second_text'); ?>"><?php _e( 'Second CTA Text:' ); ?></label>
        <textarea class="widefat" id="<?php echo $this->get_field_id('second_text'); ?>" name="<?php echo $this->get_field_name('second_text'); ?>"><?php echo $current['second_text']; ?></textarea></p>
        
        
        
        
        <p><label for="<?php echo $this->get_field_id('third_picture'); ?>"><?php _e( 'Third CTA Picture:' ); ?></label>
        <select id="<?php echo $this->get_field_id('third_picture'); ?>" name="<?php echo $this->get_field_name('third_picture'); ?>">
            <?php foreach ( $this->pictures as $img => $name ) : ?>
                <option value="<?php echo $img; ?>" <?php if ( $img == $current['third_picture'] ) { echo 'selected'; } ?>><?php echo $name; ?></option>
            <?php endforeach; ?>
        </select>
        
        <p><label for="<?php echo $this->get_field_id('third_title'); ?>"><?php _e( 'Third CTA Title:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('third_title'); ?>" name="<?php echo $this->get_field_name('third_title'); ?>" type="text" value="<?php echo $current['third_title']; ?>" /></p>
        
        <p><label for="<?php echo $this->get_field_id('third_page'); ?>"><?php _e( 'Connect CTA To A Page:' ); ?></label>
        <?php wp_dropdown_pages(array('name' => $this->get_field_name('third_page'), 'id' => $this->get_field_id('third_page'), 'selected' => $current['third_page'])); ?></p>
        
        <p><label for="<?php echo $this->get_field_id('third_link'); ?>"><?php _e( 'Or Create A Custom Link:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('third_link'); ?>" name="<?php echo $this->get_field_name('third_link'); ?>" type="text" value="<?php echo $current['third_link']; ?>" /></p>
        
        <p><label for="<?php echo $this->get_field_id('third_text'); ?>"><?php _e( 'Third CTA Text:' ); ?></label>
        <textarea class="widefat" id="<?php echo $this->get_field_id('third_text'); ?>" name="<?php echo $this->get_field_name('third_text'); ?>"><?php echo $current['third_text']; ?></textarea></p>
        

<?php
    }
    
}
