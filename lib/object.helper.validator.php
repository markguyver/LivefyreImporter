<?php

	namespace Markguyver\LivefyreImporter\Helper;
	
	class Validator { // Declare \Markguyver\LivefyreImporter\Helper\Validator class
		
		public static function validate_string( $string ) { // Declare \Markguyver\LivefyreImporter\Helper\Validator::validate_string() function
			$return = false;
			$string = \trim( (string) $string );
			if ( !empty( $string ) ) { // Check for Passed Parameter
				$return = $string;
			} // End of Check for Passed Parameter
			return $return;
		} // End of Declare \Markguyver\LivefyreImporter\Helper\Validator::validate_string() function
		
		public static function validate_float( $float ) { // Declare \Markguyver\LivefyreImporter\Helper\Validator::validate_float() function
			return ( \is_float( $float ) ? (float) $float : false );
		} // End of Declare \Markguyver\LivefyreImporter\Helper\Validator::validate_float() function
		
		public static function validate_int( $int ) { // Declare \Markguyver\LivefyreImporter\Helper\Validator::validate_int() function
			return ( \is_int( $int ) ? (int) $int : false );
		} // End of Declare \Markguyver\LivefyreImporter\Helper\Validator::validate_int() function
		
		public static function validate_boolean( $boolean ) { // Declare \Markguyver\LivefyreImporter\Helper\Validator::validate_boolean() function
			return (bool) $boolean;
		} // End of Declare \Markguyver\LivefyreImporter\Helper\Validator::validate_boolean() function
		
		public static function validate_datetime( $datetime ) { // Declare \Markguyver\LivefyreImporter\Helper\Validator::validate_datetime() function
			$return = false;
			$datetime = static::validate_string( $datetime );
			if ( !empty( $datetime ) ) { // Check for Passed Parameter
				if ( false !== \strtotime( $datetime ) ) { // Validate Date String
					$return = $datetime;
				} // End of Validate Date String
			} // End of Check for Passed Parameter
			return $return;
		} // End of Declare \Markguyver\LivefyreImporter\Helper\Validator::validate_datetime() function
		
		protected static function filter_string_variable( $variable, $filter ) { // Declare \Markguyver\LivefyreImporter\Helper\Validator::filter_string_variable() function
			$return = false;
			$variable = static::validate_string( $variable );
			$filter = static::validate_int( $filter );
			if ( $variable AND $filter ) { // Check Passed Parameters
				$return = \filter_var( $variable, $filter );
			} // End of Check Passed Parameters
			return $return;
		} // End of Declare \Markguyver\LivefyreImporter\Helper\Validator::filter_string_variable() function
		
		public static function validate_url( $url ) { // Declare \Markguyver\LivefyreImporter\Helper\Validator::validate_url() function
			return static::filter_string_variable( $url, \FILTER_VALIDATE_URL );
		} // End of Declare \Markguyver\LivefyreImporter\Helper\Validator::validate_url() function
		
		public static function validate_ip_addres( $ip_address ) { // Declare \Markguyver\LivefyreImporter\Helper\Validator::validate_ip_addres() function
			return static::filter_string_variable( $ip_address, \FILTER_VALIDATE_IP );
		} // End of Declare \Markguyver\LivefyreImporter\Helper\Validator::validate_ip_addres() function
		
		public static function validate_email( $email ) { // Declare \Markguyver\LivefyreImporter\Helper\Validator::validate_email() function
			return static::filter_string_variable( $email, \FILTER_VALIDATE_EMAIL );
		} // End of Declare \Markguyver\LivefyreImporter\Helper\Validator::validate_email() function
		
		public static function sanitize_string( $string ) {
			$return = false;
			$string = static::validate_string( $string );
			if ( !empty( $string ) ) { // Check String Validation
				$return = \htmlentities( \urldecode( $string ), ENT_QUOTES | ENT_HTML401 );
				$return = \str_replace( array( "\n\r", "\r\n", "\r", "\n" ), '<br/>', $return );
				$return = \str_replace( array( '&nbsp;', '&amp;nbsp;', '&#160;', '&amp;#160;' ), ' ', $return );
				$return = \str_replace( array( '&amp;', '\/' ), array( '&', '/' ), $return );
			} // End of Check String Validation
			return $return;
		}
		
		public static function sanitize_html( $string ) {
			$return = false;
			$string = static::validate_string( $string );
			if ( !empty( $string ) ) { // Check String Validation
				$string = \mb_convert_encoding( $string, 'HTML-ENTITIES', 'UTF-8' );
				$string = \strip_tags( $string, \Markguyver\LivefyreImporter\HTML_ALLOWED_TAGS );
				$return = $string; // Add the HTML attribute filtering functionality - DELETE
			} // End of Check String Validation
			return $return;
		}
		
	} // End of Declare \Markguyver\LivefyreImporter\Helper\Validator class