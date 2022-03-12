<?php
if (!empty(moda_theme_options('footer_widget'))) {
    do_action('moda_footer_widget');
} else {
    if (is_active_sidebar('footer-widget')) {
        echo '<div class="row">';
        dynamic_sidebar('footer-widget');
        echo '</div>';
    }
}