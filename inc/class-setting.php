<?php
/**
 * Base setting class for the fields manager.
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
 * Base setting class.
 *
 * @since  1.0.0
 * @access public
 */
class Haricot_Setting {

	/**
	 * The type of setting.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'default';

	/**
	 * Stores the manager object.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    object
	 */
	public $manager;

	/**
	 * Name/ID of the setting.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $name = '';

	/**
	 * Value of the setting.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $value = '';

	/**
	 * Default value of the setting.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $default = '';

	/**
	 * Sanitization/Validation callback function.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $sanitize_callback = '';

	/**
	 * A user role capability required to save the setting.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string|array
	 */
	public $capability = '';

	/**
	 * A feature that the current theme must support to save the setting.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string|array
	 */
	public $theme_supports = '';

	/**
	 * Creates a new setting object.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @param  string  $cap
	 * @param  array   $args
	 * @return void
	 */
	public function __construct( $manager, $name, $args = array() ) {

		foreach ( array_keys( get_object_vars( $this ) ) as $key ) {

			if ( isset( $args[ $key ] ) )
				$this->$key = $args[ $key ];
		}

		$this->manager = $manager;
		$this->name    = $name;

		if ( $this->sanitize_callback )
			add_filter( "haricot_{$this->manager->name}_sanitize_{$this->name}", $this->sanitize_callback, 10, 2 );
	}

	/**
	 * Gets the value of the setting.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return mixed
	 */
	public function get_value() {

		$value = get_term_meta( $this->manager->term_id, $this->name, true );

		return ! $value ? $this->default : $value;
	}

	/**
	 * Gets the posted value of the setting.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return mixed
	 */
	public function get_posted_value() {

		$value = '';

		if ( isset( $_POST[ $this->get_field_name() ] ) )
			$value = $_POST[ $this->get_field_name() ];

		return $this->sanitize( $value );
	}

	/**
	 * Retuns the correct field name for the setting.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function get_field_name() {

		return "haricot_{$this->manager->name}_setting_{$this->name}";
	}

	/**
	 * Sanitizes the value of the setting.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return mixed
	 */
	public function sanitize( $value ) {

		return apply_filters( "haricot_{$this->manager->name}_sanitize_{$this->name}", $value, $this );
	}

	/**
	 * Saves the value of the setting.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function save() {

		if ( ! $this->check_capabilities() )
			return;

		$old_value = $this->get_value();
		$new_value = $this->get_posted_value();

		// If we have don't have a new value but do have an old one, delete it.
		if ( ! $new_value && $old_value )
			delete_term_meta( $this->manager->term_id, $this->name );

		// If the new value doesn't match the old value, set it.
		else if ( $new_value !== $old_value )
			update_term_meta( $this->manager->term_id, $this->name, $new_value );
	}

	/**
	 * Checks if the setting should be saved at all.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return bool
	 */
	public function check_capabilities() {

		if ( $this->capability && ! call_user_func_array( 'current_user_can', (array) $this->capability ) )
			return false;

		if ( $this->theme_supports && ! call_user_func_array( 'theme_supports', (array) $this->theme_supports ) )
			return false;

		return true;
	}
}
