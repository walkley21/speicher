<?php 
/*
Template name : Single-Posting
*/


/*
 * IMPORTANT IMPORTANT  IMPORTANT  IMPORTANT  IMPORTANT IMPORTANT  IMPORTANT  IMPORTANT IMPORTANT  IMPORTANT 
 * All changes must be validated agains a craig list ad.
 * IMPORTANT  IMPORTANT IMPORTANT  IMPORTANT  IMPORTANT  IMPORTANT IMPORTANT IMPORTANT  IMPORTANT IMPORTANT 
 */

require_once("myposting.class.php");	
require_once("bitly.class.php");	
	
//*image gallery in case it doesn't come from the mls *//	
$images =& get_children( 'post_type=attachment&order=ASC&post_mime_type=image&numberposts=-1&post_parent=' . $post->ID ); 
           
			
	
    $bitlyUser = get_option('tribusThemeBitly');
	$bitlyKey  = get_option('tribusThemeBitlyApi');
	$b = new Bitly($bitlyUser,$bitlyKey);
	//echo "short is $b";
	
	// get the mls from the theme options
	$mls = get_post_meta($post->ID, 'posting_mls', true);
        
        //$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
	//$image_array = wp_get_attachment_image_src($post_thumbnail_id);
        
       // print_r($image_array);
        //echo "curernt [$mls]";  
            
        
	//echo "mls is $mls";
	// get the path to the logo image
	$logoPath =  get_option('tribusLogoPath');

        //echo "[$logoPath]";    
        
	// get feed id from theme options
	$feedid = get_option('tribusThemeFeedId');

        /* more information link*/
        $more_info='';
        if (!empty($mls)){
	$more_info = site_url().'/idx/mls-'.$mls.'-';
        }
        else
        {
             $more_info = get_post_meta($post->ID, 'posting_more', true);
        }
        
        $similar = get_post_meta($post->ID, 'posting_similar_homes', true);
        
        if (!empty($similar))// check for the http part 
        {
            if((substr_compare($similar,"http://",0,7)) === 0) $similar = $similar;
            else $similar = "http://{$similar}";
        }
        
        
        $textLink = get_post_meta($post->ID, 'posting_text', true);
        $urlLink  = get_post_meta($post->ID, 'posting_search_link', true);
        
        
        $address = get_post_meta($post->ID, 'posting_address', true);
        $price   = get_post_meta($post->ID, 'posting_price', true);
        //echo "price is [$price]";
        $beds   = get_post_meta($post->ID, 'posting_beds', true);
        $baths   = get_post_meta($post->ID, 'posting_baths', true);
        $garage   = get_post_meta($post->ID, 'posting_garage', true);
        $lote   = get_post_meta($post->ID, 'posting_lote', true);
        $status   = get_post_meta($post->ID, 'posting_status', true);
        $county   = get_post_meta($post->ID, 'posting_county', true);
        $year   = get_post_meta($post->ID, 'posting_year', true);
        
        
	$p = new MyPosting($mls,$feedid);
	
        if (!$p->Found())/*MLS number is invalid or out of the allowed to this site*/
        {
            echo "<h1>Property not found.</h1>";
            return;
        }
        
        
        $user = get_userdata($post->post_author);	
	                
        $current_user = wp_get_current_user();
                            
        if($user->user_photo)
            $photo = $user->user_photo;
        else
            $photo = get_bloginfo("stylesheet_directory") . "/images/thumb_nophoto.jpg";
      

