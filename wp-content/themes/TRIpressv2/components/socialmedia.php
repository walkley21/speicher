<?php 
    
    
?>

<div id="social-media"  >
    
    <ul id="social-media-ul-new" >
        <?php if ($fb = getLink('tribusThemeFacebookLink')):?>
        <li><a href="<?php echo $fb ?>" class="fb">facebook</a></li>
        <?php endif; ?> 
        
        <?php if ($tw = getLink('tribusThemeTwitterLink')):?>
        <li><a href="<?php echo $tw ?>" class="tw">twitter</a></li>
        <?php endif; ?> 
        
        <?php if ($gp = getLink('tribusThemeGooglePlusLink')):?>
        <li><a href="<?php  echo $gp; ?>" class="gp">google</a></li>
        <?php endif; ?> 
        
        <?php if ($li = getLink('tribusThemeLinkedInLink')):?>
        <li><a href="<?php echo $li ?>" class="li">linked id</a></li>
        <?php endif; ?> 
        
        
        <?php if ($yt = getLink('tribusThemeYouTubeLink')):?>
        <li><a href="<?php echo $yt ?>" class="yt">you tube</a></li>
        <?php endif; ?> 
        
        <li  id="email-link" class="visible-phone visible-tablet" >
         <a  id="email-icon-only" href="<?= get_bloginfo('url');?>/forms/email-us/" data-toggle="modal" class="email" data-target="#myModal">Email Us</a>
            
        </li>
        
        
    </ul>
    
</div>

<?php 

    function getLink($brand )
    {
        $channel = get_option($brand);
        $url = '#';
        if ( $channel )  
	$url = ( substr($channel, 0, 7) == "http://" ) ? $channel : "http://{$channel}";
        return $url;
    }

?>