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

<div class="clear" style="height:20px;"></div>

<?php 
		global $current_page, $wp_query;
		if ( $current_page < $wp_query->max_num_pages ) {
			$prev = $current_page + 1;
			echo '<p align="left" style="width:200px;float:left;"><a href="/blog/page/' . $prev . '">&laquo; Previous Entries</a></p>';
		}
		if ( $current_page > 1 ) {
			$next = $current_page - 1;
			echo '<p align="right" style="width:200px;float:right;"><a href="/blog/page/' . $next . '">Next Entries &raquo;</a></p>';
		}
?>

<div class="clear"></div>

<?php else : ?>

	<h2 class="center">Not Found</h2>
	<p class="center">Sorry, but you are looking for something that isn't here.</p>

<?php endif; ?>

<?php get_footer(); ?>