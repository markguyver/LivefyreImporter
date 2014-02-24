<?php

	namespace Markguyver\LivefyreImporter\Database;
	
	abstract class Base { // Declare \Markguyver\LivefyreImporter\Database\Base abstract class
		
		use \Markguyver\LivefyreImporter\Helper\Singleton;		// Add Singleton Trait
		use \Markguyver\LivefyreImporter\Helper\Error_Message;	// Add Error_Message Trait
		
		protected $default_host = '127.0.0.1';
		
		protected $connection_error_message = false;
		
		protected $database_handle = false;
		protected $prepared_statement_handles = array();
		
		public function check_connection() { // Declare \Markguyver\LivefyreImporter\Database\Base->check_connection() function
			return (bool) $this->database_handle;
		} // End of Declare \Markguyver\LivefyreImporter\Database\Base->check_connection() function
		
		public function get_connection_error_message() { // Declare \Markguyver\LivefyreImporter\Database\Base->get_connection_error_message() function
			return $this->connection_error_message;
		} // End of Declare \Markguyver\LivefyreImporter\Database\Base->get_connection_error_message() function
		
		protected function set_connection_error_message( $message ) { // Declare \Markguyver\LivefyreImporter\Database\Base->set_connection_error_message() function
			$this->set_last_error_message( $message );
			$this->connection_error_message = $this->last_error_message;
		} // End of Declare \Markguyver\LivefyreImporter\Database\Base->set_connection_error_message() function
		
	} // End of Declare \Markguyver\LivefyreImporter\Database\Base abstract class