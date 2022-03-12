<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 */
get_header();
if (is_active_sidebar('sidebar-1')) {
    $main = 'col-xl-8';
    $sidebar = 'col-xl-4';
} else {
    $main = 'col-xl-12';
    $sidebar = 'col-xl-12';
}
?>
    <div class="moda-blog-section moda-section">
        <div class="container">
            <div class="moda-blog-wraper">
                <div class="row">
                    <div class="<?php echo esc_attr($main); ?>">
                        <?php if (have_posts()) :

                            /* Start the Loop */
                            while (have_posts()) : the_post();

                                get_template_part('template-parts/singlecontent');

                            endwhile;

                        endif; ?>
                    </div>
                    <div class="<?php echo esc_attr($sidebar); ?>">
                        <?php get_sidebar(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php get_footer();