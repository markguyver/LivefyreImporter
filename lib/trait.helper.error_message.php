<?php

	namespace Markguyver\LivefyreImporter\Helper;
	
	trait Error_Message { // Declare \Markguyver\LivefyreImporter\Helper\Error_Message trait
		
		protected $debug = false;
		
		protected $errors = array();
		protected $last_error_message = false;
		
		public function get_debug() { // Declare \Markguyver\LivefyreImporter\Helper\Error_Message->get_debug() function
			return $this->debug;
		} // End of Declare \Markguyver\LivefyreImporter\Helper\Error_Message->get_debug() function
		
		public function set_debug( $debug_setting ) { // Declare \Markguyver\LivefyreImporter\Helper\Error_Message->set_debug() function
			$this->debug = (bool) $debug_setting;
		} // End of Declare \Markguyver\LivefyreImporter\Helper\Error_Message->set_debug() function
		
		public function get_last_error_message() { // Declare \Markguyver\LivefyreImporter\Helper\Error_Message->get_last_error_message() function
			return $this->last_error_message;
		} // End of Declare \Markguyver\LivefyreImporter\Helper\Error_Message->get_last_error_message() function
		
		protected function set_last_error_message( $message ) { // Declare \Markguyver\LivefyreImporter\Helper\Error_Message->set_last_error_message() function
			$this->last_error_message = trim( (string) $message );
			if ( $this->debug ) { // Check Debug Setting
				$this->add_error_message( $message );
			} // End of Check Debug Setting
		} // End of Declare \Markguyver\LivefyreImporter\Helper\Error_Message->set_last_error_message() function
		
		protected function add_error_message( $message ) { // Declare \Markguyver\LivefyreImporter\Helper\Error_Message->add_error_message() function
			$this->errors[] = trim( (string) $message );
		} // End of Declare \Markguyver\LivefyreImporter\Helper\Error_Message->add_error_message() function
		
	} // End of Declare \Markguyver\LivefyreImporter\Helper\Error_Message trait