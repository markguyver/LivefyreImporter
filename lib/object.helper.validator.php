<?php

	namespace Markguyver\LivefyreImporter\Helper;
	
	/**
	 * This is a helper class that provides static validation methods. This class is a wrapper for the validation trait.
	 */
	class Validator { // Declare \Markguyver\LivefyreImporter\Helper\Validator class
		
		use Validation; // Add Validation Trait
		
		protected static $validator_instance = false;
		
		protected static function verify_instance() { // Declare \Markguyver\LivefyreImporter\Helper\Validator::verify_instance() function
			if ( ! static::$validator_instance ) { // Check if Instance Exists
				static::$validator_instance = new static();
			} // End of Check if Instance Exists
		} // End of Declare \Markguyver\LivefyreImporter\Helper\Validator::verify_instance() function
		
		public static function check_string( $string ) { // Declare \Markguyver\LivefyreImporter\Helper\Validator::check_string() function
			static::verify_instance();
			return static::$validator_instance->validate_string( $string );
		} // End of Declare \Markguyver\LivefyreImporter\Helper\Validator::check_string() function
		
		public static function check_float( $float ) { // Declare \Markguyver\LivefyreImporter\Helper\Validator::check_float() function
			static::verify_instance();
			return static::$validator_instance->validate_float( $float );
		} // End of Declare \Markguyver\LivefyreImporter\Helper\Validator::check_float() function
		
		public static function check_int( $int ) { // Declare \Markguyver\LivefyreImporter\Helper\Validator::check_int() function
			static::verify_instance();
			return static::$validator_instance->validate_int( $int );
		} // End of Declare \Markguyver\LivefyreImporter\Helper\Validator::check_int() function
		
		public static function check_boolean( $bool ) { // Declare \Markguyver\LivefyreImporter\Helper\Validator::check_boolean() function
			static::verify_instance();
			return static::$validator_instance->validate_boolean( $bool );
		} // End of Declare \Markguyver\LivefyreImporter\Helper\Validator::check_boolean() function
		
		public static function check_datetime( $datetime ) { // Declare \Markguyver\LivefyreImporter\Helper\Validator::check_datetime() function
			static::verify_instance();
			return static::$validator_instance->validate_datetime( $datetime );
		} // End of Declare \Markguyver\LivefyreImporter\Helper\Validator::check_datetime() function
		
		public static function check_url( $url ) { // Declare \Markguyver\LivefyreImporter\Helper\Validator::check_url() function
			static::verify_instance();
			return static::$validator_instance->validate_url( $url );
		} // End of Declare \Markguyver\LivefyreImporter\Helper\Validator::check_url() function
		
		public static function check_ip_address( $ip_address ) { // Declare \Markguyver\LivefyreImporter\Helper\Validator::check_ip_address() function
			static::verify_instance();
			return static::$validator_instance->validate_ip_address( $ip_address );
		} // End of Declare \Markguyver\LivefyreImporter\Helper\Validator::check_ip_address() function
		
		public static function check_email( $email ) { // Declare \Markguyver\LivefyreImporter\Helper\Validator::check_email() function
			static::verify_instance();
			return static::$validator_instance->validate_email( $email );
		} // End of Declare \Markguyver\LivefyreImporter\Helper\Validator::check_email() function
		
		protected function __construct() { // Declare \Markguyver\LivefyreImporter\Helper\Validator->__construct() function
		} // End of Declare \Markguyver\LivefyreImporter\Helper\Validator->__construct() function
		
	} // End of Declare \Markguyver\LivefyreImporter\Helper\Validator class