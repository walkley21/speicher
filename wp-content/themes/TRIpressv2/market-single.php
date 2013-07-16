<?php get_header(); 
require_once("dom.php");

if (isset($_GET['testzip']))
$testZip = $_GET['testzip'];



?>
<div id="mainWrapper" class="blogDetailView" >
<a href="/market-stats" style="float:left;margin:15px 0px 10px 0px;">&laquo; Back To All Market Stats</a>
<div class="clear"></div>
<h2 class="h2-border" style="margin-top:0;"><?php echo ucwords( urldecode($city) ); ?>, <?php echo $state; ?> <?php if ( $zip != 'a' ) { echo "({$zip})"; } ?></h2>
	
<?php function displaySF($city, $state, $zip) { 





?>

<div id="market-stats-content">

	<?php 
	$path = "http://charts.altosresearch.com/altos/app?pai=".PAI."&ra=a&q=a&st={$state}&c={$city}&z={$zip}&service=statTable&rt=sf&l=f";

	$html = file_get_html($path);
	
	
	
	
	$Table =  $html->getElementById("full");
	
	?>
	<div class="row-fluid">
    	<div class="span12"><?php echo $Table?></div>
    </div>

	<!--iframe class="" style="border:none;padding:none;"  scrolling="no" src="http://charts.altosresearch.com/altos/app?pai=<?php echo PAI; ?>&ra=a&q=a&st=<?php echo $state; ?>&c=<?php echo $city; ?>&z=<?php echo $zip; ?>&service=statTable&rt=sf&l=f">Frames not supported</iframe-->
	<div id="market-stats-buttonsss" class="row-fluid">
		<a href="<?php bloginfo('url'); ?>/forms/market-report/?iframe=true&width=450&height=500" style="float:left;margin-right:10px;" class="prettyPhoto "><img src="<?php bloginfo('stylesheet_directory'); ?>/images/market-report.png"></a>
		<?php if ( $zip != 'a' ) { ?>
			<a href="<?php bloginfo('url'); ?>/idx/?idx-q-ZipCodes=<?php echo $zip; ?>" style="float:left; class=""><img src="<?php bloginfo('stylesheet_directory');?>/images/market-search.png"></a>
		<?php } else { ?>
			<a href="<?php bloginfo('url'); ?>/idx/?idx-q-Cities=<?php echo $city; ?>"  style="float:left;class=""><img src="<?php bloginfo('stylesheet_directory');?>/images/market-search.png"></a>
		<?php } ?>
	</div>
	<br />
	<div class="stats row-fluid">
		
		<img  class="span5 offset1" src="http://charts.altosresearch.com/altos/app?s=median:r,&ra=c&q=a&st=<?php echo $state; ?>&c=<?php echo $city; ?>&z=<?php echo $zip; ?>&sz=s&ts=e&rt=sf&service=chart&pai=<?php echo PAI; ?>&co=0&endDate=&startDate=&theme=newchart" alt="Home Inventory in <?php echo ucwords( urldecode($city) ); ?>, <?php echo $state; ?> <?php if ( $zip != 'a' ) { echo "({$zip})"; } ?>">
		<img  class="span5 offset1" src="http://charts.altosresearch.com/altos/app?s=inventory:r,&ra=c&q=a&st=<?php echo $state; ?>&c=<?php echo $city; ?>&z=<?php echo $zip; ?>&sz=s&ts=e&rt=sf&service=chart&pai=<?php echo PAI; ?>&co=0&endDate=&startDate=&theme=newchart" alt="Median Price of Homes in <?php echo ucwords( urldecode($city) ); ?>, <?php echo $state; ?> <?php if ( $zip != 'a' ) { echo "({$zip})"; } ?>">
		
	</div>
	<div class="stats row-fluid">
    
    <img  class="span5 offset1" src="http://charts.altosresearch.com/altos/app?s=mean_dom:r,&ra=c&q=a&st=<?php echo $state; ?>&c=<?php echo $city; ?>&z=<?php echo $zip; ?>&sz=s&ts=e&rt=sf&service=chart&pai=<?php echo PAI; ?>&co=0&endDate=&startDate=&theme=newchart" alt="Average Days on Market of Homes in <?php echo ucwords( urldecode($city) ); ?>, <?php echo $state; ?> <?php if ( $zip != 'a' ) { echo "({$zip})"; } ?>">
	<img  class="span5 offset1" src="http://charts.altosresearch.com/altos/app?s=median_market_heat:r,&ra=c&q=a&st=<?php echo $state; ?>&c=<?php echo $city; ?>&z=<?php echo $zip; ?>&sz=s&ts=e&rt=sf&service=chart&pai=<?php echo PAI; ?>&co=0&endDate=&startDate=&theme=newchart" alt="Real Estate Market Index in <?php echo ucwords( urldecode($city) ); ?>, <?php echo $state; ?> <?php if ( $zip != 'a' ) { echo "({$zip})"; } ?>">
	</div>
    
<?php } ?>

