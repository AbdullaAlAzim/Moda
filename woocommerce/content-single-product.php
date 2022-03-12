<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>
    <section class="moda-product-details-section moda-section">
        <div class="container">
            <div class="row">

                <div class="col-lg-5 wow fadeInUp">
                    <div class="moda-product-thumb">
                        <?php
                        /**
                         * Hook: woocommerce_before_single_product_summary.
                         *
                         * @hooked woocommerce_show_product_sale_flash - 10
                         * @hooked woocommerce_show_product_images - 20
                         */
                        do_action('woocommerce_before_single_product_summary');
                        ?>
                    </div>
                </div>
                <div class="col-lg-7 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="moda-details-content">
                        <div class="pricing-area">
                            <h2><?php the_title(); ?></h2>
                            <h4><?php woocommerce_template_single_price(); ?></h4>
                            <div class="detaisl">
                                <div class="row">
                                    <div class="col-3">
                                        <p><span>SKU :</span> <?php echo wp_kses_post($product->get_sku()); ?> </p>
                                        <p><span>Category :</span> <?php echo moda_product_category(); ?></p>
                                    </div>
                                    <div class="col-9">
                                        <p>
                                            <span>Availability :</span> <?php echo wp_kses_post($product->get_stock_status()); ?>
                                        </p>
                                        <p><span>Tags : </span> <?php echo moda_product_tags(); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-content">
                            <p><?php echo wp_kses_post($product->get_short_description()); ?></p>
                            <?php if (
                                $product->get_type() == 'variable' ||
                                $product->get_type() == 'grouped'

                            ) { ?>
                                <?php woocommerce_template_single_add_to_cart(); ?>
                            <?php } ?>
                        </div>
                        <div class="product-cart-area">
                            <?php if (
                                $product->get_type() == 'simple' ||
                                $product->get_type() == 'external'
                            ) { ?>
                                <div class="left">
                                    <?php woocommerce_template_single_add_to_cart(); ?>
                                </div>
                            <?php } ?>
                            <div class="right-side">
                                <ul>
                                    <li>
                                        <?php moda_wishlist_button(); ?>
                                    </li>
                                    <li>
                                        <?php moda_compare_icon_only_product_card(); ?>
                                    </li>
                                    <li><a href="javascript:void(0)"><i class="fas fa-share"></i></a>
                                        <ul class="product-social-share">
                                            <li>
                                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><i
                                                            class="fab fa-facebook-f"></i></a></li>
                                            <li>
                                                <a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php echo the_title(); ?>&via=<?php the_author_meta('twitter'); ?>"><i
                                                            class="fab fa-twitter"></i></a></li>
                                            <li>
                                                <a href="mailto:type%20email%20address%20here?subject=I%20wanted%20to%20share%20this%20post%20with%20you%20from%20<?php bloginfo('name'); ?>&body=<?php the_title(); ?> - <?php the_permalink(); ?>"
                                                   title="Email to a friend/colleague"><i
                                                            class="far fa-envelope"></i></a></li>
                                            <li>
                                                <a href="https://api.whatsapp.com/send?text=<?php the_title(); ?>: <?php the_permalink(); ?>"><i
                                                            class="fab fa-whatsapp"></i></a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="moda-product-description moda-section wow fadeInUp">
        <div class="container">
            <div class="moda-description">
                <?php
                /**
                 * Hook: woocommerce_single_product_summary.
                 *
                 * @hooked woocommerce_template_single_title - 5
                 * @hooked woocommerce_template_single_rating - 10
                 * @hooked woocommerce_template_single_price - 10
                 * @hooked woocommerce_template_single_excerpt - 20
                 * @hooked woocommerce_template_single_add_to_cart - 30
                 * @hooked woocommerce_template_single_meta - 40
                 * @hooked woocommerce_template_single_sharing - 50
                 * @hooked WC_Structured_Data::generate_product_data() - 60
                 */
                do_action('woocommerce_single_product_summary');
                ?>

                <?php
                /**
                 * Hook: woocommerce_after_single_product_summary.
                 *
                 * @hooked woocommerce_output_product_data_tabs - 10
                 * @hooked woocommerce_upsell_display - 15
                 * @hooked woocommerce_output_related_products - 20
                 */
                do_action('woocommerce_after_single_product_summary');
                ?>
            </div>
        </div>
    </section>
    <section class="related-products-section moda-section wow fadeInUp" data-wow-delay="0.3s">
        <div class="container countdown-slide-arrow">
            <h2><?php esc_attr_e('Related Products', 'moda'); ?></h2>
            <div class="moda-related-product-wraper swiper-container ">
                <div class="swiper-wrapper">
                    <?php $args = array(
                        'post_type' => 'product',
                        'posts_per_page' => 6,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'product_visibility',
                                'field' => 'name',
                                'terms' => 'outofstock',
                                'operator' => 'NOT IN',
                            ),
                        ),
                    );
                    $loop = new WP_Query($args);
                    if ($loop->have_posts()) {
                        while ($loop->have_posts()) : $loop->the_post();
                            ?>
                            <div class="swiper-slide">
                                <div class="moda-product-card-items">
                                    <div class="product-card">
                                        <div class="product-images">
                                            <a href="<?php the_permalink(); ?>" class="moda-hover-thumb-woo">
                                                <?php
                                                /**
                                                 *
                                                 * @hooked moda_woo_thumbnail - 11
                                                 */
                                                do_action('moda_woocommerce_shop_loop_images');
                                                ?>

                                            </a>
                                            <div class="product-action">
                                                <?php woocommerce_template_loop_add_to_cart(); ?>
                                                <?php moda_wishlist_button(); ?>
                                                <?php moda_compare_icon_only_product_card(); ?>
                                            </div>
                                        </div>
                                        <div class="product-title">
                                            <span class="categories"><?php echo moda_product_category(); ?></span>
                                            <?php echo moda_wc_get_review(true, ''); ?>
                                            <a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a>
                                            <h4><?php woocommerce_template_loop_price(); ?></h4>
                                        </div>
                                        <?php
                                        /**
                                         * Hook: woocommerce_before_shop_loop_item.
                                         *
                                         * @hooked woocommerce_template_loop_product_link_open - 10
                                         */
                                        do_action('woocommerce_before_shop_loop_item');

                                        /**
                                         * Hook: woocommerce_before_shop_loop_item_title.
                                         *
                                         * @hooked woocommerce_show_product_loop_sale_flash - 10
                                         * @hooked woocommerce_template_loop_product_thumbnail - 10
                                         */
                                        do_action('woocommerce_before_shop_loop_item_title');

                                        /**
                                         * Hook: woocommerce_shop_loop_item_title.
                                         *
                                         * @hooked woocommerce_template_loop_product_title - 10
                                         */
                                        do_action('woocommerce_shop_loop_item_title');

                                        /**
                                         * Hook: woocommerce_after_shop_loop_item_title.
                                         *
                                         * @hooked woocommerce_template_loop_rating - 5
                                         * @hooked woocommerce_template_loop_price - 10
                                         */
                                        do_action('woocommerce_after_shop_loop_item_title');

                                        /**
                                         * Hook: woocommerce_after_shop_loop_item.
                                         *
                                         * @hooked woocommerce_template_loop_product_link_close - 5
                                         * @hooked woocommerce_template_loop_add_to_cart - 10
                                         */
                                        do_action('woocommerce_after_shop_loop_item');
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endwhile;
                    } else {
                        esc_html_e('No products found', 'moda');
                    }
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>

</div>

<?php do_action('woocommerce_after_single_product'); ?>
