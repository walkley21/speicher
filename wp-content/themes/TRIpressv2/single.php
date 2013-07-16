<?php get_header(); ?>
<div id="mainWrapper" class="blogDetailView">
<article id="inner">     

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="detail_post_entry" >
    
        <h1 class="title"><?php the_title(); ?></h1>
    
        <div class="byline">
           <span class="date">	Posted : <?php the_time('m-d-Y') ?> </span>
           <span class="author">Author : <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )))?>">
           								 <?php echo get_the_author() ?> 
                                         </a>
                                         </span>
           
        </div>
    	
        
        
        
    	<?php 
		if ( has_post_thumbnail() ) { ?>
		<div class="entry_image">
		<?php the_post_thumbnail(array(300,200)); ?>
		</div>
		<?php }	 ?>
    
        <div class="actual-single-content">
        <?php the_content('Read the rest of this entry &raquo;'); ?>
        </div>
        <div style="clear:both;"></div>
        <div class="container-fluid" style="padding:10px; border:1px solid #ccc;border-radius:5px;box-shadow: 1px 1px 5px  #ccc;margin-bottom:20px;margin-top:10px; ">
        <div class="row-fluid">
        		<div class="span2 " style="padding-top:6px;">
                	 <?php echo get_avatar( get_the_author_meta( 'ID' ), $size = '96', $default = '' ); ?>
                </div>
                <div class="span10">
                	<div class="row-fluid">
                    	<div class="span6  ">
                        	<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )))?>" >
                      		 <?php the_author_meta('first_name', get_the_author_meta( 'ID' )); ?>
                             <?php the_author_meta('last_name', get_the_author_meta( 'ID' )); ?>
                            </a>
                        </div>
                        
                        <div class="span3 pull-left" id="blog-author-phone">
                        	<?php 
								 $telephone = get_the_author_meta('phone', get_the_author_meta( 'ID' ));
									if (empty($telephone) ) 
									$telephone =  get_option('tribusThemePhoneNumber');
									echo  $telephone;
								
							?>
                            
                        </div>
                        
                    	<div class="span3 pull-left" id="blog-author-email">
                         	<?php $email = get_the_author_meta('user_email', get_the_author_meta( 'ID' )); ?>
                            <a href="mailto:<?php  echo antispambot($email);?>">Email</a> 
                        </div>
                       
                    </div>
                    <div class="row-fluid">
                    	<div class="span12">
                        	 <?php the_author_meta( 'description', get_the_author_meta( 'ID' ) ); ?> 
                        </div>
                    </div>
                </div>
        </div>
        </div>
        <p class="postmetadata alt">
           
                
            
                
                
                
                
    
                <?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
                    // Both Comments and Pings are open ?>
				You can <a href="#respond">leave a response</a>, or <a href="<?php trackback_url(true); ?>" rel="trackback">trackback</a> from your own site.

			<?php } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
				// Only Pings are Open ?>
				Responses are currently closed, but you can <a href="<?php trackback_url(true); ?> " rel="trackback">trackback</a> from your own site.

			<?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
				// Comments are open, Pings are not ?>
				

			<?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
				// Neither Comments, nor Pings are open ?>
				Both comments and pings are currently closed.

			<?php }  ?>

		
	</p>

<?php comments_template(); ?>
</div>
<?php endwhile; ?>

	<p align="left"><?php next_posts_link('&laquo; Previous Entries') ?></p>
	<p align="right"><?php previous_posts_link('Next Entries &raquo;') ?></p>

<?php else : ?>

	<h2 class="center">Not Found</h2>
	<p class="center">Sorry, but you are looking for something that isn't here.</p>

<?php endif; ?>
</article>        
</div> <!-- closes mainWrapper div -->

<?php if ( !is_home() || defined('INTERIOR') ): ?>
<div class="sidebar-wrapper"> 
    <?php { get_sidebar(); } ?>
</div>
<?php endif; ?>

<div style="clear:both"></div>
<?php get_footer(); ?>