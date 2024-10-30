<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Klementin_wp_sub_menu_point {

	private $data = array();

	/**
	 * Allows for setting a menu property
	 *
	 * @param $prop - As defined per WP documentation
	 * @param $value - The value
	 *
	 * @return $this
	 */
	public function set_property( $prop, $value ) {
		$this->data[ $prop ] = $value;

		return $this;
	}

	/**
	 * Sets all the data at once.
	 *
	 * @param $data
	 *
	 * @return $this
	 */
	public function setup( $data ) {
		$this->data = $data;

		return $this;
	}

	/**
	 * Adds the WordPress menu
	 * @return $this
	 */
	public function add() {

		add_action( 'admin_menu', function () {
			add_submenu_page( ...array_values( $this->data ) );
		} );

		return $this;
	}
}