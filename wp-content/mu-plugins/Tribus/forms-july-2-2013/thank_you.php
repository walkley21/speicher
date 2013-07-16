<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>Thank You | <?php bloginfo('name'); ?></title>

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
<!--
body, html{
	margin: 0 auto;
	padding: 0;
	text-align: left;
}

div, h1, h2, h3, h4, h5, h6, a, table {
	margin: 0;
	padding: 0;
}

a {text-decoration: none; color: #f00;}
a:hover {text-decoration: underline;}

.break {
	clear: both;
}

body {
	background: #fff;
	font-size: 12px;
	font-family: 'Lucida Grande', Verdana, Arial, Sans-Serif;
	color: #333;
	margin: 1px;
}

#wrapper {
	margin: 0;
	width: 448px;
}

#content {
	padding: 20px;
}

.thankyou {
	margin: 0 0 10px;
	color: #666;
}

.error {
	margin: 0 0 10px;
	color: #f00;
}

h2 {
	background: #22317a;
	padding: 10px 20px;
	color: #fff;
	font-size: 24px;
	font-weight: normal;
}



-->
</style>

</head>
<body>
	
<div id="wrapper">
								
	<h2>Thank You</h2>
	
	<div id="content">
		
		<div class="thankyou">
			
		<?php if ( defined('ADVANCED_IDX') && ADVANCED_IDX ) { ?>
		
		<p>Thanks for registering for <?php bloginfo('name'); ?>. Please continue to search on the site for all the homes in the area.  However, as a thank you for registering,  if you're interested in more specific search criteria, below please find a link to our advanced search system.</p>
		
		<p><a href="<?php bloginfo('url'); ?>/idx/advanced" target="_top"><?php bloginfo('url'); ?>/idx/advanced</a></p>
		
		<?php } else { ?>
			
			<p>Thanks for registering for <?php bloginfo('name'); ?>. Please continue to search on the site for all the homes in the area.</p>
			
		<?php } ?>
		
		</div>
		
	</div>
	
</div>
	

</body>
</html>