<?php
/*
Plugin Name: Tribus Agent Template Base Class
Plugin URI: http://www.tribus.com/
Description: Implements base properties and methods for Tribus custom theme wordpress network
Version: 1.0
Author: Jason Benesch
Author URI: http://www.jasonbenesch.com/
*/

require_once("tribus_log.php");

class TribusCore {
	
	var $version = 1.0;
	
	function debug($info, $anything) {
		$TLog = TribusLog::getInstance(); 
		$TLog->log(array('info' => $info, 'anything' => $anything));
	}
	
	function pr($anything) {
		echo "<pre>";
		print_r($anything);
		echo "</pre>";
	}
	
}



