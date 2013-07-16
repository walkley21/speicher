<?php get_header(); ?>


<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<h2 class="title"><?php the_title(); ?></h2>
<br />
	<?php the_content('Read the rest of this entry &raquo;'); ?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>