/* -----------------------------------------------------------------------------



File:           JS Core
Version:        1.0
Last change:    00/00/00
-------------------------------------------------------------------------------- */
(function ($) {

    "use strict";

    var ModaAjax2 = {
        init: function () {
            this.Basic.init();
        },

        Basic: {
            init: function () {
                this.ModaloadMore2();
            },
            // Load more js
            ModaloadMore2: function () {
                $('#loadMore2').click(function (event) {
                    event.preventDefault();
                    var button = $(this),
                        data = {
                            'action': 'moda_load_more2',
                            'query': moda_load_more2.posts2,
                            'page': moda_load_more2.current_page2
                        };

                    $.ajax({
                        url: moda_load_more2.ajaxurl2, // AJAX handler
                        data: data,
                        type: 'POST',
                        beforeSend: function (xhr) {
                            button.text('Loading...'); // change the button text, you can also add a preloader image
                        },
                        success: function (data) {
                            if (data) {
                                button.text('Load More').prev().before(data); // insert new posts

                                moda_load_more2.current_page2++;
                                $("#loadmoreproducts").append(data);
                                if (moda_load_more2.current_page2 == moda_load_more2.max_page2)
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
        ModaAjax2.init();
    });
    console.log('ajax 2 js loaded');
})(jQuery);