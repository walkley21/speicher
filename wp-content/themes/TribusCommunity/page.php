<?php get_header(); ?>



<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<h2 class="title"><?php the_title(); ?></h2>
	<!-- Place this tag where you want the +1 button to render -->
<div class="g-plusone" data-size="medium" data-annotation="none"></div>

<!-- Place this render call where appropriate -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
<br />
	<?php the_content('Read the rest of this entry &raquo;'); ?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>