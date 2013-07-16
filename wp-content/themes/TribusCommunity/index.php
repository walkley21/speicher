<?php get_header(); ?>


<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
	<div class="byline">
		<?php the_time('F jS, Y') ?> by <a href="<?php bloginfo('url'); ?>/author/<?php the_author_nickname(); ?>"><?php the_author_meta('first_name'); ?> <?php the_author_meta('last_name'); ?></a>
		<br />Categories: <?php the_category(', ') ?>
		<br />Comments: <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?>
	</div>
	<?php the_content('Read the rest of this entry &raquo;'); ?>

<?php endwhile; ?>

	<p align="left"><?php next_posts_link('&laquo; Previous Entries') ?></p>
	<p align="right"><?php previous_posts_link('Next Entries &raquo;') ?></p>

<?php else : ?>

	<h2 class="center">Not Found</h2>
	<p class="center">Sorry, but you are looking for something that isn't here.</p>

<?php endif; ?>

<?php get_footer(); ?>