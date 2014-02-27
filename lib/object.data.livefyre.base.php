<?php

	namespace Markguyver\LivefyreImporter\Data\Livefyre;
	
	abstract class Base { // Declare \Markguyver\LivefyreImporter\Data\Livefyre\Base abstract class
		
		use \Markguyver\LivefyreImporter\Helper\Validation; // Add Validation Trait
		
		protected static $db_table_name;
		
		protected $id; // Required Field
		
		public static function get_db_table_name() { // Declare \Markguyver\LivefyreImporter\Data\Livefyre\Base::get_db_table_name() function
			return static::$db_table_name;
		} // End of Declare \Markguyver\LivefyreImporter\Data\Livefyre\Base::get_db_table_name() function
		
		public static function set_db_table_name( $table_name ) { // Declare \Markguyver\LivefyreImporter\Data\Livefyre\Base::set_db_table_name() function
			$return = false;
			$table_name = \Markguyver\LivefyreImporter\Helper\Validator::check_string( $table_name );
			if ( $table_name ) { // Check for Passed Table Name
				$return = (bool) static::$db_table_name = $table_name;
			} // End of Check for Passed Table Name
			return $return;
		} // End of Declare \Markguyver\LivefyreImporter\Data\Livefyre\Base::set_db_table_name() function
		
		public function get_id() { // Declare \Markguyver\LivefyreImporter\Data\Livefyre\Base->get_id() function
			return $this->id;
		} // End of Declare \Markguyver\LivefyreImporter\Data\Livefyre\Base->get_id() function
		
		abstract public function export_livefyre_object(); // Declare \Markguyver\LivefyreImporter\Data\Livefyre\Base->export_livefyre_object() abstract function
		
		public function export_livefyre_object_json() { // Declare \Markguyver\LivefyreImporter\Data\Livefyre\Base->export_livefyre_object_json() function
			return json_encode( $this->export_livefyre_object() );
		} // End of Declare \Markguyver\LivefyreImporter\Data\Livefyre\Base->export_livefyre_object_json() function
		
		protected function export_livefyre_data_objects_array( Array $livefyre_data_objects ) { // Declare \Markguyver\LivefyreImporter\Data\Livefyre\Base->export_livefyre_data_objects_array() function
			$return = array();
			if ( count( $livefyre_data_objects ) ) { // Check for Passed Parameter Items
				foreach ( $livefyre_data_objects AS $current_data_object ) { // Loop through Passed Parameter Items
					if ( $current_data_object instanceof self ) { // Validate Current Data Object
						$return[] = $current_data_object->export_livefyre_object_json();
					} // End of Validate Current Data Object
				} // End of Loop through Passed Parameter Items
			} // End of Check for Passed Parameter Items
			return $return;
		} // End of Declare \Markguyver\LivefyreImporter\Data\Livefyre\Base->export_livefyre_data_objects_array() function
		
	} // End of Declare \Markguyver\LivefyreImporter\Data\Livefyre\Base abstract class