<?php
/*
Plugin Name: Tribus Instant Communication Class
Plugin URI: http://www.tribus.com/
Description: Class to install Instant Communication Module.
Version: 1.0
Author: Jason Benesch
Author URI: http://www.jasonbenesch.com/
*/

require_once("tribus_core.php");

class TribusInstantCommunication extends TribusCore {

	function __construct() {
		define("INSTANT_COMMUNICATION", true);
		//$this->debug("Instant Communication 16:", "Instant Communication Module has been loaded."); 
	}

}
