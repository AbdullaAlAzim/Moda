<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
    return;
}
$column = wc_get_loop_prop('columns');
?>

<div class="moda-product-card-items product-list-card wow fadeInUp">
    <div class="product-card">
        <div class="product-images">
            <?php moda_wc_thumbnail(); ?>
        </div>
        <div class="product-title">
            <span class="categories"><?php echo moda_product_category(); ?></span>
            <?php echo moda_get_product_review(); ?>
            <a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a>
            <h4><?php woocommerce_template_loop_price(); ?></h4>
            <div class="moda-product-content">
                <p><?php echo wp_trim_words(get_the_content(), 20, '...'); ?></p>
                <div class="product-action">
                    <?php
                    woocommerce_template_loop_add_to_cart();
                    moda_wishlist_button();
                    moda_compare_icon_only_product_card();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
