<?php

use Elementor\Plugin;

function moda_product_pagination()
{

    if (is_singular())
        return;

    global $wp_query;

    /** Stop execution if there's only 1 page */
    if ($wp_query->max_num_pages <= 1)
        return;

    $paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
    $max = intval($wp_query->max_num_pages);

    /** Add current page to the array */
    if ($paged >= 1)
        $links[] = $paged;

    /** Add the pages around the current page to the array */
    if ($paged >= 3) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if (($paged + 2) <= $max) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    echo '<nav class="product-pagination">
                            <ul class="pagination-area">' . "\n";

    /** Previous Post Link */
    if (get_previous_posts_link())
        printf('<li>%s</li>' . "\n", get_previous_posts_link('<i class="fas fa-angle-left"></i>'));

    /** Link to first page, plus ellipses if necessary */
    if (!in_array(1, $links)) {
        $class = 1 == $paged ? ' class="active"' : '';

        printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link(1)), '1');

        if (!in_array(2, $links))
            echo '<li>…</li>';
    }

    /** Link to current page, plus 2 pages in either direction if necessary */
    sort($links);
    foreach ((array)$links as $link) {
        $class = $paged == $link ? ' class="current"' : '';
        printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($link)), $link);
    }

    /** Link to last page, plus ellipses if necessary */
    if (!in_array($max, $links)) {
        if (!in_array($max - 1, $links))
            echo '<li>…</li>' . "\n";

        $class = $paged == $max ? ' class="current"' : '';
        printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($max)), $max);
    }

    /** Next Post Link */
    if (get_next_posts_link())
        printf('<li>%s</li>' . "\n", get_next_posts_link('<i class="fas fa-angle-right"></i>'));

    echo '</ul></nav>' . "\n";

}

/**
 * Sale price
 */
function moda_sale_price()
{
    if (class_exists('WooCommerce')) {
        $currency = get_woocommerce_currency_symbol();
        $price = get_post_meta(get_the_ID(), '_sale_price', true);
        return $currency . $price;
    }
}

/**
 * Regular price
 */
function moda_reg_price()
{
    if (class_exists('WooCommerce')) {
        $currency = get_woocommerce_currency_symbol();
        $price = get_post_meta(get_the_ID(), '_regular_price', true);
        return $currency . $price;
    }
}

function moda_is_elementor_editor()
{

    if (did_action('admin_action_elementor')) {
        return Plugin::$instance->editor->is_edit_mode();
    }
    return is_admin() && isset($_REQUEST['action']) && in_array(sanitize_text_field(wp_unslash($_REQUEST['action'])), array('elementor', 'elementor_ajax'), true);
}

function moda_discount_badge()
{
    global $product;
    if (!$product->is_on_sale()) return false;
    if ($product->is_type('simple')) {
        $max_percentage = (($product->get_regular_price() - $product->get_sale_price()) / $product->get_regular_price()) * 100;
    } elseif ($product->is_type('variable')) {
        $max_percentage = 0;
        foreach ($product->get_children() as $child_id) {
            $variation = wc_get_product($child_id);
            $price = $variation->get_regular_price();
            $sale = $variation->get_sale_price();
            if ($price != 0 && !empty($sale)) $percentage = ($price - $sale) / $price * 100;
            if ($percentage > $max_percentage) {
                $max_percentage = $percentage;
            }
        }
    }
    if ($max_percentage > 0) return "<span class='onsale'>Save: " . round($max_percentage) . "%</span>";
}

function moda_wc_get_thumbnail()
{
    if (class_exists('WooCommerce')) {
        return woocommerce_get_product_thumbnail('woocommerce_full_size');
    }
}

function moda_wc_thumbnail($class = '')
{
    ?>
    <a href="<?php the_permalink(); ?>" class="moda-hover-thumb-woo <?php esc_attr($class); ?>">
        <?php
        /**
         *
         * @hooked moda_woo_thumbnail - 11
         */
        do_action('moda_woocommerce_shop_loop_images');
        ?>

    </a>
<?php }

//==============================================================================
// Xoopic Woo Normal Thumbnail
//==============================================================================
if (!function_exists('moda_woo_thumbnail')) :
    /**
     * Displays an optional post thumbnail.
     *
     * Wraps the post thumbnail in an anchor element on index views, or a div
     * element when on single views.
     */
    function moda_woo_thumbnail()
    {

        if (has_post_thumbnail()) {

            the_post_thumbnail('full', true);


        }

    }
