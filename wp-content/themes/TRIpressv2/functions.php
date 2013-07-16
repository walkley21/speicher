<?php

//echo "<h1>Tema<h1>";

/** Remove wordpress info in head of document **/
remove_action('wp_head', 'wp_generator');

/** Create main navigation menu **/
register_nav_menus( 
	array(
		'primary' => 'Primary Navigation',
		'communities' => 'Featured Communities'
	) 
);


/***--- ***/
class Bootstrap_Walker_Nav_Menu extends Walker_Nav_Menu {
 
	
	function start_lvl( &$output, $depth ) {
		
		//In a child UL, add the 'dropdown-menu' class
		$indent = str_repeat( "\t", $depth );
		$output	   .= "\n$indent<ul class=\"dropdown-menu\">\n";
		
	}
 
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
 
		$li_attributes = '';
		$class_names = $value = '';
 
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		
		//Add class and attribute to LI element that contains a submenu UL.
		if ($args->has_children){
			$classes[] 		= 'dropdown';
			$li_attributes .= 'data-dropdown="dropdown"';
		}
		$classes[] = 'menu-item-' . $item->ID;
		//If we are on the current page, add the active class to that menu item.
		$classes[] = ($item->current) ? 'active' : '';
 
		//Make sure you still add all of the WordPress classes.
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';
 
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
 
		$output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';
 
		//Add attributes to link element.
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		$attributes .= ($args->has_children) ? ' class="dropdown-toggle" data-toggle="dropdown"' : ''; 
 
		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= ($args->has_children) ? ' <b class="caret"></b> ' : ''; 
		$item_output .= '</a>';
		$item_output .= $args->after;
 
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
 
	//Overwrite display_element function to add has_children attribute. Not needed in >= Wordpress 3.4
	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
		
		if ( !$element )
			return;
		
		$id_field = $this->db_fields['id'];
 
		//display this element
		if ( is_array( $args[0] ) ) 
			$args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );
		else if ( is_object( $args[0] ) ) 
			$args[0]->has_children = ! empty( $children_elements[$element->$id_field] ); 
		$cb_args = array_merge( array(&$output, $element, $depth), $args);
		call_user_func_array(array(&$this, 'start_el'), $cb_args);
 
		$id = $element->$id_field;
 
		// descend only when the depth is right and there are childrens for this element
		if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {
 
			foreach( $children_elements[ $id ] as $child ){
 
				if ( !isset($newlevel) ) {
					$newlevel = true;
					//start the child delimiter
					$cb_args = array_merge( array(&$output, $depth), $args);
					call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
				}
				$this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
			}
				unset( $children_elements[ $id ] );
		}
 
		if ( isset($newlevel) && $newlevel ){
			//end the child delimiter
			$cb_args = array_merge( array(&$output, $depth), $args);
			call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
		}
 
		//end this element
		$cb_args = array_merge( array(&$output, $element, $depth), $args);
		call_user_func_array(array(&$this, 'end_el'), $cb_args);
		
	}
	
}
 

/***---***/


/** Register Sidebars **/

