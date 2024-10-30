<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Klementin_wp_ajax {

	public function add_ajax_action( $key, $func, $env = 'priv' ) {

		if ( $env != 'nopriv' ) {
			add_action( 'wp_ajax_' . $key, $func );
		}

		if ( in_array( $env, [ 'both', 'nopriv' ] ) ) {
			add_action( 'wp_ajax_nopriv_' . $key, $func );
		}

		return $this;
	}

	public function add_ajaxurl() {
		add_action( 'wp_head', function () {
			echo '<script type="text/javascript">
           var ajaxurl = "' . esc_url( admin_url( 'admin-ajax.php' ) ) . '";
         </script>';
		} );

		return $this;
	}


}