<?php

	namespace Markguyver\LivefyreImporter\Data\Disqus;
	
	trait Is_Spam { // Declare \Markguyver\LivefyreImporter\Data\Disqus\Is_Spam trait
	
		protected $is_spam = false; // Required Field
	
		public function get_is_spam( $is_spam ) { // Declare \Markguyver\LivefyreImporter\Data\Disqus\Is_Spam->get_is_spam() function
			return $this->is_spam;
		} // End of Declare \Markguyver\LivefyreImporter\Data\Disqus\Is_Spam->get_is_spam() function
	
		public function set_is_spam( $is_spam ) { // Declare \Markguyver\LivefyreImporter\Data\Disqus\Is_Spam->set_is_spam() function
			$this->is_spam = static::validate_boolean( $is_spam );
		} // End of Declare \Markguyver\LivefyreImporter\Data\Disqus\Is_Spam->set_is_spam() function
	
	} // End of Declare \Markguyver\LivefyreImporter\Data\Disqus\Is_Spam trait