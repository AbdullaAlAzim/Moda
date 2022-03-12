<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 */

get_header();
$account = class_exists('WooCommerce') ? !is_user_logged_in() && is_account_page() : '';
if (!$account) {
    ?>
    <!-- wishlist-section start  -->
    <section class="moda-blog-section moda-section">
        <div class="container">
            <?php
            while (have_posts()) : the_post();

                get_template_part('template-parts/content', 'page');

                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;

            endwhile; // End of the loop.
            ?>
        </div>
    </section>


    <?php

} else {
    while (have_posts()) : the_post();

        get_template_part('template-parts/content-account', 'page');

        // If comments are open or we have at least one comment, load up the comment template.
        if (comments_open() || get_comments_number()) :
            comments_template();
        endif;

    endwhile; // End of the loop.
}

get_footer();