<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_cart'); ?>
<div class="moda-shopping-cart-section">
    <div class="row">
        <form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
            <?php do_action('woocommerce_before_cart_table'); ?>
            <div class="row">
                <div class="col-lg-8 wow fadeInUp">
                    <div class="moda-cart-list-area">
                        <div class="cart-header">
                            <h5>Spend £80.30 to get Free Shipping</h5>
                        </div>
                        <div class="cart-product-wraper">
                            <div class="cart-list">
                                <?php do_action('woocommerce_before_cart_contents'); ?>
                                <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents table">
                                    <thead>
                                    <tr>
                                        <th class="product-thumbnail"><?php esc_html_e('Product', 'moda'); ?></th>
                                        <th class="product-price"><?php esc_html_e('Price', 'moda'); ?></th>
                                        <th class="product-quantity"><?php esc_html_e('Quantity', 'moda'); ?></th>
                                        <th class="product-subtotal"><?php esc_html_e('Subtotal', 'moda'); ?></th>
                                        <th class="product-remove">&nbsp;</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php do_action('woocommerce_before_cart_contents'); ?>

                                    <?php
                                    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                                        $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                                        $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

                                        if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
                                            $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
                                            ?>
                                            <tr class="woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">

                                                <td class="product-thumbnail">
                                                    <div class="images">
                                                        <?php
                                                        $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);

                                                        if (!$product_permalink) {
                                                            echo wp_kses_post($thumbnail); // PHPCS: XSS ok.
                                                        } else {
                                                            printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail); // PHPCS: XSS ok.
                                                        }
                                                        ?>
                                                        <p data-title="<?php esc_attr_e('Product', 'moda'); ?>">
                                                            <?php
                                                            if (!$product_permalink) {
                                                                echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key) . '&nbsp;');
                                                            } else {
                                                                echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s">%s</a>', esc_url($product_permalink), $_product->get_name()), $cart_item, $cart_item_key));
                                                            }

                                                            do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);

                                                            // Meta data.
                                                            echo wc_get_formatted_cart_item_data($cart_item); // PHPCS: XSS ok.

                                                            // Backorder notification.
                                                            if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
                                                                echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'moda') . '</p>', $product_id));
                                                            }
                                                            ?>
                                                        </p>
                                                    </div>
                                                </td>

                                                <td class="product-price"
                                                    data-title="<?php esc_attr_e('Price', 'moda'); ?>">
                                                    <?php
                                                    echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); // PHPCS: XSS ok.
                                                    ?>
                                                </td>

                                                <td class="product-quantity"
                                                    data-title="<?php esc_attr_e('Quantity', 'moda'); ?>">
                                                    <div class="nice-number">
                                                        <?php
                                                        if ($_product->is_sold_individually()) {
                                                            $product_quantity = sprintf('1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key);
                                                        } else {
                                                            $product_quantity = woocommerce_quantity_input(
                                                                array(
                                                                    'input_name' => "cart[{$cart_item_key}][qty]",
                                                                    'input_value' => $cart_item['quantity'],
                                                                    'max_value' => $_product->get_max_purchase_quantity(),
                                                                    'min_value' => '0',
                                                                    'product_name' => $_product->get_name(),
                                                                ),
                                                                $_product,
                                                                false
                                                            );
                                                        }

                                                        echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item); // PHPCS: XSS ok.
                                                        ?>
                                                    </div>
                                                </td>

                                                <td class="product-subtotal sub-total"
                                                    data-title="<?php esc_attr_e('Subtotal', 'moda'); ?>">
                                                    <?php
                                                    echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); // PHPCS: XSS ok.
                                                    ?>
                                                </td>
                                                <td class="product-remove">
                                                    <?php
                                                    echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                                        'woocommerce_cart_item_remove_link',
                                                        sprintf(
                                                            '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
                                                            esc_url(wc_get_cart_remove_url($cart_item_key)),
                                                            esc_html__('Remove this item', 'moda'),
                                                            esc_attr($product_id),
                                                            esc_attr($_product->get_sku())
                                                        ),
                                                        $cart_item_key
                                                    );
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>

                                    <?php do_action('woocommerce_cart_contents'); ?>
                                    </tbody>
                                </table>
                                <?php do_action('woocommerce_after_cart_table'); ?>
                                <div class="moda-coupon-area">
                                    <?php if (wc_coupons_enabled()) { ?>
                                        <div class="coupon moda-coupon">
                                            <input
                                                    type="text" name="coupon_code" class="input-text" id="coupon_code"
                                                    value=""
                                                    placeholder="<?php esc_attr_e('Coupon code', 'moda'); ?>"/>
                                            <button type="submit" class="button coupon-btn moda-btn" name="apply_coupon"
                                                    value="<?php esc_attr_e('Apply coupon', 'moda'); ?>"><?php esc_attr_e('Apply coupon', 'moda'); ?></button>
                                            <?php do_action('woocommerce_cart_coupon'); ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4  wow fadeInUp" data-wow-delay="0.4s">
                    <div class="moda-cart-totals">
                        <h6>Cart Totals</h6>
                        <ul>
                            <li>Subtotal<span><?php echo WC()->cart->get_total(); ?></span></li>
                            <li>Shipping Cost<span><?php echo WC()->cart->get_cart_shipping_total() ?></span></li>
                            <li>Vat<span><?php echo WC()->cart->get_subtotal_tax() ?></span></li>
                        </ul>
                        <p>Shipping options will be updated during checkout. Calculate shipping</p>
                        <div class="total">
                            <h5>Total</h5>
                            <h5><?php echo WC()->cart->get_cart_subtotal(); ?></h5>
                        </div>
                    </div>
                    <button type="submit" class="button checkout-btn moda-btn mb-2" name="update_cart"
                            value="<?php esc_attr_e('Update cart', 'moda'); ?>"><?php esc_html_e('Update cart', 'moda'); ?></button>

                    <?php do_action('woocommerce_cart_actions'); ?>

                    <?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
                    <a href="<?php echo wc_get_checkout_url(); ?>" class="checkout-btn moda-btn">PROCEED TO CHECKOUT</a>
                </div>
            </div>
        </form>

        <?php do_action('woocommerce_before_cart_collaterals'); ?>

        <div class="cart-collaterals">
            <?php
            /**
             * Cart collaterals hook.
             *
             * @hooked woocommerce_cross_sell_display
             * @hooked woocommerce_cart_totals - 10
             */
            do_action('woocommerce_cart_collaterals');
            ?>
        </div>
    </div>
</div>
<?php do_action('woocommerce_after_cart'); ?>
