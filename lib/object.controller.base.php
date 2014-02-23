<?php

	namespace Markguyver\LivefyreImporter\Controller;
	
	abstract class Base extends \Markguyver\LivefyreImporter\Database\Usage { // Declare \Markguyver\LivefyreImporter\Controller\Base abstract class
		
		public function __construct() { // Declare \Markguyver\LivefyreImporter\Controller\Base->__construct() function
			$this->get_database();
		} // End of Declare \Markguyver\LivefyreImporter\Controller\Base->__construct() function
		
	} // End of Declare \Markguyver\LivefyreImporter\Controller\Base abstract class