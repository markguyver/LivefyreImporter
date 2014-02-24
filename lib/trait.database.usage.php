<?php

	namespace Markguyver\LivefyreImporter\Database;
	
	trait Usage { // Declare \Markguyver\LivefyreImporter\Database\Usage trait

		protected $database;
		
		protected function get_database() { // Declare \Markguyver\LivefyreImporter\Database\Usage->get_database() function
			$database_class_name = \Markguyver\LivefyreImporter\DATABASE_OBJECT_NAME;
			if ( ! $this->database instanceof $database_class_name ) { // Check Class Database Attribute
				$this->database = $database_class_name::get_instance();
			}  // End of Check Class Database Attribute
			return $this->database->check_connection();
		} // End of Declare \Markguyver\LivefyreImporter\Database\Usage->get_database() function
		
	} // End of Declare \Markguyver\LivefyreImporter\Database\Usage trait