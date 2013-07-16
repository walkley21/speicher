<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<title>Market Report | <?php bloginfo('name'); ?></title>
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
</head>
<body>
	
<div id="wrapper">
	<h2>Full Market Report Email</h2>
	<div id="content">
		<div class="intro"></div>
		<iframe id="blog" src="http://www.altosresearch.com/altos/app?&service=crm&pai=<?php echo PAI; ?>&tribusid=<?php echo get_option("tribus_id"); ?>&l=b&css=http://www.altosresearch.com/altos/css/crm/default/200px.css" title="Current local market statistics" width="400" height="450" allowTransparency="true" scrolling="no" frameborder="0" marginwidth="0" marginheight="0"></iframe>
	</div>
</div>

</body>
</html>