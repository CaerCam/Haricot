<?php
/**
 * Helper functions.
 *
 * @package    Haricot
 * @subpackage Admin
 * @author     Justin Tadlock <justin@justintadlock.com>
 * @author     Charlie Merland <charlie@caercam.org>
 * @copyright  Copyright (c) 2015-2016, Justin Tadlock, Charlie Merland
 * @link       https://github.com/caercam/haricot
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/**
 * Function for validating booleans before saving them as metadata. If the value is
 * `true`, we'll return a `1` to be stored as the meta value.  Else, we return `false`.
 *
 * @since  1.0.0
 * @access public
 * @param  mixed
 * @return bool|int
 */
function haricot_validate_boolean( $value ) {

	return wp_validate_boolean( $value ) ? 1 : false;
}

/**
 * Pre-WP 4.6 function for sanitizing hex colors.
 *
 * @since  1.0.0
 * @access public
 * @param  string  $color
 * @return string
 */
function haricot_sanitize_hex_color( $color ) {

	if ( function_exists( 'sanitize_hex_color' ) )
		return sanitize_hex_color( $color );

	return $color && preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ? $color : '';
}

/**
 * Pre-WP 4.6 function for sanitizing hex colors without a hash.
 *
 * @since  1.0.0
 * @access public
 * @param  string  $color
 * @return string
 */
function haricot_sanitize_hex_color_no_hash( $color ) {

	if ( function_exists( 'sanitize_hex_color_no_hash' ) )
		return sanitize_hex_color_no_hash( $color );

	$color = ltrim( $color, '#' );

	if ( '' === $color )
		return '';

	return haricot_sanitize_hex_color( '#' . $color ) ? $color : null;
}

/**
 * Pre-WP 4.6 function for sanitizing a color and adding a hash.
 *
 * @since  1.0.0
 * @access public
 * @param  string  $color
 * @return string
 */
function haricot_maybe_hash_hex_color( $color ) {

	if ( function_exists( 'maybe_hash_hex_color' ) )
		return maybe_hash_hex_color( $color );

	if ( $unhashed = haricot_sanitize_hex_color_no_hash( $color ) )
		return '#' . $unhashed;

	return $color;
}

/**
 * Gets Underscore.js templates for managers.
 *
 * @since  1.0.0
 * @param  string  $slug
 * @return void
 */
function haricot_get_manager_template( $slug = '' ) {
	haricot_get_template( 'manager', $slug );
}

/**
 * Gets Underscore.js templates for navs.
 *
 * @since  1.0.0
 * @param  string  $slug
 * @return void
 */
function haricot_get_nav_template( $slug = '' ) {
	haricot_get_template( 'nav', $slug );
}

/**
 * Gets Underscore.js templates for sections.
 *
 * @since  1.0.0
 * @param  string  $slug
 * @return void
 */
function haricot_get_section_template( $slug = '' ) {
	haricot_get_template( 'section', $slug );
}

/**
 * Gets Underscore.js templates for controls.
 *
 * @since  1.0.0
 * @param  string  $slug
 * @return void
 */
function haricot_get_control_template( $slug = '' ) {
	haricot_get_template( 'control', $slug );
}

/**
 * Helper function for getting Underscore.js templates.
 *
 * @since  1.0.0
 * @param  string  $name
 * @param  string  $slug
 * @return void
 */
function haricot_get_template( $name, $slug = '' ) {

	// Allow devs to hook in early to bypass template checking.
	$located = apply_filters( "haricot_pre_{$name}_template", '', $slug );

	// If there's no template, let's try to find one.
	if ( ! $located ) {

		$templates = array();

		if ( $slug )
			$templates[] = "{$name}-{$slug}.php";

		$templates[] = "{$name}.php";

		// Allow devs to filter the template hierarchy.
		$templates = apply_filters( "haricot_{$name}_template_hierarchy", $templates, $slug );

		// Loop through the templates and locate one.
		foreach ( $templates as $template ) {

			if ( file_exists( haricot()->tmpl_path . $template ) ) {
				$located = haricot()->tmpl_path . $template;
				break;
			}
		}
	}

	// Allow devs to filter the final template.
	$located = apply_filters( "haricot_{$name}_template", $located, $slug );

	// Load the template.
	if ( $located )
		require( $located );
}
