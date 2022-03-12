<?php
/**
 * Replace WooCommerce Default Pagination with WP-PageNavi Pagination
 *
 */

function moda_load_ajax()
{
    global $wp_query;
    wp_enqueue_script('moda-load-more', get_template_directory_uri() . '/inc/moda-ajax/loadmorepost.js', array('jquery'), moda_theme_version(), true);
    wp_localize_script('moda-load-more', 'moda_load_more', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'posts' => json_encode($wp_query->query_vars), // everything about your loop is here
        'current_page' => get_query_var('paged') ? get_query_var('paged') : 1,
        'max_page' => $wp_query->max_num_pages,
    ));
}

add_action('wp_enqueue_scripts', 'moda_load_ajax', 99);
function moda_load_ajax2()
{
    global $wp_query;
    wp_enqueue_script('moda-load-more2', get_template_directory_uri() . '/inc/moda-ajax/loadmorepost2.js', array('jquery'), moda_theme_version(), true);
    wp_localize_script('moda-load-more2', 'moda_load_more2', array(
        'ajaxurl2' => admin_url('admin-ajax.php'),
        'posts2' => json_encode($wp_query->query_vars), // everything about your loop is here
        'current_page2' => get_query_var('paged') ? get_query_var('paged') : 1,
        'max_page2' => $wp_query->max_num_pages,
    ));
}

add_action('wp_enqueue_scripts', 'moda_load_ajax2', 99);
function moda_ajax_load_more()
{
    global $wp_query;
    if ($wp_query->max_num_pages > 1)
        echo '<div class="button-wraper">
            <a href="#" class="load-more-btn moda-btn" id="loadMore">Load More</a>
        </div>';
}

function moda_ajax_load_more2()
{
    global $wp_query;
    if ($wp_query->max_num_pages > 1)
        echo '<div class="button-wraper">
            <a href="#" class="load-more-btn moda-btn" id="loadMore2">Load More</a>
        </div>';
}

remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);
if (isset($_GET['layout']) && $_GET['layout'] == '2') {
    add_action('woocommerce_after_shop_loop', 'moda_ajax_load_more2', 10);
} else {
    add_action('woocommerce_after_shop_loop', 'moda_ajax_load_more', 10);
}

function moda_load_more_product()
{
    $args = json_decode(stripslashes($_POST['query']), true);
    $args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
    $args['post_status'] = 'publish';

    // it is always better to use WP_Query but not here
    query_posts($args);

    if (have_posts()) :

        // run the loop
        while (have_posts()): the_post();

            wc_get_template_part('content', 'product');

        endwhile;

    endif;
    die;
}

add_action('wp_ajax_moda_load_more', 'moda_load_more_product');
add_action('wp_ajax_nopriv_moda_load_more', 'moda_load_more_product');
function moda_load_more_product2()
{
    $args = json_decode(stripslashes($_POST['query']), true);
    $args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
    $args['post_status'] = 'publish';

    // it is always better to use WP_Query but not here
    query_posts($args);

    if (have_posts()) :

        // run the loop
        while (have_posts()): the_post();

            wc_get_template_part('content-product', 'layout2');

        endwhile;

    endif;
    die;
}

add_action('wp_ajax_moda_load_more2', 'moda_load_more_product2');
add_action('wp_ajax_nopriv_moda_load_more2', 'moda_load_more_product2');