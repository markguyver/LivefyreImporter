<?php

	namespace Markguyver\LivefyreImporter\Data\Livefyre;
	
	class Comment extends Base { // Declare \Markguyver\LivefyreImporter\Data\Livefyre\Comment class
		
		protected static $required_fields = array();
		protected static $optional_fields = array();
		
		protected static $db_table_name = 'comments';
		
		protected static $default_display_name = 'anonymous';
		
		public static function get_default_display_name() { // Declare \Markguyver\LivefyreImporter\Data\Livefyre\Comment->get_default_display_name() function
			return static::$default_display_name;
		} // End of Declare \Markguyver\LivefyreImporter\Data\Livefyre\Comment->get_default_display_name() function
		
		public static function set_default_display_name( $display_name ) { // Declare \Markguyver\LivefyreImporter\Data\Livefyre\Comment->set_default_display_name() function
			$display_name = static::validate_string( $display_name );
			if ( $display_name ) { // Check for Passed Parameter
				static::$default_display_name = $display_name;
			} // End of Check for Passed Parameter
		} // End of Declare \Markguyver\LivefyreImporter\Data\Livefyre\Comment->set_default_display_name() function
		
	} // End of Declare \Markguyver\LivefyreImporter\Data\Livefyre\Comment class