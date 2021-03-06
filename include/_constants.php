<?php
/**
 * @package Baizman Design Standard Library
 * @version 0.1
 */

defined ( 'ABSPATH' ) or die ( 'This file cannot be run outside of WordPress.' ) ;

// Move all constants here?
// Two issues to resolve:
// + this file should always be called first because the order matters.
// --> renaming this file and prefixing an underscore addresses this issues.
// + some of the constants derive the current folder from __FILE__, which will make folder references incorrect since we'll need to refer to the parent folder.

// Include local configuration, if present.
$local_config_path = sprintf ('%s%s%s', dirname ( __FILE__ ), DIRECTORY_SEPARATOR, 'local-config.php' ) ;

if ( file_exists ( $local_config_path ) ) {
	include_once ( $local_config_path ) ;
}

// Wrap constants in if statement to allow local over-rides.
if ( ! defined( 'BZMNDSGN_SHOW_DASHBOARD_INTERFACE' ) )
	define ( 'BZMNDSGN_SHOW_DASHBOARD_INTERFACE', True ) ;

if ( ! defined ( 'BZMNDSGN_STAGING_BACKGROUND_COLOR' ) )
	define ( 'BZMNDSGN_STAGING_BACKGROUND_COLOR', '#edeae6' ) ;

if ( ! defined ( 'BZMNDSGN_DEV_BACKGROUND_COLOR' ) )
	define ( 'BZMNDSGN_DEV_BACKGROUND_COLOR', '#f1ece7' ) ;

if ( ! defined ( 'BZMNDSGN_LOCAL_BACKGROUND_COLOR' ) ) {
	define ( 'BZMNDSGN_LOCAL_BACKGROUND_COLOR', '#e8f5f8' ) ;
}
