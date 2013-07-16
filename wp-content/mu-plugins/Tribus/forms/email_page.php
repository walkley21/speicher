<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="description" content="<?php bloginfo('description') ?>" />
<meta name="generator" content="WordPress <?php bloginfo('version') ?>" /><!-- Please leave for stats -->

<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> &raquo; Blog Archive <?php } ?> <?php wp_title(); ?></title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>?v=3" type="text/css" media="screen" />

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> Comments RSS Feed" href="<?php bloginfo('comments_rss2_url') ?>"  />

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />	

<style>
body {
	font-family: Tahoma,Geneva,sans-serif;
	background-color: #3F3D3B;
}
h2 {
	font-family: Tahoma,Geneva,sans-serif;
}
</style>

</head>

<body>

<?php

if($_REQUEST['submit'])
{

	$to = $_REQUEST['receive-email'];
	$subject = $_REQUEST['sender-name'] . " has sent you a real estate listing.";
	$message = $_REQUEST['receive-name'] . ",\n";
	$message .= $_REQUEST['sender-name'] . " has sent you the following real estate listing to check out. \n\n";
	$message .= get_bloginfo('siteurl') . "/listings/". $_REQUEST['page'] . "/" . "\n\n";
	$message .= stripslashes($_REQUEST['message']);

	 wp_mail( $to, $subject, $message, $headers, $attachments );

	$emailInfo = "To: $to (". $_REQUEST['receive-name'].")\nFrom: ". $_REQUEST['sender-email']." (".$_REQUEST['sender-name'].")\n\n";
	$emailInfo .= "Listing: ". get_bloginfo('siteurl') . "/listings/". $_REQUEST['page'] . "/" . "\n\n";
	$emailInfo .= "Message: ". stripslashes($_REQUEST['message']);

	 $args = array(
		'emailListing'			=>	$emailInfo,
	);
	tribus_send_info($args, 'Email Listing Sent');
}
?>

	<div id="listing">
		<h2>Email This Listing</h2>
		
		<? if ($_REQUEST['submit']) { ?>
			Your message has been sent.
		<? } else { ?>
		<?= $post->post_content;?>

		<form action="" method="post">

		<div class="email-item">
			<label>Your Name:</label> <input name="sender-name">
		</div>

		<div class="email-item">
			<label>Your Email:</label> <input name="sender-email">
		</div>

		<div class="email-item">
			<label>Friend's Name:</label> <input name="receive-name">
		</div>

		<div class="email-item">
			<label>Friend's Email:</label> <input name="receive-email">
		</div>

		<div class="email-item">
			<label>Message:</label> <textarea name="message" cols="35" rows="4"></textarea>
		</div>

		<div class="email-item">
			<input type="submit" name="submit" value="submit">
		</div>
		<input type="hidden" name="page" value="<?= $_REQUEST['page'];?>">

		</form>

		<? } ?>
		
	</div>

</body>
</html>