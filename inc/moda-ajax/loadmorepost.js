/* -----------------------------------------------------------------------------



File:           JS Core
Version:        1.0
Last change:    00/00/00
-------------------------------------------------------------------------------- */
(function ($) {

    "use strict";

    var ModaAjax = {
        init: function () {
            this.Basic.init();
        },

        Basic: {
            init: function () {
                this.ModaloadMore();
            },
            // Load more js
            ModaloadMore: function () {
                $('#loadMore').click(function (event) {
                    event.preventDefault();
                    var button = $(this),
                        data = {
                            'action': 'moda_load_more',
                            'query': moda_load_more.posts,
                            'page': moda_load_more.current_page
                        };

                    $.ajax({
                        url: moda_load_more.ajaxurl, // AJAX handler
                        data: data,
                        type: 'POST',
                        beforeSend: function (xhr) {
                            button.text('Loading...'); // change the button text, you can also add a preloader image
                        },
                        success: function (data) {
                            if (data) {
                                button.text('Load More').prev().before(data); // insert new posts

                                moda_load_more.current_page++;
                                $("#loadmoreproducts").append(data);
                                if (moda_load_more.current_page == moda_load_more.max_page)
                                    button.remove(); // if last page, remove the button

                                // you can also fire the "post-load" event here if you use a plugin that requires it
                                // $( document.body ).trigger( 'post-load' );
                            } else {
                                button.remove(); // if no data, remove the button as well
                            }
                        }
                    });
                });
            },

        }
    };
    jQuery(document).ready(function () {
        ModaAjax.init();
    });
    console.log('ajax js loaded');
})(jQuery);