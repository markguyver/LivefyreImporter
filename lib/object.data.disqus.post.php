<?php

	namespace Markguyver\LivefyreImporter\Data\Disqus;
	
	class Post extends \Markguyver\LivefyreImporter\Data\Livefyre\Comment { // Declare \Markguyver\LivefyreImporter\Data\Disqus\Post class
	
		use Is_Deleted; // Add Is_Deleted Trait
		use Is_Spam; // Add Is_Spam Trait
		use Disqus_ID; // Add Disqus_ID Trait
		use DB_Export; // Add DB_Export Trait
	
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
				$return->imported_display_name = ( !empty( $this->imported_display_name ) ? $this->imported_display_name : static::DEFAULT_DISPLAY_NAME );
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