<?php

	namespace Markguyver\LivefyreImporter\Helper;
	
	trait XML_Iterator { // Declare \Markguyver\LivefyreImporter\Helper\XML_Iterator trait
		
		protected $xml_data_filepath = false;
		
		protected $xml_data_object = false;
		
		protected $xml_iteration_node_name = false;
		
		public abstract function validate_string( $string );
		
		public function get_xml_data_filepath() { // Declare \Markguyver\LivefyreImporter\Helper\XML_Iterator->get_xml_data_filepath() function
			return $this->xml_data_filepath;
		} // End of Declare \Markguyver\LivefyreImporter\Helper\XML_Iterator->get_xml_data_filepath() function
		
		protected function set_xml_data_filepath( $filepath ) { // Declare \Markguyver\LivefyreImporter\Helper\XML_Iterator->set_xml_data_filepath() function
			$return = false;
			$filepath = $this->validate_string( $filepath );
			if ( $filepath AND is_readable( $filepath ) ) { // Check for Passed Filepath Parameter
				$this->xml_data_filepath = $filepath;
			} // End of Check for Passed Filepath Parameter
			return $return;
		} // End of Declare \Markguyver\LivefyreImporter\Helper\XML_Iterator->set_xml_data_filepath() function
		
		protected function clear_xml_data_filepath() { // Declare \Markguyver\LivefyreImporter\Helper\XML_Iterator->clear_xml_data_filepath() function
			$this->xml_data_filepath = false;
		} // End of Declare \Markguyver\LivefyreImporter\Helper\XML_Iterator->clear_xml_data_filepath() function
		
		protected function set_xml_data_object() { // Declare \Markguyver\LivefyreImporter\Helper\XML_Iterator->set_xml_data_object() function
			$return = false;
			if ( $this->xml_data_filepath ) { // Check for XML Data Filepath
				$this->xml_data_object = new \XMLReader();
				$return = $this->xml_data_object->open( $this->xml_data_filepath );
			} // End of Check for XML Data Filepath
			return $return;
		} // End of Declare \Markguyver\LivefyreImporter\Helper\XML_Iterator->set_xml_data_object() function
		
		protected function clear_xml_data_object() { // Declare \Markguyver\LivefyreImporter\Helper\XML_Iterator->clear_xml_data_object() function
			if ( $this->xml_data_object ) { // Check for Existing XML Data Object
				$this->xml_data_object->close();
			} // End of Check for Existing XML Data Object
			$this->xml_data_object = false;
		} // End of Declare \Markguyver\LivefyreImporter\Helper\XML_Iterator->clear_xml_data_object() function
		
		public function get_xml_iteration_node_name() { // Declare \Markguyver\LivefyreImporter\Helper\XML_Iterator->get_xml_iteration_node_name() function
			return $this->xml_iteration_node_name;
		} // End of Declare \Markguyver\LivefyreImporter\Helper\XML_Iterator->get_xml_iteration_node_name() function
		
		protected function set_xml_iteration_node_name( $iteration_node_name ) { // Declare \Markguyver\LivefyreImporter\Helper\XML_Iterator->set_xml_iteration_node_name() function
			$return = false;
			$iteration_node_name = $this->validate_string( $iteration_node_name );
			if ( $iteration_node_name ) { // Check for Passed Iteration Node Name
				$return = (bool) $this->xml_iteration_node_name = $iteration_node_name;
			} // End of Check for Passed Iteration Node Name
			return $return;
		} // End of Declare \Markguyver\LivefyreImporter\Helper\XML_Iterator->set_xml_iteration_node_name() function
		
		protected function clear_xml_iteration_node_name() { // Declare \Markguyver\LivefyreImporter\Helper\XML_Iterator->clear_xml_iteration_node_name() function
			$this->xml_iteration_node_name = false;
		} // End of Declare \Markguyver\LivefyreImporter\Helper\XML_Iterator->clear_xml_iteration_node_name() function
		
		protected function find_first_xml_node() { // Declare \Markguyver\LivefyreImporter\Helper\XML_Iterator->find_first_xml_node() function
			$return = false;
			if ( $this->xml_data_object AND $this->xml_iteration_node_name ) { // Check for XML Data Object & Iteration Node Name
				while ( ( $this->xml_data_object->read() ) AND ( $this->xml_data_object->name != $this->xml_iteration_node_name ) );
				if ( $this->xml_data_object->name == $this->xml_iteration_node_name ) { // Check Current Node Name
					$return = true;
				} // End of Check Current Node Name
			} // End of Check for XML Data Object & Iteration Node Name
			return $return;
		} // End of Declare \Markguyver\LivefyreImporter\Helper\XML_Iterator->find_first_xml_node() function
		
		protected function get_next_xml_node() { // Declare \Markguyver\LivefyreImporter\Helper\XML_Iterator->get_next_xml_node() function
			$return = false;
			if ( $this->xml_data_object AND $this->xml_iteration_node_name ) { // Check for XML Data Object & Iteration Node Name
				if ( $this->xml_data_object->name != $this->xml_iteration_node_name ) { // Check If Current Node is our Iterator
					$return = $this->find_first_xml_node();
				} else { // Middle of Check If Current Node is our Iterator
					$return = $this->xml_data_object->next( $this->xml_iteration_node_name );
				} // End of Check If Current Node is our Iterator
			} // End of Check for XML Data Object & Iteration Node Name
			if ( $return ) { // Check if Node Found
				$return = $this->xml_data_object->readOuterXML();
			} // End of Check if Node Found
			return $return;
		} // End of Declare \Markguyver\LivefyreImporter\Helper\XML_Iterator->get_next_xml_node() function
		
	} // End of Declare \Markguyver\LivefyreImporter\Helper\XML_Iterator trait