<?php

	namespace Markguyver\LivefyreImporter\Data\Disqus;
	
	use \Markguyver\LivefyreImporter\Helper\Validator;
	
	class Thread extends \Markguyver\LivefyreImporter\Data\Livefyre\Conversation { // Declare \Markguyver\LivefyreImporter\Data\Disqus\Thread class
	
		use Is_Deleted;	// Add Is_Deleted Trait
		use Disqus_ID;	// Add Disqus_ID Trait
		use DB_Export;	// Add DB_Export Trait
	
		protected $delay_export = false;	// Required Field
		protected $forum;					// Optional Field
	
		public static function create_thread_from_disqus_object( \SimpleXMLElement $thread_data ) {
			$return = false;
			$source = ( ! empty( $thread_data->link ) ? static::validate_source( $thread_data->link ) : null ); // Validate Required Fields - Source URL
			$title = ( ! empty( $thread_data->title ) ? static::validate_title( $thread_data->title ) : null ); // Validate Required Fields - Title
			$created = ( ! empty( $thread_data->createdAt ) ? static::validate_created( $thread_data->createdAt ) : null ); // Validate Required Fields - Created
			$id = static::retrieve_id_from_disqus_object( $thread_data ); // Validate Required Fields - ID
			$allow_comments = ( isset( $thread_data->isClosed ) ? static::validate_allow_comments( $thread_data->isClosed ) : null ); // Validate Optional Fields - Allow Comments
			if ( !empty( $source ) AND !empty( $title ) AND !empty( $created ) AND !empty( $id ) ) { // Check for Required Fields
				$return = new static( $source, $title, $created, $id, $allow_comments );
				if ( isset( $thread_data->isDeleted ) AND ( 'true' == (string) $thread_data->isDeleted ) ) { // Check if Thread Was Deleted
					$return->set_is_deleted( true );
				} // End of Check if Thread Was Deleted
				if ( !empty( $thread_data->forum ) ) { // Check for Forum
					$return->set_forum( $thread_data->forum );
				} // End of Check for Forum
				if (  $return->check_delay_export() ) { // Check for URL at Beginning of Title
					$return->set_delay_export( true );
				} // End of Check for URL at Beginning of Title
			} // End of Check for Required Fields
			return $return;
		}
	
		public static function validate_source( $source ) {
			return Validator::check_url( $source );
		}
	
		public static function validate_title( $title ) {
			$return = false;
			$title = Validator::check_string( $title );
			if ( !empty( $title ) ) { // Check String Validation
				$return = html_entity_decode( urldecode( $title ) );
			} // End of Check String Validation
			return $return;
		}
	
		public static function validate_allow_comments( $is_closed ) {
			$is_closed = Validator::check_string( $is_closed );
			return ( 'true' == $is_closed ? false : true ); // Return Inverse (Disqus uses 'isClosed' and Livefyre uses 'allow_comments')
		}
	
		public function export_disqus_object() { // Declare \Markguyver\LivefyreImporter\Data\Disqus\Thread->export_disqus_object() function
			$return = new \stdClass();
			$return->source			= $this->source;
			$return->title			= $this->title;
			$return->created		= $this->created;
			$return->id				= $this->id;
			$return->comments		= $this->export_livefyre_data_objects_array( $this->comments );
			$return->tags			= $this->export_livefyre_data_objects_array( $this->tags );
			$return->allow_comments	= $this->allow_comments;
			$return->delay_export	= $this->delay_export;
			$return->is_deleted		= $this->is_deleted;
			if ( !empty( $this->forum ) ) { // Check for Forum
				$return->forum = $this->forum;
			} // End of Check for Forum
			return $return;
		} // End of Declare \Markguyver\LivefyreImporter\Data\Disqus\Thread->export_disqus_object() function
	
		public function check_delay_export() { // Declare \Markguyver\LivefyreImporter\Data\Livefyre\Conversation->get_delay_export() function
			$return = false;
			if ( 0 === strpos( $this->title, 'http' ) ) { // Check for URL in Title
				$return = true;
			} // End of Check for URL in Title
			return $return;
		} // End of Declare \Markguyver\LivefyreImporter\Data\Livefyre\Conversation->get_delay_export() function
	
		public function get_delay_export() { // Declare \Markguyver\LivefyreImporter\Data\Livefyre\Conversation->get_delay_export() function
			return $this->delay_export;
		} // End of Declare \Markguyver\LivefyreImporter\Data\Livefyre\Conversation->get_delay_export() function
	
		public function set_delay_export( $delay_export ) { // Declare \Markguyver\LivefyreImporter\Data\Livefyre\Conversation->set_delay_export() function
			$this->delay_export = $this->validate_boolean( $delay_export );
		} // End of Declare \Markguyver\LivefyreImporter\Data\Livefyre\Conversation->set_delay_export() function
	
		public function get_forum() { // Declare \Markguyver\LivefyreImporter\Data\Livefyre\Conversation->get_forum() function
			return $this->forum;
		} // End of Declare \Markguyver\LivefyreImporter\Data\Livefyre\Conversation->get_forum() function
	
		public function set_forum( $forum ) { // Declare \Markguyver\LivefyreImporter\Data\Livefyre\Conversation->set_forum() function
			$return = false;
			$forum = $this->validate_string( $forum );
			if ( !empty( $forum ) ) { // Check for Passed Parameter
				$return = ( $this->forum = $forum );
			} // End of Check for Passed Parameter
			return $return;
		} // End of Declare \Markguyver\LivefyreImporter\Data\Livefyre\Conversation->set_forum() function
		
	} // End of Declare \Markguyver\LivefyreImporter\Data\Disqus\Thread class