<?php
/**
 * WP dashboard customization.
 * @package Baizman Design Standard Library
 * @version 0.1
 * FIXME: add setting for fixed column headings.
 */

function bzmndsgn_dashboard ( ) {
	_print_admin_settings_heading ('WP Dashboard Customization', 'Baizman Design Standard Library' ) ;

	$bzmndsgn_config_options_database = get_option ( BZMNDSGN_CONFIG_OPTIONS );

	$dashboard_settings_form = new form ( 'dashboard_settings' ) ;
	$dashboard_settings_form->set_settings_fields_option_group(BZMNDSGN_SETTINGS_GROUP);
	$dashboard_settings_form->set_settings_fields_page(BZMNDSGN_SETTINGS_GROUP );

	// Show correct background color prompt depending on the environment.

	$environment = _get_environment_type ( );

	$dashboard_background_color_field_label = '' ;
	$dashboard_background_color_field_input_name = '' ;

	switch ( $environment ) {
		case 'Local Development':
			$dashboard_background_color_field_label = 'Local development';
			$dashboard_background_color_field_input_name = 'local_dashboard_background_color' ;
			break;

		case 'Development':
			$dashboard_background_color_field_label = 'Dev';
			$dashboard_background_color_field_input_name = 'dev_dashboard_background_color' ;
			break;

		case 'Staging':
			$dashboard_background_color_field_label = 'Staging';
			$dashboard_background_color_field_input_name = 'staging_dashboard_background_color' ;
			break;

		default:
			break;
	}

	$dashboard_background_color_field_label .= ' dashboard background color:' ;

	if ( $dashboard_background_color_field_label && $dashboard_background_color_field_input_name ) {
		$dashboard_background_color = new color ( $dashboard_background_color_field_label, $dashboard_background_color_field_input_name,  $bzmndsgn_config_options_database[$dashboard_background_color_field_input_name] );
		$dashboard_background_color->set_field_help_text('Or try <a href="javascript:set_wp_bg_color(\'aliceblue\')">aliceblue</a>, <a href="javascript:set_wp_bg_color(\'ivory\')">ivory</a>, <a href="javascript:set_wp_bg_color(\'seashell\')">seashell</a>, or <a href="javascript:set_wp_bg_color(\'ghostwhite\')">ghostwhite</a>.');
		$dashboard_background_color->set_field_id ( 'wp_dashboard_color' );
		$dashboard_settings_form->add_form_field( $dashboard_background_color );
	}
	/*
	$production_dashboard_background_color = new text_input( 'Production dashboard background', 'english, hex, rgb, rgba, hsl, hsla color', $bzmndsgn_config_options_database['production_dashboard_background_color'] ) ;
	$general_settings_form->add_form_field($production_dashboard_background_color);
	*/

	$show_site_name = new checkbox ('Replace thank-you text with site name?',
		'checkbox-show_site_name',
		$bzmndsgn_config_options_database['checkbox-show_site_name']
	) ;
	$show_site_name->set_label_help_text('This appears in the lower left corner of every page.');
	$dashboard_settings_form->add_form_field ( $show_site_name ) ;

	$show_marketing = new checkbox ('Replace WordPress version number with branding?',
		'checkbox-show_marketing',
		$bzmndsgn_config_options_database['checkbox-show_marketing']
	) ;
	$show_marketing->set_label_help_text('This appears in the lower right corner of every page.');
	$show_marketing->set_field_help_text('Enter branding information in the field below.') ;
	$dashboard_settings_form->add_form_field ($show_marketing) ;

	$branding_info = new text_area (
		'Enter branding information:',
		'textarea-branding_info',
		'Your Company, Inc.',
		$bzmndsgn_config_options_database['textarea-branding_info']) ;
	// $branding_info->set_field_help_text('Enter one tag per line, no angle brackets (&lt;&gt;) necessary.');
	$branding_info->set_show_label( false ) ;
	$branding_info->set_rows ( 2 );
	$branding_info->set_field_help_text('Note: HTML is OK.');

	$dashboard_settings_form->add_form_field ($branding_info) ;

	if ( _get_environment_type ( ) != 'Production' ) {
		$show_site_warning = new checkbox ('Display global site warning?',
			'checkbox-show_global_site_warning',
			$bzmndsgn_config_options_database['checkbox-show_global_site_warning']
		) ;
		$show_site_warning->set_label_help_text('This message appears as a call-out at the top of every page in the dashboard.') ;
		$show_site_warning->set_field_help_text('Enter global site warning in the field below.') ;

		$dashboard_settings_form->add_form_field ($show_site_warning) ;

		$global_site_warning = new text_area (
			'Global site warning:',
			'textarea-global_site_warning',
			'Your Company, Inc.',
			$bzmndsgn_config_options_database['textarea-global_site_warning']) ;
		// $branding_info->set_field_help_text('Enter one tag per line, no angle brackets (&lt;&gt;) necessary.');
		$global_site_warning->set_show_label( false ) ;
		$global_site_warning->set_rows ( 4 );
		$global_site_warning->set_field_help_text('Note: HTML is OK.');
		$dashboard_settings_form->add_form_field ($global_site_warning) ;
	}

	$show_dashboard_widget = new checkbox ('Display WordPress Care Package dashboard widget?',
		'checkbox-show_dashboard_widget',
		$bzmndsgn_config_options_database['checkbox-show_dashboard_widget']
	) ;
	$show_dashboard_widget->set_label_help_text('Constant BZMNDSGN_SHOW_DASHBOARD_WIDGET must also be true.');
	$show_dashboard_widget->set_field_help_text('Enter the widget title and body in the fields below.');
	$dashboard_settings_form->add_form_field ( $show_dashboard_widget ) ;

	$dashboard_widget_title = new text_input( 'Dashboard widget title:', 'text-dashboard_widget_title','Widget title', $bzmndsgn_config_options_database['text-dashboard_widget_title'] );
	$dashboard_widget_title->set_show_label ( false ) ;
	$dashboard_widget_title->set_field_help_text('Widget Title') ;
	$dashboard_settings_form->add_form_field ( $dashboard_widget_title ) ;

	$dashboard_widget_body = new text_area (
		'Dashboard widget body:',
		'textarea-dashboard_widget_body',
		'Widget body',
		$bzmndsgn_config_options_database['textarea-dashboard_widget_body']) ;
	$dashboard_widget_body->set_show_label( false ) ;
	$dashboard_widget_body->set_rows ( 4 );
	$dashboard_widget_body->set_field_help_text('Widget Body. Note: HTML is OK.<br>The following variables are available: {author_company}, {author_company_url}, {home_url}, {hostname}, {support_email}, {support_phone}, {videoconference_url}.' ) ;
	$dashboard_settings_form->add_form_field ($dashboard_widget_body) ;

	$items = [] ;
	foreach ( $GLOBALS['menu'] as $menu ) {
		$menu_name = $menu[0];
		$menu_url  = $menu[2];
		// strip out menu names that contain html
		if ( strpos ( $menu_name, '<' ) !== false ) {
			list ( $menu_name_and_whitespace, ) = explode( '<', $menu_name ) ;
			$menu_name = trim ( $menu_name_and_whitespace ) ;
		}

		if ( $menu_name != '' && $menu_name != BZMNDSGN_PLUGIN_NAME ) {
			$items[$menu_name] = $menu_url ;
		}
	}

	$dashboard_links = new checkbox_group (
		'Dashboard links to hide:',
		'checkboxes-dashboard_links_to_hide',
		$items
	) ;
	$dashboard_settings_form->add_form_field ($dashboard_links) ;

	// enable fixed table headers.
	$enable_fixed_admin_table_headers = new checkbox ('Enable fixed table headers on edit listing screens?',
		'checkbox-enable_fixed_admin_table_headers',
		$bzmndsgn_config_options_database['checkbox-enable_fixed_admin_table_headers']
	) ;
	$dashboard_settings_form->add_form_field ( $enable_fixed_admin_table_headers ) ;

	// disable file editing.
	$disable_file_editing = new checkbox ('Disable theme and plugin file editor?',
		'checkbox-disable_file_editor',
		$bzmndsgn_config_options_database['checkbox-disable_file_editor']
	) ;
	$disable_file_editing->set_label_help_text('Hides links to "Appearance > Theme Editor" and "Plugins > Plugin Editor."');
	$dashboard_settings_form->add_form_field ( $disable_file_editing ) ;

	// only show if toolset plugin is enabled.
	if ( BZMNDSGN_HAS_TOOLSET ) {
		// hide toolset expiration notice.
		$hide_toolset_expiration_notice = new checkbox ( 'Hide Toolset plugin expiration notice?',
			'checkbox-hide_toolset_expiration_notice',
			$bzmndsgn_config_options_database['checkbox-hide_toolset_expiration_notice']
		);
		$hide_toolset_expiration_notice->set_label_help_text( 'If <a href="https://toolset.com" target="_blank" rel="noopener">Toolset</a> has expired, check the box to hide the administrative notice.' );
		$dashboard_settings_form->add_form_field( $hide_toolset_expiration_notice );
	}

	// only show if toolset plugin is enabled.
	if ( BZMNDSGN_HAS_TOOLSET ) {
		// sort Toolset custom taxonomies alphabetically.
		$enable_toolset_taxonomy_sort = new checkbox ( 'Sort Toolset custom taxonomies alphabetically?',
			'checkbox-enable_toolset_taxonomy_sort',
			$bzmndsgn_config_options_database['checkbox-enable_toolset_taxonomy_sort']
		);
		$enable_toolset_taxonomy_sort->set_label_help_text('This sorts taxonomies in post submenus in alphabetical order. ') ;
		$dashboard_settings_form->add_form_field( $enable_toolset_taxonomy_sort );
	}

	// Output form.
	$dashboard_settings_form->render_form();

}