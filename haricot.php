<?php
/**
 * Plugin Name: Haricot
 * Plugin URI:  https://github.com/caercam/haricot
 * Description: A neat little term meta framework based on ButterBean by Justin Tadlock.
 * Version:     1.0.1-dev
 * Author:      Charlie Merland
 * Author URI:  http://caercam.org
 *
 * @package    Haricot
 * @author     Justin Tadlock <justin@justintadlock.com>
 * @author     Charlie Merland <charlie@caercam.org>
 * @copyright  Copyright (c) 2015-2016, Justin Tadlock, Charlie Merland
 * @link       https://github.com/caercam/haricot
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

// For each version release, the priority needs to decrement by 1. This is so that
// we can load newer versions earlier than older versions when there's a conflict.
add_action( 'init', 'haricot_loader_101', 9998 );

if ( ! function_exists( 'haricot_loader_101' ) ) {

	/**
	 * Loader function.  Note to change the name of this function to use the
	 * current version number of the plugin.  `1.0.0` is `100`, `1.3.4` = `134`.
	 *
	 * @since  1.0.1
	 * @access public
	 * @return void
	 */
	function haricot_loader_101() {

		// If not in the admin, bail.
		if ( ! is_admin() )
			return;

		// If Haricot hasn't been loaded, let's load it.
		if ( ! defined( 'HARICOT_LOADED' ) ) {
			define( 'HARICOT_LOADED', true );

			require_once( trailingslashit( plugin_dir_path( __FILE__ ) ) . 'class-haricot.php' );
		}
	}
}
