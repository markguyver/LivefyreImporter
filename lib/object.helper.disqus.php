<?php

	namespace Markguyver\LivefyreImporter\Helper;
	
	class Disqus { // Define \Markguyver\LivefyreImporter\Helper\Disqus class
		
		public static function retrieve_id_from_disqus_object( \SimpleXMLElement $disqus_node ) { // Declare \Markguyver\LivefyreImporter\Helper\Disqus::retrieve_id_from_disqus_object() function
			$return = false;
			$namespaces = $disqus_node->getNamespaces( true );
			if ( !empty( $namespaces['dsq'] ) ) { // Check for Namespace
				$id = (int) $disqus_node->attributes( $namespaces['dsq'] )->id;
				if ( !empty( $id ) ) { // Check for Data
					$return = $id;
				} // End of Check for Data
			} // End of Check for Namespace
			return $return;
		} // End of Declare \Markguyver\LivefyreImporter\Helper\Disqus::retrieve_id_from_disqus_object() function
		
		protected function __construct() { // Declare \Markguyver\LivefyreImporter\Helper\Disqus->__construct() function
			// Prevent class instantiation, this class should NOT be extended. Helpers should be static functions.
		} // End of Declare \Markguyver\LivefyreImporter\Helper\Disqus->__construct() function
		
	} // End of \Markguyver\LivefyreImporter\Helper\Disqus class