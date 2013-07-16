
				
			
</div>
  



        <footer>
            
            <div class="footer">
                    <?php $biz_name = ( get_option('tribusBusinessName') ) ? get_option('tribusBusinessName') : get_bloginfo('name'); ?>
                    <p class="left">Copyright &copy; <?php echo @date("Y") ?> <?php echo $biz_name; ?>  <?php if ( $license = get_option('tribusBusinessLicenseNumber') ) { echo "DRE#: {$license}"; } ?>   |     Login To <a  target="_blank" rel="external nofollow" href="http://www.TribusCRM.com">TribusCRM</a>
                    </p>
                    <p class="right"><a  target="_blank" href="http://www.tripressrealestate.com">WordPress Real Estate Theme</a>     Powered by <a href="http://www.TribusGroup.com">Tribus Real Estate Technologies</a> <img src="<?php bloginfo('stylesheet_directory'); ?>/images/tribusx15.png">
                    </p>
                    <div class="clear"></div>
            </div><!-- end footer -->
        </footer>
    </div><!-- mainContent -->
</div><!-- page -->
	<?php wp_footer(); ?>
  
  
    
    <script src="<?php  echo  get_bloginfo('template_directory'); ?>/bootstrap/js/bootstrap.min.js"></script>
    <!--script src="<?php  echo  get_bloginfo('template_directory'); ?>/bootstrap/js/bootstrap-modal.js"></script-->
    <script src="<?php  echo  get_bloginfo('template_directory'); ?>/bootstrap/js/bootstrap-modalmanager.js"></script>
    <script src="<?php  echo  get_bloginfo('template_directory'); ?>/bootstrap/js/bootstrap-datepicker.js"></script>
    
  
  
  
  
    <div id="myModal"  class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header" style="min-height:16px">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      
      </div>
      <div class="modal-body" id="modalBody" style="min-height:360px;" >
        
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        
      </div>
    </div>  
    <!-- register -->
    <!-- special case to open it as it has to open automatically when visitors return 4+ times -->
     <a id="opens-register-form" data-toggle="modal" data-target="#myModal-register2"  style="display:none;" href="<?= get_bloginfo('url');?>/forms/register/" ></a>
     <div id="myModal-register2"  class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header" style="min-height:16px">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      
      </div>
      <div class="modal-body" id="modalBody" style="min-height:480px;" >
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        
      </div>
    </div> 
    
       <div id="myModal-register"  class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header" style="min-height:16px">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      
      </div>
      <div class="modal-body" id="modalBody-request-more" style="min-height:480px;" >
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        
      </div>
    </div> 
     <!-- schedule -->
     <div id="myModal-schedule"  class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header" style="min-height:16px">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      
      </div>
      <div class="modal-body" id="modalBody-schedule" style="min-height:480px;" >
        
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        
      </div>
    </div>  
    <!-- detail report modal begins -->
     <div id="myModal-report"  class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header" style="min-height:16px">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      
      </div>
      <div class="modal-body" id="modalBody-report" style="min-height:480px;" >
        
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <!--button class="btn btn-primary">Save changes</button-->
      </div>
    </div> 
   <!-- detail report modal ends -->            
</body>     
</html>