<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

get_header('shop');

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action('woocommerce_before_main_content');

?>
    <section class="moda-product-shop-section moda-section">
        <div class="container">
            <div class="row">
                <header class="woocommerce-products-header">
                    <?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
                        <h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
                    <?php endif; ?>

                    <?php
                    /**
                     * Hook: woocommerce_archive_description.
                     *
                     * @hooked woocommerce_taxonomy_archive_description - 10
                     * @hooked woocommerce_product_archive_description - 10
                     */
                    do_action('woocommerce_archive_description');
                    ?>
                </header>
                <div class="col-lg-3">
                    <?php
                    /**
                     * Hook: woocommerce_sidebar.
                     *
                     * @hooked woocommerce_get_sidebar - 10
                     */
                    do_action('woocommerce_sidebar');
                    ?>
                </div>
                <div class="col-lg-9">
                    <div class="moda-product-shop-area">
                        <?php
                        if (woocommerce_product_loop()) {
                            ?>
                            <div class="moda-product-fillter wow fadeInUp">
                                <?php
                                /**
                                 * Hook: woocommerce_before_shop_loop.
                                 *
                                 * @hooked woocommerce_output_all_notices - 10
                                 * @hooked woocommerce_result_count - 20
                                 * @hooked woocommerce_catalog_ordering - 30
                                 */
                                //do_action( 'woocommerce_before_shop_loop' );
                                ?>
                                <div class="fillter-left-side">
                                    <h5><?php woocommerce_result_count(); ?></h5>
                                </div>
                                <div class="fillter-right-side">
                                    <div class="fillter">
                                        <?php
                                        woocommerce_catalog_ordering();
                                        ?>
                                    </div>
                                    <?php
                                    if (isset($_GET['layout']) && $_GET['layout'] == 2) {
                                        $active = 'active';
                                    } else {
                                        $active = '';
                                    } ?>
                                    <div class="fillter-grid <?php echo esc_attr($active); ?>">
                                        <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>"><?php esc_html_e('View', 'moda'); ?></a>
                                        <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="26"
                                                 viewBox="0 0 24 26">
                                                <defs>
                                                    <clipPath id="clip-path">
                                                        <rect width="24" height="26" fill="none"/>
                                                    </clipPath>
                                                </defs>
                                                <g id="Repeat_Grid_1" data-name="Repeat Grid 1"
                                                   clip-path="url(#clip-path)">
                                                    <g transform="translate(-1676 -611)">
                                                        <rect id="Rectangle_146" data-name="Rectangle 146" width="6"
                                                              height="6" transform="translate(1676 611)"
                                                              fill="#e60c5e"/>
                                                    </g>
                                                    <g transform="translate(-1667 -611)">
                                                        <rect id="Rectangle_146-2" data-name="Rectangle 146" width="6"
                                                              height="6" transform="translate(1676 611)"
                                                              fill="#e60c5e"/>
                                                    </g>
                                                    <g transform="translate(-1658 -611)">
                                                        <rect id="Rectangle_146-3" data-name="Rectangle 146" width="6"
                                                              height="6" transform="translate(1676 611)"
                                                              fill="#e60c5e"/>
                                                    </g>
                                                    <g transform="translate(-1676 -601)">
                                                        <rect id="Rectangle_146-4" data-name="Rectangle 146" width="6"
                                                              height="6" transform="translate(1676 611)"
                                                              fill="#e60c5e"/>
                                                    </g>
                                                    <g transform="translate(-1667 -601)">
                                                        <rect id="Rectangle_146-5" data-name="Rectangle 146" width="6"
                                                              height="6" transform="translate(1676 611)"
                                                              fill="#e60c5e"/>
                                                    </g>
                                                    <g transform="translate(-1658 -601)">
                                                        <rect id="Rectangle_146-6" data-name="Rectangle 146" width="6"
                                                              height="6" transform="translate(1676 611)"
                                                              fill="#e60c5e"/>
                                                    </g>
                                                    <g transform="translate(-1676 -591)">
                                                        <rect id="Rectangle_146-7" data-name="Rectangle 146" width="6"
                                                              height="6" transform="translate(1676 611)"
                                                              fill="#e60c5e"/>
                                                    </g>
                                                    <g transform="translate(-1667 -591)">
                                                        <rect id="Rectangle_146-8" data-name="Rectangle 146" width="6"
                                                              height="6" transform="translate(1676 611)"
                                                              fill="#e60c5e"/>
                                                    </g>
                                                    <g transform="translate(-1658 -591)">
                                                        <rect id="Rectangle_146-9" data-name="Rectangle 146" width="6"
                                                              height="6" transform="translate(1676 611)"
                                                              fill="#e60c5e"/>
                                                    </g>
                                                </g>
                                            </svg>
                                        </a>
                                        <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>?layout=2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                                                 viewBox="0 0 26 26">
                                                <g id="Group_182" data-name="Group 182"
                                                   transform="translate(-1430 -578)">
                                                    <rect id="Rectangle_147" data-name="Rectangle 147" width="26"
                                                          height="4" transform="translate(1430 578)" fill="#9d9d9d"/>
                                                    <rect id="Rectangle_148" data-name="Rectangle 148" width="26"
                                                          height="4" transform="translate(1430 585)" fill="#9d9d9d"/>
                                                    <rect id="Rectangle_149" data-name="Rectangle 149" width="26"
                                                          height="4" transform="translate(1430 593)" fill="#9d9d9d"/>
                                                    <rect id="Rectangle_150" data-name="Rectangle 150" width="26"
                                                          height="4" transform="translate(1430 600)" fill="#9d9d9d"/>
                                                </g>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php
                            woocommerce_product_loop_start();

                            if (wc_get_loop_prop('total')) {
                                while (have_posts()) {
                                    the_post();
                                    /**
                                     * Hook: woocommerce_shop_loop.
                                     */
                                    do_action('woocommerce_shop_loop');
                                    if (isset($_GET['layout']) && $_GET['layout'] == '2') {
                                        wc_get_template_part('content-product', 'layout2');
                                    } else {
                                        wc_get_template_part('content', 'product');
                                    }

                                }
                            }

                            woocommerce_product_loop_end();

                            /**
                             * Hook: woocommerce_after_shop_loop.
                             *
                             * @hooked woocommerce_pagination - 10
                             */
                            do_action('woocommerce_after_shop_loop');
                        } else {
                            /**
                             * Hook: woocommerce_no_products_found.
                             *
                             * @hooked wc_no_products_found - 10
                             */
                            do_action('woocommerce_no_products_found');
                        }

                        /**
                         * Hook: woocommerce_after_main_content.
                         *
                         * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
                         */
                        do_action('woocommerce_after_main_content');
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
get_footer('shop');
