function http_get(params, with_nonce = true) {
    var url = new URL(ajaxurl);

    params.forEach(function (el) {
        url.searchParams.append(el.key, el.value);
    })

    return jQuery.get(url);
}

function http_post(action, params, with_nonce = true) {

    if (with_nonce) {
        var nonce_key = jQuery("#klementin-wp-nonce-key").val();
        var nonce_value = jQuery('input[name="' + nonce_key + '"]').val();
        var nonce_obj = {};
        nonce_obj[nonce_key] = nonce_value;
        nonce_obj['klementin_wp_auto_nonce_key'] = nonce_key;
    }

    return jQuery.post(ajaxurl, {action, ...params, ...nonce_obj});

}


/**
 * Execute a function given a delay time
 *
 * @param {type} func
 * @param {type} wait
 * @param {type} immediate
 * @returns {Function}
 */
function klementin_wp_debounce(func, wait, immediate) {
    var timeout;
    return function () {
        var context = this, args = arguments;
        var later = function () {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };
        var callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
};