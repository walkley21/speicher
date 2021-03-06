<?php
/*
Plugin Name: Tribus API Class
Plugin URI: http://www.tribus.com/
Description: Class to control permalinks for custom endpoints.
Version: 1.0
Author: Jason Benesch
Author URI: http://www.jasonbenesch.com/
*/

require_once("tribus_core.php");

class TribusApi extends TribusCore {


	function __construct() {
		add_filter( 'query_vars', array(&$this, 'queryVars'));
		add_action( 'init', array(&$this, 'flushRewriteRules'));
		add_action( 'generate_rewrite_rules', array(&$this, 'addRewriteRules'));
		add_action( 'template_redirect', array(&$this, 'template'));
	}

	function queryVars( $query_vars ) {
		$myvars = array(
			'controller',
			'action',
			'extras'
		);
		$query_vars = array_merge( $query_vars, $myvars );
		return $query_vars;
	}

	function flushRewriteRules() {
		global $wp_rewrite;
//		$wp_rewrite->flush_rules(); // [dj] moved to end of addRewriteRules()
	}

	function addRewriteRules( $wp_rewrite ) {
		$wp_rewrite->add_rewrite_tag( "%controller%", "(blog|debugcrm|forms|market-stats|meebo)", "controller=" );
		$wp_rewrite->add_rewrite_tag( "%action%", "(thank-you|register|submit|view|more-info|more-submit|market-report|email-us|email-submit|home-worth|schedule-showing|showing-submit|detailed-report|page)", "action=" );
		$wp_rewrite->add_rewrite_tag( "%extras%", "(.+)", "extras=" );
		$urls = array(
			'%controller%',
			'%controller%/%action%',
			'%controller%/%action%/%extras%'
		);
		foreach( $urls as $url ) :
			$rule = $wp_rewrite->generate_rewrite_rules($url, EP_NONE, false, false, false, false, false);
			$wp_rewrite->rules = array_merge( $rule, $wp_rewrite->rules );
		endforeach;
		return $wp_rewrite;
	}

	private function __handle_extras($extras) {
		$pieces = explode("/", $extras);
		foreach ( $pieces as $piece ) {
			if ( strpos($piece, ":") ) {
				$split = explode(":", $piece);
				$this->params[$split[0]] = $split[1];
			} else {
				$this->params[] = $piece;
			}
		}
	}

