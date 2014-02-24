<?php

	namespace Markguyver\LivefyreImporter\Helper;
	
	trait Singleton { // Declare \Markguyver\LivefyreImporter\Helper\Singleton trait
		
		protected static $singleton_instance;
		
		public static function get_instance() { // Declare \Markguyver\LivefyreImporter\Helper\Singleton::get_instance() function
			if ( ! static::$singleton_instance instanceof self ) { // Check for Existing Database Handle
				static::$singleton_instance = new static();
			} // End of Check for Existing Database Handle
			return static::$singleton_instance;
		} // End of Declare \Markguyver\LivefyreImporter\Helper\Singleton::get_instance() function
		
		protected abstract function __construct(); // Declare \Markguyver\LivefyreImporter\Helper\Singleton->__construct() abstract function
		
	} // End of Declare \Markguyver\LivefyreImporter\Helper\Singleton trait