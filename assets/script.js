jQuery(document).ready(function ($) {

    function klementin_wp_infinite_shopping_save(add_empty_field = 1) {
        http_post('klementin-infinite-shopping-for-woocommerce-save-exclude', {
            add_empty_field, excludes:
                $(".klementin-infinite-shopping-for-woocommerce-exclude").get().map(i => $(i).val())
        }).done((res) => {
            $('.klementin-infinite-shopping-for-woocommerce-exclude-table').html(res);
        })
    }

    $(document).on('click', '.klementin-infinite-shopping-for-woocommerce-add-exclude', function () {
        klementin_wp_infinite_shopping_save();
    });

    $(document).on('click', '.klementin-infinite-shopping-for-woocommerce-remove-exclude', function () {
        $(this).closest('.klementin-infinite-shopping-for-woocommerce-exclude-grid').remove();
        klementin_wp_infinite_shopping_save();
    });

    $(document).on('keyup', ".klementin-infinite-shopping-for-woocommerce-exclude", klementin_wp_debounce(function () {
        klementin_wp_infinite_shopping_save(0);
    }, 500));

});