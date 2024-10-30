<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Klementin_wp_nonce {


	private $nonce_key;

	public function __construct( $nonce_key = null ) {
		$this->nonce_key = $nonce_key;
	}

	public function prepare_for_ajax_nonce() {

		$this->nonce_key = $this->nonce_key ?? rand( 1, 100000 ) . 'klementin_wp';

		add_action( 'in_admin_header', array( $this, 'nonce_ajax_field' ) );
		add_action( 'wp_footer', array( $this, 'nonce_ajax_field' ) );

		if ( isset( $_REQUEST['action'] ) && isset( $_REQUEST['klementin_wp_auto_nonce_key'] ) ) {
			$this->nonce_key = $_REQUEST['klementin_wp_auto_nonce_key'];
			add_action( 'init', array( $this, 'verify_or_fail_nonce' ) );
		}
	}

	public function nonce_ajax_field() {
		echo '<input type="hidden" id="klementin-wp-nonce-key" value="' . esc_attr($this->nonce_key) . '" />';
		$this->nonce_field();
	}

	public function nonce_field() {
		return wp_nonce_field( $this->nonce_key, $this->nonce_key );
	}

	public function verify_or_fail_nonce() {

		// Verify that the nonce is valid.
		if ( ! isset( $_REQUEST[ $this->nonce_key ] ) || ! wp_verify_nonce( $_REQUEST[ $this->nonce_key ], $this->nonce_key ) ) {
			throw new \Exception( 'Invalid Klementin Wp Nonce' );
		}
	}

}