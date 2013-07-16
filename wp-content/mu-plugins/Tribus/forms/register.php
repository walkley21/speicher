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
	#FORM-wrapper input[type=email],
	#FORM-wrapper select
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
	<h2 class="popup-title popup<?php echo $themeColor ?>">Register</h2>
		<div id="content">
			<form action="/forms/email-submit/" method="post" id="commentForm" class="container-fluid popup-form">
			<?php wp_nonce_field('contact_us','ContactUs'); ?>

				<div class="row-fluid popup-text" >
					<div class="intro span12">
                    	Do you like similar properties to the ones you've been searching for?
        				If so let us know so we can send you better results and additional properties that might not even be publicly available. 
				        If you fill in your email address below you'll receive a link to create your own custom search.
        
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
						<label class="span8">Send Me Info on Properties in this Area</label>
				</div>   
                         
				<div class="row-fluid">
						<input class="span12"  style="border:1px solid #ccc" name="search_area" />
				</div>
                <div class="row-fluid">
                		<div class="span3">
                        			<label>Beds</label>
                                    <select name="beds" class="pulldown" >
                                        <option value="1">1+</option>
                                        <option value="2">2+</option>
                                        <option value="3">3+</option>
                                        <option value="4">4+</option>
                                        <option value="5">5+</option>
                                    </select>
                        </div>
                        <div class="span3">
                        			<label>Baths</label>
                                    <select name="baths" class="pulldown" >
                                        <option value="1">1+</option>
                                        <option value="2">2+</option>
                                        <option value="3">3+</option>
                                        <option value="4">4+</option>
                                    </select>
                        </div>
                        <div class="span3">
                        			<label>Price Min</label>
									<input name="min" type="text" value=""  style="width:80px"  />
                        </div>
                        <div class="span3">
                        			<label>Price Max</label>
									<input name="max" type="text" value="" style="width:80px" />
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
			
			
			</form>
		</div><!-- content -->
</div>



<script type="text/javascript">

(function ($){


$("#commentForm").submit(function(){
	
	
	var t_f_action = $(this).attr("action");
	
	$.post(t_f_action , $(this).serialize(),function(data){
		
			$("#modalBody").html(data);
		
	}    );
	
	return false;
	
});
	
})(jQuery);



</script>
