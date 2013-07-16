<?php get_header(); ?>

	<div class="row-fluid">
            <div id="post-index-main" class="post-archive span9" > 
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							
									<article class="article-post">
										<div id="post-<?php the_ID() ?>" class="archive">
											<h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
											<div class="byline">
												Posted : <?php the_time('m-d-Y') ?>
												
											</div>
													<div class="post-thumb-archive">
												   <?php 
														if ( has_post_thumbnail() ) : // check if the post has a Post Thumbnail assigned to it.
														?><a href="<?php the_permalink()?>" > 
														   <?php the_post_thumbnail( array(200,160) ); ?>
														  </a> 
													   <?php      
													endif; ?>
													</div>
													
											<?php the_excerpt(); ?>
											<div class="clear"></div>
										</div>
									</article>
					<?php endwhile; ?>
                
					<div style="clear:both;margin-top:10px;">
						<p align="left"><?php next_posts_link('&laquo; Previous Entries') ?></p>
						<p align="right"><?php previous_posts_link('Next Entries &raquo;') ?></p>
					</div>
            
					<?php else : ?>
					
						<h2 class="center">Not Found</h2>
						<p class="center">Sorry, but you are looking for something that isn't here.</p>
					
					<?php endif; ?>
            </div>
    
    
   
			<?php if ( !is_front_page() ): ?>
			<div class="sidebar-wrapper-1  span3 side-bar-area">
				<?php { get_sidebar(); } ?>
			</div>
			<?php endif; ?>
    
    </div>
    <div style="clear:both"></div>
<?php get_footer(); ?>