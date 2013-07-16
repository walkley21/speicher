<?php

get_header();
if ( !dynamic_sidebar( 'home-page-widget' ) ) :
	include(TEMPLATEPATH . '/includes/more_info.php');
	include(TEMPLATEPATH . '/includes/post_preview.php');
	include(TEMPLATEPATH . '/includes/featured_listings.php');
	include(TEMPLATEPATH . '/includes/featured_communities.php');
endif;
get_footer();

?>