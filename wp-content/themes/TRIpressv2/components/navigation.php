<?php 
$themeColor = ( get_option('tribusThemeColor') ) ? get_option('tribusThemeColor') : 'gray'; 
$class = '';
if ($themeColor == 'blue' or $themeColor=='red')
{
	$class= 'navbar-inverse';
}
?>



<div class="navbar <?php echo $class ?>">
        <div class="navbar-inner">
                <div class="container">
                          <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                          </a>
                
                          <div class="nav-collapse collapse navbar-responsive-collapse">
                                 <?php 
                
                                     $args = array(
                                                                'theme_location' => '',
                                                                'depth'		 => 2,
                                                                'container'	 => false,
                                                                'menu_class'	 => 'nav Primary-Font',
                                                                'walker'	 => new Bootstrap_Walker_Nav_Menu()
                                                            );
                                             
                                                            wp_nav_menu($args);
                                
                                ?>
                            
                          </div><!-- /.nav-collapse -->
                </div>
       	</div><!-- /navbar-inner -->
</div><!-- /navbar -->