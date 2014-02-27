<?php

	namespace Markguyver\LivefyreImporter\Helper;
	
	/**
	 * This is a helper class that provides static validation methods. This class is a wrapper for the validation trait.
	 */
	class Validator {
		
		use Validation; // Add Validation Trait
		
		protected static $validator_instance = false;
		
		protected static function verify_instance() {
			if ( ! static::$validator_instance ) {
				static::$validator_instance = new static();
			}
		}
		
		public static function check_string( $string ) {
			static::verify_instance();
			return static::$validator_instance->validate_string( $string );
		}
		
		public static function check_float( $float ) {
			static::verify_instance();
			return static::$validator_instance->validate_float( $float );
		}
		
		public static function check_int( $int ) {
			static::verify_instance();
			return static::$validator_instance->validate_int( $int );
		}
		
		public static function check_boolean( $bool ) {
			static::verify_instance();
			return static::$validator_instance->validate_boolean( $bool );
		}
		
		public static function check_datetime( $datetime ) {
			static::verify_instance();
			return static::$validator_instance->validate_datetime( $datetime );
		}
		
		public static function check_url( $url ) {
			static::verify_instance();
			return static::$validator_instance->validate_url( $url );
		}
		
		public static function check_ip_address( $ip_address ) {
			static::verify_instance();
			return static::$validator_instance->validate_ip_address( $ip_address );
		}
		
		public static function check_email( $email ) {
			static::verify_instance();
			return static::$validator_instance->validate_email( $email );
		}
		
		protected function __construct() {
		}
		
	}