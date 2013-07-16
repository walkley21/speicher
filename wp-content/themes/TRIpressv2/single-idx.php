<?php
/*
Template Name: dsIDXpress Details Page
*/
?>
<?php get_header(); ?>

<div id="idx-results-archive">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<h2 class="title"><?php the_title(); ?></h2>
	<?php 
		
		$data = get_the_content();
		$replace = '<div id="idx-buttons">
						<a href="' . get_bloginfo('siteurl') . '/forms/more-info/?address=' . urlencode(get_the_title()) . '&iframe=true&width=450&height=510" class="more-info-image"  data-toggle="modal" data-target="#myModal-register" ></a>	
						<a href="' . get_bloginfo('siteurl') . '/forms/schedule-showing/?showdate=true&address=' . urlencode(get_the_title()) . '&iframe=true&width=450&height=520" class="schedule-info-image"  data-toggle="modal" data-target="#myModal-schedule" ></a>
						<a href="' . get_bloginfo('siteurl') . '/forms/detailed-report/?address=' . urlencode(get_the_title()) . '&url=' . urlencode(get_permalink()) . '&city=' . $post->city . '&iframe=true&width=450&height=510" class="detailed-report-image"  data-toggle="modal" data-target="#myModal-report"></a></div>
						<table id="dsidx-primary-data">';
		
		$content = str_replace('<table id="dsidx-primary-data">', $replace, $data);
		echo $content;
	
	?>

	

<?php endwhile; endif; ?>
        
        
<?php
	$url = $_SERVER['REQUEST_URI'];
	$zip = substr($url, -5);
	$atts = shortcode_atts(array(
		"city"			=> "",
		"community"		=> "",
		"tract"			=> "",
		"zip"			=> $zip,
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

	if ( !strstr($apiHttpResponse['body'], "Sorry, but") ) {
?>

	<div class="community-header" id="similar-properties">
		<h2 class="h2-border">other properties you might like</h2>
		<?php echo $apiHttpResponse['body']; ?>
		<div class="break"></div>
	</div>
<?php
 	}
?>        
        
        
</div>
<?php get_footer(); ?>
