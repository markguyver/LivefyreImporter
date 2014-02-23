<?php

	namespace Markguyver\LivefyreImporter\Data\Disqus;
	
	trait Is_Deleted { // Declare \Markguyver\LivefyreImporter\Data\Disqus\Is_Deleted trait

		protected $is_deleted = false;		// Required Field
	
		public function get_is_deleted() { // Declare \Markguyver\LivefyreImporter\Data\Livefyre\Is_Deleted->get_is_deleted() function
			return $this->is_deleted;
		} // End of Declare \Markguyver\LivefyreImporter\Data\Livefyre\Is_Deleted->get_is_deleted() function
	
		public function set_is_deleted( $is_deleted ) { // Declare \Markguyver\LivefyreImporter\Data\Livefyre\Is_Deleted->set_is_deleted() function
			$this->is_deleted = static::validate_boolean( $is_deleted );
		} // End of Declare \Markguyver\LivefyreImporter\Data\Livefyre\Is_Deleted->set_is_deleted() function
		
	} // End of  Declare \Markguyver\LivefyreImporter\Data\Disqus\Is_Deleted trait