<?php global $is_my_home; $is_my_home= true;?>
<?php get_header(); 
require_once 'includes/Mobile_Detect.php';
$detect = new Mobile_Detect;
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
global $myHeight;
$myHeight = "";
if ($deviceType=='computer')
{
	$myHeight = 'style="height:450px;"';
	
}
?>



<div class="home-page">
	
   <div id="navigation-small"> 
    
   </div>
   <div id="search-container-small" class="span12" style="margin-top:-1px;"></div>
    <div style="clear:both"></div>

    <div id="rotator-out-wrapper"  >
    <div id="rotator-home-widget-wrapper"  > 
    
         			<div <?php echo $myHeight ?>>	
                    <?php get_template_part( 'components/rotator' ) ?>
                    </div>  
                     <div id="home-widget-wrapper">
                           <div id="home-widget-wrapper-inner">
                                   <div id="page-widget"> 
              
                                        <?php dynamic_sidebar( 'cta-over-slider-widget' ) ?>

                                   </div>  
                                
                           </div>
                    </div>  
                    
        
                    <div id="home-widget-search">
                           <div id="page-widget-search-wrapper">
                                <div id="page-widget-search"> 
                                    <?php dynamic_sidebar( 'search-form-over-slider-widget' ) ?>                   
                                </div>  
                           </div>
                    </div>     
        
        
    </div>
    </div>    
    <div style="clear:both;"></div>
   
    <!-- nvaigarion -->
    <div id="navigation-large">
    	<div id="navigation-inner">
        	  <?php 
			        get_template_part('components/navigation');
			   ?>
    	</div>	
    </div>
    
    <!-- navigations ends --->
    
    
    <!-- don't delete; holds elements dynamically positioned   -->
    <div id="buttons-container-small"  style=""></div>
    <div style="clear:both"></div>
  
  	

    
    <div >
    <?php 
	
	//dynamic_sidebar('home-page-widget') 
	if ( !dynamic_sidebar( 'home-page-widget' ) ) :?>
	<div style="margin:0 auto;">
	<?php 
	include(TEMPLATEPATH . '/includes/more_info.php');
	include(TEMPLATEPATH . '/includes/post_preview.php');
	include(TEMPLATEPATH . '/includes/featured_listings.php');
	include(TEMPLATEPATH . '/includes/featured_communities.php');
	endif;
	
	?>
    </div>
  </div>
    
  
  
</div>
<?php get_footer(); ?>