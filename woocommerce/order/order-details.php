<?php
/**
 * Order details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.6.0
 */

defined('ABSPATH') || exit;

$order = wc_get_order($order_id); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

if (!$order) {
    return;
}

$order_items = $order->get_items(apply_filters('woocommerce_purchase_order_item_types', 'line_item'));
$show_purchase_note = $order->has_status(apply_filters('woocommerce_purchase_note_order_statuses', array('completed', 'processing')));
$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();
$downloads = $order->get_downloadable_items();
$show_downloads = $order->has_downloadable_item() && $order->is_download_permitted();

if ($show_downloads) {
    wc_get_template(
        'order/order-downloads.php',
        array(
            'downloads' => $downloads,
            'show_title' => true,
        )
    );
}
?>
    <section class="delivery-date">
        <?php do_action('woocommerce_order_details_before_order_table', $order); ?>

        <h6 class="woocommerce-order-details__title"><?php esc_html_e('Your Delivery Dates', 'moda'); ?></h6>
        <div class="delivery-date-table">
            <table class="woocommerce-table woocommerce-table--order-details shop_table table order_details">
                <tbody>
                <?php
                do_action('woocommerce_order_details_before_order_table_items', $order);

                foreach ($order_items as $item_id => $item) {
                    $product = $item->get_product();

                    wc_get_template(
                        'order/order-details-item.php',
                        array(
                            'order' => $order,
                            'item_id' => $item_id,
                            'item' => $item,
                            'show_purchase_note' => $show_purchase_note,
                            'purchase_note' => $product ? $product->get_purchase_note() : '',
                            'product' => $product,
                        )
                    );
                }

                do_action('woocommerce_order_details_after_order_table_items', $order);
                ?>
                <td><?php echo esc_html('Est.'); ?><?php echo wc_format_datetime($order->get_date_created()); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></td>
                </tbody>
            </table>
            <div class="order-view">
                <p><?php echo esc_html('For more details, track your delivery status under My Account >') ?> <a
                            href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>"><?php echo esc_html('My Order'); ?></a>
                </p>
                <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>"
                   class="order-view-btn"><?php echo esc_html('View Order'); ?></a>
            </div>
            <div class="confirmation-email">
                <span><img src="<?php echo get_template_directory_uri() ?>/assets/img/payment/email-conformation.svg"
                           alt="Mail Icon"> <?php echo esc_html('We’ve sent a confirmation email to ' . $order->get_billing_email() . ' with the order details.'); ?></span>
            </div>
        </div>
        <?php do_action('woocommerce_order_details_after_order_table', $order); ?>
    </section>

<?php
/**
 * Action hook fired after the order details.
 *
 * @param WC_Order $order Order data.
 * @since 4.4.0
 */
do_action('woocommerce_after_order_details', $order);

if ($show_customer_details) {
    wc_get_template('order/order-details-customer.php', array('order' => $order));
}
