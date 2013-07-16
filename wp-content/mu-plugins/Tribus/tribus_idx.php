<?php
/*
Plugin Name: Tribus Custom Advance IDX Class
Plugin URI: http://www.tribus.com/
Description: Class to install Tribus Advance IDX Class.
Version: 1.0
Author: Jason Benesch
Author URI: http://www.jasonbenesch.com/
*/

require_once("tribus_core.php");

class TribusIDX extends TribusCore {
	
	function __construct() {
		//$this->debug("Advance IDX 16:", "Advance IDX Module has been loaded."); 
		define("ADVANCED_IDX", true);
		//add_action('wp_head', array(&$this, 'add_advance_idx'));
	}
	
	function add_advance_idx() {
		//echo "<!-- Hello, I am Advance IDX javascript code. -->";
	}
	
}
