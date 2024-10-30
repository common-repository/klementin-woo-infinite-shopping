<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Klementin_wp {

	public static function init() {

		add_action( 'admin_enqueue_scripts', array( self::class, 'assets' ) );
		add_action( 'wp_enqueue_scripts', array( self::class, 'assets' ) );

	}

	/**
	 * Register the Klementin wp assests
	 */
	public static function assets() {
		wp_register_style( 'klementin-wp.css', plugin_dir_url( __FILE__ ) . 'assets/css/klementin-wp.css', array() );
		wp_enqueue_style( 'klementin-wp.css' );

		wp_register_script( 'klementin-wp.js', plugin_dir_url( __FILE__ ) . 'assets/js/script.js', array(), false, true );
		wp_enqueue_script( 'klementin-wp.js' );
	}

}