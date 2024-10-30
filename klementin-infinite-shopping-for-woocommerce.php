<?php
/**
 * Plugin Name: Klementin Infinite Shopping For Woocommerce
 * Description: Give your customers the experience they expect once they click "Continue shopping" on your Woocommerce store.
 * Version: 1.3
 * Author: Klementin
 * Author URI: https://klementin.dk
 */

//No direct calls allowed
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

define( 'KLEMENTIN_INFINITE_SHOPPING_FOR_WOOCOMMERCE_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
require_once( KLEMENTIN_INFINITE_SHOPPING_FOR_WOOCOMMERCE_PLUGIN_DIR . 'vendor/autoload.php' );

( new Klementin_wp_plugin_dependency() )->check_if_dependency_plugin_is_active( plugin_basename( __FILE__ ), 'woocommerce/woocommerce.php', "To use Klementin Infinite Shopping For Woocommerce you need to have the Woocommerce plugin installed and activated.", 'klementin-infinite-shopping-for-woocommerce' );

require_once( KLEMENTIN_INFINITE_SHOPPING_FOR_WOOCOMMERCE_PLUGIN_DIR . 'class-klementin-infinite-shopping-for-woocommerce.php' );

Klementin_infinite_shopping_for_woocommerce::init();