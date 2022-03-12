<?php
/**
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 */

if (!function_exists('moda_setup')) {

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function moda_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on _s, use a find and replace
         * to change 'moda' to the name of your theme in all the template files.
         */
        load_theme_textdomain('moda', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');
        // Add theme support for images siza.
        add_image_size('moda-770-430', 770, 430, true);
        add_image_size('moda-370-260', 370, 260, true);
        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support('custom-logo');
        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => esc_html__('Primary', 'moda'),
        ));
        register_nav_menus(array(
            'account' => esc_html__('Account Menu', 'moda'),
        ));
        register_nav_menus(array(
            'category' => esc_html__('Category Menu', 'moda'),
        ));
        add_theme_support('wp-block-styles');
        add_theme_support('align-wide');
        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'script',
            'style'
        ));
        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('moda_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');
        add_theme_support('woocommerce');
    }
}
add_action('after_setup_theme', 'moda_setup');

define('MODA_PATH', get_template_directory());
define('MODA_URL', get_template_directory_uri());
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function moda_content_width()
{
    $GLOBALS['content_width'] = apply_filters('moda_content_width', 640);
}

add_action('after_setup_theme', 'moda_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function moda_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'moda'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'moda'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="wedgets-title">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Shop Sidebar', 'moda'),
        'id' => 'shop-sidebar',
        'description' => esc_html__('Add widgets here.', 'moda'),
        'before_widget' => '<div id="%1$s" class="moda-sidebar-widgets %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="sidebar-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer Widget', 'moda'),
        'id' => 'footer-widget',
        'description' => esc_html__('Add widgets here.', 'moda'),
        'before_widget' => '<div class="col-lg-4"><div id="%1$s" class="footer-items %2$s">',
        'after_widget' => '</div></div>',
        'before_title' => '<h2 class="title">',
        'after_title' => '</h2>',
    ));
}

add_action('widgets_init', 'moda_widgets_init');

function moda_theme_version()
{
    $modatheme = wp_get_theme();
    $moda_version = esc_html($modatheme->get('Version'));
    return $moda_version;
}

/**
 * Register Google fonts.
 *
 * @return string Google fonts URL for the theme.
 */
function moda_fonts_url()
{
    $fonts_url = '';
    $fonts = array();
    $subsets = '';

    if ('off' !== esc_html_x('on', 'Jost font: on or off', 'moda')) {
        $fonts[] = 'Jost:300,400,500,600,700,800,900';
    }
    if ('off' !== esc_html_x('on', 'Open Sans: on or off', 'moda')) {
        $fonts[] = 'Open Sans:300,400,600,700,800';
    }

    if ($fonts) {
        $fonts_url = add_query_arg(array(
            'family' => urlencode(implode('|', $fonts)),
            'subset' => urlencode($subsets),
        ), 'https://fonts.googleapis.com/css');
    }

    return $fonts_url;
}

/**
 * Enqueue scripts and styles.
 */
function moda_scripts()
{
    wp_enqueue_style('moda-fonts', moda_fonts_url());
    wp_enqueue_style('moda-bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css');
    wp_enqueue_style('moda-animate', get_template_directory_uri() . '/assets/css/animate.css');
    wp_enqueue_style('moda-nice-number', get_template_directory_uri() . '/assets/css/jquery.nice-number.css');
    wp_enqueue_style('moda-nice-select', get_template_directory_uri() . '/assets/css/nice-select.css');
    wp_enqueue_style('moda-jquery-ui', get_template_directory_uri() . '/assets/css/jquery-ui.css');
    wp_enqueue_style('moda-swiper-bundle', get_template_directory_uri() . '/assets/css/swiper-bundle.min.css');
    wp_enqueue_style('moda-default', get_template_directory_uri() . '/assets/css/default.css');
    wp_enqueue_style('moda-fontawesome', get_template_directory_uri() . '/assets/css/fontawesome-all.min.css');
    wp_enqueue_style('moda-flaticon', get_template_directory_uri() . '/assets/font/flaticon.css');
    wp_enqueue_style('moda-theme-main', get_template_directory_uri() . '/assets/css/moda.css');
    wp_enqueue_style('moda-theme-wc', get_template_directory_uri() . '/assets/css/moda-wc.css');
    wp_enqueue_style('moda-theme', get_stylesheet_uri());
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    wp_enqueue_style('dashicons');
    wp_enqueue_script('moda-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array('jquery'), moda_theme_version(), true);
    wp_enqueue_script('moda-nice-number', get_template_directory_uri() . '/assets/js/jquery.nice-number.js', array('jquery'), moda_theme_version(), true);
    wp_enqueue_script('moda-swiper', get_template_directory_uri() . '/assets/js/swiper-bundle.min.js', array('jquery'), moda_theme_version(), true);
    wp_enqueue_script('moda-nice-select', get_template_directory_uri() . '/assets/js/jquery.nice-select.js', array('jquery'), moda_theme_version(), true);
    wp_enqueue_script('moda-touch-punch', get_template_directory_uri() . '/assets/js/jquery.ui.touch-punch.min.js', array('jquery'), moda_theme_version(), true);
    wp_enqueue_script('jquery-ui-slider');
    wp_enqueue_script('moda-wow', get_template_directory_uri() . '/assets/js/wow.min.js', array('jquery'), moda_theme_version(), true);
    wp_enqueue_script('moda-unit', get_template_directory_uri() . '/assets/js/unit.js', array('jquery'), moda_theme_version(), true);
    wp_enqueue_script('moda-wc', get_template_directory_uri() . '/assets/js/moda-wc.js', array('jquery'), moda_theme_version(), true);
    wp_enqueue_script('moda-jquery-yith-wcwl', get_template_directory_uri() . '/assets/js/moda-yith.js', array('jquery'), moda_theme_version(), true);

}

add_action('wp_enqueue_scripts', 'moda_scripts', 99);


function moda_admin_css()
{
    wp_enqueue_style('moda-admin-style', get_template_directory_uri() . '/assets/css/admin.css');
}

add_action('admin_enqueue_scripts', 'moda_admin_css');

/**
 * Custom template tags for this theme.
 */
require_once get_template_directory() . '/inc/template-tags.php';
require_once get_template_directory() . '/helper/customizer-extra.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require_once get_template_directory() . '/inc/template-functions.php';
/**
 * Functions which loaded from plugin.
 */
require_once get_template_directory() . '/inc/plug-dependent.php';
/**
 * Load plugin recommendation.
 */
require_once get_template_directory() . '/inc/plugin-recommendations.php';
require_once get_template_directory() . '/inc/wc-functions.php';
require_once get_template_directory() . '/inc/wc-actions.php';
require_once get_template_directory() . '/inc/moda-ajax/loadmore.php';


