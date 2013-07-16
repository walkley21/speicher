<?php get_header(); ?>

<h2 class="h2-border">Featured Communities</h2>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<div class="cat-item">
	
		<div class="cat-image">
			<?php if ( has_post_thumbnail() ) { ?>
				<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
					<?php the_post_thumbnail('community'); ?>
				</a>
			<?php } ?>
		</div>
		<div class="cat-info">
			<p class="first"><label><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></label></p>
			<?php the_content('Find out more about this community &raquo;'); ?>
		</div>
		<div class="clear"></div>
	
	</div>
	
<?php endwhile; ?>

	<p align="left"><?php next_posts_link('&laquo; Previous Entries') ?></p>
	<p align="right"><?php previous_posts_link('Next Entries &raquo;') ?></p>

<?php else : ?>

	<h2 class="center">Not Found</h2>
	<p class="center">Sorry, but you are looking for something that isn't here.</p>

<?php endif; ?>

<?php get_footer(); ?>