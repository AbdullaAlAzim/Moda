<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

if (!defined('ABSPATH')) {
    exit;
}

do_action('woocommerce_before_account_navigation');
?>
<div class="user-info">
    <div class="moda-user-thumb">
        <?php echo get_avatar(get_current_user_id()) ?>
    </div>
    <div class="user-title">
        <a href="#" class="user-name">
            <?php global $current_user;
            wp_get_current_user();
            echo wp_kses_post($current_user->display_name) . "\n";
            ?>
        </a>
    </div>
</div>
<nav class="woocommerce-MyAccount-navigation">
    <ul class="nav flex-column" id="myTab" role="tablist">
        <?php foreach (wc_get_account_menu_items() as $endpoint => $label) : ?>
            <li class="<?php echo wc_get_account_menu_item_classes($endpoint); ?>">
                <a href="<?php echo esc_url(wc_get_account_endpoint_url($endpoint)); ?>"><?php echo esc_html($label); ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>

<?php do_action('woocommerce_after_account_navigation'); ?>
