<?php

	namespace Markguyver\LivefyreImporter\Database;
	
	trait Usage { // Declare \Markguyver\LivefyreImporter\Database\Usage trait

		protected $database;
		
		protected function get_database() { // Declare \Markguyver\LivefyreImporter\Database\Usage->get_database() function
			$database_class_name = \Markguyver\LivefyreImporter\DATABASE_OBJECT_NAME;
			if ( ! is_a( $this->database, $database_class_name ) ) {
				$this->database = $database_class_name::get_instance();
			}
			return $this->database->check_connection();
		} // End of Declare \Markguyver\LivefyreImporter\Database\Usage->get_database() function
		
	} // End of Declare \Markguyver\LivefyreImporter\Database\Usage trait