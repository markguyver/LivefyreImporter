<?php

	namespace Markguyver\LivefyreImporter;
	
	/**
	 * Stores the framework library folder path in a static variable and returns it for includes.
	 * @return string /path/to/lib/
	 */
	function get_library_path() { // Declare \Markguyver\LivefyreImporter\get_library_path() function
		static $library_path = null;
		if ( is_null( $library_path ) ) { // Check for Empty Path
			$library_path = dirname( __FILE__ ) . '/';
		} // End of Check for Empty Path
		return $library_path;
	} // End of Declare \Markguyver\LivefyreImporter\get_library_path() function

	include_once( get_library_path() . 'include.configuration.php' ); // Retrieve Configuration
	include_once( get_library_path() . 'include.autoloader.php' ); // Add Object Autoloader