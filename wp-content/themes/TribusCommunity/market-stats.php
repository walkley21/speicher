<?php get_header(); ?>

<h2 class="h2-border">Select A Market Below</h2>

<ul>
<?php

global $markets;
$m = array();
$i = 0;
foreach ( $markets->list as $market ) {
	$zip = ( $market->cityWide == "true" ) ? 'a' : $market->zipName;
	$city = urlencode($market->cityName);
	$name = ( $market->cityWide == "true" ) ? "{$market->cityName}, {$market->stateName}" : "{$market->zipName} - {$market->cityName}, {$market->stateName}";
	echo "<li><a href=\"/market-stats/view/{$market->stateName}/{$city}/{$zip}\">{$name}</a> (<a href=\"/market-stats/view/{$market->stateName}/{$city}/{$zip}/sf\">homes</a>) (<a href=\"/market-stats/view/{$market->stateName}/{$city}/{$zip}/mf\">condos</a>)</li>";
}

?>
</ul>

<?php get_footer(); ?>