function twentytwelve_widgets_init(){

register_sidebar(
	array(
		'name' => 'Home Page',
		'id' => 'home-page-widget',
		'description' => 'Home Page Widgets',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h3 class="section">',
		'after_title' => '</h3>'
	) 
);

register_sidebar(
	array(
		'name' => 'Horizontal Search ',
		'id' => 'horizontal-search',
		'description' => 'Horizontal seearch area for non-home-page pages',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h3 class="section">',
		'after_title' => '</h3>'
	) 
);

/** Register Sidebars **/
register_sidebar(
	array(
		'name' => 'Details Page Widget Area',
		'id' => 'details-page-widget-area',
		'description' => 'Widget for the Details Page',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h3 class="section">',
		'after_title' => '</h3>'
	) 
);



register_sidebar(
	array(
		'name' => 'CTA buttons over Slider',
		'id' => 'cta-over-slider-widget',
		'description' => 'Exclusively for CTA buttons over slider',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h3 class="section">',
		'after_title' => '</h3>'
	) 
);

register_sidebar(
	array(
		'name' => 'Search Form over Slider',
		'id' => 'search-form-over-slider-widget',
		'description' => 'Exclusively for search form over slider',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h3 class="section">',
		'after_title' => '</h3>'
	) 
);

register_sidebar( 
	array(
		'name' => 'Sidebar',
		'id' => 'sidebar-widget',
		'description' => 'Sidebar on Blog',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	)
);

register_sidebar( 
  array(
    'name' => 'Search Form Area',
    'id' => 'search-form-area-widget',
    'description' => 'Search form area if form is hidden',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
  )
);

$active_widgets = get_option( 'sidebars_widgets' );



if ( ! empty ( $active_widgets['home-page-widget'] ))
{   // Okay, no fun anymore. There is already some content.
	//echo "there is some content already";
    return;
}
else
{
/*automatically load the features communities and the featured listings to the home page  */



$counter=2;
$active_widgets[ 'home-page-widget' ][0] = 'featured_listings_version2-' . $counter;
$demo_widget_content[ $counter ] = array ( 'title' => 'The second instance of our amazing demo widget.' );
update_option( 'widget_featured_listings_version2', $demo_widget_content );
//update_option( 'sidebars_widgets', $active_widgets );

$counter++;

$active_widgets[ 'home-page-widget' ][1] = 'featured_communities_version2-' . $counter;
$demo_widget_content[ $counter ] = array ( 'title' => 'The second instance of our amazing demo widget.' );
update_option( 'widget_featured_communities_version2', $demo_widget_content );
update_option( 'sidebars_widgets', $active_widgets );

}


}
add_action( 'widgets_init', 'twentytwelve_widgets_init' );

/** Post thumbnails for post previews on home page **/
add_theme_support('post-thumbnails', array( 'post', 'page', 'listing', 'community', 'market','posting' ));
add_image_size('blog_preview', 175, 115, true);
add_image_size('blog_roll', 250, 164, true);
add_image_size('tiny_listing', 50, 30, true);
add_image_size('listings', 150, 150, true);
add_image_size('community', 200, 190, true);
add_image_size('single_listing', 365, 274, true);
/*required by postings*/
add_image_size('single_posting', 400,300, true);
add_image_size('main_listing', 290,150, true);

add_theme_support( 'automatic-feed-links' );

wp_deregister_script('jquery');

function tribus_add_scripts() {
    
    global $wp_styles;
	
	
	
	
	/** Add scripts and styles **/
	//wp_enqueue_style('yui-autocomplete', get_bloginfo('template_url') . '/css/autocomplete.css');
	
     //   wp_dequeue_script('jquery');
    wp_dequeue_script('jquery');
	wp_dequeue_script('jquery-ui-core');

    wp_enqueue_script('jquery','http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js');
	wp_enqueue_script( 'twentytwelve-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0', true );

       // wp_enqueue_script('prettyPhoto', get_template_directory_uri() . '/js/prettyphoto/jquery.prettyPhoto.js', array(), '3.1.5', true );
    
        
        wp_enqueue_script('flexslider',get_bloginfo('template_url').'/js/rotator/jquery.flexslider-min.js');
        wp_enqueue_script('easing',get_bloginfo('template_url').'/js/rotator/jquery.easing.js');
        wp_enqueue_script('mousewheel',get_bloginfo('template_url').'/js/rotator/jquery.mousewheel.js');
        wp_enqueue_script('demo',get_bloginfo('template_url').'/js/rotator/demo.js');
        
       // wp_enqueue_script('menu',get_bloginfo('template_url').'/js/menu/menu2.js');
        wp_enqueue_script('menu',get_bloginfo('template_url').'/js/navigation.js');
        
        wp_enqueue_script('size',get_bloginfo('template_url').'/js/size.js');
       wp_enqueue_script('scripts',get_bloginfo('template_url').'/js/scripts.js');
       
        
      
       // wp_enqueue_style('prettyPhotoCss', get_bloginfo('template_url') . '/css/prettyPhoto.css');
        
    
	   wp_enqueue_style('bootstrap', get_bloginfo('template_url') . '/bootstrap/css/bootstrap.min.css');
       wp_enqueue_style('bootstrapresponsive', get_bloginfo('template_url') . '/bootstrap/css/bootstrap-responsive.min.css');
       wp_enqueue_style('bootstrapdatepicker', get_bloginfo('template_url') . '/bootstrap/css/datepicker.css');
        
       
	
        
        
}      


add_action('wp_enqueue_scripts', 'tribus_add_scripts');


