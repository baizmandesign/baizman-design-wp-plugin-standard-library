<?php
/**
 * General settings.
 * @package Baizman Design Standard Library
 * @version 0.1
 */

function bzmndsgn_general_settings () {

	_print_admin_settings_heading ('General Settings:', 'Baizman Design Standard Library' ) ;

	$bzmndsgn_config_options_database = get_option ( BZMNDSGN_CONFIG_OPTIONS );

	$general_settings_form = new form ( 'general_settings' ) ;
	$form_database_settings = $general_settings_form->get_form_database_settings() ;
	$general_settings_form->set_settings_fields_option_group(BZMNDSGN_SETTINGS_GROUP);
	$general_settings_form->set_settings_fields_page(BZMNDSGN_SETTINGS_GROUP );

	// Google Analytics ID
	$google_analytics_id = new text_input( 'Google Analytics ID:', 'google_analytics_id','UA-NNNNNNNNN-N', $bzmndsgn_config_options_database['google_analytics_id'] );
	$google_analytics_id->set_field_help_text('<a href="https://support.google.com/analytics/answer/1008080?hl=en" target="_blank" rel="noopener">Learn where to obtain your Google Analytics ID.</a>');
	$general_settings_form->add_form_field( $google_analytics_id );

	// Google Measurement ID
	// https://support.google.com/analytics/answer/9539598
	$google_measurement_id = new text_input( 'Google Measurement ID:', 'google_measurement_id','G-NNNNNNNNNN', $bzmndsgn_config_options_database['google_measurement_id'] );
	$google_measurement_id->set_field_help_text('<a href="https://support.google.com/analytics/answer/9539598?hl=en" target="_blank" rel="noopener">Learn where to obtain your Google Measurement ID.</a>');
	$general_settings_form->add_form_field( $google_measurement_id );

	// 404 log file prefix
	$four_zero_four_log_file_prefix = new text_input( '404 Log File Prefix:', 'log_file_prefix','UA-NNNNNNNNN-N', $bzmndsgn_config_options_database['log_file_prefix'] );
	$four_zero_four_log_file_prefix->set_field_help_text('To log 404 errors, add <code><small>_bzmndsgn_log_404_error()</small></code> to the theme\'s 404.php.<br><a href="/wp-admin/admin.php?page=bzmndsgn_404_error_log">Visit the 404 Error Log.</a>');
	$general_settings_form->add_form_field( $four_zero_four_log_file_prefix );

	// Local plugin option name
	$local_plugin_option_name_label = 'Local plugin option name' ;
	$local_plugin_option_name_input_name = 'local_plugin_option_name' ;
	$local_plugin_option_name = new text_input( $local_plugin_option_name_label, $local_plugin_option_name_input_name, 'option_name', $bzmndsgn_config_options_database[$local_plugin_option_name_input_name] );
	$local_plugin_option_name->set_field_help_text( 'This is the <code><small>option_name</small></code> in the MySQL database.' );

	$general_settings_form->add_form_field( $local_plugin_option_name );

	// Suppress auto-update email notifications for plugins
	$disable_plugin_auto_update_email_notifications = new checkbox( 'Suppress auto-update email notifications for plugins?','checkbox-disable_plugin_auto_update_email_notifications',$bzmndsgn_config_options_database['checkbox-disable_plugin_auto_update_email_notifications']) ;
	$general_settings_form->add_form_field ($disable_plugin_auto_update_email_notifications) ;

	// Suppress auto-update email notifications for themes
	$disable_theme_auto_update_email_notifications = new checkbox( 'Suppress auto-update email notifications for themes?','checkbox-disable_theme_auto_update_email_notifications',$bzmndsgn_config_options_database['checkbox-disable_theme_auto_update_email_notifications']) ;
	$general_settings_form->add_form_field ($disable_theme_auto_update_email_notifications) ;


	// var_dump($bzmndsgn_config_options_database);
	// print_r($form_database_settings);
	$general_settings_form->render_form();

	_print_admin_settings_footer() ;

}
