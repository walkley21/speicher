<?php

get_header();


if($_REQUEST['tribusaction'] == 'thankyou') { 
    ?>
    
    <link rel="stylesheet" href="<?php echo get_theme_root_uri() ?>/Tribus/resources/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
    <script type="text/javascript" src="<?php echo get_theme_root_uri() ?>/Tribus/resources/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
    
    <a class="iframe" id="thank-you-link" href="/forms/thank-you"></a>
    
    <!--div class="thankyouframe"></div-->
    <script type="text/javascript">  
    
    jQuery(document).ready(function($) {
    
    $("a#thank-you-link").fancybox({
        'width' : 460,
        'height' : 520,
        'transitionIn'    :    'elastic',
        'transitionOut'    :    'elastic',
        'speedIn'        :    600, 
        'speedOut'        :    200, 
        'overlayShow'    :    true,
        'overlayColor' :  '#000000'
    });
    
    $("a#thank-you-link").trigger('click');
    
});
    
    
    
    </script>
    
<?php } ?>
<div class="cta">

    <div class="cta-item cta_about">
        <div class="icon"></div>
        <h3><a href="#">About</a></h3>
        <p>Community is a village in DuPage County, Illinois, United States. The population was 22,930 at the 2011 census, and estimated to be 23,135 as of 2008.</p>
    </div>
    
    <div class="cta-item last">
        <!--div class="icon"></div-->
        <h3><a href="/blog/category/news-events/">News and Events</a></h3>
        <!--p>Search all homes with our custom homes search.</p-->
        <?php 
        global $wpbd;
        
        $args = array(
            'numberposts' => 3,
            'orderby' => 'post_date',
            'order' => 'DESC',
            'category' => 7,
            'post_type' => 'post',
            'post_status' => 'publish',
            'suppress_filters' => true ); 
        $news = wp_get_recent_posts($args);
        //print_r($news);
        if(!empty($news) ) :
            echo '<ul>';
            foreach($news as $item):
                echo '<li><span class="cta_news_date">'.date('m/d/Y',strtotime($item['post_date'])).'</span><span class="cta_news_title"><a href="'.get_permalink($item['ID']).'">'.$item['post_title'].'</a></span></li>';
            endforeach;
            echo '</ul>';
        endif;
        ?>
        
    </div>
    
</div>

<div class="homes_bg">
    <div id="homes_dir" style="margin-left: 16px;">
        <h3 class="section">Homes For Sale</h3>
        <div class="excerpts">            
            <?php 
            query_posts( array( 'post_type' => 'listing', 'listingcategory'=>'homes-for-sale', 'showposts' => 2 ) );
            if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <div class="excerpt">
                    <a href="<?php the_permalink() ?>" title="<?php the_title() ?>" alt="<?php the_title() ?>" rel="bookmark"><?php the_post_thumbnail(array('197')) ?></a>
                    <!--img src="<?php //echo bloginfo('stylesheet_directory'); ?>/images/house1.jpg" alt="3"/-->
                    <div id="price"><div>$<?php echo get_post_meta($post->ID, 'listing_price', true); ?></div></div>
                    <p><?php the_title(); ?></p>
                </div>
                
                <?php //the_content();

            endwhile; endif; wp_reset_query(); 
            ?>            
            <br class="clear"/>
        </div><!-- end excerpts -->
    </div><!-- end #homes_dir -->
    <div id="homes_dir" style="margin-left: 20px;">
        <h3 class="section">Sold Homes</h3>

        <div class="excerpts">            
            <?php 
            query_posts( array( 'post_type' => 'listing', 'listingcategory' => 'sold-homes', 'showposts' => 2 ) );
            if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <div class="excerpt">
                    <a href="<?php the_permalink() ?>" title="<?php the_title() ?>" alt="<?php the_title() ?>" rel="bookmark"><?php the_post_thumbnail(array('197')) ?></a>
                    <!--img src="<?php //echo bloginfo('stylesheet_directory'); ?>/images/house1.jpg" alt="3"/-->
                    <div id="price"><div>$<?php echo get_post_meta($post->ID, 'listing_price', true); ?></div></div>
                    <p><?php the_title(); ?></p>
                </div>
                
                <?php //the_content();

            endwhile; endif; wp_reset_query(); 
            ?>            
            <br class="clear"/>
        </div><!-- end excerpts -->
        
        
        
        <!--div class="excerpts">

            <div class="excerpt">
                <img src="<?php //echo bloginfo('stylesheet_directory'); ?>/images/house3.jpg" alt="3"/>
                <div id="price"><div>$1,219,000</div></div>
                <p>1111 Brickell Bay Drive 3 () Miami FL 33131</p>
            </div>
            
            <div class="excerpt">
                <img src="<?php //echo bloginfo('stylesheet_directory'); ?>/images/house4.jpg" alt="3"/>
                <div id="price"><div>$1,219,000</div></div>
                <p>1111 Brickell Bay Drive 3 () Miami FL 33131</p>
            </div>
            
            <br class="clear"/>
        </div--><!-- end excerpts -->
    </div><!-- end #homes_dir -->
</div>

<div class="options-bottoms">
    <a href="#"><img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/button-search-homes.png" alt="Search Homes"></a>
    <a href="/blog/communities"><img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/button-communities.png" alt="Communities"></a>
    <a style="padding-right: 0px;" href="/market-stats"><img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/button-market-watch.png" alt="Market Watch"></a>
</div>
<?php
get_footer();

?>
