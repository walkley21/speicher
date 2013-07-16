<?php 
$data = homepagelistings();

global $myHeight;


if (empty($data)) return; /*don't output anything on empty listings */

?>
                      
    <section class="slider" id="slider-container"  >
        <div class="flexslider" id="slider-container-inner"  >
          <ul class="slides">
          
          				<?php foreach($data as $listing): ?>
                        	
                            
                            
                            <li style="position:relative">
                            	<a href="<?php echo $listing['permalink']?>" >
                                <img  src="<?php echo $listing['source'] ?>" width="960" height="450" />
                                <p class="flex-caption" style="display:block;height:40px;">
                                	<?php echo $listing['info'];?>
                                </p>
                                </a>
                            </li>
                        <?php endforeach;?>
  	    		
          </ul>
        </div>
      </section>
  
<script type="text/javascript">
    
   (function($) {


    $(window).load(function(){
       
      $('.flexslider').flexslider({
        animation: "slide",
		
		slideshow: false, 
        start: function(slider){
          
        }
      });
    });
    
    //plugin code
    })(jQuery);
    
	
	(function($){
	
			$(window).resize(function(){
			
					
					$("#direct-rotator-wrapper").css("height","");
					console.log("height removed");
				
			});
		
	})(jQuery);
	
  </script>