<?php function displayMF($city, $state, $zip) { ?>
<div id="market-stats-content" class="row-fluid">
	<iframe id="statsFrame" class="span12"  scrolling="no" src="http://charts.altosresearch.com/altos/app?pai=<?php echo PAI; ?>&ra=a&q=a&st=<?php echo $state; ?>&c=<?php echo $city; ?>&z=<?php echo $zip; ?>&css=http://charts.altosresearch.com/altos/css/crm/midnightblue/stattable.css&service=statTable&rt=mf&l=f">Frames not supported</iframe>
	<div id="market-stats-buttons">
		<a href="<?php bloginfo('url'); ?>/forms/market-report/?iframe=true&width=450&height=500" class="prettyPhoto"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/market-report.png"></a>
		<?php if ( $zip != 'a' ) { ?>
			<a href="<?php bloginfo('url'); ?>/idx/?idx-q-ZipCodes=<?php echo $zip; ?>"><img src="<?php bloginfo('stylesheet_directory');?>/images/market-search.png"></a>
		<?php } else { ?>
			<a href="<?php bloginfo('url'); ?>/idx/?idx-q-Cities=<?php echo $city; ?>"><img src="<?php bloginfo('stylesheet_directory');?>/images/market-search.png"></a>
		<?php } ?>
	</div>
	<div class="stats">
		<h4>Condominiums</h4>
		<img src="http://charts.altosresearch.com/altos/app?s=median:r,&ra=c&q=a&st=<?php echo $state; ?>&c=<?php echo $city; ?>&z=<?php echo $zip; ?>&sz=s&ts=e&rt=mf&service=chart&pai=<?php echo PAI; ?>&co=0&endDate=&startDate=&theme=newchart" alt="Home Inventory in <?php echo ucwords( urldecode($city) ); ?>, <?php echo $state; ?> <?php if ( $zip != 'a' ) { echo "({$zip})"; } ?>">
		<img src="http://charts.altosresearch.com/altos/app?s=inventory:r,&ra=c&q=a&st=<?php echo $state; ?>&c=<?php echo $city; ?>&z=<?php echo $zip; ?>&sz=s&ts=e&rt=mf&service=chart&pai=<?php echo PAI; ?>&co=0&endDate=&startDate=&theme=newchart" alt="Median Price of Homes in <?php echo ucwords( urldecode($city) ); ?>, <?php echo $state; ?> <?php if ( $zip != 'a' ) { echo "({$zip})"; } ?>">
		<img src="http://charts.altosresearch.com/altos/app?s=mean_dom:r,&ra=c&q=a&st=<?php echo $state; ?>&c=<?php echo $city; ?>&z=<?php echo $zip; ?>&sz=s&ts=e&rt=mf&service=chart&pai=<?php echo PAI; ?>&co=0&endDate=&startDate=&theme=newchart" alt="Average Days on Market of Homes in <?php echo ucwords( urldecode($city) ); ?>, <?php echo $state; ?> <?php if ( $zip != 'a' ) { echo "({$zip})"; } ?>">
		<img src="http://charts.altosresearch.com/altos/app?s=median_market_heat:r,&ra=c&q=a&st=<?php echo $state; ?>&c=<?php echo $city; ?>&z=<?php echo $zip; ?>&sz=s&ts=e&rt=mf&service=chart&pai=<?php echo PAI; ?>&co=0&endDate=&startDate=&theme=newchart" alt="Real Estate Market Index in <?php echo ucwords( urldecode($city) ); ?>, <?php echo $state; ?> <?php if ( $zip != 'a' ) { echo "({$zip})"; } ?>">
	</div>
<?php } 

