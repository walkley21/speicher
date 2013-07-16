<?php get_header(); ?>
<div class="row-fluid">
<div id="regular-page" class="span9">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<h1 class="title"><?php the_title(); ?></h1>
<br />
	<?php the_content('Read the rest of this entry &raquo;'); ?>

<?php endwhile; endif; ?>
</div>
<div class="span3 side-bar-area">
<?php get_sidebar(); ?>
</div>
</div>
<div style="clear:both"></div>
<?php get_footer(); ?>