endif;
//==============================================================================
// Xoopic Hover Thumbnail
//==============================================================================
if (!function_exists('moda_woocommerce_get_alt_product_thumbnail')) {
    /**
     * Get Hover image for WooCommerce Grid
     */
    function moda_woocommerce_get_alt_product_thumbnail()
    {


        global $product;
        $attachment_ids = $product->get_gallery_image_ids();
        $class = 'show-on-hover hide-for-small moda-back-image';

        if ($attachment_ids) {
            $loop = 0;
            foreach ($attachment_ids as $attachment_id) {
                $image_link = wp_get_attachment_url($attachment_id);
                if (!$image_link) {
                    continue;
                }
                $loop++;
                echo apply_filters('moda_woocommerce_get_alt_product_thumbnail',
                    wp_get_attachment_image($attachment_id, 'full', false, array('class' => $class)));
                if ($loop == 1) {
                    break;
                }
            }
        }
    }
}
add_action('moda_woocommerce_shop_loop_images', 'moda_woocommerce_get_alt_product_thumbnail', 11);
add_action('moda_woocommerce_shop_loop_images', 'moda_woo_thumbnail', 11);

function moda_dynamic_thumbnail()
{
    global $product;
    $attachment_ids = $product->get_gallery_image_ids();
    if ($attachment_ids) {
        ob_start();
        ?>
        <div class="swiper-container product-slide">
            <div class="swiper-wrapper">
                <?php foreach ($attachment_ids

                as $attachment_id) { ?>
                <a class="swiper-slide images img-radius" href="<?php the_permalink(); ?>">
                    <?php echo wp_get_attachment_image($attachment_id, 'full'); ?>
                    <?php } ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
        <?php
        $gallery_images = ob_get_contents();
        ob_end_clean();
        ob_flush();
    }
    if ($attachment_ids) {
        return $gallery_images;
    } else {
        return '<a href=' . get_the_permalink() . '>' . moda_wc_get_thumbnail() . '</a>';
    }
}

