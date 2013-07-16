<?php
/*
Plugin Name: Tribus Market Stats Class
Plugin URI: http://www.tribus.com/
Description: Class to install Tribus Market Stats Module.
Version: 1.0
Author: Jason Benesch
Author URI: http://www.jasonbenesch.com/
*/

require_once("tribus_core.php");

class TribusMarketStats extends TribusCore {

	function __construct() {
		define("MARKET_STATS", true);
		$pai = get_option('tribusMarketStats');
		if ( isset($pai) && !empty($pai) ) define("PAI", $pai);
		//$this->debug("Market Stats 16:", "Market Stats Module has been loaded."); 
	}

}
