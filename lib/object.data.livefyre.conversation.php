<?php

	namespace Markguyver\LivefyreImporter\Data\Livefyre;
	
	class Conversation extends Base { // Declare \Markguyver\LivefyreImporter\Data\Livefyre\Conversation class
	
		protected $source;					// Required Field
		protected $title;					// Required Field
		protected $created;					// Required Field
		protected $comments = array();		// Required Field
	
		protected $tags = array();			// Optional Field
		protected $allow_comments = true;	// Optional Field
	
		protected static $db_table_name = 'posts';
	
		protected function __construct( $source, $title, $created, $id, $allow_comments = true ) {
			// No validation here.  That should be handled by factory methods.
			$this->source			= (string) $source;
			$this->title			= (string) $title;
			$this->created			= (string) $created;
			$this->id				= (int) $id;
			$this->allow_comments	= (bool) $allow_comments;
		}
	
		public function export_livefyre_object() { // Declare \Markguyver\LivefyreImporter\Data\Livefyre\Conversation->export_livefyre_object() function
			$return = new \stdClass();
			$return->source			= $this->source;
			$return->title			= $this->title;
			$return->created		= $this->created;
			$return->id				= $this->id;
			$return->comments		= $this->export_livefyre_data_objects_array( $this->comments );
			$return->allow_comments	= $this->allow_comments;
			return $return;
		} // End of Declare \Markguyver\LivefyreImporter\Data\Livefyre\Conversation->export_livefyre_object() function
	
		protected function add_comment( Comment &$comment ) { // Declare \Markguyver\LivefyreImporter\Data\Livefyre\Conversation->add_comment() function
			$this->comments[] = $comment;
		} // End of Declare \Markguyver\LivefyreImporter\Data\Livefyre\Conversation->add_comment() function
		
		public function add_comment_filtered( Comment &$comment ) { // Declare \Markguyver\LivefyreImporter\Data\Livefyre\Conversation->add_comment_filtered() function
			$return = false;
			if ( ! empty( $comment->get_parent_id() ) ) { // Check for Comment Parent ID Attribute
				if ( $this->find_comment_by_id( $comment->get_parent_id() ) ) { // Check if Comment Parent Exists
					$return = (bool) ( $this->comments[] = $comment );
				} // End of Check if Comment Parent Exists
			} else { // Middle of Check for Comment Parent ID Attribute
				$return = (bool) ( $this->comments[] = $comment );
			} // End of Check for Comment Parent ID
			return $return;
		} // End of Declare \Markguyver\LivefyreImporter\Data\Livefyre\Conversation->add_comment_filtered() function
	
		protected function find_comment_by_id( $comment_id ) { // Declare \Markguyver\LivefyreImporter\Data\Livefyre\Conversation->find_comment_by_id() function
			$return = false;
			$comment_id = $this->validate_int( $comment_id );
			if ( $comment_id ) { // Check for Passed Parameter
				foreach ( $this->comments AS $current_comment ) { // Loop through Comments
					if ( $current_comment->get_id() == $comment_id ) { // Check if Parent Comment Exists
						$return = $current_comment;
						break;
					} // End of Check if Parent Comment Exists
				} // End of Loop through Comments
			} // End of Check for Passed Parameter
			return $return;
		} // End of Declare \Markguyver\LivefyreImporter\Data\Livefyre\Conversation->find_comment_by_id() function
	
		public function get_comments() { // Declare \Markguyver\LivefyreImporter\Data\Livefyre\Conversation->get_comments() function
			return $this->comments;
		} // End of Declare \Markguyver\LivefyreImporter\Data\Livefyre\Conversation->get_comments() function
	
		public function add_tag( Tag &$tag ) { // Declare \Markguyver\LivefyreImporter\Data\Livefyre\Conversation->add_tag() function
			$this->tags[] = $tag;
		} // End of Declare \Markguyver\LivefyreImporter\Data\Livefyre\Conversation->add_tag() function
	
	} // End of Declare \Markguyver\LivefyreImporter\Data\Livefyre\Conversation class