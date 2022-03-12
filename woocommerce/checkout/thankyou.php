<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined('ABSPATH') || exit;
?>
    <section class="thank-you-section">
        <div class="woocommerce-order">
            <div class="thank-you-wrapper">
                <?php
                if ($order) :

                    do_action('woocommerce_before_thankyou', $order->get_id());
                    ?>

                    <?php if ($order->has_status('failed')) : ?>

                    <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e('Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'moda'); ?></p>

                    <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
                        <a href="<?php echo esc_url($order->get_checkout_payment_url()); ?>"
                           class="button pay"><?php esc_html_e('Pay', 'moda'); ?></a>
                        <?php if (is_user_logged_in()) : ?>
                            <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>"
                               class="button pay"><?php esc_html_e('My account', 'moda'); ?></a>
                        <?php endif; ?>
                    </p>

                <?php else : ?>
                    <div class="thank-you-area">
                        <ul>
                            <li><img src="<?php echo get_template_directory_uri() ?>/assets/img/payment/thank1.svg"
                                     alt="Icon 1"></li>
                            <li><img src="<?php echo get_template_directory_uri() ?>/assets/img/payment/thank2.svg"
                                     alt="Icon 2"></li>
                            <li><img src="<?php echo get_template_directory_uri() ?>/assets/img/payment/thank3.svg"
                                     alt="Icon 3"></li>
                        </ul>
                        <h2><?php echo esc_html('Thank You'); ?></h2>
                        <span class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters('woocommerce_thankyou_order_received_text', esc_html__('Your order has been received', 'moda'), $order); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
                        <p><?php esc_html_e('Your order number is:', 'moda'); ?>
                            <b>#<?php echo wp_kses_post($order->get_order_number()); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></b>
                        </p>
                    </div>
                <?php endif; ?>

                    <?php do_action('woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id()); ?>
                    <?php do_action('woocommerce_thankyou', $order->get_id()); ?>

                <?php else : ?>

                    <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters('woocommerce_thankyou_order_received_text', esc_html__('Thank you. Your order has been received.', 'moda'), null); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>

                <?php endif; ?>
            </div>
        </div>
    </section>
<?php //get_template_part('woocommerce/single-product/up', 'sells')?>