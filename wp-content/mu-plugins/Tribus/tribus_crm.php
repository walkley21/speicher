<?php
/*
Plugin Name: Tribus CRM Class
Plugin URI: http://www.tribus.com/
Description: Singleton class that POSTs data to Tribus CRM endpoint
Version: 1.0
Author: Jason Benesch
Author URI: http://www.jasonbenesch.com/
*/

require_once(ABSPATH . 'wp-includes/class-http.php');

if ( !class_exists('TribusCRM') ) {
class TribusCRM extends WP_Http {

	var $version = '1.0';
	// http://www.tribuscrm.com/process_leads.asp?userID=xxxx
	var $uri = 'http://www.tribuscrm.com/process_leads.asp';
	var $user_id = null;
	var $email_to = null;
	var $lead_data = array(
		'this_data_provider' => array(
			'data_provider_name' => 'Website',
			'snapshot' => array(
				'date' => '',
				'time' => ''
			)
		),
		'contact' => array(
			'name' => array(
				'first' => '',
				'last' => ''
			),
			'email' => '',
			'address' => array(
				'unit_number' => '',
				'street_number' => '',
				'street_name' => '',
				'city' => '',
				'state_or_province' => '',
				'country' => '',
				'zip' => '',
			),
			'phone_list' => array(
				'phone' => array(
					'number' => '',
					'description' => '',
				)
			),
			'perferred_way_to_contact' => '',
			'role' => ''
		),
		'note' => '',
		'progress_status' => 'Hot',
		'lead_owner_id' => '',
		'owner_account_type' => 'Agent',
		'lead_source' => '',
		'lead_sub_source' => '',
		'preferred_office' => '',
		'preferred_agent' => '',
		'search_property_details' => array(
			'price' => '',
			'area' => '',
			'square_feet' => '',
			'beds' => '',
			'baths' => ''
		)
	);

	function create_xml() {
		$xml = "<?xml version=\"1.0\" ?><LeadList><Version>2.05</Version><Status Code=\"200\" Description=\"Success\" /><Lead>";

		$xml .= "<ThisDataProvider><DataProviderName>{$this->lead_data['this_data_provider']['data_provider_name']}</DataProviderName>";
		$xml .= "<Snapshot><Date>{$this->lead_data['this_data_provider']['snapshot']['date']}</Date>";
		$xml .= "<Time>{$this->lead_data['this_data_provider']['snapshot']['time']}</Time></Snapshot></ThisDataProvider>";

		$xml .= "<Contact><Name><First>{$this->lead_data['contact']['name']['first']}</First><Last>{$this->lead_data['contact']['name']['last']}</Last></Name>";
		$xml .= "<Email>{$this->lead_data['contact']['email']}</Email><Address>";
		$xml .= "<UnitNumber>{$this->lead_data['contact']['address']['unit_number']}</UnitNumber><StreetNumber>{$this->lead_data['contact']['address']['street_number']}</StreetNumber>";
		$xml .= "<StreetName>{$this->lead_data['contact']['address']['street_name']}</StreetName>";
		$xml .= "<City>{$this->lead_data['contact']['address']['city']}</City><StateOrProvince>{$this->lead_data['contact']['address']['state_or_province']}</StateOrProvince>";
		$xml .= "<Country>{$this->lead_data['contact']['address']['country']}</Country><Zip>{$this->lead_data['contact']['address']['zip']}</Zip></Address>";

		$xml .=	"<PhoneList><Phone><Number>{$this->lead_data['contact']['phone_list']['phone']['number']}</Number>";
		$xml .= "<Description>{$this->lead_data['contact']['phone_list']['phone']['description']}</Description></Phone></PhoneList>";
		$xml .= "<PreferredWayToContact>{$this->lead_data['contact']['perferred_way_to_contact']}</PreferredWayToContact><Role>{$this->lead_data['contact']['role']}</Role></Contact>";

		$xml .= "<Note>{$this->lead_data['note']}</Note>";
		$xml .= "<ProgressStatus>{$this->lead_data['progress_status']}</ProgressStatus>";
		$xml .= "<LeadOwnerID>{$this->lead_data['lead_owner_id']}</LeadOwnerID>";
		$xml .= "<OwnerAccountType>{$this->lead_data['owner_account_type']}</OwnerAccountType>";
		$xml .= "<LeadSource>{$this->lead_data['lead_source']}</LeadSource>";
		$xml .= "<LeadSubsource>{$this->lead_data['lead_sub_source']}</LeadSubsource>";
		$xml .= "<Preferredoffice>{$this->lead_data['preferred_office']}</Preferredoffice>";
		$xml .= "<preferredagent>{$this->lead_data['preferred_agent']}</preferredagent>";

//		$xml .= "<SearchPropertyDetails><Price>{$this->lead_data['search_property_details']['price']}</Price><Area>{$this->lead_data['search_property_details']['area']}</Area>";
//		$xml .= "<square_feet>{$this->lead_data['search_property_details']['square_feet']}</square_feet>";
//		$xml .= "<Beds>{$this->lead_data['search_property_details']['beds']}</Beds><Baths>{$this->lead_data['search_property_details']['baths']}</Baths></SearchPropertyDetails>";

		$xml .= "</Lead></LeadList>";
		return $xml;
	}

	function create_email_message() {
		$email = "DataProvider: {$this->lead_data['this_data_provider']['data_provider_name']}\r\n";
		$email .= "Date: {$this->lead_data['this_data_provider']['snapshot']['date']}\r\n";
		$email .= "Time: {$this->lead_data['this_data_provider']['snapshot']['time']}\r\n";
		$email .= "Lead Source: {$this->lead_data['lead_source']}\r\n";

		$email .= "\r\n- Contact Information -\r\n";
		$email .= "First Name: {$this->lead_data['contact']['name']['first']}\r\n";
		$email .= "Last Name: {$this->lead_data['contact']['name']['last']}\r\n";
		$email .= "Email: {$this->lead_data['contact']['email']}\r\n";
		$email .= "Phone: {$this->lead_data['contact']['phone_list']['phone']['number']}\r\n";

		$email .= "\r\n- Property Information -\r\n";
		$email .= "Unit Number: {$this->lead_data['contact']['address']['unit_number']}\r\n";
		$email .= "Street Number: {$this->lead_data['contact']['address']['street_number']}\r\n";
		$email .= "Street Name: {$this->lead_data['contact']['address']['street_name']}\r\n";
		$email .= "City: {$this->lead_data['contact']['address']['city']}\r\n";
		$email .= "State: {$this->lead_data['contact']['address']['state_or_province']}\r\n";
		$email .= "Country: {$this->lead_data['contact']['address']['country']}\r\n";
		$email .= "Zip Code: {$this->lead_data['contact']['address']['zip']}\r\n";

		$email .= "\r\n- Comments -\r\n";
		$email .= "{$this->lead_data['note']}\r\n";

		$email .= "\r\n- Search Details -\r\n";
		$email .= "Price: {$this->lead_data['search_property_details']['price']}\r\n";
		$email .= "Area: {$this->lead_data['search_property_details']['area']}\r\n";
		$email .= "SQFT: {$this->lead_data['search_property_details']['square_feet']}\r\n";
		$email .= "Beds: {$this->lead_data['search_property_details']['beds']}\r\n";
		$email .= "Baths: {$this->lead_data['search_property_details']['baths']}\r\n";
		return $email;
	}

	function __construct() {
		$this->lead_data['this_data_provider']['data_provider_name'] = $this->convert_xml_entities(get_bloginfo('name'));
		$this->lead_data['this_data_provider']['snapshot']['date'] = date("m/d/Y");
		$this->lead_data['this_data_provider']['snapshot']['time'] = date("H:i:s A");
		$this->user_id = get_option('tribus_id');
		$this->email_to = get_option('admin_email');
	}

	function set_user_id($user_id = null) {
		if ( $user_id ) {
			$this->user_id = $user_id;
			return true;
		}
		return false;
	}

	function set_email_to($email_to = null) {
		if ( $email_to ) {
			$this->email_to = $email_to;
			return true;
		}
		return false;
	}

	function set_provider($name = null, $date = null, $time = null) {
		if ( $name ) $this->lead_data['this_data_provider']['data_provider_name'] = $this->convert_xml_entities($name);
		if ( $date ) $this->lead_data['this_data_provider']['snapshot']['date'] = $date;
		if ( $time ) $this->lead_data['this_data_provider']['snapshot']['date'] = $time;
		return true;
	}

	function set_contact($contact = null) {
		if ( is_array($contact) ) {
			foreach ( $contact as $name => $value ) {
				if ( is_array($value) ) {
					foreach ( $value as $n => $v ) {
						if ( is_array($v) ) {
							foreach ( $v as $a => $b ) $this->lead_data['contact'][$name][$n][$a] = $this->convert_xml_entities($b);
						} else {
							$this->lead_data['contact'][$name][$n] = $this->convert_xml_entities($v);
						}
					}
				} else {
					$this->lead_data['contact'][$name] = $this->convert_xml_entities($value);
				}
			}
			return true;
		}
		return false;
	}

	function set_note($note = null) {
		if ( $note ) {
			$this->lead_data['note'] = $this->convert_xml_entities($note);
			return true;
		}
		return false;
	}

	function set_status($status = null) {
		if ( $status ) {
			$this->lead_data['progress_status'] = $this->convert_xml_entities($status);
			return true;
		}
		return false;
	}

	function set_owner($owner = null) {
		if ( $owner ) {
			$this->lead_data['lead_owner_id'] = $this->convert_xml_entities($owner);
			return true;
		}
		return false;
	}

	function set_account_type($type = null) {
		if ( $type ) {
			$this->lead_data['owner_account_type'] = $this->convert_xml_entities($type);
			return true;
		}
		return false;
	}

	function set_lead_source($source = null) {
		if ( $source ) {
			$this->lead_data['lead_source'] = $this->convert_xml_entities($source);
			return true;
		}
		return false;
	}

	function set_lead_sub_source($source = null) {
		if ( $source ) {
			$this->lead_data['lead_sub_source'] = $this->convert_xml_entities($source);
			return true;
		}
		return false;
	}

	function set_preferred_office($office = null) {
		if ( $office ) {
			$this->lead_data['preferred_office'] = $this->convert_xml_entities($office);
			return true;
		}
		return false;
	}

	function set_preferred_agent($agent = null) {
		if ( $agent ) {
			$this->lead_data['preferred_agent'] = $this->convert_xml_entities($agent);
			return true;
		}
		return false;
	}

	function set_property_details($details = null) {
		if ( is_array($details) ) {
			foreach ( $details as $name => $value ) {
				if ( is_array($value) ) {
					foreach ( $value as $n => $v ) {
						if ( is_array($v) ) {
							foreach ( $v as $a => $b ) $this->lead_data['search_property_details'][$name][$n][$a] = $this->convert_xml_entities($b);
						} else {
							$this->lead_data['search_property_details'][$name][$n] = $this->convert_xml_entities($v);
						}
					}
				} else {
					$this->lead_data['search_property_details'][$name] = $this->convert_xml_entities($value);
				}
			}
			return true;
		}
		return false;
	}

	function save() {
		$subject = 'A New Lead Form Was Submitted On: ' . get_bloginfo('name');
		$message = $this->create_email_message();
		$headers = array();
		wp_mail( $this->email_to, $subject, $message, $headers );

		if ( $this->user_id ) {
			$url = $this->uri . "?userID=" . $this->user_id;
			$args = array(
				'method' => 'POST',
				'timeout' => 4,
				//'user-agent' => 'TribusCRM/' . $this->version . ';' . get_bloginfo( 'url' ),
				'body' => $this->create_xml()
			);
Tribus::log('TribusCRM::save() ' . date('Y-d-m H:i:s'));
Tribus::log('  submitting form to ' . $url);
Tribus::log('  data: ' . var_export($args, TRUE));
			//error_log( $url );
			//error_log( serialize($args) );
			$resp = $this->request($url, $args);
			//error_log( serialize($resp) );
Tribus::log('  response object: ' . var_export($resp, TRUE));
			if ( is_wp_error( $resp ) ) {
				//wp_mail("jason@realestatetomato.com", "Find my way home error", "There was an error sending in a lead for on find my way home.");
				return false;

			}
			return $resp;
		}

		return false;
	}

	function convert_xml_entities($string = null) {
		if ( $string ) {
			return str_replace(array("<", ">", "\"", "'", "&"), array("&lt;", "&gt;", "&quot;", "&apos;", "&amp;"), $string);
		}
		return false;
	}


}
}
