				</div> <!-- end blog -->
		
			</div><!-- end main -->

			<br class="clear"/>

		</div> <!-- end content -->

		<div class="content_bottom"></div>

		<div class="footer_image">
			<div class="footer_custom">
				<h1><?php bloginfo( 'name' ); ?></h1>
			</div>
		</div>

		<div class="footer">
			<?php $biz_name = ( get_option('tribusBusinessName') ) ? get_option('tribusBusinessName') : get_bloginfo('name'); ?>
			<p class="left">Copyright &copy; 2011 <?php echo $biz_name; ?>  <?php if ( $license = get_option('tribusBusinessLicenseNumber') ) { echo "DRE#: {$license}"; } ?>   |     Login To <a rel="external nofollow" href="http://www.TribusCRM.com">TribusCRM</a></p>
			<p class="right">TRIpress <a href="http://www.tripressrealestate.com">WordPress Real Estate Theme</a>     Powered by <a href="http://www.TribusGroup.com">Tribus Real Estate Technologies</a> <img src="<?php bloginfo('stylesheet_directory'); ?>/images/tribusx15.png"></p>
			<div class="clear"></div>
		</div><!-- end footer -->
	
	</div><!-- end innerBody -->
	<?php wp_footer(); ?>
</body>
</html>