	private function __validate_email($email) {
		return eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email);
	}

	function display_blog($page = 1) {
		define('INTERIOR', true);
		query_posts('paged='.$page);
		global $current_page;
		$current_page = $page;
		include(TEMPLATEPATH . '/index.php');
	}

	function display_meebo() {
		global $meebo_link;
		$meebo = get_option('tribusThemeMeembo');
		$meebo_link = ( substr($meebo, 0, 7) == "http://" ) ? $meebo : "http://{$meebo}";
		include ( dirname(__FILE__) . '/forms/meebo.php' );
	}

	function display_market_stats() {
		global $wp;
		if ( isset($wp->query_vars['action']) && !empty($wp->query_vars['action']) && $wp->query_vars['action'] == 'view' ) {
			global $state, $city, $zip, $prop_type;
			if ( defined('MARKET_STATS') && MARKET_STATS ) {
				if ( defined('PAI') ) {
					$state = $this->params[0];
					$city = $this->params[1];
					$zip = ( isset($this->params[2]) ) ? $this->params[2] : '';
					$prop_type = ( isset($this->params[3]) ) ? $this->params[3] : '';
					define('INTERIOR', true);
					include(TEMPLATEPATH . '/market-single.php');
				} else {
					include(TEMPLATEPATH . '/market-error.php');
				}
			} else {
				define('INTERIOR', true);
				include(TEMPLATEPATH . '/404.php');
			}
		} else {
			if ( defined('MARKET_STATS') && MARKET_STATS ) {
				if ( defined('PAI') ) {

					//http://charts.altosresearch.com/altos/app?service=listlocations&pai=53831628&usage=charts&dul=true&rf=json

					$url = "http://charts.altosresearch.com/altos/app?service=listlocations&pai=".PAI."&usage=charts&dul=true&rf=json";



					$resp = wp_remote_get($url, array('timeout' => 12));
					if( is_wp_error( $resp ) ) {
						echo 'We could not locate your zip codes.';
						echo "<pre>";
						print_r($resp);
						echo "</pre>";
					} else {
						global $markets;
						$markets = json_decode($resp['body']);
						define('INTERIOR', true);
						include(TEMPLATEPATH . '/market-stats.php');
					}
				} else {
					define('INTERIOR', true);
					include(TEMPLATEPATH . '/market-error.php');
				}
			} else {
				define('INTERIOR', true);
				include(TEMPLATEPATH . '/404.php');
			}
		}
	}

	function display_debug_crm() {
		require_once("tribus_crm.php");
		$crm = new TribusCRM;
		$crm->set_user_id('1234');
		$crm->set_contact(array(
			'name' => array(
				'first' => '"Jason"',
				'last' => "O'Malley"
			),
			'email' => 'jason@realestatetomato.com',
			'address' => array(
				'unit_number' => '23A',
				'street_number' => '1234',
				'street_name' => 'uh\'lua ave',
				'city' => '<strong>SD</strong>'
			)
		));
		$crm->set_property_details(array(
			'price' => '1,000',
			'area' => 'San Diego'
		));
		$xml = $crm->create_xml();
		header("Content-type: text/xml");
		echo $xml;
	}


	function template() {
		global $wp;

		if( isset($wp->query_vars['controller']) && !empty($wp->query_vars['controller']) ) {

			$extra = 1;
			if ( isset($wp->query_vars['extras']) && !empty($wp->query_vars['extras']) ) {
				$this->__handle_extras($wp->query_vars['extras']);
				$extra = $wp->query_vars['extras'];
			}

			switch( $wp->query_vars['controller'] ) {
				case 'blog' :
					$this->display_blog( $extra );
				break;

				case 'meebo' :
					$this->display_meebo();
				break;

				case 'market-stats' :
					$this->display_market_stats();
				break;

				case 'forms' :

					if ( isset($wp->query_vars['action']) && !empty($wp->query_vars['action']) ) {
						switch( $wp->query_vars['action'] ) {
							case 'thank-you' :
								include( dirname(__FILE__) . '/forms/thank_you.php' );
							break;

							case 'home-worth' :
								if ( !empty($_POST) && wp_verify_nonce($_POST['HomeWorth'], 'home_worth') ) {
									require_once("tribus_crm.php");
									$defaults = array(
										'twhw_first_name' => '',
										'twhw_last_name' => '',
										'twhw_email' => '',
										'twhw_phone' => '',
										'twhw_address' => '',
										'twhw_beds' => '',
										'twhw_sqft' => '',
										'HTTP_REFERER' => '',
										'REMOTE_ADDR' => ''
									);

									$a = array_merge($defaults, $_POST);
									$crm = new TribusCRM;
									$crm->set_contact(array(
										'name' => array(
											'first' => $a['twhw_first_name'],
											'last' => $a['twhw_last_name']
										),
										'email' => $a['twhw_email'],
										'phone_list' => array(
											'phone' => array(
												'number' => $a['twhw_phone']
											)
										)
									));
									$crm->set_property_details(array(
										'area' => $a['twhw_address'],
										'square_feet' => $a['twhw_sqft'],
										'beds' => $a['twhw_beds']
									));
									$crm->set_lead_source($a['HTTP_REFERER']);

									$resp = $crm->save();

									header("Location: " . $_POST['twhw_redirect_to'] . "?form_submitted=true");

								} else {
									define('INTERIOR', true);
									include(TEMPLATEPATH . '/404.php');
								}
							break;

							case 'register' :
								include ( dirname(__FILE__) . '/forms/register.php' );
							break;

							case 'email-us' :
								include ( dirname(__FILE__) . '/forms/email_us.php' );
							break;

							case 'email-submit' :
								if ( !empty($_POST) && wp_verify_nonce($_POST['ContactUs'], 'contact_us') ) {

									require_once("tribus_crm.php");
									$defaults = array(
										'first_name' => '',
										'last_name' => '',
										'email' => '',
										'phone' => '',
										'comments' => '',
										'HTTP_REFERER' => '',
										'REMOTE_ADDR' => ''
									);
									$a = array_merge($defaults, $_POST);
									$crm = new TribusCRM;
									$crm->set_contact(array(
										'name' => array(
											'first' => $a['first_name'],
											'last' => $a['last_name']
										),
										'email' => $a['email'],
										'phone_list' => array(
											'phone' => array(
												'number' => $a['phone']
											)
										)
									));
									$crm->set_note($a['comments']);
									$crm->set_lead_source($a['HTTP_REFERER']);

									$resp = $crm->save();
									header("Location: /forms/thank-you/");

								} else {
									define('INTERIOR', true);
									include(TEMPLATEPATH . '/404.php');
								}
							break;

							case 'more-info' :
								include ( dirname(__FILE__) . '/forms/request_more.php' );
							break;

							case 'more-submit' :
								if ( !empty($_POST) && wp_verify_nonce($_POST['MoreInfo'], 'more_info') ) {

									require_once("tribus_crm.php");
									$defaults = array(
										'first_name' => '',
										'last_name' => '',
										'communicate' => '',
										'email' => '',
										'phone' => '',
										'comments' => '',
										'address' => '',
										'referer' => '',
										'HTTP_REFERER' => '',
										'REMOTE_ADDR' => ''
									);
									$a = array_merge($defaults, $_POST);
									$crm = new TribusCRM;
									$crm->set_contact(array(
										'name' => array(
											'first' => $a['first_name'],
											'last' => $a['last_name']
										),
										'email' => $a['email'],
										'phone_list' => array(
											'phone' => array(
												'number' => $a['phone']
											)
										),
										'perferred_way_to_contact' => $a['communicate']
									));

									$note = "Address I was looking at: {$a['address']}\r\n";
									$note .= "Comments: \r\n";
									$note .= $a['comments'];
									$crm->set_note($note);

									$crm->set_lead_source($a['referer']);

									$resp = $crm->save();

									if ( $_POST['cloudcma'] == 'Y' ) {
										$args = array(
											'body' => array(
												'user'		=> get_option('admin_email'),
												'url'		=> $a['referer'],
												'email_to'	=> $a['email']
											)
										);
Tribus::log('TribusApi::template() submitting "more-submit" form ' . date('Y-m-d H:i:s'));
Tribus::log('  posting to http://cloudcma.com/properties/widget');
Tribus::log('  data: ' . var_export($args, TRUE));
										wp_remote_post( "http://cloudcma.com/properties/widget", $args );
									}

									header("Location: /forms/thank-you/");

								} else {
									define('INTERIOR', true);
									include(TEMPLATEPATH . '/404.php');
								}
							break;

							case 'schedule-showing' :
								include ( dirname(__FILE__) . '/forms/schedule_showing.php' );
							break;

							case 'showing-submit' :
								if ( !empty($_POST) && wp_verify_nonce($_POST['ShowingSubmit'], 'showing_submit') ) {

									require_once("tribus_crm.php");
									$defaults = array(
										'first_name' => '',
										'last_name' => '',
										'date' => '',
										'time' => '',
										'communicate' => '',
										'email' => '',
										'phone' => '',
										'comments' => '',
										'address' => '',
										'HTTP_REFERER' => '',
										'REMOTE_ADDR' => ''
									);
									$a = array_merge($defaults, $_POST);
									$crm = new TribusCRM;
									$crm->set_contact(array(
										'name' => array(
											'first' => $a['first_name'],
											'last' => $a['last_name']
										),
										'email' => $a['email'],
										'phone_list' => array(
											'phone' => array(
												'number' => $a['phone']
											)
										),
										'perferred_way_to_contact' => $a['communicate']
									));

									$note = "Requested Showing Time:\r\n";
									$note .= "Date: {$a['date']}\r\n";
									$note .= "Time: {$a['time']}\r\n";
									$note .= "Address: {$a['address']}\r\n";
									$note .= "Comments: \r\n";
									$note .= $a['comments'];
									$crm->set_note($note);
									$crm->set_lead_source($a['HTTP_REFERER']);

									$resp = $crm->save();
									header("Location: /forms/thank-you/");

								} else {
									define('INTERIOR', true);
									include(TEMPLATEPATH . '/404.php');
								}
							break;

							case 'detailed-report' :
								include ( dirname(__FILE__) . '/forms/detailed_report.php' );
							break;

							case 'market-report' :
								include ( dirname(__FILE__) . '/forms/market_report.php' );
							break;

							case 'submit' :
								if ( !empty($_POST) && wp_verify_nonce($_POST['UserRegister'], 'user_regsiter') ) {

									// Check to make sure we have no errors
									$has_error = false;
									global $error_message;
									$error_message = '';

									if ( !isset($_POST['first_name']) || empty($_POST['first_name']) ) {
										$has_error = true;
										$error_message .= "Please enter your first name.<br>";
									}

									if ( !isset($_POST['last_name']) || empty($_POST['last_name']) ) {
										$has_error = true;
										$error_message .= "Please enter your last name.<br>";
									}

									if ( !isset($_POST['email']) || empty($_POST['email']) || !$this->__validate_email($_POST['email']) ) {
										$has_error = true;
										$error_message .= "Please enter a valid email address.";
									}

									if ( $has_error ) {
										include ( dirname(__FILE__) . '/forms/register_error.php' );
									} else {
										require_once("tribus_crm.php");

										$defaults = array(
											'first_name' => '',
											'last_name' => '',
											'email' => '',
											'phone' => '',
											'search_area' => '',
											'beds' => 1,
											'baths' => 1,
											'min' => '',
											'max' => '',
											'comments' => '',
											'referer' => ''
										);
										$a = array_merge($defaults, $_POST);
										$crm = new TribusCRM;
										$crm->set_contact(array(
											'name' => array(
												'first' => $a['first_name'],
												'last' => $a['last_name']
											),
											'email' => $a['email']
										));
										$crm->set_lead_source($a['referer']);
										$crm->set_property_details(array(
											'price' => $a['min'] . '-' . $a['max'],
											'area' => $a['search_area'],
											'beds' => $a['beds'],
											'baths' => $a['baths']
										));
										$xml = $crm->create_xml();

										// [dj] add sending of form data
										$resp = $crm->save();

										//header("Content-type: text/xml");
										//echo $xml;
										header("Location: /forms/thank-you");
									}

								} else {
									define('INTERIOR', true);
								   	include(TEMPLATEPATH . '/404.php');
								}
							break;

							default :
								define('INTERIOR', true);
								include(TEMPLATEPATH . '/404.php');
							break;
						}
					} else {
						define('INTERIOR', true);
						include(TEMPLATEPATH . '/404.php');
					}

				break;

				case 'debugcrm' :
					$this->display_debug_crm();
				break;

				default:
					define('INTERIOR', true);
					include(TEMPLATEPATH . '/404.php');
				break;

			}
			exit;
		}
	}

}

