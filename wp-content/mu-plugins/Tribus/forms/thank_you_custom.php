<?php global $catArray; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style-white.css" type="text/css" media="screen" />
<link rel="icon" href="<?php bloginfo('url'); ?>/favicon.ico" type="image/x-icon">
<script type='text/javascript' src='<?= get_bloginfo("stylesheet_directory") ; ?>/js/datepicker/js/jquery.js'></script>
<script type='text/javascript' src='<?= get_bloginfo("stylesheet_directory") ; ?>/js/datepicker/js/jquery-ui.js'></script>
<script type='text/javascript' src='<?= get_bloginfo("stylesheet_directory") ; ?>/js/jquery-validate/jquery.validate.js'></script>
<link type="text/css" href="<?= get_bloginfo("stylesheet_directory") ; ?>/js/datepicker/css/ui-darkness/jquery-ui-1.8.6.custom.css" rel="Stylesheet" />	


<script>
	jQuery(function() {
		jQuery( "#date" ).datepicker();
	});
	</script>


</head>
<body>

<?php
/*
Template Name: Thank You
*/

$style = '';

if ($_REQUEST['action'] == 'email-us') {

	$args = array(
		'first_name'	=>	$_REQUEST['first_name'],
		'last_name'		=>	$_REQUEST['last_name'],
		'phone'			=>	$_REQUEST['phone'], 
		'email'			=>	$_REQUEST['email'],
		'comments'		=>	$_REQUEST['comments'],
		'communicate'	=>	$_REQUEST['communicate'],
		'send_id'		=>	$_REQUEST['send_id']
	);
	tribus_send_info($args, 'Contact');
	$style = 'white';

} else if ($_REQUEST['action'] == 'home-worth') {

	$args = array(
		'area'			=>	$_REQUEST['area'],
		'beds'			=>	$_REQUEST['beds'],
		'phone'			=>	$_REQUEST['phone'],
		'sqft'			=>	$_REQUEST['sqft'],
		'first_name'	=>	$_REQUEST['first_name'],
		'last_name'		=>	$_REQUEST['last_name'],
		'email'			=>	$_REQUEST['email'],
		'home_worth'	=> '1'
	);
	tribus_send_info($args, 'What Is My Home Worth?');

}
else if($_REQUEST['action'] == "more-info")
{
	$args = array(
		'first_name'	=>	$_REQUEST['first_name'],
		'last_name'		=>	$_REQUEST['last_name'],
		'phone'			=>	$_REQUEST['phone'], 
		'email'			=>	$_REQUEST['email'],
		'comments'		=>	$_REQUEST['comments'],
		'address'		=>	$_REQUEST['address'],
		'price'			=>	$_REQUEST['price'],
		'city'			=>	$_REQUEST['city'],
		'send_id'		=>	$_REQUEST['send_id'],
		'communicate'	=>	$_REQUEST['communicate'],
		'date'			=>	$_REQUEST['date'],
		'time'			=>	$_REQUEST['time'],
		'cloud_cma'		=>	$_REQUEST['cloud_cma']
	);
	tribus_send_info($args, 'Contact');
	$style = 'white';
}

if($_REQUEST['cloud_cma'])
{
	$args = array(
		'user'		=> 'cbainfo@cballiance.net',
		'url'		=> $_REQUEST['url'],
		'email_to'	=> $_REQUEST['email']
	);

	//print_r($args);

	$query = http_build_query($args);
	$posturl = "http://cloudcma.com/properties/widget";
	$ch = curl_init();    // initialize curl handle
	curl_setopt($ch, CURLOPT_URL, $posturl); // set url to post to
	curl_setopt($ch, CURLOPT_POSTFIELDS, $query); // add POST fields
	$useragent="Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1";
	curl_setopt($ch, CURLOPT_USERAGENT, $useragent); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
	$result = curl_exec($ch); // run the whole process
	curl_close ($ch);

}

get_header($style);

the_post();

?>
	
	<div id="content">
	
		<div id="sub-content">
		<div id="email-header">
			<h2><?php the_title(); ?></h2>
		</div>
		<div id="page-content">
					
								
		<?
		if($_REQUEST['cloud_cma']) { ?>

		Thank you for your request. Please check your email, you should receive a PDF with your property report in just a few moments.

		<? } else { ?>
			<?php the_content(); ?>
		<? } ?>
				
	
		</div><!-- #content -->
	
	<?php if (!$style) get_sidebar() ?>
	
	</div><!-- #page -->
	

</body>
</html>