	
<?php $themeColor = ( get_option('tribusThemeColor') ) ? get_option('tribusThemeColor') : 'gray'; ?>
<style >
.popupblue{
background-color:#1A70A9!important;	
}
.popupgray{
background-color:#ccc!important;	
color:white;
}
.popupred{
background-color:#6a0000;
}
</style>
<style type="text/css">
	
	#FORM-wrapper input[type=text],
	#FORM-wrapper input[type=tel],
	#FORM-wrapper input[type=email]
	{
	
	
	border:1px solid #ccc;
	border-radius:5px;	
	padding:3px;
	margin-bottom:8px;
	}
	#FORM-wrapper textarea{
	
		
	border:1px solid #ccc;
	border-radius:5px;	
	min-height:100px;
	padding:3px;
	margin-bottom:8px;
	}
	#FORM-wrapper label{
	
	display:block;

	padding:4px 0;
	min-height:20px;
	margin:0;
	font-size:1em;
	line-height:normal;	
	}

	#FORM-wrapper .sendButton{
	
	border:1px solid #ccc;
	border-radius:5px;
	margin-top:10px;	
	}
	#FORM-wrapper .popup-text{
	color:#666;	
	}
	#FORM-wrapper .popup-title{
		font-size:24px;
		padding:6px;
		line-height:1.4em;
		margin-bottom:10px;
			
	}
	
	</style>

<div id="FORM-wrapper">
	<h2 class="popup-title popup<?php echo $themeColor ?>">Get A Detailed Report Instantly</h2>
		<div id="content">
			<form action="/forms/more-submit/" method="post" id="commentForm-report" class="container-fluid">
			<?php wp_nonce_field('more_info','MoreInfo'); ?>

				<div class="row-fluid popup-text" >
					<div class="intro span12">
                    	To get more information or schedule a showing on <?= $_REQUEST['address'];?>, please fill out the information below. Someone will contact you immediately.
                    </div>
				</div>
				<div class="row-fluid">
					
						<div class="span6">
							<div class="row-fluid">
							<label class="span12">First Name *</label>
							</div >
							<div class="row-fluid">
							<input name="first_name" type="text" value="" required="required" class="text-field span12" id="first_name" />
							</div>
						</div>
						<div class="span6">
							<div class="row-fluid">
								<label class="span12">Last Name *</label>
							</div>
							<div class="row-fluid">
							<input name="last_name" type="text" value="" required="required" class="text-field span12" id="last_name" />
							</div >
						   
						</div>
				</div>
                <div class="row-fluid" >
						<label class="span8">How would you like us to communicate with you?</label>
				</div>   
				
                <div class="row-fluid">
							<input name="communicate" type="text" value="" class="text-field span12"  />
				</div>   
                
				<div class="row-fluid">
				
					<div class="span6">
						<div class="row-fluid">
							<label class="span12">Email *</label>
						</div>
						<div class="row-fluid">
							<input class="span12" name="email" type="email" value="" id="email"  required="required" />
						</div>
					</div>
				
					<div class="span6" style="">
						<div class="row-fluid">
							<label class="span12">Phone</label>
						</div>
						<div class="row-fluid">
							<input class="span12"  name="phone" type="tel"
                             pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
                             value="" id="phone" 
                             placeholder="###-###-####"
                               />
						</div>
					</div>
				</div>
				<div class="row-fluid" style="float:left;line-height:normal;">
						<label class="span8">Do you have any questions, comments or requests?</label>
				</div>   
                
				<div class="row-fluid">
						<textarea class="span12"  style="border:1px solid #ccc" name="comments" id="comments"></textarea>
				</div>
			
				<div class="row-fluid">
				   <input  class="span4 offset4 sendButton btn " type="submit" value="Send"/>     
				</div>
			
			
            	<!-- hidden fields ---->
                <input name="address" type="hidden" value="<?= trim($_REQUEST['address']); ?>" />
                <input name="city" type="hidden" value="<?= trim($_REQUEST['city']);?>" />
                <input name="cloudcma" value="Y" type="hidden">
                <input name="referer" value="<?php echo $_SERVER['HTTP_REFERER']; ?>" type="hidden">
			</form>
		</div><!-- content -->
</div>



<script type="text/javascript">

(function ($){


$("#commentForm-report").submit(function(){
	
	
	var t_f_action = $(this).attr("action");
	
	$.post(t_f_action , $(this).serialize(),function(data){
		
			$("#modalBody-report").html(data);
		
	}    );
	
	return false;
	
});
	
})(jQuery);



</script>
