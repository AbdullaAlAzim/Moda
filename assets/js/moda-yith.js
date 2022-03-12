jQuery(function ($) {
    $(document).on('added_to_wishlist removed_from_wishlist', function () {
        $.get(yith_wcwl_l10n.ajax_url, {
            action: 'yith_wcwl_update_wishlist_count'
        }, function (data) {
            $('.yith-wcwl-items-count').html(data.count);
            //console.log(data);
        });
    });
});