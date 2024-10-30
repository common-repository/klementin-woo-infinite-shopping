<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Klementin_Wp_view {

	/**
	 * Returns a view file and allows for variable injection
	 *
	 * @param $name
	 * @param array $args
	 */
	public static function render( $name, array $args = array() ) {
		$args = apply_filters( 'klementin_wp_view', $args, $name );

		foreach ( $args as $key => $val ) {
			$$key = $val;
		}

		$file = __DIR__ . '/../../../../views/' . $name . '.php';

		include( $file );
	}

}