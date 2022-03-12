<?php

require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';

add_action('tgmpa_register', 'moda_register_required_plugins');

function moda_register_required_plugins()
{

    $plugins = array(

        array(
            'name' => esc_attr__('Moda Core', 'moda'),
            'slug' => 'moda-core',
            'source' => get_template_directory_uri() . '/plugin/moda-core.zip',
            'required' => true,
            'version' => '1.0.0',
            'force_activation' => false,
            'force_deactivation' => false,
        ),
        array(
            'name' => esc_attr__('Woocommerce Multi Currency pro', 'moda'),
            'slug' => 'woocommerce-multi-currency',
            'source' => get_template_directory_uri() . '/plugin/woocommerce-multi-currency.zip',
            'required' => true,
            'version' => '1.0.0',
            'force_activation' => false,
            'force_deactivation' => false,
        ),
        array(
            'name' => esc_attr__('Contact Form 7', 'moda'),
            'slug' => 'contact-form-7',
            'required' => true,
            'force_activation' => false,
            'force_deactivation' => false,
        ),
        array(
            'name' => esc_attr__('Moda Demo Importer', 'moda'),
            'slug' => 'one-click-demo-import',
            'required' => true,
            'force_activation' => false,
            'force_deactivation' => false,
        ),
        array(
            'name' => esc_attr__('WooCommerce Wishlist', 'moda'),
            'slug' => 'yith-woocommerce-wishlist',
            'required' => true,
            'force_activation' => false,
            'force_deactivation' => false,
        ),
        array(
            'name' => esc_attr__('WooCommerce Compare', 'moda'),
            'slug' => 'woo-smart-compare',
            'required' => true,
            'force_activation' => false,
            'force_deactivation' => false,
        ),
        array(
            'name' => esc_attr__('WooCommerce Variants Swatch', 'moda'),
            'slug' => 'shopengine',
            'required' => true,
            'force_activation' => false,
            'force_deactivation' => false,
        ),
        array(
            'name' => esc_attr__('WooCommerce', 'moda'),
            'slug' => 'woocommerce',
            'required' => true,
            'force_activation' => false,
            'force_deactivation' => false,
        ),
        array(
            'name' => esc_attr__('Filters', 'moda'),
            'slug' => 'color-filters',
            'required' => true,
            'force_activation' => false,
            'force_deactivation' => false,
        ),
        array(
            'name' => esc_attr__('GTranslate', 'moda'),
            'slug' => 'gtranslate',
            'required' => true,
            'force_activation' => false,
            'force_deactivation' => false,
        ),

        array(
            'name' => esc_attr__('Elementor', 'moda'),
            'slug' => 'elementor',
            'required' => true,
            'version' => '',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => '',
        ),
    );

    $config = array(
        'default_path' => '',
        'menu' => 'tgmpa-install-plugins',
        'has_notices' => true,
        'dismissable' => true,
        'dismiss_msg' => '',
        'is_automatic' => false,
        'message' => '',
    );

    tgmpa($plugins, $config);

}