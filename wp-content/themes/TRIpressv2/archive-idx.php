<?php
/*
Template Name: dsIDXpress Results Page
*/
?>

<?php get_header(); ?>

<div id="idx-results-archive">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<h2 class="title"><?php the_title(); ?></h2>
	
	<?php the_content(); ?>

<?php endwhile; endif; ?>
</div>
<?php get_footer(); ?>
