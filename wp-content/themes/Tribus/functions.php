<?php

/** Remove wordpress info in head of document **/
remove_action('wp_head', 'wp_generator');

/** Create main navigation menu **/
register_nav_menus( 
	array(
		'primary' => 'Primary Navigation',
		'communities' => 'Featured Communities'
	) 
);

/** Register Sidebars **/
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


/** Post thumbnails for post previews on home page **/
add_theme_support('post-thumbnails', array( 'post', 'page', 'listing', 'community', 'market' ));
add_image_size('blog_preview', 175, 115, true);
add_image_size('blog_roll', 250, 164, true);
add_image_size('tiny_listing', 50, 30, true);
add_image_size('listings', 150, 150, true);
add_image_size('community', 200, 190, true);
add_image_size('single_listing', 365, 274, true);
add_theme_support( 'automatic-feed-links' );


function tribus_add_scripts() {
	/** Add scripts and styles **/
	wp_enqueue_style('yui-autocomplete', get_bloginfo('template_url') . '/css/autocomplete.css');
	wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'tribus_add_scripts');


/** Add Custom Login **/
function my_custom_login_logo() {
    echo '<style type="text/css">
        h1 a { background-image:url(http://tripressrealestate.com/wp-content/uploads/2012/07/TribusRealEstateWP.png) !important; }
    </style>';
}

add_action('login_head', 'my_custom_login_logo');