/*doesn't require a header nor nav bar, just search box */
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php language_attributes(); ?>>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	
    
	
    
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<title><?php wp_title(); ?></title>
	
	<?php wp_head(); ?>
    
    <!-- copy to clipboeard --->
    <script type="text/javascript" src="<?php echo get_template_directory_uri()."/js/ZeroClipboard.js" ?>"></script>
	<!--script type="text/javascript" src="<?php echo get_template_directory_uri()."/js/jquery.js" ?>"></script-->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri()."/js/images.js" ?>"></script>
	
	<style type="text/css">
		/*copy to clipboard button*/
		
		#copy:hover { background-color:#eee; }	
		#copy:active { background-color:#aaa; }	
			  
		#d_clip_button.hover { background-color:#eee; }
		
		#d_clip_button.active { background-color:#aaa; }
	</style>
	
	<script language="JavaScript">
		
		/*basicall there are two instances of the object*/
		
		//var clip = null;
		jQuery(document).ready(function(){
			ZeroClipboard.setMoviePath( '<?php echo get_template_directory_uri() ?>/js/ZeroClipboard.swf' );
			init(jQuery('#craigtable'));
			ClipBoard();
		});
		
		function init(obj) {
  		  

			var clip = new ZeroClipboard.Client();
			clip.setHandCursor( true );
			clip.addEventListener('mouseOver', function (client) {
				// update the text on mouse over
				var text = jQuery(obj).html();
				clip.setText(text);
			});
			clip.glue( 'd_clip_button', 'd_clip_container' );
			
		}
		function ClipBoard() {
  		  

			var clip2 = new ZeroClipboard.Client();
			clip2.setHandCursor( true );
			clip2.addEventListener('mouseOver', function (client) {
				// update the text on mouse over
				var text = '<?php echo $b;?>';
				clip2.setText(text);
			});
			clip2.glue( 'copywrapper', 'copy' );
			
		}
        
		
	</script>
        
        <script>
            (function ($){
                    var utm = '<?php echo $_GET['utm_source'];?>';
                    if (utm=='')        
                    this.location="?utm_source=TribusPostings&utm_medium=CL&utm_campaign=TribusPostings";
                
            })(jQuery);
        </script>
</head>


<body class="<?php echo $themeColor; ?>" 
style="background-color:#73777E; position:relative;"><!-- same as add container -->
<style>
div{margin:0; padding:0}
#copywrapper{
	width:240px!important;
}
#copy,#d_clip_button
{
	padding:4px;
}
#copywrapper,
#d_clip_container{
	width:200px;
	border:1px solid #CCC;
	float:left;
	background-color:white;
	border-radius:3px;
	margin-right:20px;
	font-size:12px;
	
}

td,table{
    
    /*border:1px solid red;
    border-collapse: collapse;*/
}
</style>


<?php 

$post_object = get_post(  get_the_ID() );
$content=$post_object->post_content;

//echo "content is [$content]";

?>


<?php if ( current_user_can('manage_options') ==true ) : ?>
 <!--- copy to clipboard --->
<div  style="width:720px;margin:0 auto;">
	
     <div id="d_clip_container"  >
        <div id="d_clip_button" >
            Copy html code to clipboard
        </div>
    </div>

<!--- copy shorten url to clipboard --->


    <div id="copywrapper" >
         <div id="copy">Copy Bit.ly URL <?php echo $b	?></div>
    </div>


</div>
    
<div style="clear:both;height:1px;">    

<?php endif; ?>
<!-- copy to clipboard ends ---->



