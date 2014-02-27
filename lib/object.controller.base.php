<?php

	namespace Markguyver\LivefyreImporter\Controller;
	
	abstract class Base { // Declare \Markguyver\LivefyreImporter\Controller\Base abstract class
		
		use \Markguyver\LivefyreImporter\Helper\Validation;		// Add Validation Trait
		use \Markguyver\LivefyreImporter\Helper\Error_Message;	// Add Error_Message Trait
		use \Markguyver\LivefyreImporter\Database\Usage;		// Add Database Usage Trait
		
		protected $statistics = array();
		
		public function __construct() { // Declare \Markguyver\LivefyreImporter\Controller\Base->__construct() function
			$this->get_database();
		} // End of Declare \Markguyver\LivefyreImporter\Controller\Base->__construct() function
		
	} // End of Declare \Markguyver\LivefyreImporter\Controller\Base abstract class