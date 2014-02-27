<?php

	namespace Markguyver\LivefyreImporter\Data\Disqus;
	
	trait Disqus_ID { // Define \Markguyver\LivefyreImporter\Data\Disqus\Disqus_ID trait
		
		public function retrieve_id_from_disqus_object( \SimpleXMLElement $disqus_node ) { // Declare \Markguyver\LivefyreImporter\Data\Disqus\Disqus_ID::retrieve_id_from_disqus_object() function
			$return = false;
			$namespaces = $disqus_node->getNamespaces( true );
			if ( ! empty( $namespaces['dsq'] ) AND ! empty( $disqus_node->attributes( $namespaces['dsq'] )->id ) ) { // Check for Namespace
				$id = (int) $disqus_node->attributes( $namespaces['dsq'] )->id;
				if ( !empty( $id ) ) { // Check for Data
					$return = $id;
				} // End of Check for Data
			} // End of Check for Namespace
			return $return;
		} // End of Declare \Markguyver\LivefyreImporter\Data\Disqus\Disqus_ID::retrieve_id_from_disqus_object() function
		
	} // End of \Markguyver\LivefyreImporter\Data\Disqus\Disqus_ID trait