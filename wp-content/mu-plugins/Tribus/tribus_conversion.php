<?php
/*
Plugin Name: Tribus Custom Power Conversion Class
Plugin URI: http://www.tribus.com/
Description: Class to install Tribus Power Conversion Class.
Version: 1.0
Author: Jason Benesch
Author URI: http://www.jasonbenesch.com/
*/

require_once("tribus_core.php");

class TribusPowerConversion extends TribusCore {
	
	function __construct() {
		define("TB_POWER_CONVERSION", true);
		add_action('template_redirect', array(&$this, 'activate_popup_registration'));	
	}
	
	function activate_popup_registration() {
		global $wp;
		if ( isset($wp->query_vars['post_type']) ) {
			if ( $wp->query_vars['post_type'] == 'listing' ) {
				add_action('wp_footer', array(&$this, 'fire_popup_registration'));
			}
		} else if ( isset($wp->query_vars['idx-action']) ) {
			add_action('wp_footer', array(&$this, 'fire_popup_registration'));
		}
	}
	
	
	
	function fire_popup_registration() {
?>
	<script type="text/javascript">
		function createCookie(name,value,days) {
			if (days) {
				var date = new Date();
				date.setTime(date.getTime()+(days*24*60*60*1000));
				var expires = "; expires="+date.toGMTString();
			}
			else var expires = "";
			document.cookie = name+"="+value+expires+"; path=/";
		}

		function readCookie(name) {
			var nameEQ = name + "=";
			var ca = document.cookie.split(';');
			for(var i=0;i < ca.length;i++) {
				var c = ca[i];
				while (c.charAt(0)==' ') c = c.substring(1,c.length);
				if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
			}
			return null;
		}

		function eraseCookie(name) {
			createCookie(name,"",-1);
		}
	
		jQuery(function($){
			if (navigator.cookieEnabled) {
				if (!readCookie('tribus_form')) {
					if (readCookie('tribus_count')) {
						var currCount = 0;
						currCount = parseInt(readCookie('tribus_count'));
						if (currCount >= 4) {
							$("").prettyPhoto({theme: 'none', allow_resize: false, iframe_markup: '<iframe src="{path}" width="{width}" height="{height}" frameborder="no"></iframe>'});
							$.prettyPhoto.open('/forms/register/?iframe=true&width=450&height=520');
							createCookie('tribus_count', 1, 600);
						} else {
							createCookie('tribus_count', (currCount+1), 600);
						}
					} else {		
						createCookie('tribus_count', 4, 600);
					}
				}
			}
		});
	</script>
	
<?php
	}
	
}
