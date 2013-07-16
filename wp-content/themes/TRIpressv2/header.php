<!DOCTYPE html >
<html <?php language_attributes(); ?>  class="html5">
<?php 
global $is_my_home;
?>    
<head>
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
        
        <!--[if lt IE 9]>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri() ?>/css/ie.css" />
        <![endif]-->
        
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<title><?php wp_title(); ?></title>
	
	<?php if ( get_option('tribusThemeNameFont') ) { ?>
	<link href='http://fonts.googleapis.com/css?family=<?php echo urlencode(get_option('tribusThemeNameFont')); ?>' id="nameFontCss" rel='stylesheet' type='text/css'>
	<?php } ?>
	
	<?php if ( get_option('tribusThemeDescriptionFont') ) { ?>
	<link href='http://fonts.googleapis.com/css?family=<?php echo urlencode(get_option('tribusThemeDescriptionFont')); ?>' id="descFontCss" rel='stylesheet' type='text/css'>
	<?php } ?>
        <!-- create the font classes so they can be applied to any style -->
        <style>
            .Primary-Font {font-family:'<?php echo get_option('tribusThemeNameFont')?>'!important;}
             #page, .Secondary-Font {font-family:'<?php echo get_option('tribusThemeDescriptionFont')?>'!important;}
             #menu-main-menu a{font-family:'<?php echo get_option('tribusThemeNameFont')?>'!important;}
        </style>
        
        
	<!----------- BEFORE WP HEAD -->
	<?php wp_head(); ?>
        <!-- AFTER WP HEAD -->


        
        
<?php $themeColor = ( get_option('tribusThemeColor') ) ? get_option('tribusThemeColor') : 'gray'; ?>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_bloginfo('template_directory')."/css/". $themeColor?>/css.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_bloginfo('template_directory')."/css/". $themeColor?>/menu/menu.css" />

</head>
<body <?php body_class(); ?> style="position:relative;" >

    
    <div id="page" class="<?php echo $themeColor ?> " >
   
   		
        <div id="social-contact" class="color" >
           <div id="social-contact-inner" style="position:relative;" >
           		
                <?php if (!$is_my_home):?>
                <div id="site-name">
                    <?php  global $Tribus; ?>
                	<?php  echo $Tribus->tribus_theme->custom_title(); ?>
                </div> 
                <?php endif; ?>
           
           
           		<div class="" id="right-part-container"  >
                    <?php get_template_part( 'components/contact') ?>
                </div>  
                <div class="<?php echo ($is_my_home)?'alignLeft':'alignRight'; ?>" id="social-media-container" >
                    <?php get_template_part( 'components/socialmedia') ?>
                </div>
                 
            </div>    
        </div>
       
        
    <div style="clear: both;"></div>
     <?php  if( !$is_my_home): ?>
        <?php get_template_part('components/navigation')?>
    <?php endif; ?> 
    <div id="mainContent" class="<?php echo ($is_my_home)?'home-page-wrapper':'non-home-page-wrapper'; ?>" >
       
    <?php  
	if (!$is_my_home) 
	{
		 dynamic_sidebar('horizontal-search') ;
	}
	
	?>
   
    
   
