<?php

	namespace Markguyver\LivefyreImporter\Data\Livefyre;
	
	use \Markguyver\LivefyreImporter\Helper\Validator;
	
	class Comment extends Base { // Declare \Markguyver\LivefyreImporter\Data\Livefyre\Comment class
	
		protected $post_id;					// Required Field
		protected $body_html;				// Required Field
		protected $created;					// Required Field
	
		protected $author_id;				// Required Field (If importing users)
		protected $imported_display_name;	// Required Field (If NOT importing users -- Do NOT include, if passing author_id)
		protected $imported_email;			// Optional Field (Do NOT include, if passing author_id)
		protected $imported_url;			// Optional Field (Do NOT include, if passing author_id)
	
		protected $parent_id;				// Optional Field
		protected $likes = array();			// Optional Field
		
		protected static $db_table_name = 'comments';
		
		protected static $default_display_name = 'anonymous';
		
		public static function get_default_display_name() { // Declare \Markguyver\LivefyreImporter\Data\Livefyre\Comment->get_default_display_name() function
			return static::$default_display_name;
		} // End of Declare \Markguyver\LivefyreImporter\Data\Livefyre\Comment->get_default_display_name() function
		
		public static function set_default_display_name( $display_name ) { // Declare \Markguyver\LivefyreImporter\Data\Livefyre\Comment->set_default_display_name() function
			$display_name = $this->validate_string( $display_name );
			if ( $display_name ) { // Check for Passed Parameter
				static::$default_display_name = $display_name;
			} // End of Check for Passed Parameter
		} // End of Declare \Markguyver\LivefyreImporter\Data\Livefyre\Comment->set_default_display_name() function
	
		public static function validate_imported_display_name( $imported_display_name ) {
			return Validator::check_string( $imported_display_name );
		}
	
		public static function validate_imported_email( $imported_email ) {
			return Validator::check_email( $imported_email );
		}
	
		protected function __construct( $id, $post_id, $body_html, $created, $parent_id = 0 ) {
			// No validation here.  That should be handled by factory methods.
			$this->id				= (int) $id;
			$this->post_id			= (int) $post_id;
			$this->body_html		= (string) $body_html;
			$this->created			= (string) $created;
			$this->parent_id		= (int) $parent_id;
		}
	
		public function export_livefyre_object() {
			$return = new \stdClass();
			$return->id						= $this->id;
			$return->body_html				= $this->body_html;
			$return->created				= $this->created;
			$return->imported_display_name	= ( ! empty( $this->imported_display_name ) ? $this->imported_display_name : static::$default_display_name );
			if ( ! empty( $this->imported_email ) ) { // Check for Author Email
				$return->imported_email = $this->imported_email;
			} // End of Check for Author Email
			if ( ! empty( $this->parent_id ) ) { // Check for Parent ID
				$return->parent_id = $this->parent_id;
			} // End of Check for Parent ID
			return $return;
		}
	
		public function get_body_html() {
			return $this->body_html;
		}
	
		public function get_parent_id() {
			return $this->parent_id;
		}
	
		public function get_post_id() {
			return $this->post_id;
		}
	
		public function set_imported_display_name( $imported_display_name ) {
			$imported_display_name = static::validate_imported_display_name( $imported_display_name );
			return $this->imported_display_name = ( $imported_display_name ? $imported_display_name : static::$default_display_name );
		}
	
		public function set_imported_email( $imported_email ) {
			$return = false;
			$imported_email = static::validate_imported_email( $imported_email );
			if ( $imported_email ) { // Check Email Validation
				$return = ( $this->imported_email = $imported_email );
			} // End of Check Email Validation
			return $return;
		}
		
	} // End of Declare \Markguyver\LivefyreImporter\Data\Livefyre\Comment class