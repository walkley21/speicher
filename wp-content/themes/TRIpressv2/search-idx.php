<?php
/*
Template Name: dsIDXpress dsSearchAgent
*/
?>

<?php get_header('fullwidth-no-sidebar'); ?>


<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<h2 class="title"><?php the_title(); ?></h2>
	
	<?php the_content(); ?>

<?php endwhile; endif; ?>

<?php get_footer('no-sidebar'); ?>