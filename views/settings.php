<?php if ( ! defined( 'ABSPATH' ) ) {
	exit;
}; ?>
<div class="kl-wp-container kl-wp-mx-auto">
    <h1 class="kl-wp-text-2xl"><?php esc_html_e( "Exclude URL's from the infinite shopping redirect", 'klementin-infinite-shopping-for-woocommerce' ); ?></h1>
    <small class="kl-wp-mb-4"><?php esc_html_e( "Here you can input URL's that the system should not 'remember' meaning no redirect will be made to those pages after the customer clicking 'Continue shopping'", 'klementin-infinite-shopping-for-woocommerce' ); ?></small><bR>
    <small class="kl-wp-mb-4"><?php esc_html_e( 'URL excludes is performed on a matching basis, so be specific with your exclusions.', 'klementin-infinite-shopping-for-woocommerce' ); ?></small><br>
    <small class="kl-wp-mb-4"><?php esc_html_e( 'Example: writing "shop" will exclude everything with the word "shop" in the URL.', 'klementin-infinite-shopping-for-woocommerce' ); ?></small><br>
    <small class="kl-wp-mb-4"><?php esc_html_e( 'Example: writing "shop/product-1" will exclude everything with the text "shop/product-1" in the URL.', 'klementin-infinite-shopping-for-woocommerce' ); ?></small>
	<?php ( new Klementin_wp_nonce( 'klementin_infinite_shopping_for_woocommerce_exclude' ) )->nonce_field(); ?>
    <div class="klementin-infinite-shopping-for-woocommerce-exclude-table">
		<?php echo Klementin_Wp_view::render( 'exclude-table', compact( 'excludes' ) ); ?>
    </div>
</div>