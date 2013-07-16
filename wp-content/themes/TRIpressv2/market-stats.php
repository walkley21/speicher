<?php get_header(); ?>
<div id="mainWrapper" class="blogDetailView">
<h2 class="h2-border"  >Select A Market Below</h2>

<ul id="statistics-list">
<?php

global $markets;
$m = array();
$i = 0;
foreach ( $markets->list as $market ) {
	$zip = ( $market->cityWide == "true" ) ? 'a' : $market->zipName;
	$city = urlencode($market->cityName);
	$name = ( $market->cityWide == "true" ) ? "{$market->cityName}, {$market->stateName}" : "{$market->zipName} - {$market->cityName}, {$market->stateName}";
	echo "<li><a href=\"/market-stats/view/{$market->stateName}/{$city}/{$zip}\">{$name}</a> (<a class='homes' href=\"/market-stats/view/{$market->stateName}/{$city}/{$zip}/sf\">homes</a>) (<a  class='condos'  href=\"/market-stats/view/{$market->stateName}/{$city}/{$zip}/mf\">condos</a>)</li>";
}

?>
</ul>
</div>
<div class="sidebar-wrapper"> 
    <?php { get_sidebar(); } ?>
</div>
<div style="clear:both"></div>
<?php get_footer(); ?>