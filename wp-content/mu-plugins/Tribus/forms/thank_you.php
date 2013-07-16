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

<script type="text/javascript" charset="utf-8">

	function createCookie(name,value,days) {
		if (days) {
			var date = new Date();
			date.setTime(date.getTime()+(days*24*60*60*1000));
			var expires = "; expires="+date.toGMTString();
		}
		else var expires = "";
		document.cookie = name+"="+value+expires+"; path=/";
	}
	
	function readCookie(name) {
		var nameEQ = name + "=";
		var ca = document.cookie.split(';');
		for(var i=0;i < ca.length;i++) {
			var c = ca[i];
			while (c.charAt(0)==' ') c = c.substring(1,c.length);
			if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
		}
		return null;
	}
	
	function eraseCookie(name) {
		createCookie(name,"",-1);
	}

	if (navigator.cookieEnabled) {
		createCookie('tribus_form', true, 600);
	}


</script>

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
	<h2 class="popup-title popup<?php echo $themeColor ?>">Thank you</h2>
		<div id="content">
			<form action="/forms/email-submit/" method="post" id="commentForm" class="container-fluid popup-form">
			

				<div class="row-fluid popup-text" >
					<?php if ( defined('ADVANCED_IDX') && ADVANCED_IDX ): ?>
                    <p>Thanks for registering for <?php bloginfo('name'); ?>. Please continue to search on the site for all the homes in the area.  However, as a thank you for registering,  if you're interested in more specific search criteria, below please find a link to our advanced search system.</p>
                    <p><a href="<?php bloginfo('url'); ?>/idx/advanced" target="_top"><?php bloginfo('url'); ?>/idx/advanced</a></p>
                    <?php else: ?>
                    <p>Thanks for registering for <?php bloginfo('name'); ?>. Please continue to search on the site for all the homes in the area.</p>
                    <?php endif;?>
				</div>
			</form>
		</div>
</div>        

        
        