<div id="craigtable" > 
<table width="100%" border="0" >
<tr>
	<td bgcolor="#73777E" align="center" >
 		<br /><!-- a bit of padding-->	         
        <table width="710" border="0" align="center" style="background-color:#fff;" bgcolor="#ffffff">
            <tbody>
            <tr>
            <td colspan="2" align="center" style="padding:10px;">
                 <font size="+4">
                
                <?php the_title() ?>
                
                </font>
            </td>
            </tr>
            <tr>
                <td colspan="2" align="center" style="border:1px solid #03C;padding:10px;" bgcolor="#E7EFFE">
                    <font size="+2" color="#354698"><?php echo $p->getAddress($address); ?></font>
                </td>
            </tr>
                
                <tr>
                    
                    <td id="mainImage" width="400" height="274" align="center" valign="top">
                         
                         <?php /*if mls the image come from url , else display featured image*/?>
                         <?php if (!empty($mls)): ?>   
                         <?php echo $p->getMainImage(400); ?>
                         <?php else:
                         /* single posting size as defined in the functions.php file */    
                         the_post_thumbnail('single_posting','style="vertical-align:top"'); 
                         endif; ?>
                            
                    
                    </td>
                    
                    <td  valign="top" style="vertical-align:top">
                    <table width="100%" border="0" style="border-collapse:collapse;" >
                      <tr>
                        <td><table width="100%" border="0" cellpadding="2" cellspacing="0">
                          <tbody>
                            <tr>
                              <td colspan="2" align="center" style="border:1px solid #03C;padding:4px" ><font size="+1" color="#354698"> Property Features </font></td>
                            </tr>
                            <tr  >
                              <th align="left" bgcolor="#FFFFFF" >Offered at</th>
                              <td bgcolor="#FFFFFF"><?php echo $p->getPrice($price)?></td>
                            </tr>
                              
                            <?php  ?>
                            <?php if ( (!empty($beds) and empty($mls)) or (!empty($mls))  ): ?>  
                            <tr >
                              <th align="left" bgcolor="#EBEBEB">Beds</th>
                              <td bgcolor="#EBEBEB"><?php echo $p->getBeds($beds)?></td>
                            </tr>
                            <?php endif; ?>
                              
                             <?php if ( (!empty($baths) and empty($mls)) or (!empty($mls))  ): ?>  
                            <tr >
                              <th align="left" bgcolor="#FFFFFF">Baths</th>
                              <td bgcolor="#FFFFFF"><?php echo $p->getBaths($baths)?></td>
                            </tr>
                            <?php endif; ?>  
                              
                              
                           <?php if ( (!empty($garage) and empty($mls)) or (!empty($mls))  ): ?>   
                            <tr >
                              <th align="left" bgcolor="#EBEBEB">Garage</th>
                              <td bgcolor="#EBEBEB"><?php echo $p->getGarages($garage)?></td>
                            </tr>
                           <?php endif; ?>
                             
                              
                             <?php if ( (!empty($lote) and empty($mls)) or (!empty($mls))  ): ?>    
                            <tr >
                              <th align="left" bgcolor="#FFFFFF">Lot size</th>
                              <td bgcolor="#FFFFFF"><?php echo $p->getHouseSqFeet($lote)?></td>
                            </tr>
                            <?php endif; ?>     
                              
                              
                             <?php if ( (!empty($status) and empty($mls)) or (!empty($mls))  ): ?>     
                            <tr >
                              <th width="50%" align="left" bgcolor="#EBEBEB">Status</th>
                              <td bgcolor="#EBEBEB"><?php echo $p->getStatus($status)?></td>
                            </tr>
                             <?php endif; ?>     
                              
                            <?php if ( (!empty($county) and empty($mls)) or (!empty($mls))  ): ?>  
                            <tr >
                              <th align="left" bgcolor="#FFFFFF">County</th>
                              <td bgcolor="#FFFFFF"><?php echo $p->getCounty($county) ?></td>
                            </tr>
                            <?php endif; ?>  
                              
                             <?php if ( (!empty($year) and empty($mls)) or (!empty($mls))  ): ?>   
                            <tr >
                              <th align="left" bgcolor="#EBEBEB">Year Built</th>
                              <td bgcolor="#EBEBEB"><?php echo $p->getYearBuilt($year)?></td>
                            </tr>
                           <?php endif; ?>  
                              
                          </tbody>
                        </table></td>
                      </tr>
                        
                      <?php if(!empty($more_info)):?>  
                      <tr>
                        <td>
                            <a href="<?php echo $more_info?>" >
                                <img src="<?php echo get_template_directory_uri() ?>/images/more-info.png" />
                            </a>
                        </td>
                      </tr>
                      <?php endif; ?>  
                      <?php if (!empty($similar)):?>  
                      <tr>
                        <td>
                            <a  href="<?php echo $similar; ?>" >
                             <img src="<?php echo get_template_directory_uri() ?>/images/similar-homes.png"/>
                            </a>
                        </td>
                      </tr>
                      <?php endif; ?>  
                        
                    </table></td>
                    
              </tr>   
                
            <?php if (!empty($mls) or (!empty($images))): ?>   
            <tr>
                <td colspan="2" id='gallery' align="center">
                        <?php
                        if (!empty($mls)):
                        echo $p->getGallery();
                        else:
                        $gallery = '<table border="0" align="center"><tr>';
                         foreach ( $images as $attachment_id => $attachment )
                         {
                                $img = wp_get_attachment_image_src($attachment_id, 'full');
                                $image_attributes = wp_get_attachment_image_src( $attachment_id ); // returns an array
                                $gallery.='<td>';
                                $gallery.='<a href="#">';
                                $gallery.='<img src="'.$image_attributes[0].'" width="40" height="40">';
                                $gallery.='</a>';
                                $gallery.='</td>';
                         }
                        $gallery.='</tr></table>';
                        echo $gallery;
                        endif;
                        ?>               
                        
                        
                </td>
            </tr>
            <?php endif; ?>    
            <tr>
            <td colspan="2" style="vertical-aling:top;" valign="top">
                
                    <?php echo $p->getDescription($content) ?>
                
            </td>
            </tr>
            <?php if(!empty($textLink) and (!empty($urlLink))): ?>
                <tr>
                    <td>
                        <div>
                            <a href="<?php echo $urlLink?>"><?php echo $textLink ?></a>      
                        </div>
                    </td>
                </tr>
            <?php endif;?>    
                
            <tr>
            <td colspan="2"  valing="top">
                <table width="100%" bgcolor="#EBEBEB" border="0" align="center" cellpadding="4" cellspacing="0" style="border:1px solid #cccccc;">
                    <tr>
                        <td width="583" valing="top">
                            <table width="100%" border="0">
                          <tr>
                            <td  style="padding:10px;" width="30%" rowspan="3" align="center" valign="middle">
                                <img width="90px" style="vertical-align:top" height="96px" src="<?php echo $photo; ?>"/>
                            </td>
                            <td colspan="6" style="padding:10px 0 0 0;">
                                <font size="+2" color="#3300CC">
                                        <?php bloginfo( 'name' );  ?>
                                </font>
                                
                            </td>
                          </tr>
                          <tr>
                            <td colspan="6" style="padding:10px 0;">
                                <font size="+2" color="#747474">
                                    <?php echo $user->display_name;?>
                                </font>
                            </td>
                            </tr>
                          <tr>
                             <?php if ($user->facebook ): ?>
                                <td>
                                   <a href="http://www.facebook.com/<?php echo $user->facebook; ?>" rel="nofollow" target="_blank"><img src="<?php bloginfo('stylesheet_directory')?>/images/01-fb.png" width="40px" height="40px" /></a>
                                </td>
                               <?php endif;?>
                               <?php if ($user->twitter ): ?>
                                   <td><a href="http://twitter.com/<?php echo $user->twitter; ?>" rel="nofollow" target="_blank"><img src="<?php bloginfo('stylesheet_directory')?>/images/02-tw.png" width="40px" height="40px" /></a></td>
                               <?php endif;?>
                               <?php if ($user->linkedin ): ?>
                                   <td><a href="https://www.linkedin.com/in/<?php echo $user->linkedin; ?>" rel="nofollow" target="_blank"><img src="<?php bloginfo('stylesheet_directory')?>/images/03-linked.png" width="40px" height="40px" /></a></td>
                               <?php endif;?>
                               <?php if ($user->pinterest ): ?>
                                   <td><a href="http://pinterest.com/<?php echo $user->pinterest; ?>" rel="nofollow" target="_blank"><img src="<?php bloginfo('stylesheet_directory')?>/images/04-pin.png" width="40px" height="40px" /></a></td>
                               <?php endif;?>
                               <?php if ($user->googleplus ): ?>
                                   <td><a href="https://plus.google.com/<?php echo $user->googleplus; ?>" rel="nofollow" target="_blank"><img src="<?php bloginfo('stylesheet_directory')?>/images/05-g.png" width="40px" height="40px" /></a></td>
                               <?php endif;?>
                                   
                          </tr>
                        </table></td>
                       
                        <td width="" align="center" valign="middle">
                            <?php
                           
                            if(!empty($logoPath)): ?>
                            <img style="vertical-align:top" width="150px" height="150px" src="<?php echo $logoPath ?>" />
                            <?php endif; ?>
                        </td>
                    </tr>
                   
                </table>
                
            </td>
            </tr>
            <tr>
                      <td colspan="2" align="center" style="font-size: 10px;color:#666;" >
                          <font size="1" color="#666">   <a  style="text-decoration:none;color:#666;" href="http://www.TribusGroup.com">LISTING BUILDER PROVIDED BY : TRIBUS REAL ESTATE WEBSITES</a>
                          </font>     
                      </td>
            </tr>
                    
        </tbody>
    </table>
<br /><!-- a bit of padding-->	
</td>
</tr>
</table>	        
        
        
</div>



<script>

function imgError(image) {
    //image.onerror = "";
    //image.src = "/images/noimage.gif";
	$(image).remove();
    return true;
}


(function($){
	$(document).ready(function(){

	/*
	ddd
	*/
	
	$('#gallery a img').hover(function (){
	
		//alert(5)
		var att = $(this).attr('src');
		//alert(att)
		var re  = att.replace(/tiny/g,'full');
		//att.replace("",'full');
		//alert(re)
		$('#mainImage img').attr('src',re);
		
		
		
	},function(){});
	
	
	
});
	
} )(jQuery);

</script>

</body>
