<?php

	namespace Markguyver\LivefyreImporter\Controller;
	
	abstract class Base { // Declare \Markguyver\LivefyreImporter\Controller\Base abstract class
		
		use \Markguyver\LivefyreImporter\Helper\Validation;		// Add Validation Trait
		use \Markguyver\LivefyreImporter\Helper\Error_Message;	// Add Error_Message Trait
		use \Markguyver\LivefyreImporter\Database\Usage;		// Add Database Usage Trait
		
		protected $statistics = array();
		
		protected $view_object = false;
		
		public function __construct() { // Declare \Markguyver\LivefyreImporter\Controller\Base->__construct() function
			$this->get_database();
			$this->set_view_object();
		} // End of Declare \Markguyver\LivefyreImporter\Controller\Base->__construct() function
		
		public function set_view_object() {
			$return = false;
			$view_type = $this->determine_view_type();
			$this->view_object = new $view_type();
			return $return;
		}
		
		protected function determine_view_type() {
			$return = '\Markguyver\LivefyreImporter\View\\';
			switch ( php_sapi_name() ) { // Check PHP SAPI Value
				
				case 'cli':
					$return .= 'CLI';
				break;
				
				default:
					$return .= 'HTML';
				break;
				
			} // End of Check PHP SAPI Value
			return $return;
		}
		
		protected function initialize_statistics_node( $node_name ) {
			$node_name = $this->validate_string( $node_name );
			if ( $node_name ) { // Check for Valid Node Name
				$this->statistics[$node_name] = array(
					'total'			=> 0,
					'processed'		=> 0,
					'skipped'		=> 0,
					'failed'		=> 0
				);
			} // End of Check for Valid Node Name
		}
		
		public function get_statistics() {
			return $this->statistics;
		}
		
	} // End of Declare \Markguyver\LivefyreImporter\Controller\Base abstract class