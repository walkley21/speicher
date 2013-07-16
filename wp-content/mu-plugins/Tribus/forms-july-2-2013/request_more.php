<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title>Request More Info | <?php bloginfo('name'); ?></title>

<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js'></script>
<!--<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js'></script>-->
<!--<script type='text/javascript' src='<?= get_bloginfo("stylesheet_directory") ; ?>/js/jquery-validate/jquery.validate.js'></script>-->

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

a {text-decoration: none}
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

.intro {
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

label {
	clear: both;
	display: block;
	margin-bottom: 3px;
	padding-top: 10px;
}

.text-field {
	width: 195px;
	border: 1px solid #666;
	font-size: 14px;
	padding: 2px;
	font-family: 'Lucida Grande', Verdana, Arial, Sans-Serif;
}

textarea {
	float: left;
	width: 402px;
	height: 60px;
	border: 1px solid #666;
	font-size: 14px;
	padding: 2px;
	font-family: 'Lucida Grande', Verdana, Arial, Sans-Serif;
}

.submit {
	float: right;
	margin-top: 10px;
}

.half {
	float: left;
	width: 201px;
}

.quarter {
	float: left;
	width: 97px;
}



-->
</style>

<!--  fix -->



<script type="text/javascript">

	function checkFields()
	{
		var first = document.getElementById('first_name');
		var last = document.getElementById('last_name');
		var email = document.getElementById('email');
		var phone = document.getElementById('phone');
		var sendAlert = false;
		var sendPhoneAlert = false;

		if((first.value == "First Name") || (first.value == ""))
			sendAlert = true;
		if((last.value == "Last Name") || (last.value == ""))
			sendAlert = true;
		if((email.value == "Your Email Address") || (email.value == ""))
			sendAlert = true;
		
		if(phone.value != "")
		{
			if(phone.value.search(/\d{3}\-\d{3}\-\d{4}/)==-1)
				sendPhoneAlert = true;
		}


		if(sendAlert == true)
		{
			alert("The following fields are required: First Name, Last Name, and Email Address");
			return false;
		}
		else if(sendPhoneAlert)
		{
			alert("Please fill out your phone number in the following format: ###-###-####");
			return false;
		}
		else
		{
			return true;
		}
	}
	
	jQuery(function($){
		$("#commentForm").submit(checkFields);
	});
</script>

</head>
<body>

<div id="wrapper">
	
	<h2>Request More Info</h2>
	
	<div id="content">
		
		<?php
		$vals = array(
			array("first_name", "First Name:"),
			array("last_name", "Last Name:"),
			array("email", "Email:"),
			array("phone", "Phone:"),
			array("comments", "Do you have any questions or requests?"),
			array("send_id", ""),
			array("address", ""),
			array("price", ""),
			array("city", ""),
			array("communicate", "How would you like us to communicate with you?"),
			array("date", "When would you like to see this property?"),
			array("time", ""),
		);
		?>
		
		<div class="intro">To get more information or schedule a showing on <?= $_REQUEST['address'];?>, please fill out the information below. Someone will contact you immediately.</div>
		

		<form action="/forms/more-submit/" method="post" id="commentForm">
			
			<?php wp_nonce_field('more_info','MoreInfo'); ?>
			
			<div class="half">
				<label>First Name *</label>
				<input name="first_name" type="text" value="" class="text-field" id="first_name" />
			</div>
			
			<div class="half" style="margin-left: 6px;">
				<label>Last Name *</label>
				<input name="last_name" type="text" value="" class="text-field" id="last_name" />
			</div>

			<label>How would you like us to communicate with you?</label>
			<input name="communicate" type="text" value="" class="text-field" style="width: 402px;" />

			<div class="half">
				<label>Email *<span style="float:right;">or</span></label>
				<input name="email" type="text" value="" class="text-field" id="email"/>
			</div>
			
			<div class="half" style="margin-left: 6px;">
				<label>Phone</label>
				<input name="phone" type="text" value="" id="phone" class="text-field" id="phone" />
			</div>
			
			<label>Do you have any questions or requests?</label>
			<textarea name="comments"></textarea>
			
			<div class="submit"><input name="submit" class="submit" type="submit" onClick=" return checkFields();" />
			<input name="address" type="hidden" value="<?= trim($_REQUEST['address']); ?>" />

		</form>
	
	</div>

</div>
	
</body>
</html>