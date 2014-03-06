<?php

	namespace Markguyver\LivefyreImporter\Controller\Disqus;
	
	use \Markguyver\LivefyreImporter\Data\Disqus\Thread;
	use \Markguyver\LivefyreImporter\Data\Disqus\Post;
	
	class Import extends \Markguyver\LivefyreImporter\Controller\Base { // Declare \Markguyver\LivefyreImporter\Controller\Disqus\Import class
		
		use \Markguyver\LivefyreImporter\Helper\XML_Iterator; // Add XML_Iterator Trait
		
		protected $recognized_nodes = array(
			'thread'	=> 'create_thread',
			'post'		=> 'create_post'
		);
		
		public function import_all_nodes( $node_name, $xml_filepath = null ) { // Declare \Markguyver\LivefyreImporter\Controller\Disqus\Import->import_all_nodes() function
			if ( $xml_filepath ) { // Check for Passed XML Filepath
				$this->set_xml_data_filepath( $xml_filepath );
			} // End of Check for Passed XML Filepath
			if ( !empty( $this->recognized_nodes[$node_name] ) AND $this->set_xml_iteration_node_name( $node_name ) AND $this->set_xml_data_object() ) { // Check XML Object Initialization
				$this->initialize_statistics_node( $node_name );
				while( $current_node = $this->get_next_xml_node() ) { // Loop through XML Nodes
					$this->statistics[$node_name]['total']++;
					$current_simplexml = \simplexml_load_string( $current_node );
					if ( $current_simplexml ) { // Check for SimpleXMLElement
						$current_object = $this->{$this->recognized_nodes[$node_name]}( $current_simplexml );
						if ( $current_object ) { // Check for Thread Object
							$this->statistics[$node_name]['processed']++;
							
							
// 							print_r( $current_object ); // DELETE
							
							
						} else { // Middle of Check for Thread Object
							$this->statistics[$node_name]['failed']++;
						} // End of Check for Thread Object
					} else { // Middle of Check for SimpleXMLElement
						$this->statistics[$node_name]['skipped']++;
					} // End of Check for SimpleXMLElement
				} // End of Loop through XML Nodes
			} // End of Check XML Object Initialization
			if ( $this->xml_iteration_node_name ) { // Check for Iteration Node Name
				$this->clear_xml_iteration_node_name();
			} // End of Check for Iteration Node Name
			if ( $this->xml_data_object ) { // Check for XML Data Object
				$this->clear_xml_data_object();
			} // End of Check for XML Data Object
		} // End of Declare \Markguyver\LivefyreImporter\Controller\Disqus\Import->import_all_nodes() function
		
		protected function create_thread( \SimpleXMLElement $thread_xml ) {
			return Thread::create_thread_from_disqus_object( $thread_xml );
		}
		
		protected function create_post( \SimpleXMLElement $post_xml ) {
			return Post::create_post_from_disqus_object( $post_xml );
		}
		
	} // End of Declare \Markguyver\LivefyreImporter\Controller\Disqus\Import class