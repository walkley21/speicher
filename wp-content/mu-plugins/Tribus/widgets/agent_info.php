<?php

class Agent_Info extends WP_Widget {
    
    function Agent_Info()
    {
        $widget_ops = array('description' => __("Agent Info") );
        $this->WP_Widget('Agent_Info', __('Agent Info'), $widget_ops);
    }
    
    function widget($args, $instance )
    {
        extract($args);
        $text = apply_filters('widget_text', $instance['text'] );
        $link = $instance['link'];
        echo $before_widget;
        global $post;
        $curauth = get_userdata($post->post_author);
        ?>
        <div class="agent-wrapper">
			<div class="agent row-fluid"  >
					<div class="agent-avatar span2">
						<?
						echo get_avatar(get_the_author_meta('ID' ), $size = '96', $default = '' );
						?>
						
					</div>
        
					<div class="span10">
			
								<div class="row-fluid">
					
										<a class="agent-info-name span3" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID' )))?>" >
											<span class="agent-name ">
						
											<?php echo $curauth->display_name;?>
						
											</span>
										</a>
										<div class="email span3 offset3">
											<img style="float:left;margin-top:-2px;margin-right:4px" src="<?php bloginfo('stylesheet_directory'); ?>/images/agent-email.png">
											<div class="txt">
												<?php $email = get_the_author_meta('user_email', get_the_author_meta('ID' ));?>
												<a class="agent-mail-anchor" href="mailto:<?php  echo antispambot($email);?>">Email</a>
											</div>
										</div>
										<div class="phone span3">
												<img style="float:left;" src="<?php bloginfo('stylesheet_directory'); ?>/images/agent-phone.png" />
												<div class="txt agent-mail-phone"><?php if ($curauth->cell) {
													echo $curauth->cell;
												} else {
													echo $curauth->phone;
												}
												?>
												</div>
										</div>
					
								</div>
								
								<div class="row-fluid">
									<div class="span12  agent-info-description">
										<?php
										
										$content = apply_filters('the_content', get_user_meta($post->post_author, 'description', true));
										$numchars = strlen($content);
										if ($numchars > 200) {
											$content = substr($content, 0, 200);
										}
										
										echo $content;
										if ($numchars > 200) {
											echo "...<a href=\"". get_bloginfo('siteurl')."/author/". $curauth->user_login."\" class=\"agent-more\">read more</a>";
										}?>
							
									</div>
								</div>
								
					</div>
			</div>	
			
        
       
        
        
        
			<div class="row-fluid">
				<div class="span2">
        
					<?php if ($curauth->facebook) {
					?><div class="facebook "><a href="<?php echo $curauth->facebook; ?>" rel="nofollow" target="_blank"><img width="26" src="<?php bloginfo('stylesheet_directory'); ?>/images/agent-facebook.png"></a></div><?php }
					?>
					<?php if ($curauth->twitter) {
					?><div class="twitter"><a href="http://twitter.com/<?php echo $curauth->twitter; ?>" rel="nofollow" target="_blank"><img width="26" src="<?php bloginfo('stylesheet_directory'); ?>/images/agent-twitter.png"></a></div><?php }
					?>
					<?php if ($curauth->linkedin) {
					?><div class="linkedin"><a href="https://www.linkedin.com/e/fpf/<?php echo $curauth->linkedin; ?>" rel="nofollow" target="_blank"><img width="26" src="<?php bloginfo('stylesheet_directory'); ?>/images/agent-linkedin.png"></a></div><?php }
					?>
					<?php if ($curauth->youtube) {
					?><div class="youtube"><a href="http://www.youtube.com/<?php echo $curauth->youtube; ?>" rel="nofollow" target="_blank"><img width="26"  src="<?php bloginfo('stylesheet_directory'); ?>/images/agent-youtube.png"></a></div><?php }
					?>
				</div>
				<div class="break"></div>
			</div>
        
        
        
        
        
        
        
       
        </div>
        
        <?php
        echo $after_widget;
    }
    
}
