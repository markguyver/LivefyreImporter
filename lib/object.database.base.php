<?php

	namespace Markguyver\LivefyreImporter\Database;
	
	abstract class Base extends \Markguyver\LivefyreImporter\Helper\Error_Message { // Declare \Markguyver\LivefyreImporter\Database\Base abstract class
		
		protected static $pdo_database;
		
		public static function get_instance() { // Declare \Markguyver\LivefyreImporter\Database\Base::get_instance() function
			if ( ! is_a( static::$pdo_database, __NAMESPACE__ . '\Base' ) ) { // Check for Existing Database Handle
				static::$pdo_database = new static();
			} // End of Check for Existing Database Handle
			return static::$pdo_database;
		} // End of Declare \Markguyver\LivefyreImporter\Database\Base::get_instance() function
		
		protected $default_host = '127.0.0.1';
		
		protected $connection_error_message = false;
		
		protected $database_handle = false;
		protected $prepared_statement_handles = array();
		
		abstract protected function __construct(); // Declare \Markguyver\LivefyreImporter\Database\Base->__construct() abstract function
		
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