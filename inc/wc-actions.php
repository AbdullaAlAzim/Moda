<?php
add_action('woocommerce_widget_shopping_cart_buttons', function () {
    // Removing Buttons
    remove_action('woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_button_view_cart', 10);
    remove_action('woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_proceed_to_checkout', 20);

    // Adding customized Buttons
    add_action('woocommerce_widget_shopping_cart_buttons', 'moda_widget_shopping_cart_button_view_cart', 10);
    add_action('woocommerce_widget_shopping_cart_buttons', 'moda_widget_shopping_cart_proceed_to_checkout', 20);
}, 1);

function moda_woocommerce_setup()
{
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
    add_filter('woocommerce_enqueue_styles', '__return_false');
}

add_action('after_setup_theme', 'moda_woocommerce_setup');
if (function_exists('WooCommerce')) {
    function moda_wc_scripts()
    {
        $font_path = WC()->plugin_url() . '/assets/fonts/';
        $inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

        wp_add_inline_style('moda-woocommerce-style', $inline_font);
    }

    add_action('wp_enqueue_scripts', 'moda_wc_scripts', 99);
}
function moda_update_wishlist_count()
{
    if (function_exists('YITH_WCWL')) {
        wp_send_json(YITH_WCWL()->count_products());
    }
}

add_action('wp_ajax_moda_update_wishlist_count', 'moda_update_wishlist_count');
add_action('wp_ajax_nopriv_moda_update_wishlist_count', 'moda_update_wishlist_count');

// Custom cart button
function moda_widget_shopping_cart_button_view_cart()
{
    $original_link = wc_get_cart_url();
    echo '<a href="' . esc_url($original_link) . '" class="button cart moda-btn cart-drawer wc-forward">' . esc_html__('View cart', 'moda') . '</a>';
}

// Custom Checkout button
function moda_widget_shopping_cart_proceed_to_checkout()
{
    $original_link = wc_get_checkout_url();
    echo '<a href="' . esc_url($original_link) . '" class="button moda-btn cart-drawer checkout wc-forward">' . esc_html__('Checkout', 'moda') . '</a>';
}

/**
 * Locate a template and return the path for inclusion.
 *
 * @since 1.0.0
 */
function moda_wc_locate_template($template, $template_name, $template_path)
{
    global $woocommerce;

    $_template = $template;

    if (!$template_path) $template_path = $woocommerce->template_url;

    $theme_path = MODA_PATH . '/inc/vendor/woocommerce/';

    // Look within passed path within the theme - this is priority
    $template = locate_template(
        array(
            trailingslashit($template_path) . $template_name,
            $template_name
        )
    );

    // Modification: Get the template from this folder, if it exists
    if (!$template && file_exists($theme_path . $template_name))
        $template = $theme_path . $template_name;

    // Use default template
    if (!$template)
        $template = $_template;

    // Return what we found
    return $template;
}

function moda_wc_locate_template_parts($template, $slug, $name)
{
    $theme_path = MODA_PATH . '/inc/vendor/woocommerce/';
    if ($name) {
        $newpath = $theme_path . "{$slug}-{$name}.php";
    } else {
        $newpath = $theme_path . "{$slug}.php";
    }
    return file_exists($newpath) ? $newpath : $template;
}

//add_filter( 'woocommerce_locate_template', 'moda_wc_locate_template', 10, 3 );
//add_filter( 'wc_get_template_part', 'moda_wc_locate_template_parts', 10, 3 );
/**
 * Show cart contents / total Ajax
 */
add_filter('woocommerce_add_to_cart_fragments', 'moda_woocommerce_header_add_to_cart_fragment');

function moda_woocommerce_header_add_to_cart_fragment($fragments)
{
    global $woocommerce;
    ob_start();
    ?>
    <span class="moda-cart-count"><?php echo wp_kses_post($woocommerce->cart->cart_contents_count); ?></span>
    <?php
    $fragments['span.moda-cart-count'] = ob_get_clean();
    return $fragments;
}

/**
 * WooCommerce update mini cart on ajax click
 */
// Update Cart Count & Mini Cart
add_filter('woocommerce_add_to_cart_fragments', 'iconic_cart_count_fragments', 10, 1);

function iconic_cart_count_fragments($fragments)
{
    if (!empty(WC()->cart->get_cart_contents_count())) {
        $fragments['span.menu-cart-count'] = '<span class="cart-count menu-cart-count">(' . WC()->cart->get_cart_contents_count() . ')</span>';

        ob_start();
        echo '<div class="header-mini-cart">';
        woocommerce_mini_cart();
        echo '</div>';
        $fragments['div.header-mini-cart'] = ob_get_clean();
    }

    return $fragments;

}

/**
 * Create the section beneath the products tab
 **/
add_filter('woocommerce_get_sections_products', 'moda_woo_settings');
function moda_woo_settings($sections)
{

    $sections['moda_woo'] = esc_attr__('Moda', 'moda');
    return $sections;

}

/**
 * Add settings to the specific section we created before
 */
