<?php

	namespace Markguyver\LivefyreImporter;
	
	/**
	 * This is the framework's object autoloader. It only includes classes and traits in our root namespace (\Markguyver\LivefyreImporter).
	 * The autoloader is namespace-aware and object/trait filenames should follow (with the namespaces and classnames all lowercase): trait.namespace.classname.php or object.namespace.classname.php
	 * @param string $class \Markguyver\LivefyreImporter\Namespace\ClassName
	 */
	function object_autoloader( $class ) { // Declare \Markguyver\LivefyreImporter\object_autoloader() function
		$class = explode( '\\', $class );
		if ( count( $class ) > 2 ) { // Validate Class Namespaces
			$root = array_shift( $class );
			$primary = array_shift( $class );
			if ( ( 'Markguyver' == $root ) AND ( 'LivefyreImporter' == $primary ) ) { // Check for Framework Namespace
				$filepath_prefixes = array( 'trait', 'object' );
				foreach ( $class AS $current_namespace ) { // Loop through Object Namespace
					$filepath[] = strtolower( $current_namespace );
				} // End of Loop through Object Namespace
				$filepath[] = 'php';
				foreach ( $filepath_prefixes AS $current_prefix ) { // Loop through Filepath Prefixes
					$current_class_path = get_library_path() . implode( '.', array_merge( array( $current_prefix ), $filepath ) );
					if ( is_readable( $current_class_path ) ) { // Check for Constructed Filepath
						include_once( $current_class_path );
					} // End of Check for Constructed Filepath
				} // End of Loop through Filepath Prefixes
			} // End of Check for Framework Namespace
		} // End of Validate Class Namespaces
	} // End of Declare \Markguyver\LivefyreImporter\object_autoloader() function
	
	\spl_autoload_register( __NAMESPACE__ . '\object_autoloader' ); // Register Framework Autoloader