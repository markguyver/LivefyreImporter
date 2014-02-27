<?php

	namespace Markguyver\LivefyreImporter\Data\Disqus;
	
	class Thread extends \Markguyver\LivefyreImporter\Data\Livefyre\Conversation { // Declare \Markguyver\LivefyreImporter\Data\Disqus\Thread class
	
		use Is_Deleted;	// Add Is_Deleted Trait
		use Disqus_ID;	// Add Disqus_ID Trait
		use DB_Export;	// Add DB_Export Trait
	
		protected $delay_export = false;	// Required Field
		protected $forum;					// Optional Field
	
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
			
			// Use this function to add rules for delaying export
			
			return false; // DELETE
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