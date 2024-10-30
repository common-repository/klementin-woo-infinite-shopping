<?php if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>
<?php foreach ( $excludes as $exclude ): ?>
    <div class="kl-wp-grid kl-wp-grid-cols-6 kl-wp-gap-2 kl-wp-mt-4 klementin-infinite-shopping-for-woocommerce-exclude-grid">
        <div class="kl-wp-col-span-5">
            <input type="text" name="exclude[]" value="<?php echo esc_attr($exclude); ?>"
                   class="klementin-infinite-shopping-for-woocommerce-exclude kl-wp-w-full"/>
        </div>
        <div class="kl-wp-col-span-1 kl-wp-flex kl-wp-items-center">
            <button class="button klementin-infinite-shopping-for-woocommerce-remove-exclude kl-wp-flex kl-wp-items-center kl-wp-ml-auto">
                <span class="dashicons dashicons-trash"></span></button>
            <button class="button klementin-infinite-shopping-for-woocommerce-add-exclude kl-wp-ml-2">+</button>
        </div>
    </div>
<?php endforeach; ?>