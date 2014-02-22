<?php

	namespace Markguyver\LivefyreImporter;
	
	/**
	 * This is the framework's object autoloader. It only includes classes in our root namespace (\Markguyver\LivefyreImporter).
	 * The autoloader is namespace-aware and object filenames should follow: object.namespace.classname.php (with the namespaces and classnames all lowercase).
	 * @param string $class \Markguyver\LivefyreImporter\Namespace\ClassName
	 */
	function object_autoloader( $class ) {
		$class = explode( '\\', $class );
		if ( count( $class ) > 2 ) { // Validate Class Namespaces
			$root = array_shift( $class );
			$primary = array_shift( $class );
			if ( ( 'Markguyver' == $root ) AND ( 'LivefyreImporter' == $primary ) ) { // Check for Framework Namespace
				$filepath = array( 'object' );
				foreach ( $class AS $current_namespace ) { // Loop through Object Namespace
					$filepath[] = strtolower( $current_namespace );
				} // End of Loop through Object Namespace
				$filepath[] = 'php';
				$class = get_library_path() . implode( '.', $filepath );
				if ( file_exists( $class ) ) { // Check for Constructed Filepath
					include_once( $class );
				} // End of Check for Constructed Filepath
			} // End of Check for Framework Namespace
		} // End of Validate Class Namespaces
	}
	
	\spl_autoload_register( __NAMESPACE__ . '\object_autoloader' );