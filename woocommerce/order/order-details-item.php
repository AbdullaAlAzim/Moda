<?php
/**
 * Order Item Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-item.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!apply_filters('woocommerce_order_item_visible', true, $item)) {
    return;
}
?>
<td class="images <?php echo esc_attr(apply_filters('woocommerce_order_item_class', 'woocommerce-table__line-item order_item', $item, $order)); ?>">
    <?php
    $is_visible = $product && $product->is_visible();
    $product_permalink = apply_filters('woocommerce_order_item_permalink', $is_visible ? $product->get_permalink($item) : '', $item, $order);
    echo wp_kses_post(apply_filters('woocommerce_order_item_name', $product_permalink ? sprintf('<a href="%s">%s</a>', $product_permalink, $product->get_image()) : $product->get_image(), $item, $is_visible));

    do_action('woocommerce_order_item_meta_start', $item_id, $item, $order, false);

    wc_display_item_meta($item); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

    do_action('woocommerce_order_item_meta_end', $item_id, $item, $order, false);
    ?>

</td>
