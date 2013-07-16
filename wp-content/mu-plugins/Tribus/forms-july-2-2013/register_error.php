<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>Register Error | <?php bloginfo('name'); ?></title>

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
</script>

</head>
<body>
	


<div id="wrapper">
								
	<h2>Register</h2>
	
	<div id="content">
		
		<div class="intro">Whoops. Please make sure to fill in all of the required fields below before submitting again.</div>
		
		<?php global $error_message; ?>
		<div class="error"><?php echo $error_message; ?></div>
		
		<form action="/forms/submit" method="post">
			
			<?php wp_nonce_field('user_regsiter','UserRegister'); ?>
			
			<div class="half">
				<label>First Name *</label>
				<?php $first_name = ( isset($_POST['first_name']) && !empty($_POST['first_name']) ) ? $_POST['first_name'] : ''; ?>
				<input name="first_name" type="text" value="<?php echo $first_name; ?>" class="text-field" id="first_name" />
			</div>
			
			<div class="half" style="margin-left: 6px;">
				<label>Last Name *</label>
				<?php $last_name = ( isset($_POST['last_name']) && !empty($_POST['last_name']) ) ? $_POST['last_name'] : ''; ?>
				<input name="last_name" type="text" value="<?php echo $last_name; ?>" class="text-field" id="last_name" />
			</div>	
			
			<div class="half">
				<label>Email Address *</label>
				<?php $email = ( isset($_POST['email']) && !empty($_POST['email']) ) ? $_POST['email'] : ''; ?>
				<input name="email" type="text" value="<?php echo $email; ?>" class="text-field" />
			</div>	
			
			<div class="half" style="margin-left: 6px;">
				<label>Phone Number</label>
				<?php $phone = ( isset($_POST['phone']) && !empty($_POST['phone']) ) ? $_POST['phone'] : ''; ?>
				<input name="phone" type="text" value="<?php echo $phone; ?>" id="phone" class="text-field" id="phone" />
			</div>
			
			<label>Send Me Info on Properties in this Area</label>
			<?php $search_area = ( isset($_POST['search_area']) && !empty($_POST['search_area']) ) ? $_POST['search_area'] : ''; ?>
			<input name="search_area" type="text" value="<?php echo $search_area; ?>" class="text-field" style="width: 402px;" />
			
			<div class="quarter">
				<label>Beds</label>
				<?php $beds = ( isset($_POST['beds']) && !empty($_POST['beds']) ) ? $_POST['beds'] : null; ?>
				<select name="beds" class="pulldown" style="width: 80px;">
					<option value="1" <?php if ($beds == 1) echo "selected"; ?>>1+</option>
					<option value="2" <?php if ($beds == 2) echo "selected"; ?>>2+</option>
					<option value="3" <?php if ($beds == 3) echo "selected"; ?>>3+</option>
					<option value="4" <?php if ($beds == 4) echo "selected"; ?>>4+</option>
					<option value="5" <?php if ($beds == 5) echo "selected"; ?>>5+</option>
				</select>
			</div>	
			
			<div class="quarter" style="width: 98px; margin-left: 6px;">
				<label>Baths</label>
				<?php $baths = ( isset($_POST['baths']) && !empty($_POST['baths']) ) ? $_POST['baths'] : null; ?>
				<select name="baths" class="pulldown" style="width: 85px;">
					<option value="1" <?php if ($baths == 1) echo "selected"; ?>>1+</option>
					<option value="2" <?php if ($baths == 2) echo "selected"; ?>>2+</option>
					<option value="3" <?php if ($baths == 3) echo "selected"; ?>>3+</option>
					<option value="4" <?php if ($baths == 4) echo "selected"; ?>>4+</option>
				</select>
			</div>
			
			<div class="quarter" style="margin-left: 6px;">
				<label>Price Min</label>
				<?php $min = ( isset($_POST['min']) && !empty($_POST['min']) ) ? $_POST['min'] : ''; ?>
				<input name="min" type="text" value="<?php echo $min; ?>" class="text-field" style="width: 90px;" />
			</div>
			
			<div class="quarter" style="width: 98px; margin-left: 6px;">
				<label>Price Max</label>
				<?php $max = ( isset($_POST['max']) && !empty($_POST['max']) ) ? $_POST['max'] : ''; ?>
				<input name="max" type="text" value="<?php echo $max; ?>" class="text-field" style="width: 95px;" />
			</div>
			
			<label>Comments</label>
			<?php $comments = ( isset($_POST['comments']) && !empty($_POST['comments']) ) ? $_POST['comments'] : ''; ?>
			<textarea name="comments"><?php echo $comments; ?></textarea>
			
			<label style="float:left;"><small>* Required Fields</small></label>

			<div class="submit"><input type="submit" name="" value="Submit" onClick=" return checkFields();"></div>
			
			<?php $referer = ( isset($_POST['referer']) && !empty($_POST['referer']) ) ? $_POST['referer'] : ''; ?>
			<input name="referer" type="hidden" value="<?php echo $referer; ?>">
			
		</form>

	</div>
	
</div>
	

</body>
</html>