/** Add Custom Login **/
function my_custom_login_logo() {
    echo '<style type="text/css">
        h1 a { background-image:url(http://tripressrealestate.com/wp-content/uploads/2012/07/TribusRealEstateWP.png) !important; }
    </style>';
}

add_action('login_head', 'my_custom_login_logo');



/*used to retrive the photos and other MLS info*/
require_once("dom.php");


/*  POSTINGS RELATED */

function my_admin_notice(){
    global $pagenow,$typenow;
    if ( (($pagenow == 'post-new.php') || ($pagenow == 'post.php')) and ($typenow == 'posting'))
        {
        ?>

             <SCRIPT TYPE="text/javascript">
            jQuery(document).ready(function(){
                var myDiv = jQuery('<div>');
                myDiv.css("border","1px solid #55B3E6");
                myDiv.css("padding","5px");
                myDiv.css("background","#E0F4FF");
                myDiv.css("width","99%");
                myDiv.html("Each MLS has different rules, before using this tool, please check to make sure the features offered are allowed by your MLS.");
                jQuery(".wrap").find("h2").after(myDiv);
                });
            </SCRIPT>
            

        <?php
    }
}
//add_action('admin_notices', 'my_admin_notice');
/* end postings related*/




function new_excerpt_more($more) {
       global $post;
       global $is_my_home; 
       //echo "[[[$is_my_home]]]";
       $moreLabel = 'read more';
       if ( $is_my_home )
       $moreLabel = '...';    
       
	return ' <a class="moretag" href="'. get_permalink($post->ID) . '">'.$moreLabel.'</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');



function custom_excerpt_length() {
 global $is_my_home;
 if ( $is_my_home )
 {
    return 40;
 }
 else return 100;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


/*---- it wasnt background , it was just adjacent images 
add_theme_support( 'custom-background', array(
        'default-color' => 'ffffff',
) );
----*/



function get_the_post_thumbnail_src($img)
{
  return (preg_match('~\bsrc="([^"]++)"~', $img, $matches)) ? $matches[1] : '';
}

function homepagelistings()
{

 
 	    $listings = new WP_Query( array( 
			'post_type' => 'listing', 
			'post_status' => 'publish', 
			'posts_per_page' => 7, 
			'orderby' => 'rand', 
			'meta_key' => 'featured_listing', 
			'meta_value' => 1 
		) );
		
		if ( $listings->have_posts() )
		{
			$data = array();
			while ( $listings->have_posts() ) 
			{
				$listings->the_post();
				$price = (float) get_post_meta(get_the_ID(), 'listing_price', true);
				
				$source = trim(get_the_post_thumbnail_src(get_the_post_thumbnail(get_the_ID(), 'main_listing')));
			
			
				$data[] = array(
					'address' 		=> get_post_meta(get_the_ID(), 'listing_address', true),
					'price'			=> '$' . number_format( $price ),
					'beds'			=> get_post_meta(get_the_ID(), 'listing_bedrooms', true),
					'baths'			=> get_post_meta(get_the_ID(), 'listing_bathrooms', true),
					'info'			=> get_post_meta(get_the_ID(), 'other_listing_info', true),
					'large_image'	=> get_the_post_thumbnail(get_the_ID(), 'main_listing'),
					'source'	=> $source,
					'small_image'	=> get_the_post_thumbnail(get_the_ID(), 'tiny_listing'),
					'permalink'		=> get_permalink(get_the_ID())
				);
			}
		}
       
	   return $data;
	
}

/*disable the help toool bar, replaceit with custom help page  */

function custom_admin_js() {
    $url = get_option('siteurl');
    $url = get_bloginfo('template_directory') . '/js/wp-admin.js';

    echo '"<script type="text/javascript" src="'. $url . '"></script>"';
}
add_action('admin_footer', 'custom_admin_js');

/*add authir teleophine nubmer*/


/*user profile tel*/


add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );

function my_show_extra_profile_fields( $user ) { ?>

	<h3>Extra profile information</h3>

	<table class="form-table">

		<tr>
			<th><label for="twitter">Phone</label></th>

			<td>
				<input type="text" name="phone" id="phone" value="<?php echo esc_attr( get_the_author_meta( 'phone', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your telephone number.</span>
			</td>
		</tr>

	</table>
<?php }


add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );

function my_save_extra_profile_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

	/* Copy and paste this line for additional fields. Make sure to change 'twitter' to the field ID. */
	update_usermeta( $user_id, 'phone', $_POST['phone'] );
}


/*automatically enable the communitiues widget */