function moda_dynamic_single_thumbnail()
{
    global $product;
    $attachment_ids = $product->get_gallery_image_ids();
    if ($attachment_ids) {
        ob_start();
        ?>
        <div class="swiper-container mySwiper2">
            <div class="swiper-wrapper">
                <?php foreach ($attachment_ids as $attachment_id) { ?>
                    <div class="swiper-slide">
                        <?php echo wp_get_attachment_image($attachment_id, 'full'); ?>
                    </div>
                <?php } ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
        <div class="swiper-container mySwiper">
            <div class="swiper-wrapper">
                <?php foreach ($attachment_ids as $attachment_id) { ?>
                    <div class="swiper-slide">
                        <?php echo wp_get_attachment_image($attachment_id, 'full'); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php
        $gallery_images = ob_get_contents();
        ob_end_clean();
        ob_flush();
    }
    if ($attachment_ids) {
        return $gallery_images;
    } else {
        return moda_wc_get_thumbnail();
    }
}

function moda_post_category()
{
    global $post;
    $product_cat = get_the_terms($post->ID, 'category');
    $output = [];
    if ($product_cat) {
        foreach ($product_cat as $cat) {
            $output[] = $cat->name;
        }
    }
    return implode(', ', $output);
}

function moda_product_category()
{
    global $post;
    $product_cat = get_the_terms($post->ID, 'product_cat');
    $output = [];
    if ($product_cat) {
        foreach ($product_cat as $cat) {
            $output[] = $cat->name;
        }
    }
    return implode(', ', $output);
}

function moda_product_tags()
{
    global $post;
    $product_cat = get_the_terms($post->ID, 'product_tag');
    $output = [];
    if ($product_cat) {
        foreach ($product_cat as $cat) {
            $output[] = $cat->name;
        }
    }
    return implode(', ', $output);
}

function moda_get_product_review()
{
    global $product;
    $output = '';
    //$output .= '<ul>';
    $output .= wc_get_rating_html($product->get_average_rating());
    //$output .= '</ul>';
    return $output;

}

function moda_wc_get_review($anchor = false, $class = 'review')
{
    global $product;
    $count = $product->get_average_rating();
    if ($count) {
        ob_start();
        for ($i = 0; $i < $count; $i++) { ?>
            <li>
                <?php if ($anchor == true) { ?>
                <a href="#">
                    <?php } ?>
                    <i class="fas fa-star"></i>
                    <?php if ($anchor == true) { ?>
                </a>
            <?php } ?>
            </li>
        <?php }
        $rating = ob_get_contents();
        ob_end_clean();
        ob_flush();
    }
    if ($product->get_review_count()) {
        return '<ul class="' . $class . '">' . $rating . '</ul>';
    } else
        return '';
}

function moda_wc_get_wishlist_link()
{
    if (class_exists('YITH_WCWL')) {
        $link = YITH_WCWL()->get_wishlist_url();
    } else {
        $link = '#';
    }
    return $link;
}

if (defined('YITH_WCWL') && !function_exists('yith_wcwl_get_items_count')) {
    function yith_wcwl_get_items_count()
    {
        ob_start();
        ?>
        <a href="<?php echo esc_url(YITH_WCWL()->get_wishlist_url()); ?>">
            <i class="fal fa-heart"></i>
            <span class="yith-wcwl-items-count">
              <?php echo esc_html(yith_wcwl_count_all_products()); ?>
            </span>
        </a>
        <?php
        return ob_get_clean();
    }

}

if (defined('YITH_WCWL') && !function_exists('yith_wcwl_ajax_update_count')) {
    function yith_wcwl_ajax_update_count()
    {
        wp_send_json(array(
            'count' => yith_wcwl_count_all_products()
        ));
    }

    add_action('wp_ajax_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count');
    add_action('wp_ajax_nopriv_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count');
}
function moda_wc_wishlist_count()
{
    if (class_exists('YITH_WCWL')) {
        do_shortcode('[yith_wcwl_items_count]');
    } else {
        return '<a href="#">
            <i class="fal fa-heart"></i>
            <span class="yith-wcwl-items-count">
              0            </span>
        </a>';
    }
}

function moda_wishlist_button()
{
    if (class_exists('YITH_WCWL')) :
        global $product;
        ?>

        <a href="<?php echo YITH_WCWL()->is_product_in_wishlist($product->get_id()) ? esc_url(YITH_WCWL()->get_wishlist_url()) : esc_url(add_query_arg('add_to_wishlist', $product->get_id())); ?>"
           data-product-id="<?php echo esc_attr($product->get_id()); ?>"
           data-product-type="<?php echo esc_attr($product->get_type()); ?>"
           data-wishlist-url="<?php echo esc_url(YITH_WCWL()->get_wishlist_url()); ?>"
           data-browse-wishlist-text="<?php echo esc_attr(get_option('yith_wcwl_browse_wishlist_text')); ?>"
           class="button moda_product_wishlist_button <?php echo YITH_WCWL()->is_product_in_wishlist($product->get_id()) ? 'clicked added' : 'add_to_wishlist'; ?>"
           rel="nofollow" data-toggle="tooltip">
            <span class="icon"><i class="fal fa-heart"></i></span>
        </a>

    <?php
    endif;
}

function moda_wishlist_grid_button()
{
    if (class_exists('YITH_WCWL')) :
        global $product;
        ?>

        <a href="<?php echo YITH_WCWL()->is_product_in_wishlist($product->get_id()) ? esc_url(YITH_WCWL()->get_wishlist_url()) : esc_url(add_query_arg('add_to_wishlist', $product->get_id())); ?>"
           data-product-id="<?php echo esc_attr($product->get_id()); ?>"
           data-product-type="<?php echo esc_attr($product->get_type()); ?>"
           data-wishlist-url="<?php echo esc_url(YITH_WCWL()->get_wishlist_url()); ?>"
           data-browse-wishlist-text="<?php echo esc_attr(get_option('yith_wcwl_browse_wishlist_text')); ?>"
           class="button moda_product_wishlist_button <?php echo YITH_WCWL()->is_product_in_wishlist($product->get_id()) ? 'clicked added' : 'add_to_wishlist'; ?>"
           rel="nofollow" data-toggle="tooltip">
            <span class="action-text">
                <?php echo YITH_WCWL()->is_product_in_wishlist($product->get_id()) ?
                    esc_attr(get_option('yith_wcwl_browse_wishlist_text')) :
                    esc_attr('wishlist');
                ?>
                </span>
            <span class="icon"><i class="fal fa-heart"></i></span>
        </a>

    <?php
    endif;
}

//==============================================================================
// Add Compare Icon in Product Card
//==============================================================================

function moda_compare_icon_in_product_card()
{
    if (class_exists('WPCleverWoosc')) {
        global $product;
        $productId = $product->get_id();
        ?>
        <a href="#" class="compare button woosc-btn woosc-btn-<?php echo esc_html($productId); ?>"
           data-id="<?php echo esc_html($productId); ?>" rel="nofollow">
            <span class="action-text"><?php echo esc_html('Compare'); ?></span>
            <span class="icon"><i class="far fa-external-link-alt"></i></span>
        </a>
    <?php }

}

function moda_compare_icon_only_product_card()
{
    if (class_exists('WPCleverWoosc')) {
        global $product;
        $productId = $product->get_id();
        ?>
        <a href="#" class="compare button woosc-btn woosc-btn-<?php echo esc_html($productId); ?>"
           data-id="<?php echo esc_html($productId); ?>" rel="nofollow">
            <span class="icon"><i class="far fa-external-link-alt"></i></span>
        </a>
    <?php }

}

function moda_get_cart_url()
{
    if (class_exists('WooCommerce')) {
        return wc_get_cart_url();
    }
}

function moda_cart_items()
{
    if (!moda_is_elementor_editor() && class_exists('WooCommerce')) {
        echo '<div class="header-mini-cart">';
        woocommerce_mini_cart();
        echo '</div>';
    }
}