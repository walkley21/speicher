<?php 
    $telephone = '';
    if ( get_option('tribusThemePhoneNumber') ) 
    $telephoneLabel  =  get_option('tribusThemePhoneNumber');


	$telephone = str_replace("-","",$telephoneLabel);
?>


<div id="contact" class="hidden-phone hidden-tablet"   >
    <ul  id="contact-ul-new" >
        <li  id="email-link"  style="float:right;">
            <a href="<?= get_bloginfo('url');?>/forms/email-us/" id="contact-email-form" class="email"  data-toggle="modal" data-target="#myModal">Email Us</a>
        </li>
        <li style="float:right"><a href="tel:<?php echo $telephone; ?>" class="telephone phone-call" ><?php echo $telephoneLabel ?></a></li>   
    </ul>
   
</div>

<div  id="phone-big" class="visible-phone visible-tablet" >
    	 <a href="tel:<?php echo $telephone?>" class="phone-call">
		 	<?php echo $telephoneLabel;?>
         </a>   
</div>



