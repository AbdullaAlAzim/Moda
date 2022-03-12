<?php
$arg = [
    'cat' => '<span class="niotitle">' . esc_html__('Category', 'moda') . '</span>',
    'tag' => '<span  class="niotitle">' . esc_html__('Tag', 'moda') . '</span>',
    'author' => '<span  class="niotitle">' . esc_html__('Author', 'moda') . '</span>',
    'year' => '<span  class="niotitle">' . esc_html__('Year', 'moda') . '</span>',
    'notfound' => '<span  class="niotitle">' . esc_html__('Not found', 'moda') . '</span>',
    'search' => '<span  class="niotitle">' . esc_html__('Search for', 'moda') . '</span>',
    'marchive' => '<span  class="niotitle">' . esc_html__('Monthly archive', 'moda') . '</span>',
    'yarchive' => '<span  class="niotitle">' . esc_html__('Yearly archive', 'moda') . '</span>',
];

if (is_home() && get_option('page_for_posts')) {
    $title = 'Blog';
} elseif (is_front_page()) {
    $title = 'Front Page';
} else {
    $title = get_the_title();
}
$query_args = array(
    'post_type' => 'product',
    'posts_per_page' => 4,
);
$product_thumb = new WP_Query($query_args);
?>
<!-- Start of header section
	============================================= -->
<!-- header start  -->
<header class="header-section moda-default-header">
    <div class="main-header">
        <div class="container">
            <div class="main-header-wraper">
                <?php moda_logo(); ?>
                <div class="main-menu-inner">
                    <div class="overlaly"></div>
                    <div class="main-menu  d-none d-lg-block">
                        <?php
                        echo str_replace(['menu-item-has-children', 'sub-menu'], ['dropdown', 'dropdown-menu'],
                            wp_nav_menu(array(
                                    'container' => false,
                                    'echo' => false,
                                    'menu_id' => 'main-menu',
                                    'theme_location' => 'primary',
                                    'fallback_cb' => 'moda_no_main_nav',
                                    'items_wrap' => '<ul>%3$s</ul>',
                                )
                            ));
                        ?>
                    </div>
                    <div class="mobile-menu d-block d-lg-none">
                        <div class="nav_close d-block d-lg-none"><i class="fal fa-times"></i></div>
                        <?php
                        echo str_replace(['menu-item-has-children', 'sub-menu'], ['dropdown', 'dropdown-menu'],
                            wp_nav_menu(array(
                                    'container' => false,
                                    'echo' => false,
                                    'menu_id' => 'm-main-menu',
                                    'theme_location' => 'primary',
                                    'fallback_cb' => 'moda_no_main_nav',
                                    'items_wrap' => '<ul>%3$s</ul>',
                                )
                            ));
                        ?>
                    </div>
                    <div class="moda-header-elements default-ele">

                        <!-- search  -->
                        <div class="wrapper">
                            <form id="searchform" class="searchbox" action="<?php echo home_url('/'); ?>" method="get">
                                <input type="text" id="search" placeholder="Search" class="input" name="s" value=""/>
                                <input type="hidden" name="post_type" value="product"/>
                            </form>
                        </div>

                        <!-- search  -->
                        <ul>
                            <li><a class="searchbtn" href="#"><i class="fal fa-search"></i></a></li>
                            <li><?php echo moda_wc_wishlist_count(); ?></li>
                            <li><a class="moda-cart-open" href="#"> <i class="flaticon-add-to-basket"></i><span
                                            class="moda-cart-count"></span></a></li>
                            <li class="dropdown"><a
                                        href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>"><i
                                            class="flaticon-user"></i></a>
                                <?php
                                echo str_replace(['menu-item-has-children', 'sub-menu'], ['dropdown', 'dropdown-menu'],
                                    wp_nav_menu(array(
                                            'container' => false,
                                            'echo' => false,
                                            'menu_id' => 'ac-main-menu',
                                            'theme_location' => 'account',
                                            'fallback_cb' => 'moda_no_main_nav',
                                            'items_wrap' => '<ul class="dropdown-menu">%3$s</ul>',
                                        )
                                    ));
                                ?>
                            </li>
                            <li><a class="open-nav" href="#"><img
                                            src="<?php echo get_template_directory_uri() ?>/assets/img/nav.svg"
                                            alt="Nav"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header end  -->
<div class="cart-overlay"></div>
<div class="moda-shop-cart">
    <div class="moda-cart-wraper">
        <div class="moda-cart-header">
            <div class="cart-close"><i class="fal fa-times"></i></div>
            <p><?php echo esc_html('My Cart'); ?></p>
        </div>
        <?php moda_cart_items(); ?>
    </div>
</div>
<!-- right side nav start  -->
<div class="right-overlaly"></div>
<div class="moda-right-side-nav">
    <div class="moda-nav-wraper">
        <div class="moda-modal-content p-0">
            <div class="content-wraper">
                <a href="#" class="nav-close-btn"><i class="fal fa-times"></i></a>
                <div class="logo"><?php moda_logo(); ?></div>
                <p><?php echo esc_html('We proudly dedicate ourselves to shaping the world in which every woman feels the comfort and inspiration needed to develop and express her personal sense of style. Clothes and accessories are extensions that color the day of modern women. '); ?></p>
                <div class="moda-new-arrivals">
                    <h2><?php echo esc_html('New Arrivals'); ?></h2>
                    <div class="images-thumb">
                        <?php
                        if ($product_thumb->have_posts()) {
                            while ($product_thumb->have_posts()) {
                                $product_thumb->the_post();
                                ?>
                                <a class="moda-arrival-thumb" href="<?php the_permalink(); ?>">
                                    <?php echo moda_wc_get_thumbnail() ?>
                                </a>
                                <?php
                            }
                            wp_reset_postdata();
                        }
                        ?>
                    </div>
                    <?php
                    echo str_replace(['menu-item-has-children', 'sub-menu'], ['dropdown', 'dropdown-menu'],
                        wp_nav_menu(array(
                                'container' => false,
                                'echo' => false,
                                'menu_id' => 'ac-main-menu',
                                'theme_location' => 'account',
                                'fallback_cb' => 'moda_no_main_nav',
                                'items_wrap' => '<ul>%3$s</ul>',
                            )
                        ));
                    ?>
                </div>
                <div class="moda-news-letter-form">
                    <h3>Newsletter</h3>
                    <form>
                        <div class="moda-input-group">
                            <input type="email" placeholder="Enter your email">
                            <button type="button" class="modal-btn moda-btn"><i class="fas fa-paper-plane"></i></button>
                        </div>
                    </form>
                    <div class="follow-us">
                        <h4><?php echo esc_html('Follow us :'); ?></h4>
                        <ul>
                            <li><a href="https://www.facebook.com"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="https://www.twitter.com"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="https://www.linkedin.com"><i class="fab fa-linkedin-in"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- right side nav  end-->


<section class="breadcrumb-section product-page-breadcrumb moda-blog-page-breadcrumb moda-section"
         data-background="<?php the_post_thumbnail_url(); ?>">
    <div class="container">
        <h2><?php echo wp_kses_post($title); ?></h2>
        <nav aria-label="breadcrumb">
            <?php moda_unit_breadcumb(); ?>
        </nav>
    </div>
</section>