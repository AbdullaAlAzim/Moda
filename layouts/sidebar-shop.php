<?php
if (moda_theme_options('sidebar_shop')) {
    do_action('moda_sidebar_shop');
} else {
    if (is_active_sidebar('shop-sidebar')) {
        echo '<div class="moda-sidebar">';
        dynamic_sidebar('shop-sidebar');
        echo '</div>';
    }
}