<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>Register | <?php bloginfo('name'); ?></title>

<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js'></script>
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

<script>
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
	if((email.value == "Your Email Address") || (last.value == ""))
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
								
	<h2>Register</h2>
	
	<div id="content">
		
		<div class="intro">Do you like similar properties to the ones you've been searching for?  If so let us know so we can send you better results and additional properties that might not even be publicly available.  If you fill in your email address below you'll receive a link to create your own custom search.</div>
			
		<form action="/forms/submit" method="post" id="commentForm">
			
			<?php wp_nonce_field('user_regsiter','UserRegister'); ?>
			
			<div class="half">
				<label>First Name *</label>
				<input name="first_name" type="text" value="" class="text-field" id="first_name" />
			</div>
			
			<div class="half" style="margin-left: 6px;">
				<label>Last Name *</label>
				<input name="last_name" type="text" value="" class="text-field" id="last_name" />
			</div>	
			
			<div class="half">
				<label>Email Address *</label>
				<input name="email" type="text" value="" class="text-field" />
			</div>	
			
			<div class="half" style="margin-left: 6px;">
				<label>Phone Number</label>
				<input name="phone" type="text" value="" id="phone" class="text-field" id="phone" />
			</div>
			
			<label>Send Me Info on Properties in this Area</label>
			<input name="search_area" type="text" value="" class="text-field" style="width: 402px;" />
			
			<div class="quarter">
				<label>Beds</label>
				<select name="beds" class="pulldown" style="width: 80px;">
					<option value="1">1+</option>
					<option value="2">2+</option>
					<option value="3">3+</option>
					<option value="4">4+</option>
					<option value="5">5+</option>
				</select>
			</div>	
			
			<div class="quarter" style="width: 98px; margin-left: 6px;">
				<label>Baths</label>
				<select name="baths" class="pulldown" style="width: 85px;">
					<option value="1">1+</option>
					<option value="2">2+</option>
					<option value="3">3+</option>
					<option value="4">4+</option>
				</select>
			</div>
			
			<div class="quarter" style="margin-left: 6px;">
				<label>Price Min</label>
				<input name="min" type="text" value="" class="text-field" style="width: 90px;" />
			</div>
			
			<div class="quarter" style="width: 98px; margin-left: 6px;">
				<label>Price Max</label>
				<input name="max" type="text" value="" class="text-field" style="width: 95px;" />
			</div>
			
			<label>Comments</label>
			<textarea name="comments"></textarea>
			
			<label style="float:left;"><small>* Required Fields</small></label>

			<div class="submit"><input type="submit" name="" value="Submit" onClick=" return checkFields();"></div>
			
			<input name="referer" type="hidden" value="<?php echo ( isset($_SERVER['HTTP_REFERER']) ) ? $_SERVER['HTTP_REFERER'] : 'direct'; ?>">
			
		</form>

	</div>
	
</div>
	

</body>
</html>