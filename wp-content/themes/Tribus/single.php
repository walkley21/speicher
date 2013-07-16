<?php get_header(); ?>


<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<h2 class="title"><?php the_title(); ?></h2>
	<div class="byline">
		<?php the_time('F jS, Y') ?> by <a href="<?php bloginfo('url'); ?>/author/<?= the_author_meta('user_login');?>"><?php the_author_meta('first_name'); ?> <?php the_author_meta('last_name'); ?></a>
		<br />Categories: <?php the_category(', ') ?>
		<br />Comments: <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?>
	</div>
	<?php the_content('Read the rest of this entry &raquo;'); ?>
	
	<p class="postmetadata alt">
		<small>
			This entry was posted
		
			on <?php the_time('l, F jS, Y') ?> at <?php the_time() ?>
			and is filed under <?php the_category(', ') ?>.
			You can follow any responses to this entry through the <?php comments_rss_link('RSS 2.0'); ?> feed. 

			<?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
				// Both Comments and Pings are open ?>
				You can <a href="#respond">leave a response</a>, or <a href="<?php trackback_url(true); ?>" rel="trackback">trackback</a> from your own site.

			<?php } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
				// Only Pings are Open ?>
				Responses are currently closed, but you can <a href="<?php trackback_url(true); ?> " rel="trackback">trackback</a> from your own site.

			<?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
				// Comments are open, Pings are not ?>
				You can skip to the end and leave a response. Pinging is currently not allowed.

			<?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
				// Neither Comments, nor Pings are open ?>
				Both comments and pings are currently closed.

			<?php }  ?>

		</small>
	</p>

<?php comments_template(); ?>

<?php endwhile; ?>

	<p align="left"><?php next_posts_link('&laquo; Previous Entries') ?></p>
	<p align="right"><?php previous_posts_link('Next Entries &raquo;') ?></p>

<?php else : ?>

	<h2 class="center">Not Found</h2>
	<p class="center">Sorry, but you are looking for something that isn't here.</p>

<?php endif; ?>

<?php get_footer(); ?>