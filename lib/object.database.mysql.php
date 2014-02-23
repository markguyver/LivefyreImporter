<?php

	namespace Markguyver\LivefyreImporter\Database;
	
	class MySQL extends Base { // Declare \Markguyver\LivefyreImporter\Database\MySQL class
		
		protected $default_connection_encoding = 'utf8';
		
		protected function __construct() { // Declare \Markguyver\LivefyreImporter\Database\MySQL->__construct() function
			global $database_options;
			if ( !empty( $database_options['user'] ) AND !empty( $database_options['password'] ) AND !empty( $database_options['database'] ) ) { // Check for Required Fields
				$username = trim( (string) $database_options['user'] );
				$password = trim( (string) $database_options['password'] );
				$database = trim( (string) $database_options['database'] );
				if ( ! empty( $database_options['host'] ) ) { // Check for Host
					$host = trim( (string) $database_options['host'] );
				} else { // Middle of Check for Host
					$host = $this->default_host;
				} // End of Check for Host
				if ( ! empty( $database_options['encoding'] ) ) { // Check for Connection Encoding
					$encoding = trim( (string) $database_options['encoding'] );
				} else { // Middle of Check for Connection Encoding
					$encoding = $this->default_connection_encoding;
				} // End of Check for Connection Encoding
				try { // Try to Connect to Database
					$this->database_handle = new \PDO( sprintf( 'mysql:host=%s;dbname=%s;charset=%s', $host, $database, $encoding ), $username, $password );
					if ( isset( $database_options['error_mode'] ) AND is_int( $database_options['error_mode'] ) ) { // Check for Error Mode Setting
						$this->database_handle->setAttribute( \PDO::ATTR_ERRMODE, (int) $database_options['error_mode'] );
					} // End of Check for Error Mode Setting
				} catch ( \PDOException $e ) { // Middle of Try to Connect to Database
					$this->set_connection_error_message( $e->getMessage() );
				} // End of Try to Connect to Database
			} else { // Middle of Check for Required Fields
				$this->set_connection_error_message( 'Missing required database setting(s) in global $database_options variable (user, password, and/or database).' );
			} // End of Check for Required Fields
			unset( $database_options ); // Remove Database Connection Options Variable
		} // End of Declare \Markguyver\LivefyreImporter\Database\MySQL->__construct() function
		
	} // End of Declare \Markguyver\LivefyreImporter\Database\MySQL class