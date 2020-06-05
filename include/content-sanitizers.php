<?php
/**
 * Miscellaneous functions.
 * TODO: add filter to autolink URLs in the_content?
 * @package Baizman Design Standard Library
 * @version 0.1
 */

defined ( 'ABSPATH' ) or die ( 'This file cannot be run outside of WordPress.' ) ;

$bzmndsgn_config_options_database = get_option ( BZMNDSGN_CONFIG_OPTIONS );

if ( ! function_exists ( 'bzmndsgn_remove_content_blank_lines' ) ):
	/**
	 * When a post is saved, remove any empty lines from the_content.
	 * @param $content
	 *
	 * @return mixed
	 */
	function bzmndsgn_remove_content_blank_lines ( $content ) {
		$content = preg_replace ( "/^&nbsp;\s*/m", '', $content) ;
		return trim ( $content) ;
	}
	if ( isset ( $bzmndsgn_config_options_database['checkbox-strip_content_blank_lines_on_save'] ) && $bzmndsgn_config_options_database['checkbox-strip_content_blank_lines_on_save'] ) {
		add_filter( 'content_save_pre', 'bzmndsgn_remove_content_blank_lines', 10, 1 );
	}
endif;

/**
 * Remove blank links when the_content is output. (In case we're on a website that doesn't have the bzmndsgn_remove_content_blank_lines filter enabled.)
 * @param $content
 *
 * @return string
 *
 * @link https://developer.wordpress.org/reference/hooks/the_content/
 */
if ( ! function_exists ( 'bzmndsgn_filter_content_blank_lines' ) ):
	function pce_filter_content_blank_lines( $content ) {

		// Check if we're inside the main loop in a single post page.
		if ( is_single() && in_the_loop() && is_main_query() ) {
			if ( get_post_type() == 'course' ) {
				$content = preg_replace ( "/^&nbsp;\s*/m", '', $content) ;
				return trim ( $content) ;
			}
		}

		return $content;
	}
	if ( isset ( $bzmndsgn_config_options_database['checkbox-strip_content_blank_lines_on_display'] ) && $bzmndsgn_config_options_database['checkbox-strip_content_blank_lines_on_display'] ) {
		add_filter( 'the_content', 'bzmndsgn_filter_content_blank_lines' );
	}
endif;

if ( ! function_exists ( 'bzmndsgn_strip_illegal_tags' ) ):
	function bzmndsgn_strip_illegal_tags ( $content ) {
		/**
		 * When a post is saved, remove all tags but the legal tags in the array.
		 * @param $content
		 *
		 * @return string
		 */

		// These tags will not be stripped out.
		// FIXME: limit to one or more post types?
		// TODO: make these tags user-configurable via the admin interface.
		$legal_tags[] = '<a>' ;
		$legal_tags[] = '<b>' ;
		$legal_tags[] = '<strong>' ;
		$legal_tags[] = '<i>' ;
		$legal_tags[] = '<em>' ;
		$legal_tags[] = '<h1>' ;
		$legal_tags[] = '<h2>' ;
		$legal_tags[] = '<h3>' ;
		$legal_tags[] = '<h4>' ;
		$legal_tags[] = '<h5>' ;
		$legal_tags[] = '<h6>' ;
		$legal_tags[] = '<ul>' ;
		$legal_tags[] = '<li>' ;
		$legal_tags[] = '<blockquote>' ;
		$legal_tags[] = '<p>' ; // necessary?

		return strip_tags( $content, implode( '', $legal_tags ) );
	}
	if ( isset ( $bzmndsgn_config_options_database['checkbox-strip_illegal_tags_on_save'] ) && $bzmndsgn_config_options_database['checkbox-strip_illegal_tags_on_save'] ) {
		add_filter( 'content_save_pre', 'bzmndsgn_strip_illegal_tags', 10, 1 );
	}
endif;

if ( ! function_exists ( 'bzmndsgn_filter_content_double_spaces' ) ):
	/**
	 * Condense double-spaces into a single space when the_content is output.
	 * @param $content
	 *
	 * @return string
	 * @link https://stackoverflow.com/questions/16563421/cant-get-str-replace-to-strip-out-spaces-in-a-php-string
	 */
	function bzmndsgn_filter_content_double_spaces( $content ) {

		// Check if we're inside the main loop in a single post page.
		if ( is_single() && in_the_loop() && is_main_query() ) {
			if ( get_post_type() == 'section' ) {

				return preg_replace('/\s+/u', ' ', $content ) ;
			}
		}

		return $content;
	}
	if ( isset ( $bzmndsgn_config_options_database['checkbox-strip_double_spaces_on_display'] ) && $bzmndsgn_config_options_database['checkbox-strip_double_spaces_on_display'] ) {
		add_filter( 'the_content', 'bzmndsgn_filter_content_double_spaces' );
	}
endif;

if ( ! function_exists ( 'bzmndsgn_strip_double_spaces' ) ):
	/**
	 * Condense double-spaces into a single space when the post is saved.
	 * FIXME: this may need more testing before it is rolled out to clients' websites.
	 * @param $content
	 *
	 * @return string
	 * @link https://stackoverflow.com/questions/16563421/cant-get-str-replace-to-strip-out-spaces-in-a-php-string
	 */
	function bzmndsgn_strip_double_spaces( $content ) {

		return preg_replace('/\s+/u', ' ', $content ) ;

	}
	if ( isset ( $bzmndsgn_config_options_database['checkbox-strip_double_spaces_on_save'] )  && $bzmndsgn_config_options_database['checkbox-strip_double_spaces_on_save'] ) {
		add_filter( 'content_save_pre', 'bzmndsgn_strip_double_spaces', 10, 1 );
	}
endif;

