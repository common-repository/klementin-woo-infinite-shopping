<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Klementin_infinite_shopping_for_woocommerce {


	private static $exclude_routes = array(
		'product',
		'vare',
		'?wc-ajax'
	);

	/**
	 * Init plugin configuration
	 * exposes the filter klementin_infinite_shopping_for_woocommerce_redirect
	 */
	public static function init() {

		add_action( 'wp', array( self::class, 'record_refer_address' ) );
		add_action( 'wp_footer', array( self::class, 'get_refer_cookie' ) );
		add_filter( 'woocommerce_continue_shopping_redirect', array( self::class, 'do_continue_shopping_link' ) );
		add_filter( 'klementin_infinite_shopping_for_woocommerce_redirect', array(
			self::class,
			'do_continue_shopping_link'
		) );
		add_action( 'admin_enqueue_scripts', function () {
			wp_register_script( 'klementin-infinite-shopping-for-woocommerce.js', plugin_dir_url( __FILE__ ) . 'assets/script.js', array(), false, true );
			wp_enqueue_script( 'klementin-infinite-shopping-for-woocommerce.js' );
		} );

		( new Klementin_wp_ajax() )
			->add_ajaxurl()->add_ajax_action( 'klementin-infinite-shopping-for-woocommerce-save-exclude', array(
				self::class,
				'save_exclude'
			) );


		( new Klementin_wp_menu_point() )->setup( array(
			'page_title' => 'Infinite shopping',
			'menu_title' => 'Infinite shopping',
			'capability' => 'install_plugins',
			'menu_slug'  => 'klementin-infinite-shopping-for-woocommerce',
			'function'   => function () {
				self::get_exclude_table( 'settings' );
			},
			'icon_url'   => 'dashicons-randomize',
		) )->add();

		( new Klementin_wp_nonce() )->prepare_for_ajax_nonce();
	}

	/**
	 * Gets the view for a exclude table row or for the whole settings page.
	 *
	 * @param string $view - The view to return.
	 * @param bool $add_empty_field - If we should add a empty field as the last in the array.
	 */
	public static function get_exclude_table( $view = 'exclude-table', $add_empty_field = true ) {
		$excludes = get_option( 'klementin-infinite-shopping-for-woocommerce', array() );
		$excludes = is_array( $excludes ) ? $excludes : array();

		if ( $add_empty_field ) {
			$excludes = array_merge( $excludes, array( '' ) );
		}

		return Klementin_Wp_view::render( $view, compact( 'excludes' ) );
	}

	/**
	 * Saves the exclusions made by the user.
	 */
	public static function save_exclude() {
		if ( ! current_user_can( 'install_plugins' ) ) {
			return false;
		}

		$option = get_option( 'klementin-infinite-shopping-for-woocommerce', array() );
		$data   = array_filter( array_map( function ( $item ) {
			return sanitize_text_field( $item );
		}, $_REQUEST['excludes'] ) );
		update_option( 'klementin-infinite-shopping-for-woocommerce', $data );

		echo self::get_exclude_table( 'exclude-table', sanitize_text_field( $_REQUEST['add_empty_field'] ) );

		die;
	}

	private static function get_exclude_routes() {
		$woocommerce_specific = array( wc_get_cart_url(), wc_get_checkout_url() );

		$product = wc_get_product();

		if ( ! empty( $product ) ) {
			$woocommerce_specific[] = $product->get_permalink();
		}

		return array_merge( self::$exclude_routes, get_option( 'klementin-infinite-shopping-for-woocommerce' ), $woocommerce_specific );
	}

	public static function do_continue_shopping_link() {

		if ( self::has_refer_cookie() ) {
			return self::get_refer_cookie();
		} else {
			return '/';
		}

	}

	public static function has_refer_cookie() {
		return ! empty( $_COOKIE['klementin_infinite_shopping_for_woocommerce_refer'] );
	}

	public static function get_refer_cookie() {
		return esc_url( $_COOKIE['klementin_infinite_shopping_for_woocommerce_refer'] );
	}

	/**
	 * Checks if we can set the refer.
	 * This is done by firstly checking if we actually have a refer and then if it is exclued.
	 * And finally making sure the user is not admin
	 * @return bool
	 */
	public static function can_set_refer() {

		if ( empty( $_SERVER['HTTP_REFERER'] ) ) {
			return false;
		}

		$is_excluded_route = false;

		foreach ( self::get_exclude_routes() as $exclude_route ) {
			$is_excluded_route = strpos( $_SERVER['HTTP_REFERER'], $exclude_route ) !== false;

			if ( $is_excluded_route ) {
				break;
			}
		}

		return ! is_admin() && ! $is_excluded_route && ! is_cart() && ! is_checkout() && ! is_product();
	}

	public static function record_refer_address() {
		if ( self::can_set_refer() ) {
			setcookie( 'klementin_infinite_shopping_for_woocommerce_refer', esc_url( $_SERVER['HTTP_REFERER'] ), time() + 86000, "/", '', false, true );
		}
	}


}