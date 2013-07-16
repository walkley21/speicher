<?php 

class Tribus_Buttons extends WP_Widget {
    
    var $options = array(
        'widget_title' => '',
        'first_picture' => '',
        'first_title' => '',
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
    
    function __construct() {
        $widget_opts = array( 'classname' => 'widget-buttons', 'description' => __("Simple buttons to place on the bottom of the home page") );
        $control_opts = array( 'width' => 300, 'height' => 350 );
        parent::__construct('tribus_simple_buttons', __('Tribus Simple Buttons'), $widget_opts, $control_opts);
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
        <div class="container-fluid"  id="buttons-container">

        <div class="row-fluid" id="bottom-buttons" >
    
            <div id="bb-first" class="bbutton span4">
                <a href="<?php echo $link1; ?>"> 
                    <span class="title"><?php echo $current['first_title'] ?></span>
                    <span class="text"><?php echo $current['first_text']?></span>
                </a>
            </div>

            <div id="bb-second" class="bbutton span4"> 
                <a href="<?php echo $link2?>">
                   <span class="title">
                       <?php echo $current['second_title']?>
                   </span>
                    <span class="text">
                       <?php echo $current['second_text']?>
                    </span>
                </a>
            </div>
            <div id="bb-third"  class="bbutton span4">
                <a href="<?php echo $link3?>">
                    <span class="title"><?php echo $current['third_title']?></span>
                    <span class="text"><?php echo $current['third_text']?></span>
                </a>
            </div>
    
        </div>
            
        </div>  
        <div style="clear:both"></div>
        <br/>
        
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

       
        
        <p><label for="<?php echo $this->get_field_id('first_title'); ?>"><?php _e( 'First Title:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('first_title'); ?>" name="<?php echo $this->get_field_name('first_title'); ?>" type="text" value="<?php echo $current['first_title']; ?>" /></p>
        
        <p><label for="<?php echo $this->get_field_id('first_link'); ?>"><?php _e( 'First Link:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('first_link'); ?>" name="<?php echo $this->get_field_name('first_link'); ?>" type="text" value="<?php echo $current['first_link']; ?>" /></p>
        
        <p><label for="<?php echo $this->get_field_id('first_text'); ?>"><?php _e( 'First Text:' ); ?></label>
        <textarea class="widefat" id="<?php echo $this->get_field_id('first_text'); ?>" name="<?php echo $this->get_field_name('first_text'); ?>"><?php echo $current['first_text']; ?></textarea></p>
        
        
        
        
       
        
        <p><label for="<?php echo $this->get_field_id('second_title'); ?>"><?php _e( 'Second Title:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('second_title'); ?>" name="<?php echo $this->get_field_name('second_title'); ?>" type="text" value="<?php echo $current['second_title']; ?>" /></p>
        
             
        <p><label for="<?php echo $this->get_field_id('second_link'); ?>"><?php _e( 'Second Link:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('second_link'); ?>" name="<?php echo $this->get_field_name('second_link'); ?>" type="text" value="<?php echo $current['second_link']; ?>" /></p>
        
        <p><label for="<?php echo $this->get_field_id('second_text'); ?>"><?php _e( 'Second Text:' ); ?></label>
        <textarea class="widefat" id="<?php echo $this->get_field_id('second_text'); ?>" name="<?php echo $this->get_field_name('second_text'); ?>"><?php echo $current['second_text']; ?></textarea></p>
        
        
        <p><label for="<?php echo $this->get_field_id('third_title'); ?>"><?php _e( 'Third Title:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('third_title'); ?>" name="<?php echo $this->get_field_name('third_title'); ?>" type="text" value="<?php echo $current['third_title']; ?>" /></p>
        
       
        <p><label for="<?php echo $this->get_field_id('third_link'); ?>"><?php _e( 'Third Link:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('third_link'); ?>" name="<?php echo $this->get_field_name('third_link'); ?>" type="text" value="<?php echo $current['third_link']; ?>" /></p>
        
        <p><label for="<?php echo $this->get_field_id('third_text'); ?>"><?php _e( 'Third Text:' ); ?></label>
        <textarea class="widefat" id="<?php echo $this->get_field_id('third_text'); ?>" name="<?php echo $this->get_field_name('third_text'); ?>"><?php echo $current['third_text']; ?></textarea></p>
        

<?php
    }
    
}
