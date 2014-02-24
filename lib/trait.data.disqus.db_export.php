<?php

	namespace Markguyver\LivefyreImporter\Data\Disqus;
	
	trait DB_Export { // Declare \Markguyver\LivefyreImporter\Data\Disqus\DB_Export trait
		
		abstract public function export_disqus_object(); // Declare Declare \Markguyver\LivefyreImporter\Data\Disqus\DB_Export->export_disqus_object() abstract function
		
		public function get_prepared_insert_array() { // Declare \Markguyver\LivefyreImporter\Data\Disqus\DB_Export->get_insert_array() function
			$return = array();
			foreach ( $this->export_disqus_object() AS $current_field => $current_field_value ) { // Loop through Export Fields
				if ( ! is_array( $current_field_value ) ) { // Exclude Array Fields
					$return[$current_field] = $current_field_value;
				} // End of Exclude Array Fields
			} // End of Loop through Export Fields
			return $return;
		} // End of Declare \Markguyver\LivefyreImporter\Data\Disqus\DB_Export->get_insert_array() function
		
	} // End of Declare \Markguyver\LivefyreImporter\Data\Disqus\DB_Export trait