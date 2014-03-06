<?php

	namespace Markguyver\LivefyreImporter\Data\Disqus;
	
	use \Markguyver\LivefyreImporter\Helper\Validator;
	
	class Post extends \Markguyver\LivefyreImporter\Data\Livefyre\Comment { // Declare \Markguyver\LivefyreImporter\Data\Disqus\Post class
	
		use Is_Deleted;	// Add Is_Deleted Trait
		use Is_Spam;	// Add Is_Spam Trait
		use Disqus_ID;	// Add Disqus_ID Trait
		use DB_Export;	// Add DB_Export Trait
	
		public static function create_post_from_disqus_object( \SimpleXMLElement $comment_data ) {
			$return = false;
			$id = static::retrieve_id_from_disqus_object( $comment_data ); // Validate Required Fields - ID
			$post_id = static::retrieve_id_from_disqus_object( $comment_data->thread ); // Validate Required Fields - ID
			$body_html = ( ! empty( $comment_data->message ) ? static::validate_message( $comment_data->message ) : null ); // Validate Required Fields - Body HTML
			$created = ( ! empty( $comment_data->createdAt ) ? static::validate_created( $comment_data->createdAt ) : nullÊ); // Validate Required Fields - Created
			$parent_id = ( isset( $comment_data->parent ) ? static::retrieve_id_from_disqus_object( $comment_data->parent ) : 0 ); // Validate Optional Fields - Parent ID
			if ( !empty( $id ) AND !empty( $post_id ) AND !empty( $body_html ) AND !empty( $created ) ) { // Check for Required Fields
				$return = new static( $id, $post_id, $body_html, $created, $parent_id );
				if ( isset( $comment_data->author->isAnonymous ) AND ( 'false' == $comment_data->author->isAnonymous ) ) { // Check Author isAnonymous
					if ( !empty( $comment_data->author->name ) ) { // Check for Comment Author Name
						$imported_display_name = $comment_data->author->name;
					} // End of Check for Comment Author Name
					if ( !empty( $comment_data->author->email ) ) { // Check for Comment Author Email
						$imported_email = $comment_data->author->email;
					} // End of Check for Comment Author Email
				} // End of Check Author isAnonymous
				$return->set_imported_display_name( ( ! empty( $imported_display_name ) ? $imported_display_name : null ) );
				if ( ! empty( $imported_email ) ) { // Check for Imported Email
					$return->set_imported_email( $imported_email );
				} // End of Check for Imported Email
				if ( isset( $comment_data->isSpam ) AND ( 'true' == (string) $comment_data->isSpam ) ) { // Check for Spam Comments
					$return->set_is_spam( true );
				} // End of Check for Spam Comments
				if ( isset( $comment_data->isDeleted ) AND ( 'true' == (string) $comment_data->isDeleted ) ) { // Check for Deleted Comments
					$return->set_is_deleted( true );
				} // End of Check for Deleted Comments
			} // End of Check for Required Fields
			return $return;
		}
	
		public static function validate_message( $message ) {
			$return = false;
			$message = Validator::check_string( $message );
			if ( !empty( $message ) ) { // Check String Validation
				$message = mb_convert_encoding( $message, 'HTML-ENTITIES', 'UTF-8' );
				$message = strip_tags( $message, \Markguyver\LivefyreImporter\HTML_ALLOWED_TAGS );
				
				// Filter HTML Attributes -- DELETE
// 				static::ensure_dom_scrubber();
// 				if ( static::$dom_scrubber->set_input_document_from_string( $message ) ) { // Create Comment HTML Document
// 					if ( static::$dom_scrubber->process_document() ) { // Process Comment HTML Document
// 						$return = static::$dom_scrubber->get_output_document_html();
// 					} // End of Process Comment HTML Document
// 				} // End of Create Comment HTML Document
				$return = $message; // DELETE
				
			} // End of Check String Validation
			return $return;
		}
	
		public function export_disqus_object() { // Declare \Markguyver\LivefyreImporter\Data\Disqus\Post->export_disqus_object() function
			$return = new \stdClass();
			$return->id				= $this->id;
			$return->post_id		= $this->post_id;
			$return->body_html		= $this->body_html;
			$return->created		= $this->created;
			$return->is_deleted		= $this->is_deleted;
			$return->is_spam		= $this->is_spam;
			if ( !empty( $this->author_id ) ) { // Check for Author Info
				$return->author_id = $this->author_id;
			} else { // Middle of Check for Author Info
				$return->imported_display_name = ( ! empty( $this->imported_display_name ) ? $this->imported_display_name : static::$default_display_name );
				if ( !empty( $this->imported_email ) ) { // Check for Author Email
					$return->imported_email = $this->imported_email;
				} // End of Check for Author Email
				if ( !empty( $this->imported_url ) ) { // Check for Author URL
					$return->imported_url = $this->imported_url;
				} // End of Check for Author URL
			} // End of Check for Author Info
			if ( !empty( $this->parent_id ) ) { // Check for Parent ID
				$return->parent_id = $this->parent_id;
			} // End of Check for Parent ID
			if ( count( $this->likes ) ) { // Check for Likes
				$return->likes = $this->export_livefyre_data_objects_array( $this->likes );
			} // End of Check for Likes
			return $return;
		} // End of Declare \Markguyver\LivefyreImporter\Data\Disqus\Post->export_disqus_object() function
	
	} // End of Declare \Markguyver\LivefyreImporter\Data\Disqus\Post class