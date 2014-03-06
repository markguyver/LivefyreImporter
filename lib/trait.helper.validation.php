<?php

	namespace Markguyver\LivefyreImporter\Helper;
	
	/**
	 * This trait provides basic variable validation.
	 */
	trait Validation { // Declare \Markguyver\LivefyreImporter\Helper\Validation trait
		
		/**
		 * The validation mappings as such: 'data_type' => 'validation_function'. It is used by the $this->validate_value() method.
		 * @var array
		 * @access protected
		 */
		protected $datatype_to_function = array(
			'str'				=> 'validate_string',
			'string'			=> 'validate_string',
			'float'				=> 'validate_float',
			'double'			=> 'validate_float',
			'int'				=> 'validate_int',
			'integer'			=> 'validate_int',
			'bool'				=> 'validate_boolean',
			'boolean'			=> 'validate_boolean',
			'datetime'			=> 'validate_datetime',
			'url'				=> 'validate_url',
			'ip'				=> 'validate_ip_addres',
			'ip_addr'			=> 'validate_ip_addres',
			'ip_address'		=> 'validate_ip_addres',
			'email'				=> 'validate_email',
			'email_addr'		=> 'validate_email',
			'email_address'		=> 'validate_email'
		);
		
		/**
		 * This method performs validations. It is a wrapper method that calls the other methods defined in this trait and provides a means of programmatically calling them.
		 * @param multitype $value The value to be validated
		 * @param string $data_type The data type (should be an array key in the $datatype_to_function variable)
		 * @return multitype Passes through the validation method return value
		 * @access public
		 */
		public function validate_value( $value, $data_type ) {
			$return = false;
			$data_type = $this->validate_string( $data_type );
			if ( ( $data_type ) AND ( ! empty( $this->datatype_to_function[$data_type] ) ) ) { // Check for Valid Passed Data Type
				$return = $this->{$this->datatype_to_function[$data_type]}( $value );
			} // End of Check for Valid Passed Data Type
			return $return;
		}
		
		/**
		 * This method validates strings. Non-empty strings are not allowed.
		 * @param string $string
		 * @return boolean|string A trimmed string or false
		 * @access public
		 */
		public function validate_string( $string ) { // Declare \Markguyver\LivefyreImporter\Helper\Validation->validate_string() function
			$return = false;
			$string = \trim( (string) $string );
			if ( !empty( $string ) ) { // Check for Passed Parameter
				$return = $string;
			} // End of Check for Passed Parameter
			return $return;
		} // End of Declare \Markguyver\LivefyreImporter\Helper\Validation->validate_string() function
		
		/**
		 * This method validates floating point numbers.
		 * @param float $float
		 * @return float|boolean A floating point number or false
		 * @access public
		 */
		public function validate_float( $float ) { // Declare \Markguyver\LivefyreImporter\Helper\Validation->validate_float() function
			return ( \is_float( $float ) ? (float) $float : false );
		} // End of Declare \Markguyver\LivefyreImporter\Helper\Validation->validate_float() function
		
		/**
		 * This method validates integers.
		 * @param int $int
		 * @return int|boolean An integer or false
		 * @access public
		 */
		public function validate_int( $int ) { // Declare \Markguyver\LivefyreImporter\Helper\Validation->validate_int() function
			return ( \is_int( $int ) ? (int) $int : false );
		} // End of Declare \Markguyver\LivefyreImporter\Helper\Validation->validate_int() function
		
		/**
		 * This method returns boolean values.
		 * @param boolean $boolean
		 * @return boolean True or false
		 * @access public
		 */
		public function validate_boolean( $boolean ) { // Declare \Markguyver\LivefyreImporter\Helper\Validation->validate_boolean() function
			return (bool) $boolean;
		} // End of Declare \Markguyver\LivefyreImporter\Helper\Validation->validate_boolean() function
		
		/**
		 * This method validates dates, times, and datetimes.
		 * @param string $datetime
		 * @return string|boolean It returns a trimmed string of what was provided or false
		 * @access public
		 */
		public function validate_datetime( $datetime ) { // Declare \Markguyver\LivefyreImporter\Helper\Validation->validate_datetime() function
			$return = false;
			$datetime = $this->validate_string( $datetime );
			if ( !empty( $datetime ) ) { // Check for Passed Parameter
				if ( false !== \strtotime( $datetime ) ) { // Validate Date String
					$return = $datetime;
				} // End of Validate Date String
			} // End of Check for Passed Parameter
			return $return;
		} // End of Declare \Markguyver\LivefyreImporter\Helper\Validation->validate_datetime() function
		
		/**
		 * This is a helper method that utilizes \filter_var() to validate various values (i.e. url, email address, etc).
		 * @param string $variable
		 * @param int $filter The filter to be used against the value
		 * @return boolean|string The value that was passed into this function or false
		 * @access protected
		 */
		protected function filter_string_variable( $variable, $filter ) { // Declare \Markguyver\LivefyreImporter\Helper\Validation->filter_string_variable() function
			$return = false;
			$variable = $this->validate_string( $variable );
			$filter = $this->validate_int( $filter );
			if ( $variable AND $filter ) { // Check Passed Parameters
				$return = \filter_var( $variable, $filter );
			} // End of Check Passed Parameters
			return $return;
		} // End of Declare \Markguyver\LivefyreImporter\Helper\Validation->filter_string_variable() function
		
		/**
		 * This method validates URLs (using self::filter_string_variable()).
		 * @param string $url
		 * @return boolean|string The URL string that was passed to this object or false.
		 * @access public
		 */
		public function validate_url( $url ) { // Declare \Markguyver\LivefyreImporter\Helper\Validation->validate_url() function
			return $this->filter_string_variable( $url, \FILTER_VALIDATE_URL );
		} // End of Declare \Markguyver\LivefyreImporter\Helper\Validation->validate_url() function
		
		/**
		 * This method validates IP addresses (using self::filter_string_variable()).
		 * @param string $ip_address
		 * @return boolean|string The IP address string that was passed to this object or false.
		 * @access public
		 */
		public function validate_ip_address( $ip_address ) { // Declare \Markguyver\LivefyreImporter\Helper\Validation->validate_ip_address() function
			return $this->filter_string_variable( $ip_address, \FILTER_VALIDATE_IP );
		} // End of Declare \Markguyver\LivefyreImporter\Helper\Validation->validate_ip_address() function
		
		/**
		 * This method validates email addresses (using self::filter_string_variable()).
		 * @param string $email
		 * @return boolean|string The email address string that was passed to this object or false.
		 * @access public
		 */
		public function validate_email( $email ) { // Declare \Markguyver\LivefyreImporter\Helper\Validation->validate_email() function
			return $this->filter_string_variable( $email, \FILTER_VALIDATE_EMAIL );
		} // End of Declare \Markguyver\LivefyreImporter\Helper\Validation->validate_email() function
		
	} // End of Declare \Markguyver\LivefyreImporter\Helper\Validation trait