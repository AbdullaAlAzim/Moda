<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
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

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters('woocommerce_product_tabs', array());

if (!empty($product_tabs)) :

    $index = 0;
    $index2 = 0;
    ?>

    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <?php foreach ($product_tabs as $key => $product_tab) :
                $index++;
                if ($index == 1) {
                    $active = 'active';
                } else {
                    $active = '';
                }
                ?>
                <button class="nav-link <?php echo esc_attr($active); ?>" id="nav-<?php echo esc_attr($key); ?>-tab"
                        data-bs-toggle="tab" data-bs-target="#nav-<?php echo esc_attr($key); ?>"
                        type="button"><?php echo wp_kses_post(apply_filters('woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key)); ?></button>
            <?php endforeach; ?>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <?php foreach ($product_tabs as $key => $product_tab) :
            $index2++;
            if ($index2 == 1) {
                $active2 = 'active show';
            } else {
                $active2 = '';
            }
            ?>
            <div class="tab-pane fade <?php echo esc_attr($active2); ?> <?php echo esc_attr($key); ?>"
                 id="nav-<?php echo esc_attr($key); ?>" role="tabpanel">
                <?php
                if (isset($product_tab['callback'])) {
                    call_user_func($product_tab['callback'], $key, $product_tab);
                }
                ?>
            </div>
        <?php endforeach; ?>
        <?php do_action('woocommerce_product_after_tabs'); ?>
    </div>

<?php endif; ?>
