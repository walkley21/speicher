<?php if ( is_active_sidebar( 'sidebar-widget' ) ) : ?>
        <div id="secondary" class="widget-area-sidebar" role="complementary">
                <?php dynamic_sidebar( 'sidebar-widget' ); ?>
        </div><!-- #secondary -->
<?php endif; ?>