add_filter('woocommerce_get_settings_products', 'moda_custom_woo_settings', 10, 2);
function moda_custom_woo_settings($settings, $current_section)
{
    /**
     * Check the current section is what we want
     **/
    if ($current_section == 'moda_woo') {
        $moda_woo_customize = array();
        // Add Title to the Settings
        $moda_woo_customize[] = array('name' => esc_attr__('Moda Woo Settings', 'moda'), 'type' => 'title', 'desc' => esc_attr__('Moda all woocommerce settings in here.', 'moda'), 'id' => 'moda_woo');
        // Add settings number of products per page
        $moda_woo_customize[] = array(
            'name' => esc_attr__('Products Per Shop Page', 'moda'),
            'desc_tip' => esc_attr__('example 12 products per shop page', 'moda'),
            'id' => 'products_per_page',
            'type' => 'number',
            'desc' => esc_attr__('Put the number how many products you want to display in a page', 'moda'),
        );
        // Add settings number of products per row
        $moda_woo_customize[] = array(
            'name' => esc_attr__('Products Per Shop Row', 'moda'),
            'desc_tip' => esc_attr__('example 3 products per shop page', 'moda'),
            'id' => 'products_per_row',
            'type' => 'number',
            'desc' => esc_attr__('Put the number how many products you want to display in a page', 'moda'),
        );
        $moda_woo_customize[] = array('type' => 'sectionend', 'id' => 'moda_woo');
        return $moda_woo_customize;

    } else {
        return $settings;
    }
}

/**
 * Change number or products per row to 3
 */
add_filter('loop_shop_columns', 'moda_products_per_row', 30);
if (!function_exists('moda_products_per_row')) {
    function moda_products_per_row()
    {
        $row = get_option('products_per_row') ? get_option('products_per_row') : 4;
        return $row; // 4 products per row
    }
}

/**
 * Change number of products that are displayed per page (shop page)
 */
add_filter('loop_shop_per_page', 'moda_products_per_page', 30);
function moda_products_per_page($cols)
{
    $cols = get_option('products_per_page') ? get_option('products_per_page') : 9;
    return $cols;
}

add_action('woocommerce_before_main_content', 'moda_remove_sidebar');
function moda_remove_sidebar()
{
    if (is_checkout() || is_cart() || is_product()) {
        remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
    }
}

function moda_remove_wishlist($show)
{
    $show = false;
    return $show;
}

add_filter('yith_wcwl_show_add_to_wishlist', 'moda_remove_wishlist');

function moda_remove_compare($show)
{
    $show = false;
    return $show;
}

add_filter('yith_wcwl_show_add_to_wishlist', 'moda_remove_compare');
remove_action('woocommerce_single_product_summary', 'YITH_WCWL_Frontend–>print_button', 31);

remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
function moda_remove_shop_title($val)
{
    $val = false;
    return $val;
}

add_filter('woocommerce_show_page_title', 'moda_remove_shop_title');

add_action('woocommerce_pagination', 'woocommerce_pagination', 10);

//add_filter('woocommerce_form_field_args', 'moda_wc_form_field_args', 10, 3);
function moda_wc_form_field_args($args, $key, $value)
{
    if (is_edit_account_page()) {
        return $args;
    }
    $args['class'] = array('moda-input-group');
    return $args;
}

add_filter('woocommerce_checkout_fields', 'moda_checkout_fields_styling');

function moda_checkout_fields_styling($field)
{

    $field['billing']['billing_first_name']['priority'] = 1;
    $field['billing']['billing_last_name']['priority'] = 2;
    $field['billing']['billing_email']['priority'] = 3;
    $field['billing']['billing_phone']['priority'] = 4;

    $field['billing']['billing_first_name']['class'][0] = 'half-width';
    $field['billing']['billing_last_name']['class'][0] = 'half-width';
    $field['billing']['billing_email']['class'][0] = 'half-width';
    $field['billing']['billing_phone']['class'][0] = 'half-width';

    return $field;

}

add_filter('woocommerce_gateway_icon', 'custom_payment_gateway_icons', 10, 2);
function custom_payment_gateway_icons($icon, $gateway_id)
{

    foreach (WC()->payment_gateways->get_available_payment_gateways() as $gateway)
        if ($gateway->id == $gateway_id) {
            $title = $gateway->get_title();
            break;
        }

    // The path (subfolder name(s) in the active theme)
    $path = get_template_directory_uri() . '/assets/img/payment';

    // Setting (or not) a custom icon to the payment IDs
    if ($gateway_id == 'bacs')
        $icon = '<img src="' . WC_HTTPS::force_https_url("$path/1.png") . '" alt="' . esc_attr($title) . '" />';
    elseif ($gateway_id == 'cheque')
        $icon = '<img src="' . WC_HTTPS::force_https_url("$path/3.png") . '" alt="' . esc_attr($title) . '" />';
    elseif ($gateway_id == 'cod')
        $icon = '<img src="' . WC_HTTPS::force_https_url("$path/2.png") . '" alt="' . esc_attr($title) . '" />';
    elseif ($gateway_id == 'ppec_paypal' || 'paypal')
        return $icon;

    return $icon;
}

remove_action('woocommerce_before_shop_loop', 'woocommerce_output_all_notices');
// Remove default WooCommerce style


remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);

remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
//remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
//remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);

//remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

remove_action('woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10); // Remove Duplicated Cart Totals
//remove_action('woocommerce_before_single_product', 'woocommerce_output_all_notices', 10);

remove_action('woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10);
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
