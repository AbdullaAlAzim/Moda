<?php
/**
 * Order Customer Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-customer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.6.0
 */

defined('ABSPATH') || exit;

$show_shipping = !wc_ship_to_billing_address_only() && $order->needs_shipping_address();
$order_items = $order->get_items(apply_filters('woocommerce_purchase_order_item_types', 'line_item'));

//var_dump($order_items);
?>
<section class="woocommerce-customer-details order-summery">

    <p>
        <a class="order-summery-header collapsed" data-bs-toggle="collapse" href="#order-summeryone">
            <?php echo esc_html('Order Summery'); ?>
            <span><?php echo get_woocommerce_currency_symbol() . $order->get_total(); ?></span>
        </a>
    </p>
    <div class="collapse" id="order-summeryone">
        <div class="card card-body">
            <ul class="price">
                <li><span><?php echo esc_html('Subtotal (' . $order->get_item_count() . ' Items)'); ?></span>
                    <span><?php echo wp_kses_post($order->get_subtotal_to_display()); ?></span></li>
                <li><span><?php echo esc_html('Delivery Charge'); ?></span>
                    <span><?php echo get_woocommerce_currency_symbol() . $order->get_shipping_total(); ?></span></li>
            </ul>
            <div class="order-price-bottom">
                <p><?php echo esc_html('Order Summery'); ?></p>
                <div class="right-side">
                    <h4><?php echo get_woocommerce_currency_symbol() . $order->get_total(); ?></h4>
                    <span><?php echo esc_html('VAT included, where applicable'); ?></span>
                </div>
            </div>
        </div>
    </div>

    <?php do_action('woocommerce_order_details_after_customer_details', $order); ?>

</section>