switch ( $prop_type ) {
	case 'mf' :
		displayMF($city, $state, $zip);
	break;
	case 'sf' :
		displaySF($city, $state, $zip);
	break;
	default:
		displaySF($city, $state, $zip);
		displayMF($city, $state, $zip);
	break;
} 


?>
	
</div>


<?php
if ( defined("DSIDXPRESS_OPTION_NAME")  ) {
	$z = ( $zip != 'a' ) ? $zip : "";
	$atts = shortcode_atts(array(
		"city"			=> isset($testZip)?'':$city,
		"community"		=> "",
		"tract"			=> "",
		"zip"			=> isset($testZip)?$testZip:$z,
		"minprice"		=> "",
		"maxprice"		=> "",
		"propertytypes"	=> "",
		"linkid"		=> "",
		"count"			=> "6",
		"orderby"		=> "DateAdded",
		"orderdir"		=> "DESC",
		"showlargerphotos"	=> "true"
	), $atts);

	$apiRequestParams = array();
	$apiRequestParams["responseDirective.ViewNameSuffix"] = "shortcode";
	$apiRequestParams["responseDirective.IncludeMetadata"] = "true";
	$apiRequestParams["responseDirective.IncludeLinkMetadata"] = "true";
	$apiRequestParams["responseDirective.ShowLargerPhotos"] = $atts["showlargerphotos"];
	$apiRequestParams["query.Cities"] = htmlspecialchars_decode($atts["city"]);
	$apiRequestParams["query.Communities"] = htmlspecialchars_decode($atts["community"]);
	$apiRequestParams["query.TractIdentifiers"] = htmlspecialchars_decode($atts["tract"]);
	$apiRequestParams["query.ZipCodes"] = $atts["zip"];
	$apiRequestParams["query.PriceMin"] = $atts["minprice"];
	$apiRequestParams["query.PriceMax"] = $atts["maxprice"];

	if ( $atts["propertytypes"] ) {
		$propertyTypes = explode(",", str_replace(" ", "", $atts["propertytypes"]));
		$propertyTypes = array_combine(range(0, count($propertyTypes) - 1), $propertyTypes);
		foreach ($propertyTypes as $key => $value)
			$apiRequestParams["query.PropertyTypes[{$key}]"] = $value;
	}

	if ($atts["linkid"]) {
		$apiRequestParams["query.LinkID"] = $atts["linkid"];
		$apiRequestParams["query.ForceUsePropertySearchConstraints"] = "true";
	}

	$apiRequestParams["directive.ResultsPerPage"] = $atts["count"];
	$apiRequestParams["directive.SortOrders[0].Column"] = $atts["orderby"];
	$apiRequestParams["directive.SortOrders[0].Direction"] = $atts["orderdir"];
	
	
	
	
	$apiHttpResponse = dsSearchAgent_ApiRequest::FetchData("Results", $apiRequestParams);

	if ( !strstr($apiHttpResponse['body'], "Sorry, but")  ) {
?>

	<div class="community-header" id="similar-properties">
		<h2 class="h2-border">Homes You Might Like in <?php echo ucwords( urldecode($city) ); ?>, <?php echo $state; ?></h2>
		<?php echo $apiHttpResponse['body']; ?>
		<div class="break" style="clear:both;"></div>
	</div>
<?php
 	} 
}
?>


<div id="listing-about">
	<h2 class="h2-border" style="margin-bottom:0">About The Area</h2>
	<?php 
	$z = ( $zip != 'a' ) ? $zip : "";
	$lookup = "{$city},+{$state}+{$z}"; 
	
	?>

	<ul class="tab-nav">
		<li><a href="#aa-map" class="active">Map</a></li>
		
	</ul>
	
	<div id="aa-map" class="tab-box row-fluid">
		<iframe class="span12" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=<?php echo $lookup; ?>&amp;ie=UTF8&amp;hq=&amp;hnear=<?php echo $lookup; ?>&amp;z=14&amp;output=embed"></iframe>
	</div>

	


</div>

<script type='text/javascript'>
	jQuery(function($){		
		$('ul.tab-nav li a').click(function(event){
			event.preventDefault();
			$('ul.tab-nav li a').removeClass('active');
			$(this).addClass('active');
			$('.tab-box').hide();
			$( $(this).attr('href') ).show();
			return false; 
		});
	});
</script>
</div>
<div class="sidebar-wrapper"> 
    <?php { get_sidebar(); } ?>
</div>
<div style="clear:both"></div>
<?php get_footer(); ?>