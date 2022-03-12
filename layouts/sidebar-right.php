<?php
$checkout = class_exists('WooCommerce') ? is_checkout() || is_cart() || is_product() : '';
if (!empty(moda_theme_options('sidebar'))) {
    do_action('moda_sidebar');
} else {
    if (is_active_sidebar('sidebar-1') && !$checkout) {
        echo '<div class="moda-wedgets-area">';
        dynamic_sidebar('sidebar-1');
        echo '</div>';
    }
}