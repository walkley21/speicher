				</div> <!-- end blog -->
				
				<?php if ( !is_home() || defined('INTERIOR') ) { get_sidebar(); } ?>
		
			</div><!-- end main -->

            <div class="fb-banners">
                <?php if( is_home() && !defined('INTERIOR') && get_option('tribusFacebookApp') == 'Y' ):?>
            	<?php //if( get_option('tribusFacebookLike') == 'Y' ):?>
                	<div class="fb-like" data-href="http://tribus.creative-works.us/" data-send="false" data-width="450" data-show-faces="true"></div>
                <?php endif;?>
				<?php if( is_home() && !defined('INTERIOR') ):?>
                    <div style="float: right; width: 300px;">
                        <span style="color: #136cc0; font-family: Georgia; font-size: 14px; font-style: italic;">Information Sponsored By:</span><br>
                        <table cellpadding="0" cellspacing="0" width="100%" align="left">
                        <tr>
                            <td rowspan="2" width="100px"><?php $avtr = get_avatar(1, 80); echo $avtr; ?></td>
                            <td style="font-family: Arial; font-size: 14px; font-weight: bold; color: #136cc0; text-transform: uppercase;">
                            <?php $user_info = get_userdata(1);
                            echo $user_info->display_name;
                            ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-family: Arial; font-size: 12px; font-weight: bold; color: #585858;">Phone: <?php echo get_option('tribusThemePhoneNumber'); ?></td>
                        </tr>
                        </table>
                    </div>
                <?php endif;?>
            </div>
            
			<br class="clear"/>

		</div> <!-- end content -->

		<div class="content_bottom">
        </div>

		<div class="footer_image">
			<div class="footer_custom">
				<span class="brand-name"><?php bloginfo( 'name' ); ?></span>
                <span class="footer_custom_copyright">
                Copyright &copy; 2011 Baird & Warner Real Estate   |     Login To <a rel="external nofollow" href="<?php echo get_bloginfo('url'); ?>/wp-login.php">Community</a>
                </span>
			</div>
		</div>

		<!--div class="footer">
			<?php /*$biz_name = ( get_option('tribusBusinessName') ) ? get_option('tribusBusinessName') : get_bloginfo('name'); ?>
			<p class="left">Copyright &copy; 2011 <?php echo $biz_name; ?>  <?php if ( $license = get_option('tribusBusinessLicenseNumber') ) { echo "DRE#: {$license}"; } ?>   |     Login To <a rel="external nofollow" href="http://www.TribusCRM.com">TribusCRM</a></p>
			<p class="right">TRIpress <a href="http://www.tripressrealestate.com">WordPress Real Estate Theme</a>     Powered by <a href="http://www.TribusGroup.com">Tribus Real Estate Technologies</a> <img src="<?php bloginfo('stylesheet_directory'); */?>/images/tribusx15.png"></p>
			<div class="clear"></div>
		</div--><!-- end footer -->
	
	</div><!-- end innerBody -->
	<?php wp_footer(); ?>
</body> <!-- end of body   this is the end of the body -->
</html>