<?php

class Wpe_Logger {

    function __construct() {
        $this->log_version();
        $this->log_plugins();
    }

    function __destruct() {
        
    }

    function log_version() {
        global $wp_version;

        // Don't make this request when in staging.
        if ( is_wpe_snapshot() )
            return false;

        // Don't make this call when the request is ajax
        if ( DOING_AJAX && defined( 'DOING_AJAX' ) )
            return false;

        $http = new WP_Http;
        $body = array( 'body' => array( 'wp_version' => $wp_version ) );
        $msg         = $http->post( 'http://api.wpengine.com/1.1/?method=version&account_name=' . PWP_NAME . '&wpe_apikey=' . WPE_APIKEY, $body );
    }

    public function log_plugins() {

        // Don't make this request when in staging.
        if ( is_wpe_snapshot() )
            return false;

        // Don't make this call when the request is ajax
        if ( DOING_AJAX && defined( 'DOING_AJAX' ) )
            return false;

        //define('WP_DEBUG',true);
        $active_plugins = get_option( 'active_plugins' );
        $key            = serialize( $active_plugins );
        $encrypted_data = json_encode( $active_plugins );
        $checksum       = sha1( $key );
        $http           = new WP_Http;
        $data           = array( 'body' => array( 'checksum' => $checksum, 'payload'  => $encrypted_data ) );
        $msg       = $http->post( 'http://api.wpengine.com/1.1/?method=plugins&account_name=' . PWP_NAME . '&wpe_apikey=' . WPE_APIKEY, $data );
    }

}