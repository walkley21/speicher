<?php
/*
Plugin Name: Tribus Custom Error/Debugging Class
Plugin URI: http://www.tribus.com/
Description: Class to track and log errors in Tribus framework.
Version: 1.0
Author: Jason Benesch
Author URI: http://www.jasonbenesch.com/
*/

class TribusLog {
	
	private static $instance;
	var $bugs = array();
	
	function __construct() {
		add_action('wp_footer', array(&$this, 'console'));
	}
	
	public static function getInstance() { 
		if ( !self::$instance ) { 
	    	self::$instance = new TribusLog(); 
	   	} 
		return self::$instance; 
	}
	
	function log($array) {
		array_push($this->bugs, $array);
	}
	
	function console() {
		if ( !empty($this->bugs) ) {
			foreach ( $this->bugs as $bug ) {
				echo "<strong>{$bug['info']}</strong>";
				echo "<pre>";
				print_r($bug['anything']);
				echo "</pre>";
			}
		}
	}
	
}
