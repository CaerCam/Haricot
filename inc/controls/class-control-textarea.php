<?php
/**
 * Textarea control class.
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
 * Textarea control class.
 *
 * @since  1.0.0
 * @access public
 */
class Haricot_Control_Textarea extends Haricot_Control {

	/**
	 * The type of control.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'textarea';

	/**
	 * Adds custom data to the json array. This data is passed to the Underscore template.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function to_json() {
		parent::to_json();

		$this->json['value'] = esc_textarea( $this->get_value() );
	}
}
