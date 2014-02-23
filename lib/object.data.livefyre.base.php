<?php

	namespace Markguyver\LivefyreImporter\Data\Livefyre;
	
	abstract class Base extends \Markguyver\LivefyreImporter\Helper\Validator { // Declare \Markguyver\LivefyreImporter\Data\Livefyre\Base abstract class
		
		protected static $required_fields = array();
		protected static $optional_fields = array();
		
		protected static $db_table_name;
		
		public static function get_db_table_name() { // Declare \Markguyver\LivefyreImporter\Data\Livefyre\Base::get_db_table_name() function
			return static::$db_table_name;
		} // End of Declare \Markguyver\LivefyreImporter\Data\Livefyre\Base::get_db_table_name() function
		
		abstract public function export_livefyre_object(); // Declare \Markguyver\LivefyreImporter\Data\Livefyre\Base->export_livefyre_object() abstract function
		
		public function export_comment_json() { // Declare \Markguyver\LivefyreImporter\Data\Livefyre\Base->export_comment_json() function
			return json_encode( $this->export_livefyre_object() );
		} // End of Declare \Markguyver\LivefyreImporter\Data\Livefyre\Base->export_comment_json() function
		
	} // End of Declare \Markguyver\LivefyreImporter\Data\Livefyre\Base abstract class