<?php

	namespace Markguyver\LivefyreImporter;
	
	/**
	 * This constant contains the name of the database object class that you would like the framework to use.
	 * Please note: this object MUST extend the \Markguyver\LivefyreImport\Database\Base class.
	 * @var string The database object class name
	 */
	const DATABASE_OBJECT_NAME = '\Markguyver\LivefyreImporter\Database\MySQL';
	
	/**
	 * This variable contains an array of connection options to be used by the database object class.
	 * Please see database object (concrete) class for documentation about valid options.
	 * @var array The options to be used to connect to the database
	 */
	$database_options = array(
		'host'			=> '127.0.0.1',
		'user'			=> 'livefyre',
		'password'		=> 'livefyre',
		'database'		=> 'livefyre',
		'encoding'		=> 'utf8',
 		'error_mode'	=> \PDO::ERRMODE_SILENT
	);
	global $database_options;
	
	/**
	 * This is a list of HTML tags allowed by Livefyre. This variable will be used as the second parameter of strip_tags().
	 * @var string The allowed HTML tags
	 */
	const HTML_ALLOWED_TAGS = '<a><span><label><p><br><strong><em><u><blockquote><ul><li><ol><pre><body><b><i>';